<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOrderCode extends Migration
{
  public function up()
  {
    $this->forge->addColumn('orders', [
      'order_code' => [
        'type' => 'VARCHAR',
        'constraint' => 255,
        'null' => false,
        'unique' => true
      ]
    ]);
  }

  public function down()
  {

    $this->forge->dropColumn('orders', 'order_code');
  }
}
