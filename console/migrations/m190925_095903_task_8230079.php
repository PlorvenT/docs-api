<?php

use yii\db\Migration;

/**
 * Class m190925_095903_task_8230079
 */
class m190925_095903_task_8230079 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE `product_size` ADD COLUMN `features_content`  text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL AFTER `marking_content`;");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE `product_size` DROP COLUMN `features_content`;");
    }
}
