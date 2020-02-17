<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rayon}}`.
 */
class m200217_091103_create_rayon_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rayon}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(50),
            'value' => $this->string(50),
            'city' => $this->string(50),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rayon}}');
    }
}
