<?php
class Authenticate{
    public function verifyCode($secret,$email,$code){
        $ga = new GoogleAuthenticator();
        $status = $ga->verifyCode($secret, $code);
        return $status;
    }

    public function generateCode($email){
        $ga = new GoogleAuthenticator();
        $secret = $ga->createSecret();
        $_SESSION['secret'] = $secret;
        $codeUrl = $ga->getQRCodeGoogleUrl($email, $secret);
        return $codeUrl;
    }
}