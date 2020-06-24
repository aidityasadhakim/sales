<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('isLogin'))
{
function isLogin() {
        $ci = &get_instance();
        if ($ci->session->userdata('is_login') == TRUE) {
            return TRUE;
        } else {
            $ci->session->set_flashdata('error', 'Anda tidak memiliki hak akses');
            redirect('login');
        }
    }
}

if (!function_exists('isLoginAdmin'))
{
function isLoginAdmin() {
        $ci = &get_instance();
        if ($ci->session->userdata('is_login') == TRUE && $ci->session->userdata('level') == 1 ) {
            return TRUE;
        } else {
            $ci->session->set_flashdata('error', 'Anda tidak memiliki hak akses');
            redirect('login');
        }
    }
}

if (!function_exists('getLabelLevelUser'))
{
function getLabelLevelUser($level) {
        if ($level == 1) {
            return 'Administrator';
        } 
        else if ($level == 2) {
            return 'Sub Admin';
        }
        else if ($level == 3) {
            return 'Operator';
        }
    }
}

if (!function_exists('getDataColumn'))
{
function getDataColumn($table, $condition, $value, $field) {
        $CI =& get_instance();
        $CI->db->where($condition, $value);
        $query = $CI->db->get($table);
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
            return $data[$field];
        }
        else {
            return null;
        }
    }
}

if (!function_exists('decreaseStock'))
{
function decreaseStock($item_id = '', $qty) {
        $CI =& get_instance();
        $CI->db->set('stock', 'stock - '.$qty, FALSE);
        $CI->db->where('id', $item_id);
        $CI->db->where('stock >=', $qty);
        $CI->db->update('items');
        return $CI->db->affected_rows();
    }
}

if (!function_exists('increaseStock'))
{
function increaseStock($item_id = '', $qty) {
        $CI =& get_instance();
        $CI->db->set('stock', 'stock + '.$qty, FALSE);
        $CI->db->where('id', $item_id);
        $CI->db->update('items');
    }
}
