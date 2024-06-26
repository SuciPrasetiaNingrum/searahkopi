<?php 
class Login extends Controller{
    public function index(){
        $data['judul'] = 'LOGIN | Searah Kopi';
        $this->view('components/navbar', $data);
        $this->view('auth/login', $data);
        $this->view('components/footer', $data);
    }
    public function authenticate(){

        $user = $this->model('User_model')->login($_POST['email'], $_POST['password']);
         
        if ($user) {
            Flasher::setFlash('Login', 'successful', 'success');
            $_SESSION['user'] = $user;
            $_SESSION['last_activity'] = time();
            header('Location: ' . BASEURL . 'home');
        } else {

            Flasher::setFlash('Login Gagal', 'Password atau email salah.', 'danger');
            header('Location: ' . BASEURL . 'login');
        }
        exit;
    }
}