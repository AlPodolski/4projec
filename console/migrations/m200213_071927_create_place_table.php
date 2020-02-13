<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%place}}`.
 */
class m200213_071927_create_place_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%place}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(50),
            'url' => $this->string(50),
        ]);
        $this->execute('INSERT INTO `place` (`id`, `url`, `value`) VALUES
                                (1, \'appartamentu\', \'в апартаментах\'),
                                (2, \'viezd\', \'на  выезде\'),
                                (3, \'v-mashine\', \'В машине\'),
                                (4, \'v-sayne\', \'В сауне\'),
                                (5, \'na-domu\', \'На дому\'),
                                (6, \'v-klube\', \'В клубе\'),
                                (7, \'po-vizovu\', \'По вызову\'),
                                (8, \'na-doroge\', \'На дорогах\');
                                ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%place}}');
    }
}
