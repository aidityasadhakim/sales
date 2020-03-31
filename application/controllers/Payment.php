<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Paymentmodel', 'payment');
        $this->load->model('Residencemodel', 'res');
        $this->load->model('Mansionmodel', 'mans');
        isLogin();

    }

    // List all your items
    public function index($type)
    {
        $data['title'] = 'Data Pembayaran '.getLabelUnitType($type);
        $data['page'] = 'payment_'.$type;
        $data['type'] = $type;
        if ($this->input->post('submit')) {
            $data['unit_id'] = $this->input->post('unit_id');
            $data['bills'] = $this->payment->getBillDataByUnit($type, $data['unit_id']);
        }
        if ($type == 1) {
            $data['units'] = $this->res->getAllData();
        }
        else {
            $data['units'] = $this->mans->getAllData();
        }

        $this->load->view('payments/view', $data);
    }

    public function paid($type)
    {
        if ($this->input->post('submit')) {
            $units = $this->input->post('units');
            foreach ($units as $key => $value) {
                $this->payment->payData($value);
            }
            $this->session->set_flashdata('msg', 'Pembayaran berhasil dilakukan!');
            redirect('payment/index/'.$type);
        }
    }

    public function getDetail()
    {
        $id = $this->input->post('id');
        $type = $this->input->post('type');

        $bill = $this->payment->getBillDataById($id);
        if ($type == 'el') {
            echo '<table align="center" width="100%">';
            echo '<tr>';
            echo '<td width="50%">Pemakaian Bulan Lalu</td>';
            echo '<td>: '.$bill['el_last_used'].' kWH</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td width="50%">Pemakaian Bulan Ini</td>';
            echo '<td>: '.$bill['el_used'].' kWH</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td width="50%">Total Pemakaian</td>';
            echo '<td>: '.$bill['el_total_used'].' kWH</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td width="50%">Tarif</td>';
            echo '<td>: Rp. '.number_format($bill['el_rate']).'</td>';
            echo '</tr>';
            echo '<td width="50%">Biaya Pemakaian</td>';
            echo '<td>: Rp. '.number_format($bill['el_rate'] * $bill['el_total_used']).'</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td width="50%">Pasum</td>';
            echo '<td>: Rp. '.number_format($bill['pasum']).'</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td width="50%">PPJU</td>';
            echo '<td>: Rp. '.number_format($bill['ppju']).'</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td width="50%">PPN</td>';
            echo '<td>: Rp. '.number_format($bill['ppn']).'</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td width="50%">Total Tagihan Listrik</td>';
            echo '<td>: <strong>Rp. '.number_format($bill['el_total_price']).'</strong></td>';
            echo '</tr>';
            echo '</table>';
        }
        else if ($type == 'water') {
            echo '<table align="center" width="100%">';
            echo '<tr>';
            echo '<td width="50%">Pemakaian Bulan Lalu</td>';
            echo '<td>: '.$bill['water_last_used'].' kWH</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td width="50%">Pemakaian Bulan Ini</td>';
            echo '<td>: '.$bill['water_used'].' kWH</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td width="50%">Total Pemakaian</td>';
            echo '<td>: '.$bill['water_total_used'].' kWH</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td width="50%">Tarif</td>';
            echo '<td>: Rp. '.number_format($bill['water_rate']).'</td>';
            echo '</tr>';
            echo '<td width="50%">Biaya Pemakaian</td>';
            echo '<td>: Rp. '.number_format($bill['water_rate'] * $bill['water_total_used']).'</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td width="50%">Abonemen</td>';
            echo '<td>: Rp. '.number_format($bill['abonemen']).'</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td width="50%">Total Tagihan Air</td>';
            echo '<td>: <strong>Rp. '.number_format($bill['water_total_price']).'</strong></td>';
            echo '</tr>';
            echo '</table>';
        }
    }
}

/* End of file Payment.php */
/* Location: ./application/controllers/Payment.php */

 ?>