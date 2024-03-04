<?php

namespace App\Controllers;

use App\Models\MachineModel;
use CodeIgniter\HTTP\RedirectResponse;

class MachineController extends BaseController
{
    public function index(): string
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

    public function add(): string
    {
        return view('Machine/Add');
    }

    public function store(): RedirectResponse
    {
        try {
            $data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'qr' => $this->request->getPost('qr'),
            ];
            $machineModel = new MachineModel();
            $machineModel->save($data);
            return redirect()->to('/machine')->with("success", $data['name'] . " Data Added");
        } catch (\Exception $e) {
            log_message("error", $e->getMessage());
            return redirect()->to('/machine/add')->with('error', $e->getMessage());
        }
    }

    public function edit($id): string
    {
        $machineModel = new MachineModel();
        $data = $machineModel->find($id);
        return view('Machine/Edit', [
            'data' => $data->toArray()
        ]);
    }

    public function update($id): RedirectResponse
    {

        try {
            $data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'qr' => $this->request->getPost('qr'),
            ];
            $machineModel = new MachineModel();
            $machineModel->update($id, $data);
            return redirect()->to('/machine')->with("success", $data['name'] . " Data Updated");
        } catch (\Exception $e) {
            log_message("error", $e->getMessage());
            return redirect()->to('/machine/edit')->with('error', $e->getMessage());
        }

    }

    public function delete($id): RedirectResponse
    {
        $machineModel = new MachineModel();
        $machineModel->delete($id);
        return redirect()->to('/machine')->with("success", "Data Deleted");
    }
}
