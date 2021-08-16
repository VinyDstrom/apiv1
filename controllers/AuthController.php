<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

	public function index()
    {
        echo 'Auth_controller';
    }

    public function token(){
        $jwt = new JWT();

        $JwtSecretKey = '';
        $data = array(
            'userId' => 145,
            'email' => 'test@gmail.com',
            'userType' => 'admin'
        );

        $token = $jwt->encode($data, $JwtSecretKey, 'HS256');
        echo $token;
    }

    public function decode_token(){
        $token = $this->input->post('token');
        // $token = $this->uri->segment(2);

        $jwt = new JWT();

        $JwtSecretKey = '';
        $decode_token = $jwt->decode($token, $JwtSecretKey, 'HS256');
        echo "<pre>";
        print_r($decode_token);

        $token1 = $jwt->jsonEncode($decode_token);
        echo $token1;
    }
}
