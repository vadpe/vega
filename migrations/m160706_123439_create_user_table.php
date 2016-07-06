<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user_table`.
 */
class m160706_123439_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user',
            [
                'id'        => 'pk',
                'password'  => 'string NOT NULL',
                'email'     => 'string NOT NULL'
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
