<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class PenjualanController {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function updatePenjualan($id, $jumlah_penjualan, $harga_penjualan) {
        $query = "UPDATE penjualan SET JumlahPenjualan='$jumlah_penjualan', HargaJual='$harga_penjualan' WHERE IdPenjualan=$id";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            header("Location: penjualan.php");
            exit;
        } else {
            return "Error updating Penjualan: " . mysqli_error($this->mysqli);
        }
    }

    public function getPenjualanData($id) {
        $result = mysqli_query($this->mysqli, "SELECT * FROM penjualan WHERE IdPenjualan=$id");
        return mysqli_fetch_assoc($result);
    }
}

// Create database connection using config file
include_once("config.php");

$penjualanController = new PenjualanController($mysqli);

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $jumlah_penjualan = $_POST['jumlah_penjualan'];
    $harga_penjualan = $_POST['harga_penjualan'];

    $message = $penjualanController->updatePenjualan($id, $jumlah_penjualan, $harga_penjualan);
}

$id = $_GET['id'];

$penjualan_data = $penjualanController->getPenjualanData($id);

if (!$penjualan_data) {
    echo "Penjualan data not found.";
    exit;
}

$jumlah_penjualan = $penjualan_data['JumlahPenjualan'];
$harga_penjualan = $penjualan_data['HargaJual'];
?>

<html>
<head>
    <title>Edit Penjualan</title>
</head>

<body>
<a href="penjualan.php">Go to Penjualan List</a>
<br/><br/>

<form name="update_penjualan" method="post" action="edit_penjualan.php">
    <table border="0">
        <tr> 
            <td>Jumlah Penjualan</td>
            <td><input type="text" name="jumlah_penjualan" value="<?php echo $jumlah_penjualan; ?>"></td>
        </tr>
        <tr> 
            <td>Harga Penjualan</td>
            <td><input type="text" name="harga_penjualan" value="<?php echo $harga_penjualan; ?>"></td>
        </tr>
        <tr>
            <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
            <td><input type="submit" name="update" value="Update Penjualan"></td>
        </tr>
    </table>
</form>
</body>
</html>
