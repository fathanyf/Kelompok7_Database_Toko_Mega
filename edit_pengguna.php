<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class PenggunaController {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function updatePengguna($id, $nama_pengguna, $password, $hak_akses) {
        $query = "UPDATE pengguna SET NamaPengguna='$nama_pengguna', Password='$password', HakAkses='$hak_akses' WHERE IdPengguna=$id";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            header("Location: pengguna.php");
            exit;
        } else {
            return "Error updating Pengguna: " . mysqli_error($this->mysqli);
        }
    }

    public function getPenggunaData($id) {
        $result = mysqli_query($this->mysqli, "SELECT * FROM pengguna WHERE IdPengguna=$id");
        return mysqli_fetch_assoc($result);
    }
}

// Create database connection using config file
include_once("config.php");

$penggunaController = new PenggunaController($mysqli);

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama_pengguna = $_POST['nama_pengguna'];
    $password = $_POST['password'];
    $hak_akses = $_POST['hak_akses'];

    $message = $penggunaController->updatePengguna($id, $nama_pengguna, $password, $hak_akses);
}

$id = $_GET['id'];

$pengguna_data = $penggunaController->getPenggunaData($id);

if (!$pengguna_data) {
    echo "Pengguna data not found.";
    exit;
}

$nama_pengguna = $pengguna_data['NamaPengguna'];
$password = $pengguna_data['Password'];
$hak_akses = $pengguna_data['HakAkses'];
?>

<html>
<head>
    <title>Edit Pengguna</title>
</head>

<body>
<a href="pengguna.php">Go to Pengguna List</a>
<br/><br/>

<form name="update_pengguna" method="post" action="edit_pengguna.php">
    <table border="0">
        <tr> 
            <td>Nama Pengguna</td>
            <td><input type="text" name="nama_pengguna" value="<?php echo $nama_pengguna; ?>"></td>
        </tr>
        <tr> 
            <td>Password</td>
            <td><input type="text" name="password" value="<?php echo $password; ?>"></td>
        </tr>
        <tr> 
            <td>Hak Akses</td>
            <td><input type="text" name="hak_akses" value="<?php echo $hak_akses; ?>"></td>
        </tr>
        <tr>
            <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
            <td><input type="submit" name="update" value="Update Pengguna"></td>
        </tr>
    </table>
</form>
</body>
</html>
