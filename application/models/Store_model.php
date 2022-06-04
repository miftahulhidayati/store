<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Store_model extends MY_Model
{

    protected $_table_name = 'MS_STORE';
    protected $_primary_key = 'ID';
    protected $_order_by = 'ID';
    protected $_order_by_type = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
    function duplicateStore($code, $name, $id = null)
    {

        if ($id != null) {
            $num = $this->db->query("SELECT * FROM " . $this->_table_name . "
				WHERE ID <> '" . $id . "' AND
				( CODE = '" . $code . "' OR NAME = '" . $name . "' )")->num_rows();

            if ($num <= 0)
                return 1;
            else
                return 0;
        } else {
            $this->db->where('NAME', $code);
            $this->db->or_where('CODE', $name);
            $num = $this->db->get($this->_table_name)->num_rows();

            if ($num <= 0)
                return 1;
            else
                return 0;
        }
    }
}