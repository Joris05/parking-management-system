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

    public function get_users()
    {
        $this->db->select('*');
        $this->db->where('id != 1');
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function create($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function create_user_group($data)
    {
        $this->db->insert('user_group', $data);
        return true;
    }

    public function update_user_group($data, $id)
    {
        $this->db->where('user_id', $id);
		$update = $this->db->update('user_group', $data);
        if($update){
            return true;
        }
        else{
            return false;
        }
    }

    public function get_user_group($id)
    {
        $this->db->select('*');
        $this->db->where('user_id', $id);
        $query = $this->db->get('user_group');
        $result = $query->row_array();

        $group_id = $result['group_id'];
        $this->db->select('*');
        $this->db->where('id', $group_id);
        $query1 = $this->db->get('groups');
        return $query1->row_array();
    }

    public function get_user_details($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('users'); 
        $result = $query->row_array();
        return $result;
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
		$update = $this->db->update('users', $data);
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
		$delete = $this->db->delete('users');
		if($delete){
            return true;
        }
        else{
            return false;
        }
    }

}