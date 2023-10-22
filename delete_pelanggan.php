<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class PelangganDeleter {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function deletePelanggan($id) {
        $query = "DELETE FROM Pelanggan WHERE IdPelanggan=$id";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            header("Location: pelanggan.php");
            exit;
        } else {
            return "Error deleting Pelanggan: " . mysqli_error($this->mysqli);
        }
    }
}


include_once("config.php");

$pelangganDeleter = new PelangganDeleter($mysqli);

$id = $_GET['id'];
$message = $pelangganDeleter->deletePelanggan($id);

if (!empty($message)) {
    echo $message;
}
?>

