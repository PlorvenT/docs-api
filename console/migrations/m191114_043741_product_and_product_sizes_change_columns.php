<?php

use yii\db\Migration;

/**
 * Class m191114_043741_product_and_product_sizes_change_columns
 */
class m191114_043741_product_and_product_sizes_change_columns extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {
		$this->addColumn('{{%product}}', 'marking_content', $this->text()->null()->defaultValue(null));
		$this->addColumn('{{%product}}', 'pickup_modal_content', $this->text()->null()->defaultValue(null));

		$this->dropColumn('{{%product}}', 'features_content');
		$this->dropColumn('{{%product}}', 'sizes_content');

		$this->alterColumn('{{%product_size}}', 'features_content', $this->text()->null()->defaultValue(null));
		$this->dropColumn('{{%product_size}}', 'marking_content');
		$this->addColumn('{{%product_size}}', 'sizes_content', $this->text()->null()->defaultValue(null));
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->dropColumn('{{%product}}', 'marking_content');
		$this->dropColumn('{{%product}}', 'pickup_modal_content');

		$this->addColumn('{{%product}}', 'features_content', $this->text()->notNull());
		$this->addColumn('{{%product}}', 'sizes_content', $this->text()->notNull());

		$this->alterColumn('{{%product_size}}', 'features_content', $this->text()->null()->defaultValue(null));
		$this->addColumn('{{%product_size}}', 'marking_content', $this->text()->notNull());
		$this->dropColumn('{{%product_size}}', 'sizes_content');
	}
}
