<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%presents}}`.
 */
class m200320_062334_add_price_column_to_presents_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('presents', 'price', $this->smallInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('presents', 'price');
    }
}
