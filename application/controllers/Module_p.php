<?php
defined('BASEPATH') or exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';

class Module_p extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Module_p_model');
    }
    public function index()
    {
        if (empty($_SESSION['iduser'])) {
            redirect(base_url("Auth"));
        } else if ($_SESSION['pro'] != PROJECT_NAME) {
            redirect(base_url("Auth"));
        } else {

            if (!(in_array("Module Privilege", $_SESSION['lMenu']))) {
                redirect(base_url($_SESSION['linkMenu'][0]));
            }

            foreach ($_SESSION['privilege'] as $row) {
                if ($row['MODULE_NAME'] == "Module Privilege") {
                    if ($row['IS_CREATE'] == 0) {
                        $isCreate = 0;
                    } else {
                        $isCreate = 1;
                    }

                    if ($row['IS_READ'] == 0) {
                        $isRead = 0;
                    } else {
                        $isRead = 1;
                    }

                    if ($row['IS_UPDATE'] == 0) {
                        $isEdit = 0;
                    } else {
                        $isEdit = 1;
                    }

                    if ($row['IS_DELETE'] == 0) {
                        $isDelete = 0;
                    } else {
                        $isDelete = 1;
                    }

                    if ($row['IS_EXPORT'] == 0) {
                        $isExp = 0;
                    } else {
                        $isExp = 1;
                    }

                    if ($row['IS_IMPORT'] == 0) {
                        $isImp = 0;
                    } else {
                        $isImp = 1;
                    }

                    if ($isRead == 0) {
                        redirect(base_url($_SESSION['linkMenu'][0]));
                    }
                    break;
                }
            }

            $data = array(
                'isCreate' => $isCreate,
                'isEdit' => $isEdit,
                'isRead' => $isRead,
                'isDelete' => $isDelete,
                'isExp' => $isExp,
                'isImp' => $isImp,
                'menu_name' => 'Module Privilege',
            );

            $this->load->view('module_p/view', $data);
        }
    }
    public function getDataTable()
    {
        if (empty($_SESSION['iduser'])) {
            redirect(base_url("Auth"));
        } else if ($_SESSION['pro'] != PROJECT_NAME) {
            redirect(base_url("Auth"));
        } else {

            $col = $_GET['arr'];
            $tbl = $_GET['tb'];
            $stt = 1;

            if (empty($_GET['where'])) {
                $where = "";
            } else {
                $where = $_GET['where'];
                $wherecol = $_GET['wherecol'];
            }

            $table = "(select
                a.*,
                CONCAT('','') as ACTION
            from
                 MS_MODULE_PREVILEGE a)temp";

            // Primary key of table
            $primaryKey = $col[0];

            for ($i = 0; $i < sizeof($col); $i++) {
                $columns[$i]['db'] = $col[$i];
                $columns[$i]['dt'] = $i;
            }

            $columns[$i]['db'] = 'ACTION';
            $columns[$i]['dt'] = $i;

            echo json_encode(
                SSP::simple($_GET, $this->config->item('dbss'), $table, $primaryKey, $columns)
            );
        }
    }
}