<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class PenjualanController {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function addPenjualan($jumlah_penjualan, $harga_penjualan) {
        $query = "INSERT INTO penjualan (JumlahPenjualan, HargaJual) VALUES('$jumlah_penjualan', '$harga_penjualan')";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            return "Penjualan added successfully. <a href='penjualan.php'>View Penjualan</a>";
        } else {
            return "Error adding Penjualan: " . mysqli_error($this->mysqli);
        }
    }
}

include_once("config.php");

if (isset($_POST['Submit'])) {
    $jumlah_penjualan = $_POST['jumlah_penjualan'];
    $harga_penjualan = $_POST['harga_penjualan'];

    $penjualanController = new PenjualanController($mysqli);
    $message = $penjualanController->addPenjualan($jumlah_penjualan, $harga_penjualan);

    echo $message;
}
?>

<html>
<head>
    <title>Add Penjualan</title>
</head>

<body>
<a href="penjualan.php">Go to Penjualan List</a>
<br/><br/>

<form action="add_penjualan.php" method="post" name="form1">
    <table width="25%" border="0">
        <tr> 
            <td>Jumlah Penjualan</td>
            <td><input type="text" name="jumlah_penjualan"></td>
        </tr>
        <tr> 
            <td>Harga Penjualan</td>
            <td><input type="text" name="harga_penjualan"></td>
        </tr>
        <tr> 
            <td></td>
            <td><input type="submit" name="Submit" value="Add Penjualan"></td>
        </tr>
    </table>
</form>
</body>
</html>
