<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class BarangController {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function addBarang($nama_barang, $nama_depan, $nama_belakang, $keterangan, $satuan, $no_hp, $alamat, $id_pengguna, $id_akses) {
        $query = "INSERT INTO barang (NamaBarang, NamaDepan, NamaBelakang, Keterangan, Satuan, NoHp, Alamat, IdPengguna, IdAkses) 
        VALUES ('$nama_barang', '$nama_depan', '$nama_belakang', '$keterangan', '$satuan', '$no_hp', '$alamat', '$id_pengguna', '$id_akses')";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            header("Location: barang.php");
            exit;
        } else {
            return "Error adding Barang: " . mysqli_error($this->mysqli);
        }
    }
}

include_once("config.php");

if (isset($_POST['Submit'])) {
    $nama_barang = $_POST['nama_barang'];
    $nama_depan = $_POST['nama_depan'];
    $nama_belakang = $_POST['nama_belakang'];
    $keterangan = $_POST['keterangan'];
    $satuan = $_POST['satuan'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $id_pengguna = $_POST['id_pengguna'];
    $id_akses = $_POST['id_akses'];

    $barangController = new BarangController($mysqli);
    $message = $barangController->addBarang($nama_barang, $nama_depan, $nama_belakang, $keterangan, $satuan, $no_hp, $alamat, $id_pengguna, $id_akses);

    echo $message;
}
?>

<html>
<head>
    <title>Add Barang</title>
</head>

<body>
<a href="barang.php"><button>Go to Barang List</button></a>
<br/><br/>

<form action="add_barang.php" method="post" name="form1">
    <table width="25%" border="0">
        <tr> 
            <td>Nama Barang</td>
            <td><input type="text" name="nama_barang"></td>
        </tr>
        <tr> 
            <td>Keterangan</td>
            <td><input type="text" name="keterangan"></td>
        </tr>
        <tr> 
            <td>Satuan</td>
            <td><input type="text" name="satuan"></td>
        </tr>
        <tr> 
            <td>No HP</td>
            <td><input type="text" name="no_hp"></td>
        </tr>
        <tr> 
            <td>Alamat</td>
            <td><input type="text" name="alamat"></td>
        </tr>
        <tr> 
            <td>IdPengguna</td>
            <td><input type="text" name="id_pengguna"></td>
        </tr>
        <tr> 
            <td>IdAkses</td>
            <td><input type="text" name="id_akses"></td>
        </tr>
        <tr> 
            <td></td>
            <td><input type="submit" name="Submit" value="Add Barang"></td>
        </tr>
    </table>
</form>
</body>
</html>
