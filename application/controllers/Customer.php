<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        isLogin();
        $this->load->model('Customermodel', 'customer');
    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['title'] = 'Master Pelanggan';
        $data['page'] = 'master';
        $data['customers'] = $this->customer->getAllData();
        $this->load->view('customers/view', $data);
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

            $this->customer->insertData($dataInsert);
            $this->session->set_flashdata('msg', 'Data berhasil ditambah!');
            redirect('customer');
        }
        else {
            $data['title'] = 'Tambah Data Pelanggan';
            $data['page']  = 'master';
            $this->load->view('customers/insert',$data);
        }
    }

    //Update one item
    public function update( $id = NULL )
    {
        $data['row'] = $this->customer->getDataById($id);
        if ($this->input->post('submit')) {

            $name = $this->input->post('name');
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');

            $dataUpdate = array(
                        'name'  => $name,
                        'phone'  => $phone,
                        'address'  => $address
                        );    
            

            $this->customer->updateData($id, $dataUpdate);
            $this->session->set_flashdata('msg', 'Data berhasil diubah!');
            redirect('customer');
        }
        else {
            $data['title'] = 'Ubah Data Pelanggan';
            $data['page']  = 'master';
            $this->load->view('customers/update', $data);
        }
    }

    //Delete one item
    public function delete( $id = NULL )
    {
        $this->customer->deleteData($id);
        $this->session->set_flashdata('msg', 'Data berhasil dihapus!');
        redirect('customer');
    }
}

/* End of file Customer.php */
/* Location: ./application/controllers/Customer.php */

 ?>