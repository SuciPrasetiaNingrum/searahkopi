<?php
// if(!session_id()) session_start();
session_start();

$max_duration = 1800; //30 Menit Session Time

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $max_duration)) {
    session_unset();     
    session_destroy();   
    header('Location: ' . BASEURL . 'login');
    exit;
}

$_SESSION['last_activity'] = time(); 
require_once '../app/init.php';
$app = new App;