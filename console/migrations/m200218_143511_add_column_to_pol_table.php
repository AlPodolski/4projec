<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%pol}}`.
 */
class m200218_143511_add_column_to_pol_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pol', 'url', $this->string(50));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('pol', 'url');
    }
}
