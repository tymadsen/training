<?php

class Usermodel extends CI_Model {

	var $id = -1;
	var $firstname = "";
	var $lastname = "";
	var $username = "";

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function create_account($info){
		
        $password = crypt($info['password']);
        $data = $info;
        $data['password'] = $password;
        $this->db->insert('user', $data);
        // echo($this->db->last_query());
        return !empty($this->db->_error_message());
	}

	public function login($user){
		$exists = false;
        $uname 	= $user['username'];
        $pword 	= $user['password'];

        $query = $this->db->get_where('user', array('username' => $uname));

        // echo($this->db->last_query());
        if($query->num_rows() > 0){

        	$data 		= $query->result()[0];
        	$enc_pword 	= $data->password;

	        if($enc_pword == crypt($pword, $enc_pword)){
	        	$exists = true;
	        	//Clear user data if set
	        	$this->session->unset_userdata(array(
			        	'user_id' => '',
			        	'firstname' => '',
			        	'lastname' => '',
			        	'username' => '',
			        	'logged_in' => '',
			        	'account' => ''
	        		));
	        	$new_data = array(
			        	'user_id' => $data->id,
			        	'firstname' => $data->firstname,
			        	'lastname' => $data->lastname,
			        	'username' => $data->username,
			        	'logged_in' => TRUE
	        		);
	        	$this->session->set_userdata(array('account' => $new_data));
	        }	
        }
        return $exists;
	}

	public function get_user(){
		return $this;
	}
}

?>