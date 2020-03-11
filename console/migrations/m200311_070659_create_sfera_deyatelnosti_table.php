<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sfera_deyatelnosti}}`.
 */
class m200311_070659_create_sfera_deyatelnosti_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sfera_deyatelnosti}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(50),
            'url' => $this->string(50),
        ]);

        $this->execute('INSERT INTO `sfera_deyatelnosti` ( `value`, `url`) VALUES
                        ( \'благоустройство\', \'blagoustrojstvo\'),
                        ( \'вооруженные силы\', \'vooruzhennye-sily\'),
                        ( \'госуправление\', \'gosupravlenie\'),
                        ( \'журналистика\', \'zhurnalistika\'),
                        ( \'закон и правопорядок\', \'zakon-i-pravoporyadok\'),
                        ( \'здравоохранение\', \'zdravoohranenie\'),
                        ( \'издательство\', \'izdatelstvo\'),
                        ( \'информатика\', \'informatika\'),
                        ( \'лесное хозяйство\', \'lesnoe-hozyajstvo\'),
                        ( \'наука\', \'nauka\'),
                        ( \'образование и культура\', \'obrazovanie-i-kultura\'),
                        ( \'общественное питание\', \'obshchestvennoe-pitanie\'),
                        ( \'предпринимательство\', \'predprinimatelstvo\'),
                        ( \'промышленность\', \'promyshlennost\'),
                        ( \'связь\', \'svyaz\'),
                        ( \'сельское хозяйство\', \'selskoe-hozyajstvo\'),
                        ( \'социальная\', \'socialnaya\'),
                        ( \'спорт и туризм\', \'sport-i-turizm\'),
                        ( \'строительство\', \'stroitelstvo\'),
                        ( \'творчество\', \'tvorchestvo\'),
                        ( \'торговля\', \'torgovlya\'),
                        ( \'транспорт\', \'transport\'),
                        ( \'услуги населению\', \'uslugi-naseleniyu\'),
                        ( \'финансы\', \'finansy\'),
                        ( \'экономика\', \'ehkonomika\'),
                        ( \'юриспруденция\', \'yurisprudenciya\');');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sfera_deyatelnosti}}');
    }
}
