<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentMethod extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        isLogin();
        $this->load->model('PaymentMethodmodel', 'pay_method');
    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['title'] = 'Master Cara Pembayaran';
        $data['page'] = 'master';
        $data['methods'] = $this->pay_method->getAllData();
        $this->load->view('payment_methods/view', $data);
    }

    // Add a new item
    public function add()
    {
        if ($this->input->post('submit')) {

            $name = $this->input->post('name');

            $dataInsert = array('name'  => $name);            

            $this->pay_method->insertData($dataInsert);
            $this->session->set_flashdata('msg', 'Data berhasil ditambah!');
            redirect('PaymentMethod');
        }
        else {
            $data['title'] = 'Tambah Data Cara Pembayaran';
            $data['page']  = 'master';
            $this->load->view('payment_methods/insert',$data);
        }
    }

    //Update one item
    public function update( $id = NULL )
    {
        $data['row'] = $this->pay_method->getDataById($id);
        if ($this->input->post('submit')) {

            $name = $this->input->post('name');

            $dataUpdate = array('name'  => $name);

            $this->pay_method->updateData($id, $dataUpdate);
            $this->session->set_flashdata('msg', 'Data berhasil diubah!');
            redirect('PaymentMethod');
        }
        else {
            $data['title'] = 'Ubah Data Cara Pembayaran';
            $data['page']  = 'master';
            $this->load->view('payment_methods/update', $data);
        }
    }

    //Delete one item
    public function delete( $id = NULL )
    {
        $this->pay_method->deleteData($id);
        $this->session->set_flashdata('msg', 'Data berhasil dihapus!');
        redirect('PaymentMethod');
    }
}

/* End of file PaymentMethod.php */
/* Location: ./application/controllers/PaymentMethod.php */

 ?>