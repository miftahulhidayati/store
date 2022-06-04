<?php
defined('BASEPATH') or exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Category_product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('joy_helper');
        $this->load->model('Category_product_model');
    }
    public function index()
    {
        if (empty($_SESSION['iduser'])) {
            redirect(base_url("Auth"));
        } else if ($_SESSION['pro'] != PROJECT_NAME) {
            redirect(base_url("Auth"));
        } else {
            if (!(in_array("Category Product", $_SESSION['lMenu']))) {
                redirect(base_url($_SESSION['linkMenu'][0]));
            }
            foreach ($_SESSION['privilege'] as $row) {
                if ($row['MODULE_NAME'] == "Category Product") {
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
                'menu_name' => 'Category Product',
            );
            $this->load->view('category_product/view', $data);
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
            if ($where != "") {
                $table = "(SELECT *, CONCAT('','') as ACTION  FROM $tbl WHERE $wherecol = '$where' ORDER BY CREATED_DATE DESC)temp";
            } else {
                $table = "(SELECT *, CONCAT('','') as ACTION  FROM $tbl ORDER BY CREATED_DATE DESC)temp";
            }
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
    public function get_edit($id)
    {
        if (empty($_SESSION['iduser'])) {
            redirect(base_url("Auth"));
        } else if ($_SESSION['pro'] != PROJECT_NAME) {
            redirect(base_url("Auth"));
        } else {
            $res = $this->Category_product_model->get_edit($id);
            echo json_encode($res);
        }
    }

    public function create_action()
    {
        if (empty($_SESSION['iduser'])) {
            redirect(base_url("Auth"));
        } else if ($_SESSION['pro'] != PROJECT_NAME) {
            redirect(base_url("Auth"));
        } else {
            $cekduplicate = $this->Category_product_model->duplicateCategory($this->input->post('code', TRUE), $this->input->post('name', TRUE));
            if (!$cekduplicate) {
                $res = "Failed: Duplicate Data";
                echo json_encode($res);
                exit();
            }
            $datainsert = array(
                'CODE' => strtoupper($this->input->post('code', true)),
                'NAME' => ($this->input->post('name', true)),
                'STATUS' => 1,
                'CREATED_DATE' => date('Y-m-d H:i:s'),
                'CREATED_BY' => $_SESSION['username'],
                'DATE_LOG' => date('Y-m-d H:i:s'),
                'USER_LOG' => $_SESSION['username'],
            );
            $res = $this->Category_product_model->insert($datainsert);
            if ($res) {
                $res = "Success!";
            } else {
                $res = "Failed: Failed to create data";
            }
            echo json_encode($res);
        }
    }
    public function update_action()
    {
        if (empty($_SESSION['iduser'])) {
            redirect(base_url("Auth"));
        } else if ($_SESSION['pro'] != PROJECT_NAME) {
            redirect(base_url("Auth"));
        } else {
            $id = $this->input->post('id_category_product', true);
            $cekduplicate = $this->Category_product_model->duplicateCategory($this->input->post('code', TRUE), $this->input->post('name', TRUE), $id);
            if (!$cekduplicate) {
                $res = "Failed: Duplicate Data";
                echo json_encode($res);
                exit();
            }
            $dataupdate = array(
                'CODE' => strtoupper($this->input->post('code', true)),
                'NAME' => ($this->input->post('name', true)),
                'DATE_LOG' => date('Y-m-d H:i:s'),
                'USER_LOG' => $_SESSION['username'],
            );
            $res = $this->Category_product_model->update($dataupdate, array('ID_CATEGORY_PRODUCT' => $id));
            if ($res) {
                $res = "Success!";
            } else {
                $res = "Failed: Failed to create data";
            }
            echo json_encode($res);
        }
    }

    public function activeAction($id)
    {
        $dataupdate = array(
            'STATUS'      => '1',
            'DATE_LOG'    => date('Y-m-d H:i:s'),
            'USER_LOG'    => $_SESSION['username'],
        );
        $res = $this->Category_product_model->update($dataupdate, array('ID_CATEGORY_PRODUCT' => $id));
        echo json_encode($res);
    }
    public function inactiveAction($id)
    {
        $dataupdate = array(
            'STATUS'      => '0',
            'DATE_LOG'    => date('Y-m-d H:i:s'),
            'USER_LOG'    => $_SESSION['username'],
        );
        $res = $this->Category_product_model->update($dataupdate, array('ID_CATEGORY_PRODUCT' => $id));
        echo json_encode($res);
    }
}