<?php

use yii\db\Migration;

/**
 * Class m200228_142656_alter_hair_color_table
 */
class m200228_142656_alter_hair_color_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('hair_color', 'url', $this->string(50));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('hair_color', 'url');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200228_142656_alter_hair_color_table cannot be reverted.\n";

        return false;
    }
    */
}
