<?php

$con = mysqli_connect("localhost", "root", "", "myhmsdb");
$username = $_POST['username'];
$nama = $_POST['nama'];
$password = md5($_POST['password']);
$id = $_POST['id_staff'];


mysqli_query($con, "UPDATE staff SET username='$username', nama='$nama', password='$password' WHERE id_staff = $id");

header("location:admin-panel1.php?pesan=update");
