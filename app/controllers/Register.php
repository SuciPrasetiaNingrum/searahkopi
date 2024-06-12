<?php
class Register extends Controller {
    public function index(){
        $data['judul'] = 'REGISTER | Searah Kopi';
        $this->view('auth/register', $data);
    }
    public function addUser(){
        $result = $this->model('User_model')->register($_POST);
        if ($result == 1) {
            Flasher::setFlash('register_success', 'Pendaftaran berhasil!', 'success');
            header('Location: ' . BASEURL . '/register');
        } 
        elseif($result == -2){
            Flasher::setFlash('Registrasi Gagal', 'Email Sudah Terdaftar!', 'warning');
            header('Location: ' . BASEURL . '/register');
        }
        else {
            Flasher::setFlash('register_failed', 'Pendaftaran gagal, coba lagi.', 'danger');
            header('Location: ' . BASEURL . '/register');
        }
    }
}

