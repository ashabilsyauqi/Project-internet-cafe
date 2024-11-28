<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of PCs</title>
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
    </style>
</head>
<body>
    <h1>List of PCs</h1>
    <a href="<?= base_url('admin/pc/create'); ?>">Add New PC</a>
    <a href="<?php echo site_url('admin/'); ?>">back to Main</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nomor PC</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pc as $p): ?>
                <tr>
                    <td><?= $p['id_pc']; ?></td>
                    <td><?= $p['nomor_pc']; ?></td>
                    <td><?= $p['status_pc']; ?></td>
                    <td>
                        <a href="<?= base_url('admin/pc/edit/' . $p['id_pc']); ?>">Edit</a>
                        <a href="<?= base_url('admin/pc/delete/' . $p['id_pc']); ?>" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>