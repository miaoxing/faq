<?php

namespace Miaoxing\Faq\Controller\Admin;

use Miaoxing\Faq\Service\FaqRecord;
use miaoxing\plugin\BaseController;

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
                $faqs = wei()->faq()->curApp();

                $faqs
                    ->notDeleted()
                    ->limit($req['rows'])
                    ->page($req['page']);

                // 排序
                $sort = $req['sort'] ?: 'id';
                $order = $req['order'] == 'asc' ? 'ASC' : 'DESC';
                $faqs->orderBy($sort, $order);

                $faqs->findAll();

                // 数据
                $data = [];
                /** @var FaqRecord $faq */
                foreach ($faqs as $faq) {
                    $data[] = $faq->toArray() + [
                        ];
                }

                return $this->suc([
                    'data' => $data,
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
        $faq = wei()->faq()->curApp()->notDeleted()->findId($req['id']);

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
            ]
        ]);
        if (!$validator->isValid()) {
            return $this->err($validator->getFirstMessage());
        }

        $faq = wei()->faq()->curApp()->notDeleted()->findId($req['id']);

        $faq->save($req);

        return $this->suc();
    }

    public function destroyAction($req)
    {
        $faq = wei()->faq()->curApp()->notDeleted()->findOneById($req['id']);

        $faq->softDelete();

        return $this->suc();
    }
}
