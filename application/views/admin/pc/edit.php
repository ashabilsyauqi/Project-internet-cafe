<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit PC</title>
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
        .container {
            max-width: 400px;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #495057;
        }
        input[type="number"],
        select {
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit PC</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="nomor_pc">Nomor PC:</label>
                <input type="number" name="nomor_pc" id="nomor_pc" value="<?= $pc['nomor_pc']; ?>" required>
            </div>

            <div class="form-group">
                <label for="status_pc">Status PC:</label>
                <select name="status_pc" id="status_pc" required>
                    <option value="Available" <?= $pc['status_pc'] == 'Available' ? 'selected' : ''; ?>>Available</option>
                    <option value="In Use" <?= $pc['status_pc'] == 'In Use' ? 'selected' : ''; ?>>In Use</option>
                    <option value="Maintenance" <?= $pc['status_pc'] == 'Maintenance' ? 'selected' : ''; ?>>Maintenance</option>
                </select>
            </div>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>