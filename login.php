<link rel="stylesheet" type="text/css" href="style.css">
<?php
// Import koneksi database
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Ambil kata sandi terenkripsi dari database berdasarkan username
    $sql = "SELECT password FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $encrypted_password = $row["password"];

        // Implementasi Vigenere Cipher untuk dekripsi (Anda harus mengganti ini dengan algoritma yang sesuai)
        $decrypted_password = vigenere_decrypt($encrypted_password, "selasa");

        if ($password == $decrypted_password) {
            echo "Login berhasil.";
        } else {
            echo "Kata sandi salah.";
        }
    } else {
        echo "Pengguna tidak ditemukan.";
    }
}

function vigenere_decrypt($text, $key) {
    $text = strtoupper($text);
    $key = strtoupper($key);
    $result = "";
    $keyLength = strlen($key);
    $keyIndex = 0;

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        if (ctype_alpha($char)) {
            $textChar = ord($char) - 65;
            $keyChar = ord($key[$keyIndex % $keyLength]) - 65;
            $encryptedChar = ($textChar + $keyChar) % 26 + 65;
            $result .= chr($encryptedChar);
            $keyIndex++;
        } else {
            $result .= $char;
        }
    }

    return $result;
}

?>
<!-- HTML form untuk login -->

<!DOCTYPE html>
<html>
<head>
    <title>Login Pengguna</title>
</head>
<body>
    <h2>Login Pengguna</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
