<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transactionmodel', 'trans');
        $this->load->model('Residencemodel', 'res');
        $this->load->model('Mansionmodel', 'mans');
        $this->load->model('Ratemodel', 'rate');
        isLogin();
    }

    // List all your items
    public function index($type)
    {
        $data['title'] = 'Data Transaksi '.getLabelUnitType($type);
        $data['page'] = 'trans_'.$type;
        $data['type'] = $type;
        $data['transactions'] = $this->trans->getAllDataByType($type);
        if ($type == 1) {
            $this->load->view('transactions/residence_view', $data);
        }
        elseif ($type == 2) {
            $this->load->view('transactions/mansion_view', $data);
        }
    }

    // Add a new item
    public function add($type)
    {
        if ($this->input->post('unit_id')) {

            $unit_type = $this->input->post('unit_type');
            $unit_id = $this->input->post('unit_id');
            $transaction_date = $this->input->post('transaction_date');
            $period = $this->input->post('period').'-01';
            $due_date = $this->input->post('period').'-20';
            $el_last_used = $this->input->post('el_last_used');
            $el_used = $this->input->post('el_used');
            $el_total_used = $this->input->post('el_total_used');
            $el_rate = $this->input->post('el_rate');
            $pasum = $this->input->post('pasum');
            $abonemen = $this->input->post('abonemen');
            $ppju = $this->input->post('ppju');
            $ppn = $this->input->post('ppn');
            $el_total_price = $this->input->post('el_total_price');
            $water_last_used = $this->input->post('water_last_used');
            $water_used = $this->input->post('water_used');
            $water_total_used = $this->input->post('water_total_used');
            $water_rate = $this->input->post('water_rate');
            $water_total_price = $this->input->post('water_total_price');
            $cs_area = $this->input->post('cs_area');
            $cs_rate = $this->input->post('cs_rate');
            $cs_total_price = $this->input->post('cs_total_price');
            $cabletv_total_price = $this->input->post('cabletv_total_price');
            $sf_total_price = $this->input->post('sf_total_price');
            $grand_total = $el_total_price + $water_total_price + $cs_total_price + $cabletv_total_price + $sf_total_price;


            $dataInsert = array('unit_type' => $unit_type,
                        'unit_id'  => $unit_id,
                        'transaction_date'  => $transaction_date,
                        'period'  => $period,
                        'due_date'  => $due_date,
                        'el_last_used'  => $el_last_used,
                        'el_used'  => $el_used,
                        'el_total_used'  => $el_total_used,
                        'el_rate'  => $el_rate,
                        'pasum'  => $pasum,
                        'abonemen'  => $abonemen,
                        'ppju'  => $ppju,
                        'ppn'  => $ppn,
                        'el_total_price'  => $el_total_price,
                        'water_last_used'  => $water_last_used,
                        'water_used'  => $water_used,
                        'water_total_used'  => $water_total_used,
                        'water_rate'  => $water_rate,
                        'water_total_price'  => $water_total_price,
                        'cs_area'  => $cs_area,
                        'cs_rate'  => $cs_rate,
                        'cs_total_price'  => $cs_total_price,
                        'cabletv_total_price'  => $cabletv_total_price,
                        'sf_total_price'  => $sf_total_price,
                        'grand_total' => $grand_total,
                        'created_by' => $this->session->userdata('id'),
                        'payment_status' => 0
                        );            

            $this->trans->insertData($dataInsert);
            $this->session->set_flashdata('msg', 'Data berhasil ditambah!');
            redirect('transaction/index/'.$type);
        }
        else {
            $data['title'] = 'Tambah Data Transaksi '.getLabelUnitType($type);
            $data['page'] = 'trans_'.$type;
            $data['type'] = $type;
            if ($type == 1) {
                $data['units'] = $this->res->getAllData();
                $this->load->view('transactions/residence_insert', $data);
            }
            else {
                $data['units'] = $this->mans->getAllData();
                $this->load->view('transactions/mansion_insert', $data);
            }
        }
    }

    //Update one item
    public function update( $id = NULL )
    {
        $data['row'] = $this->trans->getDataById($id);
        if ($this->input->post('unit_id')) {

            $transaction_date = $this->input->post('transaction_date');
            $period = $this->input->post('period').'-01';
            $due_date = $this->input->post('period').'-20';
            $el_last_used = $this->input->post('el_last_used');
            $el_used = $this->input->post('el_used');
            $el_total_used = $this->input->post('el_total_used');
            $el_rate = $this->input->post('el_rate');
            $pasum = $this->input->post('pasum');
            $abonemen = $this->input->post('abonemen');
            $ppju = $this->input->post('ppju');
            $ppn = $this->input->post('ppn');
            $el_total_price = $this->input->post('el_total_price');
            $water_last_used = $this->input->post('water_last_used');
            $water_used = $this->input->post('water_used');
            $water_total_used = $this->input->post('water_total_used');
            $water_rate = $this->input->post('water_rate');
            $water_total_price = $this->input->post('water_total_price');
            $cs_area = $this->input->post('cs_area');
            $cs_rate = $this->input->post('cs_rate');
            $cs_total_price = $this->input->post('cs_total_price');
            $cabletv_total_price = $this->input->post('cabletv_total_price');
            $sf_total_price = $this->input->post('sf_total_price');
            $grand_total = $el_total_price + $water_total_price + $cs_total_price + $cabletv_total_price + $sf_total_price;


            $dataUpdate = array(
                        'transaction_date'  => $transaction_date,
                        'period'  => $period,
                        'due_date'  => $due_date,
                        'el_last_used'  => $el_last_used,
                        'el_used'  => $el_used,
                        'el_total_used'  => $el_total_used,
                        'el_rate'  => $el_rate,
                        'pasum'  => $pasum,
                        'abonemen'  => $abonemen,
                        'ppju'  => $ppju,
                        'ppn'  => $ppn,
                        'el_total_price'  => $el_total_price,
                        'water_last_used'  => $water_last_used,
                        'water_used'  => $water_used,
                        'water_total_used'  => $water_total_used,
                        'water_rate'  => $water_rate,
                        'water_total_price'  => $water_total_price,
                        'cs_area'  => $cs_area,
                        'cs_rate'  => $cs_rate,
                        'cs_total_price'  => $cs_total_price,
                        'cabletv_total_price'  => $cabletv_total_price,
                        'sf_total_price'  => $sf_total_price,
                        'grand_total' => $grand_total,
                        'created_by' => $this->session->userdata('id'),
                        'payment_status' => 0
                        );  
            

            $this->trans->updateData($id, $dataUpdate);
            $this->session->set_flashdata('msg', 'Data berhasil diubah!');
            redirect('transaction/index/'.$data['row']['unit_type']);
        }
        else {
            $type = $data['row']['unit_type'];
            $data['title'] = 'Ubah Data Transaksi '.getLabelUnitType($type);
            $data['page'] = 'trans_'.$type;
            $data['type'] = $type;
            if ($type == 1) {
                $data['unit'] = $this->trans->getDataUnitByTransId($data['row']['unit_id'], 'residences');
                $this->load->view('transactions/residence_update',$data);
            }
            else {
                $data['unit'] = $this->trans->getDataUnitByTransId($data['row']['unit_id'], 'mansions');
                $this->load->view('transactions/mansion_update',$data);
            }
        }
    }

    //Delete one item
    public function delete( $id = NULL )
    {
        $row = $this->trans->getDataById($id);
        $this->trans->deleteData($id);
        $this->session->set_flashdata('msg', 'Data berhasil dihapus!');
        redirect('transaction/index/'.$row['unit_type']);
    }

    public function getData()
    {
        $type = $this->input->post('unit_type');
        $id = $this->input->post('unit_id');
        $period = $this->input->post('period');

        $lastPeriod = date('Y-m', strtotime('first day of previous month', strtotime($period)));
        $date = explode('-', $lastPeriod);

        if ($type == 1) {
            $unit = $this->res->getDataById($id);
        }
        else {
            $unit = $this->mans->getDataById($id);
        }

        $lastBill = $this->trans->getLastMonthBill($type, $id, $date[1], $date[0]);

        $rate = $this->rate->getAllData();

        $data = array('unit' => $unit, 'bill' => $lastBill, 'rate' => $rate);
        echo json_encode($data);
    }

    public function checkPeriod()
    {
        $type = $this->input->post('unit_type');
        $id = $this->input->post('unit_id');
        $period = $this->input->post('period');

        $date = explode('-', date('Y-m', strtotime($period)));

        $isExist = $this->trans->checkBillExistThisMonth($type, $id, $date[1], $date[0]);

        echo $isExist;
    }
}

/* End of file Transaction.php */
/* Location: ./application/controllers/Transaction.php */

 ?>