<?php
defined('BASEPATH') OR exit('No direct script access allowed');



// application/controllers/admin/Booking.php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Booking_model');
        $this->load->helper('url');
    }

    // Menampilkan semua booking
    public function index()
    {
        $data['bookings'] = $this->Booking_model->get_all_bookings();
        $this->load->view('admin/booking/index', $data);
    }

    // Form untuk menambah booking baru
    public function create()
    {
        $this->load->view('admin/booking/create');
    }

    // Menyimpan booking baru
    public function store()
    {
        $data = [
            'nama_penyewa' => $this->input->post('nama_penyewa'),
            'lama_menyewa' => $this->input->post('lama_menyewa'),
            'pc_id' => $this->input->post('pc_id'),
        ];

        $this->Booking_model->create_booking($data);
        redirect('admin/booking');
    }

    // Form untuk mengedit booking
    public function edit($id)
    {
        $data['booking'] = $this->Booking_model->get_booking_by_id($id);
        $this->load->view('admin/booking/edit', $data);
    }

    // Menyimpan perubahan booking
    public function update($id)
    {
        $data = [
            'nama_penyewa' => $this->input->post('nama_penyewa'),
            'lama_menyewa' => $this->input->post('lama_menyewa'),
            'pc_id' => $this->input->post('pc_id'),
        ];

        $this->Booking_model->update_booking($id, $data);
        redirect('admin/booking');
    }

    // Menghapus booking
    public function delete($id)
    {
        $this->Booking_model->delete_booking($id);
        redirect('admin/booking');
    }
}
