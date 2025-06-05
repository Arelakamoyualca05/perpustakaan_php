<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password_input = $_POST['password'];

    // Cari user di database
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Verifikasi password hash
        if (password_verify($password_input, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            echo "<script>alert('Password salah!'); window.location='index.html';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!'); window.location='index.html';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: index.html");
    exit;
}
?>