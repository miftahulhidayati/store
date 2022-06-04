<?php
defined('BASEPATH') or exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('joy_helper');
        $this->load->model('Users_model');
        $this->load->model('Global_model');
    }

    public function index()
    {
        if (empty($_SESSION['iduser'])) {
            redirect(base_url("Auth"));
        } else if ($_SESSION['pro'] != PROJECT_NAME) {
            redirect(base_url("Auth"));
        } else {

            if (!(in_array("Manage User", $_SESSION['lMenu']))) {
                redirect(base_url($_SESSION['linkMenu'][0]));
            }

            foreach ($_SESSION['privilege'] as $row) {
                if ($row['MODULE_NAME'] == "Manage User") {
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
            $uGroup = $this->db->query('SELECT * FROM MS_USER_GROUP WHERE STATUS="1"')->result();

            $data = array(
                'isCreate' => $isCreate,
                'isEdit' => $isEdit,
                'isRead' => $isRead,
                'isDelete' => $isDelete,
                'isExp' => $isExp,
                'isImp' => $isImp,
                'uGroup' => $uGroup,
                'menu_name' => 'Manage User'
            );
            $this->load->view('users/view', $data);
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
                c.USER_GROUP_NAME AS USER_GROUP_NAME,
                CONCAT('','') as ACTION
            from
                MS_USERS a
            left join MS_USER_GROUP c on
                a.GROUP_ID = c.ID
            )temp";

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

            $res = $this->Users_model->get_edit($id);

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

            $cekduplicate = $this->Users_model->dupliUser($this->input->post('uname', true), $this->input->post('emailAddress', true));
            if ($cekduplicate) {
                $hash = generateRandomString();
                $password = md5($this->input->post('password', true) . $hash);

                $datainsert = array(
                    'USERNAME' => strtoupper($this->input->post('uname', true)),
                    'NAME' => strtoupper($this->input->post('namee', true)),
                    'EMAIL' => strtoupper($this->input->post('emailAddress', true)),
                    'POSITION' => strtoupper($this->input->post('positionUser', true)),
                    'PASSWORD' => $password,
                    'HASH' => $hash,
                    'GROUP_ID' => strtoupper($this->input->post('groupUser', true)),
                    'ID_STORE' => $this->input->post('id_store', true),
                    'CREATED_DATE' => date('Y-m-d H:i:s'),
                    'CREATED_BY' => $_SESSION['username'],
                    'DATE_LOG' => date('Y-m-d H:i:s'),
                    'USER_LOG' => $_SESSION['username'],
                );
                $res = $this->Users_model->create_action($datainsert);
            } else {
                $res = "Failed: Duplicate Username/Email";
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

            $id = $this->input->post('IDUserEdit', true);
            $cekduplicate = $this->Users_model->dupliUser($this->input->post('uname', true), $this->input->post('emailAddress', true), $id);
            if ($cekduplicate) {
                if ($this->input->post('password', true) == "") {
                    $dataupdate = array(
                        'USERNAME' => strtoupper($this->input->post('uname', true)),
                        'NAME' => strtoupper($this->input->post('namee', true)),
                        'EMAIL' => strtoupper($this->input->post('emailAddress', true)),
                        'POSITION' => strtoupper($this->input->post('positionUser', true)),
                        'ID_STORE' => $this->input->post('id_store', true),
                        'GROUP_ID' => strtoupper($this->input->post('groupUser', true)),
                        'DATE_LOG' => date('Y-m-d H:i:s'),
                        'USER_LOG' => $_SESSION['username'],
                    );
                } else {
                    $hash = generateRandomString();
                    $password = md5($this->input->post('password', true) . $hash);

                    $dataupdate = array(
                        'USERNAME' => strtoupper($this->input->post('uname', true)),
                        'NAME' => strtoupper($this->input->post('namee', true)),
                        'EMAIL' => strtoupper($this->input->post('emailAddress', true)),
                        'POSITION' => strtoupper($this->input->post('positionUser')),
                        'PASSWORD' => $password,
                        'HASH' => $hash,
                        'ID_STORE' => $this->input->post('id_store', true),
                        'GROUP_ID' => strtoupper($this->input->post('groupUser', true)),
                        'DATE_LOG' => date('Y-m-d H:i:s'),
                        'USER_LOG' => $_SESSION['username'],
                    );
                }

                $res = $this->Users_model->update_action($dataupdate, $id);
            } else {
                $res = "Failed: Duplicate Username/Email";
            }

            echo json_encode($res);
        }
    }

    public function delete_row($id)
    {
        $res = $this->Users_model->delete_row($id);

        echo json_encode($res);
    }

    public function activeUser($id)
    {
        $res = $this->Users_model->activeUser($id);

        echo json_encode($res);
    }

    public function inactiveUser($id)
    {
        $res = $this->Users_model->inactiveUser($id);

        echo json_encode($res);
    }

    public function update_profile()
    {
        if (empty($_SESSION['iduser'])) {
            redirect(base_url("Auth"));
        } else if ($_SESSION['pro'] != PROJECT_NAME) {
            redirect(base_url("Auth"));
        } else {

            $id = $this->input->post('IDchProfile', true);
            $cekduplicate = $this->Users_model->dupliUser($_SESSION['username'], $this->input->post('chProfileemailAddress', true), $id);
            if ($cekduplicate) {
                $dataupdate = array(
                    'NAME' => strtoupper($this->input->post('chProfilenamee', true)),
                    'EMAIL' => strtoupper($this->input->post('chProfileemailAddress', true)),
                    'POSITION' => strtoupper($this->input->post('chProfilepositionUser', true)),
                    'DATE_LOG' => date('Y-m-d H:i:s'),
                    'USER_LOG' => $_SESSION['username'],
                );

                $res = $this->Users_model->update_action($dataupdate, $id);
                if ($res == "1 Affected Rows") {
                    $_SESSION['name'] = $dataupdate['NAME'];
                    $_SESSION['email'] = $dataupdate['EMAIL'];
                    $_SESSION['position'] = $dataupdate['POSITION'];
                }
            } else {
                $res = "Failed: Duplicate Email";
            }

            echo json_encode($res);
        }
    }

    public function changePass()
    {
        if (empty($_SESSION['iduser'])) {
            redirect(base_url("Auth"));
        } else if ($_SESSION['pro'] != PROJECT_NAME) {
            redirect(base_url("Auth"));
        } else {

            if (empty($_SESSION['iduser'])) {
                $id = $this->input->post('idUser', true);
            } else {
                $id = $_SESSION['iduser'];
            }
            if ($this->input->post('NewchPass', true) == $this->input->post('RechPass', true)) {
                $cekoldpass = $this->Users_model->cekoldpass(($this->input->post('chPass', true)), $id);
                if ($cekoldpass) {
                    if ($this->input->post('chPass', true) == $this->input->post('NewchPass', true)) {
                        $res = "Failed: Old Password and New Password are same";
                    } else {
                        $hash = generateRandomString();
                        $password = md5($this->input->post('NewchPass', true) . $hash);

                        $dataupdate = array(
                            'PASSWORD' => $password,
                            'HASH' => $hash,
                            'DATE_LOG' => date('Y-m-d H:i:s'),
                            'USER_LOG' => $id,
                        );

                        $res = $this->Users_model->changePass($dataupdate, $id);
                    }
                } else {
                    $res = "Failed: Wrong old password";
                }
            } else {
                $res = "Failed: Password not match";
            }

            echo json_encode($res);
        }
    }
}