<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyQRDatasToBeComeOneToOneWithMachine extends Migration
{
  public function up()
  {
    $this->forge->dropTable('qrdatas');
    $this->forge->modifyColumn('machines', [
      'qr' => [
        'type' => 'varchar',
        'constraint' => 100,
        'null' => false,
        'unique' => true
      ]
    ]);
  }

  public function down()
  {
    throw new \Exception('Migration ModifyQRDatasToBeComeOneToOneWithMachine is not reversible');
  }
}
