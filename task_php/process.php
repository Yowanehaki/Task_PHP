<?php
session_start(); // Mulai sesi untuk menyimpan data

// Fungsi untuk mendeteksi browser dari User-Agent
function getBrowser($userAgent) {
    if (strpos($userAgent, 'Edg') !== false || strpos($userAgent, 'Edge') !== false) {
        return 'Microsoft Edge'; 
    } elseif (strpos($userAgent, 'Chrome') !== false) {
        return 'Google Chrome';
    } elseif (strpos($userAgent, 'Firefox') !== false) {
        return 'Mozilla Firefox'; 
    } elseif (strpos($userAgent, 'Safari') !== false && strpos($userAgent, 'Chrome') === false) {
        return 'Safari';
    } elseif (strpos($userAgent, 'MSIE') !== false || strpos($userAgent, 'Trident') !== false) {
        return 'Internet Explorer'; 
    } else {
        return 'Browser Tidak Dikenali'; 
    }
}

// Periksa apakah metode request adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $name = htmlspecialchars($_POST['name']);
    $nim = htmlspecialchars($_POST['nim']);
    $email = htmlspecialchars($_POST['email']);
    $gender = htmlspecialchars($_POST['gender']);
    $file = $_FILES['file'];

    // Validasi file
    if ($file['type'] !== "text/plain") {
        die("Error: File harus berupa file teks dengan ekstensi .txt.");
    }
    if ($file['size'] > 2000000) { // Maksimal ukuran file: 2MB
        die("Error: Ukuran file terlalu besar (maksimal 2MB).");
    }

    // Baca isi file
    $fileContent = file_get_contents($file['tmp_name']);

    // Pindahkan file ke folder uploads
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Buat folder jika belum ada
    }
    $filePath = $uploadDir . basename($file['name']);
    move_uploaded_file($file['tmp_name'], $filePath);

    // Ambil informasi browser dan sistem operasi
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $browserName = getBrowser($userAgent); // Dapatkan nama browser
    $os = PHP_OS; // Sistem operasi

    // Simpan semua data ke session
    $_SESSION['data'] = [
        'name' => $name,
        'nim' => $nim,
        'email' => $email,
        'gender' => $gender,
        'fileContent' => $fileContent,
        'browser' => $browserName,
        'os' => $os,
    ];

    // Redirect ke halaman hasil
    header("Location: result.php");
    exit();
} else {
    echo "Error: Form harus diakses melalui metode POST.";
}
?>
