<?php

use yii\db\Migration;

/**
 * Class m190912_225351_add_clientCompanyInn_column
 */
class m190912_225351_add_clientCompanyInn_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order', 'clientCompanyInn', $this->string(255)->null());
        $this->addColumn('client', 'companyInn', $this->string(255)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('client', 'companyInn');
        $this->dropColumn('order', 'clientCompanyInn');
    }
}
