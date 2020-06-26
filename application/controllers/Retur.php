<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Retur extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        isLogin();
        $this->load->model('Returmodel', 'retur');
    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['title'] = 'Nota Retur';
        $data['page'] = 'returns';
        $data['returns'] = $this->retur->getAllData();
        $this->load->view('returns/view', $data);
    }

    // Add a new item
    public function add()
    {
        if ($this->input->post('submit')) {

            $transaction_date = $this->input->post('transaction_date');
            $sale_id = $this->input->post('sale_id');
            $note = $this->input->post('note');

            $dataInsert = array(
                        'transaction_date'  => $transaction_date,
                        'sale_id'  => $sale_id,
                        'note'  => $note,
                        'user_id' => $this->session->userdata('id')
                        );            

            $this->retur->insertData($dataInsert);
            $this->retur->updateDataSale($sale_id, array('status' => 3));
            $this->session->set_flashdata('msg', 'Data berhasil ditambah!');
            redirect('retur');
        }
        else {
            $data['title'] = 'Tambah Nota Retur';
            $data['page']  = 'returns';
            $data['sales'] = $this->retur->getAllDataSales();
            $this->load->view('returns/insert',$data);
        }
    }

    public function detail($id = '')
    {
        $data['title'] = 'Detil Nota Retur';
        $data['page']  = 'returns';
        $data['rowRetur'] = $this->retur->getDataById($id);
        $data['rowNota'] = $this->retur->getDataSalesById($data['rowRetur']['sale_id']);
        $data['resDetailNota'] = $this->retur->getDataDetailSalesByIdTrans($data['rowRetur']['sale_id']);
        $this->load->view('returns/detail',$data);
    }

    //Update one item
    public function update( $id = NULL )
    {

    }

    //Delete one item
    public function delete( $id = NULL )
    {

    }
}

/* End of file Retur.php */
/* Location: ./application/controllers/Retur.php */

 ?>