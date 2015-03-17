<?php 

class Page extends CI_Controller {

	public function index(){

		$data['page_title'] = 'My page';
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('content', $data);
		$this->load->view('footer');
		
	}

}

?>