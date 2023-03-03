<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
class Parking extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('model_parking');
        $this->load->model('model_category');
        $this->load->model('model_slots');
        $this->load->model('model_rates');
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

    public function index()
    {
        $data['page_title'] = 'Manage Parking';

        $parking_data = $this->model_parking->get_parking();
	
		$result = array();
		foreach ($parking_data as $k => $v) {
			$result[$k]['parking'] = $v;
			$category_data = $this->model_category->get_category_details($v['vehicle_cat_id']);
			$slot_data = $this->model_slots->get_slot_details($v['slot_id']);
			$rate_data = $this->model_rates->get_rates_details($v['rate_id']);

			$result[$k]['category'] = $category_data;
			$result[$k]['slot'] = $slot_data;
			$result[$k]['rate'] = $rate_data;
		}

        $data['parking_data'] = $result;
        $this->load->view('template/header', $data);
        $this->load->view('template/side_menubar');
        $this->load->view('template/header_menu');
        $this->load->view('parking/index', $data);
        $this->load->view('template/footer');
    }

    /*
        Display create Parking page and Insert parking details into the database
    */
    public function create()
    {

        $data['page_title'] = 'Add Parking';

        $this->form_validation->set_rules('parking_slot', 'Slot', 'required');
		$this->form_validation->set_rules('vehicle_cat', 'Category', 'required');
		$this->form_validation->set_rules('vehicle_rate', 'Rate', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case

        	$parking_code = strtoupper('parking-'.substr(md5(uniqid(mt_rand(), true)), 0, 6));
            $vehicle_cat = $this->input->post('vehicle_cat');
            $vehicle_rate = $this->input->post('vehicle_rate');
            $parking_slot = $this->input->post('parking_slot');

        	$data = array(
        		'parking_code' => $parking_code,
        		'vechile_cat_id' => $vehicle_cat,
        		'rate_id' => $vehicle_rate,
        		'slot_id' => $parking_slot,
        		'in_time' => strtotime('now'),
        		'paid_status' => 0
        	);

        	$create = $this->model_parking->create($data);
        	if($create == true) {

        		// now unavailable the slot
        		$slot_data = array(
        			'availability_status' => 2
        		);

        		$update_slot = $this->model_slots->update_slot_availability($slot_data, $parking_slot);

        		if($create == true && $update_slot == true) {
        			$this->session->set_flashdata('success', 'Successfully created');
		    		redirect('parking', 'refresh');	
        		}
        		else {
        			$this->session->set_flashdata('errors', 'Error occurred!!');
	        		redirect('parking/create', 'refresh');
        		}
        		
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('parking/create', 'refresh');
        	}
        }
        else {
        	$vehicle_cat = $this->model_category->get_active_category();
        	
        	$data['vehicle_cat'] = $vehicle_cat;

        	$slots = $this->model_slots->get_available_slot();
        	$data['slot_data'] = $slots;

			$this->load->view('template/header', $data);
            $this->load->view('template/side_menubar');
            $this->load->view('template/header_menu');
            $this->load->view('parking/create', $data);
            $this->load->view('template/footer');
		}
    }

    /*
        Get list of rate by vehicle category and return to JSON
    */
    public function get_category_rate($id)
    {
        if($id){
            $rate_data = $this->model_rates->get_category_rate($id);
			$html = '';
			foreach ($rate_data as $k => $v) {
				$html .= '<option value="'.$v['id'].'">'.$v['rate_name'].'</option>';
			}
			
			echo json_encode($html);
        }
    }

}