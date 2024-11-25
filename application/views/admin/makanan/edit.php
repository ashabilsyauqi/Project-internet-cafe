<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h2>Edit Makanan</h2>

<form action="<?php echo site_url('admin/makanan/update/' . $makanan->id_makanan); ?>" method="post" enctype="multipart/form-data">
    <label>Nama Makanan:</label>
    <input type="text" name="nama_makanan" value="<?php echo $makanan->nama_makanan; ?>" required><br>

    <label>Harga Makanan:</label>
    <input type="number" name="harga_makanan" value="<?php echo $makanan->harga_makanan; ?>" required><br>

    <label>Harga Beli:</label>
    <input type="number" name="harga_beli" value="<?php echo $makanan->harga_beli; ?>" required><br>

    <label>Stok Makanan:</label>
    <input type="number" name="stok_makanan" value="<?php echo $makanan->stok_makanan; ?>" required><br>

    <label>Foto Makanan:</label>
    <input type="file" name="foto_makanan"><br>

    <input type="submit" value="Update Makanan">
</form>
