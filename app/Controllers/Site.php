<?php

namespace App\Controllers;

use App\Models\UrlStateModel;
use App\Libraries\LibHttpTracing;
use CodeIgniter\API\ResponseTrait;

class Site extends BaseController {

    use ResponseTrait;

    private $libtracing;

    public function __construct() {
        $this->model = new UrlStateModel();
        $this->libtracing = new LibHttpTracing();
    }

    public function index() {
        return view('home/index');
    }

    public function site() {
        $data = (object) [
                    'id' => null,
                    'url' => null,
        ];
        return view('home/site', ['site' => $data]);
    }

    public function view($id) {
        $track = $this->model->find($id);

        if (empty($track)) {
            $this->sessionUser->setFlashdata('error', "url inválida");
            return redirect()->to('/');
        }

        return view('home/site', ['site' => $track]);
    }

    public function remove($id) {
        $track = $this->model->find($id);

        if (empty($track)) {
            $this->sessionUser->setFlashdata('error', "url inválida");
            return redirect()->to('/');
        }

        if ($this->model->delete($id)) {
            $this->sessionUser->setFlashdata('success', "Url `{$track->url}` excluida com sucesso");
            return redirect()->to('/');
        } else {
            $this->sessionUser->setFlashdata('error', "Ocorreu um erro ao excluir url");
            return redirect()->to('site/' . $id);
        }
    }

    public function addsite() {
        $url = trim($this->request->getPost('url'));

        if (!validate_url($url)) {
            $this->sessionUser->setFlashdata('error', "A url `{$url}` é inválida");
            return redirect()->to('site');
        }

        $rs = $this->model->where('url', $url)->first();
        if (!empty($rs)) {
            $this->sessionUser->setFlashdata('error', "A url `{$url}` já está cadastrada");
            return redirect()->to('site');
        }

        $data = [
            'user_id' => $this->sessionUser->getUserId(),
            'url' => $url,
            'status_code' => null,
        ];

        $id = $this->model->insert($data);
        if ($id) {
            // $this->processaSite($id);
            $this->sessionUser->setFlashdata('success', "Url `{$url}` cadastrada com sucesso");
            return redirect()->to('/');
        } else {
            $this->sessionUser->setFlashdata('error', "Ocorreu um erro ao cadastrar url");
            return redirect()->to('site');
        }
    }

    public function editsite($id) {
        $track = $this->model->find($id);

        if (empty($track)) {
            $this->sessionUser->setFlashdata('error', "url inválida");
            return redirect()->to('/');
        }

        $url = trim($this->request->getPost('url'));
        if (!validate_url($url)) {
            $this->sessionUser->setFlashdata('error', "A url `{$url}` é inválida");
            return redirect()->to('site/' . $id);
        }

        $rs = $this->model->where(['url' => $url, 'id<>' => $id])->first();
        if (!empty($rs)) {
            $this->sessionUser->setFlashdata('error', "A url `{$url}` já está cadastrada");
            return redirect()->to('site/' . $id);
        }

        $data = [
            'user_id' => $this->sessionUser->getUserId(),
            'url' => $url,
            'status_code' => null,
        ];

        if ($this->model->update($id, $data)) {
            // $this->processaSite($id);
            $this->sessionUser->setFlashdata('success', "Url `{$url}` atualizada com sucesso");
            return redirect()->to('/');
        } else {
            $this->sessionUser->setFlashdata('error', "Ocorreu um erro ao atualizar url");
            return redirect()->to('site/' . $id);
        }
    }

    public function track() {
        $track = $this->model->list();
        $data = [];
        foreach ($track as $k => $v) {
            $linkEdit = base_url() . "/site/{$v->id}";
            $btg = "<a href=\"{$linkEdit}\" class=\"btn btn-sm btn-primary\" data-site=\"{$v->id}\"  data-toggle=\"tooltip\" data-placement=\"top\" title=\"Editar\" ><i class=\"bi bi-pencil-square\"></i></a> ";
            $groupButton = "<div class=\"btn-group\" role=\"group\">{$btg}</dvi>";
            $data[] = (object) [
                        'id' => $v->id,
                        'url' => $v->url,
                        'status' => (string) $v->status_code,
                        'updated' => date('d/m/Y H:i:s', strtotime($v->updated_at)),
                        'user' => $v->username,
                        'btn' => $groupButton
            ];
        }
        return $this->respond($data, 200);
    }

    private function processaSite($id) {
        $url = $this->model->find($id);
        if (!empty($url) && $this->libtracing->trackSite($url->url)) {
            $this->model->update($url->id, [
                'status_code' => $this->libtracing->getStatusCode(),
                'response' => $this->libtracing->getContent(),
            ]);
        }
    }

}
