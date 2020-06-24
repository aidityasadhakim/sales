<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        isLogin();
        $this->load->model('Operatormodel', 'operator');
    }

    // List all your items
    public function index( $offset = 0 )
    {
        $id = $this->session->userdata('id');
        $data['row'] = $this->operator->getDataById($id);
        if ($this->input->post('submit')) {

            $name = $this->input->post('name');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');

            if ($password != '') {
                if ($password != $confirm_password) {
                    $this->session->set_flashdata('error', 'Password tidak sesuai!');
                    redirect('setting');
                }
                else {

                    $dataUpdate = array(
                                'name'  => $name,
                                'username'  => $username,
                                'password' => md5($password)
                                );

                    $checkExist = $this->operator->checkExistUpdate($id, $username);

                    if ($checkExist != 0) {
                        $this->session->set_flashdata('error', 'Username sudah dipakai!');
                        redirect('setting');
                    }
                    else {
                        $this->operator->updateData($id, $dataUpdate);
                        $this->session->set_flashdata('msg', 'Data berhasil diubah!');
                        redirect('setting');
                    }
                }
            }
            else {
                $dataUpdate = array(
                            'name'  => $name,
                            'username'  => $username
                            );

                $checkExist = $this->operator->checkExistUpdate($id, $username);

                if ($checkExist != 0) {
                    $this->session->set_flashdata('error', 'Username sudah dipakai!');
                    redirect('setting');
                }
                else {
                    $this->operator->updateData($id, $dataUpdate);
                    $this->session->set_flashdata('msg', 'Data berhasil diubah!');
                    redirect('setting');
                }

            }  
        }
        else {
            $data['title'] = 'Pengaturan Akun';
            $data['page']  = 'master';
            $this->load->view('operators/update_setting', $data);
        }
    }
}

/* End of file Setting.php */
/* Location: ./application/controllers/Setting.php */

 ?>