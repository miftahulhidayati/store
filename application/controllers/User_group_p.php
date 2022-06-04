<?php
defined('BASEPATH') or exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';

class User_group_p extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usergroup_p_model');
    }
    public function index()
    {
        if (empty($_SESSION['iduser'])) {
            redirect(base_url("Auth"));
        } else if ($_SESSION['pro'] != PROJECT_NAME) {
            redirect(base_url("Auth"));
        } else {

            if (!(in_array("User Group Privilege", $_SESSION['lMenu']))) {
                redirect(base_url($_SESSION['linkMenu'][0]));
            }

            foreach ($_SESSION['privilege'] as $row) {
                if ($row['MODULE_NAME'] == "User Group Privilege") {
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
                'menu_name' => 'User Group Privilege',
            );

            $this->load->view('usergroup_p/view', $data);
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
    public function editPrivilege($id)
    {
        if (empty($_SESSION['iduser'])) {
            redirect(base_url("Auth"));
        } else if ($_SESSION['pro'] != PROJECT_NAME) {
            redirect(base_url("Auth"));
        } else {
            foreach ($_SESSION['privilege'] as $row) {
                if ($row['MODULE_NAME'] == "User Group Privilege") {
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
                'menu_name' => 'Edit User Group Privilege',
            );

            $data['back'] = base_url('user_group_p');
            $data['id'] = $id;
            $uGroup = $this->db->get_where('MS_USER_GROUP', array('ID' => $id))->row();
            $data['uGroupName'] = $uGroup->USER_GROUP_NAME;
            $data['datatree'] = $this->get_PrivilegeCb($id, true);
            $this->load->view('usergroup_p/form_edit', $data);
        }
    }

    public function get_PrivilegeCb($uGroupid, $fnc = false)
    {

        $listMainMenu = $this->Usergroup_p_model->getListMM();

        $arraystate = array('opened' => true);
        $data['dataTree'] = array();
        $i = 0;
        foreach ($listMainMenu as $row) {

            // CHECK MAIN SUB MENU
            $resMSM = $this->Usergroup_p_model->getMSM($row->ID);
            // /CHECK MAIN SUB MENU

            if ($resMSM->num_rows() > 0) {

                $arraychildlvl1 = array();
                foreach ($resMSM->result() as $MSM) {

                    // CHECK SUB SUB MENU
                    $resSSM = $this->Usergroup_p_model->getSSM($MSM->ID);
                    // /CHECK SUB SUB MENU

                    if ($resSSM->num_rows() > 0) {

                        $arraychildlvl2 = array();
                        foreach ($resSSM->result() as $SSM) {

                            // CHECK MODULE ACTIONS (SSM)
                            $resModAct = $this->Usergroup_p_model->getModAct($SSM->ID, $uGroupid);
                            // /CHECK MODULE ACTIONS (SSM)

                            $datacheckbox = array(
                                'Add' => '<input type="hidden" name="moduleMenuID[]" value="' . $resModAct['MODULE_PREVILEGE_ID'] . '"> <input type="hidden" name="MenuID[]" value="' . $SSM->ID . '"> <input type="checkbox" data-index=' . $i . ' name="addcb' . $i . '" onclick="otherToggle(' . $i . ', this)" ' . ($resModAct['IS_CREATE'] == 0 ? '' : 'checked') . '>',
                                'Read' => '<input type="checkbox" data-index=' . $i . ' name="readcb' . $i . '" onclick="readToggle(' . $i . ', this)" ' . ($resModAct['IS_READ'] == 0 ? '' : 'checked') . '>',
                                'Edit' => '<input type="checkbox" data-index=' . $i . ' name="editcb' . $i . '" onclick="otherToggle(' . $i . ', this)" ' . ($resModAct['IS_UPDATE'] == 0 ? '' : 'checked') . '>',
                                'Delete' => '<input type="checkbox" data-index=' . $i . ' name="delcb' . $i . '" onclick="otherToggle(' . $i . ', this)" ' . ($resModAct['IS_DELETE'] == 0 ? '' : 'checked') . '>',
                                'Export' => '<input type="checkbox" data-index=' . $i . ' name="expcb' . $i . '" onclick="otherToggle(' . $i . ', this)" ' . ($resModAct['IS_EXPORT'] == 0 ? '' : 'checked') . '>',
                                'Import' => '<input type="checkbox" data-index=' . $i . ' name="impcb' . $i . '" onclick="otherToggle(' . $i . ', this)" ' . ($resModAct['IS_IMPORT'] == 0 ? '' : 'checked') . '>',
                                'Btn' => '<button class="btn btn-success waves-effect waves-light" type="button" onclick="chkrow(' . $i . ')" style="padding: 0 3px; font-size: 10px; line-height: 20px"> Check/Uncheck</button>',
                            );

                            // LEVEL 1 NO CHILD
                            $arraytmpchildlvl2 = array(
                                'text' => $SSM->MODULE_NAME,
                                'type' => 'Default',
                                'state' => $arraystate,
                                'data' => $datacheckbox,
                            );
                            array_push($arraychildlvl2, $arraytmpchildlvl2);
                            $i++;
                        }
                        // LEVEL 1 NO CHILD
                        $arraytmpchildlvl1 = array(
                            'text' => $MSM->MODULE_NAME,
                            'type' => 'Default',
                            'state' => $arraystate,
                            'children' => $arraychildlvl2,
                        );
                        array_push($arraychildlvl1, $arraytmpchildlvl1);
                    } else {

                        // CHECK MODULE ACTIONS (MSM)
                        $resModAct = $this->Usergroup_p_model->getModAct($MSM->ID, $uGroupid);
                        // /CHECK MODULE ACTIONS (MSM)

                        $datacheckbox = array(
                            'Add' => '<input type="hidden" name="moduleMenuID[]" value="' . $resModAct['MODULE_PREVILEGE_ID'] . '"> <input type="hidden" name="MenuID[]" value="' . $MSM->ID . '"> <input type="checkbox" data-index=' . $i . ' name="addcb' . $i . '" onclick="otherToggle(' . $i . ', this)" ' . ($resModAct['IS_CREATE'] == 0 ? '' : 'checked') . '>',
                            'Read' => '<input type="checkbox" data-index=' . $i . ' name="readcb' . $i . '" onclick="readToggle(' . $i . ', this)" ' . ($resModAct['IS_READ'] == 0 ? '' : 'checked') . '>',
                            'Edit' => '<input type="checkbox" data-index=' . $i . ' name="editcb' . $i . '" onclick="otherToggle(' . $i . ', this)" ' . ($resModAct['IS_UPDATE'] == 0 ? '' : 'checked') . '>',
                            'Delete' => '<input type="checkbox" data-index=' . $i . ' name="delcb' . $i . '" onclick="otherToggle(' . $i . ', this)" ' . ($resModAct['IS_DELETE'] == 0 ? '' : 'checked') . '>',
                            'Export' => '<input type="checkbox" data-index=' . $i . ' name="expcb' . $i . '" onclick="otherToggle(' . $i . ', this)" ' . ($resModAct['IS_EXPORT'] == 0 ? '' : 'checked') . '>',
                            'Import' => '<input type="checkbox" data-index=' . $i . ' name="impcb' . $i . '" onclick="otherToggle(' . $i . ', this)" ' . ($resModAct['IS_IMPORT'] == 0 ? '' : 'checked') . '>',
                            'Btn' => '<button class="btn btn-success waves-effect waves-light" type="button" onclick="chkrow(' . $i . ')" style="padding: 0 3px; font-size: 10px; line-height: 20px"> Check/Uncheck</button>',
                        );

                        // LEVEL 1 NO CHILD
                        $arraytmpchildlvl1 = array(
                            'text' => $MSM->MODULE_NAME,
                            'type' => 'Default',
                            'state' => $arraystate,
                            'data' => $datacheckbox,
                        );
                        array_push($arraychildlvl1, $arraytmpchildlvl1);
                        $i++;
                    }
                }

                // LEVEL 1 NO CHILD
                $arraytmp = array(
                    'text' => $row->MODULE_NAME,
                    'type' => 'Default',
                    'state' => $arraystate,
                    'children' => $arraychildlvl1,
                );
            } else {

                // CHECK MODULE ACTIONS
                $resModAct = $this->Usergroup_p_model->getModAct($row->ID, $uGroupid);
                // /CHECK MODULE ACTIONS

                $datacheckbox = array(
                    'Add' => '<input type="hidden" name="moduleMenuID[]" value="' . $resModAct['MODULE_PREVILEGE_ID'] . '"> <input type="hidden" name="MenuID[]" value="' . $row->ID . '"> <input type="checkbox" data-index=' . $i . ' name="addcb' . $i . '" onclick="otherToggle(' . $i . ', this)" ' . ($resModAct['IS_CREATE'] == 0 ? '' : 'checked') . '>',
                    'Read' => '<input type="checkbox" data-index=' . $i . ' name="readcb' . $i . '" onclick="readToggle(' . $i . ', this)" ' . ($resModAct['IS_READ'] == 0 ? '' : 'checked') . '>',
                    'Edit' => '<input type="checkbox" data-index=' . $i . ' name="editcb' . $i . '" onclick="otherToggle(' . $i . ', this)" ' . ($resModAct['IS_UPDATE'] == 0 ? '' : 'checked') . '>',
                    'Delete' => '<input type="checkbox" data-index=' . $i . ' name="delcb' . $i . '" onclick="otherToggle(' . $i . ', this)" ' . ($resModAct['IS_DELETE'] == 0 ? '' : 'checked') . '>',
                    'Export' => '<input type="checkbox" data-index=' . $i . ' name="expcb' . $i . '" onclick="otherToggle(' . $i . ', this)" ' . ($resModAct['IS_EXPORT'] == 0 ? '' : 'checked') . '>',
                    'Import' => '<input type="checkbox" data-index=' . $i . ' name="impcb' . $i . '" onclick="otherToggle(' . $i . ', this)" ' . ($resModAct['IS_IMPORT'] == 0 ? '' : 'checked') . '>',
                    'Btn' => '<button class="btn btn-success waves-effect waves-light" type="button" onclick="chkrow(' . $i . ')" style="padding: 0 3px; font-size: 10px; line-height: 20px"> Check/Uncheck</button>',
                );

                // LEVEL 0 NO CHILD
                $arraytmp = array(
                    'text' => $row->MODULE_NAME,
                    'type' => 'Default',
                    'state' => $arraystate,
                    'data' => $datacheckbox,
                );
                $i++;
            }

            array_push($data['dataTree'], $arraytmp);
        }

        if ($fnc) {
            return $data;
        } else {
            echo json_encode($data);
        }
    }

    public function saveCb()
    {
        $this->db->trans_start();

        for ($i = 0; $i < count($this->input->post('moduleMenuID', true)); $i++) {
            if ($this->input->post('moduleMenuID')[$i] == "") {
                $Cselector = "addcb" . $i;
                $Rselector = "readcb" . $i;
                $Uselector = "editcb" . $i;
                $Dselector = "delcb" . $i;
                $Eselector = "expcb" . $i;
                $Iselector = "impcb" . $i;

                $datainsert = array(
                    'USER_GROUP_ID' => $this->input->post('uGroupCBID', true),
                    'MODULE_PREVILEGE_ID' => $this->input->post('MenuID')[$i],
                    'IS_CREATE' => ($this->input->post($Cselector, true) == "on" ? "1" : "0"),
                    'IS_READ' => ($this->input->post($Rselector, true) == "on" ? "1" : "0"),
                    'IS_UPDATE' => ($this->input->post($Uselector, true) == "on" ? "1" : "0"),
                    'IS_DELETE' => ($this->input->post($Dselector, true) == "on" ? "1" : "0"),
                    'IS_EXPORT' => ($this->input->post($Eselector, true) == "on" ? "1" : "0"),
                    'IS_IMPORT' => ($this->input->post($Iselector, true) == "on" ? "1" : "0"),
                    'CREATED_DATE' => date('Y-m-d H:i:s'),
                    'CREATED_BY' => $_SESSION['username'],
                    'DATE_LOG' => date('Y-m-d H:i:s'),
                    'USER_LOG' => $_SESSION['username'],
                );

                // query INSERT
                $this->db->insert("MS_USER_GROUP_PREVILEGE", $datainsert);
            } else {
                $Cselector = "addcb" . $i;
                $Rselector = "readcb" . $i;
                $Uselector = "editcb" . $i;
                $Dselector = "delcb" . $i;
                $Eselector = "expcb" . $i;
                $Iselector = "impcb" . $i;
                $dataupdate = array(
                    'USER_GROUP_ID' => $this->input->post('uGroupCBID', true),
                    'MODULE_PREVILEGE_ID' => $this->input->post('MenuID')[$i],
                    'IS_CREATE' => ($this->input->post($Cselector, true) == "on" ? "1" : "0"),
                    'IS_READ' => ($this->input->post($Rselector, true) == "on" ? "1" : "0"),
                    'IS_UPDATE' => ($this->input->post($Uselector, true) == "on" ? "1" : "0"),
                    'IS_DELETE' => ($this->input->post($Dselector, true) == "on" ? "1" : "0"),
                    'IS_EXPORT' => ($this->input->post($Eselector, true) == "on" ? "1" : "0"),
                    'IS_IMPORT' => ($this->input->post($Iselector, true) == "on" ? "1" : "0"),
                    'DATE_LOG' => date('Y-m-d H:i:s'),
                    'USER_LOG' => $_SESSION['username'],
                );

                // query UPDATE
                $this->db->where("USER_GROUP_ID", $this->input->post('uGroupCBID', true));
                $this->db->where("MODULE_PREVILEGE_ID", $this->input->post('MenuID')[$i]);
                $this->db->update("MS_USER_GROUP_PREVILEGE", $dataupdate);
            }
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $result = 'Save User Group Privilege Failed. Please Try again';
        } else {
            $this->db->trans_commit();
            $result = 'Save User Group Privilege Success';
        }

        echo json_encode($result);
    }

    // public function json()
    // {
    //     if (empty($_SESSION['iduser'])) {
    //         redirect(base_url("Auth"));
    //     } else if ($_SESSION['pro'] != "bnpb") {
    //         redirect(base_url("Auth"));
    //     } else {

    //         header('Content-Type: application/json');
    //         $col = implode(',', $this->input->post('arr', true));
    //         $tbl = $this->input->post('tb', true);
    //         $modName = $this->input->post('modName', true);
    //         $res = $this->Usergroup_p_model->json($col, $tbl, $modName);
    //         $tes = json_decode($res);
    //         foreach ($tes->data as $row) {
    //             if ($row->CREATED_DATE != "0000-00-00" && $row->CREATED_DATE != null) {
    //                 $row->CREATED_DATE = date('d M Y', strtotime($row->CREATED_DATE));
    //             } else {
    //                 $row->CREATED_DATE = "";
    //             }
    //         }

    //         echo json_encode($tes);

    //     }
    // }

    public function delete_row($id)
    {
        $res = $this->Usergroup_p_model->delete_row($id);

        echo json_encode($res);
    }
}