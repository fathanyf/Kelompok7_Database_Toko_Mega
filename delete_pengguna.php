<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class PenggunaDeleter {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function deletePengguna($id) {
        $query = "DELETE FROM pengguna WHERE IdPengguna=$id";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            header("Location: pengguna.php");
            exit;
        } else {
            echo "Error deleting Pengguna: " . mysqli_error($this->mysqli);
        }
    }
}

include_once("config.php");

$penggunaDeleter = new PenggunaDeleter($mysqli);

$id = $_GET['id'];

$message = $penggunaDeleter->deletePengguna($id);
?>

