<?php
class Keranjang extends Controller
{

    public function index()
    {
        if(isset($_SESSION['user'])){
            $data['userauth'] = $_SESSION['user'];
            $data['lists'] = $this->model('Menu_listing')->getAllOrderedItemByUserID($data['userauth']['id']);
            $data['judul'] = 'Keranjang';
            $this->view('components/navbar', $data);
            $this->view('home/keranjang', $data);
            $this->view('components/footer', $data);
        }else{
            header('location: ' . BASEURL . 'login');
        }
       
    }
    public function addItem()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->model('Menu_listing')->addItem($_POST) > 0) {
                Flasher::setFlash('Item berhasil ', 'ditambahkan', 'success');
                header('location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                Flasher::setFlash('Item gagal ', 'ditambahkan', 'danger');
                header('location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
        }
    }

    public function addPayment(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->model('Menu_listing')->addPayment($_POST) > 0) {
                Flasher::setFlash('Transaksi berhasil silahkan Bayar', '', 'success');
                header('location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                Flasher::setFlash('Transaksi Gagal ', '', 'danger');
                header('location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
        }
    }
    
    public function hapusItem($id){
        if($this->model('Menu_listing')->hapusItem($id) > 0){
            Flasher::setFlash('Item berhasil ', 'dihapus', 'success');
            header('location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
}
