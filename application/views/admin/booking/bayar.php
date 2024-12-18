<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #4e73df, #1cc88a);
            color: white;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .receipt-card {
            width: 350px;
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: left;
        }

        .receipt-card h3 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #333;
            text-align: center;
        }

        .table {
            width: 100%;
            margin-top: 10px;
        }

        .table td {
            padding: 5px;
            text-align: left;
        }

        .total-price {
            margin-top: 15px;
            font-size: 18px;
            font-weight: bold;
            color: #2ecc71;
        }

        form {
            width: 100%;
            margin-top: 20px;
        }

        .drop-area {
            border: 2px dashed #1cc88a;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            margin-top: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .drop-area:hover {
            background-color: #e0f7e0; /* Light green on hover */
        }

        .drop-area p {
            margin: 0;
            color: #555;
        }

        button {
            background-color: #1cc88a;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #17a673;
        }
    </style>
</head>
<body>

<div class="receipt-card">
    <h3>Detail Pemesanan</h3>
    <table class="table">
        <tr>
            <td>Sewa</td>
            <td>:</td>
            <td><?= $booking_data['lama_menyewa']; ?> Jam</td>
            <td>Rp<?= number_format($booking_data['harga_sewa'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td>Jajanan</td>
            <td>:</td>
            <td><?= $booking_data['nama_makanan']; ?></td>
            <td>Rp<?= number_format($booking_data['harga_makanan'], 0, ',', '.'); ?></td>
        </tr>
    </table>

    <p class="total-price">Total Harga: Rp<?= number_format($booking_data['harga_total'], 0, ',', '.'); ?></p>
    <p>Nomor Rekening: Mandiri 2342182648923</p>

    <form method="post" action="<?php echo site_url('admin/booking/store_step2'); ?>" enctype="multipart/form-data">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" 
               value="<?php echo $this->security->get_csrf_hash(); ?>">
        <label>Upload Bukti Pembayaran</label>
        <div class="drop-area" id="drop-area">
            <p>Drag & Drop files here</p>
            <p>or</p>
            <p><button type="button" id="browse-button">Browse Files</button></p>
            <input type="file" name="bukti_pembayaran" id="fileElem" required style="display:none;">
        </div>
        <button type="submit">Simpan Booking</button>
    </form>
</div>

<script>
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('fileElem');
    const browseButton = document.getElementById('browse-button');

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Highlight drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });

    // Remove highlight when item is no longer hovering
    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });

    // Handle dropped files
    dropArea.addEventListener('drop', handleDrop, false);

    // Open file dialog when clicking the button
    browseButton.addEventListener('click', () => {
        fileInput.click();
    });

    // Handle file selection
    fileInput.addEventListener('change', (event) => {
        const files = event.target.files;
        handleFiles(files);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function highlight() {
        dropArea.classList.add('highlight');
    }

    function unhighlight() {
        dropArea.classList.remove('highlight');
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    function handleFiles(files) {
        // You can add file handling logic here if needed
        console.log(files);
    }
</script>

</body>
</html>
