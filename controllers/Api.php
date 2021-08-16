<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('AuthModel','AM');
    }
	public function login()
    {
        $jwt = new JWT();
        $JwtSecretKey = 'mysecretetoken';

        $email      = trim($this->input->post('email'));
        $password   = trim($this->input->post('password'));
        $token      = $this->input->post('token');
        
        if($this->Authcheck($token,$email,$password) == true){
            $check_login = $this->AM->check_login($email, $password);

            if($check_login != true){
                $response['status'] = 'success';
                $response['message'] = 'No record found';
            }else{
                $response['status'] = 'success';
                $token = $jwt->encode($check_login, $JwtSecretKey, 'HS256');
                $response['token'] = $token;
                $response['message'] = 'Login Successfully';
            }
        }else{
            $response['status'] = 'error';
            $response['message'] = 'Login Invalid';
        }
        echo json_encode($response);
    }

    public function registration(){
        $email      = trim($this->input->post('email'));
        $firstname  = trim($this->input->post('first_name'));
        $middlename = trim($this->input->post('middle_name'));
        $lastname   = trim($this->input->post('last_name'));
        $password   = trim($this->input->post('password'));
        
        if($this->validate_email($email) == false){
            $response['email_error'] = 'Invalid email ID';
        }
        if($this->password_expression($password) == false){
            $response['password_error'] = '%s must be at least 6 characters and must contain at least one lower case letter, one upper case letter and one digit';
        }
        if($firstname == ''){
            $response['firstname_error'] = 'First name is required';
        }

        if($this->validate_email($email) == true && $this->password_expression($password) ==true &&  $firstname != ''){
            $data = array(
                'email'      => $email,
                'first_name'  => $firstname,
                'middle_name' => $middlename,
                'last_name'   => $lastname,
                'password'   => $password
            );
            $response['message'] = $this->AM->data_insert($data)!=0?'You have been Registered':'Please try again';
        }
        $response['status'] = 'success';
        echo json_encode($response);
    }

    public function password_expression($password)
    {
        if (1 !== preg_match("/^.*(?=.{6,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $password)){
                return false;
        }else
        {
            return TRUE;
        }
    }
    public function Authcheck($token,$email,$password)
    {
        $jwt = new JWT();
        $JwtSecretKey = 'mysecretetoken';
        $decode_token = $jwt->decode($token, $JwtSecretKey, 'HS256');
        if($decode_token->email==$email && $decode_token->password==$password){
            return true;
        }else{
            return false;
        }
    }
    public function validate_email($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == true) {
            return $this->AM->duplicate_check(array('email',$email));
        }else{
            return  false;
        }
    }
}
