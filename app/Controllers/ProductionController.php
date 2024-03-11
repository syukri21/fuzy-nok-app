<?php

namespace App\Controllers;

use App\Entities\ProductionEntity;
use App\Models\ItemModel;
use App\Models\MachineModel;
use App\Models\ProductionModel;
use App\Models\QRDataModel;
use App\Models\ShiftModel;

class ProductionController extends BaseController
{
    public function index()
    {
        $page = $this->request->getGet("page_operator") ?? 1;
        $user = session()->get('data');

        $productionModel = new ProductionModel();
        $productionModel->where('user_id', $user['id'])
            ->select("productions.*, items.name as item_name, machines.name as machine_name, shifts.name as shift_name")
            ->join("machines", "machines.id = productions.machine_id", "LEFT")
            ->join("items", "items.id = productions.item_id")
            ->join("shifts", "shifts.id = productions.shift_id")
            ->orderBy("productions.id", "DESC");

        return view('Production/Index', [
            'title' => 'Laporan Produksi',
            'data' => $productionModel->paginate(20, 'production', $page),
            'pager' => $productionModel->pager
        ]);
    }

    public function add()
    {
        $qr = session()->getFlashdata('qr');
        $machineModel = new MachineModel();
        $shiftModel = new ShiftModel();
        if (empty($qr)) {
            return redirect()->to('/home')->with('error', 'QR Tidak Ditemukan');
//            $qr = (new QRDataModel())->first();
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

    public function store($qrId)
    {
        try {

            $user = session()->get('data');
            if (empty($user)) {
                log_message("error", "User Not Found");
                return redirect()->back()->with('error', "User Not Found");
            }

            $post = $this->request->getPost();

            $QRDataModel = new QRDataModel();
            $qr = $QRDataModel->find($qrId);
            $qrdata = json_decode($qr->data);
            if (empty($qr) || empty($qrdata)) {
                return redirect()->back()->with('error', "QR Tidak Ditemukan");
            }

            $machineModel = new MachineModel();
            $machine = $machineModel->where("qr", $qr->code)->orderBy("id", "DESC")->first();

            $itemModel = new ItemModel();
            $item = $itemModel->where("id", $qrdata->item)->first();

            $data = [
                'user_id' => $user['id'],
                'machine_id' => $machine->id,
                'shift_id' => $post['shift_id'],
                'item_id' => $item->id,
                'job' => $qrdata->job,
                'qty' => $post['result'],
                'noJobDesk' => $qrdata->noJobDesk,
                'cav' => $qrdata->cav,
                'cycle' => $post['cycle'],
                'result' => $post['result'],
                'defect' => $post['defect'],
                'ok' => $post['ok'],
            ];


            $productionEntity = new ProductionEntity();
            $productionEntity->fill($data);
            $productionModel = new ProductionModel();
            $productionModel->save($productionEntity);
            return redirect()->to("/home")->with('success', "Produksi Berhasil");
        } catch (\Exception $e) {
            log_message("error", $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }


    }

    public function chart()
    {
        $user = session()->get('data');
        if (empty($user)) {
            log_message("error", "User Not Found");
            return json_encode([
                "error" => "User Not Found",
                "code" => 401
            ]);
        }
        $db = db_connect();
        $query = $db->query("SELECT DATE_FORMAT(created_at, '%m') as date, SUM(result) as result, SUM(defect ) as defect, SUM(ok) as ok FROM productions WHERE user_id = " . $user['id'] . " GROUP BY DATE_FORMAT(created_at, '%m')");
        return json_encode([
            "data" => $query->getResultArray()
        ]);
    }
}
