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

    public function signup() {
        return view('user/signup');
    }

    public function register() {
        $data = [
            'email' => trim($this->request->getPost('email')),
            'name' => trim($this->request->getPost('name')),
            'pass' => trim($this->request->getPost('pass')),
        ];

        if ($this->model->save($data) === false) {
            $vErro = $this->model->errors();
            $this->sessionUser->setFlashdata('error', $vErro);
            return redirect()->to('/signup');
        } else {
            $user = $this->model->login($this->request->getPost('email'), $this->request->getPost('pass'));
            $this->sessionUser->setUser($user);
            return redirect()->to(base_url());
        }
    }

    public function passwordrecovery() {
        return view('user/passwordrecovery');
    }

    public function sendpasswordrecovery() {
        $email = trim($this->request->getPost('email'));

        $user = $this->model->where('email', $email)->first();
        if (empty($user)) {
            $this->sessionUser->setFlashdata('error', 'e-mail não cadastrado!');
            return redirect()->to('/passwordrecovery');
        } else {
            $hash = $this->model->createHash($user->id);
            return view('user/hash', ['user' => $user, 'hash' => $hash]);
        }
    }

    public function resetpassword($hash) {

        if (empty($hash)) {
            $this->sessionUser->setFlashdata('error', 'Link inválido!');
        }

        $user = $this->model->where('hash', $hash)->first();

        if (empty($user)) {
            $this->sessionUser->setFlashdata('error', 'Link inválido!');
            return redirect()->to('/signup');
        } else {
            return view('user/changepass', ['user' => $user, 'hash' => $hash]);
        }
    }

    public function changepassword($hash) {
        $user = $this->model->where('hash', $hash)->first();
        if (empty($user)) {
            $this->sessionUser->setFlashdata('error', 'Link inválido!');
            return redirect()->to('/signup');
        }

        $data = [
            'id' => $user->id,
            'pass' => trim($this->request->getPost('pass')),
            'hash' => null,
        ];
        if ($this->model->save($data) === false) {
            $vErro = $this->model->errors();
            $this->sessionUser->setFlashdata('error', $vErro);
            return redirect()->to('/resetpassword/' . $hash);
        } else {
            $this->sessionUser->setFlashdata('success', 'Senha alterada com sucesso');
        }
        return redirect()->to('/signin');
    }

    public function logout() {
        $this->sessionUser->clearUser();
        return redirect()->to('/signin');
    }

}
