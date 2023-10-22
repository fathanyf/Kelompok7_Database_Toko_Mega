<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class PelangganManager {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function addPelanggan($id_pembelian, $nim_pelanggan, $id_barang, $qty, $tanggal_pesan, $id_pengguna) {
        $query = "INSERT INTO Pelanggan (IdPembelian, NimPelanggan, IdBarang, Qty, TanggalPesan, IdPengguna) VALUES('$id_pembelian', '$nim_pelanggan', '$id_barang', '$qty', '$tanggal_pesan', '$id_pengguna')";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            header("Location: pelanggan.php");
            exit;
        } else {
            return "Error adding Pelanggan: " . mysqli_error($this->mysqli);
        }
    }
}

// Create database connection using config file
include_once("config.php");

$pelangganManager = new PelangganManager($mysqli);

if (isset($_POST['Submit'])) {
    $id_pembelian = $_POST['id_pembelian'];
    $nim_pelanggan = $_POST['nim_pelanggan'];
    $id_barang = $_POST['id_barang'];
    $qty = $_POST['qty'];
    $tanggal_pesan = $_POST['tanggal_pesan'];
    $id_pengguna = $_POST['id_pengguna'];

    $message = $pelangganManager->addPelanggan($id_pembelian, $nim_pelanggan, $id_barang, $qty, $tanggal_pesan, $id_pengguna);

    echo $message;
}
?>

<html>
<head>
    <title>Add Pelanggan</title>
</head>

<body>
<a href="pelanggan.php">Go to Pelanggan List</a>
<br/><br/>

<form action="add_pelanggan.php" method="post" name="form1">
    <table width="25%" border="0">
        <tr> 
            <td>Id Pembelian</td>
            <td><input type="text" name="id_pembelian"></td>
        </tr>
        <tr> 
            <td>Nim Pelanggan</td>
            <td><input type="text" name="nim_pelanggan"></td>
        </tr>
        <tr> 
            <td>Id Barang</td>
            <td><input type="text" name="id_barang"></td>
        </tr>
        <tr> 
            <td>Qty</td>
            <td><input type="text" name="qty"></td>
        </tr>
        <tr> 
            <td>Tanggal Pesan</td>
            <td><input type="text" name="tanggal_pesan"></td>
        </tr>
        <tr> 
            <td>Id Pengguna</td>
            <td><input type="text" name="id_pengguna"></td>
        </tr>
        <tr> 
            <td></td>
            <td><input type="submit" name="Submit" value="Add Pelanggan"></td>
        </tr>
    </table>
</form>
</body>
</html>
