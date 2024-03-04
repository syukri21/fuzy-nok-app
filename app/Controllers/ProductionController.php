<?php

namespace App\Controllers;

use App\Models\MachineModel;
use App\Models\QRDataModel;

class ProductionController extends BaseController
{
    public function index()
    {
        return view('Production/Index');
    }

    public function add()
    {
        $qr = session()->getFlashdata('qr');
        $machineModel = new MachineModel();
        if (empty($qr)) {
//            return redirect()->to('/home')->with('error', 'QR Tidak Ditemukan');
            $qr = (new QRDataModel())->first();
        }
        $machine = $machineModel->where("qr", $qr->code)->first();
        return view('Production/Add', [
            'qr' => $qr,
            'qr_data' => json_decode($qr->data),
            'machine' => $machine,
            'title' => 'Produksi'
        ]);
    }
}