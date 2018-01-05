<?php

namespace Miaoxing\Faq\Controller;

use Miaoxing\Plugin\BaseController;

class Faqs extends BaseController
{
    public function indexAction($req)
    {
        $rows = 10;
        $page = $req['page'] > 0 ? (int) $req['page'] : 1;

        $faqs = wei()->faqModel()
            ->desc('views')
            ->desc('id')
            ->limit($rows)
            ->page($page);

        if ($req['q']) {
            $searchValue = '%' . str_replace(['%', '_'], ['/%', '/_'], $req['q']) . '%';
            $faqs->andWhere('question LIKE ? ESCAPE "/" OR answer LIKE ? ESCAPE "/"', [$searchValue, $searchValue]);
        }

        $faqs->findAll();

        $ret = [
            'data' => $faqs,
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
        $faq = wei()->faqModel()->findOneById($req['id']);

        $faq->incr('views', 1)->save();

        return $this->suc();
    }
}
