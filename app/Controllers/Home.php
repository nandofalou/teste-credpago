<?php

namespace App\Controllers;

use App\Libraries\LibHttpTracing;

class Home extends BaseController {

    public function __construct() {
        $this->track = new LibHttpTracing();
    }

    public function index() {
        $user = $this->sessionUser->getUser();
        $url = ['https://www.cloudid.com.br', 'https://pidasde.com.br', 'https://pida.com.br', 'https://getbootstrap.com'];
//        foreach ($url as $value) {
//            $rs = $this->track->trackSite($value);
//            d($this->track->getContent());
//            d($this->track->getStatusCode());
//        }
//        //$rs = $this->track->trackSite($url);
//        d($rs);
//        dd('');
        return view('home/index');
    }

}
