<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class PembelianManager {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function addPembelian($jumlah_pembelian, $harga_pembelian) {
        $query = "INSERT INTO pembelian (JumlahPembelian, HargaBeli) VALUES('$jumlah_pembelian', '$harga_pembelian')";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            // Redirect to pembelian.php
            header("Location: pembelian.php");
            exit;
        } else {
            return "Error adding Pembelian: " . mysqli_error($this->mysqli);
        }
    }
}

// Create database connection using config file
include_once("config.php");

$pembelianManager = new PembelianManager($mysqli);

if (isset($_POST['Submit'])) {
    $jumlah_pembelian = $_POST['jumlah_pembelian'];
    $harga_pembelian = $_POST['harga_pembelian'];

    $message = $pembelianManager->addPembelian($jumlah_pembelian, $harga_pembelian);
}
?>


<html>
<head>
    <title>Add Pembelian</title>
</head>

<body>
<a href="pembelian.php"><button>Go to Pembelian List</button></a>
<br/><br/>

<form action="add_pembelian.php" method="post" name="form1">
    <table width="25%" border="0">
        <tr> 
            <td>Jumlah Pembelian</td>
            <td><input type="text" name="jumlah_pembelian"></td>
        </tr>
        <tr> 
            <td>Harga Pembelian</td>
            <td><input type="text" name="harga_pembelian"></td>
        </tr>
        <tr> 
            <td></td>
            <td><input type="submit" name="Submit" value="Add Pembelian"></td>
        </tr>
    </table>
</form>
</body>
</html>
