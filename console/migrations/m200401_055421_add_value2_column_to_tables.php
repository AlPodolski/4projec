<?php

use yii\db\Migration;

/**
 * Class m200401_055421_add_value2_column_to_tables
 */
class m200401_055421_add_value2_column_to_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $params = \common\models\FilterParams::find()->asArray()->all();

        foreach ($params as $param){

            if (isset($param['class_name'])){

                $table = $param['class_name']::tableName();

                $this->addColumn($table, 'value2', $this->string());
                $this->addColumn($table, 'value3', $this->string());

            }

        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $params = \common\models\FilterParams::find()->asArray()->all();

        foreach ($params as $param){

            if (isset($param['class_name'])){

                $table = $param['class_name']::tableName();

                $this->dropColumn($table, 'value2');
                $this->dropColumn($table, 'value3');

            }

        }
    }
}
