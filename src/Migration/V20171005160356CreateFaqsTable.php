<?php

namespace Miaoxing\Faq\Migration;

use Miaoxing\Plugin\BaseMigration;

class V20171005160356CreateFaqsTable extends BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->schema->table('faqs')
            ->id()
            ->int('app_id')
            ->string('question')
            ->mediumText('answer')
            ->int('views')->comment('查看次数')
            ->timestamps()
            ->userstamps()
            ->softDeletable()
            ->exec();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->schema->dropIfExists('faqs');
    }
}
