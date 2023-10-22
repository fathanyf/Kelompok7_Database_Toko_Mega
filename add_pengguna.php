<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class PenggunaController {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function addPengguna($nama_pengguna, $password, $hak_akses) {
        $query = "INSERT INTO pengguna (NamaPengguna, Password, HakAkses) VALUES('$nama_pengguna', '$password', '$hak_akses')";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            header("Location: pengguna.php");
            exit;
        } else {
            return "Error adding Pengguna: " . mysqli_error($this->mysqli);
        }
    }
}

include_once("config.php");

if (isset($_POST['Submit'])) {
    $nama_pengguna = $_POST['nama_pengguna'];
    $password = $_POST['password'];
    $hak_akses = $_POST['hak_akses'];

    $penggunaController = new PenggunaController($mysqli);
    $message = $penggunaController->addPengguna($nama_pengguna, $password, $hak_akses);

    echo $message;
}
?>

<html>
<head>
    <title>Add Pengguna</title>
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById('password');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
    </script>
</head>

<body>
<a href="pengguna.php"><button>Go to Pengguna List</button></a>
<br/><br/>

<form action="add_pengguna.php" method="post" name="form1">
    <table width="25%" border="0">
        <tr> 
            <td>Nama Pengguna</td>
            <td><input type="text" name="nama_pengguna"></td>
        </tr>
        <tr> 
            <td>Password</td>
            <td>
                <input type="password" id="password" name="password">
                <button type="button" onclick="togglePasswordVisibility()">Show Password</button>
            </td>
        </tr>
        <tr> 
            <td>IdAkses</td>
            <td><input type="text" name="hak_akses"></td>
        </tr>
        <tr> 
            <td></td>
            <td><input type="submit" name="Submit" value="Add Pengguna"></td>
        </tr>
    </table>
</form>
</body>
</html>
