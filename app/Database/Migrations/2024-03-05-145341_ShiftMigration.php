<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ShiftMigration extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'start_time' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'end_time' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addPrimaryKey("id", "shifts__id");
        $this->forge->addUniqueKey("name", "shifts__name");
        $this->forge->createTable("shifts");
    }

    public function down()
    {
        $this->forge->dropKey("shifts", "shifts__id");
        $this->forge->dropKey("shifts", "shifts__name");
        $this->forge->dropTable("shifts");
    }
}
