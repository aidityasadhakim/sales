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

if (!function_exists('getTowerByFloorId'))
{
function getTowerByFloorId($floor_id, $field = '') {
        $CI =& get_instance();
        $CI->db->where('id', $floor_id);
        $query = $CI->db->get('towers');
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
            $parent_id = $data['parent_id'];
            $CI->db->where('id', $parent_id);
            $queryTower = $CI->db->get('towers');
            if ($queryTower->num_rows() > 0) {
                $dataTower = $queryTower->row_array();
                return $dataTower[$field];
            }
            else {
                return '-';
            }
        }
        else {
            return '-';
        }
    }
}

if (!function_exists('checkedFacility'))
{
function checkedFacilityUnit($unit_id, $facility_id) {
        $CI =& get_instance();
        $CI->db->where('unit_id', $unit_id);
        $CI->db->where('facility_id', $facility_id);
        $query = $CI->db->get('unit_facilities');
        if ($query->num_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
    }
}
