<?php

namespace Miaoxing\Faq\Service;

use Miaoxing\Plugin\BaseService;

class Faq extends BaseService
{
    public function __invoke()
    {
        return wei()->faqRecord();
    }
}
