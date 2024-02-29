<?php

namespace App\Database\Seeds;


use App\Entities\UserEntity;
use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;


class UserRegistration extends Seeder
{
    public function run()
    {
        $faker = Factory::create("id_ID");
        for ($i = 0; $i < 10; $i++) {
            $userEntity = new UserEntity([
                'username' => $faker->userName(),
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'gender' => $faker->randomElement(["male", "female"]),
                'email' => $faker->email,
                'password' => UserEntity::hash("operatorpwd"),
                'nik' => $faker->numerify('NOK-####'),
                'role' => $faker->randomElement(["admin", "user"]),
            ]);
            $userModel = new UserModel();
            $userModel->save($userEntity);
        }
    }
}
