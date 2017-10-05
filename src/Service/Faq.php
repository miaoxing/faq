<?php

namespace Miaoxing\Faq\Service;

use miaoxing\plugin\BaseService;

class Faq extends BaseService
{
    public function __invoke()
    {
        return wei()->faqRecord();
    }
}
