<h2>List of Makanan</h2>

<table>
    <tr>
        <th>Nama Makanan</th>
        <th>Harga Makanan</th>
        <th>Stok Makanan</th>
        <th>Foto</th>
        <th>Aksi</th>
    </tr>

    <?php foreach($makanan as $m): ?>
    <tr>
        <td><?= $m->nama_makanan ?></td>
        <td><?= $m->harga_makanan ?></td>
        <td><?= $m->stok_makanan ?></td>
        <td><img src="<?= base_url('uploads/'.$m->foto_makanan) ?>" width="100"></td>
        <td>
            <a href="<?= base_url('admin/makanan/edit/'.$m->id_makanan) ?>">Edit</a>
            <a href="<?= base_url('admin/makanan/delete/'.$m->id_makanan) ?>" onclick="return confirm('Are you sure to delete?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<a href="<?= base_url('admin/makanan/create') ?>">Tambah Makanan</a>
