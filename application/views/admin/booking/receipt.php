<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Receipt</title>
    <style>
        /* Full viewport height with gradient background */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to right, #6a11cb, #2575fc); /* Gradient background */
            font-family: Arial, sans-serif;
        }

        /* Card styling */
        .receipt-card {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .receipt-card h2 {
            font-size: 24px;
            margin-bottom: 15px;
            text-align: center;
            color: #333;
        }

        .receipt-card p {
            margin: 5px 0;
            font-size: 16px;
            color: #555;
        }

        .receipt-card .total-price {
            margin-top: 15px;
            font-size: 18px;
            font-weight: bold;
            color: #2ecc71; /* Green color for total price */
        }

        .receipt-card .line {
            width: 100%;
            border-top: 1px dashed #ddd;
            margin: 10px 0;
        }
    </style>
</head>
<body>

    <div class="receipt-card">
        <h2>Booking Receipt</h2>
        <p><strong>Nama Penyewa:</strong> John Doe</p>
        <p><strong>Lama Menyewa:</strong> 3 Jam</p>
        <p><strong>PC yang Disewa:</strong> PC-01</p>
        <div class="line"></div>
        <p><strong>Harga Sewa PC:</strong> Rp 9000</p>
        <p><strong>Harga Makanan:</strong> Rp 2000</p>
        <div class="line"></div>
        <p class="total-price"><strong>Total yang Harus Dibayar:</strong> Rp 11000</p>
    </div>

</body>
</html>
