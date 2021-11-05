<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController {

    public function __construct() {
        $this->model = new UserModel();
    }

    public function index() {

# criar usuario
//        $this->model->insert(
//                [
//                    'name' => 'Fernando Almeida',
//                    'email' => 'nando.falou@gmail.com',
//                    'pass' => '123456',
//                    'hash' => null,
//                ]
//        );
# validar usuário
        $user = $this->model->login('nando.falou@gmail.com', '123456');
        //dd($this->model->findAll());
        dd($user);
//return view('welcome_message');
    }

}
