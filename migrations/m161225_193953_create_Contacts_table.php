<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contacts`.
 * Has foreign keys to the tables:
 *
 * - `Users`
 */
class m161225_193953_create_Contacts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('Contacts', [
            'id' => $this->primaryKey(),
            'addr' => $this->string(63)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'verified' => $this->string(15),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp(),
            'deleted_at' => $this->timestamp(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-contacts-user_id',
            'Contacts',
            'user_id'
        );

        // add foreign key for table `Users`
        $this->addForeignKey(
            'fk-contacts-user_id',
            'Contacts',
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
            'fk-contacts-user_id',
            'Contacts'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-contacts-user_id',
            'Contacts'
        );

        $this->dropTable('Contacts');
    }
}
