<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
class Slots extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('model_slots');
        $this->load->model('model_groups');
        $this->load->model('model_category');

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
        Display the Manage Slot Page
    */
    public function index()
    {
        // check if allowed to access the page
        if(!in_array('viewSlots', $this->permission)) {
			redirect('errors', 'refresh');
		}
        // access permission
        $data['user_permission'] = unserialize($this->group_data['permission']);

        $data['page_title'] = 'Manage Slots';

        $slot_data = $this->model_slots->get_slots();
		$data['slot_data'] = $slot_data;

        $result = array();
		foreach ($slot_data as $k => $v) {
			$result[$k]['slot'] = $v;
			$category_data = $this->model_category->get_category_details($v['vehicle_cat_id']);

			$result[$k]['category'] = $category_data;
		}

        $data['slot_datas'] = $result;

        $this->load->view('template/header', $data);
        $this->load->view('template/side_menubar');
        $this->load->view('template/header_menu');
        $this->load->view('slots/index', $data);
        $this->load->view('template/footer');
    }

    /*
        Display create Slot page and Insert slot into the database
    */
    public function create()
    {
        // check if allowed to access the page
        if(!in_array('createSlots', $this->permission)) {
			redirect('errors', 'refresh');
		}
        // access permission
        $data['user_permission'] = unserialize($this->group_data['permission']);

        $data['page_title'] = 'Add Slot';

        $this->form_validation->set_rules('vehicle_cat', 'Vehicle Category', 'required|trim');
        $this->form_validation->set_rules('slot_name', 'Slot name', 'required|trim');
		$this->form_validation->set_rules('status', 'Status', 'required|trim');

        if ($this->form_validation->run() == TRUE) {
            /* table column slots and html post fields */
            $vehicle_category = $this->input->post('vehicle_cat');
            $slot_name = $this->input->post('slot_name');
            $status = $this->input->post('status');
            $data = array(
        		'slot_name' => $slot_name,
        		'active' => $status,
        		'availability_status' => 1,
                'vehicle_cat_id' => $vehicle_category
        	);

            $check = $this->model_slots->check_slot($slot_name, $vehicle_category);

            if($check == false){
                $create = $this->model_slots->create($data);
                if($create == true){
                    $this->session->set_flashdata('success', 'Successfully created');
                    redirect('slots', 'refresh');
                }
                else{
                    $this->session->set_flashdata('error', 'Error occurred!!');
                    redirect('slots/create', 'refresh');
                }
            }
            else{
                $this->session->set_flashdata('error', 'Slot Name is already exist on this category!!');
                redirect('slots/create', 'refresh');
            }
        }
        else{
            $data['vehicle_cat'] = $this->model_category->get_category();
            $this->load->view('template/header', $data);
            $this->load->view('template/side_menubar');
            $this->load->view('template/header_menu');
            $this->load->view('slots/create', $data);
            $this->load->view('template/footer');
        }
    }

    /*
        Display Edit Slot page and update slot into the database
    */
    public function edit($id = null)
    {
        // check if allowed to access the page
        if(!in_array('updateSlots', $this->permission)) {
			redirect('errors', 'refresh');
		}
        // access permission
        $data['user_permission'] = unserialize($this->group_data['permission']);

        if($id){
            $data['page_title'] = 'Edit Slot';

            $this->form_validation->set_rules('vehicle_cat', 'Vehicle Category', 'required|trim');
            $this->form_validation->set_rules('slot_name', 'Slot name', 'required|trim');
            $this->form_validation->set_rules('status', 'Status', 'required|trim');

            if ($this->form_validation->run() == TRUE) {
                /* table column slots and html post fields */
                $vehicle_category = $this->input->post('vehicle_cat');
                $slot_name = $this->input->post('slot_name');
                $status = $this->input->post('status');
                $data = array(
                    'slot_name' => $slot_name,
                    'active' => $status,
                    'vehicle_cat_id' => $vehicle_category
                );

                $check = $this->model_slots->check_other_slot($slot_name, $vehicle_category, $id);

                if($check == false){
                    $create = $this->model_slots->update($data, $id);
                    if($create == true){
                        $this->session->set_flashdata('success', 'Successfully updated');
                        redirect('slots', 'refresh');
                    }
                    else{
                        $this->session->set_flashdata('error', 'Error occurred!!');
                        redirect('slots/edit/' . $id, 'refresh');
                    }
                }
                else{
                    $this->session->set_flashdata('error', 'Slot Name is already exist on this category!!');
                    redirect('slots/edit/' . $id, 'refresh');
                }
            }
            else{
                /*
                    Get the details of the Slot by ID in the database
                */
                $data['slot_data'] = $this->model_slots->get_slot_details($id);
                $data['vehicle_cat'] = $this->model_category->get_category();
                $this->load->view('template/header', $data);
                $this->load->view('template/side_menubar');
                $this->load->view('template/header_menu');
                $this->load->view('slots/edit', $data);
                $this->load->view('template/footer');
            }
        }
    }

    /*
        Delete the slot in the database
    */
    public function delete($id)
    {
        // check if allowed to access the page
        if(!in_array('deleteSlots', $this->permission)) {
			redirect('errors', 'refresh');
		}
        if($id){
            $delete = $this->model_slots->delete($id);
            if($delete == true) {
                $this->session->set_flashdata('success', 'Successfully removed');
                redirect('slots', 'refresh');
            }
            else {
                $this->session->set_flashdata('error', 'Error occurred!!');
                redirect('slots', 'refresh');
            }
        }
    }

}