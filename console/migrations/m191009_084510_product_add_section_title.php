<?php

use yii\db\Migration;

/**
 * Class m191009_084510_product_add_section_title
 */
class m191009_084510_product_add_section_title extends Migration {
	public $mainTable = '{{%product}}';

	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {
		$this->addColumn($this->mainTable, 'section_title', $this->string(255)->notNull()->after('title'));
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->dropColumn($this->mainTable, 'section_title');
	}
}
