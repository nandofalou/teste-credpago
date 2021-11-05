<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController {

    public function __construct() {
        $this->model = new UserModel();
    }

    public function index() {

        return view('home/index');
    }

}
