<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
class Company extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('model_company');
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
        Display the Manage Company Page
    */
    public function index()
    {
        $data['page_title'] = 'Manage Company';
        $company_id = 1;

		$this->form_validation->set_rules('company_name', 'Category name', 'required|trim');
        $this->form_validation->set_rules('address', 'Status', 'required|trim');

        if ($this->form_validation->run() == TRUE) {
            // true case
        	$data = array(
        		'name' => $this->input->post('company_name'),
        		'address' => $this->input->post('address'),
                'message' => trim($this->input->post('message')),
        	);

        	$update = $this->model_company->update($data, $company_id);
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        	}

        	redirect('company', 'refresh');
        }
        else {
			$company_data = $this->model_company->get_company($company_id);
			$data['company_data'] = $company_data;
			$this->load->view('template/header', $data);
            $this->load->view('template/side_menubar');
            $this->load->view('template/header_menu');
            $this->load->view('company/index', $data);
            $this->load->view('template/footer');
		}

        
    }

}