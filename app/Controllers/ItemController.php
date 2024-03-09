<?php

namespace App\Controllers;

use App\Entities\ItemEntity;
use App\Models\ItemModel;
use CodeIgniter\HTTP\RedirectResponse;

class ItemController extends BaseController
{
    public function index(): string
    {
        $page = $this->request->getGet('page_operator') ?? 1;
        $itemModel = new ItemModel();
        return view('Item/Index', [
            'data' => $itemModel->paginate(20, 'item', $page),
            'pager' => $itemModel->pager,
        ]);
    }

    public function add(): string
    {
        return view('Item/Add');
    }


    public function store(): RedirectResponse
    {
        try {
            $itemModel = new ItemModel();
            $data = $this->request->getPost();

            $image = $this->request->getFile("image");
            if (!$image->isValid() && $image->getError() != 0) {
                throw new \Exception("Image is invalid");
            }


            $relPath = 'uploads/' . $image->store();
            $itemEntity = new ItemEntity();
            $itemEntity->fill([
                ...$data,
                'image' => $relPath
            ]);


            $itemModel->save($itemEntity);
            return redirect()->to('/item')->with('success', $data['name'] . 'Data created');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit(int $id): string
    {
        $itemModel = new ItemModel();
        $data = $itemModel->find($id);
        return view('Item/Edit', [
            'data' => $data->toArray()
        ]);
    }

    public function delete(int $id): RedirectResponse
    {
        $itemModel = new ItemModel();
        $itemModel->delete($id);
        return redirect()->to('/item')->with("success", "Data Deleted");

    }

    public function update(int $id): RedirectResponse
    {
        try {
            $itemModel = new ItemModel();
            $item = $itemModel->find($id);
            $data = $this->request->getPost();

            $image = $this->request->getFile("image");
            if (!$image->isValid() && $image->getError() != 0) {
                throw new \Exception("Image is invalid");
            }
            $relPath = 'uploads/' . $image->store();
            $item->fill([
                ...$data,
                'image' => $relPath
            ]);

            $itemModel->save($item);
            return redirect()->to('/item')->with('success', $data['name'] . 'Data created');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }




}
