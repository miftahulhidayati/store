<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// Deklarasi pembuatan class Jurusan_model
class Module_p_model extends CI_Model
{

    // Property yang bersifat public
    public $table = 'MS_MODULE_PREVILEGE';
    public $id = 'ID';

    public function __construct()
    {
        parent::__construct();
    }
}