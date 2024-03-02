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
                'name' => 'Machine 1',
                'qr_text' => 'Machine 1',
                'qr_path' => 'Machine 1',
            ],
            [
                'name' => 'Machine 2',
                'qr_text' => 'Machine 2',
                'qr_path' => 'Machine 2',
            ],
            [
                'name' => 'Machine 3',
                'qr_text' => 'Machine 3',
                'qr_path' => 'Machine 3',
            ],
        ];

        $machineModel = new MachineModel();
        $machineModel->save($data[0]);
        $machineModel->save($data[1]);
        $machineModel->save($data[2]);

    }
}
