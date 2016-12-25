<?php

use yii\db\Migration;

/**
 * Handles the creation of table `logs`.
 * Has foreign keys to the tables:
 *
 * - `Users`
 */
class m161225_195533_create_Logs_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('Logs', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'ip' => $this->string(15)->notNull(),
            'action' => $this->string(63)->notNull(),
            'description' => $this->string(255)->notNull(),
            'created_at' => $this->timestamp()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-logs-user_id',
            'Logs',
            'user_id'
        );

        // add foreign key for table `Users`
        $this->addForeignKey(
            'fk-logs-user_id',
            'Logs',
            'user_id',
            'Users',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `Users`
        $this->dropForeignKey(
            'fk-logs-user_id',
            'Logs'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-logs-user_id',
            'Logs'
        );

        $this->dropTable('Logs');
    }
}
