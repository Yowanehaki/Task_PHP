<?php
session_start();
if (!isset($_SESSION['data'])) {
    die("Tidak ada data untuk ditampilkan.");
}
$data = $_SESSION['data'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pendaftaran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Data Pendaftaran</h1>
        <table>
            <tr>
                <th>Nama</th>
                <td><?= $data['name'] ?></td>
            </tr>
            <tr>
                <th>NIM</th>
                <td><?= $data['nim'] ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= $data['email'] ?></td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td><?= $data['gender'] ?></td>
            </tr>
            <tr>
                <th>Isi File</th>
                <td><pre><?= htmlspecialchars($data['fileContent']) ?></pre></td>
            </tr>
            <tr>
                <th>Browser</th>
                <td><?= htmlspecialchars($data['browser']) ?></td>
            </tr>
            <tr>
                <th>Sistem Operasi</th>
                <td><?= $data['os'] ?></td>
            </tr>
        </table>
    </div>
</body>
</html>
