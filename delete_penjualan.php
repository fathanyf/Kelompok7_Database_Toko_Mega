<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class PenjualanDeleter {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function deletePenjualan($id) {
        $query = "DELETE FROM penjualan WHERE IdPenjualan=$id";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            header("Location: penjualan.php");
            exit;
        } else {
            return "Error deleting Penjualan: " . mysqli_error($this->mysqli);
        }
    }
}

// Create database connection using config file
include_once("config.php");

$penjualanDeleter = new PenjualanDeleter($mysqli);

$id = $_GET['id'];

$message = $penjualanDeleter->deletePenjualan($id);
?>