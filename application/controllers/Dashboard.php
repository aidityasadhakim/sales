<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        isLogin();

    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['title'] = 'Dashboard';
        $data['page'] = 'dashboard';
        $this->load->view('dashboard', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */