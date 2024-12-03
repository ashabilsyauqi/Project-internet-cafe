<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Booking_model');
        $this->load->model('Pc_model'); // To fetch PC data
        $this->load->model('Makanan_model'); // To fetch food data
    }

    // Show all bookings
    public function index() {
        // Fetch all bookings from the model
        $data['bookings'] = $this->Booking_model->get_all_bookings(); // This ensures you get all bookings

        // If there are no bookings, set an empty array
        if (empty($data['bookings'])) {
            $data['bookings'] = [];
        }

        // Load the view with data
        $this->load->view('admin/booking/index', $data);
    }
    

    // Form to create a new booking
    public function create()
    {
        $data['pcs'] = $this->Pc_model->getAllPc(); // Fetch all PC data
        $data['makanan'] = $this->Makanan_model->getAllMakanan(); // Fetch all food data
        $this->load->view('admin/booking/create', $data);
    }

    public function store()
    {
        // Get data from form
        $nama_penyewa = $this->input->post('nama_penyewa');
        $lama_menyewa = $this->input->post('lama_menyewa');
        $id_pc = $this->input->post('pc_id');  
        $tanggal_booking = $this->input->post('tanggal_booking');
        $jajanan = $this->input->post('jajanan');
    
        // Get PC price from database
        $pc = $this->db->get_where('PC', ['id_pc' => $id_pc])->row_array();


        // $harga_pc = $pc['harga'] ?? 0; // Default 0 if not found
        $harga_pc = 3000; // Default 0 if not found

    
        // Get snack price from database
        $makanan = $this->db->get_where('Makanan', ['id_makanan' => $jajanan])->row_array();
        $harga_jajanan = $makanan['harga_makanan'] ?? 0; // Default 0 if not found
    
        // Calculate total price
        $harga_total = ($harga_pc * $lama_menyewa) + $harga_jajanan;
    
        // Insert data into the array for saving
        $data = array(
            'nama_penyewa' => $nama_penyewa,
            'lama_menyewa' => $lama_menyewa,
            'id_pc' => $id_pc,
            'tanggal_booking' => $tanggal_booking,
            'jajanan' => $jajanan,
            'harga_total' => $harga_total // Add total price to the data array
        );
    
        // Insert data to database using model
        $insert = $this->Booking_model->insert_booking($data);
    
        if ($insert) {
            // Redirect to index page after success
            $this->session->set_flashdata('success', 'Data berhasil disimpan!');
            redirect('admin/booking');
        } else {
            // Display error message if failed
            echo "Data failed to save!";
        }
    }
    

    // Form to edit an existing booking
    public function edit($id)
    {
        $data['booking'] = $this->Booking_model->get_booking_by_id($id);
        $data['pcs'] = $this->Pc_model->getAllPc();
        $data['makanan'] = $this->Makanan_model->getAllMakanan();
        $this->load->view('admin/booking/edit', $data);
    }

    // Update an existing booking
    public function update($id)
    {
        $pc_id = $this->input->post('id_pc');
        $food_id = $this->input->post('jajanan');
        $lama_menyewa = $this->input->post('lama_menyewa');
        $tanggal_booking = $this->input->post('tanggal_booking');

        // Fetch selected PC price
        $pc_data = $this->Pc_model->getPcById($pc_id);
        if ($pc_data === null) {
            $this->session->set_flashdata('error', 'PC not found.');
            redirect('admin/booking/edit/' . $id);
        }
        $harga_sewa = $pc_data['harga_sewa'];

        // Fetch selected food price
        $food_data = $this->Makanan_model->get_food_by_id($food_id);
        if ($food_data === null) {
            $this->session->set_flashdata('error', 'Food item not found.');
            redirect('admin/booking/edit/' . $id);
        }
        $harga_makanan = $food_data['harga'];

        // Calculate total price
        $harga_total = ($harga_sewa * $lama_menyewa) + $harga_makanan;

        // Validate if the selected PC is available
        if (!$this->Booking_model->is_pc_available($pc_id, $tanggal_booking, $id)) {
            $this->session->set_flashdata('error', 'PC is already booked on this date.');
            redirect('admin/booking/edit/' . $id);
        }

        // Prepare booking data
        $booking_data = [
            'nama_penyewa' => $this->input->post('nama_penyewa'),
            'lama_menyewa' => $lama_menyewa,
            'id_pc' => $pc_id,
            'tanggal_booking' => $tanggal_booking,
            'harga_total' => $harga_total,
            'jajanan' => $food_id,
        ];

        // Update booking data in the database
        $this->Booking_model->update_booking($id, $booking_data);

        // Set success message and redirect
        $this->session->set_flashdata('success', 'Booking updated successfully.');
        redirect('admin/booking');
    }

    // Delete a booking
    public function delete($id)
    {
        $this->Booking_model->delete_booking($id);
        $this->session->set_flashdata('success', 'Booking deleted successfully.');
        redirect('admin/booking');
    }
}
