<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>peminjaman_buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Data</h1>
        <a href="insert.php" class="btn-tambah">Tambah Data</a>
        
        <table border="1">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Website</th>
                <th>Comment</th>
                <th>Gender</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $query = "SELECT * FROM praktik ORDER BY id DESC";
            $result = mysqli_query($koneksi, $query);
            
            while ($row = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['website']; ?></td>
                <td><?php echo $row['coment']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td>
                    <a href="update.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn-hapus" onclick="return confirm('Yakin hapus data?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
