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

        // Simpan data sementara di session
        $booking_data = [
            'nama_penyewa' => $input['nama_penyewa'],
            'lama_menyewa' => $input['lama_menyewa'],
            'id_pc' => $input['pc_id'],
            'harga_sewa' => $harga_pc * $input['lama_menyewa'],
            'harga_makanan' => $harga_jajanan,
            'jajanan' => $input['jajanan'],
            'harga_total' => $harga_total,
            'status' => 'pending'
        ];

        $this->session->set_userdata('booking_data', $booking_data);

        // Redirect ke form pembayaran (Step 2)
        redirect('admin/booking/bayar');
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
        // Mengambil data booking dari session
        $booking_data = $this->session->userdata('booking_data');
        
        // Cek apakah data booking ada di session
        if (empty($booking_data)) {
            redirect('admin/booking/create');  // Redirect jika tidak ada data
        }
    
        // Konfigurasi upload bukti pembayaran
        $config['upload_path'] = './uploads/bukti_pembayaran/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size'] = 2048;  // Maksimal ukuran file 2MB
    
        // Load library upload
        $this->load->library('upload', $config);
    
        // Jika upload gagal
        if (!$this->upload->do_upload('bukti_pembayaran')) {
            $error = ['error' => $this->upload->display_errors()];
            $this->session->set_flashdata('error', $error['error']);
            redirect('admin/booking/bayar');  // Redirect ke halaman bayar jika upload gagal
        } else {
            // Jika upload berhasil, simpan nama file
            $upload_data = $this->upload->data();
            $bukti_pembayaran = $upload_data['file_name'];
        }
    
        // Menambahkan bukti pembayaran ke data booking
        $booking_data['bukti_pembayaran'] = $bukti_pembayaran;
    
        // Menyimpan data booking ke database
        if ($this->Booking_model->insert_booking($booking_data)) {
            // Update status PC dan kurangi stock makanan
            $this->Pc_model->update_pc_status($booking_data['id_pc'], 'in use');
            $this->Makanan_model->reduce_stock($booking_data['jajanan'], 1);
    
            // Menghapus session booking data setelah berhasil
            $this->session->unset_userdata('booking_data');
            $this->session->set_flashdata('success', 'Booking successfully created.');
        } else {
            // Menampilkan pesan error jika gagal menyimpan data
            $this->session->set_flashdata('error', 'Failed to create booking.');
        }
    
        // Redirect ke halaman booking setelah selesai
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

        // Check if the PC is available for the booking date
        if (!$this->Booking_model->is_pc_available($input['pc_id'], $input['lama_menyewa'], $id)) {
            $this->session->set_flashdata('error', 'PC is already booked for this duration.');
            redirect(' admin/booking/edit/' . $id);
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
