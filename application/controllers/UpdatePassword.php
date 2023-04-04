<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class UpdatePassword extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        isLogin();
        $this->load->model('Itemmodel', 'item');
        $this->load->model('Operatormodel', 'operator');

    }

    // List all your items
    public function index( $offset = 0 )
    { 
        $dataUpdate = array(
            'name'  => 'Aling',
            'username'  => 'aling',
            'password' => md5('123123123')
            );

        $checkExist = $this->operator->checkExistUpdate(3, 'aling');

        if ($checkExist != 0) {
            $this->session->set_flashdata('error', 'Username sudah dipakai!');
            redirect('setting');
        }
        else {
            $this->operator->updateData(3, $dataUpdate);
            $this->session->set_flashdata('msg', 'Data berhasil diubah!');
            redirect('setting');
        }
   }
}
 ?>
