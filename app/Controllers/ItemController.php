<?php

namespace App\Controllers;

use App\Models\ItemModel;

class ItemController extends BaseController
{
    public function index()
    {
        $page = $this->request->getGet('page_operator') ?? 1;
        $itemModel = new ItemModel();
        return view('Item/Index', [
            'data' => $itemModel->paginate(20, 'item', $page),
            'pager' => $itemModel->pager,
        ]);
    }
}
