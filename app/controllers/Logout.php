<?php
class Logout extends Controller {

    public function index() {
        session_start();
        session_unset();
        session_destroy();
        header('location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
