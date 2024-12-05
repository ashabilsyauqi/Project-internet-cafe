<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Booking_model');
        $this->load->model('Pc_model');
        $this->load->model('Makanan_model');
    }

    public function index()
    {
        $data['bookings'] = $this->Booking_model->get_all_bookings();
        $this->load->view('admin/booking/index', $data);
    }

    public function create()
    {
        $data['pcs'] = $this->Pc_model->getAvailablePc();
        $data['makanan'] = $this->Makanan_model->getAllMakananWithStock();
        $this->load->view('admin/booking/create', $data);
    }

    public function store()
    {
        // Set zona waktu Indonesia (Jakarta)
        date_default_timezone_set('Asia/Jakarta');
    
        // Ambil data dari form input
        $input = $this->input->post();
    
        // Validasi input dasar
        if (empty($input['lama_menyewa']) || empty($input['pc_id']) || empty($input['nama_penyewa'])) {
            $this->session->set_flashdata('error', 'Harap isi semua data yang diperlukan.');
            redirect('admin/booking/create');
            return;
        }
    
        // Ambil data PC dan makanan
        $pc = $this->Pc_model->getPcById($input['pc_id']);
        if (!$pc) {
            $this->session->set_flashdata('error', 'PC tidak ditemukan.');
            redirect('admin/booking/create');
            return;
        }
    
        $makanan = $this->Makanan_model->get_food_by_id($input['jajanan'] ?? null);
        if ($input['jajanan'] && !$makanan) {
            $this->session->set_flashdata('error', 'Makanan tidak ditemukan.');
            redirect('admin/booking/create');
            return;
        }
    
        // Harga dan perhitungan total
        $harga_pc = 3000; // Harga sewa per jam
        $harga_jajanan = $makanan['harga_makanan'] ?? 0;
        $lama_menyewa = (int)$input['lama_menyewa']; // Pastikan integer
        $harga_total = ($harga_pc * $lama_menyewa) + $harga_jajanan;
    
        // Hitung waktu selesai (end_time) dengan timezone yang sudah diset
        $lama_menyewa_dalam_detik = $lama_menyewa * 3600; // Konversi jam ke detik
        $end_time = date('Y-m-d H:i:s', time() + $lama_menyewa_dalam_detik);
    
        // Siapkan data untuk dimasukkan ke tabel booking
        $data = [
            'nama_penyewa'   => $input['nama_penyewa'],
            'lama_menyewa'   => $lama_menyewa,
            'id_pc'          => $input['pc_id'],
            'harga_sewa'     => $harga_pc * $lama_menyewa,
            'harga_makanan'  => $harga_jajanan,
            'jajanan'        => $input['jajanan'] ?? null,
            'harga_total'    => $harga_total,
            'end_time'       => $end_time,
            'created_at'     => date('Y-m-d H:i:s'), // Waktu saat data dibuat sesuai dengan zona waktu
            'updated_at'     => date('Y-m-d H:i:s')  // Waktu saat data di-update sesuai dengan zona waktu
        ];
    
        // Simpan data booking dan update status PC
        if ($this->Booking_model->insert_booking($data)) {
            $this->Pc_model->update_pc_status($input['pc_id'], 'in use');
    
            // Kurangi stok makanan jika ada
            if (!empty($input['jajanan'])) {
                $this->Makanan_model->reduce_stock($input['jajanan'], 1);
            }
    
            // Berikan feedback sukses
            $this->session->set_flashdata('success', 'Booking berhasil dibuat.');
        } else {
            // Berikan feedback error
            $this->session->set_flashdata('error', 'Gagal membuat booking.');
        }
    
        // Redirect kembali ke halaman booking
        redirect('admin/booking');
    }
    


    public function edit($id)
    {
        $data['booking'] = $this->Booking_model->get_booking_by_id($id);
        if (!$data['booking']) {
            $this->session->set_flashdata('error', 'Booking not found.');
            redirect('admin/booking');
        }
        $data['pcs'] = $this->Pc_model->getAllPc();
        $data['makanan'] = $this->Makanan_model->getAllMakananWithStock();
        $this->load->view('admin/booking/edit', $data);
    }

    public function update($id)
    {
        $input = $this->input->post();
        $pc = $this->Pc_model->getPcById($input['pc_id']);
        $makanan = $this->Makanan_model->get_food_by_id($input['jajanan']);

        $harga_pc = 3000;
        $harga_jajanan = $makanan['harga_makanan'] ?? 0;
        $harga_total = ($harga_pc * $input['lama_menyewa']) + $harga_jajanan;

        // Hitung `end_time` sebagai waktu mulai + lama menyewa (jam)
        $lama_menyewa_dalam_detik = $input['lama_menyewa'] * 3600;
        $end_time = date('Y-m-d H:i:s', time() + $lama_menyewa_dalam_detik);

        $data = [
            'nama_penyewa' => $input['nama_penyewa'],
            'lama_menyewa' => $input['lama_menyewa'],
            'id_pc' => $input['pc_id'],
            'harga_sewa' => $harga_pc * $input['lama_menyewa'],
            'harga_makanan' => $harga_jajanan,
            'jajanan' => $input['jajanan'],
            'harga_total' => $harga_total,
            'end_time' => $end_time
        ];

        if ($this->Booking_model->update_booking($id, $data)) {
            $this->Pc_model->update_pc_status($input['pc_id'], 'in use');
            $this->Makanan_model->reduce_stock($input['jajanan'], 1);
            $this->session->set_flashdata('success', 'Booking successfully updated.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update booking.');
        }

        redirect('admin/booking');
    }

    public function delete($id)
    {
        $booking = $this->Booking_model->get_booking_by_id($id);
        if ($this->Booking_model->delete_booking($id)) {
            $this->Pc_model->update_pc_status($booking['id_pc'], 'Available');
            $this->session->set_flashdata('success', 'Booking successfully deleted.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete booking.');
        }

        redirect('admin/booking');
    }

    public function update_pc_status()
    {
        $this->db->where('end_time <', date('Y-m-d H:i:s'));
        $bookings = $this->db->get('booking_pc')->result_array();

        foreach ($bookings as $booking) {
            $this->Pc_model->update_pc_status($booking['id_pc'], 'Available');
            $this->Booking_model->delete_booking($booking['id']);
        }
    }
}
