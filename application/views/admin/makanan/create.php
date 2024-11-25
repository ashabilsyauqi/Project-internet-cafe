<?php echo form_open('admin/makanan/store'); ?>

    <label for="nama_makanan">Nama Makanan</label>
    <input type="text" name="nama_makanan" id="nama_makanan" value="<?php echo set_value('nama_makanan'); ?>" required>

    <label for="harga_makanan">Harga Makanan</label>
    <input type="number" name="harga_makanan" id="harga_makanan" value="<?php echo set_value('harga_makanan'); ?>" required>

    <label for="harga_beli">Harga Beli</label>
    <input type="number" name="harga_beli" id="harga_beli" value="<?php echo set_value('harga_beli'); ?>" required>

    <label for="stok_makanan">Stok Makanan</label>
    <input type="number" name="stok_makanan" id="stok_makanan" value="<?php echo set_value('stok_makanan'); ?>" required>

    <label for="foto_makanan">Foto Makanan</label>
    <input type="file" name="foto_makanan" id="foto_makanan">

    <button type="submit">Tambah Makanan</button>

<?php echo form_close(); ?>
