<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking List</title>
</head>
<body>

    <h1>Booking List</h1>

    <?php if (!empty($bookings)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID Booking</th>
                    <th>PC Number</th>
                    <th>Food Item</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <!-- Ensure id_booking is set before displaying -->
                        <td><?php echo isset($booking['nama_penyewa']) ? $booking['nama_penyewa'] : 'N/A'; ?></td>

                        
                        <td><?php echo isset($booking['nomor_pc']) ? $booking['nomor_pc'] : 'N/A'; ?></td>
                        <td><?php echo isset($booking['makanan']) ? $booking['makanan'] : 'N/A'; ?></td>
                        <td>
                            <a href="<?php echo site_url('admin/booking/edit/' . $booking['id']); ?>">Edit</a> | 
                            <a href="<?php echo site_url('admin/booking/delete/' . $booking['id']); ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No bookings found.</p>
    <?php endif; ?>

</body>
</html>
