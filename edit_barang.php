<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class BarangController {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function updateBarang($id, $nama_barang, $nama_depan, $nama_belakang, $keterangan, $satuan, $no_hp, $alamat, $id_pengguna, $id_akses) {
        $query = "UPDATE barang SET NamaBarang='$nama_barang', NamaDepan='$nama_depan', NamaBelakang='$nama_belakang', Keterangan='$keterangan', Satuan='$satuan', NoHp='$no_hp', Alamat='$alamat', IdPengguna='$id_pengguna', IdAkses='$id_akses' WHERE IdBarang=$id";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            header("Location: barang.php");
            exit;
        } else {
            return "Error updating Barang: " . mysqli_error($this->mysqli);
        }
    }

    public function getBarangData($id) {
        $result = mysqli_query($this->mysqli, "SELECT * FROM barang WHERE IdBarang=$id");
        return mysqli_fetch_assoc($result);
    }
}

// Create database connection using the config file
include_once("config.php");

$barangController = new BarangController($mysqli);

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama_barang = $_POST['nama_barang'];
    $nama_depan = $_POST['nama_depan'];
    $nama_belakang = $_POST['nama_belakang'];
    $keterangan = $_POST['keterangan'];
    $satuan = $_POST['satuan'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $id_pengguna = $_POST['id_pengguna'];
    $id_akses = $_POST['id_akses'];

    $message = $barangController->updateBarang($id, $nama_barang, $nama_depan, $nama_belakang, $keterangan, $satuan, $no_hp, $alamat, $id_pengguna, $id_akses);
}

$id = $_GET['id'];

$barang_data = $barangController->getBarangData($id);

if (!$barang_data) {
    echo "Barang data not found.";
    exit;
}

$nama_barang = $barang_data['NamaBarang'];
$nama_depan = $barang_data['NamaDepan'];
$nama_belakang = $barang_data['NamaBelakang'];
$keterangan = $barang_data['Keterangan'];
$satuan = $barang_data['Satuan'];
$no_hp = $barang_data['NoHp'];
$alamat = $barang_data['Alamat'];
$id_pengguna = $barang_data['IdPengguna'];
$id_akses = $barang_data['IdAkses'];
?>

<html>
<head>
    <title>Edit Barang</title>
</head>

<body>
<a href="barang.php"><button>Go to Barang List</button></a>
<br/><br/>

<form name="update_barang" method="post" action="edit_barang.php">
    <table border="0">
        <tr> 
            <td>Nama Barang</td>
            <td><input type="text" name="nama_barang" value="<?php echo $nama_barang; ?>"></td>
        </tr>
        <tr> 
            <td>Keterangan</td>
            <td><input type="text" name="keterangan" value="<?php echo $keterangan; ?>"></td>
        </tr>
        <tr> 
            <td>Satuan</td>
            <td><input type="text" name="satuan" value="<?php echo $satuan; ?>"></td>
        </tr>
        <tr> 
            <td>No HP</td>
            <td><input type="text" name="no_hp" value="<?php echo $no_hp; ?>"></td>
        </tr>
        <tr> 
            <td>Alamat</td>
            <td><input type="text" name="alamat" value="<?php echo $alamat; ?>"></td>
        </tr>
        <tr> 
            <td>Id Pengguna</td>
            <td><input type="text" name="id_pengguna" value="<?php echo $id_pengguna; ?>"></td>
        </tr>
        <tr> 
            <td>Id Akses</td>
            <td><input type="text" name="id_akses" value="<?php echo $id_akses; ?>"></td>
        </tr>
        <tr>
            <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
            <td><input type="submit" name="update" value="Update Barang"></td>
        </tr>
    </table>
</form>
</body>
</html>

