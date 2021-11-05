<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController {

    public function __construct() {
        $this->model = new UserModel();
    }

    public function signin() {
        return view('user/signin');
    }

    public function login() {

        $user = $this->model->login($this->request->getPost('email'), $this->request->getPost('pass'));

        if (!empty($user)) {
            $this->sessionUser->setUser($user);
            return redirect()->to(base_url());
        } else {
            $this->sessionUser->setFlashdata('error', 'Usuário ou senha incorretos');
            return redirect()->to('/signin');
        }
    }

    public function logout() {
        $this->sessionUser->clearUser();
        return redirect()->to('/signin');
    }

}
