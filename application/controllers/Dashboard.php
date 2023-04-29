<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();

        $this->load->model('model_slots');
        $this->load->model('model_users');
        $this->load->model('model_parking');
        $this->load->model('model_dashboard');
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
            redirect('/', 'refresh');
        }
    }

    /*
        Displays the dashboard after success login.
        Loads the pages in the template
    */
    public function index($yr = null)
    {
        $data['page_title'] = 'Dashboard';

        $today_year = date('Y');
        if($this->input->post('select_year')) {
			$today_year = $this->input->post('select_year');
		}

        $data['user_permission'] = unserialize($this->group_data['permission']);

        // count the total slots
        $data['total_slots'] = $this->model_slots->get_total_slots();
        // count the total users
        $data['total_users'] = $this->model_users->get_total_users();
        // count the total parking
        $data['total_parking'] = $this->model_parking->get_total_parking();
        // get the year in the parking table for filtering year in the graph
        $data['report_years'] = $this->model_dashboard->get_parking_year();

        // Get the year either this year or filtered year selected
        $data['selected_year'] = $today_year;
        
        
        // Get the sum of the total earning per month of the year
        $parking_data = $this->model_dashboard->get_parking_data_year($today_year);
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

        // Get the list of Vehicles
        $vehicle_cat = $this->model_category->get_active_category();
        $final_vehicle_data = array();
        foreach ($vehicle_cat as $k => $v) {
            $final_vehicle_data[$k] = '"'.$v['name'].'"';
        }

        $final_vehicle_datas = array();
        foreach ($vehicle_cat as $k => $v) {
            $tslots = $this->model_slots->count_available_slot_by_vehicle($v['id']);
            $final_vehicle_datas[$k]['vehicle'] = $v;
            $final_vehicle_datas[$k]['slots'] = $tslots;
        }
        $data['vehicle_cat'] = $final_vehicle_data;
        $data['vehicle_datas'] = $final_vehicle_datas;


        $final_total_vehicle_data = array();
        $total_each_per_vehicle = $this->model_dashboard->get_total_per_vehicle();
        foreach ($total_each_per_vehicle as $k => $v) {
            $final_total_vehicle_data[$k] = '"'.$v['total_vehicle'].'"';	
        }
        $data['total_per_vehicle'] = $final_total_vehicle_data;

        $this->load->view('template/header', $data);
        $this->load->view('template/side_menubar');
        $this->load->view('template/header_menu');
        $this->load->view('dashboard/index', $data);
        $this->load->view('template/footer');
    }

    /*
		clears the session and redirects to login page
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/', 'refresh');
	}
}