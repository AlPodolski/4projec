<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hair_color}}`.
 */
class m200210_151737_create_hair_color_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hair_color}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(100),
            'pol' => $this->tinyInteger(),
        ]);


        $this->insert('hair_color', ['value' => 'Блондинка', 'pol' => 2]);
        $this->insert('hair_color', ['value' => 'Брюнетка', 'pol' => 2]);

        $this->insert('hair_color', ['value' => 'Брюнет', 'pol' => 1]);
        $this->insert('hair_color', ['value' => 'Блондин', 'pol' => 1]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%hair_color}}');
    }
}
