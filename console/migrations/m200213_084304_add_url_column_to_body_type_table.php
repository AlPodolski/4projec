<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%body_type}}`.
 */
class m200213_084304_add_url_column_to_body_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('body_type', 'url', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('body_type','url' );
    }
}
