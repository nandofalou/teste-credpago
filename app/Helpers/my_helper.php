<?php

if (!function_exists('get_gravatar_url')) {

    function get_gravatar_url($email) {
        $email = md5(strtolower(trim($email)));
        $user_gravatar_url = 'https://www.gravatar.com/avatar/' . md5($email) . '.jpg?s=80&r=pg';
        return $user_gravatar_url;
    }

}

if (!function_exists('validate_url')) {

    function validate_url($url) {

        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return true;
        }
        return false;
    }

}

if (!function_exists('validate_email')) {

    function validate_email($email) {
        if (empty($email))
            return false;

        $pattern = "/^(('[\w\-\s]+')|([\w\-]+(?:\.[\w\-]+)*)|('[\w\-\s]+')([\w\-]+(?:\.[\w\-]+)*))(@((?:[\w\-]+\.)*\w[\w\-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i";
        if (!preg_match($pattern, $email))
            return false;
        $dominio = explode('@', $email);

        return checkdnsrr(array_pop($dominio), "MX");
    }

}