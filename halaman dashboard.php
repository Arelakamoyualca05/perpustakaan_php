<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<title>Dashboard</title>
</head>
<body>
<h1>Selamat datang, <?php echo $_SESSION['username']; ?>!</h1>
<a href="logout.php">Logout</a>
</body>
</html>
<?php
session_start();
session_destroy();
header("Location: index.html");
exit;
?>