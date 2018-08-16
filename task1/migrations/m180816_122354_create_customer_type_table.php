<?php

use yii\db\Migration;

/**
 * Handles the creation of table `customer_type`.
 * Has foreign keys to the tables:
 *
 * - `customer`
 */
class m180816_122354_create_customer_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('customer_type', [
            'id' => $this->primaryKey(),
            'customerId' => $this->integer()->notNull(),
            'customerType' => $this->integer(),
            'inn' => $this->string(255),
            'companyName' => $this->string(255)->notNull(),
        ]);

        // creates index for column `customerId`
        $this->createIndex(
            'idx-customer_type-customerId',
            'customer_type',
            'customerId'
        );

        // add foreign key for table `customer`
        $this->addForeignKey(
            'fk-customer_type-customerId',
            'customer_type',
            'customerId',
            'customer',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `customer`
        $this->dropForeignKey(
            'fk-customer_type-customerId',
            'customer_type'
        );

        // drops index for column `customerId`
        $this->dropIndex(
            'idx-customer_type-customerId',
            'customer_type'
        );

        $this->dropTable('customer_type');
    }
}
