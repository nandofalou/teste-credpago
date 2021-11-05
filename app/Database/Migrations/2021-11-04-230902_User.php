<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration {

    public function up() {

        $this->forge->addField([
            'id' => [
                'type' => 'INTEGER',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'null' => true,
                'constraint' => 100,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'null' => false,
                'constraint' => 100,
            ],
            'pass' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'hash' => [
                'type' => 'VARCHAR',
                'null' => false,
                'constraint' => 200,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
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

        $this->forge->addKey('email', false, false);
        $this->forge->addKey('name', false, false);
        $this->forge->addKey('hash', false, false);
        $this->forge->addKey('created_at', false, false);
        $this->forge->addKey('updated_at', false, false);
        $this->forge->addKey('deleted_at', false, false);

        if ($this->db->DBDriver === 'SQLite3') {
            $this->forge->createTable('users', true);
        } else {
            $this->forge->createTable('users', true, ['ENGINE' => 'InnoDB']);
        }
    }

    public function down() {
        $this->forge->dropTable('users', true);
    }

}
