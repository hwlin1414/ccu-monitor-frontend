<?php

use yii\db\Migration;

class m161228_022556_init_data extends Migration
{
    public function up()
    {
        $this->insert('Groups', [
            'name' => '管理員',
        ]);
        $this->insert('GroupPerms', [
            'group_id' => '1',
            'perm' => '*'
        ]);
        $this->insert('Users', [
            'name' => 'admin',
            'password' => password_hash('admin', PASSWORD_BCRYPT),
            'group_id' => 1,
            'enabled' => true,
            'verified' => true,
            'registedip' => '127.0.0.1',
        ]);
        
    }

    public function down()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
        $this->truncateTable('Users');
        $this->truncateTable('GroupPerms');
        $this->truncateTable('Groups');
        $this->execute('SET FOREIGN_KEY_CHECKS = 1;');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
