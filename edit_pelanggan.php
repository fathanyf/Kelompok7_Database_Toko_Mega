<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class PelangganController {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function updatePelanggan($id, $id_pembelian, $nim_pelanggan, $id_barang, $qty, $tanggal_pesan, $id_pengguna) {
        $query = "UPDATE Pelanggan SET IdPembelian='$id_pembelian', NimPelanggan='$nim_pelanggan', IdBarang='$id_barang', Qty='$qty', TanggalPesan='$tanggal_pesan', IdPengguna='$id_pengguna' WHERE IdPelanggan=$id";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            header("Location: pelanggan.php");
            exit;
        } else {
            return "Error updating Pelanggan: " . mysqli_error($this->mysqli);
        }
    }

    public function getPelangganData($id) {
        $result = mysqli_query($this->mysqli, "SELECT * FROM Pelanggan WHERE IdPelanggan=$id");
        return mysqli_fetch_assoc($result);
    }
}


include_once("config.php");

$pelangganController = new PelangganController($mysqli);

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $id_pembelian = $_POST['id_pembelian'];
    $nim_pelanggan = $_POST['nim_pelanggan'];
    $id_barang = $_POST['id_barang'];
    $qty = $_POST['qty'];
    $tanggal_pesan = $_POST['tanggal_pesan'];
    $id_pengguna = $_POST['id_pengguna'];

    $message = $pelangganController->updatePelanggan($id, $id_pembelian, $nim_pelanggan, $id_barang, $qty, $tanggal_pesan, $id_pengguna);
}

$id = $_GET['id'];

$pelanggan_data = $pelangganController->getPelangganData($id);

if (!$pelanggan_data) {
    echo "Pelanggan data not found.";
    exit;
}

$id_pembelian = $pelanggan_data['IdPembelian'];
$nim_pelanggan = $pelanggan_data['NimPelanggan'];
$id_barang = $pelanggan_data['IdBarang'];
$qty = $pelanggan_data['Qty'];
$tanggal_pesan = $pelanggan_data['TanggalPesan'];
$id_pengguna = $pelanggan_data['IdPengguna'];
?>

<html>
<head>
    <title>Edit Pelanggan</title>
</head>

<body>
<a href="pelanggan.php"><button>Go to Pelanggan List</button></a>
<br/><br/>

<form name="update_pelanggan" method="post" action="edit_pelanggan.php">
    <table border="0">
        <tr> 
            <td>Id Pembelian</td>
            <td><input type="text" name="id_pembelian" value="<?php echo $id_pembelian; ?>"></td>
        </tr>
        <tr> 
            <td>Nama Pelanggan</td>
            <td><input type="text" name="nim_pelanggan" value="<?php echo $nim_pelanggan; ?>"></td>
        </tr>
        <tr> 
            <td>Id Barang</td>
            <td><input type="text" name="id_barang" value="<?php echo $id_barang; ?>"></td>
        </tr>
        <tr> 
            <td>Qty</td>
            <td><input type="text" name="qty" value="<?php echo $qty; ?>"></td>
        </tr>
        <tr> 
            <td>Tanggal Pesan</td>
            <td><input type="text" name="tanggal_pesan" value="<?php echo $tanggal_pesan; ?>"></td>
        </tr>
        <tr> 
            <td>Id Pengguna</td>
            <td><input type="text" name="id_pengguna" value="<?php echo $id_pengguna; ?>"></td>
        </tr>
        <tr>
            <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
            <td><input type="submit" name="update" value="Update Pelanggan"></td>
        </tr>
    </table>
</form>
</body>
</html>
