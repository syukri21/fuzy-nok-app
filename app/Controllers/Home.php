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
        $page = $this->request->getGet('page_operator');
        if (!isset($page)) {
            $page = 1;
        }
        $userModel = new  UserData();
        $perPage = 20;
        $paginate = $userModel->join('users', 'users.id = user_datas.user_id')->where("role", "operator")->orderBy("first_name", "ASC")->paginate($perPage, 'operator', $page);
        return view('Home/AdminHome', [
            'data' => $paginate,
            'pager' => $userModel->pager,
            'perPage' => $perPage,
            'page' => $page,
            'count' => $userModel->join("users", "users.id = user_datas.user_id", "left")->where("role", "operator")->countAllResults(),
        ]);
    }
}
