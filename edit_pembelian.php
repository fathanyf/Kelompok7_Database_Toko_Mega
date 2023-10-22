<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class PembelianManager {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function updatePembelian($id, $jumlah_pembelian, $harga_pembelian) {
        if (isset($_POST['update'])) {
            $query = "UPDATE pembelian SET JumlahPembelian='$jumlah_pembelian', HargaBeli='$harga_pembelian' WHERE IdPembelian=$id";
            $result = mysqli_query($this->mysqli, $query);

            if ($result) {
                header("Location: pembelian.php");
                exit;
            } else {
                echo "Error updating Pembelian: " . mysqli_error($this->mysqli);
            }
        }
    }

    public function getPembelianData($id) {
        $result = mysqli_query($this->mysqli, "SELECT * FROM pembelian WHERE IdPembelian=$id");

        if ($result) {
            $pembelian_data = mysqli_fetch_array($result);
            if ($pembelian_data) {
                return $pembelian_data;
            } else {
                echo "Pembelian data not found.";
                exit;
            }
        } else {
            echo "Error retrieving Pembelian data: " . mysqli_error($this->mysqli);
            exit;
        }
    }
}

// Create database connection using config file
include_once("config.php");

$pembelianManager = new PembelianManager($mysqli);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $pembelian_data = $pembelianManager->getPembelianData($id);

    $jumlah_pembelian = isset($_POST['jumlah_pembelian']) ? $_POST['jumlah_pembelian'] : $pembelian_data['JumlahPembelian'];
    $harga_pembelian = isset($_POST['harga_pembelian']) ? $_POST['harga_pembelian'] : $pembelian_data['HargaBeli'];

    $pembelianManager->updatePembelian($id, $jumlah_pembelian, $harga_pembelian);
} else {
    echo "No 'id' parameter provided in the URL.";
}
?>

<html>
<head>
    <title>Edit Pembelian</title>
</head>

<body>
<a href="pembelian.php">Go to Pembelian List</a>
<br/><br/>

<?php if (isset($_GET['id'])) { ?>
    <form name="update_pembelian" method="post" action="edit_pembelian.php?id=<?php echo $id; ?>">
        <table border="0">
            <tr>
                <td>Jumlah Pembelian</td>
                <td><input type="text" name="jumlah_pembelian" value="<?php echo $jumlah_pembelian; ?>"></td>
            </tr>
            <tr>
                <td>Harga Pembelian</td>
                <td><input type="text" name="harga_pembelian" value="<?php echo $harga_pembelian; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
                <td><input type="submit" name="update" value="Update Pembelian"></td>
            </tr>
        </table>
    </form>
<?php } ?>
</body>
</html>
