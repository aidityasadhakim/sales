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
}

/* End of file Payment.php */
/* Location: ./application/controllers/Payment.php */

 ?>