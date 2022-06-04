<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    protected $_action = null;
    protected $_controller = null;
    protected $_module = null;
    protected $_data = array();
    protected $_ekey = null;

    public function __construct()
    {
        parent::__construct();

        $this->_data['version'] = CI_VERSION;
        $this->_data['action'] = $this->_action = $this->application->_action;
        $this->_data['controller'] = $this->_controller = $this->application->_controller;
        $this->_data['module'] = $this->_module = $this->application->_module;

    }
}