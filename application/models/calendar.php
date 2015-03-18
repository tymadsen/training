<?php

class Calendar extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function set_event($post = array())
	{
		if(empty($post))
			throw new Exception("No data passed in to set_event method of calendar model.");

		$this->db->insert("event", $post);
		// var_dump($post);
		$id = $this->db->insert_id();
		$query = $this->db->where("id", $id)
							->get("event");
		$result = $query->row_array();
		$out = "[$result[id], '$result[month]', '$result[date]', '$result[title]', $result[year]]";
		return $out;
		/*
		$sql = "INSERT INTO user_events (user_name,month,date,title,year) VALUES ('$_POST[user_name]','$_POST[month]','$_POST[date]',
			'$_POST[title]','$_POST[year]')";
		mysqli_query($con,$sql);
		if(mysqli_errno())
			echo "Error: " . mysqli_error($con);
		else{
			echo '['.'"'.$_POST[month].'"'.','.'"'.$_POST[date].'"'.','.'"'.$_POST[title].'"'.','.'"'.$_POST[year].'"'.']';
		}
		*/
	}

	public function update_event($post = array())
	{
		if(empty($post))
			throw new Exception("No data passed in to update_event method of calendar model.");

		$new_title = $post['new_title'];
		unset($post['new_title']);
		$this->db->where($post)
					->update("event", array("title"=>$new_title));
		/*
		$delimiter = "WHERE user_name='$_POST[user_name]' AND year='$_POST[year]' AND month='$_POST[month]' AND date='$_POST[date]' AND title='$_POST[title]' LIMIT 1";
		if($_POST[new_title] != "")
			$sql = "UPDATE user_events SET title='$_POST[new_title]' ".$delimiter;
		else
			$sql = "DELETE FROM user_events ".$delimiter;
		mysqli_query($con,$sql);
		if(mysqli_errno())
			echo "Error: " . mysqli_error($con);
		else
			echo '"'.$_POST[new_title].'"';
		*/
	}

	public function delete_event($post = array())
	{
		if(empty($post))
			throw new Exception("No data passed in to delete_event method of calendar model.");

		// $id = $post['id'];
		// unset($post['id']);
		$this->db->where($post)
					->delete("event");
		/*
		$delimiter = "WHERE user_name='$_POST[user_name]' AND year='$_POST[year]' AND month='$_POST[month]' AND date='$_POST[date]' AND title='$_POST[title]' LIMIT 1";
		if($_POST[new_title] != "")
			$sql = "UPDATE user_events SET title='$_POST[new_title]' ".$delimiter;
		else
			$sql = "DELETE FROM user_events ".$delimiter;
		mysqli_query($con,$sql);
		if(mysqli_errno())
			echo "Error: " . mysqli_error($con);
		else
			echo '"'.$_POST[new_title].'"';
		*/
	}

	

	public function get_events($post = array())
	{
		if(empty($post))
			throw new Exception("No data passed in to get_events method of calendar model.");
		
		$query = $this->db->select("*")
						->from("event")
						->where("user_id", $post['user_id'])
						->get();
		$results = $query->result_array();
		// echo $results;
		$count = 0;
		$out = "[";
		foreach($results as $result)
		{
			if($count != 0)
				$out .= ",";
			// $out .= '"['.'"'.$month.'"'.','.'"'.$date.'"'.','.'"'.$title.'"'.','.'"'.$year.'"'.']';
			$out .= "[$result[id], '$result[month]', '$result[date]', '$result[title]', $result[year]]";
			$count++;
		}
		$out .= "]";
		// var_dump($out);

		return $out;
		/*
		$sql = "SELECT * FROM user_events WHERE user_name='$_POST[user_name]'";
		$result = mysqli_query($con,$sql);
		$count = 0;
		echo '[';
		while($row = mysqli_fetch_array($result)){
			$month = $row['month'];
			$date = $row['date'];
			$title = $row['title'];
			$year = $row['year'];
			if($count != 0)
				echo ',';
			echo '['.'"'.$month.'"'.','.'"'.$date.'"'.','.'"'.$title.'"'.','.'"'.$year.'"'.']';
			$count++;
		}
		echo ']';
		*/
	}
}

?>