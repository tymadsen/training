<?php

class State extends CI_Model {

    //var $var = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    /**
	*
	*	Get all states/
	*
	*	@author Ty Madsen
	*	@since 12-May-2014
	*	@access public
	*/
	public function get_all()
	{
		$query = $this->db->select('*')
				->from('state')
				->get();
				// var_dump($query);
		$result = $query->result_array();
		// var_dump($result);
		return $result;
	}
    //function function_name($input){}
}
?>