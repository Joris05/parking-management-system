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
    public function index()
    {
        $data['page_title'] = 'Dasboard';

        $data['total_slots'] = $this->model_slots->get_total_slots();
        $data['total_users'] = $this->model_users->get_total_users();
        $data['total_parking'] = $this->model_parking->get_total_parking();

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