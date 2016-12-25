<?php

use yii\db\Migration;

/**
 * Handles the creation of table `groups`.
 */
class m161225_104418_create_Groups_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('Groups', [
            'id' => $this->primaryKey(),
            'name' => $this->string(63)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('Groups');
    }
}
