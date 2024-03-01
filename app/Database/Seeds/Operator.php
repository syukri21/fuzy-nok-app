<?php

namespace App\Database\Seeds;

use App\Entities\UserEntity;
use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class Operator extends Seeder
{
    public function run()
    {
        $faker = Factory::create("id_ID");
        $users = [];
        for ($i = 0; $i < 50; $i++) {
            $nik = $faker->unique()->numerify('NOK-####');
            $name = $faker->unique()->userName();
            $userEntity = new UserEntity([
                'username' => $name,
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'gender' => $faker->randomElement(["male", "female"]),
                'email' => $faker->unique()->email(),
                'password' => UserEntity::hash("operatorpwd"),
                'nik' => $nik,
                'role' => $faker->randomElement(["admin"]),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
            $users[] = $userEntity->toArray();
        }

        $userModel = new UserModel();
        $insertBatch = $userModel->builder()->insertBatch($users);
        echo $insertBatch;
        $all = $userModel->findAll();
        $userdatas = [];
        foreach ($all as $user) {
            $userData = new \App\Entities\UserData([
                'user_id' => $user->id,
                'alamat' => $faker->address(),
                'phone' => $faker->phoneNumber(),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),

            ]);
            $userdatas[] = $userData->toArray();
            echo "userdata name " . $user->first_name . "\n";
        }
        $userDataModel = new \App\Models\UserData();
        $userDataModel->builder()->insertBatch($userdatas);
        echo "inserted " . $insertBatch . "\n";

    }
}
