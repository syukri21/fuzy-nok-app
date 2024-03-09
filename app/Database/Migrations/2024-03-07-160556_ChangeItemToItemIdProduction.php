<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeItemToItemIdProduction extends Migration
{
    public function up()
    {
        $this->forge->dropColumn("productions", "item");
        $this->forge->addColumn("productions", [
            "item_id" => [
                "type" => "BIGINT",
                "unsigned" => true,
                'auto_increment' => true
            ]
        ]);
    }

    public function down()
    {

        $this->forge->dropColumn("productions", "item_id");
        $this->forge->addColumn("productions", [
            "item_id" => [
                "type" => "BIGINT",
                "unsigned" => true,
                'auto_increment' => true
            ]
        ]);
    }
}
