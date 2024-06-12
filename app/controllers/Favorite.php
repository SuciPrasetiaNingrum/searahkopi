<?php
class Favorite extends Controller{
    public function index(){
        $data['lists'] = $this->model('Menu_listing')->getAllList();
        $data['judul'] = 'FAVORITE | Searah Kopi';
        $this->view('home/favorite', $data);
    }
}
?>
