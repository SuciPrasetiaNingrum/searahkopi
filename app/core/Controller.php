<?php 
class Controller {
    public function view($view,$data = []){
        require_once '../app/views/home/navbar.php';
        require_once '../app/views/'. $view . '.php';
        require_once '../app/views/home/footer.php';
    }

    public function model($model){
        require_once('../app/models/'. $model . '.php');
        return new $model;
    }
}