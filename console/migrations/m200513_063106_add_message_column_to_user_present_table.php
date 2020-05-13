<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user_present}}`.
 */
class m200513_063106_add_message_column_to_user_present_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user_presents', 'message', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user_presents', 'message');
    }
}
