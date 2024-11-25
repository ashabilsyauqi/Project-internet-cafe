<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Makanan_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function add_makanan($data) {
        if ($this->db->insert('Makanan', $data)) {
            // Debug: Jika data berhasil disimpan
            log_message('debug', 'Data berhasil disimpan ke database.');
        } else {
            // Debug: Jika data gagal disimpan
            log_message('error', 'Gagal menyimpan data ke database.');
        }
    }
    

    //   // Fungsi untuk menambahkan makanan ke database
    //   public function insert_makanan($data) {
    //     $this->db->insert('Makanan', $data);
    // }


    // Fungsi untuk mendapatkan semua data makanan
    public function get_all_makanan() {
        $query = $this->db->get('Makanan');
        return $query->result(); // Mengembalikan data sebagai array objek
    }

    // Fungsi untuk mendapatkan data makanan berdasarkan ID
    public function get_makanan_by_id($id) {
        $query = $this->db->get_where('Makanan', ['id_makanan' => $id]);
        return $query->row(); // Mengembalikan data satu baris objek
    }

  

    // Fungsi untuk memperbarui data makanan
    public function update_makanan($id, $data) {
        $this->db->where('id_makanan', $id);
        $this->db->update('Makanan', $data);
    }

    // Fungsi untuk menghapus data makanan
    public function delete_makanan($id) {
        $this->db->delete('Makanan', ['id_makanan' => $id]);
    }
}
