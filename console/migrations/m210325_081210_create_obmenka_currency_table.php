<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%obmenka_currency}}`.
 */
class m210325_081210_create_obmenka_currency_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%obmenka_currency}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(25),
            'value' => $this->string(25),
        ]);

        $this->execute('INSERT INTO `obmenka_currency` ( `name` , `value` ) VALUES ("QIWI" , "qiwi")');
        $this->execute('INSERT INTO `obmenka_currency` ( `name` , `value` ) VALUES ("Visa/Master" , "visamaster.rur")');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%obmenka_currency}}');
    }
}
