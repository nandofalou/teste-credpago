<?php

namespace App\Controllers;

set_time_limit(0);

use App\Libraries\LibHttpTracing;
use CodeIgniter\API\ResponseTrait;

class Home extends BaseController {

    use ResponseTrait;

    private $libtracing;

    public function __construct() {
        $this->libtracing = new LibHttpTracing();
    }

    public function index() {
        return view('home/index');
    }

    public function sync() {
        $url = new \App\Models\UrlStateModel();
        foreach ($url->findAll() as $k => $v) {

            if ($this->libtracing->trackSite($v->url)) {
                $url->update($v->id, [
                    'status_code' => $this->libtracing->getStatusCode(),
                    'response' => (string) $this->libtracing->getContent(),
                ]);
            }
        }

        return $this->respond('ok', 200);
    }

}
