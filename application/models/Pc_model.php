<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pc_model extends CI_Model
{
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
