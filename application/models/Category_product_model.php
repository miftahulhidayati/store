<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_product_model extends MY_Model
{

    protected $_table_name = 'MS_CATEGORY_PRODUCT';
    protected $_primary_key = 'ID_CATEGORY_PRODUCT';
    protected $_order_by = 'ID_CATEGORY_PRODUCT';
    protected $_order_by_type = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
    function duplicateCategory($code, $name, $id = null)
    {

        if ($id != null) {
            $num = $this->db->query("SELECT * FROM " . $this->_table_name . "
				WHERE ID_CATEGORY_PRODUCT <> '" . $id . "' AND
				( CODE = '" . $code . "' OR NAME = '" . $name . "' )")->num_rows();

            if ($num <= 0)
                return 1;
            else
                return 0;
        } else {
            $this->db->where('CODE', $code);
            $this->db->or_where('NAME', $name);
            $num = $this->db->get($this->_table_name)->num_rows();

            if ($num <= 0)
                return 1;
            else
                return 0;
        }
    }
}