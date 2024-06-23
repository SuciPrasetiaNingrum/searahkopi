<?php
class Menu extends Controller{
    public function index(){
        $data['judul'] = 'Menu';
        $data['userauth'] = $_SESSION['user'];
        $data['lists'] = $this->model('Menu_listing')->getAllList();
       
        $this->view('components/navbar', $data);
        $this->view('home/menu', $data);
        $this->view('components/footer', $data);
    }
}
?>
