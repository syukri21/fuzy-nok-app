<?php

namespace App\Database\Seeds;


use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use CodeIgniter\Test\Fabricator;


class UserRegistration extends Seeder
{
    public function run()
    {
        $fabricator = new Fabricator(UserModel::class, null, "id_ID");
        $fabricator->create(10);
        log_message("info", "User registration done");
    }
}
