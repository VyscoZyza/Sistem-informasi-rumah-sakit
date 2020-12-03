<?php
session_start();
$con=mysqli_connect("localhost","root","","myhmsdb");
if(isset($_POST['docsub1'])){
	$dname=$_POST['username3'];
	$dpass=md5($_POST['password3']);
	$query="select * from dokter where username='$dname' and password='$dpass';";
	$result=mysqli_query($con,$query);
	if(mysqli_num_rows($result)==1)
	{
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    
		      $_SESSION['dname']=$row['username'];
      
    }
		header("Location:doctor-panel.php");
	}
	else{
    echo("<script>alert('Username atau password salah, silahkan coba lagi!');
          window.location.href = 'index.php';</script>");
  }
}
