<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Send_verification extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
       $this->load->model('Send_verification_model');
       $Verify = $this->Send_verification_model->Verify();
	   exit;
    }

}
