<?php

use yii\db\Migration;

class m151022_022744_sintret extends Migration {

    public function safeUp() {

        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'auth_key' => $this->string(),
            'password_hash' => $this->string(),
            'password_reset_token' => $this->string(),
            'email' => $this->string(128),
            'name' => $this->string(128),
            'avatar' => $this->string(128),
            'phone' => $this->string(128),
            'city' => $this->string(128),
            'roleId' => $this->integer(),
            'status' => $this->smallInteger(1),
            'position' => $this->string(128),
            'hobby' => $this->string(128),
            'description' => $this->text(),
            'createDate' => $this->dateTime(),
            'updateDate' => $this->timestamp()->notNull()
        ]);

        $this->insert('user', [
            'roleId' => 1,
            'username' => 'admin',
            'auth_key' => 'OocVKRx-iludROmUFYj4HmxNeC8v0-FG',
            'password_hash' => '$2y$13$0d3FeUDYGSyZft.3I77hV.E357FsqqAJFqaWPstWODMbdlSvxV2gC',
            'email' => 'sintret@gmail.com',
            'name' => 'andy Laser',
            'avatar' => '@web/images/avatar/1/gajah.jpg',
            'phone' => '628188888888',
            'city' => 'Jakarta',
            'status' => 1,
            'position' => 'Programmer',
            'hobby' => 'Coding',
            'createDate' => date("Y-m-d"),
            'updateDate' => $this->timestamp()->notNull()
        ]);
        
        $this->createTable('log_upload', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer(),
            'title' => $this->string(128),
            'filename' => $this->string(128),
            'fileori' => $this->string(128),
            'params' => $this->text(),
            'values' => $this->text(),
            'warning' => $this->text(),
            'keys' => $this->text(),
            'type' => $this->smallInteger(2),
            'userCreate' => $this->integer(),
            'userUpdate' => $this->integer(),
            'updateDate' => $this->timestamp()->notNull(),
            'createDate' => $this->dateTime(),
        ]);

        $this->createTable('notification', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer(),
            'title' => $this->string(),
            'message' => $this->text(),
            'url' => $this->string(),
            'params' => $this->text(),
            'userCreate' => $this->integer(),
            'userUpdate' => $this->integer(),
            'updateDate' => $this->timestamp()->notNull(),
            'createDate' => $this->dateTime(),
        ]);

        $this->createTable('tbl_dynagrid', [
            'id' => $this->string(),
            'filter_id' => $this->string(),
            'sort_id' => $this->string(),
            'data' => $this->text(),
        ]);

        $this->createTable('tbl_dynagrid_dtl', [
            'id' => $this->string(),
            'category' => $this->string(),
            'name' => $this->string(),
            'data' => $this->text(),
            'dynagrid_id' => $this->string(),
        ]);

        $this->createTable('todolist', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer(),
            'title' => $this->string(),
            'status' => $this->smallInteger(2)->defaultValue(0),
            'params' => $this->text(),
            'updateDate' => $this->timestamp()->notNull(),
            'createDate' => $this->dateTime(),
        ]);

        $this->createTable('setting', [
            'id' => $this->primaryKey(),
            'applicationName' => $this->string(),
            'description' => $this->text(),
            'sms' => $this->smallInteger(1)->defaultValue(0),
            'sms_key' => $this->string(),
            'sms_pass' => $this->string(),
            'gcm' => $this->smallInteger(1)->defaultValue(0),
            'gcm_api_key' => $this->string(),
            'gcm_sender' => $this->string(),
            'emailAdmin' => $this->string(),
            'emailSupport' => $this->string(),
            'emailOrder' => $this->string(),
            'sendgridUsername' => $this->string(),
            'sendgridPassword' => $this->string(),
            'whatsappNumber' => $this->string(),
            'whatsappPassword' => $this->string(),
            'whatsappSend' => $this->string(),
            'facebook' => $this->string(),
            'instagram' => $this->string(),
            'google' => $this->string(),
            'twitter' => $this->string(),
            'userCreate' => $this->integer(),
            'userUpdate' => $this->integer(),
            'updateDate' => $this->timestamp()->notNull(),
            'createDate' => $this->dateTime(),
        ]);

        $this->insert('setting', [
            'applicationName' => 'Yii2 Basic Easy',
            'description' => 'Using Admin Yii2 Basic Easy',
            'emailAdmin' => 'your_email@gmail.com',
            'emailSupport' => 'your_email@gmail.com',
            'emailOrder' => 'your_email@gmail.com',
        ]);
        
        $this->createTable('role', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'params' => $this->text()
        ]);

        $this->insert('role', [
            'name' => 'Admin',
            'params'=>'{"log-upload":{"create":"on","update":"on","index":"on","view":"on","parsing-log":"on","excel":"on","parsing":"on","sample":"on","delete":"on","delete-all":"on"},"notification":{"create":"on","update":"on","index":"on","view":"on","parsing-log":"on","excel":"on","parsing":"on","sample":"on","delete":"on","delete-all":"on"},"role":{"create":"on","update":"on","index":"on","view":"on","parsing-log":"on","excel":"on","parsing":"on","sample":"on","delete":"on","delete-all":"on"},"setting":{"create":"on","update":"on","index":"on","view":"on","parsing-log":"on","excel":"on","parsing":"on","sample":"on","delete":"on","delete-all":"on"},"user":{"create":"on","update":"on","index":"on","view":"on","parsing-log":"on","excel":"on","parsing":"on","sample":"on","delete":"on","delete-all":"on"}}'
        ]);
        $this->insert('role', [
            'name' => 'Editor',
            'params'=>'{"log-upload":{"create":"on","update":"on","index":"on","view":"on","parsing-log":"on","excel":"on","parsing":"on","sample":"on"},"notification":{"create":"on","update":"on","index":"on","view":"on","parsing-log":"on","excel":"on","parsing":"on","sample":"on"},"role":{"create":"on","update":"on","index":"on","view":"on","parsing-log":"on","excel":"on","parsing":"on","sample":"on"},"setting":{"create":"on","update":"on","index":"on","view":"on","parsing-log":"on","excel":"on","parsing":"on","sample":"on"},"user":{"create":"on","update":"on","index":"on","view":"on","parsing-log":"on","excel":"on","parsing":"on","sample":"on"}}'
        ]);
    }

    public function safeDown() {
        $this->dropTable('chat');
        $this->dropTable('log_upload');
        $this->dropTable('notification');
        $this->dropTable('tbl_dynagrid');
        $this->dropTable('tbl_dynagrid_dtl');
        $this->dropTable('todolist');
        $this->dropTable('setting');
        $this->dropTable('user');
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
