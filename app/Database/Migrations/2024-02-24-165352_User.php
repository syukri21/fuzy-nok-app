<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class User extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
            ],
            'nik' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'verify_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['admin', 'operator'],
                'default' => 'operator',
            ]
        ];
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id', 'users__id');
        $this->forge->addKey(['username'], false, true, "users__username");
        $this->forge->addKey(['email'], false, true, "users__email");
        $this->forge->addKey(['nik'], false, true, "users__nik");
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropKey('users', 'username', "users__username");
        $this->forge->dropKey('users', 'email', "users__email");
        $this->forge->dropKey('users', 'nik', "users__nik");
        $this->forge->dropTable('users');
    }
}
