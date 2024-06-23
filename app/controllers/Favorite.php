<?php
class Favorite extends Controller{
    public function index(){
        if(isset($_SESSION['user'])){
            $data['judul'] = 'FAVORITE | Searah Kopi';
            $data['userauth'] = $_SESSION['user'];
            $data['lists'] = $this->model('Menu_listing')->getAllFavorite($data['userauth']['id']);
            $this->view('home/favorite', $data);
        }else{
            header('location: ' . BASEURL . 'login');
        }
      
    }

    public function delete(){
        // Cek apakah user sudah login
        if (isset($_SESSION['user'])) {
            $rowCount = $this->model('Menu_listing')->deleteFavorite($_POST);
            if ($rowCount > 0) {
                Flasher::setFlash('Item favorit ', 'dihapus', 'success');
                header('location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                Flasher::setFlash('Item favorit ', 'gagal dihapus', 'warning');
                header('location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
            exit;
        }else{
            header('location: ' . BASEURL . 'login');
        }
    
       
    }
}
?>
