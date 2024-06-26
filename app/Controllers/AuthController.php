<?php


namespace App\Controllers;


use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class AuthController extends BaseController
{
  public function index(): string
  {
    return view('Login/Login');
  }

  public function login(): RedirectResponse
  {
    $userModel = new UserModel();
    $post = $this->request->getPost(['nik', 'password']);
    log_message("info", print_r($post, true));
    try {
      $userEntity = $userModel->login($post['nik'], $post['password']);
      if ($userEntity->role == "admin") {
        return redirect()->to('/admin')->with('user', $userEntity->toArray());
      } else if ($userEntity->role == "ppic") {
        return redirect()->to('/ppic')->with('user', $userEntity->toArray());
      } else if ($userEntity->role == "operator") {
        return redirect()->to('/home')->with('user', $userEntity->toArray());
      } else {
        throw new \InvalidArgumentException("Role tidak ditemukan");
      }
    } catch (\Exception $e) {

      $message = "username / password salah";
      log_message("error", $e->getMessage());
      session()->setFlashdata('error', $message);
      return redirect()->back()->with('error', $message);
    }
  }

  public function logout(): RedirectResponse
  {
    $userModel = new UserModel();
    $userModel->logout();
    return redirect()->to("/login");
  }
}

