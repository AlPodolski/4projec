<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_sfera_deyatelnosti}}`.
 */
class m200311_074056_create_user_sfera_deyatelnosti_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_sfera_deyatelnosti}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->smallInteger(),
            'city_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_sfera_deyatelnosti}}');
    }
}
