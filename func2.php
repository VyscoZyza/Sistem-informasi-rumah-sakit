<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "myhmsdb");
if (isset($_POST['patsub1'])) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];
  $kontak = $_POST['kontak'];
  $password = md5($_POST['password']);
  $cpassword = md5($_POST['cpassword']);
  if ($password == $cpassword) {
    $query = "insert into pasien(fname,lname,gender,email,kontak,password) values ('$fname','$lname','$gender','$email','$kontak','$password');";
    $result = mysqli_query($con, $query);
    if ($result) {
      echo ("<script>alert('Akun berhasil dibuat, silahkan login untuk melanjutkan');
          window.location.href = 'index1.php';</script>");
    } else {
      echo ("<script>alert('Terjadi kesalahan, silahkan coba lagi');
          window.location.href = 'index.php';</script>");
    }
  }
} else {
  header("Location:error1.php");
}
