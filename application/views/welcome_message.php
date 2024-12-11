<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Booking System</title>
	<!-- Bootstrap CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		/* Menambahkan gradasi latar belakang */
		.full-height {
			height: 100vh;
			background: linear-gradient(to right, #4e73df, #1cc88a); /* Gradasi warna */
		}

		/* Efek bayangan pada tombol */
		.position-fixed {
			position: fixed;
			bottom: 30px;
			right: 30px;
			box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
			transition: all 0.3s ease;
		}

		.position-fixed:hover {
			box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
			transform: scale(1.1);
		}
	</style>
</head>
<body>
	<div class="full-height d-flex justify-content-center align-items-center text-center text-white">
		<h1 class="display-4 fw-bold animate__animated animate__bounce">Hello There</h1>
	</div>

	<!-- Tombol Booking di sebelah kanan bawah -->
	<a href="booking/create" class="btn btn-success position-fixed rounded-pill btn-lg">Booking</a>

	<!-- Bootstrap JS CDN (optional untuk interaksi lebih lanjut) -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
