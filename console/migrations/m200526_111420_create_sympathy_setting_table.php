<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sympathy_setting}}`.
 */
class m200526_111420_create_sympathy_setting_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sympathy_setting}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'pol_id' => $this->smallInteger()->comment('ид пола который ищет пользователь'),
            'age_from' => $this->smallInteger()->comment('с какого возраста  ищет пользователь'),
            'age_to' => $this->smallInteger()->comment('до какого возраста ищет пользователь'),
        ]);

        $this->addForeignKey('fk-sympathy_setting-user_id-user-id', 'sympathy_setting', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sympathy_setting}}');
    }
}
