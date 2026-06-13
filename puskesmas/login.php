<?php
session_start();
include "config.php";

if(isset($_POST['login'])){
    $u = $_POST['username'];
    $p = $_POST['password'];
    $s = $_POST['status'];

    $q = mysqli_query($conn,
    "SELECT * FROM users WHERE username='$u' AND password='$p' AND status='$s'");

    if(mysqli_num_rows($q) > 0){
        $_SESSION['user']=$u;
        header("location:dashboard.php");
    } else {
        echo "Login gagal!";
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
<h3>Login</h3>

<form method="POST">
<input name="username" class="form-control mb-2" placeholder="Username">
<input name="password" type="password" class="form-control mb-2" placeholder="Password">

<select name="status" class="form-control mb-2">
<option>Admin</option>
<option>User</option>
</select>

<button name="login" class="btn btn-success">Login</button>
</form>

<a href="register.php">Register</a>
</div>