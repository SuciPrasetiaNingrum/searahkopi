<?php 
class Home extends Controller{
    public function index(){
        $data['lists'] = $this->model('Menu_listing')->getAllList();
        $data['userauth'] = $_SESSION['user'];
        $data['judul'] = 'Home';

        $this->view('home/index', $data);
    }

    public function addFavorite(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->model('Menu_listing')->addFavorite($_POST) > 0) {
                Flasher::setFlash('Item favorit ', 'ditambahkan', 'success');
                header('location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                Flasher::setFlash('Item favorit gagal ', 'ditambahkan', 'danger');
                header('location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
        }
    }
}