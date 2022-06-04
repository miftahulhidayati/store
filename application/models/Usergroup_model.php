<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// Deklarasi pembuatan class Jurusan_model
class Usergroup_model extends CI_Model
{

    // Property yang bersifat public
    public $table = 'MS_USER_GROUP';
    public $id = 'ID';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_edit($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row_array();
    }

    public function create_action($datainsert)
    {
        $this->db->insert($this->table, $datainsert);

        return $this->db->insert_id($this->id);
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
        $this->db->where("USER_GROUP_ID", $id);
        $this->db->delete("MS_USER_GROUP_PREVILEGE");

        $this->db->where($this->id, $id);
        $this->db->delete($this->table);

        return $this->db->affected_rows() . " Affected Rows";
    }

    public function dupliUserGroup($name, $id = null)
    {
        if ($id != null) {
            $this->db->where("ID <>", $id);
            $this->db->where("USER_GROUP_NAME", $name);
            $num = $this->db->get($this->table)->num_rows();

            if ($num <= 0) {
                return 1;
            } else {
                return 0;
            }

        } else {
            $this->db->where("USER_GROUP_NAME", $name);
            $num = $this->db->get($this->table)->num_rows();

            if ($num <= 0) {
                return 1;
            } else {
                return 0;
            }

        }
    }
    public function update_status($dataupdate, $id)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $dataupdate);
        return $this->db->affected_rows() . " Affected Rows";
    }

}