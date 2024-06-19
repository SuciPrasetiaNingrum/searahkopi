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

    
}
?>
