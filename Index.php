<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Toko Mega</title>
</head>
<body bgcolor="007fff">

<h1>Database Toko Mega</h1>
<h2>Kelompok 7</h2>
<p><b>Ezekiel Philemon - 2602336031 Fathan Yuda Febrianda - 2602340741</b></p> <br>
<p><b>Novendi Lir Pratikta – 2602222774 WheniWelanda - 2602212344</b></p> <br>
<p><b>Iman Susanto – 2602219325</b></p>

<a href="HakAkses.php"><button>Hak Akses</button></a>
<a href="penjualan.php"><button>Penjualan</button></a>
<a href="pembelian.php"><button>Pembelian</button></a>
<a href="pengguna.php"><button>Pengguna</button></a>
<a href="barang.php"><button>Barang</button></a>
<br>
<br>
<a href="pelanggan.php"><button>Pelanggan</button></a>
<a href="supplier.php"><button>Supplier</button></a>
<a href="pengitungan.php"><button>Hitungan</button></a>
<a href="logout.php"><button>Logout</button></a>

</body>
</html>

