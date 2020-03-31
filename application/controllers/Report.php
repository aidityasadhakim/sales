<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Unitmodel', 'unit');
        $this->load->model('Facilitymodel', 'facility');
        isLogin();

    }

    public function facility()
    {
        if ($this->input->post('submit')) {
            $type = $this->input->post('submit');
            if ($type == 'view') {
                $data['type'] = $this->input->post('type');
                $data['units'] = $this->unit->getDataByType($data['type']);
                $data['facilities'] = $this->facility->getAllData();
                $data['title'] = 'Laporan Fasilitas Kamar';
                $data['page'] = 'report_facility';
                $this->load->view('reports/view_facility', $data);
            }
            else if ($type == 'download') {
                $data['period'] = $this->input->post('period');
                $data['unit_type'] = $this->input->post('unit_type');
                $date = explode('-', date('Y-m', strtotime($data['period'])));
                $data['datas'] = $this->report->getDataByPeriod($date[0], $date[1], $data['unit_type']);
                
                $this->load->view('reports/report_facility', $data);    
            }
        }
        else {
            $data['title'] = 'Laporan Fasilitas Kamar';
            $data['page'] = 'report_facility';
            $this->load->view('reports/view_facility', $data);
        }

    }

}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */
 ?>