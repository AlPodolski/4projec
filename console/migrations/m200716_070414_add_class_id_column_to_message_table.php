<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%message}}`.
 */
class m200716_070414_add_class_id_column_to_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('message', 'class', $this->string(75)->comment('связанный класс'));
        $this->addColumn('message', 'related_id', $this->string(75)->comment('связанный ид из таблицы'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('message', 'class');
        $this->dropColumn('message', 'related_id');
    }
}
