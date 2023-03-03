<?php 

class Model_parking extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function create($data)
    {
        $this->db->insert('parking', $data);
        return true;
    }

    public function get_parking()
    {
        $this->db->select('*');
        $query = $this->db->get('parking');
        return $query->result_array();
    }

}