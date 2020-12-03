<?php
session_start();
$con=mysqli_connect("localhost","root","","myhmsdb");
if(isset($_POST['patsub'])){
	$email=$_POST['email'];
	$password=md5($_POST['password2']);
	$query="select * from pasien where email='$email' and password='$password';";
	$result=mysqli_query($con,$query);
	if(mysqli_num_rows($result)==1)
	{
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
      $_SESSION['pid'] = $row['pid'];
      $_SESSION['username'] = $row['fname']." ".$row['lname'];
      $_SESSION['fname'] = $row['fname'];
      $_SESSION['lname'] = $row['lname'];
      $_SESSION['gender'] = $row['gender'];
      $_SESSION['kontak'] = $row['kontak'];
      $_SESSION['email'] = $row['email'];
    }
		header("Location:patient-panel.php");
	}
  else {
    echo("<script>alert('Email atau password salah, silahkan coba lagi!');
          window.location.href = 'index1.php';</script>");
  }
		
}
