<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Receipt</h2>
    <p>Thank you for your booking!</p>
    <table class="table">
        <tr>
            <th>Nama Penyewa</th>
            <td><?= $booking_data['nama_penyewa']; ?></td>
        </tr>
        <tr>
            <th>PC Number</th>
            <td><?= $booking_data['id_pc']; ?></td>
        </tr>
        <tr>
            <th>Lama Sewa</th>
            <td><?= $booking_data['lama_menyewa']; ?> Jam</td>
        </tr>
        <tr>
            <th>Food Item</th>
            <td><?= $booking_data['nama_makanan']; ?></td>
        </tr>
        <tr>
            <th>Harga Warnet</th>
            <td>Rp<?= number_format($booking_data['harga_sewa'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <th>Harga Makanan</th>
            <td>Rp<?= number_format($booking_data['harga_makanan'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td>Rp<?= number_format($booking_data['harga_total'], 0, ',', '.'); ?></td>
        </tr>
    </table>
    <p>Nomor Rekening: Mandiri 2342182648923</p>
    <p>Bukti Pembayaran: <a href="<?= base_url('uploads/' . $booking_data['bukti_pembayaran']); ?>">Download</a></p>
</div>

</body>
</html>
