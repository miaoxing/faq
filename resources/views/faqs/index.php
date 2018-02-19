<?php

$view->layout();
$wei->page->addPluginAsset();
?>

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
