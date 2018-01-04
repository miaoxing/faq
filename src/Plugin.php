<?php

namespace Miaoxing\Faq;

use Miaoxing\Plugin\BasePlugin;

class Plugin extends BasePlugin
{
    /**
     * {@inheritdoc}
     */
    protected $name = 'FAQ';

    /**
     * {@inheritdoc}
     */
    protected $description = '用于录入常见问题';

    protected $adminNavId = 'settings';

    public function onAdminNavGetNavs(&$navs, &$categories, &$subCategories)
    {
        $navs[] = [
            'parentId' => 'settings',
            'url' => 'admin/faqs',
            'name' => '常见问题管理',
            'sort' => -100,
        ];
    }

    public function onLinkToGetLinks(&$links, &$types)
    {
        $types['faq'] = [
            'name' => '常见问题',
        ];

        $links[] = [
            'typeId' => 'faq',
            'name' => '常见问题列表',
            'url' => 'faqs',
        ];
    }
}
