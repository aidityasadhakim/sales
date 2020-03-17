<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Loginmodel','login');

    }

    // List all your items
    public function index( $offset = 0 )
    {
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->login->checkLogin($username, $password);

            if (!empty($user)) {
                $sessionData['id'] = $user['id'];
                $sessionData['username'] = $user['username'];
                $sessionData['full_name'] = $user['name'];
                $sessionData['level'] = $user['level'];
                $sessionData['is_login'] = TRUE;

                $this->session->set_userdata($sessionData);
                $dataUpdate = array('last_login' => date('Y-m-d H:i:s'));
                $this->login->updatePass($user['id'], $dataUpdate);
                redirect('dashboard');
            }

            $this->session->set_flashdata('error', 'Login gagal!, username dan password salah! ');
            redirect('login');
        }
        $data['title'] = 'Login';
        $data['page'] = 'login';
        $this->load->view('login', $data);
    }
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */

 ?>