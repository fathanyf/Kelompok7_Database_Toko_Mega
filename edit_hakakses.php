<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class HakAksesController {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function updateHakAkses($id, $nama_akses, $keterangan) {
        $query = "UPDATE hakakses SET NamaAkses='$nama_akses', Keterangan='$keterangan' WHERE IdAkses=$id";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            header("Location: hakakses.php");
            exit;
        } else {
            return "Error updating Hak Akses: " . mysqli_error($this->mysqli);
        }
    }

    public function getHakAksesData($id) {
        $result = mysqli_query($this->mysqli, "SELECT * FROM hakakses WHERE IdAkses=$id");
        return mysqli_fetch_assoc($result);
    }
}

// Create database connection using config file
include_once("config.php");

$hakaksesController = new HakAksesController($mysqli);

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama_akses = $_POST['nama_akses'];
    $keterangan = $_POST['keterangan'];

    $message = $hakaksesController->updateHakAkses($id, $nama_akses, $keterangan);
}

$id = $_GET['id'];

$hakakses_data = $hakaksesController->getHakAksesData($id);

if (!$hakakses_data) {
    echo "Hak Akses data not found.";
    exit;
}

$nama_akses = $hakakses_data['NamaAkses'];
$keterangan = $hakakses_data['Keterangan'];
?>

<html>
<head>
    <title>Edit Hak Akses</title>
</head>

<body>
<a href="hakakses.php">Go to Hak Akses List</a>
<br/><br/>

<form name="update_hakakses" method="post" action="edit_hakakses.php">
    <table border="0">
        <tr> 
            <td>Nama Akses</td>
            <td><input type="text" name="nama_akses" value="<?php echo $nama_akses; ?>"></td>
        </tr>
        <tr> 
            <td>Keterangan</td>
            <td><input type="text" name="keterangan" value="<?php echo $keterangan; ?>"></td>
        </tr>
        <tr>
            <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
            <td><input type="submit" name="update" value="Update Hak Akses"></td>
        </tr>
    </table>
</form>
</body>
</html>
