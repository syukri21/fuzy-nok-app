<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class OrderMachinesMigration extends Migration
{

  protected $tableName = 'order_machines';


  public function up()
  {

    $this->forge->addField([
      'id' => [
        'type' => 'BIGINT',
        'constraint' => 11,
        'unsigned' => true,
        'auto_increment' => true
      ],
      'order_id' => [
        'type' => 'BIGINT',
        'constraint' => 11,
        'unsigned' => true,
      ],
      'machine_id' => [
        'type' => 'BIGINT',
        'constraint' => 11,
        'unsigned' => true,
      ],
      'target_cycle' => [
        'type' => 'INT',
        'constraint' => 11
      ],
      'created_at' => [
        'type' => 'TIMESTAMP',
        'null' => false,
        'default' => new RawSql('CURRENT_TIMESTAMP'),
      ],
      'updated_at' => [
        'type' => 'TIMESTAMP',
        'null' => true
      ],
      'deleted_at' => [
        'type' => 'TIMESTAMP',
        'null' => true
      ]
    ]);
    $this->forge->addPrimaryKey("id", "order_machines__id");
    $this->forge->addForeignKey('order_id', 'orders', 'id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('machine_id', 'machines', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable($this->tableName);
    //
  }

  public function down()
  {
    $this->forge->dropForeignKey($this->tableName, 'order_machines__order_id');
    $this->forge->dropForeignKey($this->tableName, 'order_machines__machine_id');
    $this->forge->dropTable($this->tableName);
    //
  }
}
