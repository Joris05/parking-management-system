<?php 

class Model_users extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function get_total_users()
    {
        $this->db->select('*');
        $query = $this->db->get('users');
        return $query->num_rows();
    }

}