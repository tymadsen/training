<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apps extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
	}

	public function _remap($method,$params)
	{
		if($method != 'index')
 			$this->index($method, $params);
		else
			$this->index('', $params);
	}

	// public function index($method = '', $params = array())
	// {

	// 	$config =& get_config();
	// 	$base_url = $config['base_url'];
	// 	$site_url = $config['site_url'];

	// 	$data['base_url'] = $base_url;
	// 	$data['site_url'] = $site_url;
	// 	$data['params'] = array();
	// 	if(!empty($params))
	// 		$data['params'] = $params;
		
	// 	if(method_exists($this, $method))
	// 		$this->$method($data);
	// 	else
	// 		$this->load->view('home',$data);
	// }

	/**
	*
	*	Load Final Project 8, 9 and 10
	*	@author Ty Madsen
	*	@since	09-May-2014
	*	@access public
	*/
	public function index($data)
	{
		$config =& get_config();
		$base_url = $config['base_url'];
		$site_url = $config['site_url'];

		$data['base_url'] = $base_url;
		$data['site_url'] = $site_url;

		$data['css'] = array('signin','bootstrap.min');
		$data['js'] = array('bootstrap.min');
		
		$this->load->view('header', $data);
		$this->load->view('apps/signin', $data);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */