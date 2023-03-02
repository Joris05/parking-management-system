<?php 

class Model_slots extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function get_slots()
    {
        $this->db->select('*');
        $query = $this->db->get('slots');
        return $query->result_array();
    }

    public function check_slot($slot_name)
    {
        $this->db->select('*');
        $this->db->where('slot_name', $slot_name);
        $query = $this->db->get('slots'); 
        $result = $query->num_rows();
        if($result == 1){
            return true;
        }
        else {
            return false;
        }
    }

    public function create($data)
    {
        $this->db->insert('slots', $data);
        return true;
    }
}