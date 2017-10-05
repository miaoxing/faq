<?php

$view->layout();
?>

<?= $block('css') ?>
<link rel="stylesheet" href="<?= $asset('plugins/faq/css/faqs.css') ?>">
<?= $block->end() ?>

<form class="search-form" action="" method="get">
  <div class="border-all border-radius">
    <input class="search-input" name="q" value="<?= $e($req['q']) ?>" type="text" placeholder="请输入问题或答案搜索">
  </div>
  <button class="search-submit">
    <i class="text-muted ni ni-search"></i>
  </button>
</form>

<ul class="js-faq-list list list-indented">
</ul>

<script type="text/html" class="js-faq-item-tpl">
  <li class="js-faq-item">
    <a href="javascript:;" class="js-faq-link list-item has-feedback" data-id="<%= id %>">
      <h4 class="list-heading"><%= question %></h4>
      <i class="js-faq-angel bm-angle-right list-feedback"></i>
    </a>
    <div class="js-faq-answer list-body p-b p-r text-normal display-none">
      <%== answer %>
    </div>
  </li>
</script>

<?= $block('js') ?>
<script>
  require(['comps/artTemplate/template.min'], function () {
    template.helper('$', $);

    var $list = $('.js-faq-list').list({
      url: '<?= $url->query('faqs.json') ?>',
      template: template.compile($('.js-faq-item-tpl').html()),
      localData: <?= json_encode($ret) ?>
    });

    $list.on('click', '.js-faq-link', function () {
      var $item = $(this).closest('.js-faq-item');
      $item.find('.js-faq-angel').toggleClass('answer-open');

      var $answer =  $item.find('.js-faq-answer');
      $answer.toggle();
      if ($answer.is(':visible')) {
        $.post($.url('faqs/%s/view.json', $(this).data('id')));
      }
    });
  });
</script>
<?= $block->end() ?>
