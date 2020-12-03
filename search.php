<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "myhmsdb");
if (isset($_POST['search_submit'])) {
  $search = $_POST['kontak'];
  $docname = $_SESSION['dname'];
  $query = "select * from search where ID like '%$search%' or pid like '%$search%' or fname like '%$search%' or lname like '%$search%' or gender like '%$search%' or email like '%$search%' or kontak like '%$search%'";
  $result = mysqli_query($con, $query);
  echo '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  </head>
  <body style="background-color:#342ac1;color:white;text-align:center;padding-top:50px;">
  <div class="container" style="text-align:left;">
  <center><h3>Hasil Pencarian</h3></center><br>
  <table class="table table-hover">
  <thead>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Kontak</th>
      <th>Tanggal</th>
      <th>Waktu</th>
    </tr>
  </thead>
  <tbody>
  ';
  while ($row = mysqli_fetch_array($result)) {
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $kontak = $row['kontak'];
    $tanggal = $row['tanggal'];
    $waktu = $row['waktu'];
    echo '<tr>
      <td>' . $fname . '</td>
      <td>' . $lname . '</td>
      <td>' . $email . '</td>
      <td>' . $kontak . '</td>
      <td>' . $tanggal . '</td>
      <td>' . $waktu . '</td>
    </tr>';
  }
  echo '</tbody></table></div> 
<div><a href="doctor-panel.php" class="btn btn-light">Go Back</a></div>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>';
}
