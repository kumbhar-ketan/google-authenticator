<?php
@session_start();
require 'autoload.php';
if(isset($_POST['email'])){
    $email = $_POST['email'];
    $code = $_POST['code'];
    $secret = isset($_SESSION['secret']) ? $_SESSION['secret'] : '';
    $auth = new Authenticate();
    $result = $auth->verifyCode($secret,$email,$code);
    if($result){
        echo json_encode(['status' => 'success']);
    }else{
        echo json_encode(['status' => 'error']);
    }
}else{
    echo 'error';
}