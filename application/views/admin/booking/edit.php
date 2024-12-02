<!-- application/views/admin/booking/edit.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Booking</title>
</head>
<body>
    <h1>Edit Booking</h1>
    <form action="<?php echo site_url('admin/booking/update/'.$booking->id); ?>" method="post">
        <label for="nama_penyewa">Nama Penyewa:</label><br>
        <input type="text" name="nama_penyewa" id="nama_penyewa" value="<?php echo $booking->nama_penyewa; ?>" required><br><br>

        <label for="lama_menyewa">Lama Menyewa (jam):</label><br>
        <input type="number" name="lama_menyewa" id="lama_menyewa" value="<?php echo $booking->lama_menyewa; ?>" required><br><br>

        <label for="pc_id">PC ID:</label><br>
        <input type="number" name="pc_id" id="pc_id" value="<?php echo $booking->pc_id; ?>" required><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
