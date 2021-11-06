<?php

if (!function_exists('get_gravatar_url')) {

    function get_gravatar_url($email) {
        $email = md5(strtolower(trim($email)));
        $user_gravatar_url = 'https://www.gravatar.com/avatar/' . md5($email) . '.jpg?s=80&r=pg';
        return $user_gravatar_url;
    }

}
