<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paymentmodel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    var $table = 'transactions';

    public function getBillDataByUnit($type, $id)
    {
        $this->db->where('unit_type', $type);
        $this->db->where('unit_id', $id);
        $this->db->where('payment_status', 0);
        $this->db->where('deleted_at', null);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return array();
        }
    }

    public function payData($id)
    {
        $data['payment_status'] = 1;
        $data['paid_by'] = $this->session->userdata('id');
        $data['paid_at'] = date('Y-m-d H:i:s');
        $this->db->where('id',$id);
        $this->db->update($this->table,$data);
    }

}

/* End of file Paymentmodel.php */
/* Location: ./application/models/backend/Paymentmodel.php */
 ?>