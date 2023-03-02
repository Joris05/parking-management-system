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
        $data['page_title'] = 'Manage Slots';

        $slot_data = $this->model_slots->get_slots();
		$data['slot_data'] = $slot_data;

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
        $data['page_title'] = 'Add Slot';

        $this->form_validation->set_rules('slot_name', 'Slot name', 'required|trim');
		$this->form_validation->set_rules('status', 'Status', 'required|trim');

        if ($this->form_validation->run() == TRUE) {
            /* table column slots and html post fields */
            $slot_name = $this->input->post('slot_name');
            $status = $this->input->post('status');
            $data = array(
        		'slot_name' => $slot_name,
        		'active' => $status,
        		'availability_status' => 1
        	);

            $check = $this->model_slots->check_slot($category_name);

            if($check == false){
                $create = $this->model_slots->create($data);
                if($create == true){
                    $this->session->set_flashdata('success', 'Successfully created');
                    redirect('category', 'refresh');
                }
                else{
                    $this->session->set_flashdata('error', 'Error occurred!!');
                    redirect('slots/create', 'refresh');
                }
            }
            else{
                $this->session->set_flashdata('error', 'Slot Name is already exist!!');
                redirect('slots/create', 'refresh');
            }
        }
        else{
            $this->load->view('template/header', $data);
            $this->load->view('template/side_menubar');
            $this->load->view('template/header_menu');
            $this->load->view('slots/create');
            $this->load->view('template/footer');
        }
    }

}