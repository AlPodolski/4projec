<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%uniqe_index_from_username_user}}`.
 */
class m200218_093847_drop_uniqe_index_from_username_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropIndex('username', 'user' );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }
}
