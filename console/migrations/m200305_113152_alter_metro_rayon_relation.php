<?php

use yii\db\Migration;

/**
 * Class m200305_113152_alter_metro_rayon_relation
 */
class m200305_113152_alter_metro_rayon_relation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('metro', 'city');
        $this->dropColumn('rayon', 'city');

        $this->addColumn('metro', 'city_id', $this->smallInteger() );
        $this->addColumn('rayon', 'city_id', $this->smallInteger() );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->addColumn('metro', 'city', $this->string(40) );
       $this->addColumn('rayon', 'city', $this->string(40) );

        $this->dropColumn('metro', 'city_id');
        $this->dropColumn('rayon', 'city_id');
    }

}
