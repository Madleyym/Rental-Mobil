<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'koneksi.php';


if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header('Location: ../../modules/dashboard/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = md5($_POST['password']); // Menggunakan MD5 untuk password

    // Debug input values
    error_log("Username Input: " . $username);
    error_log("Password Hash: " . $password);

    $query = "SELECT id_user_tryandaasu, username_tryandaasu, level_tryandaasu, password_tryandaasu 
              FROM tbl_user_tryandaasu 
              WHERE username_tryandaasu = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        die("Query gagal diproses: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $execute_result = $stmt->execute();

    if (!$execute_result) {
        error_log("Execute failed: " . $stmt->error);
        die("Execute failed: " . $stmt->error);
    }

    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Debug database values
        error_log("DB Username: " . $user['username_tryandaasu']);
        error_log("DB Password: " . $user['password_tryandaasu']);

        // Membandingkan password yang di-hash dengan yang ada di database
        if ($user['password_tryandaasu'] === $password) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $user['username_tryandaasu'];
            $_SESSION['level'] = $user['level_tryandaasu'];

            // Debug session
            error_log("Session set - Username: " . $_SESSION['username']);
            error_log("Session set - Level: " . $_SESSION['level']);

            header('Location: index.php');
            exit;
        } else {
            error_log("Password mismatch!");
            error_log("Input (hashed): " . $password);
            error_log("DB Password: " . $user['password_tryandaasu']);
            $error = 'Password salah';
        }
    } else {
        error_log("No user found with username: " . $username);
        $error = 'Username tidak ditemukan';
    }

    $stmt->close();
}

// Test koneksi database
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rental Mobil Tryandaasu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .demo-credentials {
            margin-top: 20px;
            text-align: center;
            padding: 15px;
            background-color: #e3f2fd;
            border: 2px dashed #2196f3;
            border-radius: 10px;
        }

        .demo-credentials p {
            color: #1976d2;
            font-size: 15px;
            margin: 0;
            padding: 3px 0;
        }

        .demo-credentials .highlight {
            font-weight: bold;
            color: #1565c0;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .shine-effect {
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(255, 255, 255, 0.2),
                    transparent);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% {
                left: -100%;
            }

            100% {
                left: 200%;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="card">
            <div class="card-body p-4">
                <h2 class="text-center mb-4">Login Admin</h2>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>

                <div class="demo-credentials">
                    <p>Demo Account:</p>
                    <p><span class="highlight">Username:</span> admin</p>
                    <p><span class="highlight">Password:</span> admin</p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>