<?php

class Blogmodel extends CI_Model {

    var $user_id = '';
    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    function get_last_ten_entries($id)
    {
        $query = $this->db->get_where('entries', array('user_id' => $id), 10);
        return $query->result();
    }

    function insert_entry($data)
    {
        $this->user_id = $data['user_id'];
        $this->title = $data['title'];
        $this->content = $data['content'];
        $this->date    = date('Y-m-d');

        $this->db->insert('entries', $this);
        //return "success";
    }

    function update_entry($entry)
    {
        // $this->title   = $entry['title'];
        // $this->content = $entry['content'];
        // $this->date    = time();

        // echo $entry['title'];
        // echo $entry['content'];

        // $this->db->update('entries', $this, array('id' => $this->input->post('id')));
    }
}
?>