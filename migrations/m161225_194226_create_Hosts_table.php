<?php

use yii\db\Migration;

/**
 * Handles the creation of table `hosts`.
 * Has foreign keys to the tables:
 *
 * - `Users`
 */
class m161225_194226_create_Hosts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('Hosts', [
            'id' => $this->primaryKey(),
            'hostname' => $this->string(63)->notNull(),
            'description' => $this->string(255)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'deleted_at' => $this->timestamp()->defaultValue(null),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-hosts-user_id',
            'Hosts',
            'user_id'
        );

        // add foreign key for table `Users`
        $this->addForeignKey(
            'fk-hosts-user_id',
            'Hosts',
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
            'fk-hosts-user_id',
            'Hosts'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-hosts-user_id',
            'Hosts'
        );

        $this->dropTable('Hosts');
    }
}
