<?php

class Photo extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function get_photos($user_id = NULL){
		if($user_id == NULL)
			throw new Exception('No user_id passed in to get_photos method of photo model');

		$query = $this->db->select('*')
				->from('photo')
				->where('user_id', $user_id)
				->get();
		
		$result = $query->result_array();

		return $result;
	}

	public function add_photo($user_id = NULL, $file = array()){
		if($user_id == NULL OR empty($file))
			throw new Exception('No user_id and/or invalid file passed in to add_photo method of photo model');

		$this->db->insert('photo', array('url' => $file['file_name'], 'user_id' => $user_id));
		$id = $this->db->insert_id();

		return $id;
	}
}

?>