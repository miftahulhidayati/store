<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// Deklarasi pembuatan class Jurusan_model
class Groupprivilege_model extends CI_Model
{

    // Property yang bersifat public
    public $table = 'MS_USER_GROUP_PREVILEGE';
    public $id = 'ID';

    public function __construct()
    {
        parent::__construct();
    }

    public function json($col, $tbl, $modName)
    {
        $this->datatables->select($col);
        $this->datatables->from($tbl);

        foreach ($_SESSION['privilege'] as $row) {
            if ($row['MODULE_NAME'] == $modName) {

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

                break;
            }
        }

        // $isEdit = 1;
        // $isDelete = 1;

        $this->datatables->where("USER_GROUP_NAME <>", "Admin");

        if ($isEdit == 1) {
            $this->datatables->add_column('ACTION',
                '<div style="text-align: left;">
                    < style="float: none; margin-right: 1px;">
                        <button onclick="openEdit2(\'$1\')" type="button" class="btn btn-success"><i class="fas fa-pen"></i></button>
                    </div>
                </div>', 'USER_GROUP_ID'
            );
        } else if ($isEdit == 0) {
            $this->datatables->add_column('ACTION', '<div style="text-align: left;"></div>', 'ID');
        }

        return $sql = $this->datatables->generate();
    }

    public function getUserGroup()
    {
        $this->db->order_by($this->id, "desc");
        return $this->db->get("MS_USER_GROUP")->result();
    }

    public function getModulePrivilege()
    {
        $this->db->where("ACTIVE", "1");
        $this->db->order_by($this->id, "desc");
        return $this->db->get("MS_MODULE_PREVILEGE")->result();
    }

    public function get_edit($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row_array();
    }

    public function create_action($datainsert)
    {
        $this->db->insert($this->table, $datainsert);

        return $this->db->affected_rows() . " Affected Rows";
    }

    public function update_action($dataupdate, $id)
    {
        $cekrow = $this->db->get_where($this->table, $dataupdate)->num_rows();
        if ($cekrow == 1) {
            return "1: No update, data is same";
        } else {
            $this->db->where($this->id, $id);
            $this->db->update($this->table, $dataupdate);

            return $this->db->affected_rows() . " Affected Rows";
        }
    }

    public function delete_row($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);

        return $this->db->affected_rows() . " Affected Rows";
    }

    public function dupliUGroupPrivilege($name)
    {
        $this->db->where("USER_GROUP_ID", $name);
        $num = $this->db->get($this->table)->num_rows();

        if ($num <= 0) {
            return 1;
        } else {
            return 0;
        }

    }

    public function getListMM()
    {
        $queryMainMenu = "SELECT * FROM MS_MODULE_PREVILEGE WHERE MENU_LEVEL=0 AND ACTIVE=1
                        ORDER BY MENU_SEQ ASC";
        return $this->db->query($queryMainMenu)->result();
    }

    public function getMSM($parent)
    {
        $queryMSM = "SELECT * FROM MS_MODULE_PREVILEGE WHERE MENU_LEVEL=1 AND MENU_PARENT=" . $parent . " AND ACTIVE=1
                    ORDER BY MENU_SEQ ASC";
        return $this->db->query($queryMSM);
    }

    public function getSSM($parent)
    {
        $querySSM = "SELECT * FROM MS_MODULE_PREVILEGE WHERE MENU_LEVEL=2 AND MENU_PARENT=" . $parent . " AND ACTIVE=1
                    ORDER BY MENU_SEQ ASC";
        return $this->db->query($querySSM);
    }

    public function getModAct($modId, $uGID)
    {
        $queryModAct = "SELECT * FROM MS_USER_GROUP_PREVILEGE WHERE MODULE_PREVILEGE_ID = '" . $modId . "' AND USER_GROUP_ID = '" . $uGID . "'";
        return $this->db->query($queryModAct)->row_array();
    }

}
