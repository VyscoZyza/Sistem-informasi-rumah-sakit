<?php
// session_start();
$con=mysqli_connect("localhost","root","","myhmsdb");
// if(isset($_POST['submit'])){
//  $username=$_POST['username'];
//  $password=$_POST['password'];
//  $query="select * from logintb where username='$username' and password='$password';";
//  $result=mysqli_query($con,$query);
//  if(mysqli_num_rows($result)==1)
//  {
//   $_SESSION['username']=$username;
//   $_SESSION['pid']=
//   header("Location:patient-panel.php");
//  }
//  else
//   header("Location:error.php");
// }
if(isset($_POST['update_data']))
{
 $kontak=$_POST['kontak'];
 $status=$_POST['status'];
 $query="update appointment set payment='$status' where kontak='$kontak';";
 $result=mysqli_query($con,$query);
 if($result)
  header("Location:updated.php");
}

// function display_docs()
// {
//  global $con;
//  $query="select * from dokter";
//  $result=mysqli_query($con,$query);
//  while($row=mysqli_fetch_array($result))
//  {
//   $username=$row['username'];
//   $price=$row['tarif'];
//   echo '<option value="' .$username. '" data-value="'.$price.'">'.$username.'</option>';
//  }
// }


function display_spesialiss() {
  global $con;
  $query="select distinct(spesialis) from dokter";
  $result=mysqli_query($con,$query);
  while($row=mysqli_fetch_array($result))
  {
    $spesialis=$row['spesialis'];
    echo '<option data-value="'.$spesialis.'">'.$spesialis.'</option>';
  }
}

function display_docs()
{
 global $con;
 $query = "select * from dokter";
 $result = mysqli_query($con,$query);
 while( $row = mysqli_fetch_array($result) )
 {
  $username = $row['username'];
  $price = $row['tarif'];
  $spesialis = $row['spesialis'];
  echo '<option value="' .$username. '" data-value="'.$price.'" data-spesialis="'.$spesialis.'">'.$username.'</option>';
 }
}

// function display_spesialiss() {
//   global $con;
//   $query = "select distinct(spesialis) from dokter";
//   $result = mysqli_query($con,$query);
//   while($row = mysqli_fetch_array($result))
//   {
//     $spesialis = $row['spesialis'];
//     $username = $row['username'];
//     echo '<option value = "' .$spesialis. '">'.$spesialis.'</option>';
//   }
// }


if(isset($_POST['doc_sub']))
{
 $username=$_POST['username'];
 $query="insert into dokter(username)values('$username')";
 $result=mysqli_query($con,$query);
 if($result)
  header("Location:adddoc.php");
}

?>