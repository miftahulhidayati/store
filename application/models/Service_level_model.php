<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service_level_model extends MY_Model
{

    protected $_table_name = 'MS_SERVICE_LEVEL';
    protected $_primary_key = 'ID';
    protected $_order_by = 'ID';
    protected $_order_by_type = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
}