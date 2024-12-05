<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Makanan_model extends CI_Model {

    /**
     * Get all food records with stock greater than 0
     * @return array
     */
    public function getAllMakananWithStock()
    {
        $this->db->where('stok_makanan >', 0);
        return $this->db->get('makanan')->result_array();
    }

    /**
     * Reduce the stock of a food item
     * @param int $id
     * @param int $quantity
     * @return bool
     */
    public function reduce_stock($id, $quantity)
    {
        // Mengurangi stock_makanan dengan quantity yang dipesan
        $this->db->set('stok_makanan', 'stok_makanan - ' . (int)$quantity, FALSE);
        $this->db->where('id_makanan', $id);
        return $this->db->update('makanan');
    }

    /**
     * Get all food records
     * @return array
     */
    public function getAllMakanan()
    {
        return $this->db->get('makanan')->result_array();
    }

    /**
     * Get a food record by ID
     * @param int $id
     * @return array|null
     */
    public function get_food_by_id($id)
    {
        $this->db->where('id_makanan', $id);
        return $this->db->get('makanan')->row_array();
    }

    /**
     * Get the total price of selected foods
     * @param array $ids
     * @return int
     */
    public function getTotalHargaMakanan($ids)
    {
        $this->db->select_sum('harga_makanan', 'total_harga');
        $this->db->where_in('id_makanan', $ids);
        $result = $this->db->get('makanan')->row_array();
        return isset($result['total_harga']) ? $result['total_harga'] : 0;
    }

    /**
     * Get a food record by ID (alternative method)
     * @param int $id
     * @return object|null
     */
    public function get_makanan_by_id($id)
    {
        return $this->db->get_where('makanan', ['id_makanan' => $id])->row();
    }

    /**
     * Insert a new food record
     * @param array $data
     * @return bool
     */
    public function insert_makanan($data)
    {
        return $this->db->insert('makanan', $data);
    }

    /**
     * Update an existing food record
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update_makanan($id, $data)
    {
        return $this->db->update('makanan', $data, ['id_makanan' => $id]);
    }

    /**
     * Delete a food record
     * @param int $id
     * @return bool
     */
    public function delete_makanan($id)
    {
        return $this->db->delete('m akanan', ['id_makanan' => $id]);
    }
}