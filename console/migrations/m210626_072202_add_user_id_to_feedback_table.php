<?php

use yii\db\Migration;

/**
 * Class m210626_072202_add_user_id_to_feedback_table
 */
class m210626_072202_add_user_id_to_feedback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('feedback', 'user_id', $this->integer()
            ->comment('id пользователя который оставил обращение'));

        $this->addForeignKey('fk_feedback_user_id_to_user_id', 'feedback' , 'user_id',
        'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('feedback', 'user_id');
    }

}
