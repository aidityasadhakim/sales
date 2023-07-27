<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ChangePassword extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        isLogin();
        $this->load->model('Operatormodel', 'operator');
    }

    function index()
    {
        $id = "5";
        $dataUpdate = array(
            'name'  => "istanahp",
            'username'  => "istanahp",
            'password' => md5("123")
        );

        $this->operator->updateData($id, $dataUpdate);
    }
}
