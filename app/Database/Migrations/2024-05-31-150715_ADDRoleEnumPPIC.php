<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ADDRoleEnumPPIC extends Migration
{
    public function up()
    {
      $fields = [
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['admin', 'operator', 'ppic'],
                'default' => 'operator',
            ]
      ];

      $this->forge->modifyColumn('users', $fields);
      
      //
    }

    public function down()
    {
      $fields = [
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['admin', 'operator'],
                'default' => 'operator',
            ]
      ];

      $this->forge->modifyColumn('users', $fields);
    }
}
