<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_heart}}`.
 */
class m200904_072436_create_user_heart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_heart}}', [
            'id' => $this->primaryKey(),
            'who' => $this->integer()->unsigned()->comment('Кто занял сердце'),
            'whom' => $this->integer()->unsigned()->comment('Чье сердце занято'),
            'timestamp' => $this->integer()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_heart}}');
    }
}
