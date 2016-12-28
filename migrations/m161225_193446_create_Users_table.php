<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 * Has foreign keys to the tables:
 *
 * - `Groups`
 */
class m161225_193446_create_Users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('Users', [
            'id' => $this->primaryKey(),
            'name' => $this->string(63)->notNull()->unique(),
            'password' => $this->string(255)->notNull(),
            'group_id' => $this->integer()->notNull(),
            'enabled' => $this->boolean()->notNull(),
            'verified' => $this->boolean()->notNull(),
            'registedip' => $this->string(15)->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),#->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // creates index for column `group_id`
        $this->createIndex(
            'idx-users-group_id',
            'Users',
            'group_id'
        );

        // add foreign key for table `Groups`
        $this->addForeignKey(
            'fk-users-group_id',
            'Users',
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
            'fk-users-group_id',
            'Users'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            'idx-users-group_id',
            'Users'
        );

        $this->dropTable('Users');
    }
}
