<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_model extends CI_Model {
    private $table = 'files';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function insert_file($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function get_files()
    {
        return $this->db->get($this->table)->result_object();
    }
    public function get_file_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->result_object();
    }
    public function update_download($id, $data)
    {
        $this->db->where(['id' => $id])->update($this->table, $data);
        return $this->db->affected_rows();
    }
}

/* End of file Upload_model.php */
