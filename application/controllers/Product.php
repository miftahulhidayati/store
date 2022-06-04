<?php
defined('BASEPATH') or exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('joy_helper');
        $this->load->model('Product_model');
        $this->load->model('Category_product_model');
    }
    public function index()
    {
        if (empty($_SESSION['iduser'])) {
            redirect(base_url("Auth"));
        } else if ($_SESSION['pro'] != PROJECT_NAME) {
            redirect(base_url("Auth"));
        } else {
            if (!(in_array("Product", $_SESSION['lMenu']))) {
                redirect(base_url($_SESSION['linkMenu'][0]));
            }
            foreach ($_SESSION['privilege'] as $row) {
                if ($row['MODULE_NAME'] == "Product") {
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
                'menu_name' => 'Product',
            );
            $this->load->view('product/view', $data);
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

            $table = "(SELECT A.*, B.NAME AS CATEGORY_NAME, CONCAT('','') as ACTION FROM MS_PRODUCT A
                JOIN MS_CATEGORY_PRODUCT B ON B.ID_CATEGORY_PRODUCT = A.ID_CATEGORY_PRODUCT
                ORDER BY A.CREATED_DATE DESC)temp";

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
    public function add()
    {
        if (empty($_SESSION['iduser'])) {
            redirect(base_url("Auth"));
        } else if ($_SESSION['pro'] != PROJECT_NAME) {
            redirect(base_url("Auth"));
        } else {
            if (!(in_array("Product", $_SESSION['lMenu']))) {
                redirect(base_url($_SESSION['linkMenu'][0]));
            }
            foreach ($_SESSION['privilege'] as $row) {
                if ($row['MODULE_NAME'] == "Product") {
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
            $category = $this->Category_product_model->get();
            $data = array(
                'isCreate' => $isCreate,
                'isEdit' => $isEdit,
                'isRead' => $isRead,
                'isDelete' => $isDelete,
                'isExp' => $isExp,
                'isImp' => $isImp,
                'menu_name' => 'Product',
                'back' => base_url('product'),
                'category' => $category
            );
            $this->load->view('product/add', $data);
        }
    }
    public function edit($id)
    {
        if (empty($_SESSION['iduser'])) {
            redirect(base_url("Auth"));
        } else if ($_SESSION['pro'] != PROJECT_NAME) {
            redirect(base_url("Auth"));
        } else {
            if (!(in_array("Product", $_SESSION['lMenu']))) {
                redirect(base_url($_SESSION['linkMenu'][0]));
            }
            foreach ($_SESSION['privilege'] as $row) {
                if ($row['MODULE_NAME'] == "Product") {
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
            $product = $this->Product_model->get_edit($id);
            $category = $this->Category_product_model->get();

            $data = array(
                'isCreate' => $isCreate,
                'isEdit' => $isEdit,
                'isRead' => $isRead,
                'isDelete' => $isDelete,
                'isExp' => $isExp,
                'isImp' => $isImp,
                'menu_name' => 'Product',
                'back' => base_url('product'),
                'category' => $category,
                'product' => $product
            );
            $this->load->view('product/edit', $data);
        }
    }

    public function get_last_id($column, $table)
    {
        $q = $this->db->query("select $column from $table where $column = (select max($column) from $table)")->row_array();
        return $q[$column] + 1;
    }
    public function create_action()
    {
        if (empty($_SESSION['iduser'])) {
            redirect(base_url("Auth"));
        } else if ($_SESSION['pro'] != PROJECT_NAME) {
            redirect(base_url("Auth"));
        } else {
            $cekduplicate = $this->Product_model->duplicateProduct($this->input->post('product_name', true));
            if (!$cekduplicate) {
                $res = "Failed: Duplicate Data Product Name";
                echo json_encode($res);
                exit();
            }
            $urllink = '';
            if (isset($_FILES['img_product']['name'])) {
                $tmpFilePath = $_FILES['img_product']['tmp_name']; // the temp file path
                $fileName = $_FILES['img_product']['name']; // the file name
                $fileSize = $_FILES['img_product']['size']; // the file size

                if (isset($fileName) && $fileName != '' && $fileName != null) {
                    $target_dir = $this->config->item('path_product');
                    $save = $this->config->item('save_product');
                    if (!is_dir($target_dir)) {
                        mkdir($target_dir, 0777, true);
                    }

                    $original_filename = $fileName;
                    $ext = pathinfo($original_filename, PATHINFO_EXTENSION);
                    $filename_without_ext = basename($original_filename, '.' . $ext);
                    $namefile = preg_replace('/[^A-Za-z0-9\-]/', '', $filename_without_ext);
                    $filenamee = str_replace(' ', '', $namefile) . '' . date("ymd") . $this->get_last_id('ID_PRODUCT', 'MS_PRODUCT');
                    $new_filename = $filenamee . '.' . $ext;

                    if (@move_uploaded_file($tmpFilePath, $target_dir . $new_filename)) {

                        $urllink = $save . $new_filename;
                    } else {
                        $errors[] = $fileName;
                    }
                } else {
                    $errors[] = $fileName;
                }
            }
            $datainsert = array(
                'IMAGE_URL' => $urllink,
                'NAME' => $this->input->post('product_name', true),
                'PRICE' => $this->input->post('price', true),
                'ID_CATEGORY_PRODUCT' => $this->input->post('id_category_product', true),
                'DESCRIPTION' => $this->input->post('description', true),
                'STATUS' => 1,
                'CREATED_DATE' => date('Y-m-d H:i:s'),
                'CREATED_BY' => $_SESSION['username'],
                'DATE_LOG' => date('Y-m-d H:i:s'),
                'USER_LOG' => $_SESSION['username'],
            );
            $res = $this->Product_model->insert($datainsert);
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
            $id = $this->input->post('id_product', true);
            $cekduplicate = $this->Product_model->duplicateProduct($this->input->post('product_name', true), $id);
            if (!$cekduplicate) {
                $res = "Failed: Duplicate Data Product Name";
                echo json_encode($res);
                exit();
            }

            $dataupdate = array(
                'NAME' => $this->input->post('product_name', true),
                'PRICE' => $this->input->post('price', true),
                'ID_CATEGORY_PRODUCT' => $this->input->post('id_category_product', true),
                'DESCRIPTION' => $this->input->post('description', true),
                'STATUS' => 1,
                'DATE_LOG' => date('Y-m-d H:i:s'),
                'USER_LOG' => $_SESSION['username'],
            );
            if (isset($_FILES['img_product']['name']) && !empty($_FILES['img_product']['name']) && $_FILES['img_product']['name'] != 'blob') {
                $tmpFilePath = $_FILES['img_product']['tmp_name']; // the temp file path
                $fileName = $_FILES['img_product']['name']; // the file name
                $fileSize = $_FILES['img_product']['size']; // the file size

                if (isset($fileName) && $fileName != '' && $fileName != null) {
                    $target_dir = $this->config->item('path_product');
                    $save = $this->config->item('save_product');
                    if (!is_dir($target_dir)) {
                        mkdir($target_dir, 0777, true);
                    }

                    $original_filename = $fileName;
                    $ext = pathinfo($original_filename, PATHINFO_EXTENSION);
                    $filename_without_ext = basename($original_filename, '.' . $ext);
                    $namefile = preg_replace('/[^A-Za-z0-9\-]/', '', $filename_without_ext);
                    $filenamee = str_replace(' ', '', $namefile) . '' . date("ymd") . $this->get_last_id('ID_PRODUCT', 'MS_PRODUCT');
                    $new_filename = $filenamee . '.' . $ext;

                    // $target = $target_dir . basename($original_filename);
                    // $tmp = $tmpFilePath;

                    if (@move_uploaded_file($tmpFilePath, $target_dir . $new_filename)) {

                        $urllink = $save . $new_filename;
                        $dataupdate['IMAGE_URL'] = $urllink;
                    } else {
                        $errors[] = $fileName;
                    }
                } else {
                    $errors[] = $fileName;
                }
            }

            $res = $this->Product_model->update($dataupdate, array('ID_PRODUCT' => $id));
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
        $res = $this->Product_model->update($dataupdate, array('ID_PRODUCT' => $id));
        echo json_encode($res);
    }
    public function inactiveAction($id)
    {
        $dataupdate = array(
            'STATUS'      => '0',
            'DATE_LOG'    => date('Y-m-d H:i:s'),
            'USER_LOG'    => $_SESSION['username'],
        );
        $res = $this->Product_model->update($dataupdate, array('ID_PRODUCT' => $id));
        echo json_encode($res);
    }
}