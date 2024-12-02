<!-- application/views/admin/booking/create.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Booking</title>
</head>
<body>
    <h1>Tambah Booking</h1>
    <form action="<?php echo site_url('admin/booking/store'); ?>" method="post">
        <label for="nama_penyewa">Nama Penyewa:</label><br>
        <input type="text" name="nama_penyewa" id="nama_penyewa" required><br><br>

        <label for="lama_menyewa">Lama Menyewa (jam):</label><br>
        <input type="number" name="lama_menyewa" id="lama_menyewa" required><br><br>

        <label for="pc_id">PC ID:</label><br>
        <input type="number" name="pc_id" id="pc_id" required><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
