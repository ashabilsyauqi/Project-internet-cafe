<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makanan List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #343a40;
        }
        a {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        img {
            max-width: 100px; /* Ensure the image doesn't exceed 100px */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>
<body>
    <h1>Makanan List</h1>

    <a href="<?php echo site_url('admin/makanan/create'); ?>">Create New Makanan</a>
    <a href="<?php echo site_url('admin/'); ?>">back to Main</a>


    <table>
        <thead>
            <tr>
                <th>Nama Makanan</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Foto</th>
                <th>Margin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($makanan as $item): ?>
                <tr>
                    <td><?php echo $item->nama_makanan; ?></td>
                    <td><?php echo $item->harga_beli; ?></td>
                    <td><?php echo $item->harga_makanan; ?></td>
                    <td><?php echo $item->stok_makanan; ?></td>
                    <td><img src="<?php echo base_url('uploads/' . $item->foto_makanan); ?>" alt="Foto Makanan"></td>
                    <td><?php echo $item->margin_makanan; ?></td>
                    <td>
                        <a href="<?php echo site_url('admin/makanan/edit/' . $item->id_makanan); ?>">Edit</a>
                        <a href="<?php echo site_url('admin/makanan/delete/' . $item->id_makanan); ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>