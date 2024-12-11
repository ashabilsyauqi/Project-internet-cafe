<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Makanan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Makanan_model');
        $this->load->helper('form');
        $this->load->library('upload');
        $this->load->library('form_validation');
    }
    
    public function index()
    {
        $data['makanan'] = $this->Makanan_model->getAllMakanan();
        $this->load->view('admin/makanan/index', $data);
    }

    public function create()
    {
        $this->load->view('admin/makanan/create');
    }

    public function store()
    {
        // Set validation rules
        $this->form_validation->set_rules('nama_makanan', 'Nama Makanan', 'required');
        $this->form_validation->set_rules('harga_beli', 'Harga Beli', 'required|numeric');
        $this->form_validation->set_rules('harga_makanan', 'Harga Makanan', 'required|numeric');
        $this->form_validation->set_rules('stok_makanan', 'Stok Makanan', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/makanan/create');
        } else {
            // Set upload configuration
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048; 
            $config['file_name'] = uniqid();
        
            $this->upload->initialize($config);
        
            if (!$this->upload->do_upload('foto_makanan')) {
                $data['error'] = $this->upload->display_errors();
                $this->load->view('admin/makanan/create', $data);
            } else {
                $upload_data = $this->upload->data();
        
                // Calculate margin_makanan (harga_makanan - harga_beli)
                $margin_makanan = $this->input->post('harga_makanan') - $this->input->post('harga_beli');
        
                // Prepare data for insertion
                $data = array(
                    'nama_makanan' => $this->input->post('nama_makanan'),
                    'harga_beli' => $this->input->post('harga_beli'),
                    'harga_makanan' => $this->input->post('harga_makanan'),
                    'stok_makanan' => $this->input->post('stok_makanan'),
                    'foto_makanan' => $upload_data['file_name'],
                    'margin_makanan' => $margin_makanan // Store margin_makanan
                );
        
                // Insert data into database
                $this->Makanan_model->insert_makanan($data);
        
                redirect('admin/makanan');
            }
        }
    }
    

    public function edit($id)
    {
        $data['makanan'] = $this->Makanan_model->get_makanan_by_id($id);
        $this->load->view('admin/makanan/edit', $data);
    }

    public function update($id)
    {
        // Set up file upload config
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048;
        $this->upload->initialize($config);
    
        // Check if a new file is uploaded, otherwise use the old photo
        if (!empty($_FILES['foto_makanan']['name']) && !$this->upload->do_upload('foto_makanan')) {
            $data['error'] = $this->upload->display_errors();
            $this->load->view('admin/makanan/edit', $data);
            return;
        }
    
        $foto = $this->input->post('old_foto');
        if ($this->upload->do_upload('foto_makanan')) {
            $upload_data = $this->upload->data();
            $foto = $upload_data['file_name'];
        }
    
        // Calculate margin_makanan (harga_makanan - harga_beli)
        $margin_makanan = $this->input->post('harga_makanan') - $this->input->post('harga_beli');
    
        // Get data from form
        $data = array(
            'nama_makanan' => $this->input->post('nama_makanan'),
            'harga_beli'   => $this->input->post('harga_beli'),
            'harga_makanan'=> $this->input->post('harga_makanan'),
            'stok_makanan' => $this->input->post('stok_makanan'),
            'foto_makanan' => $foto,
            'margin_makanan' => $margin_makanan // Update margin_makanan
        );
    
        $this->Makanan_model->update_makanan($id, $data);
        redirect('admin/makanan');
    }
    

    public function delete($id)
    {
        $makanan = $this->Makanan_model->get_makanan_by_id($id);
        $foto = './uploads/' . $makanan->foto_makanan;

        if (is_readable($foto) && unlink($foto)) {
            $this->Makanan_model->delete_makanan($id);
            redirect('admin/makanan');
        } else {
            echo "Gagal Menghapus Foto!";
        }
    }
}
