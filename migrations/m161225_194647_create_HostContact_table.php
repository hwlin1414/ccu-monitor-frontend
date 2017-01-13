<?php

use yii\db\Migration;

/**
 * Handles the creation of table `hostcontact`.
 * Has foreign keys to the tables:
 *
 * - `Hosts`
 * - `Contacts`
 */
class m161225_194647_create_HostContact_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('HostContact', [
            'id' => $this->primaryKey(),
            'host_id' => $this->integer()->notNull(),
            'contact_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'deleted_at' => $this->timestamp()->defaultValue(null),
        ]);

        // creates index for column `host_id`
        $this->createIndex(
            'idx-hostcontact-host_id',
            'HostContact',
            'host_id'
        );

        // add foreign key for table `Hosts`
        $this->addForeignKey(
            'fk-hostcontact-host_id',
            'HostContact',
            'host_id',
            'Hosts',
            'id',
            'CASCADE'
        );

        // creates index for column `contact_id`
        $this->createIndex(
            'idx-hostcontact-contact_id',
            'HostContact',
            'contact_id'
        );

        // add foreign key for table `Contacts`
        $this->addForeignKey(
            'fk-hostcontact-contact_id',
            'HostContact',
            'contact_id',
            'Contacts',
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
            'fk-hostcontact-host_id',
            'HostContact'
        );

        // drops index for column `host_id`
        $this->dropIndex(
            'idx-hostcontact-host_id',
            'HostContact'
        );

        // drops foreign key for table `Contacts`
        $this->dropForeignKey(
            'fk-hostcontact-contact_id',
            'HostContact'
        );

        // drops index for column `contact_id`
        $this->dropIndex(
            'idx-hostcontact-contact_id',
            'HostContact'
        );

        $this->dropTable('HostContact');
    }
}
