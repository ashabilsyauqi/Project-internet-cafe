<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Receipt</title>
</head>
<body>
    <h1>Booking Receipt</h1>
    
    <?php if ($this->session->flashdata('success')): ?>
        <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>
    
    <p><strong>Booking ID:</strong> <?php echo $booking['id_booking']; ?></p>
    <p><strong>PC:</strong> <?php echo $booking['id_pc']; ?></p>
    <p><strong>Jajanan:</strong> <?php echo $booking['jajanan']; ?></p>
    <p><strong>Bukti Pembayaran:</strong> <a href="<?php echo base_url('uploads/bukti_pembayaran/' . $booking['bukti_pembayaran']); ?>" target="_blank">View Payment Proof</a></p>
    
    <!-- Display other booking details as needed -->
</body>
</html>
