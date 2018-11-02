<?php
@session_start();
require 'autoload.php';
if(isset($_POST['email'])){
    $email = $_POST['email'];
    $auth = new Authenticate();
    $codeUrl = $auth->generateCode($email);
    echo json_encode(['url' => $codeUrl]);
}else{
    echo 'error';
}