<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Makanan</title>
</head>
<body>
    <h1>Edit Makanan</h1>

    <?php echo form_open_multipart('admin/makanan/update/' . $makanan->id_makanan); ?>
        <div>
            <label for="nama_makanan">Nama Makanan:</label>
            <input type="text" name="nama_makanan" id="nama_makanan" value="<?php echo $makanan->nama_makanan; ?>" required>
        </div>

        <div>
            <label for="harga_beli">Harga Beli:</label>
            <input type="number" name="harga_beli" id="harga_beli" value="<?php echo $makanan->harga_beli; ?>" required>
        </div>

        <div>
            <label for="harga_makanan">Harga Makanan:</label>
            <input type="number" name="harga_makanan" id="harga_makanan" value="<?php echo $makanan->harga_makanan; ?>" required>
        </div>

        <div>
            <label for="stok_makanan">Stok Makanan:</label>
            <input type="number" name="stok_makanan" id="stok_makanan" value="<?php echo $makanan->stok_makanan; ?>" required>
        </div>

        <div>
            <label for="foto_makanan">Foto Makanan:</label>
            <input type="file" name="foto_makanan" id="foto_makanan" accept="image/*">
            <br>
            <!-- Display current image -->
            <img src="<?php echo base_url('uploads/' . $makanan->foto_makanan); ?>" width="100" alt="Current Photo">
            <input type="hidden" name="old_foto" value="<?php echo $makanan->foto_makanan; ?>">
        </div>

        <div>
            <label for="margin_makanan">Margin Makanan:</label>
            <input type="text" name="margin_makanan" id="margin_makanan" value="<?php echo $makanan->margin_makanan; ?>" disabled>
        </div>

        <button type="submit">Update</button>
    </form>

    <a href="<?php echo site_url('admin/makanan'); ?>">Back to List</a>
</body>
</html>
