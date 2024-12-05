<!-- application/views/admin/booking/create.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        label {
            font-size: 14px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>Tambah Booking</h1>

    <form action="<?= base_url('admin/booking/store') ?>" method="post">
        
        <div class="form-group">
            <label for="nama_penyewa">Nama Penyewa:</label>
            <input type="text" name="nama_penyewa" required placeholder="Masukkan Nama Penyewa">
        </div>

        <div class="form-group">
            <label for="lama_menyewa">Lama Menyewa (jam):</label>
            <input type="number" name="lama_menyewa" required placeholder="Masukkan Lama Menyewa (dalam jam)">
        </div>

        <div class="form-group">
            <label for="pc_id">Pilih PC:</label>
            <select name="pc_id" required>
                <option value="">Pilih PC</option>
                <?php if (!empty($pcs)): ?>
                    <?php foreach ($pcs as $pc): ?>
                        <option value="<?= $pc['id_pc'] ?>"><?= $pc['nomor_pc'] ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">Tidak ada PC tersedia</option>
                <?php endif; ?>
            </select>
        </div>

        <!-- <div class="form-group">
    <label for="tanggal_booking">Tanggal Booking:</label>
    <input type="date" name="tanggal_booking" required>
</div> -->


<div class="form-group">
    <label for="jajanan">Pilih Makanan (Optional):</label>
    <select name="jajanan" >
        <option value="">Pilih Makanan</option>
        <?php foreach ($makanan as $item): ?>
            <option value="<?= $item['id_makanan'] ?>" data-harga="<?= $item['harga_makanan'] ?>">
                <?= $item['nama_makanan'] ?> - Rp<?= number_format($item['harga_makanan'], 0, ',', '.') ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />


        <button type="submit">Submit</button>
    </form>

</body>
</html>
