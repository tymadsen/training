<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Session extends CI_Session {

	function __construct(){
		parent:: __construct();
	}

	/**
	 * Fetch session message
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function message($key)
	{
		return $this->flashdata($key);
	}

	/**
	 * Add or change message
	 *
	 * @access	public
	 * @param	mixed
	 * @param	string
	 * @return	void
	 */
	function set_message($message = '', $msg_type = 'info', $type = 'fade')
	{
		$msg_types = array('error', 'success', 'warning', 'info', 'standard');
		$msg_type = in_array($msg_type, $msg_types) ? $msg_type : 'standard';
		$msg_type = "theme : '" . $msg_type . "'";
		$type = $type == "sticky" ? "sticky" : "fade";

		$msg = "";

		if($type === "fade")
			$msg = '$.jGrowl("'.$message.'", {'.$msg_type.'});';
		else if($type === "sticky")
			$msg = '$.jGrowl("'.$message.'", {sticky:true, '.$msg_type.'});';

		$this->set_flashdata('message', $msg);
	}


	
}
// END MY_Session Class

/* End of file MY_Session.php */
/* Location: ./application/core/libraries/MY_Session.php */