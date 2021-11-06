<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UrlState extends Migration {

    public function up() {

        $this->forge->addField([
            'id' => [
                'type' => 'INTEGER',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INTEGER',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'url' => [
                'type' => 'VARCHAR',
                'null' => false,
                'constraint' => 200,
            ],
            'status_code' => [
                'type' => 'INTEGER',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'default' => null,
            ],
            'response' => [
                'type' => 'LONGTEXT',
                'null' => true,
                'default' => null,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ]
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->addKey('user_id', false, false);
        $this->forge->addKey('url', false, false);
        $this->forge->addKey('created_at', false, false);
        $this->forge->addKey('updated_at', false, false);
        $this->forge->addKey('deleted_at', false, false);

        $this->forge->addForeignKey('user_id', 'users', 'id', 'NO ACTION', 'NO ACTION');

        if ($this->db->DBDriver === 'SQLite3') {
            $this->forge->createTable('url_state', true);
        } else {
            $this->forge->createTable('url_state', true, ['ENGINE' => 'InnoDB']);
        }
    }

    public function down() {
        $this->forge->dropTable('url_state', true);
    }

}
