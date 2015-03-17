<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quiz extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('quiz_model');
	}

	public function _remap($method, $params)
	{
		$config =& get_config();
		$base_url = $config['base_url'];
		$site_url = $config['site_url'];
		$account = $this->session->userdata('account');

		$data['base_url'] = $base_url;
		$data['site_url'] = $site_url;
		$data['account'] = $account;
		$data['params'] = array();
		if(!empty($params))
			$data['params'] = $params;


		if(! $account AND ! $account['logged_in'])
		{
			$this->session->set_message("You need to log in first.");
			redirect("$base_url/training/last");
		}
		else
		{
			if($method == "get_db_info" OR $method == "set_db_info")
				$this->db($params[0]);
			else if(method_exists($this, $method))
				$this->$method($data);
			else{
				$this->session->set_message("Invalid request.");
				redirect("quiz/home");
			}
		}
	}

	public function db($method)
	{
		$data = array();
		if($post = $this->input->post())
		{
			// var_dump($post);
			// echo 'test';
			if(method_exists($this->quiz_model, $method))
				$data = $this->quiz_model->$method($post);
		}
		// echo 'test';
		echo $data;
		// var_dump($data);
		// return $data;
	}

	/**
	*
	*	Quiz home
	*	@author Ty Madsen
	*	@since	09-May-2014
	*	@access public
	*/
	public function home($data)
	{
		
		$user_id = $data['account']['user_id'];

		$params = array('user_id' => $user_id);

		// $info = array();
		// $info['quizzes'] = $this->quiz_model->get_quizzes($params);
		// $params['id'] = '1';
		// $info['time'] = $this->quiz_model->get_time($params);
		// $info['questions'] = $this->quiz_model->get_questions($params);

		// $data['info'] = $info;

		$data['user'] = $data['account'];

		$data['js'] = array('quizbuilder', 'quiznav');
		$data['css'] = array('quiz');
		// $view = $data['params'][0];
		// echo $view;

		$this->load->view('header', $data);
		$this->load->view('Project09/quiz_home', $data);
		$this->load->view('footer');
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

		$user_id = $data['account']['user_id'];

		$params = array('user_id' => $user_id);

		$info = array();
		$info['quizzes'] = $this->quiz_model->get_quizzes($params);
		$params['id'] = '1';
		$info['time'] = $this->quiz_model->get_time($params);
		$info['questions'] = $this->quiz_model->get_questions($params);

		$data['info'] = $info;

		$data['user'] = $data['account'];

		$data['js'] = array('quizbuilder', 'quiznav');
		$data['css'] = array('quiz');
		// $view = $data['params'][0];
		// echo $view;

		$this->load->view('header', $data);
		$this->load->view('Project09/quizbuilder', $data);
		$this->load->view('footer');
	}

	/**
	*
	*	Take quiz
	*	@author Ty Madsen
	*	@since	13-March-2015
	*	@access public
	*/
	public function take_quiz($data)
	{
		$user_id = $data['account']['user_id'];

		$params = array('user_id' => $user_id);

		$info = array();
		$info['quizzes'] = $this->quiz_model->get_quizzes($params);
		$params['id'] = '1';
		$info['time'] = $this->quiz_model->get_time($params);
		$info['questions'] = $this->quiz_model->get_questions($params);

		$data['info'] = $info;

		$data['user'] = $data['account'];

		$data['js'] = array('quiznav');
		$data['css'] = array('take_quiz', 'quiz');
		// $view = $data['params'][0];
		// echo $view;

		$this->load->view('header', $data);
		$this->load->view('Project09/take_quiz', $data);
		$this->load->view('footer');
	}

	/**
	*
	*	Quiz Results
	*	@author Ty Madsen
	*	@since	14-March-2015
	*	@access public
	*/
	public function quiz_results($data)
	{
		$user_id = $data['account']['user_id'];

		$params = array('user_id' => $user_id);

		$info = array();
		$data['results'] = $this->quiz_model->get_results($params);

		$data['user'] = $data['account'];

		$data['js'] = array('quiznav');
		$data['css'] = array('quiz');
		// $view = $data['params'][0];
		// echo $view;

		$this->load->view('header', $data);
		$this->load->view('Project09/results', $data);
		$this->load->view('footer');
	}
}

/* End of file quiz.php */
/* Location: ./application/controllers/quiz.php */