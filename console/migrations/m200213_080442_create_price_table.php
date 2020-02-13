<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%price}}`.
 */
class m200213_080442_create_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%price}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(50),
            'value' => $this->string(50),
        ]);
        $this->execute('INSERT INTO `price` (`id`, `url`, `value`) VALUES
                            (1, \'do-1500\', \'До 1500\'),
                            (2, \'ot-1500-do-2000\', \'От 1500 до 2000\'),
                            (3, \'ot-2000-do-3000\', \'От 2000 до 3000\'),
                            (4, \'ot-3000-do-6000\', \'От 3000 до 6000\'),
                            (5, \'ot-6000\', \'От 6000\');');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%price}}');
    }
}
