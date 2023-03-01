<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
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
        $this->load->view('template/header', $data);
        $this->load->view('template/side_menubar');
        $this->load->view('template/header_menu');
        $this->load->view('dashboard/index');
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