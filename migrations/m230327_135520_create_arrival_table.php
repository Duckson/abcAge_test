<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%arrival}}`.
 */
class m230327_135520_create_arrival_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%arrival}}', [
            'id' => $this->primaryKey(),
            'number' => $this->string(50),
            'good_id' => $this->integer()->notNull(),
            'count' => $this->integer()->notNull(),
            'price' => $this->integer()->notNull(),
            'date' => $this->date()->notNull()
        ]);
        $this->addForeignKey('arrival_good_id', '{{%arrival}}', 'good_id', '{{%good}}', 'id', 'CASCADE');

        $this->insert('{{%arrival}}', [
            'number' => '1',
            'good_id' => 1,
            'count' => 300,
            'price' => 5000,
            'date' => '2021-01-01'
        ]);
        $this->insert('{{%arrival}}', [
            'number' => 't-500',
            'good_id' => 2,
            'count' => 10,
            'price' => 6000,
            'date' => '2021-01-02'
        ]);
        $this->insert('{{%arrival}}', [
            'number' => '12-TP-777',
            'good_id' => 3,
            'count' => 100,
            'price' => 500,
            'date' => '2021-01-13'
        ]);
        $this->insert('{{%arrival}}', [
            'number' => '12-TP-778',
            'good_id' => 3,
            'count' => 50,
            'price' => 300,
            'date' => '2021-01-14'
        ]);
        $this->insert('{{%arrival}}', [
            'number' => '12-TP-779',
            'good_id' => 3,
            'count' => 77,
            'price' => 539,
            'date' => '2021-01-20'
        ]);
        $this->insert('{{%arrival}}', [
            'number' => '12-TP-877',
            'good_id' => 3,
            'count' => 32,
            'price' => 176,
            'date' => '2021-01-30'
        ]);
        $this->insert('{{%arrival}}', [
            'number' => '12-TP-977',
            'good_id' => 3,
            'count' => 94,
            'price' => 554,
            'date' => '2021-02-01'
        ]);
        $this->insert('{{%arrival}}', [
            'number' => '12-TP-979',
            'good_id' => 3,
            'count' => 200,
            'price' => 1000,
            'date' => '2021-02-05'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('arrival_good_id', '{{%arrival}}');
        $this->dropTable('{{%arrival}}');
    }
}
