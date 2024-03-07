<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Production extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'BIGINT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'machine_id' => [
                'type' => 'BIGINT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'shift_id' => [
                'type' => 'BIGINT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'job' => [
                'type' => 'ENUM',
                'constraint' => ['CURRING', 'CUTTING'],
                'default' => 'CURRING'
            ],
            'noJobDesk' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'item' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'cav' => [
                'type' => 'BIGINT',
            ],
            'cycle' => [
                'type' => 'BIGINT',
            ],
            'result' => [
                'type' => 'BIGINT',
            ],
            'defect' => [
                'type' => 'BIGINT',
            ],
            'ok' => [
                'type' => 'BIGINT',
            ],
            'qty' => [
                'type' => 'BIGINT',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey("id", "productions__id");
        $this->forge->addForeignKey("user_id", "users", "id", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("machine_id", "machines", "id", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("shift_id", "shifts", "id", "CASCADE", "CASCADE");
        $this->forge->createTable("productions");
    }

    public function down()
    {
        $this->forge->dropForeignKey("productions", "productions__id");
        $this->forge->dropForeignKey("productions", "productions__user_id");
        $this->forge->dropForeignKey("productions", "productions__machine_id");
        $this->forge->dropForeignKey("productions", "productions__shift_id");
        $this->forge->dropTable("productions");
    }
}
