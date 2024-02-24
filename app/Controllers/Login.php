<?php


namespace App\Controllers;


use App\Models\UserModel;

class Login extends BaseController
{
    public function index(): string
    {
        return view('Login/Login');
    }


    public function login()
    {
        $userModel = new UserModel();
        $post = $this->request->getPost(['username', 'password']);
        try {
            $userEntity = $userModel->login($post['username'], $post['password']);
            return redirect()->to('/home')->with('user', $userEntity->toArray());
        } catch (\ValidationException $e) {
            log_message("error", $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}