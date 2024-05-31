<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCavityOnMachines extends Migration
{
  public function up()
  {
    $this->forge->addColumn('machines', [
      'cavity' => [
        'type' => 'INT',
        'null' => false,
        'default' => 14
      ]
    ]);
  }

  public function down()
  {
    $this->forge->dropColumn('machines', 'cavity');
  }
}
