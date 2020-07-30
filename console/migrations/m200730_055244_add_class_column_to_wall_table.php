<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%wall}}`.
 */
class m200730_055244_add_class_column_to_wall_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('wall', 'class', $this->string(80)->comment('связанный класс')
            ->defaultValue('frontend\\\modules\\\user\\\models\\\Profile'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('wall', 'class');
    }
}
