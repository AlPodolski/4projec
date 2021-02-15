<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%photo}}`.
 */
class m210215_115406_add_status_column_to_photo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('photo', 'status', $this->tinyInteger()
            ->unsigned()->comment('0 статус по умолчению 1 фото скрыто')
            ->defaultValue(0)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('photo', 'status');
    }
}
