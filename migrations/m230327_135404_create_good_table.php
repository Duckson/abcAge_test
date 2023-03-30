<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%good}}`.
 */
class m230327_135404_create_good_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%good}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)
        ]);
        $this->insert('{{%good}}', ['name' => 'Колбаса',]);
        $this->insert('{{%good}}', ['name' => 'Пармезан',]);
        $this->insert('{{%good}}', ['name' => 'Левый носок',]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%good}}');
    }
}
