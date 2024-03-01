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
        $alreadyUsedNik = [];
        for ($i = 0; $i < 50; $i++) {
            $nik = $faker->numerify('NOK-####');

            $count = 1;
            while (in_array($nik, $alreadyUsedNik)) {
                echo "try " . $count;
                $nik = $faker->numerify('NOK-####');
            }
            $alreadyUsedNik[] = $nik;
            $name = $faker->userName();
            $userEntity = new UserEntity([
                'username' => $name,
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'gender' => $faker->randomElement(["male", "female"]),
                'email' => $faker->email(),
                'password' => UserEntity::hash("operatorpwd"),
                'nik' => $nik,
                'role' => $faker->randomElement(["admin"]),
            ]);
            $userModel = new UserModel();
            $userModel->save($userEntity);
            $insertID = $userModel->getInsertID();
            $userData = new \App\Entities\UserData([
                'user_id' => $insertID,
                'image' => $faker->image(),
                'alamat' => $faker->address()
            ]);
            $userDataModel = new \App\Models\UserData();
            $userDataModel->save($userData);

            echo "inserted " . $insertID . "\n" . "name: " . $name . "\n" . "nik: " . $nik . "\n";

        }
    }
}
