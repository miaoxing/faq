<?php

namespace Miaoxing\Faq\Service;

use Miaoxing\Faq\Metadata\FaqTrait;
use Miaoxing\Plugin\BaseModelV2;
use Miaoxing\Plugin\Model\HasAppIdTrait;
use Miaoxing\Plugin\Model\SoftDeleteTrait;

class FaqModel extends BaseModelV2
{
    use HasAppIdTrait;
    use SoftDeleteTrait;
    use FaqTrait;
}
