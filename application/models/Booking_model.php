<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

    // Get all bookings with the necessary details
    public function get_all_bookings()
    {
        $this->db->select('booking_pc.*, PC.nomor_pc, Makanan.nama_makanan as makanan');
        $this->db->from('booking_pc');
        $this->db->join('PC', 'booking_pc.id_pc = PC.id_pc');
        $this->db->join('Makanan', 'booking_pc.jajanan = Makanan.id_makanan', 'left');
        return $this->db->get()->result_array(); // Ensure it returns an array of bookings
    }

    // Get booking by ID
    public function get_booking_by_id($id)
    {
        return $this->db->get_where('booking_pc', ['id_booking' => $id])->row_array(); // Ensure row is returned for a single booking
    }

    // Insert a new booking
    public function insert_booking($data)
    {
        return $this->db->insert('booking_pc', $data);
    }

    // Update an existing booking
    public function update_booking($id, $data)
    {
        $this->db->where('id_booking', $id);
        return $this->db->update('booking_pc', $data);
    }

    // Delete a booking
    public function delete_booking($id)
    {
        return $this->db->delete('booking_pc', ['id_booking' => $id]);
    }

    // Check if PC is available for booking
    public function is_pc_available($pc_id, $tanggal_booking, $exclude_booking_id = null)
    {
        $this->db->from('booking_pc');
        $this->db->where('id_pc', $pc_id);
        $this->db->where('tanggal_booking', $tanggal_booking);

        if ($exclude_booking_id) {
            $this->db->where('id_booking !=', $exclude_booking_id);
        }

        $query = $this->db->get();
        return $query->num_rows() === 0; // Return true if PC is available
    }
}
