<?php 

class Model_groups extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function get_groups()
    {
        $this->db->select('*');
        $this->db->where('id != 1');
        $query = $this->db->get('groups');
        return $query->result_array();
    }

    public function create($data)
    {
        $this->db->insert('groups', $data);
        return true;
    }

    public function check_other_groups($group_name, $id)
    {
        $this->db->select('*');
        $this->db->where('id != "' . $id . '"');
        $this->db->where('group_name', $group_name);
        $query = $this->db->get('groups'); 
        $result = $query->num_rows();
        if($result == 1){
            return true;
        }
        else {
            return false;
        }
    }

    public function check_groups($group_name)
    {
        $this->db->select('*');
        $this->db->where('group_name', $group_name);
        $query = $this->db->get('groups'); 
        $result = $query->num_rows();
        if($result == 1){
            return true;
        }
        else {
            return false;
        }
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
		$update = $this->db->update('groups', $data);
        if($update){
            return true;
        }
        else{
            return false;
        }
    }

    public function get_group_details($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('groups'); 
        $result = $query->row_array();
        return $result;
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
		$delete = $this->db->delete('groups');
		if($delete){
            return true;
        }
        else{
            return false;
        }
    }

    public function get_user_group_by_user($id)
    {
        $this->db->select('*');
        $this->db->where('user_group.user_id', $id);
        $this->db->from('user_group');
        $this->db->join('groups', 'groups.id = user_group.group_id');
        $query = $this->db->get();
        $result = $query->row_array();
		return $result;
    }

}