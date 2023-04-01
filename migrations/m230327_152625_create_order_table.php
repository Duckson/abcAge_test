<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m230327_152625_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'good_id' => $this->integer()->notNull(),
            'count' => $this->integer()->notNull(),
            'date' => $this->date()->notNull()
        ]);
        $this->addForeignKey('order_good_id', '{{%order}}', 'good_id', '{{%good}}', 'id', 'CASCADE');

        for ($i = 1; $i <= 15; $i++){
            $this->insert('{{%order}}', [
                'good_id' => 3,
                'count' => round(pow((sqrt(5)+1)/2, $i) / sqrt(5)),
                'date' => date("Y-m-d",strtotime("+$i day", strtotime("2021-01-12")))
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('order_good_id', '{{%order}}');
        $this->dropTable('{{%order}}');
    }
}
