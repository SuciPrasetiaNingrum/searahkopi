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
        if (!isset($_SESSION['user'])) {
            echo json_encode(['success' => false, 'message' => 'User not logged in']);
            exit;
        }
    
        // Cek apakah ID telah dikirim melalui POST
        if (!isset($_POST['id'])) {
            echo json_encode(['success' => false, 'message' => 'No ID provided']);
            exit;
        }
    
        // Proses penghapusan favorite
        $rowCount = $this->model('Menu_listing')->deleteFavorite($_POST['id']);
        if ($rowCount > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
        exit;
    }
}
?>
