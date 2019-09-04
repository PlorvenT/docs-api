<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m190902_203830_create_product_table extends Migration
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

        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'guid' => $this->string(50)->notNull(),
            'title' => $this->string(255)->notNull(),
            'h1' => $this->string(255)->notNull(),
            'short_description' => $this->string(255)->notNull(),
            'meta_description' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'pdf_url' => $this->string(255)->notNull(),
            'certificates' => $this->json(),
            'installation_content' => $this->text()->notNull(),
            'features_content' => $this->text()->notNull(),
            'sizes_content' => $this->text()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%product_size}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11)->notNull(),
            'guid' => $this->string(50)->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
            'marking_content' => $this->text()->notNull(),
            'images' => $this->json(),
        ], $tableOptions);

        $this->createIndex('idx_product_size_product_id', '{{%product_size}}', 'product_id');
        $this->addForeignKey(
            'fk-product_size-product',
            '{{%product_size}}',
            'product_id',
            '{{%product}}' ,
            'id',
            ' cascade',
            'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-product_size-product', '{{%product_size}}');
        $this->dropTable('{{%product_size}}');
        $this->dropTable('{{%product}}');
    }
}
