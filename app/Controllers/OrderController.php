<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\MachineModel;
use App\Models\OrderMachinesModel;
use App\Models\OrderModel;
use CodeIgniter\HTTP\RedirectResponse;

class OrderController extends BaseController
{

  public function index(): string
  {
    $page = $this->request->getGet("page_operator");
    if (empty($page)) {
      $page = 1;
    }

    $orderModel = new OrderModel();
    return view('Order/Index', [
      'data' => $orderModel->paginate(20, 'order', $page),
      'pager' => $orderModel->pager
    ]);
  }

  public function add(): string
  {
    $items = (new ItemModel())->findAll();
    $machines = (new MachineModel())->findAll();
    return view('Order/Add', [
      'items' => $items, 'machines' => $machines
    ]);
  }


  public function store(): RedirectResponse
  {

    $orderModel = new OrderModel();

    try {
      $data = $this->request->getpost([
        'machine_ids',
        'target',
        'item_id',
      ]);

      if ($data['item_id'] == "" || !$data['item_id']) {
        throw new \Exception("Item cannot be empty");
      }

      if ($data['machine_ids'] == "" || !$data['machine_ids']) {
        throw new \Exception("Machines cannot be empty");
      }

      if ($data['target'] == "" || !$data['target']) {
        throw new \Exception("Target cannot be empty");
      }

      $orderModel->db->transBegin();

      $order_code = "";
      while (true) {
        $order_code = generateRandomCode();
        $isExist = $orderModel->where('order_code', $order_code)->first();
        if (!$isExist) {
          break;
        }
      }

      $orderModel->insert([
        'item_id' => $data['item_id'],
        'order_pieces' => $data['target'],
        'order_code' => $order_code
      ]);

      $machineModel = new MachineModel();
      $machine_ids_arr = explode(",", $data['machine_ids']);
      foreach ($machine_ids_arr as $machine_id) {
        $machine = $machineModel->find($machine_id);
        if (!$machine) {
          throw new \Exception("Machine not found");
        }
        $orderMachineModel = new OrderMachinesModel();
        $cycle = $data['target'] / (sizeof($machine_ids_arr) * $machine->cavity * 2);
        $orderMachineModel->insert([

          'order_id' => $orderModel->getInsertID(),
          'machine_id' => $machine_id,
          'target_cycle' => $cycle
        ]);
      }

      $orderModel->db->transCommit();
      return redirect()->to('/order')->with("success", "Data Added");
    } catch (\Exception $e) {
      log_message("error", $e->getMessage());
      $orderModel->db->transRollback();
      return redirect()->to('/order/add')->with('error', $e->getMessage());
    }
  }


  public function edit($id): string
  {
    $orderModel = new OrderModel();
    $data = $orderModel->find($id);

    $items = (new ItemModel())->findAll();
    $machines = (new MachineModel())->findAll();

    $orderMachineModel = new OrderMachinesModel();
    $orderedMachines = $orderMachineModel->where('order_id', $id)->findAll();


    return view('Order/Edit', [
      'data' => $data->toArray(),
      'items' => $items,
      'machines' => $machines,
      'orderedMachines' => $orderedMachines
    ]);
  }

  public function update($id): RedirectResponse
  {

    $orderModel = new OrderModel();

    try {
      $data = $this->request->getpost([
        'machine_ids',
        'target',
        'item_id',
      ]);

      if ($data['item_id'] == "" || !$data['item_id']) {
        throw new \Exception("Item cannot be empty");
      }

      if ($data['machine_ids'] == "" || !$data['machine_ids']) {
        throw new \Exception("Machines cannot be empty");
      }

      if ($data['target'] == "" || !$data['target']) {
        throw new \Exception("Target cannot be empty");
      }

      $orderModel->db->transBegin();

      $order = $orderModel->find($id);
      if (!$order) {
        throw new \Exception("Order not found");
      }

      $order->item_id = $data['item_id'];
      $order->order_pieces = $data['target'];
      $order->updated_at = date('Y-m-d H:i:s');
      $orderModel->save($order);


      $orderMachineModel = new OrderMachinesModel();
      $orderMachineModel->where('order_id', $id)->delete(null, true);

      $machineModel = new MachineModel();
      $machine_ids_arr = explode(",", $data['machine_ids']);

      foreach ($machine_ids_arr as $machine_id) {
        $machine = $machineModel->find($machine_id);
        if (!$machine) {
          throw new \Exception("Machine not found");
        }
        $orderMachineModel = new OrderMachinesModel();
        $cycle = $data['target'] / (sizeof($machine_ids_arr) * $machine->cavity * 2);
        $orderMachineModel->save([
          'order_id' => $id, 
          'machine_id' => $machine_id,
          'target_cycle' => $cycle
        ]);
      }

      $orderModel->db->transCommit();
      return redirect()->to('/order')->with("success", "Data Added");
    } catch (\Exception $e) {
      log_message("error", $e->getMessage());
      $orderModel->db->transRollback();
      return redirect()->to('/order/add')->with('error', $e->getMessage());
    }
  }

  public function delete($id): RedirectResponse
  {
    try {
      $orderModel = new OrderModel();
      $orderModel->delete($id);
      return redirect()->to('/order')->with("success", "Data Deleted");
    } catch (\Exception $e) {
      log_message("error", $e->getMessage());
      return redirect()->to('/order')->with('error', $e->getMessage());
    }
  }
}
