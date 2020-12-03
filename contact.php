<?php 
$con=mysqli_connect("localhost","root","","myhmsdb");
if(isset($_POST['btnSubmit']))
{
	$name = $_POST['txtName'];
	$email = $_POST['txtEmail'];
	$kontak = $_POST['txtPhone'];
	$message = $_POST['txtMsg'];

	$query="insert into kontak(name,email,kontak,message) values('$name','$email','$kontak','$message');";
	$result = mysqli_query($con,$query);
	
	if($result)
    {
    	echo '<script type="text/javascript">'; 
		echo 'alert("Message sent successfully!");'; 
		echo 'window.location.href = "kontak.html";';
		echo '</script>';
    }
}