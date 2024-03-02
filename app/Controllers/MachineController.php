<?php

namespace App\Controllers;

use App\Models\MachineModel;

class MachineController extends BaseController
{
    public function index()
    {
        $page = $this->request->getGet("page_operator");
        if (empty($page)) {
            $page = 1;
        }

        $machineModel = new MachineModel();
        return view('Machine/Index', [
            'data' => $machineModel->paginate(20, 'machine', $page),
            'pager' => $machineModel->pager
        ]);
    }
}
