<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Booking</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Menambahkan gradasi latar belakang */
        body {
            background: linear-gradient(to right, #4e73df, #1cc88a); /* Gradasi warna */
            color: white;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .container {
            max-width: 600px;
            width: 100%;
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        form {
            margin-top: 20px;
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
            background-color: #1cc88a;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #17a673;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .pc-radio-group {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* 4 kolom per baris */
            gap: 10px;
        }

        .pc-radio {
            text-align: center;
        }

        .pc-radio input[type="radio"] {
            display: none;
        }

        .pc-radio label {
            display: block;
            width: 100%;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .pc-radio input[type="radio"]:checked + label {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            background-color:darkgreen;
        }

        .available {
            background-color: #28a745; /* Green for Available */
            border-color: #28a745;
            color: white;
        }

        .in-use {
            background-color: #dc3545; /* Red for In Use */
            border-color: #dc3545;
            color: white;
        }

        .pc-radio label:hover {
            opacity: 0.9;
        }

        .food-slider {
            display: flex;
            overflow-x: auto;
            gap: 10px;
            scroll-behavior: smooth;
        }

        .food-slider::-webkit-scrollbar {
            display: none;
        }

        .food-item {
            min-width: 150px;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
            padding: 10px;
            background: #fff;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .food-item:hover {
            transform: scale(1.1);
        }

        .food-item input[type="radio"] {
            display: none;
        }

        .food-item label {
            display: block;
            cursor: pointer;
        }

        .food-item input[type="radio"]:checked + label {
            background-color: #1cc88a;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .slider-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .slider-buttons button {
            background-color: #4e73df;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .slider-buttons button:hover {
            background-color: #375a7f;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Hello Pemain Hebat!</h1>

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
                <div class="pc-radio-group">
                    <?php if (!empty($pcs)): ?>
                        <?php foreach ($pcs as $pc): ?>
                            <div class="pc-radio">
                                <input type="radio" id="pc-<?= $pc['id_pc'] ?>" name="pc_id" value="<?= $pc['id_pc'] ?>" required>
                                <label for="pc-<?= $pc['id_pc'] ?>" class="<?= ($pc['status_pc'] == 'Available') ? 'available' : 'in-use' ?>">
                                    <?= $pc['nomor_pc'] ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="pc-radio">
                            <label class="in-use">
                                Tidak ada PC tersedia
                            </label>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label for="jajanan">Makanan:</label>
                <div class="food-slider" id="food-slider">
                    <?php foreach ($makanan as $food): ?>
                        <div class="food-item">
                            <input type="radio" id="food-<?= $food->id_makanan; ?>" name="jajanan" value="<?= $food->id_makanan; ?>" required>
                            <label style="color:#292929" for="food-<?= $food->id_makanan; ?>">
                                <?= $food->nama_makanan; ?> <br> Rp <?= $food->harga_makanan; ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="slider-buttons">
                    <button type="button" style="width:20%"id="prev-button">&#8592; Prev</button>
                    <button type="button" style="width:20%"id="next-button">Next &#8594;</button>
                </div>
            </div>

            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />

            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        const slider = document.getElementById('food-slider');
        const prevButton = document.getElementById('prev-button');
        const nextButton = document.getElementById('next-button');

        prevButton.addEventListener('click', () => {
            slider.scrollBy({ left: -150, behavior: 'smooth' });
        });

        nextButton.addEventListener('click', () => {
            slider.scrollBy({ left: 150, behavior: 'smooth' });
        });
    </script>
</body>
</html>