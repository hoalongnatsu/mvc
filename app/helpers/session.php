<?php
session_start();

function set_flash($name= '', $message= '') {
    if(!empty($name) && !empty($message)) {
        $_SESSION[$name] = $message;
    }
}

function flash($name) {
    if (isset($_SESSION[$name])) {
        echo $_SESSION[$name];
        unset($_SESSION[$name]);
    }
}