<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Makanan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Makanan_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('upload'); // Load library upload jika diperlukan
    }

    // Menampilkan daftar makanan
    public function index() {
        $data['makanan'] = $this->Makanan_model->get_all_makanan();
        $this->load->view('admin/makanan/index', $data);
    }

    // Menampilkan form tambah makanan
    public function create() {
        $this->load->view('admin/makanan/create');
    }

    // Menyimpan data makanan
    public function store() {
        // Validasi input form
        $this->form_validation->set_rules('nama_makanan', 'Nama Makanan', 'required');
        $this->form_validation->set_rules('harga_makanan', 'Harga Makanan', 'required|numeric');
        $this->form_validation->set_rules('harga_beli', 'Harga Beli', 'required|numeric');
        $this->form_validation->set_rules('stok_makanan', 'Stok Makanan', 'required|numeric');
    
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan form create kembali
            $this->load->view('admin/makanan/create');
        } else {
            // Jika validasi sukses, proses simpan data makanan
            $foto_makanan = $this->upload_foto(); // Ambil nama foto yang di-upload
    
            $data = array(
                'nama_makanan' => $this->input->post('nama_makanan'),
                'harga_makanan' => $this->input->post('harga_makanan'),
                'harga_beli' => $this->input->post('harga_beli'),
                'stok_makanan' => $this->input->post('stok_makanan'),
                'foto_makanan' => $foto_makanan, // Simpan nama foto yang di-upload
                'margin_makanan' => $this->input->post('harga_makanan') - $this->input->post('harga_beli')  // Margin dihitung dari selisih harga jual dan harga beli
            );
    
            // Simpan data ke database
            $this->Makanan_model->add_makanan($data);
            $this->session->set_flashdata('message', 'Data makanan berhasil ditambahkan!');
            redirect('admin/makanan');
        }
    }
    

    // Fungsi untuk meng-upload foto makanan
    private function upload_foto() {
        // Konfigurasi upload
        $config['upload_path'] = './uploads/'; // Pastikan path yang benar
        $config['allowed_types'] = 'jpg|jpeg|png|gif'; // Jenis file yang diizinkan
        $config['max_size'] = 2048; // Maksimal 2MB
        $config['file_name'] = uniqid('makanan_'); // Nama file unik
    
        // Load library upload dan set konfigurasi
        $this->load->library('upload', $config);
    
        // Proses upload
        if ($this->upload->do_upload('foto_makanan')) {
            // Jika upload berhasil, ambil data file yang di-upload
            $data = $this->upload->data();
            return $data['file_name']; // Kembalikan nama file yang di-upload
        } else {
            // Jika gagal upload, tampilkan error
            echo $this->upload->display_errors(); // Tampilkan error jika upload gagal
            return null; // Tidak ada file yang di-upload
        }
    }
    
    
}
