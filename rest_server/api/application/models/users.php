<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model {

    
	public function register($email, $password,$token)
	{
		$this->db->set('email',  $email);
		$this->db->set('password',password_hash($password, PASSWORD_DEFAULT));
		$this->db->set('token',  $token);
		$this->db->insert('admin');
	}

	
}

/* End of file users.php */
/* Location: ./application/models/users.php */