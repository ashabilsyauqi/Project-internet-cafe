<!-- application/views/admin/booking/index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking PC - Admin</title>
</head>
<body>
    <h1>Daftar Booking</h1>
    <a href="<?php echo site_url('admin/booking/create'); ?>">Tambah Booking</a>
    <table border="1">
        <thead>
            <tr>
                <th>Nama Penyewa</th>
                <th>Lama Menyewa (jam)</th>
                <th>PC ID</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?php echo $booking->nama_penyewa; ?></td>
                <td><?php echo $booking->lama_menyewa; ?></td>
                <td><?php echo $booking->pc_id; ?></td>
                <td><?php echo $this->Booking_model->hitung_harga($booking->lama_menyewa); ?></td>
                <td>
                    <a href="<?php echo site_url('admin/booking/edit/'.$booking->id); ?>">Edit</a>
                    <a href="<?php echo site_url('admin/booking/delete/'.$booking->id); ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
