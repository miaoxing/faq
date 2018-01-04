<?php

namespace Miaoxing\Faq\Controller;

use Miaoxing\Plugin\BaseController;

class Faqs extends BaseController
{
    public function indexAction($req)
    {
        $rows = 10;
        $page = $req['page'] > 0 ? (int) $req['page'] : 1;

        $faqs = wei()->faq()
            ->curApp()
            ->notDeleted()
            ->desc('views')
            ->desc('id');

        $faqs->limit($rows)->page($page);

        if ($req['q']) {
            $searchValue = '%' . str_replace(['%', '_'], ['/%', '/_'], $req['q']) . '%';
            $faqs->andWhere('question LIKE ? ESCAPE "/" OR answer LIKE ? ESCAPE "/"', [$searchValue, $searchValue]);
        }

        $faqs->findAll();

        $data = [];
        foreach ($faqs as $faq) {
            $data[] = $faq->toArray();
        }

        $ret = [
            'data' => $data,
            'page' => $page,
            'rows' => $rows,
            'records' => $faqs->count(),
        ];

        switch ($req['_format']) {
            case 'json':
                return $this->suc($ret);

            default:

                return get_defined_vars();
        }
    }

    public function viewAction($req)
    {
        $faq = wei()->faq()
            ->curApp()
            ->notDeleted()
            ->findOneById($req['id']);

        $faq->incr('views', 1)->save();

        return $this->suc();
    }
}
