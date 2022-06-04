<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Users_model extends CI_Model
{

    // Property yang bersifat public
    public $table = 'MS_USERS';
    public $id = 'ID';

    public function __construct()
    {
        parent::__construct();
    }



    public function get_GroupUser()
    {
        $this->db->order_by("USER_GROUP_NAME", "ASC");
        return $this->db->get("MS_USER_GROUP")->result();
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

    public function dupliUser($name, $email, $id = null)
    {
        if ($id != null) {
            $num = $this->db->query("SELECT * FROM " . $this->table . "
                                    WHERE ID <> '" . $id . "' AND
                                    ( USERNAME = '" . $name . "' OR EMAIL = '" . $email . "' )")->num_rows();

            if ($num <= 0) {
                return 1;
            } else {
                return 0;
            }
        } else {
            $this->db->where("USERNAME", $name);
            $this->db->or_where("EMAIL", $email);
            $num = $this->db->get($this->table)->num_rows();

            if ($num <= 0) {
                return 1;
            } else {
                return 0;
            }
        }
    }

    public function changePass($dataupdate, $id = null)
    {
        if ($id != null) {
            $this->db->where($this->id, $id);
            $this->db->update($this->table, $dataupdate);

            return $this->db->affected_rows() . " Affected Rows";
        } else {
            return false;
        }
    }

    public function cekoldpass($pass, $id = null)
    {
        $this->db->where($this->id, $id);
        $user = $this->db->get('MS_USERS')->row();
        if ($user) {

            $password = md5($pass . $user->HASH);
            $pass = $password;

            $this->db->where($this->id, $id);
            $this->db->where("PASSWORD", $pass);
            $num = $this->db->get($this->table)->num_rows();

            if ($num <= 0) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function updateState($dataupdate, $id)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $dataupdate);

        return $this->db->affected_rows() . " Affected Rows";
    }

    public function activeUser($id)
    {
        $dataupdate['status'] = "1";
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $dataupdate);

        return $this->db->affected_rows() . " Affected Rows";
    }

    public function inactiveUser($id)
    {
        $dataupdate['status'] = "0";
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $dataupdate);

        return $this->db->affected_rows() . " Affected Rows";
    }
}