<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// application/models/Booking_model.php
class Booking_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    public function is_pc_available($pc_id)
    {
        // Cek apakah status_pc untuk PC tertentu adalah 'active'
        $this->db->where('id_pc', $pc_id);
        $this->db->where('status_pc', 'active'); // Sesuaikan dengan nama kolom di tabel
        $query = $this->db->get('pc');
    
        return $query->num_rows() === 0; // Jika tidak ada hasil, PC tersedia
    }
    


    public function update_pc_status($pc_id)
    {
        $data = [
            'status_pc' => 'active', // Sesuaikan dengan nama kolom di tabel
        ];

        $this->db->where('id_pc', $pc_id);
        return $this->db->update('pc', $data); // Update status_pc di tabel pc
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
