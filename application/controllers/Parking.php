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
        $this->load->model('model_company');
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

    public function index()
    {
		// check if allowed to access the page
        if(!in_array('viewParking', $this->permission)) {
			redirect('errors', 'refresh');
		}
        // access permission
        $data['user_permission'] = unserialize($this->group_data['permission']);

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
		// check if allowed to access the page
        if(!in_array('createParking', $this->permission)) {
			redirect('errors', 'refresh');
		}
        // access permission
        $data['user_permission'] = unserialize($this->group_data['permission']);

        $data['page_title'] = 'Add Parking';

        $this->form_validation->set_rules('parking_slot', 'Slot', 'required');
		$this->form_validation->set_rules('vehicle_cat', 'Category', 'required');
		$this->form_validation->set_rules('vehicle_rate', 'Rate', 'required');
		$this->form_validation->set_rules('customer_name', 'Customer Name', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case

        	$parking_code = strtoupper('p-'.substr(md5(uniqid(mt_rand(), true)), 0, 6));
            $vehicle_cat = $this->input->post('vehicle_cat');
            $vehicle_rate = $this->input->post('vehicle_rate');
            $parking_slot = $this->input->post('parking_slot');
            $customer = $this->input->post('customer_name');

            /* table column parking and html post fields */
        	$data = array(
        		'parking_code' => $parking_code,
				'customer' => $customer,
        		'vehicle_cat_id' => $vehicle_cat,
        		'rate_id' => $vehicle_rate,
        		'slot_id' => $parking_slot,
        		'in_time' => strtotime('now'),
        		'paid_status' => 0
        	);
            /* insert into the table parking */
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
        Display Edit Parking page and update parking into the database
    */
    public function edit($id=null)
    {
		// check if allowed to access the page
        if(!in_array('updateParking', $this->permission)) {
			redirect('errors', 'refresh');
		}
        // access permission
        $data['user_permission'] = unserialize($this->group_data['permission']);

        if($id){
            $data['page_title'] = 'Edit Parking';

            $this->form_validation->set_rules('parking_slot', 'Slot', 'required');
            $this->form_validation->set_rules('vehicle_cat', 'Category', 'required');
            $this->form_validation->set_rules('vehicle_rate', 'Rate', 'required');
			$this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
    
            if ($this->form_validation->run() == TRUE) {
                // true case
                $save_parking_data = $this->model_parking->get_parking_details($id);
                $slot_id = $save_parking_data['slot_id'];
                // update the slot data
	        	$update_slot_data = array(
	        		'availability_status' => 1
	        	);
	        	$this->model_slots->update_slot_availability($update_slot_data, $slot_id);
                /* table column parking and html post fields */
                $vehicle_cat = $this->input->post('vehicle_cat');
                $vehicle_rate = $this->input->post('vehicle_rate');
                $parking_slot = $this->input->post('parking_slot');
				$customer = $this->input->post('customer_name');
	        	$data = array(
	        		'vehicle_cat_id' => $vehicle_cat,
	        		'rate_id' => $vehicle_rate,
	        		'slot_id' => $parking_slot,
					'customer' => $customer
	        	);

	        	$update_parking_data = $this->model_parking->update($data, $id);
	        	if($update_parking_data == true) {

	        		// now unavailable the slot
	        		$slot_data = array(
	        			'availability_status' => 2
	        		);

	        		$update_slot = $this->model_slots->update_slot_availability($slot_data, $this->input->post('parking_slot'));

	        		if($update_parking_data == true && $update_slot == true) {
	        			$this->session->set_flashdata('success', 'Successfully updated');
			    		redirect('parking', 'refresh');	
	        		}
	        		else {
	        			$this->session->set_flashdata('errors', 'Error occurred!!');
		        		redirect('parking/edit/' . $id, 'refresh');
	        		}
	        		
	        	}
	        	else {
	        		$this->session->set_flashdata('errors', 'Error occurred!!');
	        		redirect('parking/edit/' . $id, 'refresh');
	        	}
            }
            else {
                $vehicle_cat = $this->model_category->get_active_category();
                
                $data['vehicle_cat'] = $vehicle_cat;
    
                $slots = $this->model_slots->get_available_slot();
                $data['slot_data'] = $slots;

                $save_parking_data = $this->model_parking->get_parking_details($id);
	        	$data['save_parking_data'] = $save_parking_data;

	        	// used parking slot info
	        	$get_used_slot = $this->model_slots->get_slot_details($save_parking_data['slot_id']);

	        	$get_used_rate = $this->model_rates->get_category_rate($save_parking_data['vehicle_cat_id']);

	        	$data['slot_data'][] = $get_used_slot;
                $data['get_used_rate_data'] = $get_used_rate;
    
                $this->load->view('template/header', $data);
                $this->load->view('template/side_menubar');
                $this->load->view('template/header_menu');
                $this->load->view('parking/edit', $data);
                $this->load->view('template/footer');
            }
        }
    }

    
    /*
        Delete the parking in the database
    */
    public function delete($id, $slotid)
    {
		// check if allowed to access the page
        if(!in_array('deleteParking', $this->permission)) {
			redirect('errors', 'refresh');
		}
        if($id && $slotid){
            // now available the slot
            $slot_data = array(
                'availability_status' => 1
            );
            $this->model_slots->update_slot_availability($slot_data, $slotid);
            $delete = $this->model_parking->delete($id);
            if($delete == true) {
                $this->session->set_flashdata('success', 'Successfully removed');
                redirect('parking', 'refresh');
            }
            else {
                $this->session->set_flashdata('error', 'Error occurred!!');
                redirect('parking', 'refresh');
            }
        }
    }

    /*
        Update the parking details to paid in the database
    */
    public function updatepayment()
    {
        $id = $this->input->post('parking_id');
		if($id) {
			$payment_status = $this->input->post('payment_status');

            if($payment_status == 1) {

                // get the data of parking data
				$data = $this->model_parking->get_parking_details($id);

                $check_in_time = $data['in_time'];
				$rate_id = $data['rate_id'];
				$slot_id = $data['slot_id'];

                $checkout_time = strtotime('now');
                // calculates the time by hourly
                $total_time = ceil((abs($checkout_time - $check_in_time) / 60) / 60);
                // get rates
                $rate_data = $this->model_rates->get_rates_details($rate_id);

                $update_data = array(
					'out_time' => $checkout_time,
					'paid_status' => 1,
					'total_time' => $total_time,
					'earned_amount' => $rate_data['rate']
				);
            }else{
                $update_data = array(
					'out_time' => '',
					'paid_status' => 0,
					'total_time' => '',
					'earned_amount' => 0				
				);
            }

			$updatePayment = $this->model_parking->update($update_data, $id);

			if($updatePayment == true) {
				$slot_update_data = array(
					'availability_status' => 1
				); 
				$update_slot_ops = $this->model_slots->update($slot_update_data, $slot_id);
    			$this->session->set_flashdata('success', 'Successfully paid.');
	    		redirect('parking', 'refresh');	
    		}
    		else {
    			$this->session->set_flashdata('payment_error', 'Error occurred!!');
        		redirect('parking/edit/'.$id, 'refresh');
    		}
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

    /*
        Print invoice
    */
    public function print_invoice($id)
    {
        if($id){
            $parking_data = $this->model_parking->get_parking_details($id);
			$company_info = $this->model_company->get_company(1);

			// get the vehicle type 
			$vehicle_category = $this->model_category->get_category_details($parking_data['vehicle_cat_id']);

			$check_in_date = date("Y-m-d", $parking_data['in_time']);
			$check_in = date("h:i a", $parking_data['in_time']);
			$slot = $this->model_slots->get_slot_details($parking_data['slot_id']);

			$html = '<html>
				<head>
				 	<title>Print</title>
				 	<style>
				 	.main-content {
					    text-align: center;
					    width: 100%;
					}

					table.table {
					    width: 50%;
					    margin: 0 auto;
					    text-align: left;
					}
				 	</style>
				</head>
				<body>
					<div class="main-content">
						<div class="company-info">
							<div class="company-name"><p>'.$company_info['name'].'</p></div>
							<div class="company-address"><p>'.$company_info['address'].'</p></div>
							<div class="parking-slip"><h2>Parking Slip</h2></div>
						</div>
						<div class="parking-info">
							<table class="table">
								<tr>
									<td>Date: '.$check_in_date.'</td>
									<td>Time: '.$check_in.'</td>
								</tr>
								<tr>
									<td>Parking no: '.$parking_data['parking_code'].' </td>
									<td>Slot #: '.$slot['slot_name'].'</td>
								</tr>
								<tr>
									<td>Vehicle type: '.ucwords($vehicle_category['name']).' </td>
								</tr>
								<tr>
									<td>Customer Name: '.$parking_data['customer'].' </td>
								</tr>
								
							</table>

							<p> For you own convenience, please do not loose the slip. </p>
						</div>
						<div class="parking-message">
							'.$company_info['message'].'
						</div>
					</div>					
				</body>
			</html>
			';

			echo $html;
        }
    }

}