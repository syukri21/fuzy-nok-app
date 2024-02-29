<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnFirstNameAndLastNameUsers extends Migration
{
    public function up()
    {
        log_message("info", "AddColumnFirstNameAndLastNameUsers Migration");
        $this->forge->addColumn('users', [
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'default' => '',
                'null' => false
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true
            ],
            'gender' => [
                'type' => 'ENUM',
                'constraint' => ['male', 'female'],
                'default' => 'male',
                'null' => false,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn("users", ["first_name", "last_name", "gender"]);
    }
}
