<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Receipt</title>
    <style>
        /* Full viewport height with gradient background */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to right, #6a11cb, #2575fc); /* Gradient background */
            font-family: Arial, sans-serif;
        }

        /* Card styling */
        .receipt-card {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .receipt-card h2 {
            font-size: 24px;
            margin-bottom: 15px;
            text-align: center;
            color: #333;
        }

        .receipt-card p {
            margin: 5px 0;
            font-size: 16px;
            color: #555;
        }

        .receipt-card .total-price {
            margin-top: 15px;
            font-size: 18px;
            font-weight: bold;
            color: #2ecc71; /* Green color for total price */
        }

        .receipt-card .line {
            width: 100%;
            border-top: 1px dashed #ddd;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="receipt-card">
    <h3>Ringkasan Booking</h3>
    <p>Nama Penyewa: <?= $booking_data['nama_penyewa']; ?></p>
    <p>Lama Menyewa: <?= $booking_data['lama_menyewa']; ?> jam</p>
    <p>Total Harga: Rp<?= number_format($booking_data['harga_total'], 0, ',', '.'); ?></p>

    <!-- Form untuk upload bukti pembayaran -->
    <form method="post" action="<?php echo site_url('admin/booking/store_step2'); ?>" enctype="multipart/form-data">
        <!-- CSRF Token -->
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" 
               value="<?php echo $this->security->get_csrf_hash(); ?>">

        <!-- Upload Bukti Pembayaran -->
        <label>Upload Bukti Pembayaran</label>
        <input type="file" name="bukti_pembayaran" required>

        <button type="submit">Simpan Booking</button>
    </form>
</div>

<!-- Menampilkan pesan error atau success -->
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>


</body>
</html>
