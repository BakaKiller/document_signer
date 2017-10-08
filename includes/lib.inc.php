<?php

function is_logged_in() {
    return (isset($_SESSION['isloggedin']) && $_SESSION['isloggedin'] == true);
}

function get_user() {
        return (is_logged_in() ? $_SESSION['user'] : false);
}

function redirect($url, $message = false) {
    $sign = strstr($message, '?') ? '&' : '?';
    header('Location: ' . $url . ($message ? $sign . 'notif=' . urlencode($message) : ''));
}

function print_object($object) {
    echo '<pre>' . print_r($object, true) . '</pre>';
}