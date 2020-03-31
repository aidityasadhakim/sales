<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bill extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transactionmodel', 'trans');
        $this->load->model('Residencemodel', 'res');
        $this->load->model('Mansionmodel', 'mans');
        isLogin();

    }

    // List all your items
    public function index($type)
    {
        $data['title'] = 'Data Tagihan '.getLabelUnitType($type);
        $data['page'] = 'bill_'.$type;
        $data['type'] = $type;
        if ($this->input->post('submit')) {
            $data['unit_id'] = $this->input->post('unit_id');
            $data['bills'] = $this->trans->getAllDataByUnitId($type, $data['unit_id']);
        }
        if ($type == 1) {
            $data['units'] = $this->res->getAllData();
        }
        else {
            $data['units'] = $this->mans->getAllData();
        }

        $this->load->view('bills/view', $data);
    }

    // List all your items
    public function cetak($id)
    {
        $data['row'] = $this->trans->getDataById($id);
        if ($data['row']['unit_type'] == 1) {
            $data['unit'] = $this->trans->getDataUnitByTransId($data['row']['unit_id'], 'residences');
        }
        else {
            $data['unit'] = $this->trans->getDataUnitByTransId($data['row']['unit_id'], 'mansions');
        }

        $this->load->view('bills/print', $data);
    }

}

/* End of file Bill.php */
/* Location: ./application/controllers/Bill.php */
 ?>