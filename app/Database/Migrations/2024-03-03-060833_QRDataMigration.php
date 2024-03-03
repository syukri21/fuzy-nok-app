<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class QRDataMigration extends Migration
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
            'code' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'data' => [
                'type' => 'JSON',
                'null' => true
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['machine', 'seal']
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
        ]);
        $this->forge->addPrimaryKey("id", "qrdatas__id");
        $this->forge->addUniqueKey(["code"], "qrdatas__code");
        $this->forge->addKey("type", false, false, "qrdatas__type");
        $this->forge->createTable("qrdatas");
    }

    public function down()
    {
        $this->forge->dropKey("qrdatas", "qrdatas__type");
        $this->forge->dropKey("qrdatas", "qrdatas__code");
        $this->forge->dropKey("qrdatas", "qrdatas__id");
        $this->forge->dropTable("qrdatas");
    }
}
