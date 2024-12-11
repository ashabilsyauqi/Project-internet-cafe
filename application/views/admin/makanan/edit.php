<h2>Edit Makanan</h2>

<?= form_open_multipart('admin/makanan/update/'.$makanan->id_makanan) ?>

    <label for="nama_makanan">Nama Makanan:</label>
    <input type="text" name="nama_makanan" value="<?= $makanan->nama_makanan ?>">
    <?= form_error('nama_makanan') ?>

    <label for="harga_beli">Harga Beli:</label>
    <input type="number" name="harga_beli" value="<?= $makanan->harga_beli ?>">
    <?= form_error('harga_beli') ?>

    <label for="harga_makanan">Harga Makanan:</label>
    <input type="number" name="harga_makanan" value="<?= $makanan->harga_makanan ?>">
    <?= form_error('harga_makanan') ?>

    <label for="stok_makanan">Stok Makanan:</label>
    <input type="number" name="stok_makanan" value="<?= $makanan->stok_makanan ?>">
    <?= form_error('stok_makanan') ?>

    <label for="foto_makanan">Foto Makanan:</label>
    <input type="file" name="foto_makanan">
    <input type="hidden" name="old_foto" value="<?= $makanan->foto_makanan ?>">

    <img src="<?= base_url('uploads/'.$makanan->foto_makanan) ?>" width="100">

    <button type="submit">Simpan</button>

<?= form_close() ?>
