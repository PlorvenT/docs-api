<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m190719_095103_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%client}}', [
            'clientSiteId' => $this->string(50)->notNull(),
            'client1cId' => $this->integer(11)->notNull(),
            'name' => $this->string(50)->notNull(),
            'email' => $this->string(50)->null(),
            'phone' => $this->string(50)->notNull(),
            'companyName' => $this->string(50)->null(),
            'communicateChannel' => $this->string(50)->null(),
        ], $tableOptions);
        $this->addPrimaryKey('pk_site_1c', '{{%client}}', ['clientSiteId', 'client1cId']);

        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'clientSiteId' => $this->string(50)->notNull(),
            'client1cId' => $this->integer(11)->notNull(),
            'status' => $this->string(50)->notNull(),
            'orderedAt' => $this->dateTime()->notNull(),
            'paymentMethod' => $this->string(50)->notNull(),
            'price' => $this->decimal(10,2)->notNull(),
            'extraData' => $this->text(),
        ], $tableOptions);

        $this->createIndex('idx_order_clientSiteId_client1cId', '{{%order}}', ['clientSiteId', 'client1cId']);
        $this->addForeignKey(
            'fk_order_client',
            '{{%order}}',
            ['clientSiteId', 'client1cId'],
            '{{%client}}' ,
            ['clientSiteId', 'client1cId'],
            ' cascade',
            'cascade'
        );

        $this->createTable('{{%order_document}}', [
            'id' => $this->primaryKey(),
            'orderId' => $this->integer(11)->notNull(),
            'name' => $this->string(50)->notNull(),
            'type' => $this->string(50)->notNull(),
            'statusForOrder' => $this->string(50)->notNull(),
            'statusForAct' => $this->string(50)->notNull(),
            'file' => $this->string(255)->notNull(),
        ], $tableOptions);

        $this->createIndex('idx_order_document_orderId', '{{%order_document}}', 'orderId');
        $this->addForeignKey(
            'fk_order_document_order',
            '{{%order_document}}',
            'orderId',
            '{{%order}}',
            'id',
            'cascade',
            'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_order_document_order', '{{%order_document}}');
        $this->dropForeignKey('fk_order_client', '{{%order}}');

        $this->dropTable('{{%order_document}}');
        $this->dropTable('{{%order}}');
        $this->dropTable('{{%client}}');
    }
}
