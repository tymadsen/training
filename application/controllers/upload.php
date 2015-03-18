<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('photo');
	}

	public function do_upload($user_id = NULL)
	{
		if($user_id == NULL)
			throw new Exception('No user_id passed in to do_upload function of upload controller.');
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= '600000';
		$config['max_width']  = '2048';
		$config['max_height']  = '2048';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$this->session->set_message($this->upload->display_errors(), 'error');
			// var_dump($error);
			redirect("training/photoviewer");
		}
		else
		{
			$this->session->set_message('Image succcessfully uploaded!', 'success');
			// $data = array('upload_data' => $this->upload->data());
			$data = $this->upload->data();

			$this->photo->add_photo($user_id, $data);

			redirect("training/photoviewer");
		}
	}
}

/* End of file upload.php */
/* Location: ./application/controllers/upload.php */