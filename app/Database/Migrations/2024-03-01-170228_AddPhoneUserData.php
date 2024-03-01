<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPhoneUserData extends Migration
{
    public function up()
    {
        $this->forge->addColumn('user_datas', [
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('user_datas', 'phone');
    }
}
