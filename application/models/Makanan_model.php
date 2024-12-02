<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Makanan_model extends CI_Model {

    // Fetch all available foods
    public function getAllMakanan()
    {
        return $this->db->get('Makanan')->result_array();
    }

    // Get total price for selected foods
    public function getTotalHargaMakanan($ids)
    {
        $this->db->select_sum('harga_makanan', 'total_harga');
        $this->db->where_in('id_makanan', $ids);
        $result = $this->db->get('Makanan')->row_array();
        return $result['total_harga'];
    }

    public function get_makanan_by_id($id)
    {
        return $this->db->get_where('Makanan', ['id_makanan' => $id])->row();
    }

    public function insert_makanan($data)
    {
        return $this->db->insert('Makanan', $data);
    }

    public function update_makanan($id, $data)
    {
        return $this->db->update('Makanan', $data, ['id_makanan' => $id]);
    }

    public function delete_makanan($id)
    {
        return $this->db->delete('Makanan', ['id_makanan' => $id]);
    }
}
