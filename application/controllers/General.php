<?php
defined('BASEPATH') or exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';

class General extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Global_model');
    }

    public function getCity()
    {
        $id = $this->input->post('id', true);
        $this->db->where('PROVINCE_ID', $id);
        $data = $this->db->get('CITY_KAB')->result();
        echo json_encode($data);
    }
    public function getKecamatan()
    {
        $id = $this->input->post('id', true);
        $this->db->where('CITY_KAB_ID', $id);
        $data = $this->db->get('KECAMATAN')->result();
        echo json_encode($data);
    }
    public function getKelurahan()
    {
        $id = $this->input->post('id', true);
        $this->db->where('KECAMATAN_ID', $id);
        $data = $this->db->get('KELURAHAN')->result();
        echo json_encode($data);
    }

    public function inactiveToggle()
    {
        $id = $_POST['id'];
        $tbl = $_POST['tbl'];
        $col = $_POST['col'];
        $res = false;

        if (($id != "" && $id != null) && ($tbl != "" && $tbl != null) && ($col != "" && $col != null)
        ) {
            $data['STATUS'] = "1";
            $where = array($col => $id);
            $res = $this->Global_model->update($tbl, $data, $where);
        }

        echo json_encode($res);
    }

    public function activeToggle()
    {
        $id = $_POST['id'];
        $tbl = $_POST['tbl'];
        $col = $_POST['col'];
        $res = false;

        if (($id != "" && $id != null) && ($tbl != "" && $tbl != null) && ($col != "" && $col != null)
        ) {
            $data['STATUS'] = "0";
            $where = array($col => $id);
            $res = $this->Global_model->update($tbl, $data, $where);
        }

        echo json_encode($res);
    }
    public function publish()
    {
        $id = $_POST['id'];
        $tbl = $_POST['tbl'];
        $col = $_POST['col'];
        $res = false;

        if (($id != "" && $id != null) && ($tbl != "" && $tbl != null) && ($col != "" && $col != null)
        ) {
            $data['STATUS'] = "2";
            $where = array($col => $id);
            $res = $this->Global_model->update($tbl, $data, $where);
        }

        echo json_encode($res);
    }
    public function json()
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
                $table = "(SELECT *, CONCAT('','') as ACTION  FROM $tbl WHERE $wherecol= '$where' ORDER BY CREATED_DATE DESC)temp";
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

                if ($_SESSION['level'] != $this->config->item("spuser")) {
                    $where = $_GET['where'];
                    $wherecol = $_GET['wherecol'];
                } else {
                    $where = "";
                }
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
    public function modaljson()
    {
        if (empty($_SESSION['iduser'])) {
            redirect(base_url("Auth"));
        } else if ($_SESSION['pro'] != PROJECT_NAME) {
            redirect(base_url("Auth"));
        } else {

            $col = $_GET['arr'];
            $tbl = $_GET['tb'];
            $stt = $_GET['st'];
            if (empty($_GET['where']) || $_GET['where'] == null) {
                $where = "";
            } else {
                $where = $_GET['where'];
                $wherecol = $_GET['wherecol'];
            }

            if ($where != "") {
                $table = "(SELECT * FROM $tbl WHERE STATUS = '$stt' AND $wherecol = '$where' ORDER BY CREATED_DATE DESC)temp";
            } else {
                $table = "(SELECT * FROM $tbl WHERE STATUS = '$stt' ORDER BY CREATED_DATE DESC)temp";
            }

            // Primary key of table
            $primaryKey = $col[0];

            for ($i = 0; $i < sizeof($col); $i++) {
                $columns[$i]['db'] = $col[$i];
                $columns[$i]['dt'] = $i;
            }

            echo json_encode(
                SSP::simple($_GET, $this->config->item('dbss'), $table, $primaryKey, $columns)
            );
        }
    }
}