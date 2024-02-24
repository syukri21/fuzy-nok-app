<?php


namespace App\Controllers;


use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Login extends BaseController
{
    public function index(): string
    {
        return view('Login/Login');
    }


    public function login(): RedirectResponse
    {
        $userModel = new UserModel();
        $post = $this->request->getPost(['username', 'password']);
        log_message("info", print_r($post, true));
        try {
            $userEntity = $userModel->login($post['username'], $post['password']);
            return redirect()->to('/home')->with('user', $userEntity->toArray());
        } catch (\ValidationException $e) {
            log_message("error", $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}