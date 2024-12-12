<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

    public function get_all_pcs()
{
    $this->db->select('id_pc, nomor_pc'); // Mengambil id dan nomor pc
    $this->db->from('PC'); // Tabel PC
    return $this->db->get()->result_array();
}




    // Get all bookings with the necessary details
    public function get_all_bookings()
    {
        $this->db->select('booking_pc.*, PC.nomor_pc, Makanan.nama_makanan as makanan');
        $this->db->from('booking_pc');
        $this->db->join('PC', 'booking_pc.id_pc = PC.id_pc');
        $this->db->join('Makanan', 'booking_pc.jajanan = Makanan.id_makanan', 'left');
        return $this->db->get()->result_array(); // Ensure it returns an array of bookings
    }

    // public function get_booking_by_id($id_booking)
    // {
    //     $this->db->where('id_booking', $id_booking);
    //     $query = $this->db->get('booking_pc');
        
    //     return $query->row_array();
    // }
    

    public function get_booking_by_id($id_booking)
{
    // Change 'id_booking' to 'id' to match the actual column name
    $this->db->where('id', $id_booking);
    $query = $this->db->get('booking_pc');
    
    return $query->row_array();
}


    // Insert a new booking
    public function insert_booking($data)
    {
        log_message('info', 'Data yang akan di-insert: ' . print_r($data, true));
    
        $insert = $this->db->insert('booking_pc', $data);
    
        if (!$insert) {
            log_message('error', 'Insert Error: ' . $this->db->last_query());
            log_message('error', 'DB Error: ' . $this->db->error()['message']);
        }
    
        return $insert;
    }
    
    

    // Update an existing booking
    public function update_booking($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('booking_pc', $data);
    }

    // Delete a booking
    public function delete_booking($id)
    {
        return $this->db->delete('booking_pc', ['id' => $id]);
    }

    // Check if PC is available for booking
    public function is_pc_available($pc_id, $tanggal_booking, $exclude_booking_id = null)
    {
        $this->db->from('booking_pc');
        $this->db->where('id_pc', $pc_id);
        $this->db->where('tanggal_booking', $tanggal_booking);

        if ($exclude_booking_id) {
            $this->db->where('id !=', $exclude_booking_id);
        }

        $query = $this->db->get();
        return $query->num_rows() === 0; // Return true if PC is available
    }
}
