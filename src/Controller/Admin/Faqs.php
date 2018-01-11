<?php

namespace Miaoxing\Faq\Controller\Admin;

use Miaoxing\Admin\Action\CrudTrait;
use Miaoxing\Plugin\BaseController;

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

    protected function beforeSave($req)
    {
        $validator = wei()->validate([
            'data' => $req,
            'rules' => [
                'question' => [],
                'answer' => [],
            ],
            'names' => [
                'question' => '问题',
                'answer' => '答案',
            ],
        ]);
        if (!$validator->isValid()) {
            return $this->err($validator->getFirstMessage());
        }

        return $this->suc();
    }
}
