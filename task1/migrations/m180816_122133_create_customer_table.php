<?php

use yii\db\Migration;

/**
 * Handles the creation of table `customer`.
 */
class m180816_122133_create_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('customer', [
            'id' => $this->primaryKey(),
            'firstName' => $this->string(255)->notNull(),
            'secondName' => $this->string(255)->notNull(),
            'lastName' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('customer');
    }
}
