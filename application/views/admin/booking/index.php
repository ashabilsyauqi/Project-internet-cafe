<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .container {
      margin-top: 30px;
    }

    .table-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .thead-dark {
      background-color: #343a40;
      color: white;
    }

    .thead-light {
      background-color: #f8f9fa;
      color: #212529;
    }

    .table th, .table td {
      text-align: center;
    }

    .btn-create-booking {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

  <div class="container">
    <!-- Create Booking Button -->
    <a href="<?= base_url('admin/booking/create') ?>" class="btn btn-primary btn-create-booking">Buat Booking</a>

    <!-- Table for Booking List -->
    <div class="table-container">
      <h4>Booking List</h4>

      <?php if (!empty($bookings)): ?>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Nama Penyewa</th>
                <th scope="col">PC Number</th>
                <th scope="col">Lama Sewa</th>
                <!-- <th scope="col">Tanggal booking</th> -->
                <th scope="col">Food Item</th>
                <th scope="col">Harga Warnet</th>
                <th scope="col">Harga Makanan</th>
                <th scope="col">Harga Total</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($bookings as $booking): ?>
                <tr>
                  <td><?php echo isset($booking['nama_penyewa']) ? $booking['nama_penyewa'] : 'N/A'; ?></td>
                  <td><?php echo isset($booking['nomor_pc']) ? $booking['nomor_pc'] : 'N/A'; ?></td>
                  <td><?php echo isset($booking['lama_menyewa']) ? $booking['lama_menyewa'] : 'N/A'; ?> Jam</td>
                  <!-- <td><?php echo isset($booking['tanggal_booking']) ? $booking['tanggal_booking'] : 'N/A'; ?></td> -->
                  <td><?php echo isset($booking['makanan']) ? $booking['makanan'] : 'None'; ?></td>
                  <td>Rp <?php echo isset($booking['harga_makanan']) ? $booking['harga_makanan'] : 'N/A'; ?></td>
                  <td>Rp <?php echo isset($booking['harga_sewa']) ? $booking['harga_sewa'] : 'N/A'; ?></td>
                  <td>Rp <?php echo isset($booking['harga_total']) ? $booking['harga_total'] : 'N/A'; ?></td>
                  <td>
                    <a href="<?php echo site_url('admin/booking/edit/' . $booking['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?php echo site_url('admin/booking/delete/' . $booking['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <p>No bookings found.</p>
      <?php endif; ?>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
