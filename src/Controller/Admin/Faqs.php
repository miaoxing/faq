<?php

namespace Miaoxing\Faq\Controller\Admin;

use Miaoxing\Admin\Action\CrudTrait;
use Miaoxing\Plugin\BaseController;
use Miaoxing\Plugin\Service\Request;

class Faqs extends BaseController
{
    use CrudTrait;

    protected $controllerName = '常见问题管理';

    protected $actionPermissions = [
        'index' => '列表',
        'new,create' => '创建',
        'edit,update' => '编辑',
        'destroy' => '删除',
    ];

    protected $displayPageHeader = true;

    protected function beforeSave(Request $req)
    {
        $ret = wei()->v()
            ->key('question', '问题')
            ->key('answer', '答案')
            ->check($req);

        return $ret;
    }
}
