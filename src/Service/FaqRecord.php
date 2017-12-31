<?php

namespace Miaoxing\Faq\Service;

use miaoxing\plugin\BaseModel;
use Miaoxing\Plugin\Model\CamelCaseTrait;

class FaqRecord extends BaseModel
{
    use CamelCaseTrait;

    protected $table = 'faqs';

    protected $providers = [
        'db' => 'app.db',
    ];

    protected $appIdColumn = 'app_id';

    protected $createdAtColumn = 'created_at';

    protected $updatedAtColumn = 'updated_at';

    protected $createdByColumn = 'created_by';

    protected $updatedByColumn = 'updated_by';

    protected $deletedAtColumn = 'deleted_at';

    protected $deletedByColumn = 'deleted_by';
}
