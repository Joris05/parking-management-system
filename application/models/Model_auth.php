<?php 

class Model_auth extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    /* 
		This function checks if the email exists in the database
	*/

    public function check_email($email)
    {
        $this->db->select('*');
        $this->db->where('email', $email);
        $query = $this->db->get('users'); 
        $result = $query->num_rows();
        if($result == 1){
            return true;
        }
        else {
            return false;
        }
    }

    /* 
		This function checks if the email and password matches with the database
	*/

    public function login($email, $password)
    {
        $this->db->select('*');
        $this->db->where('email', $email);
        $this->db->where('password', md5($password));
        $query = $this->db->get('users'); 
        if($query->num_rows() == 1){
            $result = $query->row_array();
            return $result;
        }
        else {
            return false;
        }
    }

}