<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('model_auth');
    }

    /*
        Checks if the user is already login, if login the user
        redirects to the Dashboard page
    */
    private function is_logged_in()
    {
        if ($this->session->userdata('logged_in') == TRUE) {
            redirect('admin/dashboard');
        }
    }

    /*
        Displays the login page
    */
    public function login()
    {
        $this->load->view('auth/login');
    }

    /* 
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/
    public function check_login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == TRUE) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $check_email = $this->model_auth->check_email($email);
            if($check_email == true){
                $login = $this->model_auth->login($email, $password);
                if($login){
                    $login_in_session = array(
                        'id' => $login['id'],
                        'username' => $login['username'],
                        'email' => $login['email'],
                        'logged_in' => TRUE
                    );
                    $this->session->set_userdata($login_in_session);
           			redirect('admin/dashboard', 'refresh');
                }
                else{
                    $data['errors'] = 'Incorrect username/password combination';
           			$this->load->view('auth/login', $data);
                }
            }
            else{
                $data['errors'] = 'Email does not exists';
           		$this->load->view('auth/login', $data);
            }
        }
        else {           
            $this->load->view('auth/login');
        }
    }

}