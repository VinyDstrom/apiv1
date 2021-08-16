<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

	public function check_login($email, $password)
    {
        $query = $this->db->select('password')->from('users')->where('email',$email)->get();
        if($query->num_rows() > 0){
            $pass_check = $query->row()->password;
            if($pass_check == $password){
                return $this->db->select('*')->from('users')->where('email',$email)->get()->row_array();
            }else{
                return false;    
            }
        }else{
            return false;
        }
    }
    
    public function duplicate_check($email){
        $this->db->select('*')->from('users')->where($email);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return false;
        }else{
            return true;
        }
    }
    public function data_insert($data){
        $this->db->insert('users', $data);
        return $this->db->affected_rows();
    }
}
