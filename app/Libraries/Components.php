<?php

namespace App\Libraries;

use App\Libraries\AuthUser;

/**
 * Library components for view
 *
 * @author fernando<nando.falou@gmail.com>
 */
class Components {

    private $sessionUser;

    public function menuClient() {
        $this->sessionUser = new AuthUser();
        $user = $this->sessionUser->getUser();
        $gravatar = get_gravatar_url($user->email);
        return "<a href=\"#\" class=\"d-block link-dark text-decoration-none dropdown-toggle\" id=\"dropdownUser1\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                    <img src=\"{$gravatar}\" alt=\"mdo\" width=\"32\" height=\"32\" class=\"rounded-circle\">
                </a>
                <ul class=\"dropdown-menu text-small shadow\" aria-labelledby=\"dropdownUser2\">
                    <li class=\"dropdown-item\" >{$user->name}</li>
                    <li class=\"dropdown-item\" >{$user->email}</li>
                    <li><hr class=\"dropdown-divider\"></li>
                    <li><a class=\"dropdown-item\" href=\"<?php echo base_url('logout'); ?>\">Sair</a></li>
                </ul>";
    }

}
