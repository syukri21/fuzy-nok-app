<?php

namespace App\Controllers;

use App\Models\UserData;
use CodeIgniter\HTTP\RedirectResponse;

class Home extends BaseController
{
  public function index(): RedirectResponse|string
  {
    $data = session()->get('data');
    if (empty($data)) {
      return redirect()->to('/login');
    }

    $userDataModel = new UserData();
    $userData = $userDataModel->where("user_id", $data['id'])->first();

    return view('Home/Home', [
      'userData' => $userData,
      'user' => $data,
      'title' => "NOK"
    ]);
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

  public function ppicHome(): string
  {
    $page = $this->request->getGet('page_operator');
    if (!isset($page)) {
      $page = 1;
    }
    $userModel = new  UserData();
    $perPage = 20;
    $paginate = $userModel->join('users', 'users.id = user_datas.user_id')->where("role", "operator")->orderBy("first_name", "ASC")->paginate($perPage, 'operator', $page);
    return view('Home/PPICHome', [
      'title' => "PPIC Dashboard",
      'data' => $paginate,
      'pager' => $userModel->pager,
      'perPage' => $perPage,
      'page' => $page,
      'count' => $userModel->join("users", "users.id = user_datas.user_id", "left")->where("role", "operator")->countAllResults(),
    ]);
  }
}
