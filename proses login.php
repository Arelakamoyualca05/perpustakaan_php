<?php
session_start();

// Koneksi ke database
$host = "localhost";
$username = "root"; // sesuaikan dengan username mysql kamu
$password = ""; // sesuaikan password mysql kamu
$dbname = "db_login"; // nama database kamu

$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Query untuk mencari user
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($pass, $row['password'])) {
            // Login berhasil
            $_SESSION['username'] = $user;
            header("Location: dashboard.php"); // halaman setelah login
            exit;
        } else {
            // Password salah
            echo "<script>alert('Password salah!'); window.location='index.html';</script>";
        }
    } else {
        // User tidak ditemukan
        echo "<script>alert('Username tidak ditemukan!'); window.location='index.html';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: index.html");
    exit;
}
?>