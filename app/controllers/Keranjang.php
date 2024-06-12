<?php
class Keranjang extends Controller
{

    public function addItem()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->model('Menu_listing')->addItem($_POST) > 0) {
                Flasher::setFlash('Item berhasil ', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . 'home');
                exit;
            } else {
                Flasher::setFlash('Item gagal ', 'ditambahkan', 'danger');
                header('Location: ' . BASEURL . 'home');
                exit;
            }
        }
    }

    public function index()
    {
        $data['lists'] = $this->model('Menu_listing')->getAllOrderedItems();
        $data['judul'] = 'Keranjang';
        $this->view('home/keranjang', $data);
    }
}
