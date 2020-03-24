<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Reportmodel', 'report');
        isLogin();

    }

    public function period()
    {
        if ($this->input->post('submit')) {
            $type = $this->input->post('submit');
            if ($type == 'view') {
                $data['period'] = $this->input->post('period');
                $data['unit_type'] = $this->input->post('unit_type');
                $date = explode('-', date('Y-m', strtotime($data['period'])));
                $data['datas'] = $this->report->getDataByPeriod($date[0], $date[1], $data['unit_type']);

                $data['title'] = 'Laporan Per Periode';
                $data['page'] = 'report';
                $this->load->view('reports/view_period', $data);
            }
            else if ($type == 'download') {
                $data['period'] = $this->input->post('period');
                $data['unit_type'] = $this->input->post('unit_type');
                $date = explode('-', date('Y-m', strtotime($data['period'])));
                $data['datas'] = $this->report->getDataByPeriod($date[0], $date[1], $data['unit_type']);
                
                $this->load->view('reports/report_period', $data);    
            }
        }
        else {
            $data['title'] = 'Laporan Per Periode';
            $data['page'] = 'report';
            $this->load->view('reports/view_period', $data);
        }
    }
    
}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */

 ?>