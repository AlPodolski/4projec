<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transport}}`.
 */
class m200311_091324_create_transport_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transport}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(50),
            'url' => $this->string(50),
        ]);

        $this->execute("INSERT INTO `transport` ( `value`, `url`) VALUES
                        ( 'есть автомобиль', 'est-avtomobil'),
                        ( 'есть мотоцикл', 'est-motocikl'),
                        ( 'отсутствует', 'otsutstvuet');");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%transport}}');
    }
}
