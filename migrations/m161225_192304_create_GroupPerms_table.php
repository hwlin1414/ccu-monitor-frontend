<?php

use yii\db\Migration;

/**
 * Handles the creation of table `groupperms`.
 * Has foreign keys to the tables:
 *
 * - `Groups`
 */
class m161225_192304_create_GroupPerms_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('GroupPerms', [
            'group_id' => $this->integer()->notNull(),
            'perm' => $this->string(255)->notNull(),
            'PRIMARY KEY(group_id, perm)',
        ]);

        // creates index for column `group_id`
        $this->createIndex(
            'idx-groupperms-group_id',
            'GroupPerms',
            'group_id'
        );

        // add foreign key for table `Groups`
        $this->addForeignKey(
            'fk-groupperms-group_id',
            'GroupPerms',
            'group_id',
            'Groups',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `Groups`
        $this->dropForeignKey(
            'fk-groupperms-group_id',
            'GroupPerms'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            'idx-groupperms-group_id',
            'GroupPerms'
        );

        $this->dropTable('GroupPerms');
    }
}
