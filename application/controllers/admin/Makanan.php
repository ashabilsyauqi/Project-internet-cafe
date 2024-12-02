<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Makanan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Makanan_model');
        $this->load->helper('form'); // Load the form helper here
        $this->load->library('upload'); // Load the upload library here
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
        // Set up file upload config
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'png|jpg|gif';
        $config['max_size']             = 2048;

        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload('foto_makanan')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('admin/makanan/create', $error);
        } else {
            // Get file upload data
            $upload_data = $this->upload->data();
            $foto = $upload_data['file_name'];

            // Get data from form
            $data = array(
                'nama_makanan' => $this->input->post('nama_makanan'),
                'harga_beli'   => $this->input->post('harga_beli'),
                'harga_makanan'=> $this->input->post('harga_makanan'),
                'stok_makanan' => $this->input->post('stok_makanan'),
                'foto_makanan' => $foto,
                'margin_makanan' => $this->calculate_margin(
                    $this->input->post('harga_beli'),
                    $this->input->post('harga_makanan')
                ),
            );

            // Insert into database using Makanan_model
            $insert = $this->Makanan_model->insert_makanan($data);
            if ($insert) {
                redirect('admin/makanan');
            } else {
                echo "Gagal Menyimpan Data!";
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
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'png|jpg|gif';
        $config['max_size']             = 2048;

        $this->upload->initialize($config);

        // Check if a new file is uploaded, otherwise use the old photo
        if ( ! $this->upload->do_upload('foto_makanan')) {
            // If no new file is uploaded, keep the old photo
            $foto = $this->input->post('old_foto');
        } else {
            // If a new file is uploaded, use the new one
            $upload_data = $this->upload->data();
            $foto = $upload_data['file_name'];
        }

        // Get data from form and calculate margin
        $data = array(
            'nama_makanan' => $this->input->post('nama_makanan'),
            'harga_beli'   => $this->input->post('harga_beli'),
            'harga_makanan'=> $this->input->post('harga_makanan'),
            'stok_makanan' => $this->input->post('stok_makanan'),
            'foto_makanan' => $foto,
            'margin_makanan' => $this->calculate_margin(
                $this->input->post('harga_beli'),
                $this->input->post('harga_makanan')
            ),
        );

        // Update data in database using Makanan_model
        $update = $this->Makanan_model->update_makanan($id, $data);
        if ($update) {
            redirect('admin/makanan');
        } else {
            echo "Gagal Mengupdate Data!";
        }
    }

    public function delete($id)
    {
        $makanan = $this->Makanan_model->get_makanan_by_id($id);
        $foto = './uploads/' . $makanan->foto_makanan;

        // Delete the image file
        if (is_readable($foto) && unlink($foto)) {
            $delete = $this->Makanan_model->delete_makanan($id);
            redirect('admin/makanan');
        } else {
            echo "Gagal Menghapus Foto!";
        }
    }

    private function calculate_margin($harga_beli, $harga_jual)
    {
        // Calculate margin based on harga_beli and harga_jual
        return ($harga_jual - $harga_beli);
    }
}
