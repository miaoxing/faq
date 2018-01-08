<?php

namespace Miaoxing\Faq\Controller\Admin;

use Miaoxing\Faq\Service\FaqModel;
use Miaoxing\Plugin\BaseController;

class Faqs extends BaseController
{
    protected $controllerName = '常见问题管理';

    protected $actionPermissions = [
        'index' => '列表',
        'new,create' => '创建',
        'edit,update' => '编辑',
        'destroy' => '删除',
    ];

    protected $displayPageHeader = true;

    public function indexAction($req)
    {
        switch ($req['_format']) {
            case 'json':
                $faqs = wei()->faqModel()
                    ->limit($req['rows'])
                    ->page($req['page'])
                    ->setQueryParams($req)
                    ->sort();

                $faqs->findAll();

                return $this->suc([
                    'data' => $faqs,
                    'page' => (int) $req['page'],
                    'rows' => (int) $req['rows'],
                    'records' => $faqs->count(),
                ]);

            default:
                return get_defined_vars();
        }
    }

    public function newAction($req)
    {
        return $this->editAction($req);
    }

    public function editAction($req)
    {
        $faq = wei()->faqModel()->findId($req['id']);

        return get_defined_vars();
    }

    public function updateAction($req)
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

        $faq = wei()->faqModel()->findId($req['id']);

        $faq->save($req);

        return $this->suc();
    }

    public function destroyAction($req)
    {
        $faq = wei()->faqModel()->findOneById($req['id']);

        $faq->destroy();

        return $this->suc();
    }
}
