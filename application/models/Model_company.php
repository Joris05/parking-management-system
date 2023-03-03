<?php 

class Model_company extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function get_company($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('company'); 
        return $query->row_array();	
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
		$update = $this->db->update('company', $data);
        if($update){
            return true;
        }
        else{
            return false;
        }
    }

}