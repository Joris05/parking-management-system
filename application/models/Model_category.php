<?php 

class Model_category extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function get_category()
    {
        $this->db->select('*');
        $query = $this->db->get('vehicle_category');
        return $query->result_array();
    }

    public function get_active_category()
    {
        $this->db->select('*');
        $this->db->where('active', 1);
        $query = $this->db->get('vehicle_category'); 
        return $query->result_array();
    }

    public function create($data)
    {
        $this->db->insert('vehicle_category', $data);
        return true;
    }

    public function check_category($category_name)
    {
        $this->db->select('*');
        $this->db->where('name', $category_name);
        $query = $this->db->get('vehicle_category'); 
        $result = $query->num_rows();
        if($result == 1){
            return true;
        }
        else {
            return false;
        }
    }

    public function check_other_category($category_name, $id)
    {
        $this->db->select('*');
        $this->db->where('id != "' . $id . '"');
        $this->db->where('name', $category_name);
        $query = $this->db->get('vehicle_category'); 
        $result = $query->num_rows();
        if($result == 1){
            return true;
        }
        else {
            return false;
        }
    }

    public function get_category_details($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('vehicle_category'); 
        $result = $query->row_array();
        return $result;
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
		$update = $this->db->update('vehicle_category', $data);
        if($update){
            return true;
        }
        else{
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
		$delete = $this->db->delete('vehicle_category');
		if($delete){
            return true;
        }
        else{
            return false;
        }
    }

}