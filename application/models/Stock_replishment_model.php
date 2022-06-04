<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stock_replishment_model extends MY_Model
{

    protected $_table_name = 'STOCK_REPLISHMENT';
    protected $_primary_key = 'ID';
    protected $_order_by = 'ID';
    protected $_order_by_type = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
}