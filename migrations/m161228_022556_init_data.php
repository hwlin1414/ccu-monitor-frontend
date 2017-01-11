<?php

use yii\db\Migration;

class m161228_022556_init_data extends Migration
{
    public function up()
    {
        $this->insert('GlobalConfig', [
            'key' => 'defaultGroupId',
            'value' => '1',
        ]);
        $this->insert('GlobalConfig', [
            'key' => 'mailVerifycation',
            'value' => '1',
        ]);
        $this->insert('GlobalConfig', [
            'key' => 'registEnable',
            'value' => '1',
        ]);
        $this->insert('GlobalConfig', [
            'key' => 'userVerifycation',
            'value' => '1',
        ]);
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
        $this->insert('Logs', [
            'ip' => '0.0.0.0',
            'level' => 'info',
            'user_id' => null,
            'action' => 'app',
            'description' => '系統初始化',
        ]);
    }

    public function down()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
        $this->truncateTable('Services');
        $this->truncateTable('HostContact');
        $this->truncateTable('Hosts');
        $this->truncateTable('Contacts');
        $this->truncateTable('Logs');
        $this->truncateTable('Users');
        $this->truncateTable('GroupPerms');
        $this->truncateTable('Groups');
        $this->truncateTable('GlobalConfig');
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
