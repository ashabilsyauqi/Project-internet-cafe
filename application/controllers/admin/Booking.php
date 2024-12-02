<?php
defined('BASEPATH') OR exit('No direct script access allowed');



// application/controllers/admin/Booking.php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Memuat model Booking_model dan Pc_model
        $this->load->model('Booking_model');
        $this->load->model('Pc_model');  // Tambahkan ini
    }

    // Menampilkan semua booking
    public function index()
    {
        $data['bookings'] = $this->Booking_model->get_all_bookings();
        $this->load->view('admin/booking/index', $data);
    }



    public function create()
    {
        if ($this->input->post('id_pc')) {
            $pc_id = $this->input->post('id_pc');
            
            // Validasi apakah PC tersedia
            if (!$this->Booking_model->is_pc_available($pc_id)) {
                $this->session->set_flashdata('error', 'PC yang dipilih sudah ter-booking.');
                redirect('admin/booking/create');
            }
    
            // Menyimpan data booking ke tabel booking_pc
            $booking_data = [
                'nama_penyewa' => $this->input->post('nama_penyewa'),
                'lama_menyewa' => $this->input->post('lama_menyewa'),
                'id_pc' => $pc_id,
                'status' => 'active', // Status booking
            ];
    
            // Insert data booking ke tabel booking_pc
            $this->Booking_model->createBooking($booking_data);
    
            // Update status_pc menjadi 'active'
            $this->Booking_model->update_pc_status($pc_id);
    
            // Redirect setelah berhasil booking
            $this->session->set_flashdata('success', 'Booking berhasil dibuat!');
            redirect('admin/booking');
        }
    
        // Ambil daftar PC dari model Pc_model
        $data['pcs'] = $this->Pc_model->getAllPc();
    
        $this->load->view('admin/booking/create', $data);
    }
    
    

    
    public function edit($id)
    {
        $data['booking'] = $this->Booking_model->getBookingById($id);
        $data['pcs'] = $this->Pc_model->getAllPc();
        $data['harga_per_jam'] = 3000; // Harga per jam
        $this->load->view('admin/booking/edit', $data);
    }



    // Form untuk menambah booking baru
    // public function create()
    // {
    //     $this->load->view('admin/booking/create');
    // }

    // Menyimpan booking baru
    public function store()
    {
        $tanggal_booking = $this->input->post('tanggal_booking');
        $pc_id = $this->input->post('pc_id');
    
        // Cek apakah PC sudah terbooking pada tanggal tertentu
        if ($this->Booking_model->is_pc_available($pc_id, $tanggal_booking)) {
            $data = [
                'nama_penyewa' => $this->input->post('nama_penyewa'),
                'lama_menyewa' => $this->input->post('lama_menyewa'),
                'pc_id' => $pc_id,
                'tanggal_booking' => $tanggal_booking,
            ];
    
            $this->Booking_model->create_booking($data);
            redirect('admin/booking');
        } else {
            $this->session->set_flashdata('error', 'PC sudah terbooking pada tanggal ini.');
            redirect('admin/booking/create');
        }
    }
    
    public function update($id)
    {
        $tanggal_booking = $this->input->post('tanggal_booking');
        $pc_id = $this->input->post('pc_id');
    
        // Cek apakah PC sudah terbooking pada tanggal tertentu
        if ($this->Booking_model->is_pc_available($pc_id, $tanggal_booking)) {
            $data = [
                'nama_penyewa' => $this->input->post('nama_penyewa'),
                'lama_menyewa' => $this->input->post('lama_menyewa'),
                'pc_id' => $pc_id,
                'tanggal_booking' => $tanggal_booking,
            ];
    
            $this->Booking_model->update_booking($id, $data);
            redirect('admin/booking');
        } else {
            $this->session->set_flashdata('error', 'PC sudah terbooking pada tanggal ini.');
            redirect('admin/booking/edit/' . $id);
        }
    }
    // Menghapus booking
    public function delete($id)
    {
        $this->Booking_model->delete_booking($id);
        redirect('admin/booking');
    }
}
