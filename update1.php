<?php

$con = mysqli_connect("localhost", "root", "", "myhmsdb");
$dokter = $_SESSION['dname'];
$diagnosa = $_POST['diagnosa'];
$alergi = $_POST['alergi'];
$pid = $_POST['pid'];
$ID = $_POST['ID'];
$resep = $_POST['resep'];
$status = "Belum melakukan pembayaran";


mysqli_query($con, "insert into laporan(dokter,pid,ID, diagnosa,alergi, resep, status_pembayaran) values ('$dokter','$pid','$ID','$diagnosa','$alergi','$resep', '$status')");

header("location:doctor-panel.php");
