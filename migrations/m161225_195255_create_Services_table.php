<?php

use yii\db\Migration;

/**
 * Handles the creation of table `services`.
 * Has foreign keys to the tables:
 *
 * - `Hosts`
 * - `Users`
 */
class m161225_195255_create_Services_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('Services', [
            'id' => $this->primaryKey(),
            'host_id' => $this->integer()->notNull(),
            'type' => $this->string(15)->notNull(),
            'port' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'deleted_at' => $this->timestamp()->defaultValue(null),
        ]);

        // creates index for column `host_id`
        $this->createIndex(
            'idx-services-host_id',
            'Services',
            'host_id'
        );

        // add foreign key for table `Hosts`
        $this->addForeignKey(
            'fk-services-host_id',
            'Services',
            'host_id',
            'Hosts',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-services-user_id',
            'Services',
            'user_id'
        );

        // add foreign key for table `Users`
        $this->addForeignKey(
            'fk-services-user_id',
            'Services',
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
        // drops foreign key for table `Hosts`
        $this->dropForeignKey(
            'fk-services-host_id',
            'Services'
        );

        // drops index for column `host_id`
        $this->dropIndex(
            'idx-services-host_id',
            'Services'
        );

        // drops foreign key for table `Users`
        $this->dropForeignKey(
            'fk-services-user_id',
            'Services'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-services-user_id',
            'Services'
        );

        $this->dropTable('Services');
    }
}
