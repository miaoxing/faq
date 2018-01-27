<?php

$view->layout();
?>

<?= $block('header-actions') ?>
<a class="btn btn-default" href="<?= $url('admin/faqs') ?>">返回列表</a>
<?= $block->end() ?>

<div class="row">
  <div class="col-xs-12">
    <form class="form-horizontal js-faq-form" role="form" method="post">

      <div class="form-group">
        <label class="col-lg-2 control-label" for="question">
          <span class="text-warning">*</span>
          问题
        </label>

        <div class="col-lg-4">
          <input type="text" name="question" id="question" class="form-control" required>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label" for="answer">
          <span class="text-warning">*</span>
          答案
        </label>

        <div class="col-lg-6">
          <textarea type="text" name="answer" id="answer" class="js-answer" required></textarea>
        </div>
      </div>

      <div class="clearfix form-actions form-group">
        <input type="hidden" name="id" id="id">

        <div class="col-lg-offset-2">
          <button class="btn btn-primary" type="submit">
            <i class="fa fa-check bigger-110"></i>
            提交
          </button>
          &nbsp; &nbsp; &nbsp;
          <a class="btn btn-default" href="<?= $url('admin/faqs') ?>">
            <i class="fa fa-undo bigger-110"></i>
            返回列表
          </a>
        </div>
      </div>
    </form>
  </div>
</div>

<?= $block->js() ?>
<script>
  require([
    'form',
    'ueditor',
    'validator',
    'plugins/app/libs/jquery.populate/jquery.populate',
  ], function (form) {
    var faq = <?= $faq->toJson() ?>;

    $('.js-faq-form')
      .populate(faq)
      .ajaxForm({
        url: $.url('admin/faqs/update'),
        dataType: 'json',
        beforeSubmit: function (arr, $form) {
          return $form.valid();
        },
        success: function (ret) {
          $.msg(ret, function () {
            if (ret.code === 1) {
              window.location.href = $.url('admin/faqs');
            }
          });
        }
      })
      .validate();

    $('.js-answer').ueditor();
  });
</script>
<?= $block->end() ?>
