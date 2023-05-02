<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('model_slots');
		$this->load->model('model_category');
    }

	public function index()
	{
		// Get the list of Vehicles
        $vehicle_cat = $this->model_category->get_active_category();

		$final_vehicle_datas = array();
        foreach ($vehicle_cat as $k => $v) {
            $tslots = $this->model_slots->count_available_slot_by_vehicle($v['id']);
            $final_vehicle_datas[$k]['vehicle'] = $v;
            $final_vehicle_datas[$k]['slots'] = $tslots;
        }
        $data['vehicle_datas'] = $final_vehicle_datas;

		$this->load->view('customer/header');
		$this->load->view('customer/home', $data);
		$this->load->view('customer/footer');
	}

	public function contact()
	{
		$this->load->view('customer/header');
		$this->load->view('customer/contact');
		$this->load->view('customer/footer');
	}
}
