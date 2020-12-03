<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "myhmsdb");
if (isset($_POST['adsub'])) {
	$username = $_POST['username1'];
	$password = md5($_POST['password2']);
	$query = "select * from staff where username='$username' and password='$password';";
	$result = mysqli_query($con, $query);
	if (mysqli_num_rows($result) == 1) {
		$_SESSION['username'] = $username;
		header("Location:staff-panel.php");
	} else
		echo ("<script>alert('Username atau password salah, silahkan coba lagi!');
          window.location.href = 'index.php';</script>");
}
