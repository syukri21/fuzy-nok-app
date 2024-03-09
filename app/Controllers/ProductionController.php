<?php

namespace App\Controllers;

use App\Database\Migrations\Item;
use App\Models\ItemModel;
use App\Models\MachineModel;
use App\Models\QRDataModel;
use App\Models\ShiftModel;

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
        $shiftModel = new ShiftModel();
        if (empty($qr)) {
//            return redirect()->to('/home')->with('error', 'QR Tidak Ditemukan');
            $qr = (new QRDataModel())->first();
        }
        $machine = $machineModel->where("qr", $qr->code)->first();
        $itemModel = new ItemModel();
        $json_decode = json_decode($qr->data);
        return view('Production/Add', [
            'qr' => $qr,
            'qr_data' => $json_decode,
            'item' => $itemModel->find($json_decode->item),
            'machine' => $machine,
            'title' => 'Produksi',
            'shifts' => $shiftModel->findAll()
        ]);
    }

    public function store()
    {

    }
}
