<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// application/models/Booking_model.php
class Booking_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    // Fungsi untuk mendapatkan semua booking
    public function get_all_bookings()
    {
        return $this->db->get('booking_pc')->result();
    }

    // Fungsi untuk mendapatkan booking berdasarkan id
    public function get_booking_by_id($id)
    {
        return $this->db->get_where('booking_pc', ['id' => $id])->row();
    }

    // Fungsi untuk insert data booking baru
    public function create_booking($data)
    {
        return $this->db->insert('booking_pc', $data);
    }

    // Fungsi untuk update data booking
    public function update_booking($id, $data)
    {
        return $this->db->update('booking_pc', $data, ['id' => $id]);
    }

    // Fungsi untuk delete booking
    public function delete_booking($id)
    {
        return $this->db->delete('booking_pc', ['id' => $id]);
    }

    // Fungsi untuk menghitung harga
    public function hitung_harga($lama_menyewa)
    {
        return $lama_menyewa * 3000; // Harga per jam
    }
}
