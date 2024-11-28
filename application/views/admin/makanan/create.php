<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Makanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #343a40;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #495057;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #0056b3;
        }
        .back-button {
            text-align: center;
            margin-top: 15px;
        }
        .back-button a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Makanan</h1>

        <?php echo form_open_multipart('admin/makanan/store'); ?>
            <div class="form-group">
                <label for="nama_makanan">Nama Makanan:</label>
                <input type="text" name="nama_makanan" id="nama_makanan" value="<?php echo set_value('nama_makanan'); ?>" required>
            </div>

            <div class="form-group">
                <label for="harga_beli">Harga Beli:</label>
                <input type="number" name="harga_beli" id="harga_beli" value="<?php echo set_value('harga_beli'); ?>" required>
            </div>

            <div class="form-group">
                <label for="harga_makanan">Harga Makanan:</label>
                <input type="number" name="harga_makanan" id="harga_makanan" value="<?php echo set_value('harga_makanan'); ?>" required>
            </div>

            <div class="form-group">
                <label for="stok_makanan">Stok Makanan:</label>
                <input type="number" name="stok_makanan" id="stok_makanan" value="<?php echo set_value('stok_makanan'); ?>" required>
            </div>

            <div class="form-group">
                <label for="foto_makanan">Foto Makanan:</label>
                <input type="file" name="foto_makanan" id="foto_makanan" accept="image/*" required>
            </div>

            <button type="submit">Create</button>
        </form>

        <div class="back-button">
            <a href="<?php echo site_url('admin/makanan'); ?>">Back to List</a>
        </div>
    </div>
</body>
</html>