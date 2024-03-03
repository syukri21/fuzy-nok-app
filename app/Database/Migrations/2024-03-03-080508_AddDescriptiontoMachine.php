<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDescriptiontoMachine extends Migration
{
    public function up()
    {
        $this->forge->addColumn("machines", [
            'description' => [
                'type' => 'TEXT',
                'null' => true
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn("machines", "description");
    }
}
