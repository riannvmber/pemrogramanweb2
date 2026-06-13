<?php
include "config.php";

if(isset($_POST['register'])){
    $u = $_POST['username'];
    $p = $_POST['password'];
    $s = $_POST['status'];

    mysqli_query($conn,
    "INSERT INTO users VALUES(NULL,'$u','$p','$s')");

    echo "Register berhasil!";
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
<h3>Register</h3>

<form method="POST">

<input name="username" class="form-control mb-2" placeholder="Username">
<input name="password" class="form-control mb-2" type="password" placeholder="Password">

<select name="status" class="form-control mb-2">
<option>Admin</option>
<option>User</option>
</select>

<button name="register" class="btn btn-primary">Register</button>

</form>

<a href="login.php">Login</a>
</div>