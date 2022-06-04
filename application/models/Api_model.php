<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Api_model extends CI_Model
{

    public $id = 'ID';

    public function __construct()
    {
        parent::__construct();
    }

    public function getListMM()
    {
        $queryMainMenu = "SELECT * FROM MS_MODULE_PREVILEGE WHERE MENU_LEVEL=0 AND ACTIVE=1 AND IS_MOBILE = 0
                        ORDER BY MENU_SEQ ASC";
        return $this->db->query($queryMainMenu)->result();
    }

    public function getMSM($parent)
    {
        $queryMSM = "SELECT * FROM MS_MODULE_PREVILEGE WHERE MENU_LEVEL=1 AND MENU_PARENT=" . $parent . " AND ACTIVE=1 AND IS_MOBILE = 0
                    ORDER BY MENU_SEQ ASC";
        return $this->db->query($queryMSM);
    }

    public function getSSM($parent)
    {
        $querySSM = "SELECT * FROM MS_MODULE_PREVILEGE WHERE MENU_LEVEL=2 AND MENU_PARENT=" . $parent . " AND ACTIVE=1 AND IS_MOBILE = 0
                    ORDER BY MENU_SEQ ASC";
        return $this->db->query($querySSM);
    }

    public function getModAct($modId, $uGID)
    {
        $queryModAct = "SELECT * FROM MS_USER_GROUP_PREVILEGE WHERE MODULE_PREVILEGE_ID = '" . $modId . "' AND USER_GROUP_ID = '" . $uGID . "' AND IS_MOBILE = 0";
        return $this->db->query($queryModAct)->row_array();
    }

    public function AuthLogin($uname = null, $pass = null)
    {
        $this->db->where('USERNAME', $uname);
        $this->db->where('PASSWORD', $pass);
        $data = $this->db->get('v_tblUsers');

        if ($data->num_rows() <= 0) {
            $res = false;
        } else {
            $res = $data->result();
        }

        return $res;
    }

    public function getPrivilege($uname = null, $pass = null)
    {

        $queryGet = "SELECT C.ID, MODULE_NAME, USERNAME, D.ID AS USER_ID, MENU_LEVEL, MENU_PARENT, MENU_SEQ,
                        A.IS_READ, A.IS_CREATE, A.IS_DELETE, A.IS_UPDATE, A.IS_EXPORT, A.IS_IMPORT,
                        C.CONTROLLER, C.FUNCTION, C.ICON
                    FROM MS_USER_GROUP_PREVILEGE A
                    JOIN MS_USER_GROUP B ON A.USER_GROUP_ID = B.ID
                    JOIN MS_MODULE_PREVILEGE C ON A.MODULE_PREVILEGE_ID = C.ID
                    JOIN MS_USERS D ON B.ID = D.GROUP_ID
                    WHERE (D.USERNAME = '" . $uname . "')
                    AND IS_READ != '0'
                    ORDER BY C.MENU_SEQ ASC";

        return $this->db->query($queryGet);
    }

}