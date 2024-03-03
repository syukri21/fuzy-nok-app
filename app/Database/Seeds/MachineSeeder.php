<?php

namespace App\Database\Seeds;

use App\Models\MachineModel;
use CodeIgniter\Database\Seeder;

class MachineSeeder extends Seeder
{
    public function run()
    {

        $data = [
            [
                'name' => '522 A',
                'description' => 'Mesin curing 522 A',
            ],
            [
                'name' => '523 B',
                'description' => 'Mesin curing 523 B',
            ],
            [
                'name' => '500 C',
                'description' => 'Mesin curing 500 C',
            ],
        ];

        $machineModel = new MachineModel();
        $machineModel->save($data[0]);
        $machineModel->save($data[1]);
        $machineModel->save($data[2]);

    }
}
