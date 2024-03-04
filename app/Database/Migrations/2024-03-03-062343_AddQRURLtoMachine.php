<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddQRURLtoMachine extends Migration
{
    public function up()
    {
        $this->forge->addColumn("machines", [
            "qr" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => true
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn("machines", "qr");
    }
}
