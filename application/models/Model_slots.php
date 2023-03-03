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

    public function check_other_slot($slot_name, $id)
    {
        $this->db->select('*');
        $this->db->where('id != "' . $id . '"');
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

    public function get_slot_details($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('slots'); 
        $result = $query->row_array();
        return $result;
    }

    public function create($data)
    {
        $this->db->insert('slots', $data);
        return true;
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
		$update = $this->db->update('slots', $data);
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
		$delete = $this->db->delete('slots');
		if($delete){
            return true;
        }
        else{
            return false;
        }
    }

    public function get_available_slot()
    {
        $this->db->select('*');
        $this->db->where('availability_status', 1);
        $this->db->where('active', 1);
        $query = $this->db->get('slots'); 
        $result = $query->result_array();
        return $result;
    }

    public function update_slot_availability($data, $id)
    {
        $this->db->where('id', $id);
		$update = $this->db->update('slots', $data);
        if($update){
            return true;
        }
        else{
            return false;
        }
    }
}