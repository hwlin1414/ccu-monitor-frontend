<?php

use yii\db\Migration;

/**
 * Handles the creation of table `GlobalConfig`.
 */
class m161225_102625_create_GlobalConfig_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('GlobalConfig', [
            'key' => $this->string(63)->notNull(),
            'value' => $this->string(255)->notNull(),
            'PRIMARY KEY (`key`)',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('GlobalConfig');
    }
}
