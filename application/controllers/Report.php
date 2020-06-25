<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        isLoginAdmin();
        $this->load->model('Reportmodel', 'report');
        $this->load->model('PaymentMethodmodel', 'method');
    }

    public function stock()
    {
        if ($this->input->post('submit')) {
            $type = $this->input->post('submit');
            if ($type == 'view') {
                $data['start_date'] = $this->input->post('start_date');
                $data['end_date'] = $this->input->post('end_date');
                $data['item_id'] = $this->input->post('item_id');

                $data['stocks'] = $this->report->getDataStockByPeriod($data['start_date'], $data['end_date'], $data['item_id']);

                $data['title'] = 'Laporan Mutasi Stok Barang';
                $data['page'] = 'report';
                $data['items'] = $this->report->getAllItems();
                $this->load->view('reports/stock_view', $data);
            }
            else if ($type == 'download') {
                $data['start_date'] = $this->input->post('start_date');
                $data['end_date'] = $this->input->post('end_date');
                $data['item_id'] = $this->input->post('item_id');

                $data['stocks'] = $this->report->getDataStockByPeriod($data['start_date'], $data['end_date'], $data['item_id']);
                
                $this->load->view('reports/stock_download', $data);    
            }
        }
        else {
            $data['title'] = 'Laporan Mutasi Stok Barang';
            $data['page'] = 'report';
            $data['items'] = $this->report->getAllItems();
            $this->load->view('reports/stock_view', $data);
        }
    }

    public function cash_in()
    {
        if ($this->input->post('submit')) {
            $type = $this->input->post('submit');
            if ($type == 'view') {
                $data['start_date'] = $this->input->post('start_date');
                $data['end_date'] = $this->input->post('end_date');
                $data['method_id'] = $this->input->post('method_id');

                $data['sales'] = $this->report->getDataCashSaleByPeriod($data['start_date'], $data['end_date'], $data['method_id']);

                $data['title'] = 'Laporan Kas Masuk';
                $data['page'] = 'report';
                $data['methods'] = $this->method->getAllData();
                $this->load->view('reports/cashin_view', $data);
            }
            else if ($type == 'download') {
                $data['start_date'] = $this->input->post('start_date');
                $data['end_date'] = $this->input->post('end_date');
                $data['method_id'] = $this->input->post('method_id');

                $data['sales'] = $this->report->getDataCashSaleByPeriod($data['start_date'], $data['end_date'], $data['method_id']);
                
                $this->load->view('reports/cashin_download', $data);    
            }
        }
        else {
            $data['title'] = 'Laporan Kas Masuk';
            $data['page'] = 'report';
            $data['methods'] = $this->method->getAllData();
            $this->load->view('reports/cashin_view', $data);
        }
    }

    public function cash_out()
    {
        if ($this->input->post('submit')) {
            $type = $this->input->post('submit');
            if ($type == 'view') {
                $data['start_date'] = $this->input->post('start_date');
                $data['end_date'] = $this->input->post('end_date');
                $data['method_id'] = $this->input->post('method_id');

                $data['purchases'] = $this->report->getDataCashPurchaseByPeriod($data['start_date'], $data['end_date'], $data['method_id']);

                $data['title'] = 'Laporan Kas Keluar';
                $data['page'] = 'report';
                $data['methods'] = $this->method->getAllData();
                $this->load->view('reports/cashout_view', $data);
            }
            else if ($type == 'download') {
                $data['start_date'] = $this->input->post('start_date');
                $data['end_date'] = $this->input->post('end_date');
                $data['method_id'] = $this->input->post('method_id');

                $data['purchases'] = $this->report->getDataCashPurchaseByPeriod($data['start_date'], $data['end_date'], $data['method_id']);
                
                $this->load->view('reports/cashout_download', $data);    
            }
        }
        else {
            $data['title'] = 'Laporan Kas Keluar';
            $data['page'] = 'report';
            $data['methods'] = $this->method->getAllData();
            $this->load->view('reports/cashout_view', $data);
        }
    }

    public function sales()
    {
        if ($this->input->post('submit')) {
            $type = $this->input->post('submit');
            if ($type == 'view') {
                $data['start_date'] = $this->input->post('start_date');
                $data['end_date'] = $this->input->post('end_date');

                $data['sales'] = $this->report->getDataSalesByPeriod($data['start_date'], $data['end_date']);

                $data['title'] = 'Laporan Penjualan';
                $data['page'] = 'report';
                $this->load->view('reports/sales_view', $data);
            }
            else if ($type == 'download') {
                $data['start_date'] = $this->input->post('start_date');
                $data['end_date'] = $this->input->post('end_date');
                $data['method_id'] = $this->input->post('method_id');

                $data['sales'] = $this->report->getDataSalesByPeriod($data['start_date'], $data['end_date']);
                
                $this->load->view('reports/sales_download', $data);    
            }
        }
        else {
            $data['title'] = 'Laporan Penjualan';
            $data['page'] = 'report';
            $this->load->view('reports/sales_view', $data);
        }
    }

    public function purchases()
    {
        if ($this->input->post('submit')) {
            $type = $this->input->post('submit');
            if ($type == 'view') {
                $data['start_date'] = $this->input->post('start_date');
                $data['end_date'] = $this->input->post('end_date');

                $data['purchases'] = $this->report->getDataPurchasesByPeriod($data['start_date'], $data['end_date']);

                $data['title'] = 'Laporan Pembelian';
                $data['page'] = 'report';
                $this->load->view('reports/purchases_view', $data);
            }
            else if ($type == 'download') {
                $data['start_date'] = $this->input->post('start_date');
                $data['end_date'] = $this->input->post('end_date');
                $data['method_id'] = $this->input->post('method_id');

                $data['purchases'] = $this->report->getDataPurchasesByPeriod($data['start_date'], $data['end_date']);
                
                $this->load->view('reports/purchases_download', $data);    
            }
        }
        else {
            $data['title'] = 'Laporan Pembelian';
            $data['page'] = 'report';
            $this->load->view('reports/purchases_view', $data);
        }
    }


}
/* End of file Report.php */
/* Location: ./application/controllers/Report.php */

 ?>