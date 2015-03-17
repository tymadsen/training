<?php

class Student extends CI_Model {

    //var $var = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    /**
	*
	*	Get all info for specified id/
	*
	*	@author Ty Madsen
	*	@since 12-May-2014
	*	@access public
	*/
	public function get_info($student_id = null)
	{
		if($student_id == NULL)
			throw new Exception('No student id passed in to get_info function on Student model');
		$query = $this->db->select('*')
				->from('student')
				->where('student_id',$student_id)
				->get();
				echo $query();
		$result = array();//$query->result_array();
		return $result;
	}
    //function function_name($input){}
}
?>