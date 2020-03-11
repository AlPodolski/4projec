<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%zhile}}`.
 */
class m200311_081917_create_zhile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%zhile}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(50),
            'url' => $this->string(50),
        ]);

        $this->execute("INSERT INTO `zhile` (`value`, `url`) VALUES
                        ( 'своя квартира', 'svoya-kvartira'),
                        ( 'свой дом', 'svoj-dom'),
                        ( 'снимаю квартиру', 'snimayu-kvartiru'),
                        ( 'общежитие', 'obshchezhitie'),
                        ( 'живу с родителями', 'zhivu-s-roditelyami'),
                        ( 'живу с приятелем/подругой', 'zhivu-s-priyatelem-podrugoj'),
                        ( 'нет постоянного жилья', 'net-postoyannogo-zhilya');");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%zhile}}');
    }
}
