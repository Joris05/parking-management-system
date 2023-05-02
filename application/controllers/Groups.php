<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
class Groups extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
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
            redirect('admin/', 'refresh');
        }
    }

   /*
        Display the Manage Groups Page
    */
    public function index()
    {
        // check if allowed to access the page
        if(!in_array('viewGroup', $this->permission)) {
			redirect('errors', 'refresh');
		}
        // access permission
        $data['user_permission'] = unserialize($this->group_data['permission']);

        $data['page_title'] = 'Manage Groups';
        $data['groups_data'] = $this->model_groups->get_groups();

        $this->load->view('template/header', $data);
        $this->load->view('template/side_menubar');
        $this->load->view('template/header_menu');
        $this->load->view('groups/index', $data);
        $this->load->view('template/footer');
    }

    /*
        Display create Groups page and Insert groups into the database
    */
    public function create()
    {
        // check if allowed to access the page
        if(!in_array('createGroup', $this->permission)) {
			redirect('errors', 'refresh');
		}
        // access permission
        $data['user_permission'] = unserialize($this->group_data['permission']);

        $data['page_title'] = 'Add Group';

        $this->form_validation->set_rules('group_name', 'Group name', 'required');

        if ($this->form_validation->run() == TRUE) {
            /* table column groups and html post fields */
            $group_name = $this->input->post('group_name');
            $permission = $this->input->post('permission');
            // Turns objects into a string
            $permission = serialize($permission);
            
        	$data = array(
        		'group_name' => $group_name,
        		'permission' => $permission
        	);

            $check = $this->model_groups->check_groups($group_name);

            if($check == false){
                // insert into the table groups
                $create = $this->model_groups->create($data);
                if($create == true) {
                    $this->session->set_flashdata('success', 'Successfully created');
                    redirect('admin/groups', 'refresh');
                }
                else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect('admin/groups/create', 'refresh');
                }
            }
            else{
                $this->session->set_flashdata('error', 'Group Name is already exist!!');
                redirect('admin/groups/create', 'refresh');
            }
        }
        else {
            $this->load->view('template/header', $data);
            $this->load->view('template/side_menubar');
            $this->load->view('template/header_menu');
            $this->load->view('groups/create');
            $this->load->view('template/footer');
        }
    }

    /*
        Display Edit Category page and update category into the database
    */
    public function edit($id = null)
    {

        // check if allowed to access the page
        if(!in_array('updateGroup', $this->permission)) {
			redirect('errors', 'refresh');
		}
        // access permission
        $data['user_permission'] = unserialize($this->group_data['permission']);

        if($id){
            $data['page_title'] = 'Edit Group';

            $this->form_validation->set_rules('group_name', 'Group name', 'required');

            if ($this->form_validation->run() == TRUE) {
                /* table column groups and html post fields */
                $group_name = $this->input->post('group_name');
                $permission = $this->input->post('permission');
                // Turns objects into a string
                $permission = serialize($permission);
                
                $data = array(
                    'group_name' => $group_name,
                    'permission' => $permission
                );
    
                $check = $this->model_groups->check_other_groups($group_name, $id);
    
                if($check == false){
                    // update into the table groups
                    $update = $this->model_groups->update($data, $id);
                    if($update == true) {
                        $this->session->set_flashdata('success', 'Successfully updated');
                        redirect('admin/groups', 'refresh');
                    }
                    else {
                        $this->session->set_flashdata('errors', 'Error occurred!!');
                        redirect('admin/groups/edit/' . $id, 'refresh');
                    }
                }
                else{
                    $this->session->set_flashdata('error', 'Group Name is already exist!!');
                    redirect('admin/groups/edit/' . $id, 'refresh');
                }
            }
            else {
                // get the details of the group by ID
                $group_data = $this->model_groups->get_group_details($id);
				$data['group_data'] = $group_data;

                $this->load->view('template/header', $data);
                $this->load->view('template/side_menubar');
                $this->load->view('template/header_menu');
                $this->load->view('groups/edit', $data);
                $this->load->view('template/footer');
            }
        }
    }

    /*
        Delete the group in the database
    */
    public function delete($id){
        // check if allowed to access the page
        if(!in_array('deleteGroup', $this->permission)) {
			redirect('errors', 'refresh');
		}
        if($id){
            $delete = $this->model_groups->delete($id);
            if($delete == true) {
                $this->session->set_flashdata('success', 'Successfully removed');
                redirect('admin/groups', 'refresh');
            }
            else {
                $this->session->set_flashdata('error', 'Error occurred!!');
                redirect('admin/groups', 'refresh');
            }
        }
    }

}