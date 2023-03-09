<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
class Reports extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('model_groups');
        $this->load->model('model_dashboard');
        $this->load->model('model_reports');

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
        Display the Report Page
    */
    public function index($year = null)
    {
        // check if allowed to access the page
        if(!in_array('viewReports', $this->permission)) {
			redirect('errors', 'refresh');
		}

        $data['page_title'] = 'Reports';
        // access permission
        $data['user_permission'] = unserialize($this->group_data['permission']);

        // get the year in the parking table for filtering year in the report
        $data['report_years'] = $this->model_dashboard->get_parking_year();
        // Get current year
        $today_year = date('Y');
        if($year){
            $today_year = $year;
        }
        
        $data['year'] = $today_year;

        $parking_data = $this->model_reports->get_parking_data_per_year($today_year);

        $final_parking_data = array();
		foreach ($parking_data as $k => $v) {
			
			if(count($v) > 1) {
				$total_amount_earned = array();
				foreach ($v as $k2 => $v2) {
					if($v2) {
						$total_amount_earned[] = $v2['earned_amount'];
					}
				}
				$final_parking_data[$k] = array_sum($total_amount_earned);	
			}
			else {
				$final_parking_data[$k] = 0;	
			}
		}

        $data['parking_data'] = $final_parking_data;

        $this->load->view('template/header', $data);
        $this->load->view('template/side_menubar');
        $this->load->view('template/header_menu');
        $this->load->view('reports/index', $data);
        $this->load->view('template/footer');
    }

}