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

        return redirect()->to('/admin')->with('success', $post['first_name'] . ' ' . $post['last_name'] . ' added');
    }

    public function edit(int $id): string|RedirectResponse
    {
        $userModel = new UserModel();
        $userDataModel = new \App\Models\UserData();
        $user = $userModel->find($id)->toArray();
        $userData = $userDataModel->where('user_id', $id)->first()->toArray();

        if (empty($user) || empty($userData)) {
            return redirect()->to('/admin');
        }

        $operator = [];
        foreach ($user as $key => $item) {
            if ($key == 'password') continue;
            $operator[$key] = $item;
        }

        foreach ($userData as $key => $userDatum) {
            $operator[$key] = $userDatum;
        }

        return view('Operator/Edit', [
            'operator' => $operator,
        ]);
    }

    public function update(int $id): RedirectResponse
    {

        $post = $this->request->getPost();


        $userModel = new UserModel();
        $user = $userModel->find($id);
        if (empty($user)) {
            return redirect()->to('/admin');
        }

        if ($post['password'] != "default") {
            $post['password'] = UserEntity::hash($post['password']);
        } else {
            unset($post['password']);
        }

        $userDataModel = new \App\Models\UserData();
        $userData = $userDataModel->where('user_id', $user->id)->first();
        if (empty($userData)) {
            return redirect()->to('/admin');
        }

        $arr = [
            'email' => $post['email'],
            'first_name' => $post['first_name'],
            'last_name' => $post['last_name'],
            'nik' => $post['nik'],
            'username' => $post['username'],
        ];

        if (!empty($post['password'])) {
            $arr['password'] = UserEntity::hash($post['password']);
        }

        $user = $user->fill($arr);
        $userData = $userData->fill([
            'phone' => $post['phone'],
            'alamat' => $post['alamat'],
        ]);

        if (!$user->hasChanged() && !$userData->hasChanged()) {
            log_message("info", "No changes");
            return redirect()->to('/operator/edit/' . $id)->with('error', "No changes");
        }

        try {
            if ($user->hasChanged()) $userModel->update($id, $user);
            if ($userData->hasChanged()) $userDataModel->update($userData->id, $userData);
        } catch (\Exception $e) {
            log_message("error", $e->getMessage());
            return redirect()->to('/operator/edit/' . $id)->with('error', $e->getMessage());
        }

        return redirect()->to('/admin')->with("success", "Data updated");
    }

    public function delete(int $id): RedirectResponse
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);
        if (empty($user)) {
            return redirect()->to('/admin')->with('error', "Data not found");
        }
        $userModel->where("id", $id)->delete($id, true);
        return redirect()->to('/admin')->with("success", "Data deleted");
    }

    public function uploadImage($userId): bool|string|RedirectResponse
    {
        $session = session()->get("data");
        if ($session['role'] == "operator" && $session['id'] != $userId) {
            return json_encode([
                'success' => false,
                'message' => 'Unauthorized',
            ]);
        }
        try {
            $userDataModel = new \App\Models\UserData();
            $user = $userDataModel->find($userId);
            if (empty($user)) {
                return json_encode([
                    'success' => false,
                    'message' => 'Unauthorized',
                ]);
            }

            $image = $this->request->getFile('image');
            $relPath = 'uploads/' . $image->store();
            $user->image = $relPath;
            if ($user->hasChanged()) {
                $userDataModel->save($user);
            }

            return json_encode([
                'success' => true,
                'message' => 'Success',
            ]);

        } catch (\Exception $e) {
            log_message("error", $e->getMessage());
            return json_encode([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }

}
