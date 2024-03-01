<?php

namespace App\Controllers;

use App\Models\UserData;

class Home extends BaseController
{
    public function index(): string
    {
        return view('Home/Home');
    }

    public function adminHome(): string
    {
        $page = $this->request->getGet('page');
        if (!isset($page)) {
            $page = 1;
        }
        $userModel = new  UserData();
        $paginate = $userModel->join('users', 'users.id = user_datas.user_id')->paginate(20, 'operator', $page);
        return view('Home/AdminHome', [
            'data' => $paginate,
            'pager' => $userModel->pager
        ]);
    }
}
