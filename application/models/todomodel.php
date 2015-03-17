<?php
class Todomodel extends CI_Model{

	var $user_id = -1;
	var $item = '';

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function insert_todo($todo = null){

		$this->user_id = $todo['user_id'];
    	$this->item = $todo['item'];

        $this->db->insert('todos', $this);
        //return "success";    
    }	

    function get_all($id = -1){
    	$query = $this->db->get_where('todos', array('user_id' => $id));
        return $query->result();
    }
}

?>