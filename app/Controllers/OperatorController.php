<?php

namespace App\Controllers;

use App\Entities\UserEntity;
use App\Models\UserModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\RedirectResponse;

class OperatorController extends BaseController
{
    public function add(): string
    {
        return view('Operator/Add');
    }

    public function store(): RedirectResponse
    {

        try {

            $post = $this->request->getPost();

            // split email by @ get first part and add the number last 4 nik
            $username = substr($post['email'], 0, strpos($post['email'], '@')) . substr($post['nik'], -4);

            $userModel = new UserModel();
            $userEntity = new UserEntity([
                ...$post,
                'password' => UserEntity::hash($post['password']),
                'role' => 'operator',
                'username' => $username,
            ]);
            $userModel->save($userEntity);

            $userDataModel = new \App\Models\UserData();
            $userData = new \App\Entities\UserData([
                ...$post,
                'user_id' => $userModel->getInsertID(),
            ]);
            $userDataModel->save($userData);
        } catch (\Exception|DatabaseException $e) {
            log_message("error", $e->getMessage());
            return redirect()->to('/operator/add')->with('error', $e->getMessage());
        }

        return redirect()->to('/admin');
    }
}
