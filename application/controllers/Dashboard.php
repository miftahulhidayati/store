<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Global_model');
    }

    public function index()
    {
        if (empty($_SESSION['iduser'])) {
            redirect(base_url("Auth"));
        } else if ($_SESSION['pro'] != PROJECT_NAME) {
            redirect(base_url("Auth"));
        } else {
            $data['main_view'] = 'dashboard/view';
            $data['menu_name'] = 'Dashboard';
            $this->load->view('dashboard/view', $data);
        }
    }
}