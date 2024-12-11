<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Makanan_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    // Menampilkan semua makanan dari tabel makanan
    public function getAllMakanan()
    {
        // Mengambil data makanan yang stoknya kurang dari 1
        $this->db->where('stok_makanan >', 1);  // Ubah kondisi menjadi kurang dari 1
        return $this->db->get('makanan')->result();
    }
    
    

    // Menambahkan data makanan
    public function insert_makanan($data)
    {
        $this->db->insert('makanan', $data);
    }


    public function get_food_by_id($id_makanan)
    {
        $this->db->where('id_makanan', $id_makanan);
        $query = $this->db->get('makanan');
        return $query->row_array(); // Mengambil data makanan berdasarkan ID
    }



    // // Mengambil data makanan berdasarkan ID
    // public function get_makanan_by_id($id)
    // {
    //     return $this->db->get_where('makanan', array('id_makanan' => $id))->row();
    // }

    // Mengupdate data makanan berdasarkan ID
    public function update_makanan($id, $data)
    {
        $this->db->where('id_makanan', $id);
        $this->db->update('makanan', $data);
    }

    // Menghapus data makanan berdasarkan ID
    public function delete_makanan($id)
    {
        $this->db->where('id_makanan', $id);
        $this->db->delete('makanan');
    }

    // Menampilkan semua makanan dengan stok yang terkait
    public function getAllMakananWithStock()
    {
        // Ambil data dari tabel makanan dan stok_makanan
        $this->db->select('makanan.*, makanan.stok_makanan');
        $this->db->from('makanan');
        return $this->db->get()->result();
    }
    
    

    // Mengurangi stok makanan
  // Mengurangi stok makanan
public function reduce_stock($food_id, $quantity)
{
    // Ambil data stok makanan berdasarkan food_id (stok_makanan ada di tabel makanan)
    $this->db->select('stok_makanan');
    $this->db->from('makanan');
    $this->db->where('id_makanan', $food_id); // Asumsi id_makanan adalah food_id di tabel makanan
    $stock = $this->db->get()->row();

    if ($stock) {
        $new_stock = $stock->stok_makanan - $quantity;

        // Pastikan stok tidak menjadi negatif
        if ($new_stock >= 0) {
            // Update stok jika jumlah cukup
            $this->db->set('stok_makanan', $new_stock);
            $this->db->where('id_makanan', $food_id);
            return $this->db->update('makanan');
        } else {
            return false; // Tidak cukup stok
        }
    }
    return false; // Makanan tidak ditemukan
}



    //   // Metode untuk mengambil data makanan berdasarkan ID
    //   public function get_food_by_id($id_makanan)
    //   {
    //       // Menjalankan query untuk mengambil data makanan berdasarkan id
    //       $this->db->where('id_makanan', $id_makanan);
    //       $query = $this->db->get('makanan');
    //       return $query->row();  // Mengembalikan satu baris data
    //   }
  
}
