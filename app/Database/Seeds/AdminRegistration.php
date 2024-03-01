<?php

namespace App\Database\Seeds;


use App\Entities\UserEntity;
use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;


class AdminRegistration extends Seeder
{
    public function run()
    {
        $faker = Factory::create("id_ID");
        $userEntity = new UserEntity([
            'username' => $faker->userName(),
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'gender' => $faker->randomElement(["male", "female"]),
            'email' => "superadmin@nok.com",
            'password' => UserEntity::hash("adminpwd"),
            'nik' => $faker->numerify('NOK-####'),
            'role' => $faker->randomElement(["admin"]),
        ]);
        $userModel = new UserModel();
        $userModel->save($userEntity);
        $insertID = $userModel->getInsertID();
        $userData = new \App\Entities\UserData([
            'user_id' => $insertID,
            'image' => $faker->imageUrl(640, 480),
            'alamat' => $faker->address()
        ]);
        $userDataModel = new \App\Models\UserData();
        $userDataModel->save($userData);
    }
}
