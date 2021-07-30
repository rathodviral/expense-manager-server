<?php
class Token
{

    public function __construct()
    {
    }

    //C
    public function createToken($data)
    {
        define('SECRET_KEY', "aakar");
        /* Create a part of token using secretKey and other stuff */
        $tokenGeneric = SECRET_KEY . $_SERVER["SERVER_NAME"]; // It can be 'stronger' of course

        /* Encoding token */
        $token = hash('sha256', $tokenGeneric . $data);

        // return array('token' => $token, 'userData' => $data);
        return $token;
    }
}
