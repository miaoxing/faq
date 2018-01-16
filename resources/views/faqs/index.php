<?php

$view->layout();
?>

<?= $block('css') ?>
<link rel="stylesheet" href="<?= $wei->fAsset('faq.css') ?>">
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
      <%= answer %>
    </div>
  </li>
</script>

<?= $block('js') ?>
<script src="<?= $wei->fAsset('faq-manifest.js') ?>"></script>
<script src="<?= $wei->fAsset('faq.js') ?>"></script>
<?= $block->end() ?>
