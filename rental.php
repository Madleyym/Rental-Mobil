<?php
session_start();
require_once 'koneksi.php';
require_once 'functions.php';
checkLogin();

// Pencarian rental
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$query = "SELECT r.*, p.nama_tryandaasu, m.nama_mobil_tryandaasu 
          FROM tbl_rental_tryandaasu r 
          LEFT JOIN tbl_pelanggan_tryandaasu p ON r.nik_ktp_tryandaasu = p.nik_ktp_tryandaasu
          LEFT JOIN tbl_mobil_tryandaasu m ON r.no_plat_tryandaasu = m.no_plat_tryandaasu";
if (!empty($search)) {
    $query .= " WHERE r.no_trx_tryandaasu LIKE '%$search%' 
                OR p.nama_tryandaasu LIKE '%$search%'
                OR m.nama_mobil_tryandaasu LIKE '%$search%'";
}
$query .= " ORDER BY r.tgl_rental_tryandaasu DESC, r.jam_rental_tryandaasu DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Rental - Rental Mobil Tryandaasu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Rental Mobil Tryandaasu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="mobil.php">Data Mobil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pelanggan.php">Data Pelanggan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="rental.php">Data Rental</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Data Rental</h2>
            <a href="tambah_rental.php" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Rental
            </a>
        </div>

        <!-- Search Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="search" placeholder="Cari berdasarkan No TRX, nama pelanggan, atau nama mobil..." value="<?php echo $search; ?>">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No TRX</th>
                                <th>Pelanggan</th>
                                <th>Mobil</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Harga</th>
                                <th>Lama</th>
                                <th>Total</th>
                                <th width="200">Aksi</th>
                            </tr>
                        </thead>
                        <!-- https://github.com/Madleyym/Rental-Mobil/blob/main/rental.php -->
                        <tbody>
                            <?php if ($result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['no_trx_tryandaasu']); ?></td>
                                        <td>
                                            <?php echo htmlspecialchars($row['nama_tryandaasu']); ?><br>
                                            <small class="text-muted"><?php echo htmlspecialchars($row['nik_ktp_tryandaasu']); ?></small>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($row['nama_mobil_tryandaasu']); ?><br>
                                            <small class="text-muted"><?php echo htmlspecialchars($row['no_plat_tryandaasu']); ?></small>
                                        </td>
                                        <td><?php echo date('d/m/Y', strtotime($row['tgl_rental_tryandaasu'])); ?></td>
                                        <td><?php echo date('H:i', strtotime($row['jam_rental_tryandaasu'])); ?></td>
                                        <td>Rp <?php echo number_format($row['harga_tryandaasu'], 0, ',', '.'); ?></td>
                                        <td><?php echo $row['lama_tryandaasu']; ?> hari</td>
                                        <td>Rp <?php echo number_format($row['total_bayar_tryandaasu'], 0, ',', '.'); ?></td>
                                        <td>
                                            <a href="edit_rental.php?id=<?php echo $row['no_trx_tryandaasu']; ?>" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            <button onclick="confirmDelete('<?php echo $row['no_trx_tryandaasu']; ?>')" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data rental</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data rental akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'hapus_rental.php?id=' + id;
                }
            })
        }

        // Tampilkan pesan sukses jika ada
        <?php if (isset($_SESSION['success'])): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?php echo $_SESSION['success']; ?>',
                timer: 3000,
                showConfirmButton: false
            });
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
    </script>
</body>

</html>