<?php

namespace App\Controllers;

use App\Entities\Shift;
use App\Models\ShiftModel;

class ShiftController extends BaseController
{
    public function index()
    {
        $page = $this->request->getGet("page_operator") ?? 1;
        $shiftModel = new ShiftModel();
        return view("Shift/Index", [
            'data' => $shiftModel->paginate(20, 'shifts', $page),
            'pager' => $shiftModel->pager,
            'page' => $page
        ]);
    }

    public function add()
    {
        return view("Shift/Add");
    }

    public function store()
    {
        try {
            $shiftModel = new ShiftModel();
            $data = $this->request->getPost();
            $shift = new Shift();
            $shift->fill($data);
            $shiftModel->save($shift);
            return redirect()->to('/shift')->with("success", $data['name'] . " Shift added successfully");
        } catch (\Exception $e) {
            log_message("error", $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function edit($id)
    {
        $shiftModel = new ShiftModel();
        $data = $shiftModel->find($id);
        return view("Shift/Edit", ['data' => $data->toArray()]);
    }


    public function update($id)
    {
        try {
            $shiftModel = new ShiftModel();
            $data = $this->request->getPost();
            $shift = $shiftModel->find($id);
            $shift->fill($data);
            $shiftModel->save($shift);
            return redirect()->to('/shift')->with("success", $data['name'] . " Shift updated successfully");
        } catch (\Exception $e) {
            log_message("error", $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function delete($id)
    {
        try {
            $shiftModel = new ShiftModel();
            $shiftModel->delete($id);
            return redirect()->to('/shift')->with("success", "Shift deleted successfully");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
