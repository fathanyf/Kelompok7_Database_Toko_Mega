<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class PembelianDeleter {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function deletePembelian($id) {
        $query = "DELETE FROM pembelian WHERE IdPembelian=$id";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            header("Location: pembelian.php");
            exit;
        } else {
            return "Error deleting Pembelian: " . mysqli_error($this->mysqli);
        }
    }
}


include_once("config.php");

$pembelianDeleter = new PembelianDeleter($mysqli);

$id = $_GET['id'];
$message = $pembelianDeleter->deletePembelian($id);

if (!empty($message)) {
    echo $message;
}
?>

