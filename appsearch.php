<!DOCTYPE html>
 <?php #include("func.php");?>
<html>
<head>
	<title>Patient Details</title>
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

</head>
<body>
<?php
include("newfunc.php");
if(isset($_POST['app_search_submit']))
{
	$kontak=$_POST['app_kontak'];
	$query = "select * from appointment where kontak= '$kontak';";
  $result = mysqli_query($con,$query);
  $row=mysqli_fetch_array($result);
  if($row['fname']=="" & $row['lname']=="" & $row['email']=="" & $row['kontak']=="" & $row['dokter']=="" & $row['tarif']=="" & $row['tanggal']=="" & $row['waktu']==""){
    echo "<script> alert('No entries found! Please enter valid details'); 
          window.location.href = 'patient-panel1.php#list-doc';</script>";
  }
  else {
    echo "<div class='container-fluid' style='margin-top:50px;'>
    <div class='card'>
    <div class='card-body' style='background-color:#342ac1;color:#ffffff;'>
  <table class='table table-hover'>
    <thead>
      <tr>
        <th scope='col'>First Name</th>
        <th scope='col'>Last Name</th>
        <th scope='col'>Email</th>
        <th scope='col'>kontak</th>
        <th scope='col'>dokter Name</th>
        <th scope='col'>Consultancy Fees</th>
        <th scope='col'>Appointment Date</th>
        <th scope='col'>Appointment Time</th>
        <th scope='col'>Appointment Status</th>
      </tr>
    </thead>
    <tbody>";
  
    
          $fname = $row['fname'];
          $lname = $row['lname'];
          $email = $row['email'];
          $kontak = $row['kontak'];
          $dokter = $row['dokter'];
          $tarif= $row['tarif'];
          $tanggal= $row['tanggal'];
          $waktu = $row['waktu'];
          if(($row['status_pasien']==1) && ($row['status_dokter']==1))  
                    {
                      $appstatus = "Active";
                    }
                    if(($row['status_pasien']==0) && ($row['status_dokter']==1))  
                    {
                      $appstatus = "Cancelled by You";
                    }

                    if(($row['status_pasien']==1) && ($row['status_dokter']==0))  
                    {
                      $appstatus = "Cancelled by dokter";
                    }
          echo "<tr>
            <td>$fname</td>
            <td>$lname</td>
            <td>$email</td>
            <td>$kontak</td>
            <td>$dokter</td>
            <td>$tarif</td>
            <td>$tanggal</td>
            <td>$waktu</td>
            <td>$appstatus</td>
          </tr>";
    echo "</tbody></table><center><a href='patient-panel1.php' class='btn btn-light'>Back to your Dashboard</a></div></center></div></div></div>";
  }
  }
	
?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> 
</body>
</html>