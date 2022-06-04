<?php
defined('BASEPATH') or exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';

class User_group extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usergroup_model');
        $this->load->model('Groupprivilege_model');
    }
    public function index()
    {
        if (empty($_SESSION['iduser'])) {
            redirect(base_url("Auth"));
        } else if ($_SESSION['pro'] != PROJECT_NAME) {
            redirect(base_url("Auth"));
        } else {

            if (!(in_array("User Group", $_SESSION['lMenu']))) {
                redirect(base_url($_SESSION['linkMenu'][0]));
            }

            foreach ($_SESSION['privilege'] as $row) {
                if ($row['MODULE_NAME'] == "User Group") {
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
                'menu_name' => 'User Group',
            );

            $this->load->view('usergroup/view', $data);
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
                 MS_USER_GROUP a)temp";

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

            $res = $this->Usergroup_model->get_edit($id);

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

            $cekduplicate = $this->Usergroup_model->dupliUserGroup($this->input->post('UgroupName', true));
            if ($cekduplicate) {
                $datainsert = array(
                    'USER_GROUP_NAME' => strtoupper($this->input->post('UgroupName', true)),
                    'CREATED_DATE' => date('Y-m-d H:i:s'),
                    'CREATED_BY' => $_SESSION['username'],
                    'DATE_LOG' => date('Y-m-d H:i:s'),
                    'USER_LOG' => $_SESSION['username'],
                );
                $id = $this->Usergroup_model->create_action($datainsert);

                $datainsert = array(
                    'USER_GROUP_ID' => $id,
                    'CREATED_DATE' => date('Y-m-d H:i:s'),
                    'CREATED_BY' => $_SESSION['username'],
                    'DATE_LOG' => date('Y-m-d H:i:s'),
                    'USER_LOG' => $_SESSION['username'],
                );
                $res = $this->Groupprivilege_model->create_action($datainsert);
            } else {
                $res = "Failed: Duplicate Name";
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

            $id = $this->input->post('IDUserGroupEdit', true);
            $cekduplicate = $this->Usergroup_model->dupliUserGroup($this->input->post('UgroupName', true), $id);
            if ($cekduplicate) {
                $dataupdate = array(
                    'USER_GROUP_NAME' => strtoupper($this->input->post('UgroupName', true)),
                    'DATE_LOG' => date('Y-m-d H:i:s'),
                    'USER_LOG' => $_SESSION['username'],
                );
                $res = $this->Usergroup_model->update_action($dataupdate, $id);
            } else {
                $res = "Failed: Duplicate Name";
            }

            echo json_encode($res);
        }
    }

    public function inactive()
    {
        $id = $_POST['id'];
        $dataupdate['STATUS'] = '0';

        $res = $this->Usergroup_model->update_status($dataupdate, $id);
        echo json_encode($res);
    }

    public function active()
    {
        $id = $_POST['id'];
        $dataupdate['STATUS'] = '1';

        $res = $this->Usergroup_model->update_status($dataupdate, $id);
        echo json_encode($res);
    }
}