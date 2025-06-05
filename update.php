<?php
// Contoh menambah user baru
include 'koneksi.php';

$username = 'admin';
$password_baru = 'admin123';
$hash_password = password_hash($password_baru, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $hash_password);
$stmt->execute();

echo "Pengguna berhasil ditambahkan.";
$stmt->close();
$conn->close();
?>