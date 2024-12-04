<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pc_model extends CI_Model
{


    public function update_pc_status($id_pc, $status)
    {
        $data = [
            'status_pc' => $status
        ];

        $this->db->where('id_pc', $id_pc);
        return $this->db->update('PC', $data); // Update status PC di tabel pc
    }


    public function getAvailablePc()
    {
        $this->db->where('status_pc', 'Available');
        $query = $this->db->get('PC');
        
        // Debugging
        if ($query->num_rows() > 0) {
            return $query->result_array(); // Mengembalikan hasil sebagai array
        } else {
            // Jika tidak ada PC yang available
            log_message('debug', 'Tidak ada PC yang tersedia.');
            return []; // Mengembalikan array kosong
        }
    }
    




    // Fetch all PCs
    public function getAllPc()
    {
        return $this->db->get('PC')->result_array();  // Using "PC" as table name
    }

    // Create new PC
    public function createPc($data)
    {
        return $this->db->insert('PC', $data);  // Using "PC" as table name
    }

    // Get single PC by ID
    public function getPcById($id_pc)
    {
        return $this->db->get_where('PC', ['id_pc' => $id_pc])->row_array();  // Using "PC" as table name
    }

    // Update PC data
    public function updatePc($id_pc, $data)
    {
        $this->db->where('id_pc', $id_pc);
        return $this->db->update('PC', $data);  // Using "PC" as table name
    }

    // Delete PC
    public function deletePc($id_pc)
    {
        $this->db->where('id_pc', $id_pc);
        return $this->db->delete('PC');  // Using "PC" as table name
    }
}
