<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "myhmsdb");
if (isset($_POST['adsub'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$query = "select * from admin where username='$username' and password='$password';";
	$result = mysqli_query($con, $query);
	if (mysqli_num_rows($result) == 1) {
		$_SESSION['username'] = $username;
		header("Location:admin-panel1.php");
	} else
		// header("Location:error2.php");
		echo ("<script>alert('Username atau password salah, coba lagi!');
          window.location.href = 'index.php';</script>");
}
