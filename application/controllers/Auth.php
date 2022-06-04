<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        if (empty($_SESSION['iduser'])) {
            $this->load->view('templates/login');
        } else if ($_SESSION['pro'] != PROJECT_NAME) {
            $this->load->view('templates/login');
        } else {

            redirect(base_url());
        }
    }
    public function forgot_password()
    {
        $this->load->view('templates/forgot_password');
    }
    public function resetpassword()
    {
        $data['email'] = $_GET['email'];
        $data['token'] = $_GET['token'];

        $this->load->view('templates/reset_password', $data);
    }
}