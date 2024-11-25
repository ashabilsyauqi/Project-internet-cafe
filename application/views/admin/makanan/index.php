<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Makanan</title>
    <style>
        /* CSS untuk tabel */
        table {
            width: 100%; /* Membuat tabel mengambil lebar penuh */
            border-collapse: collapse; /* Menggabungkan border agar lebih rapi */
        }

        th, td {
            padding: 10px; /* Menambah padding untuk celah yang lebih baik */
            text-align: left; /* Menyelaraskan teks ke kiri */
            border: 1px solid #ddd; /* Menambah border pada setiap cell */
        }

        th {
            background-color: #f4f4f4; /* Warna latar belakang untuk header */
        }

        img {
            width: 100px; /* Menyesuaikan lebar gambar */
            height: auto; /* Menjaga rasio aspek gambar */
        }

        a {
            text-decoration: none;
            color: #007bff; /* Memberi warna biru pada link */
        }

        a:hover {
            text-decoration: underline; /* Menambahkan underline saat hover */
        }

        h2 {
            margin-bottom: 20px;
        }

        .message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 20px;
        }

        .no-data {
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>

<h2>Daftar Makanan</h2>

<?php if (!empty($message)): ?>
    <div class="message">
        <p><?php echo $message; ?></p>
    </div>
<?php endif; ?>

<a href="<?php echo site_url('admin/makanan/create'); ?>">Tambah Makanan</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nama Makanan</th>
            <th>Harga Makanan</th>
            <th>Harga Beli</th>
            <th>Stok Makanan</th>
            <th>Foto Makanan</th>
            <th>Margin Makanan</th>
            <th>Tindakan</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($makanan)): ?>
            <?php foreach ($makanan as $item): ?>
                <tr>
                    <td><?php echo $item->nama_makanan; ?></td>
                    <td><?php echo number_format($item->harga_makanan, 0, ',', '.'); ?></td>
                    <td><?php echo number_format($item->harga_beli, 0, ',', '.'); ?></td>
                    <td><?php echo $item->stok_makanan; ?></td>
                    <td><img src="<?php echo base_url('uploads/' . $item->foto_makanan); ?>" width="100" alt="Foto Makanan"></td>
                    <td><?php echo number_format($item->margin_makanan, 0, ',', '.'); ?></td>
                    <td>
                        <a href="<?php echo site_url('admin/makanan/edit/' . $item->id_makanan); ?>">Edit</a> |
                        <a href="<?php echo site_url('admin/makanan/delete/' . $item->id_makanan); ?>">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr class="no-data">
                <td colspan="7">Tidak ada data makanan</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


</body>
</html>
