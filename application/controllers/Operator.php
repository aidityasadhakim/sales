<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Operator extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        isLoginAdmin();
        $this->load->model('Operatormodel', 'operator');
    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['title'] = 'Master Operator';
        $data['page'] = 'master';
        $data['operators'] = $this->operator->getAllData();
        $this->load->view('operators/view', $data);
    }

    // Add a new item
    public function add()
    {
        if ($this->input->post('submit')) {

            $name = $this->input->post('name');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');
            $level = $this->input->post('level');

            if ($password != $confirm_password) {
                $this->session->set_flashdata('error', 'Password tidak sesuai!');
                redirect('operator/add');
            }
            else {

                $dataInsert = array(
                            'name'  => $name,
                            'username'  => $username,
                            'level' => $level,
                            'password' => md5($password),
                            'status' => 1
                            );

                $checkExist = $this->operator->checkExist($username);

                if ($checkExist != 0) {
                    $this->session->set_flashdata('error', 'Username sudah dipakai!');
                    redirect('operator/add');
                }
                else {
                    $this->operator->insertData($dataInsert);
                    $this->session->set_flashdata('msg', 'Data berhasil ditambah!');
                    redirect('operator');
                }
            }
        }
        else {
            $data['title'] = 'Tambah Data Operator';
            $data['page']  = 'master';
            $this->load->view('operators/insert',$data);
        }
    }

    //Update one item
    public function update( $id = NULL )
    {
        $data['row'] = $this->operator->getDataById($id);
        if ($this->input->post('submit')) {

            $name = $this->input->post('name');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');
            $level = $this->input->post('level');

            if ($password != '') {
                if ($password != $confirm_password) {
                    $this->session->set_flashdata('error', 'Password tidak sesuai!');
                    redirect('operator/update/'.$id);
                }
                else {

                    $dataUpdate = array(
                                'name'  => $name,
                                'username'  => $username,
                                'level' => $level,
                                'password' => md5($password)
                                );

                    $checkExist = $this->operator->checkExistUpdate($id, $username);

                    if ($checkExist != 0) {
                        $this->session->set_flashdata('error', 'Username sudah dipakai!');
                        redirect('operator/update/'.$id);
                    }
                    else {
                        $this->operator->updateData($id, $dataUpdate);
                        $this->session->set_flashdata('msg', 'Data berhasil diubah!');
                        redirect('operator');
                    }
                }
            }
            else {
                $dataUpdate = array(
                            'name'  => $name,
                            'username'  => $username,
                            'level' => $level
                            );

                $checkExist = $this->operator->checkExistUpdate($id, $username);

                if ($checkExist != 0) {
                    $this->session->set_flashdata('error', 'Username sudah dipakai!');
                    redirect('operator/update/'.$id);
                }
                else {
                    $this->operator->updateData($id, $dataUpdate);
                    $this->session->set_flashdata('msg', 'Data berhasil diubah!');
                    redirect('operator');
                }

            }  
        }
        else {
            $data['title'] = 'Ubah Data Operator';
            $data['page']  = 'master';
            $this->load->view('operators/update', $data);
        }
    }

    //Delete one item
    public function delete( $id = NULL )
    {
        $this->operator->deleteData($id);
        $this->session->set_flashdata('msg', 'Data berhasil dihapus!');
        redirect('operator');
    }
}

/* End of file Operator.php */
/* Location: ./application/controllers/Operator.php */

 ?>