<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pc_model extends CI_Model
{
    // Fetch all PCs
    public function getAllPc()
    {
        return $this->db->get('pc')->result_array();
    }

    // Create new PC
    public function createPc($data)
    {
        return $this->db->insert('pc', $data);
    }

    // Get single PC by ID
    public function getPcById($id_pc)
    {
        return $this->db->get_where('pc', ['id_pc' => $id_pc])->row_array();
    }

    // Update PC data
    public function updatePc($id_pc, $data)
    {
        $this->db->where('id_pc', $id_pc);
        return $this->db->update('pc', $data);
    }

    // Delete PC
    public function deletePc($id_pc)
    {
        $this->db->where('id_pc', $id_pc);
        return $this->db->delete('pc');
    }
}
