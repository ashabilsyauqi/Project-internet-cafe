<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pc_model extends CI_Model
{
    const STATUS_AVAILABLE = 'Available';
    const STATUS_IN_USE = 'In Use';
    const STATUS_UNDER_MAINTENANCE = 'Under Maintenance';

    public function update_pc_status()
{
    log_message('debug', 'Memperbarui status PC...');

    // Ambil semua booking yang sudah berakhir
    $this->db->where('end_time <', date('Y-m-d H:i:s'));
    $bookings = $this->db->get('booking_pc')->result_array();

    log_message('debug', 'Booking yang sudah berakhir: ' . print_r($bookings, true));

    foreach ($bookings as $booking) {
        // Update status PC menjadi 'Available'
        $this->Pc_model->update_pc_status($booking['id_pc'], 'Available');
        
        // Hapus booking yang sudah berakhir (opsional)
        $this->Booking_model->delete_booking($booking['id']);
    }
}

    public function getAvailablePc()
    {
        return $this->db->where('status_pc', self::STATUS_AVAILABLE)->get('PC')->result_array();
    }

    // Fetch all PCs
    public function getAllPc()
    {
        return $this->db->get('PC')->result_array();  // Mengambil semua PC
    }

    // Create new PC
    public function createPc($data)
    {
        return $this->db->insert('PC', $data);  // Menambahkan PC baru
    }

    // Get single PC by ID
    public function getPcById($id_pc)
    {
        return $this->db->get_where('PC', ['id_pc' => $id_pc])->row_array();  // Mengambil PC berdasarkan ID
    }

    // Update PC data
    public function updatePc($id_pc, $data)
    {
        $this->db->where('id_pc', $id_pc);
        return $this->db->update('PC', $data);  // Memperbarui data PC
    }

    // Update status untuk semua PC yang sudah tidak digunakan
    public function update_all_pc_status()
    {
        // Ambil semua booking yang sudah berakhir
        $this->db->where('end_time <', date('Y-m-d H:i:s'));
        $bookings = $this->db->get('booking_pc')->result_array();

        foreach ($bookings as $booking) {
            // Update status PC menjadi 'Available'
            $this->update_pc_status($booking['id_pc'], self::STATUS_AVAILABLE);
            
            // Hapus booking yang sudah berakhir (opsional)
            $this->Booking_model->delete_booking($booking['id']);
        }
    }
}