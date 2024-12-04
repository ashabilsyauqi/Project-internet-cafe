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
   
       // Load the view dengan data available_pcs dan bookings
       $this->load->view('admin/booking/index', $data);
   }
   
   

   public function create()
   {
       // Ambil daftar PC yang statusnya 'Available'
       $data['pcs'] = $this->Pc_model->getAvailablePc();
   
       // Debugging
       log_message('debug', 'Daftar PC yang tersedia: ' . print_r($data['pcs'], true));
   
       // Ambil semua makanan
       $data['makanan'] = $this->Makanan_model->getAllMakanan();
   
       // Load the view dengan data pcs dan makanan
       $this->load->view('admin/booking/create', $data);
   }

    // Store new booking
    // Store new booking
public function store()
{
    $input = $this->input->post();
    $pc = $this->Pc_model->getPcById($input['pc_id']);
    $makanan = $this->Makanan_model->get_food_by_id($input['jajanan']);

    $harga_pc = 3000;
    $harga_jajanan = $makanan['harga_makanan'] ?? 0;
    $harga_total = ($harga_pc * $input['lama_menyewa']) + $harga_jajanan;

    // Prepare booking data
    $data = [
        'nama_penyewa' => $input['nama_penyewa'],
        'lama_menyewa' => $input['lama_menyewa'],
        'id_pc' => $input['pc_id'],
        'tanggal_booking' => $input['tanggal_booking'],
        'harga_sewa' => $harga_pc * $input['lama_menyewa'],
        'harga_makanan' => $harga_jajanan,
        'jajanan' => $input['jajanan'],
        'harga_total' => $harga_total
    ];

    // Insert booking and update PC status
    if ($this->Booking_model->insert_booking($data)) {
        // Update the PC status to 'in use'
        $this->Pc_model->update_pc_status($input['pc_id'], 'in use');

        $this->session->set_flashdata('success', 'Booking successfully created.');
    } else {
        $this->session->set_flashdata('error', 'Failed to create booking.');
    }

    redirect('admin/booking');
}


    // Form to edit a booking
    public function edit($id)
    {
        $data['booking'] = $this->Booking_model->get_booking_by_id($id);
        if (!$data['booking']) {
            $this->session->set_flashdata('error', 'Booking not found.');
            redirect('admin/booking');
        }
        $data['pcs'] = $this->Pc_model->getAllPc();
        $data['makanan'] = $this->Makanan_model->getAllMakanan();
        $this->load->view('admin/booking/edit', $data);
    }

    // Update booking
   // Update booking
public function update($id)
{
    $input = $this->input->post();
    $pc = $this->Pc_model->getPcById($input['pc_id']);
    $makanan = $this->Makanan_model->get_food_by_id($input['jajanan']);

    $harga_pc = 3000;
    $harga_jajanan = $makanan['harga_makanan'] ?? 0;
    $harga_total = ($harga_pc * $input['lama_menyewa']) + $harga_jajanan;

    // Check if the PC is available for the booking date
    if (!$this->Booking_model->is_pc_available($input['pc_id'], $input['tanggal_booking'], $id)) {
        $this->session->set_flashdata('error', 'PC is already booked on this date.');
        redirect('admin/booking/edit/' . $id);
    }

    // Prepare updated booking data
    $data = [
        'nama_penyewa' => $input['nama_penyewa'],
        'lama_menyewa' => $input['lama_menyewa'],
        'id_pc' => $input['pc_id'],
        'tanggal_booking' => $input['tanggal_booking'],
        'harga_sewa' => $harga_pc * $input['lama_menyewa'],
        'harga_makanan' => $harga_jajanan,
        'jajanan' => $input['jajanan'],
        'harga_total' => $harga_total
    ];

    // Update booking and change PC status to 'in use'
    if ($this->Booking_model->update_booking($id, $data)) {
        // Update the PC status to 'in use'
        $this->Pc_model->update_pc_status($input['pc_id'], 'in use');

        $this->session->set_flashdata('success', 'Booking successfully updated.');
    } else {
        $this->session->set_flashdata('error', 'Failed to update booking.');
    }

    redirect('admin/booking');
}

    // Delete booking
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
