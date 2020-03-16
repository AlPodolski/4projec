<?php

use yii\db\Migration;

/**
 * Class m200316_121301_add_title_to_advert_table
 */
class m200316_121301_add_title_to_advert_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('advert', 'title', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('advert', 'title');
    }
}
