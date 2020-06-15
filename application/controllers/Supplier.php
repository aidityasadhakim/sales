<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        isLogin();
        $this->load->model('Suppliermodel', 'supplier');

    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['title'] = 'Master Pemasok';
        $data['page'] = 'master';
        $data['suppliers'] = $this->supplier->getAllData();
        $this->load->view('suppliers/view', $data);
    }

    // Add a new item
    public function add()
    {
        if ($this->input->post('submit')) {

            $name = $this->input->post('name');
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');

            $dataInsert = array(
                        'name'  => $name,
                        'phone'  => $phone,
                        'address'  => $address
                        );            

            $this->supplier->insertData($dataInsert);
            $this->session->set_flashdata('msg', 'Data berhasil ditambah!');
            redirect('supplier');
        }
        else {
            $data['title'] = 'Tambah Data Pemasok';
            $data['page']  = 'master';
            $this->load->view('suppliers/insert',$data);
        }
    }

    //Update one item
    public function update( $id = NULL )
    {
        $data['row'] = $this->supplier->getDataById($id);
        if ($this->input->post('submit')) {

            $name = $this->input->post('name');
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');

            $dataUpdate = array(
                        'name'  => $name,
                        'phone'  => $phone,
                        'address'  => $address
                        );    
            

            $this->supplier->updateData($id, $dataUpdate);
            $this->session->set_flashdata('msg', 'Data berhasil diubah!');
            redirect('supplier');
        }
        else {
            $data['title'] = 'Ubah Data Pemasok';
            $data['page']  = 'master';
            $this->load->view('suppliers/update', $data);
        }
    }

    //Delete one item
    public function delete( $id = NULL )
    {
        $this->supplier->deleteData($id);
        $this->session->set_flashdata('msg', 'Data berhasil dihapus!');
        redirect('supplier');
    }
}

/* End of file Supplier.php */
/* Location: ./application/controllers/Supplier.php */

 ?>