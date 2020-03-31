<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportmodel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    var $table = 'transactions';


    public function getDataByPeriod($year, $month, $type)
    {
        $this->db->where('deleted_at', null);
        $this->db->where('unit_type', $type);
        $this->db->where('MONTH(period)', $month);
        $this->db->where('YEAR(period)', $year);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return array();
        }
    }

}

/* End of file Reportmodel.php */
/* Location: ./application/models/backend/Reportmodel.php */
 ?>