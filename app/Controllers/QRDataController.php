<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\QRDataModel;
use CodeIgniter\HTTP\RedirectResponse;

class QRDataController extends BaseController
{
    public function index(): string
    {

        $page = $this->request->getGet("page_operator");
        if (empty($page)) {
            $page = 1;
        }

        $qrModel = new QRDataModel();

        return view('QR/Index', [
            'data' => $qrModel->paginate(20, 'qr_data', $page),
            'pager' => $qrModel->pager,
        ]);
    }

    public function add(): string
    {
        $itemModel = new ItemModel();
        return view('QR/Add', [
            "items" => $itemModel->findAll()
        ]);
    }

    public function store(): RedirectResponse
    {

        try {
            $qrModel = new QRDataModel();
            $post = $this->request->getPost([
                "code",
                "type",
                "job",
                "noJobDesk",
                "item",
                "cav",
                "targetCycle"
            ]);
            $data = [
                "data" =>
                    json_encode([
                        "job" => 'Curring',
                        "noJobDesk" => $post['noJobDesk'],
                        "item" => $post['item'],
                        "cav" => $post['cav'],
                        "targetCycle" => $post['targetCycle']
                    ]),
                "code" => $post['code'],
                "type" => 'machine',
            ];
            $qrModel->save($data);
            return redirect()->to('/qr')->with("success", $data['code'] . " Data Added");

        } catch (\Exception $e) {
            log_message("error", $e->getMessage());
            return redirect()->to('/qr')->with("error", $e->getMessage());
        }
    }


    public function edit($id): string
    {
        $QRDataModel = new QRDataModel();
        $data = $QRDataModel->where('id', $id)->first()->toArray();
        $json_decode = json_decode($data['data'], false);
        foreach ($json_decode as $key => $item) {
            $data[$key] = $item;
        }
        return view('QR/Edit', [
            'data' => $data
        ]);
    }

    public function update($id): RedirectResponse
    {
        try {
            $qrModel = new QRDataModel();
            $post = $this->request->getPost([
                "code",
                "type",
                "job",
                "noJobDesk",
                "item",
                "cav",
                "targetCycle"
            ]);
            $data = [
                "data" =>
                    json_encode([
                        "job" => 'Curring',
                        "noJobDesk" => $post['noJobDesk'],
                        "item" => $post['item'],
                        "cav" => $post['cav'],
                        "targetCycle" => $post['targetCycle']
                    ]),
                "code" => $post['code'],
                "type" => 'machine',
            ];
            $qrModel->update($id, $data);
            return redirect()->to('/qr')->with("success", $data['code'] . " Data Updated");
        } catch (\Exception $e) {
            log_message("error", $e->getMessage());
            return redirect()->to('/qr')->with("error", $e->getMessage());
        }
    }


    public function delete($id): RedirectResponse
    {
        $qrModel = new QRDataModel();
        $qrModel->delete($id);
        return redirect()->to('/qr')->with("success", "Data Deleted");
    }

    public function showQrData($code): RedirectResponse
    {
        $QRDataModel = new QRDataModel();
        $data = $QRDataModel->where('code', $code)->first();
        return redirect()->to("/production/add")->with("qr", $data);

    }

    public function scan()
    {
        return view("Production/Scanner");
    }
}
