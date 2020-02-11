<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%eye_color}}`.
 */
class m200211_071407_create_eye_color_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%eye_color}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(50),
        ]);

        $this->insert('eye_color', ['value' => 'синий' ]);
        $this->insert('eye_color', ['value' => 'голубой' ]);
        $this->insert('eye_color', ['value' => 'серый' ]);
        $this->insert('eye_color', ['value' => 'зеленый' ]);
        $this->insert('eye_color', ['value' => 'янтарный' ]);
        $this->insert('eye_color', ['value' => 'болотный' ]);
        $this->insert('eye_color', ['value' => 'карий' ]);
        $this->insert('eye_color', ['value' => 'черный' ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%eye_color}}');
    }
}
