<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Makanan_model extends CI_Model {

    public function get_all_makanan()
    {
        return $this->db->get('Makanan')->result();
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
