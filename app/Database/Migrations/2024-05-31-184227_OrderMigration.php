<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class OrderMigration extends Migration
{

  protected $tableName = 'orders';
  public function up()
  {
    $fields = [
      'id' => [
        'type' => 'BIGINT',
        'constraint' => 11,
        'unsigned' => true,
        'auto_increment' => true
      ],
      'item_id' => [
        'type' => 'BIGINT',
        'constraint' => 11,
        'unsigned' => true,
      ],
      'order_pieces' => [
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
    ];

    $this->forge->addField($fields);
    $this->forge->addPrimaryKey("id", "orders__id");
    $this->forge->addForeignKey("item_id", "items", "id", "CASCADE", "CASCADE");
    $this->forge->createTable($this->tableName);
    
  }

  public function down()
  {
    $this->forge->dropForeignKey($this->tableName, 'orders__item_id');
    $this->forge->dropTable($this->tableName);
  }
}
