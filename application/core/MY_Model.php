<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    protected $_table_name;
    protected $_order_by;
    protected $_order_by_type;
    protected $_primary_filter = 'intval';
    protected $_primary_key;
    protected $_type;
    public $rules;

    public function __construct()
    {
        parent::__construct();
    }

    public function insert($data, $batch = false)
    {

        if ($batch == true) {
            $this->db->insert_batch($this->_table_name, $data);
        } else {
            $this->db->set($data);
            $this->db->insert($this->_table_name);
            $id = $this->db->insert_id();
            return $id;
        }
    }

    public function update($data, $where = array())
    {

        $this->db->set($data);
        $this->db->where($where);
        $this->db->update($this->_table_name);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get($id = null, $single = false)
    {

        if ($id != null) {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_primary_key, $id);
            $method = 'row';
        } elseif ($single == true) {
            $method = 'row';
        } else {
            $method = 'result';
        }

        if ($this->_order_by_type) {
            $this->db->order_by($this->_order_by, $this->_order_by_type);
        } else {
            $this->db->order_by($this->_order_by);
        }
        $this->db->where('STATUS', 1);
        return $this->db->get($this->_table_name)->$method();
    }
    function get_edit($id)
    {
        $this->db->where($this->_primary_key, $id);
        return $this->db->get($this->_table_name)->row_array();
    }

    public function get_where_in($where_in = null)
    {
        if ($where_in) {
            foreach ($where_in as $key => $value) {
                $this->db->where_in($key, $value);
            }
        }

        return $this->get_by(null, null, null, false, null);
    }

    public function get_by($where = null, $limit = null, $offset = null, $single = false, $select = null)
    {

        if ($select != null) {
            $this->db->select($select);
        }

        if ($where != null) {
            $this->db->where($where);
        }

        if (($limit) && ($offset)) {
            $this->db->limit($limit, $offset);
        } elseif (($limit)) {
            $this->db->limit($limit);
        }

        return $this->get(null, $single);
    }

    public function delete($id)
    {

        $filter = $this->_primary_filter;
        $id = $filter($id);

        if (!$id) {
            return false;
        }

        $this->db->where($this->_primary_key, $id);
        $this->db->limit(1);
        $delete = $this->db->delete($this->_table_name);
        if ($delete) {
            return true;
        }
    }
    function delete_row($id)
    {
        $this->db->where($this->_primary_key, $id);
        $this->db->delete($this->_table_name);

        return $this->db->affected_rows() . " Affected Rows";
    }

    public function delete_by($where = null)
    {

        if ($where) {
            $this->db->where($where);
        }

        $this->db->delete($this->_table_name);
    }

    public function count($where = null)
    {

        if (!empty($this->_type)) {
            $where['post_type'] = $this->_type;
        }

        if ($where) {
            $this->db->where($where);
        }

        $this->db->from($this->_table_name);
        return $this->db->count_all_results();
    }

    public function unique_update($value, $id, $field)
    {

        $get_data = $this->get($id);
        $value = strtolower($value);
        $get_field = strtolower($get_data->$field);

        if ($value == $get_field) {
            $require = '';
        } else {
            $require = '|is_unique[{PRE}' . $this->_table_name . '.' . $field . ']';
        }

        return $require;
    }
    //---------
    public function fetch($where)
    {
        return $this->db->get_where($this->_tabel_name, $where)->result();
    }
    public function fetch_row($where)
    {
        return $this->db->get_where($this->_table_name, $where)->row();
    }

    public function removeFile($oldfile)
    {
        $oldfile = str_replace("--go[c-g]oc--", "/", $oldfile);
        $cmd = 'rm -f -r ' . $oldfile;
        shell_exec($cmd);
    }
    public function cekDuplicate($name, $field_where, $field_id = null, $id = null)
    {
        if ($id == null) {
            $this->db->where($field_where, $name);
            $num = $this->db->get($this->_table_name)->num_rows();
            if ($num >= 1) {
                return 0;
            } else {
                return 1;
            }
        } else {
            $this->db->where($field_where, $name);
            $this->db->where_not_in($field_id, $id);
            $num = $this->db->get($this->_table_name)->num_rows();
            if ($num >= 1) {
                return 0;
            } else {
                return 1;
            }
        }

        $this->db->close();
    }

    public function createThumbnail($src, $dest, $targetWidth, $targetHeight = null)
    {

        $type = exif_imagetype($src);

        $ext = pathinfo($src, PATHINFO_EXTENSION);

        switch (mime_content_type($src)) {
            case 'image/png':
                $image = imagecreatefrompng($src);
                break;
            case 'image/jpeg':
                $image = imagecreatefromjpeg($src);
                break;
            case 'image/jpg':
                $image = imagecreatefrompng($src);
                break;
            default:
                $image = false;
                break;
        }

        if (!$image) {
            return false;
        }

        $width = imagesx($image);
        $height = imagesy($image);

        if ($targetHeight == null) {

            $ratio = $width / $height;

            if ($width > $height) {
                $targetHeight = floor($targetWidth / $ratio);
            } else {
                $targetHeight = $targetWidth;
                $targetWidth = floor($targetWidth * $ratio);
            }
        }

        $thumbnail = imagecreatetruecolor($targetWidth, $targetHeight);

        if ($type == IMAGETYPE_GIF || $type == IMAGETYPE_PNG) {

            imagecolortransparent(
                $thumbnail,
                imagecolorallocate($thumbnail, 0, 0, 0)
            );

            if ($type == IMAGETYPE_PNG) {
                imagealphablending($thumbnail, false);
                imagesavealpha($thumbnail, true);
            }
        }

        imagecopyresampled(
            $thumbnail,
            $image,
            0,
            0,
            0,
            0,
            $targetWidth,
            $targetHeight,
            $width,
            $height
        );

        if ($ext == "png" || $ext = "jpeg") {
            return call_user_func(
                'imagejpeg',
                $thumbnail,
                $dest,
                100
            );
        } else if ($ext == "jpg") {
            return call_user_func(
                'imagepng',
                $thumbnail,
                $dest,
                9
            );
        }
    }
}