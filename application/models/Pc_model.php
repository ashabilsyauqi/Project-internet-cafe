<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pc_model extends CI_Model
{
    // Mendapatkan PC yang memiliki status 'Available'
    public function getAvailablePc()
    {
        $this->db->where('status_pc', 'Available'); // Filter untuk status 'Available'
        $query = $this->db->get('pc'); // Menjalankan query untuk tabel 'pc'
        return $query->result_array(); // Mengembalikan hasil query sebagai array
    }

    // Mengupdate status PC
    public function update_pc_status($id_pc, $status)
    {
        $data = [
            'status_pc' => $status
        ];

        $this->db->where('id_pc', $id_pc);
        return $this->db->update('PC', $data); // Update status PC di tabel pc
    }

    // Mengambil semua data PC
   // Mengambil semua data PC termasuk statusnya
public function getAllPc()
{
    $query = $this->db->get('pc'); // Mendapatkan semua data dari tabel pc
    return $query->result_array(); // Mengembalikan hasil query sebagai array
}

// Mengambil data PC yang memiliki status tertentu
public function getPcByStatus($status)
{
    $this->db->where('status_pc', $status); // Filter berdasarkan status
    $query = $this->db->get('pc');
    return $query->result_array(); // Mengembalikan hasil query sebagai array
}


    // Menambahkan PC baru
    public function createPc($data)
    {
        return $this->db->insert('PC', $data); // Menambahkan data ke tabel 'PC'
    }

    // Mendapatkan PC berdasarkan ID
    public function getPcById($id_pc)
    {
        return $this->db->get_where('PC', ['id_pc' => $id_pc])->row_array(); // Mendapatkan data PC berdasarkan id
    }

    // Mengupdate data PC
    public function updatePc($id_pc, $data)
    {
        $this->db->where('id_pc', $id_pc);
        return $this->db->update('PC', $data); // Mengupdate data PC di tabel 'PC'
    }

    // Menghapus PC
    public function deletePc($id_pc)
    {
        $this->db->where('id_pc', $id_pc);
        return $this->db->delete('PC'); // Menghapus data PC di tabel 'PC'
    }
}
