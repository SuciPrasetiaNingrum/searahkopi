<?php 
class Home extends Controller{
    public function index(){
        $data['lists'] = $this->model('Menu_listing')->getAllList();
        $data['judul'] = 'Home';
        $this->view('home/index', $data);
    }
}