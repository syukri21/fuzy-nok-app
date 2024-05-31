<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveUniqueMachineNames extends Migration
{
  public function up()
  {
    $this->forge->modifyColumn("machines", [
      'name' => [
        'type' => 'VARCHAR',
        'constraint' => 255,
        'null' => true,
        'unique' => false
      ],
    ]);
    //
  }

  public function down()
  {
    //
    $this->forge->modifyColumn("machines", [
      'name' => [
        'type' => 'VARCHAR',
        'constraint' => 255,
        'null' => false,
        'unique' => true
      ],
    ]);
  }
}
