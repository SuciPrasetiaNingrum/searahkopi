<?php
class Menu extends Controller{
    public function index(){
        $data['lists'] = $this->model('Menu_listing')->getAllList();
        $data['judul'] = 'MENU | Searah Kopi';
        $this->view('home/menu', $data);
    }
}
?>
