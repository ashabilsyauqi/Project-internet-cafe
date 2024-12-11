<h2>Tambah Makanan</h2>

<?= form_open_multipart('admin/makanan/store') ?>

    <label for="nama_makanan">Nama Makanan:</label>
    <input type="text" name="nama_makanan" value="<?= set_value('nama_makanan') ?>">
    <?= form_error('nama_makanan') ?>

    <label for="harga_beli">Harga Beli:</label>
    <input type="number" name="harga_beli" value="<?= set_value('harga_beli') ?>">
    <?= form_error('harga_beli') ?>

    <label for="harga_makanan">Harga Makanan:</label>
    <input type="number" name="harga_makanan" value="<?= set_value('harga_makanan') ?>">
    <?= form_error('harga_makanan') ?>

    <label for="stok_makanan">Stok Makanan:</label>
    <input type="number" name="stok_makanan" value="<?= set_value('stok_makanan') ?>">
    <?= form_error('stok_makanan') ?>

    <label for="foto_makanan">Foto Makanan:</label>
    <input type="file" name="foto_makanan">
    <?= isset($error) ? $error : '' ?>

    <button type="submit">Simpan</button>

<?= form_close() ?>
