<?php

class Quiz_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function get_time($post = array())
	{
		if(empty($post))
			throw new Exception('No data passed in to get_time method of quiz model.');

		$query = $this->db->select('time_allowed')
						->from('quiz')
						->where($post)
						->get();
		// var_dump($post);
		
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();
			return $result['time_allowed'];
		}
		return false;
	}

	public function get_quizzes($post = array())
	{
		if(empty($post))
			throw new Exception('No data passed in to get_quizzes method of quiz model.');
		unset($post['id']);
		$query = $this->db->where($post)
						->get('quiz');
		// var_dump($this->db->last_query());
		$result = $query->result_array();

		$out = "";
		$out .= '<table id="quiz_table" style="width:100px;border:0px" border="1">';
		$out .= '<tr style="position:absolute;left:0px;top:0px;background-color:white;z-index:200">';
		$out .= '<th style="width:500px">Quiz #</th>';
		$out .= '</tr>';
		foreach($result as $row)
		{
			$out .= '<tr><td style="text-align:center;width:500px;position:relative;top:25px">' . $row['id'] . '</td></tr>';
		}
		$out .= '</table>';
		// var_dump($out);	
		return $out;

	}

	public function get_questions($post = array())
	{
		if(empty($post))
			throw new Exception('No data passed in to get_questions method of quiz model.');
		// var_dump($post);
		$post['quiz.id'] = $post['id'];
		unset($post['id']);
		$query = $this->db->select('*')
						->from('quiz_question')
						->join('quiz', 'quiz.id = quiz_question.quiz_id')
						->where($post)
						->get();
		// var_dump($this->db->last_query());

		$out = "";
		$out .= '<table id="question_table" style="width:700px;border:0px" border="1">';
		$out .= '<tr style="position:absolute;left:0px;top:0px;background-color:white;z-index:200">';
		$out .= '<th style="width:80px">Question #</th>';
		$out .= '<th style="width:370px">Question</th>';
		$out .= '<th style="width:276px">Answer</th></tr>';

		$result = $query->result_array();
		foreach($result as $row)
		{
			$out .= '<tr style="position:relative;top:24px">';
			$out .= '<td style="cursor:pointer;text-align:center;position:relative;top:24px;width:84px">' . $row['question_id'] . '</td>';
			$out .= '<td style="position:relative;top:24px;width:370px">' . $row['question'] . '</td>';
			$out .= '<td style="position:relative;top:24px;width:276px">' . $row['answer'] . '</td>';
			$out .= '</tr>';
		}

		$out .= '</table>';

		// var_dump($out);
		
		return $out;
	}

	public function set_question($post)
	{
		$quiz_id = $post['id'];
		$question_id = $post['question_id'];
		$question = $post['question'];
		$answer = $post['answer'];
		$user_id = $post['user_id'];


		$query = $this->db->select("quiz_question.id")
					->from("quiz_question")
					->join('quiz', 'quiz.id = quiz_question.quiz_id')
					->where('user_id',$user_id)
					->where('quiz_question.quiz_id', $quiz_id)
					->where('quiz_question.question_id', $question_id)
					->get();
		// var_dump($this->db->last_query());

		if($query->num_rows() > 0)
		{
			$id = $query->row_array();
			$id = $id['id'];
			$this->db->where('id', $id)
					->update("quiz_question", array('answer' => $answer, 'question' => $question));
		}
		else
		{
			unset($post['id']);
			unset($post['user_id']);
			$data = $post;
			$data['quiz_id'] = $quiz_id;
			$this->db->insert("quiz_question", $data);
			// var_dump($this->db->last_query());
		}
	}

	public function set_time($post = array())
	{
		$data = $post;
		$time = $post['time_allowed'];
		unset($post['time_allowed']);

		$query = $this->db->select("*")
						->from("quiz")
						->where($post)
						->get();
		if($query->num_rows() > 0)
		{
			$this->db->where($post)
					->update("quiz", array('time_allowed' => $time));	
		}
		else
		{
			$this->db->insert("quiz", $data);
		}
	}

	public function submit_quiz($post = array())
	{
		if(empty($post))
			throw new Exception('No data passed in to submit_quiz method of quiz model.');
		
		// $query = $this->db->select("*")
		// 			->from("quiz_result")
		// 			->where("user_id", $post['user_id'])
		// 			->where("quiz_id", $post['quiz_id'])
		// 			->get();
		// if($query->num_rows() > 0)
		// 	throw new Exception("You suck");//Throw an error
		if(isset($post['id']))
		{
			$id = $post['id'];
			unset($post['id']);
			$this->db->where("id", $id)
					->update("quiz_result", $post);
		}
		else
		{
			$this->db->insert("quiz_result", $post);
			return $this->db->insert_id();
		}
	}

	public function submit_answer($post = array())
	{
		if(empty($post))
			throw new Exception('No data passed in to submit_answer method of quiz model.');
		
		$this->db->insert("answer", $post);
	}

	public function get_results($post)
	{
		if(empty($post))
			throw new Exception('No data passed in to get_results method of quiz model.');

		// $user_id = $post['user_id'];
		$query = $this->db->select("*")
					->from("quiz_result")
					->where($post)
					->get();
		$results = $query->result_array();
		return $results;
		/*
		$sql = "SELECT * FROM user_results WHERE user='$_POST[user_name]'";

		$result = mysqli_query($con,$sql);
		echo '<table id="completed_quizzes_table" style="width:400px;border:0px" border="1">';
		echo '<tr style="position:absolute;left:0px;top:40px;background-color:white;z-index:200">';
		echo '<th style="width:130px">Quiz #</th>';
		echo '<th style="width:130px">Score</th>';
		echo '<th style="width:130px">Date Taken</th>';
		echo '</tr>';
		//echo '<table id="quiz_table">';
		while($row = mysqli_fetch_array($result)){
			echo '<tr><td style="text-align:center;width:130px;position:relative;top:25px">' . $row['quiz_id'] . '</td>';
			echo '<td style="text-align:center;width:130px;position:relative;top:25px">' . $row['score'] . '%' . '</td>';
			echo '<td style="text-align:center;width:130px;position:relative;top:25px">' . $row['date'] . '</td></tr>';
		}
		echo '</table>';
		*/
	}

	public function get_responses($post = array())
	{
		if(empty($post))
			throw new Exception('No data passed in to get_responses method of quiz model.');

		$query = $this->db->select("*")
					->from("answer")
					->where($post)
					->get();
		$results = $query->result_array();
		$out = '';


		$out .= '<table id="completed_quizzes_table" style="width:400px;border:0px" border="1">';
		$out .= '<tr style="position:absolute;left:0px;top:40px;background-color:white;z-index:200">';
		$out .= '<th style="width:130px">Question #</th>';
		$out .= '<th style="width:130px">Response</th>';
		$out .= '<th style="width:130px">Time Taken</th>';
		$out .= '</tr>';
		foreach($results as $result){
			$out .= '<tr><td style="text-align:center;width:132px;position:relative;top:25px">' . $result['question_id'] . '</td>';
			$out .= '<td style="text-align:center;width:130px;position:relative;top:25px">' . $result['answer'] . '</td>';
			$out .= '<td style="text-align:center;width:130px;position:relative;top:25px">' . $result['time'] . ' ms</td></tr>';
		}
		$out .= '</table>';
		return $out;
	}

}
?>