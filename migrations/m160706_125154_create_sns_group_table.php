<?php

use yii\db\Migration;

/**
 * Handles the creation for table `sns_group_table`.
 */
class m160706_125154_create_sns_group_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('sns_group',
            [
                'id'        => 'pk',
                'url'       => 'string NOT NULL',
                'user_id'   => 'int'
            ]
        );
        
        $this->addForeignKey('sns_group_user_id', 
                'sns_group', 'user_id', 
                'user', 'id', 
                'CASCADE', 'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('sns_group');
    }
}
