<?php

namespace App\Libraries;

class AuthUser {

    private $session;
    private $user;

    public function __construct() {
        $this->session = \Config\Services::session();
    }

    public function setUser($login) {
        $this->modelUser();
        if (is_object($login)) {
            if (property_exists($login, 'id')) {
                $this->user->id = $login->id;
            }
            if (property_exists($login, 'name')) {
                $this->user->name = $login->name;
            }
            if (property_exists($login, 'email')) {
                $this->user->email = $login->email;
            }

            $this->user->last_login = date('Y-m-d H:i:s');
        }
        $this->session->set('user', $this->user);
    }

    public function clearUser() {
        $this->session->destroy();
        $this->modelUser();
    }

    public function getUser() {
        if ($this->logged()) {
            return (object) $this->session->get('user');
        }
        return null;
    }

    public function logged() {
        $user = $this->session->get('user');
        if (!empty($user) && is_object($user) && property_exists($user, 'id') && !empty($user->id)) {
            return true;
        }
        return false;
    }

    public function setFlashdata($type, $message) {
        $this->session->setFlashdata($type, $message);
    }

    private function modelUser() {
        $this->user = (object) [
                    "id" => null,
                    'name' => null,
                    'email' => null,
        ];
    }

}
