<?php
include "ChromePhp.php";
class Blog extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Usermodel');
		$this->load->model('Blogmodel');
		$this->load->model('Todomodel');
		$this->load->helper('form');
	}

	public function index(){
		//$this->load->helper('form');
		$this->load->view('login', array('message' => ''));
		// $data = [];
		// $data['todo_list'] = array('Clean House', 'Call Mom', 'Run Errands');
		// $data['title'] = "My New Title";
		// $data['heading'] = "My New Heading";
		// $data['query'] = $this->Blogmodel->get_last_ten_entries();
		// $this->load->view('blog', $data);
	} 

	public function comments(){

		// No echoes in controllers
		// echo 'Look at this!';
	}

	public function setcomments($comment){
		// echo $comment;
	}

	public function create_account(){
		$info = [];
		$info['firstname'] = $this->input->post('firstname');
		$info['lastname'] = $this->input->post('lastname');
		$info['username'] = $this->input->post('username');
		$info['password'] = $this->input->post('password');
		
		$errors = $this->Usermodel->create_account($info);
		$data = [];
		$data['message'] = "Test";
		if ($errors) {
		    $data['message'] = "Failed to add new user";
		    $this->load->view('new_user', $data);
		}else{
			$data['message'] = "New user added successfully";
			$this->load->view('login', $data);
		}
	}

	public function new_user(){
		$this->load->view('new_user', array('message' => ''));
	}

	public function login(){
		$user = [];

		$user['username'] = $this->input->post('username');
		$user['password'] = $this->input->post('password');
		// ChromePhp::log($user['username']);
		// ChromePhp::log($user['password']);
		if($this->Usermodel->login($user)){
			$user_data = array( 'user' 		=> $this->Usermodel->username,
								'firstname' => $this->Usermodel->firstname,
								'lastname' 	=> $this->Usermodel->lastname,
								'id' 		=> $this->Usermodel->id
							  );

			$this->session->set_userdata($user_data);
			$this->load_blog();
			// $data = [];
			// $data['todo_list'] = array('Clean House', 'Call Mom', 'Run Errands');
			// $data['title'] = "My New Title";
			// $data['heading'] = "My New Heading";
			// $data['entries'] = $this->Blogmodel->get_last_ten_entries();
			// $this->load->view('blog', $data);
		}
		else {
			$this->index();
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		$this->index();
	}

	public function getUserInfo(){
		//$this->load->model('User_model');
		$this->Usermodel->getUsername();
	}

	public function update(){
		
		$entry = [];
		$entry['title']   = $this->input->post('title'); // please read the below note
  		$entry['content'] = $this->input->post('content');
  		$entry['user_id'] = $this->session->userdata('id');
		
		if($entry['title'] != '' && $entry['content'] != '')
			$this->Blogmodel->insert_entry($entry);
		$this->load_blog();
		//$data['query'] = $this->Blog->get_last_ten_entries();
		
	}

	public function add_task(){
		$todo = [];
		$todo['user_id'] = $this->session->userdata('id');
		$todo['item']   = $this->input->post('item');
  		
  		if($todo['item'] != '')
			$this->Todomodel->insert_todo($todo);
		$this->load_blog();
	}

	public function load_blog(){
		$data = [];
		$data['todo_list'] = $this->Todomodel->get_all($this->session->userdata('id'));
		$data['firstname'] = $this->session->userdata('firstname');
		$data['lastname'] = $this->session->userdata('lastname');
		$data['title'] = "My New Title";
		$data['heading'] = "My New Heading";
		$data['entries'] = $this->Blogmodel->get_last_ten_entries($this->session->userdata('id'));
		$this->load->view('blog', $data);
	}
}
?>