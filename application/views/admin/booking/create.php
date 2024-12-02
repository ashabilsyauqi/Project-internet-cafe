<!-- application/views/admin/booking/create.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Booking</title>
</head>
<body>
    <h1>Tambah Booking</h1>
    <!-- application/views/admin/booking/create.php -->

    <form action="<?php echo site_url('admin/booking/store'); ?>" method="post">
        <label for="nama_penyewa">Nama Penyewa:</label><br>
        <input type="text" name="nama_penyewa" id="nama_penyewa" required><br><br>

        <label for="lama_menyewa">Lama Menyewa (jam):</label><br>
        <input type="number" name="lama_menyewa" id="lama_menyewa" required><br><br>

        <label for="pc_id">PC:</label><br>
        <select name="pc_id" id="pc_id" required>
            <option value="">Pilih PC</option>
            <?php foreach ($pcs as $pc): ?>
                <option value="<?php echo $pc['id_pc']; ?>"><?php echo 'PC #' . $pc['id_pc']; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="tanggal_booking">Tanggal Booking:</label><br>
        <input type="date" name="tanggal_booking" id="tanggal_booking" required><br><br>

        <button type="submit">Simpan</button>
    </form>

</body>
</html>
