<?php

namespace Miaoxing\Faq\Metadata;

/**
 * FaqTrait
 *
 * @property int $id
 * @property int $appId
 * @property string $question
 * @property string $answer
 * @property int $views 查看次数
 * @property string $createdAt
 * @property string $updatedAt
 * @property int $createdBy
 * @property int $updatedBy
 * @property string $deletedAt
 * @property int $deletedBy
 */
trait FaqTrait
{
    /**
     * @var array
     * @see CastTrait::$casts
     */
    protected $casts = [
        'id' => 'int',
        'app_id' => 'int',
        'question' => 'string',
        'answer' => 'string',
        'views' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'created_by' => 'int',
        'updated_by' => 'int',
        'deleted_at' => 'datetime',
        'deleted_by' => 'int',
    ];
}
