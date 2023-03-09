<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('model_users');
        $this->load->model('model_groups');

        $user_id = $this->session->userdata('id');
        $this->group_data = $this->model_groups->get_user_group_by_user($user_id);
        $this->permission = unserialize($this->group_data['permission']);
    }

    /*
        Checks if the user is log-out, if logout the user
        redirects to the login page
    */
    private function is_logged_in()
    {
        if (!$this->session->userdata('logged_in') == TRUE) {
            redirect('/', 'refresh');
        }
    }

    /*
        Display the Manage Users Page
    */
    public function index()
    {
        // check if allowed to access the page
        if(!in_array('viewUser', $this->permission)) {
			redirect('errors', 'refresh');
		}

        $data['page_title'] = 'Manage Users';
        $data['users_data'] = $this->model_users->get_users();
        // access permission
        $data['user_permission'] = unserialize($this->group_data['permission']);

        $user_data = $this->model_users->get_users();

		$result = array();
		foreach ($user_data as $k => $v) {

			$result[$k]['user_info'] = $v;

			$group = $this->model_users->get_user_group($v['id']);
			$result[$k]['user_group'] = $group;
		}

		$data['user_data'] = $result;

        $this->load->view('template/header', $data);
        $this->load->view('template/side_menubar');
        $this->load->view('template/header_menu');
        $this->load->view('users/index', $data);
        $this->load->view('template/footer');
    }

    /*
        Display create User page and Insert Users into the database
    */
    public function create()
    {
        // check if allowed to access the page
        if(!in_array('createUser', $this->permission)) {
			redirect('errors', 'refresh');
		}

        // access permission
        $data['user_permission'] = unserialize($this->group_data['permission']);

        $data['page_title'] = 'Add User';

        $this->form_validation->set_rules('groups', 'Group', 'required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');
		$this->form_validation->set_rules('fname', 'First name', 'trim|required');
        $this->form_validation->set_rules('lname', 'Last name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $groups = $this->input->post('groups');
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $phone = $this->input->post('phone');
            $gender = $this->input->post('gender');
            $password = MD5($this->input->post('password'));
            /* table column category and html post fields */
        	$data = array(
        		'username' => $username,
        		'password' => $password,
        		'email' => $email,
        		'firstname' => $fname,
        		'lastname' => $lname,
        		'phone' => $phone,
        		'gender' => $gender,
        	);

        	$create_id = $this->model_users->create($data);
        	if($create_id == true) {
                $group_data = array(
                    'user_id' => $create_id,
                    'group_id' => $groups
                );
                $this->model_users->create_user_group($group_data);
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('users', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('error', 'Error occurred!!');
        		redirect('users/create', 'refresh');
        	}
        }
        else {
            // false case
        	$group_data = $this->model_groups->get_groups();
        	$data['group_data'] = $group_data;

            $this->load->view('template/header', $data);
            $this->load->view('template/side_menubar');
            $this->load->view('template/header_menu');
            $this->load->view('users/create', $data);
            $this->load->view('template/footer');
        }
    }

    /*
         Display Edit user page and update user into the database
    */
    public function edit($id)
    {
        if($id){

            // check if allowed to access the page
            if(!in_array('updateUser', $this->permission)) {
                redirect('errors', 'refresh');
            }

            // access permission
            $data['user_permission'] = unserialize($this->group_data['permission']);

            $data['page_title'] = 'Edit User';

            $this->form_validation->set_rules('groups', 'Group', 'required');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('fname', 'First name', 'trim|required');
            $this->form_validation->set_rules('lname', 'Last name', 'trim|required');
    
            if ($this->form_validation->run() == TRUE) {
                $groups = $this->input->post('groups');
                $username = $this->input->post('username');
                $email = $this->input->post('email');
                $fname = $this->input->post('fname');
                $lname = $this->input->post('lname');
                $phone = $this->input->post('phone');
                $gender = $this->input->post('gender');
                $password = MD5($this->input->post('password'));
                $cpassword = MD5($this->input->post('cpassword'));
                if(!$this->input->post('password') && !$this->input->post('cpassword')) {
                    $data = array(
		        		'username' => $username,
		        		'email' => $email,
		        		'firstname' => $fname,
		        		'lastname' => $lname,
		        		'phone' => $phone,
		        		'gender' => $gender,
		        	);
                    $update = $this->model_users->update($data, $id);
		        	if($update == true) {
                        $group_data = array(
                            'user_id' => $id,
                            'group_id' => $groups
                        );
                        $this->model_users->update_user_group($group_data, $id);
		        		$this->session->set_flashdata('success', 'Successfully updated');
		        		redirect('users', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('users/edit/'.$id, 'refresh');
		        	}
                }else{
                    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
                    $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');
                    if($this->form_validation->run() == TRUE) {
                        /* table column category and html post fields */
                        $data = array(
                            'username' => $username,
                            'password' => $password,
                            'email' => $email,
                            'firstname' => $fname,
                            'lastname' => $lname,
                            'phone' => $phone,
                            'gender' => $gender,
                        );
                        $update = $this->model_users->update($data, $id);
                        if($update == true) {
                            $group_data = array(
                                'user_id' => $id,
                                'group_id' => $groups
                            );
                            $this->model_users->update_user_group($group_data, $id);
                            $this->session->set_flashdata('success', 'Successfully updated');
                            redirect('users', 'refresh');
                        }
                        else {
                            $this->session->set_flashdata('error', 'Error occurred!!');
                            redirect('users/edit/'.$id, 'refresh');
                        }
                    }else{
                        $user_data = $this->model_users->get_user_details($id);
                        $groups = $this->model_users->get_user_group($id);
                        $data['user_data'] = $user_data;
                        $data['user_group'] = $groups;

                        $group_data = $this->model_groups->get_groups();
                        $data['group_data'] = $group_data;
            
                        $this->load->view('template/header', $data);
                        $this->load->view('template/side_menubar');
                        $this->load->view('template/header_menu');
                        $this->load->view('users/edit', $data);
                        $this->load->view('template/footer');
                    }
                }
                
            }
            else {
                $user_data = $this->model_users->get_user_details($id);
                $groups = $this->model_users->get_user_group($id);
                $data['user_data'] = $user_data;
                $data['user_group'] = $groups;

                $group_data = $this->model_groups->get_groups();
                $data['group_data'] = $group_data;
    
                $this->load->view('template/header', $data);
                $this->load->view('template/side_menubar');
                $this->load->view('template/header_menu');
                $this->load->view('users/edit', $data);
                $this->load->view('template/footer');
            }
        }
    }

    /*
        Delete the users in the database
    */
    public function delete($id){
        // check if allowed to access the page
        if(!in_array('deleteUser', $this->permission)) {
            redirect('errors', 'refresh');
        }
        if($id){
            $delete = $this->model_users->delete($id);
            if($delete == true) {
                $this->session->set_flashdata('success', 'Successfully removed');
                redirect('users', 'refresh');
            }
            else {
                $this->session->set_flashdata('error', 'Error occurred!!');
                redirect('users', 'refresh');
            }
        }
    }

    /*
       View user profile
    */
    public function profile()
    {
        // check if allowed to access the page
        if(!in_array('viewProfile', $this->permission)) {
            redirect('errors', 'refresh');
        }
        // access permission
        $data['user_permission'] = unserialize($this->group_data['permission']);
        
        $data['page_title'] = 'Profile';

        $user_id = $this->session->userdata('id');

        $user_data = $this->model_users->get_user_details($user_id);
		$data['user_data'] = $user_data;

		$user_group = $this->model_users->get_user_group($user_id);
		$data['user_group'] = $user_group;

        $this->load->view('template/header', $data);
        $this->load->view('template/side_menubar');
        $this->load->view('template/header_menu');
        $this->load->view('users/profile', $data);
        $this->load->view('template/footer');
    }

    /*
       View and Update user setting
    */
    public function setting()
    {
        // check if allowed to access the page
        if(!in_array('updateSetting', $this->permission)) {
            redirect('errors', 'refresh');
        }
        // access permission
        $data['user_permission'] = unserialize($this->group_data['permission']);
        
        $data['page_title'] = 'Update Information';

        $id = $this->session->userdata('id');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('fname', 'First name', 'trim|required');
        $this->form_validation->set_rules('lname', 'Last name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $phone = $this->input->post('phone');
            $gender = $this->input->post('gender');
            $password = MD5($this->input->post('password'));
            $cpassword = MD5($this->input->post('cpassword'));
            if(!$this->input->post('password') && !$this->input->post('cpassword')) {
                $data = array(
                    'username' => $username,
                    'email' => $email,
                    'firstname' => $fname,
                    'lastname' => $lname,
                    'phone' => $phone,
                    'gender' => $gender,
                );
                $update = $this->model_users->update($data, $id);

                if($update == true) {
                    $this->session->set_flashdata('success', 'Successfully updated');
                    redirect('users/setting', 'refresh');
                }
                else {
                    $this->session->set_flashdata('error', 'Error occurred!!');
                    redirect('users/setting', 'refresh');
                }
            }else{
                $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
                $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');
                if($this->form_validation->run() == TRUE) {
                    /* table column category and html post fields */
                    $data = array(
                        'username' => $username,
                        'password' => $password,
                        'email' => $email,
                        'firstname' => $fname,
                        'lastname' => $lname,
                        'phone' => $phone,
                        'gender' => $gender,
                    );
                    $update = $this->model_users->update($data, $id);
                    if($update == true) {
                        $this->session->set_flashdata('success', 'Successfully updated');
                        redirect('users/setting', 'refresh');
                    }
                    else {
                        $this->session->set_flashdata('error', 'Error occurred!!');
                        redirect('users/setting', 'refresh');
                    }
                }else{
                    $user_data = $this->model_users->get_user_details($id);
                    $groups = $this->model_users->get_user_group($id);
                    $data['user_data'] = $user_data;
                    $data['user_group'] = $groups;

                    $group_data = $this->model_groups->get_groups();
                    $data['group_data'] = $group_data;
        
                    $this->load->view('template/header', $data);
                    $this->load->view('template/side_menubar');
                    $this->load->view('template/header_menu');
                    $this->load->view('users/setting', $data);
                    $this->load->view('template/footer');
                }
            }
        }
        else {
            $user_data = $this->model_users->get_user_details($id);
            $groups = $this->model_users->get_user_group($id);
            $data['user_data'] = $user_data;
            $data['user_group'] = $groups;

            $group_data = $this->model_groups->get_groups();
            $data['group_data'] = $group_data;

            $this->load->view('template/header', $data);
            $this->load->view('template/side_menubar');
            $this->load->view('template/header_menu');
            $this->load->view('users/setting', $data);
            $this->load->view('template/footer');
        }
    }

}