<?php

use Miaoxing\Job\Service\Job;

$view->layout();
?>

<?= $block('header-actions') ?>
<a class="btn btn-success" href="<?= $url('admin/faqs/new') ?>">新建常见问题</a>
<?= $block->end() ?>

<div class="row">
  <div class="col-xs-12">

    <!-- PAGE CONTENT BEGINS -->
    <div class="table-responsive">
      <table class="js-faq-table record-table table table-bordered table-hover">
        <thead>
        <tr>
          <th>编号</th>
          <th>问题</th>
          <th>查看次数</th>
          <th>操作</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    <!-- /.table-responsive -->
    <!-- PAGE CONTENT ENDS -->
  </div>
  <!-- /col -->
</div>
<!-- /row -->

<script id="action-tpl" type="text/html">
  <a href="<%= $.url('admin/faqs/%s/edit', id) %>">编辑</a>
  <a class="delete-record text-danger" href="javascript:"
    data-href="<%= $.url('admin/faqs/%s/destroy', id) %>">删除</a>
</script>

<?= $block('js') ?>
<script>
  require(['form', 'dataTable'], function () {
    var $table = this.$('.js-faq-table').dataTable({
      ajax: {
        url: $.queryUrl('admin/faqs.json')
      },
      columns: [
        {
          data: 'id',
          visible: false
        },
        {
          data: 'question'
        },
        {
          data: 'views'
        },
        {
          data: 'id',
          sClass: 'text-center',
          render: function (data, type, full) {
            return template.render('action-tpl', full);
          }
        }
      ]
    });

    $table.deletable();
  });
</script>
<?= $block->end() ?>
