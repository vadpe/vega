<?php

use yii\db\Migration;

/**
 * Handles the dropping for table `sns_group_table`.
 */
class m160706_131128_drop_sns_group_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropTable('sns_group');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo 'm160706_131128_drop_sns_group_table cannot be reverted.\n';
        
        return false;
    }
}
