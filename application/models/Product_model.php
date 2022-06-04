<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_model extends MY_Model
{

    protected $_table_name = 'MS_PRODUCT';
    protected $_primary_key = 'ID_PRODUCT';
    protected $_order_by = 'ID_PRODUCT';
    protected $_order_by_type = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
    function duplicateProduct($name, $id = null)
    {

        if ($id != null) {
            $num = $this->db->query("SELECT * FROM " . $this->_table_name . "
				WHERE ID_PRODUCT <> '" . $id . "' AND
				NAME = '" . $name . "'")->num_rows();

            if ($num <= 0)
                return 1;
            else
                return 0;
        } else {
            $this->db->where('NAME', $name);
            $num = $this->db->get($this->_table_name)->num_rows();

            if ($num <= 0)
                return 1;
            else
                return 0;
        }
    }
}