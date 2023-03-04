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

    public function get_total_parking()
    {
        $this->db->select('*');
        $query = $this->db->get('parking');
        return $query->num_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
		$delete = $this->db->delete('parking');
		if($delete){
            return true;
        }
        else{
            return false;
        }
    }

}