<?php
session_start();
include "config.php";

if(!isset($_SESSION['user'])){
    header("location:login.php");
}

/* =====================
   TAMBAH PASIEN
===================== */
if(isset($_POST['tambah_pasien'])){
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    mysqli_query($conn,"INSERT INTO pasien VALUES(NULL,'$nama','$alamat','$no_hp')");
}

/* =====================
   EDIT PASIEN
===================== */
$edit_pasien = null;
if(isset($_GET['edit_pasien'])){
    $id = $_GET['edit_pasien'];
    $edit_pasien = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM pasien WHERE id='$id'"));
}

/* =====================
   UPDATE PASIEN
===================== */
if(isset($_POST['update_pasien'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    mysqli_query($conn,"UPDATE pasien SET nama='$nama',alamat='$alamat',no_hp='$no_hp' WHERE id='$id'");
}

/* =====================
   DELETE PASIEN
===================== */
if(isset($_GET['hapus_pasien'])){
    $id = $_GET['hapus_pasien'];
    mysqli_query($conn,"DELETE FROM pasien WHERE id='$id'");
}

/* =====================
   TAMBAH OBAT
===================== */
if(isset($_POST['tambah_obat'])){
    $nama_obat = $_POST['nama_obat'];
    $stok = $_POST['stok'];

    mysqli_query($conn,"INSERT INTO obat VALUES(NULL,'$nama_obat','$stok')");
}

/* =====================
   EDIT OBAT
===================== */
$edit_obat = null;
if(isset($_GET['edit_obat'])){
    $id = $_GET['edit_obat'];
    $edit_obat = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM obat WHERE id='$id'"));
}

/* =====================
   UPDATE OBAT
===================== */
if(isset($_POST['update_obat'])){
    $id = $_POST['id'];
    $nama_obat = $_POST['nama_obat'];
    $stok = $_POST['stok'];

    mysqli_query($conn,"UPDATE obat SET nama_obat='$nama_obat',stok='$stok' WHERE id='$id'");
}

/* =====================
   DELETE OBAT
===================== */
if(isset($_GET['hapus_obat'])){
    $id = $_GET['hapus_obat'];
    mysqli_query($conn,"DELETE FROM obat WHERE id='$id'");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard Puskesmas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f4f6f9;">

<div class="d-flex">

<!-- SIDEBAR -->
<div class="bg-success text-white p-3" style="width:220px; min-height:100vh;">
    <h4>Puskesmas</h4>
    <hr>
    <p>👤 <?= $_SESSION['user'] ?></p>

    <a href="#pasien" class="text-white d-block mb-2">📋 Pasien</a>
    <a href="#obat" class="text-white d-block mb-2">💊 Obat</a>
    <a href="logout.php" class="text-white d-block mt-4">🚪 Logout</a>
</div>

<!-- CONTENT -->
<div class="p-4 w-100">

<h2>Dashboard Puskesmas</h2>
<p class="text-muted">Sistem Data Pasien & Obat</p>

<!-- ================= PASIEN ================= -->
<div id="pasien" class="card p-3 mb-4">
<h4>Data Pasien</h4>

<form method="POST" class="mb-3">

<input type="hidden" name="id" value="<?= $edit_pasien['id'] ?? '' ?>">

<input name="nama" class="form-control mb-2" placeholder="Nama"
value="<?= $edit_pasien['nama'] ?? '' ?>">

<input name="alamat" class="form-control mb-2" placeholder="Alamat"
value="<?= $edit_pasien['alamat'] ?? '' ?>">

<input name="no_hp" class="form-control mb-2" placeholder="No HP"
value="<?= $edit_pasien['no_hp'] ?? '' ?>">

<?php if($edit_pasien){ ?>
<button name="update_pasien" class="btn btn-warning">Update</button>
<a href="dashboard.php" class="btn btn-secondary">Cancel</a>
<?php } else { ?>
<button name="tambah_pasien" class="btn btn-primary">Tambah</button>
<?php } ?>

</form>

<table class="table table-striped table-hover">
<tr class="table-dark">
<th>Nama</th><th>Alamat</th><th>No HP</th><th>Aksi</th>
</tr>

<?php
$q = mysqli_query($conn,"SELECT * FROM pasien");
while($d = mysqli_fetch_array($q)){
?>
<tr>
<td><?= $d['nama'] ?></td>
<td><?= $d['alamat'] ?></td>
<td><?= $d['no_hp'] ?></td>
<td>
<a href="?edit_pasien=<?= $d['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
<a href="?hapus_pasien=<?= $d['id'] ?>" class="btn btn-danger btn-sm"
onclick="return confirm('Hapus data pasien?')">Hapus</a>
</td>
</tr>
<?php } ?>
</table>
</div>

<!-- ================= OBAT ================= -->
<div id="obat" class="card p-3">
<h4>Data Obat</h4>

<form method="POST" class="mb-3">

<input type="hidden" name="id" value="<?= $edit_obat['id'] ?? '' ?>">

<input name="nama_obat" class="form-control mb-2" placeholder="Nama Obat"
value="<?= $edit_obat['nama_obat'] ?? '' ?>">

<input name="stok" class="form-control mb-2" placeholder="Stok"
value="<?= $edit_obat['stok'] ?? '' ?>">

<?php if($edit_obat){ ?>
<button name="update_obat" class="btn btn-warning">Update</button>
<a href="dashboard.php" class="btn btn-secondary">Cancel</a>
<?php } else { ?>
<button name="tambah_obat" class="btn btn-success">Tambah</button>
<?php } ?>

</form>

<table class="table table-striped table-hover">
<tr class="table-dark">
<th>Nama Obat</th><th>Stok</th><th>Aksi</th>
</tr>

<?php
$q = mysqli_query($conn,"SELECT * FROM obat");
while($o = mysqli_fetch_array($q)){
?>
<tr>
<td><?= $o['nama_obat'] ?></td>
<td><?= $o['stok'] ?></td>
<td>
<a href="?edit_obat=<?= $o['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
<a href="?hapus_obat=<?= $o['id'] ?>" class="btn btn-danger btn-sm"
onclick="return confirm('Hapus obat?')">Hapus</a>
</td>
</tr>
<?php } ?>
</table>

</div>

</div>
</div>

</body>
</html>