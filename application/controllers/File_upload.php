<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class File_upload extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['form', 'url', 'download']);
        $this->load->model('upload_model');
    }
    
    public function index()
    {
        $data['error'] = '';
        $data['files'] = $this->upload_model->get_files();
        $this->load->view('index', $data);
    }
    public function upload_file()
    {
        $config['upload_path']          = APPPATH.'../assets/uploads/';
        $config['allowed_types']        = 'gif|jpg|png|pdf|docx';
        $config['max_size']             = 1024;
        $config['file_name']            = date('Ymdhis').mt_rand(0, 9999);

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('index', $error);
        }
        else
        {
            $uploaded_data = $this->upload->data();
            $data = [
                'name' => $uploaded_data['file_name'],
                'size' => $uploaded_data['file_size']
            ];
            if ($this->upload_model->insert_file($data))
            {
                echo "file Uploaded successfully";
                redirect('file_upload/index');
            }
        }
    }
    public function download($id)
    {
        $data['file'] = $this->upload_model->get_file_by_id($id);
        $file_name = $data['file'][0]->name;
        $download_count = $data['file'][0]->downloads + 1;
        $count = ['downloads' => $download_count];
        $this->upload_model->update_download($id, $count);
        force_download(APPPATH.'../assets/uploads/'.$file_name, NULL);
    }
}

/* End of file File_upload.php */
