<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class registerapi extends REST_Controller {



	public function register()
	{
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|max_length[256]');
		$this->form_validation->set_rules('password', 'password', 'required');
		return Validation::validate($this, '', '', function($token, $output)
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$id = [$email, $password];
			$token = array();
			$token['id'] = $id;
			$output['status'] = true;
			$output['email'] = $email;
			$output['token'] = JWT::encode($token,$email, $this->config->item('jwt_key'));
			$id2 = $this->Users->register($email, $password,$output['token']);
			// $id2 = $this->Users->register($email, $password,	$output['token'] );
			return $output;
		}
		);
	}

    function AkunAdmin() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id = $this->input->post('id');
				if ($id == '') {
					$customer = $this->db->get('admin')->result_array();
				} else {
					$this->db->where('id', $id);
					$customer = $this->db->get('admin')->result_array();
				}
			
				$output = $customer;
				return $output;
			}
        });
    }
        
	// public function permissions()
	// {
	// 	$this->form_validation->set_rules('resource', 'resource', 'required');
	// 	return Validation::validate($this, 'user', '', function($token, $output)
	// 	{
	// 		$resource = $this->input->post('resource');
	// 		$acl = new ACL();
	// 		$permissions = $acl->userPermissions($token->id, $resource);
	// 		$output['status'] = true;
	// 		$output['resource'] = $resource;
	// 		$output['permissions'] = $permissions;
	// 		return $output;
	// 	});
	// }

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */