<?php
$hostname = 'localhost'; // Ganti dengan nama host MySQL Anda
$username = 'root'; // Ganti dengan nama pengguna MySQL Anda
$password = ''; // Ganti dengan kata sandi MySQL Anda
$database = 'vigenere'; // Ganti dengan nama database Anda

// Membuat koneksi ke MySQL
$conn = new mysqli($hostname, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>
