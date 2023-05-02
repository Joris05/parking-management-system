<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
class Rates extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('model_rates');
        $this->load->model('model_category');
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
        Display the Manage Rates Page
    */
    public function index()
    {
        // check if allowed to access the page
        if(!in_array('viewRates', $this->permission)) {
			redirect('errors', 'refresh');
		}
        // access permission
        $data['user_permission'] = unserialize($this->group_data['permission']);

        $data['page_title'] = 'Manage Rate';

        $rates_data = $this->model_rates->get_rate();

        $result = array();
		foreach ($rates_data as $k => $v) {
			$result[$k]['rate_info'] = $v;
			$category_data = $this->model_category->get_category_details($v['vehicle_cat_id']);
			$result[$k]['cat_info'] = $category_data;
		}


		$data['rates_data'] = $result;

        $this->load->view('template/header', $data);
        $this->load->view('template/side_menubar');
        $this->load->view('template/header_menu');
        $this->load->view('rates/index', $data);
        $this->load->view('template/footer');
    }

    /*
        Display create Rates page and Insert rates into the database
    */
    public function create()
    {
        // check if allowed to access the page
        if(!in_array('createRates', $this->permission)) {
			redirect('errors', 'refresh');
		}
        // access permission
        $data['user_permission'] = unserialize($this->group_data['permission']);

        $data['page_title'] = 'Add Rate';

        $this->form_validation->set_rules('rate_name', 'Rate Name', 'required|trim');
		$this->form_validation->set_rules('category_name', 'Category', 'required|trim');
		$this->form_validation->set_rules('rate', 'Rate', 'required|integer|trim');
		$this->form_validation->set_rules('rate_status', 'Status', 'required|trim');

        if ($this->form_validation->run() == TRUE) {
            /* table column rates and html post fields */
            $rate_name = $this->input->post('rate_name');
            $category_name = $this->input->post('category_name');
            $type = 1;
            $rate = $this->input->post('rate');
            $rate_status = $this->input->post('rate_status');

            $data = array(
        		'rate_name' => $rate_name,
        		'vehicle_cat_id' => $category_name,
        		'type' => $type,
        		'rate' => $rate,
        		'active' => $rate_status
        	);

            $check = $this->model_rates->check_rates($rate_name, $category_name);

            if($check == false){
                $create = $this->model_rates->create($data);
                if($create == true){
                    $this->session->set_flashdata('success', 'Successfully created');
                    redirect('admin/rates', 'refresh');
                }
                else{
                    $this->session->set_flashdata('error', 'Error occurred!!');
                    redirect('admin/rates/create', 'refresh');
                }
            }
            else{
                $this->session->set_flashdata('error', 'Rate Name is already exist!!');
                redirect('rates/create', 'refresh');
            }
        }
        else{

            $category_data = $this->model_category->get_active_category();
        	$data['category_data'] = $category_data;

            $this->load->view('template/header', $data);
            $this->load->view('template/side_menubar');
            $this->load->view('template/header_menu');
            $this->load->view('rates/create');
            $this->load->view('template/footer');
        }
    }

    /*
        Display Edit Rate page and update Rate into the database
    */
    public function edit($id = null)
    {
        // check if allowed to access the page
        if(!in_array('updateRates', $this->permission)) {
			redirect('errors', 'refresh');
		}
        // access permission
        $data['user_permission'] = unserialize($this->group_data['permission']);

        if($id){
            $data['page_title'] = 'Edit Rate';

            $this->form_validation->set_rules('rate_name', 'Rate Name', 'required|trim');
            $this->form_validation->set_rules('category_name', 'Category', 'required|trim');
            $this->form_validation->set_rules('type', 'Type', 'required|trim');
            $this->form_validation->set_rules('rate', 'Rate', 'required|integer|trim');
            $this->form_validation->set_rules('rate_status', 'Status', 'required|trim');
    
            if ($this->form_validation->run() == TRUE) {
                /* table column rates and html post fields */
                $rate_name = $this->input->post('rate_name');
                $category_name = $this->input->post('category_name');
                $type = $this->input->post('type');
                $rate = $this->input->post('rate');
                $rate_status = $this->input->post('rate_status');
    
                $data = array(
                    'rate_name' => $rate_name,
                    'vehicle_cat_id' => $category_name,
                    'type' => $type,
                    'rate' => $rate,
                    'active' => $rate_status
                );
    
                $check = $this->model_rates->check_other_rates($rate_name, $category_name, $id);
    
                if($check == false){
                    $create = $this->model_rates->update($data, $id);
                    if($create == true){
                        $this->session->set_flashdata('success', 'Successfully created');
                        redirect('admin/rates', 'refresh');
                    }
                    else{
                        $this->session->set_flashdata('error', 'Error occurred!!');
                        redirect('admin/rates/edit/' . $id, 'refresh');
                    }
                }
                else{
                    $this->session->set_flashdata('error', 'Rate Name is already exist!!');
                    redirect('rates/edit/' . $id, 'refresh');
                }
            }
            else{
                /*
                    Get the Category List in the database
                */
                $category_data = $this->model_category->get_active_category();
                $data['category_data'] = $category_data;
                /*
                    Get the Rate Detail in the database using the id
                */
                $rate_data = $this->model_rates->get_rates_details($id);
                $data['rate_data'] = $rate_data;
    
                $this->load->view('template/header', $data);
                $this->load->view('template/side_menubar');
                $this->load->view('template/header_menu');
                $this->load->view('rates/edit', $data);
                $this->load->view('template/footer');
            }
        }
    }

    /*
        Delete the rates in the database
    */
    public function delete($id){
        // check if allowed to access the page
        if(!in_array('deleteRates', $this->permission)) {
			redirect('errors', 'refresh');
		}
        if($id){
            $delete = $this->model_rates->delete($id);
            if($delete == true) {
                $this->session->set_flashdata('success', 'Successfully removed');
                redirect('admin/rates', 'refresh');
            }
            else {
                $this->session->set_flashdata('error', 'Error occurred!!');
                redirect('admin/rates', 'refresh');
            }
        }
    }

}