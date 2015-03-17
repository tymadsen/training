<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Training extends CI_Controller {


	public function __construct(){
		parent::__construct();
	}

	public function _remap($method,$params)
	{	
		// var_dump($method);
		// var_dump($params);
		if($method != 'index')
 			$this->index($method, $params);
		else
			$this->index('', $params);
		// if(method_exists($this,$method))
		// {
		// 	$this->$method($data);
		// }
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	// var $config = array();	
	public function index($method = '', $params = array())
	{

		$config =& get_config();
		$base_url = $config['base_url'];
		$site_url = $config['site_url'];

		$data['base_url'] = $base_url;
		$data['site_url'] = $site_url;
		$data['params'] = array();
		if(!empty($params))
			$data['params'] = $params;
		
		if(method_exists($this, $method))
			$this->$method($data);
		else
		{
			$this->load->view('home',$data);
		}
	}

	/**
	*
	*	Load Project 1
	*	@author Ty Madsen
	*	@since	09-May-2014
	*	@access public
	*/
	public function project1($data)
	{

		$data['pages'][] = $this->load->view('Project01/Divs1',null, true);
		$data['pages'][] = $this->load->view('Project01/Divs2',null, true);
		
		$this->load->view('header',$data);
		$this->load->view('Project01/Divs',$data);
		$this->load->view('footer');
	}

	/**
	*
	*	Load Project 2
	*	@author Ty Madsen
	*	@since	09-May-2014
	*	@access public
	*/
	public function project2($data)
	{
		$this->load->view('header',$data);
		$this->load->view('Project02/robot',$data);
		$this->load->view('footer');
	}

	/**
	*
	*	Load Project 3
	*	@author Ty Madsen
	*	@since	09-May-2014
	*	@access public
	*/
	public function project3($data)
	{
		$this->load->view('header',$data);
		$this->load->view('Project03/numbers',$data);
		$this->load->view('footer');
	}

	/**
	*
	*	Load Project 4a
	*	@author Ty Madsen
	*	@since	09-May-2014
	*	@access public
	*/
	public function project4($data)
	{
		if(isset($data['params'][0]))
			$data['index'] = $data['params'][0];
		else
			$data['index'] = 0;
		$data['pages'][] = $this->load->view('Project04/Blocks',$data,true);
		$data['pages'][] = $this->load->view('Project04/Money',$data,true);
		
		$this->load->view('header', $data);
		$this->load->view('Project04/View',$data);
		$this->load->view('footer');
	}

	/**
	*
	*	Load Project 5
	*	@author Ty Madsen
	*	@since	09-May-2014
	*	@access public
	*/
	public function project5($data)
	{
		$this->load->view('header',$data);
		$this->load->view('Project05/Tictactoe',$data);
		$this->load->view('footer');
	}

	/**
	*
	*	Load Project 6
	*	@author Ty Madsen
	*	@since	09-May-2014
	*	@access public
	*/
	public function project6($data = array())
	{
		// var_dump($method);
		// var_dump($data);
		$this->load->model('state');
		$this->load->model('student');

		if($post = $this->input->post())
		{
			echo $post;
			$this->student->add($post);
		}
		else
		{
			$data['states'] = $this->state->get_all();
			$student_id = null;
			if($student_id != null)
				$data['student_info'] = $this->student->get_info($student_id);
			$this->load->view('header', $data);
			$this->load->view('Project06/student_form', $data);
			$this->load->view('footer');
			
		}
	}

	/**
	*
	*	Load Project 7
	*	@author Ty Madsen
	*	@since	09-May-2014
	*	@access public
	*/
	public function project7($data)
	{
		

		$data['js'] = array('coordinates', 'crSpline');
		$this->load->view('header', $data);
		$this->load->view('Project07/index.html', $data);
		$this->load->view('footer');
	}

	/**
	*
	*	Load Final Project 8, 9 and 10
	*	@author Ty Madsen
	*	@since	09-May-2014
	*	@access public
	*/
	public function last($data)
	{
		$this->load->library('session');

		$data['css'] = array('external');
		$data['js'] = array('external');
		$account = $this->session->userdata('account');
		$data['user'] = $account;

		if($account['logged_in'])
		{
			//go to home page
			$this->load->view('header', $data);
			$this->load->view('Project10/home', $data);
			$this->load->view('footer');
		}
		else
			$this->login($data);
	}

	/**
	*
	*	Login page
	*	@author Ty Madsen
	*	@since	09-May-2014
	*	@access public
	*/
	public function login($data)
	{
		$this->load->model('usermodel');
		$this->load->library('session');
		
		if($post = $this->input->post())
		{
			unset($post['submit']);
			$user_exists = $this->usermodel->login($post);
			if($user_exists)
				redirect('/training/last');
			else
			{
				redirect('/training/login');
			}
		}
		else
		{
			$data['css'] = array('external');
			$data['js'] = array('external');

			$this->load->view('header', $data);
			$this->load->view('Project10/login', $data);
			$this->load->view('footer');
		}
	}

	/**
	*
	*	Login page
	*	@author Ty Madsen
	*	@since	09-May-2014
	*	@access public
	*/
	public function logout()
	{
		// $this->load->model('usermodel');
		$this->load->library('session');
		$this->session->sess_destroy();
		
		redirect('/training/last');
	}

	/**
	*
	*	Create account page
	*	@author Ty Madsen
	*	@since	09-May-2014
	*	@access public
	*/
	public function signup($data)
	{
		$this->load->model('usermodel');
		if($post = $this->input->post())
		{	
			if($post['submit'] != 'Not a user yet?')
			{
				unset($post['submit']);
				$this->usermodel->create_account($post);
				redirect('training/last');
			}
			else
			{
				$data['css'] = array('external');
				$data['js'] = array('external');

				$this->load->view('header', $data);
				$this->load->view('Project10/signup', $data);
				$this->load->view('footer');
			}
		}
	}

	/**
	*
	*	Photo viewer
	*	@author Ty Madsen
	*	@since	09-May-2014
	*	@access public
	*/
	public function photoviewer($data)
	{
		$this->load->model('photo');
		
		// $this->session->sess_destroy();
		// var_dump($this->session->userdata('messages'));
		$account = $this->session->userdata('account');
		// var_dump($account);
		if(! $account AND ! $account['logged_in'])
		{
			$this->login($data);
		}
		else
		{
			if($post = $this->input->post() AND $post['submit'] != "Photos")
			{
				var_dump($post);
				$this->photo->add_photo($account['user_id'], $post['file']);
			}

			$photos = $this->photo->get_photos($account['user_id']);

			$data['photos'] = $photos;
			$data['user'] = $account;
			$data['error'] = '';

			$data['js'] = array('external','ImagePreloader','photoviewer');
			$data['css'] = array('photoviewer');
			$data['message'] = $this->session->message('message');

			$this->load->view('header', $data);
			$this->load->view('Project08b/photoviewer', $data);
			$this->load->view('footer');
			
		}
	
	}

	/**
	*
	*	Quiz builder
	*	@author Ty Madsen
	*	@since	09-May-2014
	*	@access public
	*/
	public function quizbuilder($data)
	{
		$this->load->model("quiz_model");

		$account = $this->session->userdata('account');
		if(! $account AND ! $account['logged_in'])
		{
			$this->login($data);
		}
		else
		{
			$user_id = $account['user_id'];

			$params = array('user_id' => $user_id);

			$info = array();
			$info['quizzes'] = $this->quiz_model->get_quizzes($params);
			$params['id'] = '1';
			$info['time'] = $this->quiz_model->get_times($params);
			$info['questions'] = $this->quiz_model->get_questions($params);

			$data['info'] = $info;

			$data['user'] = $account;

			$data['js'] = array('quizbuilder', 'quiznav');
			$data['css'] = array('quizbuilder');
			// $view = $data['params'][0];
			// echo $view;

			$this->load->view('header', $data);
			$this->load->view('Project09/quizbuilder', $data);
			$this->load->view('footer');
		}
	}

	/**
	*
	*	Calendar
	*	@author Ty Madsen
	*	@since	09-May-2014
	*	@access public
	*/
	public function calendar($data)
	{
		$this->load->model("calendar");

		$account = $this->session->userdata('account');
		if(! $account AND ! $account['logged_in'])
		{
			$this->login($data);
		}
		else
		{
			$user_id = $account['user_id'];

			$params = array('user_id' => $user_id);


			$data['user'] = $account;
			$data['js'] = array('external');

			$this->load->view('header', $data);
			$this->load->view('Project10/calendar', $data);
			$this->load->view('footer');
		}
	
	}

	public function calendar_db($data = array())
	{
		if(empty($data) OR !isset($data['params']) OR empty($data['params']))
			throw new Exception("Invalid data passed in to calendar_db function of training controller.");
		$method = $data['params'][0];// var_dump($method);
		if($method == NULL)
			throw new Exception("No method passed in to calendar_db function of training controller.");
		$this->load->model("calendar");
		if($post = $this->input->post())
		{
			// var_dump($post);
			if(method_exists($this->calendar, $method))
				$data = $this->calendar->$method($post);
		}
		echo $data;
	}
}

/* End of file training.php */
/* Location: ./application/controllers/training.php */