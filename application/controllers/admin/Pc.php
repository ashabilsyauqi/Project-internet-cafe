<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pc extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pc_model');
    }
    
      // Method untuk mengambil data PC dengan status 'Available'
      public function get_available_pcs()
      {
          $this->db->where('status', 'Available');  // Memfilter data berdasarkan status 'Available'
          $query = $this->db->get('pc');  // Menjalankan query ke tabel pc
          return $query->result_array();  // Mengembalikan hasil sebagai array
      }

    // List all PCs
    public function index()
    {
        $data['pc'] = $this->Pc_model->getAllPc();
        $this->load->view('admin/pc/index', $data); // Update path view
    }

    // Create new PC
    public function create()
    {
        if ($this->input->post()) {
            $data = [
                'nomor_pc' => $this->input->post('nomor_pc'),
                'status_pc' => $this->input->post('status_pc') ?? 'Available', // Default value
            ];
            $this->Pc_model->createPc($data);
            redirect('admin/pc'); // Update redirect path
        }
        $this->load->view('admin/pc/create'); // Update path view
    }

    // Edit existing PC
    public function edit($id_pc)
    {
        $data['pc'] = $this->Pc_model->getPcById($id_pc);

        if ($this->input->post()) {
            $updateData = [
                'nomor_pc' => $this->input->post('nomor_pc'),
                'status_pc' => $this->input->post('status_pc'),
            ];
            $this->Pc_model->updatePc($id_pc, $updateData);
            redirect('admin/pc'); // Update redirect path
        }
        $this->load->view('admin/pc/edit', $data); // Update path view
    }

    // Delete PC
    public function delete($id_pc)
    {
        $this->Pc_model->deletePc($id_pc);
        redirect('admin/pc'); // Update redirect path
    }
}
