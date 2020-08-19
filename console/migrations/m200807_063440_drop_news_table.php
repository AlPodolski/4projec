<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%news}}`.
 */
class m200807_063440_drop_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%news}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
        ]);
    }
}
