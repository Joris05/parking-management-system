<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
class Category extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('model_category');
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
        Display the Manage Category Page
    */
    public function index()
    {
        $data['page_title'] = 'Manage Category';
        $data['category_data'] = $this->model_category->get_category();

        $this->load->view('template/header', $data);
        $this->load->view('template/side_menubar');
        $this->load->view('template/header_menu');
        $this->load->view('category/index', $data);
        $this->load->view('template/footer');
    }

    /*
        Display create Category page and Insert category into the database
    */
    public function create()
    {
        $data['page_title'] = 'Add Category';

        $this->form_validation->set_rules('category_name', 'Category name', 'required|trim');
		$this->form_validation->set_rules('category_active', 'Status', 'required|trim');

        if ($this->form_validation->run() == TRUE) {
            /* table column category and html post fields */
            $category_name = $this->input->post('category_name');
            $category_status = $this->input->post('category_active');
            $data = array(
        		'name' => $category_name,
        		'active' => $category_status
        	);

            $check = $this->model_category->check_category($category_name);

            if($check == false){
                $create = $this->model_category->create($data);
                if($create == true){
                    $this->session->set_flashdata('success', 'Successfully created');
                    redirect('category', 'refresh');
                }
                else{
                    $this->session->set_flashdata('error', 'Error occurred!!');
                    redirect('category/create', 'refresh');
                }
            }
            else{
                $this->session->set_flashdata('error', 'Category Name is already exist!!');
                redirect('category/create', 'refresh');
            }
        }
        else{
            $this->load->view('template/header', $data);
            $this->load->view('template/side_menubar');
            $this->load->view('template/header_menu');
            $this->load->view('category/create');
            $this->load->view('template/footer');
        }
    }

    /*
        Display Edit Category page and update category into the database
    */
    public function edit($id = null)
    {
        if($id){
            $data['page_title'] = 'Edit Category';

            $this->form_validation->set_rules('category_name', 'Category name', 'required|trim');
            $this->form_validation->set_rules('category_active', 'Status', 'required|trim');

            if ($this->form_validation->run() == TRUE) {
                /* table column category and html post fields */
                $category_name = $this->input->post('category_name');
                $category_status = $this->input->post('category_active');
                $data = array(
                    'name' => $category_name,
                    'active' => $category_status
                );

                $check = $this->model_category->check_other_category($category_name, $id);

                if($check == false){
                    $create = $this->model_category->update($data, $id);
                    if($create == true){
                        $this->session->set_flashdata('success', 'Successfully updated');
                        redirect('category', 'refresh');
                    }
                    else{
                        $this->session->set_flashdata('error', 'Error occurred!!');
                        redirect('category/edit' . $id, 'refresh');
                    }
                }
                else{
                    $this->session->set_flashdata('error', 'Category Name is already exist!!');
                    redirect('category/edit/' . $id, 'refresh');
                }
            }
            else{
                /*
                    Get the details of the Category by ID in the database
                */
                $data['category_data'] = $this->model_category->get_category_details($id);
                $this->load->view('template/header', $data);
                $this->load->view('template/side_menubar');
                $this->load->view('template/header_menu');
                $this->load->view('category/edit', $data);
                $this->load->view('template/footer');
            }
        }
    }

    /*
        Delete the category in the database
    */
    public function delete($id){
        if($id){
            $delete = $this->model_category->delete($id);
            if($delete == true) {
                $this->session->set_flashdata('success', 'Successfully removed');
                redirect('category', 'refresh');
            }
            else {
                $this->session->set_flashdata('error', 'Error occurred!!');
                redirect('category', 'refresh');
            }
        }
    }

}