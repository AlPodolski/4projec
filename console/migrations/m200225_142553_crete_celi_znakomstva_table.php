<?php

use yii\db\Migration;

/**
 * Class m200225_142553_crete_celi_znakomstva_table
 */
class m200225_142553_crete_celi_znakomstva_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%celi_znakomstvamstva}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(50),
            'url' => $this->string(50),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%celi_znakomstvamstva}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200225_142553_crete_celi_znakomstva_table cannot be reverted.\n";

        return false;
    }
    */
}
