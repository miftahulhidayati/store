<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Global_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function insert_data($table, $data)
    {
        $result = $this->db->insert($table, $data);
        if ($result) {
            return true;
        } else {
            return false;
        }
        // $this->db->close();
        // return $this->db->insert_id();
    }

    public function get_last_id($column, $table)
    {
        $q = $this->db->query("select $column from $table where $column = (select max($column) from $table)")->row_array();
        return $q[$column] + 1;
    }

    function get($table)
    {
        return $this->db->get($table)->result();
    }

    public function fetch($where, $tabel)
    {
        return $this->db->get_where($tabel, $where)->result();
    }

    public function query($query, $obj = true)
    {
        if ($obj == true)
            return $this->db->query($query)->result();
        else
            return $this->db->query($query)->result_array();
    }

    public function fetch_row($where, $tabel)
    {
        return $this->db->get_where($tabel, $where)->row();
    }

    public function count($where, $table)
    {
        return $this->db->get_where($table, $where)->num_rows();
    }

    function cekDuplicate($table, $name, $field_where, $field_id = null, $id = null)
    {
        if ($id == null) {
            $this->db->where($field_where, $name);
            $num = $this->db->get($table)->num_rows();
            if ($num >= 1)
                return 0;
            else
                return 1;
        } else {
            $this->db->where($field_where, $name);
            $this->db->where_not_in($field_id, $id);
            $num = $this->db->get($table)->num_rows();
            if ($num >= 1)
                return 0;
            else
                return 1;
        }

        $this->db->close();
    }
    function cekDuplicate2($table, $name, $field_where, $name2, $field_where2, $field_id = null, $id = null)
    {
        if ($id == null) {
            $this->db->where($field_where, $name);
            $this->db->where($field_where2, $name2);
            $num = $this->db->get($table)->num_rows();
            if ($num >= 1)
                return 0;
            else
                return 1;
        } else {
            $this->db->where($field_where, $name);
            $this->db->where($field_where2, $name2);
            $this->db->where_not_in($field_id, $id);
            $num = $this->db->get($table)->num_rows();
            if ($num >= 1)
                return 0;
            else
                return 1;
        }

        $this->db->close();
    }

    public function checkDuplicate($table, $wherein, $wherenot = null)
    {
        if ($wherenot == null) {
            $res = $this->db->get_where($table, $wherein)->num_rows();
        } else {
            $this->db->where($wherenot);
            $this->db->where($wherein);
            $res = $this->db->get($table)->num_rows();
        }
        return $res;
    }

    public function fetch_order($where, $tabel, $ordercol = '', $order = '')
    {
        $this->db->order_by($ordercol, $order);
        return $this->db->get_where($tabel, $where)->result();
    }

    public function insert($data, $tabel)
    {
        $result = $this->db->insert($tabel, $data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function update_data($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
        if ($this->db->affected_rows () > 0) {
            return true;
        }else{
            return false;
        }
        // $this->db->close();
    }

    public function update($tablename, $arr_data, $arr_where)
    {
        $result = $this->db->update($tablename, $arr_data, $arr_where);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    // End Tomi Function update

    function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    // Start Tomi Function delete
    function delete($arr_where, $tablename)
    {
        $this->db->where($arr_where);
        $this->db->delete($tablename);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    // End Tomi Function delete
}