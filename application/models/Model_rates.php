<?php 

class Model_rates extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_rate()
	{
		$this->db->select('*');
        $query = $this->db->get('rate');
        return $query->result_array();
	}

	public function create($data)
    {
        $this->db->insert('rate', $data);
        return true;
    }

	public function check_rates($rate_name, $vehicle)
    {
        $this->db->select('*');
        $this->db->where('rate_name', $rate_name);
        $this->db->where('vehicle_cat_id', $vehicle);
        $query = $this->db->get('rate'); 
        $result = $query->num_rows();
        if($result == 1){
            return true;
        }
        else {
            return false;
        }
    }

	public function check_other_rates($rate_name, $vehicle, $id)
	{
		$this->db->select('*');
        $this->db->where('id != "'.$id.'"');
        $this->db->where('rate_name', $rate_name);
        $this->db->where('vehicle_cat_id', $vehicle);
        $query = $this->db->get('rate'); 
        $result = $query->num_rows();
        if($result == 1){
            return true;
        }
        else {
            return false;
        }
	}

	public function get_rates_details($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('rate'); 
        $result = $query->row_array();
        return $result;
    }

    public function get_category_rate($id)
    {
        $this->db->select('*');
        $this->db->where('vehicle_cat_id', $id);
        $this->db->where('active', 1);
        $query = $this->db->get('rate'); 
        return $query->result_array();
    }

    public function get_category_rate_details($id)
    {
        $this->db->select('*');
        $this->db->where('vehicle_cat_id', $id);
        $this->db->where('active', 1);
        $query = $this->db->get('rate'); 
         $result = $query->row_array();
        return $result;
    }

	public function update($data, $id)
    {
        $this->db->where('id', $id);
		$update = $this->db->update('rate', $data);
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
		$delete = $this->db->delete('rate');
		if($delete){
            return true;
        }
        else{
            return false;
        }
    }

}