<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Api_model');
    }

    public function get_PrivilegeCb($uGroupid)
    {

        $listMainMenu = $this->Api_model->getListMM();

        $arraystate = array('opened' => true);
        $data['dataTree'] = array();
        $i = 0;
        foreach ($listMainMenu as $row) {

            // CHECK MAIN SUB MENU
            $resMSM = $this->Api_model->getMSM($row->ID);
            // /CHECK MAIN SUB MENU

            if ($resMSM->num_rows() > 0) {

                $arraychildlvl1 = array();
                foreach ($resMSM->result() as $MSM) {

                    // CHECK SUB SUB MENU
                    $resSSM = $this->Api_model->getSSM($MSM->ID);
                    // /CHECK SUB SUB MENU

                    if ($resSSM->num_rows() > 0) {

                        $arraychildlvl2 = array();
                        foreach ($resSSM->result() as $SSM) {

                            // CHECK MODULE ACTIONS (SSM)
                            $resModAct = $this->Api_model->getModAct($SSM->ID, $uGroupid);
                            // /CHECK MODULE ACTIONS (SSM)

                            $datacheckbox = array(
                                'Add' => '<input type="hidden" name="moduleMenuID[]" value="' . $resModAct['MODULE_PREVILEGE_ID'] . '"> <input type="hidden" name="MenuID[]" value="' . $SSM->ID . '"> <input type="checkbox" data-index=' . $i . ' name="addcb' . $i . '" ' . ($resModAct['IS_CREATE'] == 0 ? '' : 'checked') . '>',
                                'Read' => '<input type="checkbox" data-index=' . $i . ' name="readcb' . $i . '" onclick="readToggle(' . $i . ', this)" ' . ($resModAct['IS_READ'] == 0 ? '' : 'checked') . '>',
                                'Edit' => '<input type="checkbox" data-index=' . $i . ' name="editcb' . $i . '" ' . ($resModAct['IS_UPDATE'] == 0 ? '' : 'checked') . '>',
                                'Delete' => '<input type="checkbox" data-index=' . $i . ' name="delcb' . $i . '" ' . ($resModAct['IS_DELETE'] == 0 ? '' : 'checked') . '>',
                                'Export' => '<input type="checkbox" data-index=' . $i . ' name="expcb' . $i . '" ' . ($resModAct['IS_EXPORT'] == 0 ? '' : 'checked') . '>',
                                'Import' => '<input type="checkbox" data-index=' . $i . ' name="impcb' . $i . '" ' . ($resModAct['IS_IMPORT'] == 0 ? '' : 'checked') . '>',
                                'Btn' => '<button class="btn btn-success waves-effect waves-light" type="button" onclick="chkrow(' . $i . ')" style="padding: 0 3px; font-size: 10px;"> Check/Uncheck</button>',
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
                        $resModAct = $this->Api_model->getModAct($MSM->ID, $uGroupid);
                        // /CHECK MODULE ACTIONS (MSM)

                        $datacheckbox = array(
                            'Add' => '<input type="hidden" name="moduleMenuID[]" value="' . $resModAct['MODULE_PREVILEGE_ID'] . '"> <input type="hidden" name="MenuID[]" value="' . $MSM->ID . '"> <input type="checkbox" data-index=' . $i . ' name="addcb' . $i . '" ' . ($resModAct['IS_CREATE'] == 0 ? '' : 'checked') . '>',
                            'Read' => '<input type="checkbox" data-index=' . $i . ' name="readcb' . $i . '" onclick="readToggle(' . $i . ', this)" ' . ($resModAct['IS_READ'] == 0 ? '' : 'checked') . '>',
                            'Edit' => '<input type="checkbox" data-index=' . $i . ' name="editcb' . $i . '" ' . ($resModAct['IS_UPDATE'] == 0 ? '' : 'checked') . '>',
                            'Delete' => '<input type="checkbox" data-index=' . $i . ' name="delcb' . $i . '" ' . ($resModAct['IS_DELETE'] == 0 ? '' : 'checked') . '>',
                            'Export' => '<input type="checkbox" data-index=' . $i . ' name="expcb' . $i . '" ' . ($resModAct['IS_EXPORT'] == 0 ? '' : 'checked') . '>',
                            'Import' => '<input type="checkbox" data-index=' . $i . ' name="impcb' . $i . '" ' . ($resModAct['IS_IMPORT'] == 0 ? '' : 'checked') . '>',
                            'Btn' => '<button class="btn btn-success waves-effect waves-light" type="button" onclick="chkrow(' . $i . ')" style="padding: 0 3px; font-size: 10px;"> Check/Uncheck</button>',
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
                $resModAct = $this->Api_model->getModAct($row->ID, $uGroupid);
                // /CHECK MODULE ACTIONS

                $datacheckbox = array(
                    'Add' => '<input type="hidden" name="moduleMenuID[]" value="' . $resModAct['MODULE_PREVILEGE_ID'] . '"> <input type="hidden" name="MenuID[]" value="' . $row->ID . '"> <input type="checkbox" data-index=' . $i . ' name="addcb' . $i . '" ' . ($resModAct['IS_CREATE'] == 0 ? '' : 'checked') . '>',
                    'Read' => '<input type="checkbox" data-index=' . $i . ' name="readcb' . $i . '" onclick="readToggle(' . $i . ', this)" ' . ($resModAct['IS_READ'] == 0 ? '' : 'checked') . '>',
                    'Edit' => '<input type="checkbox" data-index=' . $i . ' name="editcb' . $i . '" ' . ($resModAct['IS_UPDATE'] == 0 ? '' : 'checked') . '>',
                    'Delete' => '<input type="checkbox" data-index=' . $i . ' name="delcb' . $i . '" ' . ($resModAct['IS_DELETE'] == 0 ? '' : 'checked') . '>',
                    'Export' => '<input type="checkbox" data-index=' . $i . ' name="expcb' . $i . '" ' . ($resModAct['IS_EXPORT'] == 0 ? '' : 'checked') . '>',
                    'Import' => '<input type="checkbox" data-index=' . $i . ' name="impcb' . $i . '" ' . ($resModAct['IS_IMPORT'] == 0 ? '' : 'checked') . '>',
                    'Btn' => '<button class="btn btn-success waves-effect waves-light" type="button" onclick="chkrow(' . $i . ')" style="padding: 0 3px; font-size: 10px;"> Check/Uncheck</button>',
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

        echo json_encode($data);
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

    public function getNavmenu($resMod)
    {

        $modName = array();
        foreach ($resMod as $listMenu) {
            array_push($modName, $listMenu->MODULE_NAME);
        }

        // var_dump($modName);

        $smodName = "'" . (implode("','", $modName)) . "'";

        $queryMainMenu = "SELECT * FROM MS_MODULE_PREVILEGE WHERE MENU_LEVEL=0 AND ACTIVE=1
							ORDER BY MENU_SEQ ASC";
        $listMainMenu = $this->db->query($queryMainMenu)->result();

        $data['NavMenu'] = array();

        foreach ($listMainMenu as $row) {

            // CHECK MAIN SUB MENU
            $queryMSM = "SELECT * FROM MS_MODULE_PREVILEGE WHERE MENU_LEVEL=1 AND MENU_PARENT=" . $row->ID . " AND ACTIVE=1  ORDER BY MENU_SEQ ASC";
            $resMSM = $this->db->query($queryMSM);
            // /CHECK MAIN SUB MENU

            if ($resMSM->num_rows() > 0) {

                $arraychildlvl1 = array();
                foreach ($resMSM->result() as $MSM) {

                    // CHECK SUB SUB MENU
                    $querySSM = "SELECT * FROM MS_MODULE_PREVILEGE WHERE MENU_LEVEL=2 AND MENU_PARENT=" . $MSM->ID . " AND ACTIVE=1  ORDER BY MENU_SEQ ASC";
                    $resSSM = $this->db->query($querySSM);
                    // /CHECK SUB SUB MENU

                    if ($resSSM->num_rows() > 0) {

                        $arraychildlvl2 = array();
                        foreach ($resSSM->result() as $SSM) {

                            // CHECK SUB SUB SUB MENU
                            $querySSSM = "SELECT * FROM MS_MODULE_PREVILEGE WHERE MENU_LEVEL=3 AND MENU_PARENT=" . $SSM->ID . " AND ACTIVE=1  ORDER BY MENU_SEQ ASC";
                            $resSSSM = $this->db->query($querySSSM);
                            // /CHECK SUB SUB SUB MENU

                            if ($resSSSM->num_rows() > 0) {

                                $arraychildlvl3 = array();
                                foreach ($resSSSM->result() as $SSSM) {
                                    // LEVEL 3
                                    $arraytmpchildlvl3 = array(
                                        'NAME' => $SSSM->MODULE_NAME,
                                        'CONTROLLER' => $SSSM->CONTROLLER,
                                        'LINK' => ($SSSM->CONTROLLER == null) ? '#' : $SSM->CONTROLLER . '/' . $SSM->FUNCTION,
                                        'ICON' => $SSSM->ICON,
                                        'ID' => $SSSM->ID,
                                    );
                                    if (in_array($SSM->MODULE_NAME, $modName)) {
                                        array_push($arraychildlvl3, $arraytmpchildlvl3);
                                    }
                                }

                                // LEVEL 2
                                $arraytmpchildlvl2 = array(
                                    'NAME' => $SSM->MODULE_NAME,
                                    'CONTROLLER' => $SSM->CONTROLLER,
                                    'LINK' => ($SSM->CONTROLLER == null) ? '#' : $SSM->CONTROLLER . '/' . $SSM->FUNCTION,
                                    'ICON' => $SSM->ICON,
                                    'ID' => $SSM->ID,
                                    'CHILD' => $arraychildlvl3,
                                );
                                if (in_array($SSM->MODULE_NAME, $modName)) {
                                    array_push($arraychildlvl2, $arraytmpchildlvl2);
                                }
                            } else {
                                // LEVEL 2
                                $arraytmpchildlvl2 = array(
                                    'NAME' => $SSM->MODULE_NAME,
                                    'CONTROLLER' => $SSM->CONTROLLER,
                                    'LINK' => ($SSM->CONTROLLER == null) ? '#' : $SSM->CONTROLLER . '/' . $SSM->FUNCTION,
                                    'ID' => $SSM->ID,
                                    'ICON' => $SSM->ICON,
                                    'CHILD' => null,
                                );
                                if (in_array($SSM->MODULE_NAME, $modName)) {
                                    array_push($arraychildlvl2, $arraytmpchildlvl2);
                                }
                            }
                        }
                        // LEVEL 1
                        $arraytmpchildlvl1 = array(
                            'NAME' => $MSM->MODULE_NAME,
                            'CONTROLLER' => $MSM->CONTROLLER,
                            'LINK' => ($MSM->CONTROLLER == null) ? '#' : $MSM->CONTROLLER . '/' . $MSM->FUNCTION,
                            'ICON' => $MSM->ICON,
                            'ID' => $MSM->ID,
                            'CHILD' => $arraychildlvl2,
                        );

                        if (!(empty($arraychildlvl2))) {
                            array_push($arraychildlvl1, $arraytmpchildlvl1);
                        }
                    } else {

                        // LEVEL 1 NO CHILD
                        $arraytmpchildlvl1 = array(
                            'NAME' => $MSM->MODULE_NAME,
                            'CONTROLLER' => $MSM->CONTROLLER,
                            'LINK' => ($MSM->CONTROLLER == null) ? '#' : $MSM->CONTROLLER . '/' . $MSM->FUNCTION,
                            'ID' => $MSM->ID,
                            'ICON' => $MSM->ICON,
                            'CHILD' => null,
                        );

                        if (in_array($MSM->MODULE_NAME, $modName)) {
                            array_push($arraychildlvl1, $arraytmpchildlvl1);
                        }
                    }
                }

                // LEVEL 0
                $arraytmp = array(
                    'NAME' => $row->MODULE_NAME,
                    'CONTROLLER' => $row->CONTROLLER,
                    'LINK' => ($row->CONTROLLER == null) ? '#' : $row->CONTROLLER . '/' . $row->FUNCTION,
                    'ID' => $row->ID,
                    'ICON' => $row->ICON,
                    'CHILD' => $arraychildlvl1,
                );

                if (!(empty($arraychildlvl1))) {
                    array_push($data['NavMenu'], $arraytmp);
                }
            } else {

                // LEVEL 0 NO CHILD
                $arraytmp = array(
                    'NAME' => $row->MODULE_NAME,
                    'CONTROLLER' => $row->CONTROLLER,
                    'LINK' => ($row->CONTROLLER == null) ? '#' : $row->CONTROLLER . '/' . $row->FUNCTION,
                    'ID' => $row->ID,
                    'ICON' => $row->ICON,
                    'CHILD' => null,
                );

                if (in_array($row->MODULE_NAME, $modName)) {
                    array_push($data['NavMenu'], $arraytmp);
                }
            }
        }

        // echo json_encode($data['NavMenu']);exit();
        // var_dump($data['NavMenu']);

        return $data['NavMenu'];
    }
    public function error404()
    {
        $this->load->view('templates/error404');
    }
    public function doLogin()
    {

        $uname = $_POST['uname'];
        // $pass = md5($_POST['password']);

        // $ress = $this->Api_model->AuthLogin($uname, $pass);

        $this->db->where('USERNAME', $uname);
        $user = $this->db->get('MS_USERS')->row();
        if ($user) {

            $password = md5($this->input->post('password', true) . $user->HASH);
            $pass = $password;
            $ress = $this->Api_model->AuthLogin($uname, $pass);
        } else {
            $res['msg'] = "Failed: Invalid username. Please Try Again";
            $res['status'] = false;
            $res['type'] = "System";
            echo json_encode($res);
            exit();
        }

        $res['msg'] = "";
        $res['status'] = false;
        $res['type'] = "";
        $res['data'] = "";

        if ($ress) {
            foreach ($ress as $data) {
                $sess_username = $data->USERNAME;
                $sess_name = $data->NAME;
                $sess_email = $data->EMAIL;
                $sess_position = $data->POSITION;
                $sess_group = $data->GROUP_ID;
                $sess_iduser = $data->ID;
                $sess_status = $data->STATUS;
                $sess_store = $data->ID_STORE;
                $sess_pro = PROJECT_NAME;
            }

            if ($sess_status == "1") {
                if ($sess_group != '' || $sess_group != null) {

                    $resQueryPrivilege = $this->Api_model->getPrivilege($uname, $pass);

                    if ($resQueryPrivilege->num_rows() > 0) {

                        $dataPrivilege = array();
                        foreach ($resQueryPrivilege->result() as $row) {
                            $arraytmp = array(
                                'MODULE_NAME' => $row->MODULE_NAME,
                                'MODULE_NAME' => $row->MODULE_NAME,
                                'IS_CREATE' => $row->IS_CREATE,
                                'IS_READ' => $row->IS_READ,
                                'IS_UPDATE' => $row->IS_UPDATE,
                                'IS_DELETE' => $row->IS_DELETE,
                                'IS_EXPORT' => $row->IS_EXPORT,
                                'IS_IMPORT' => $row->IS_IMPORT,
                            );

                            array_push($dataPrivilege, $arraytmp);
                        }

                        $modName = array();
                        $modLink = array();
                        foreach ($resQueryPrivilege->result() as $listMenu) {
                            array_push($modName, $listMenu->MODULE_NAME);
                            array_push($modLink, $listMenu->CONTROLLER . "/" . $listMenu->FUNCTION);
                        }

                        $_SESSION['lMenu'] = $modName;
                        $_SESSION['linkMenu'] = $modLink;
                        $_SESSION['privilege'] = $dataPrivilege;
                        $_SESSION['navMenu'] = $this->getNavmenu($resQueryPrivilege->result());
                        $_SESSION['username'] = $sess_username;
                        $_SESSION['name'] = $sess_name;
                        $_SESSION['email'] = $sess_email;
                        $_SESSION['position'] = $sess_position;
                        $_SESSION['level'] = $sess_group;
                        $_SESSION['iduser'] = $sess_iduser;
                        $_SESSION['status'] = $sess_status;
                        $_SESSION['store'] = $sess_store;
                        $_SESSION['pro'] = $sess_pro;
                        $_SESSION['text'] = "Success";

                        $res['msg'] = "Success";
                        $res['status'] = true;
                        $res['type'] = "System";
                        $res['data'] = $ress;
                    } else {
                        $res['msg'] = "Failed: Your Account Does Not Have Privilege Yet";
                        $res['status'] = false;
                        $res['type'] = "System";
                        $res['data'] = $ress;
                    }
                }
            } else {
                $res['msg'] = "Failed: Your Account Does Not Active";
                $res['status'] = false;
            }
        } else {
            $res['msg'] = "Failed: Invalid username or password. Please Try Again";
            $res['status'] = false;
        }

        echo json_encode($res);
    }

    public function sessDestroy()
    {
        session_destroy();

        redirect(base_url());
    }
}