<?php
date_default_timezone_set('Asia/Jakarta');

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
        // Mengambil semua PC termasuk yang statusnya in use
        $pcs = $this->Pc_model->getAllPc(); // Ini akan mengambil semua data PC dengan status apa pun
    
        // Mengambil data makanan dari model
        $makanan = $this->Makanan_model->getAllMakanan();
        
        // Filter makanan dengan stok < 1
        $makanan_filtered = array_filter($makanan, function($item) {
            return $item->stok_makanan > 1;  // Pastikan stok makanan cukup
        });
        
        // Kirim data ke view
        $data['pcs'] = $pcs;
        $data['makanan'] = $makanan_filtered; // Mengirimkan data yang sudah difilter
        
        $this->load->view('admin/booking/create', $data);
    }
    public function store_step1()
{
    $input = $this->input->post();
    $pc = $this->Pc_model->getPcById($input['pc_id']);
    $makanan = $this->Makanan_model->get_food_by_id($input['jajanan']);

    $harga_pc = 3000;
    $harga_jajanan = $makanan['harga_makanan'] ?? 0;
    $harga_total = ($harga_pc * $input['lama_menyewa']) + $harga_jajanan;

    // Ambil waktu saat ini untuk 'created_at'
    $created_at = date('Y-m-d H:i:s');

    // Hitung end_time dengan menambahkan lama_menyewa dalam jam
    $end_time = date('Y-m-d H:i:s', strtotime("+{$input['lama_menyewa']} hours", strtotime($created_at)));

    // Simpan data sementara di session
    $booking_data = [
        'nama_penyewa' => $input['nama_penyewa'],
        'lama_menyewa' => $input['lama_menyewa'],
        'id_pc' => $input['pc_id'],
        'harga_sewa' => $harga_pc * $input['lama_menyewa'],
        'harga_makanan' => $harga_jajanan,
        'jajanan' => $input['jajanan'],
        'harga_total' => $harga_total,
        'status' => 'pending',
        'created_at' => $created_at,
        'end_time' => $end_time,
        'nama_makanan' => $makanan['nama_makanan'] ?? 'Tidak ada' // Menambahkan nama makanan
    ];

    $this->session->set_userdata('booking_data', $booking_data);

    // Redirect ke form pembayaran (Step 2)
    redirect('booking/bayar');
}

    // Step 2: Form upload bukti pembayaran
    public function create_step2()
    {
        $data['booking_data'] = $this->session->userdata('booking_data');
        if (empty($data['booking_data'])) {
            redirect('booking/create_step1'); // Jika belum ada data dari Step 1
        }

        $this->load->view('admin/booking/bayar', $data);
    }
    public function store_step2()
    {
        // Proses upload bukti pembayaran
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size'] = 2048; // Maksimal 2MB
    
        $this->load->library('upload', $config);
    
        if ($this->upload->do_upload('bukti_pembayaran')) {
            $upload_data = $this->upload->data();
            $bukti_pembayaran = $upload_data['file_name'];
    
            // Simpan data booking ke database
            $booking_data = $this->session->userdata('booking_data');
            $booking_data['bukti_pembayaran'] = $bukti_pembayaran;
    
            // Panggil model untuk menyimpan data
            $booking_id = $this->Booking_model->insert_booking($booking_data); // Pastikan insert_booking mengembalikan ID
    
            // Hapus data booking dari session
            $this->session->unset_userdata('booking_data');
    
            // Redirect ke halaman receipt dengan ID booking
            redirect('admin/booking/receipt/' . $booking_id);
        } else {
            // Jika gagal upload, tampilkan error
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('admin/booking/bayar');
        }
    }
    
    
    
    
    public function receipt($id_booking)
{
    // Fetch the booking data using the provided ID
    $booking_data = $this->Booking_model->get_booking_by_id($id_booking);

    if (empty($booking_data)) {
        $this->session->set_flashdata('error', 'Booking not found.');
        redirect('admin/booking');  // Redirect if no booking data found
    }

    // Pass data to the view
    $data['booking_data'] = $booking_data; // Ganti 'booking' dengan 'booking_data'
    $data['title'] = 'Booking Receipt';
    
    // Load the receipt view
    $this->load->view('admin/booking/receipt', $data);
}

    
    public function update($id)
    {
        $input = $this->input->post();
        $pc = $this->Pc_model->getPcById($input['pc_id']);
        $makanan = $this->Makanan_model->get_food_by_id($input['jajanan']);

        $harga_pc = 3000;
        $harga_jajanan = $makanan['harga_makanan'] ?? 0;
        $harga_total = ($harga_pc * $input['lama_menyewa']) + $harga_jajanan;

        // Check if the PC is available for the booking date
        if (!$this->Booking_model->is_pc_available($input['pc_id'], $input['lama_menyewa'], $id)) {
            $this->session->set_flashdata('error', 'PC is already booked for this duration.');
            redirect('admin/booking/edit/' . $id);
        }

        // Prepare updated booking data
        $data = [
            'nama_penyewa' => $input['nama_penyewa'],
            'lama_menyewa' => $input['lama_menyewa'],
            'id_pc' => $input['pc_id'],
            'harga_sewa' => $harga_pc * $input['lama_menyewa'],
            'harga_makanan' => $harga_jajanan,
            'jajanan' => $input['jajanan'],
            'harga_total' => $harga_total
        ];

        // Update booking and change PC status to 'in use'
        if ($this->Booking_model->update_booking($id, $data)) {
            // Update the PC status to 'in use'
            $this->Pc_model->update_pc_status($input['pc_id'], 'in use');

            // Reduce stock of the selected food
            $this->Makanan_model->reduce_stock($input['jajanan'], 1); // Mengurangi stock sebanyak 1

            $this->session->set_flashdata('success', 'Booking successfully updated.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update booking.');
        }

        redirect('admin/booking');
    }

    public function delete($id)
    {
        if ($this->Booking_model->delete_booking($id)) {
            $this->session->set_flashdata('success', 'Booking successfully deleted.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete booking.');
        }

        redirect('admin/booking');
    }
}
