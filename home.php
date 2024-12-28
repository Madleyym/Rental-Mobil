<?php
// koneksi.php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'rentalmobil_tryandaasu';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}
?>

// index.php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil - Tryandaasu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Rental Mobil Tryandaasu</h1>
        <div class="row mt-4">
            <div class="col-md-6">
                <h2>Data Mobil</h2>
                <a href="mobil.php" class="btn btn-primary">Kelola Mobil</a>
            </div>
            <div class="col-md-6">
                <h2>Data Pelanggan</h2>
                <a href="pelanggan.php" class="btn btn-primary">Kelola Pelanggan</a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <h2>Data Rental</h2>
                <a href="rental.php" class="btn btn-primary">Kelola Rental</a>
            </div>
            <div class="col-md-6">
                <h2>Login</h2>
                <a href="login.php" class="btn btn-primary">Login Admin</a>
            </div>
        </div>
    </div>
</body>
</html>

// login.php
<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM tbl_user_tryandaasu WHERE username_tryandaasu='$username' AND password_tryandaasu='$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        header('Location: index.php');
    } else {
        $error = 'Username atau password salah';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Login Admin</h1>
        <form method="POST" class="mt-4">
            <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
