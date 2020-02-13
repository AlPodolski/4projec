<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%age}}`.
 */
class m200213_074619_create_age_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%age}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(50),
            'value' => $this->string(50),
        ]);

        $this->execute('INSERT INTO `age` (`id`, `url`, `value`) VALUES
                            (1, \'ot-18-do-20-let\', \'От 18 до 20 лет\'),
                            (2, \'ot-21-do-25-let\', \'От 21 до 25 лет\'),
                            (3, \'ot-26-do-30-let\', \'От 26 до 30 лет\'),
                            (4, \'ot-31-do-35-let\', \'От 31 до 35 лет\'),
                            (5, \'ot-36-do-40-let\', \'от 40 до 50 лет\'),
                            (6, \'ot-41-do-45-let\', \'от 41 до 45 лет\'),
                            (7, \'ot-46-do-50-let\', \'от 46 да 50 лет\'),
                            (8, \'ot-51-do-55-let\', \'от 51 да 55 лет\'),
                            (9, \'starshe-55\', \'Старше 55 лет\');');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%age}}');
    }
}
