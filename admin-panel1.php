<!DOCTYPE html>
<?php
$con = mysqli_connect("localhost", "root", "", "myhmsdb");

include('newfunc.php');

if (isset($_POST['docsub'])) {
  $dokter = $_POST['dokter'];
  $dpassword = md5($_POST['dpassword']);
  $demail = $_POST['demail'];
  $spesialis = $_POST['spesialisial'];
  $tarif = $_POST['tarif'];
  $query = "insert into dokter(username,password,email,spesialis,tarif)values('$dokter','$dpassword','$demail','$spesialis','$tarif')";
  $result = mysqli_query($con, $query);
  if ($result) {
    echo "<script>alert('Dokter berhasil ditambahkan!');</script>";
  }
}


if (isset($_POST['docsub1'])) {
  $demail = $_POST['demail'];
  $query = "delete from dokter where email='$demail';";
  $result = mysqli_query($con, $query);
  if ($result) {
    echo "<script>alert('Dokter berhasil dihapus!');</script>";
  } else {
    echo "<script>alert('tidak bisa menghapus!');</script>";
  }
}
if (isset($_POST['stafsub'])) {
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $dpassword = md5($_POST['dpassword']);
  $query = "insert into staff(username,nama,password)values('$username','$nama','$dpassword')";
  $result = mysqli_query($con, $query);
  if ($result) {
    echo "<script>alert('Staff berhasil ditambahkan!');</script>";
  }
}
if (isset($_POST['stafsub1'])) {
  $username = $_POST['username'];
  $query = "delete from staff where username='$username';";
  $result = mysqli_query($con, $query);
  if ($result) {
    echo "<script>alert('Staff berhasil dihapus!');</script>";
  } else {
    echo "<script>alert('tidak bisa menghapus!');</script>";
  }
}

?>
<html lang="en">

<head>


  <title>Rumah Sakit Karya SBD</title>
  <meta charset="utf-8">
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css">

  <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <a class="navbar-brand" href="#"> Rumah Sakit Karya SBD </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <script>
      var check = function() {
        if (document.getElementById('dpassword').value ==
          document.getElementById('cdpassword').value) {
          document.getElementById('message').style.color = '#5dd05d';
          document.getElementById('message').innerHTML = 'Password Sesuai';
        } else {
          document.getElementById('message').style.color = '#f55252';
          document.getElementById('message').innerHTML = 'Password Tidak Sesuai';
        }
      }

      function alphaOnly(event) {
        var key = event.keyCode;
        return ((key >= 65 && key <= 90) || key == 8 || key == 32);
      };
    </script>

    <style>
      .bg-primary {
        background: -webkit-linear-gradient(left, #3931af, #00c6ff);
      }

      .col-md-4 {
        max-width: 20% !important;
      }

      .list-group-item.active {
        z-index: 2;
        color: #fff;
        background-color: #342ac1;
        border-color: #007bff;
      }

      .text-primary {
        color: #342ac1 !important;
      }

      #cpass {
        display: -webkit-box;
      }

      #list-app {
        font-size: 15px;
      }

      .btn-primary {
        background-color: #3c50c1;
        border-color: #3c50c1;
      }
    </style>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="logout1.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"></a>
        </li>
      </ul>
    </div>
  </nav>
</head>
<style type="text/css">
  button:hover {
    cursor: pointer;
  }

  #inputbtn:hover {
    cursor: pointer;
  }
</style>

<body style="padding-top:50px;">
  <div class="container-fluid" style="margin-top:50px;">
    <h3 style="margin-left: 40%; padding-bottom: 20px;font-family: 'IBM Plex Sans', sans-serif;"> Selamat Datang Admin! </h3>
    <div class="row">
      <div class="col-md-4" style="max-width:25%;margin-top: 3%;">
        <div class="list-group" id="list-tab" role="tablist">
          <a class="list-group-item list-group-item-action active" id="list-dash-list" data-toggle="list" href="#list-dash" role="tab" aria-controls="home">Dashboard</a>
          <a class="list-group-item list-group-item-action" href="#list-doc" id="list-doc-list" role="tab" aria-controls="home" data-toggle="list">List Dokter</a>
          <a class="list-group-item list-group-item-action" href="#list-vstaff" id="list-vstaff-list" role="tab" aria-controls="home" data-toggle="list">List Staff</a>
          <a class="list-group-item list-group-item-action" href="#list-pat" id="list-pat-list" role="tab" data-toggle="list" aria-controls="home">List Pasien</a>
          <a class="list-group-item list-group-item-action" href="#list-app" id="list-app-list" role="tab" data-toggle="list" aria-controls="home">Detail Konsultasi</a>
          <a class="list-group-item list-group-item-action" href="#list-pres" id="list-pres-list" role="tab" data-toggle="list" aria-controls="home">Daftar Resep</a>
          <a class="list-group-item list-group-item-action" href="#list-settings" id="list-adoc-list" role="tab" data-toggle="list" aria-controls="home">Tambah Dokter</a>
          <a class="list-group-item list-group-item-action" href="#list-settings1" id="list-ddoc-list" role="tab" data-toggle="list" aria-controls="home">Hapus Dokter</a>
          <a class="list-group-item list-group-item-action" href="#list-staff" id="list-astaf-list" role="tab" data-toggle="list" aria-controls="home">Tambah Staff</a>
          <a class="list-group-item list-group-item-action" href="#list-staff1" id="list-dstaf-list" role="tab" data-toggle="list" aria-controls="home">Hapus Staff</a>

        </div><br>
      </div>
      <div class="col-md-8" style="margin-top: 3%;">
        <div class="tab-content" id="nav-tabContent" style="width: 950px;">



          <div class="tab-pane fade show active" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">
            <div class="container-fluid container-fullw bg-white">
              <div class="row">
                <div class="col-sm-4">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-users fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;">List Dokter</h4>
                      <script>
                        function clickDiv(id) {
                          document.querySelector(id).click();
                        }
                      </script>
                      <p class="links cl-effect-1">
                        <a href="#list-doc" onclick="clickDiv('#list-doc-list')">
                          Lihat Dokter
                        </a>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-users fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;">List Staff</h4>
                      <script>
                        function clickDiv(id) {
                          document.querySelector(id).click();
                        }
                      </script>
                      <p class="links cl-effect-1">
                        <a href="#list-doc" onclick="clickDiv('#list-staff-list')">
                          Lihat Staff
                        </a>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-users fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;">List Pasien</h4>

                      <p class="cl-effect-1">
                        <a href="#app-hist" onclick="clickDiv('#list-pat-list')">
                          Lihat Pasien
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-4" style="margin-top: 5%;">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-list-ul fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;">Daftar Resep</h4>

                      <p class="cl-effect-1">
                        <a href="#list-pres" onclick="clickDiv('#list-pres-list')">
                          Lihat Resep
                        </a>
                      </p>
                    </div>
                  </div>
                </div>


                <div class="col-sm-4" style="margin-top: 5%">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-plus fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;">Pengaturan Dokter</h4>

                      <p class="cl-effect-1">
                        <a href="#app-hist" onclick="clickDiv('#list-adoc-list')">Tambah Dokter</a>
                        <a href="#app-hist" onclick="clickDiv('#list-ddoc-list')">Hapus Dokter</a>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4" style="margin-top: 5%">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-plus fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;">Pengaturan Staff</h4>

                      <p class="cl-effect-1">
                        <a href="#app-hist" onclick="clickDiv('#list-astaf-list')">Tambah Staff</a>

                        <a href="#app-hist" onclick="clickDiv('#list-dstaf-list')">
                          Hapus Staff
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row" style="margin-top:5%">
                <div class="col-sm-4">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;">Detail Konsultasi</h4>

                      <p class="cl-effect-1">
                        <a href="#app-hist" onclick="clickDiv('#list-app-list')">
                          Lihat Konsultasi
                        </a>
                      </p>
                    </div>
                  </div>
                </div>

              </div>




            </div>
          </div>


          <div class="tab-pane fade" id="list-doc" role="tabpanel" aria-labelledby="list-home-list">


            <div class="col-md-8">
              <form class="form-group" action="doctorsearch.php" method="post">
                <div class="row">
                  <div class="col-md-10"><input type="text" name="dokter_kontak" placeholder="Cari" class="form-control"></div>
                  <div class="col-md-2"><input type="submit" name="dokter_search_submit" class="btn btn-primary" value="Cari"></div>
                </div>
              </form>
            </div>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Nama Dokter</th>
                  <th scope="col">Spealisasi</th>
                  <th scope="col">Email</th>
                  <th scope="col">Tarif</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                global $con;
                $query = "select * from dokter";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {
                  $username = $row['username'];
                  $spesialis = $row['spesialis'];
                  $email = $row['email'];
                  $tarif = $row['tarif'];
                ?>
                  <tr>
                    <td scope="col" class="pt-3-half"><?php echo $username; ?></td>
                    <td scope="col" class="pt-3-half"><?php echo $spesialis; ?></td>
                    <td scope="col" class="pt-3-half"><?php echo $email; ?></td>
                    <td scope="col" class="pt-3-half"><?php echo $tarif; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <br>
          </div>
          <div class="tab-pane fade" id="list-vstaff" role="tabpanel" aria-labelledby="list-vstaff-list">


            <div class="col-md-8">
            </div>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">ID Staff</th>
                  <th scope="col">Username</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                global $con;
                $query = "select * from staff";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {
                  $sid = $row['id_staff'];
                  $username = $row['username'];
                  $nama = $row['nama'];

                ?>
                  <tr>
                    <td scope="col" class="pt-3-half"><?php echo $sid; ?></td>
                    <td scope="col" class="pt-3-half"><?php echo $username; ?></td>
                    <td scope="col" class="pt-3-half"><?php echo $nama; ?></td>
                    <td>
                      <a href="edit.php?id_staff=<?php echo $row['id_staff']; ?>" class="btn btn-warning btn-rounded btn-sm my-0">Edit</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <br>
          </div>


          <div class="tab-pane fade" id="list-pat" role="tabpanel" aria-labelledby="list-pat-list">

            <div class="col-md-8">
              <form class="form-group" action="patientsearch.php" method="post">
                <div class="row">
                  <div class="col-md-10"><input type="text" name="patient_kontak" placeholder="Cari" class="form-control"></div>
                  <div class="col-md-2"><input type="submit" name="patient_search_submit" class="btn btn-primary" value="Search"></div>
                </div>
              </form>
            </div>

            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">ID Pasien</th>
                  <th scope="col">Nama Depan</th>
                  <th scope="col">Nama Belakang</th>
                  <th scope="col">Jenis Kelamin</th>
                  <th scope="col">Email</th>
                  <th scope="col">Kontak</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                global $con;
                $query = "select * from pasien";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {
                  $pid = $row['pid'];
                  $fname = $row['fname'];
                  $lname = $row['lname'];
                  $gender = $row['gender'];
                  $email = $row['email'];
                  $kontak = $row['kontak'];

                  echo "<tr>
                        <td>$pid</td>
                        <td>$fname</td>
                        <td>$lname</td>
                        <td>$gender</td>
                        <td>$email</td>
                        <td>$kontak</td>
                      </tr>";
                }

                ?>
              </tbody>
            </table>
            <br>
          </div>


          <div class="tab-pane fade" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">

            <div class="col-md-8">

              <div class="row">



                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">dokter</th>
                      <th scope="col">ID Pasien</th>
                      <th scope="col">ID</th>
                      <th scope="col">Nama Depan</th>
                      <th scope="col">Nama Belakang</th>
                      <th scope="col">Tanggal</th>
                      <th scope="col">Waktu</th>
                      <th scope="col">Diagnosa</th>
                      <th scope="col">Alergi</th>
                      <th scope="col">Resep</th>
                      <th scope="col">Status Pembayaran</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                    global $con;
                    $query = "SELECT l.dokter, p.pid, p.fname, p.lname, j.ID, j.tanggal, j.waktu, l.diagnosa, l.alergi, l.resep, l.status_pembayaran FROM appointment j INNER JOIN pasien p on j.pid = p.pid INNER JOIN laporan l on p.pid = l.pid";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($result)) {
                      $dokter = $row['dokter'];
                      $pid = $row['pid'];
                      $ID = $row['ID'];
                      $fname = $row['fname'];
                      $lname = $row['lname'];
                      $tanggal = $row['tanggal'];
                      $waktu = $row['waktu'];
                      $diagnosa = $row['diagnosa'];
                      $alergi = $row['alergi'];
                      $resep = $row['resep'];
                      $status = $row['status_pembayaran'];


                      echo "<tr>
                        <td>$dokter</td>
                        <td>$pid</td>
                        <td>$ID</td>
                        <td>$fname</td>
                        <td>$lname</td>
                        <td>$tanggal</td>
                        <td>$waktu</td>
                        <td>$diagnosa</td>
                        <td>$alergi</td>
                        <td>$resep</td>
                        <td>$status</td>
                      </tr>";
                    }

                    ?>
                  </tbody>
                </table>
                <br>
              </div>
            </div>
          </div>




          <div class="tab-pane fade" id="list-app" role="tabpanel" aria-labelledby="list-pat-list">

            <div class="col-md-8">
              <!-- <form class="form-group" action="appsearch.php" method="post">
                <div class="row">
                  <div class="col-md-10"><input type="text" name="app_kontak" placeholder="Cari" class="form-control"></div>
                  <div class="col-md-2"><input type="submit" name="app_search_submit" class="btn btn-primary" value="Cari"></div>
                </div>
              </form> -->
            </div>

            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">ID Pasien</th>
                  <th scope="col">Nama Depan</th>
                  <th scope="col">Nama Belakang</th>
                  <th scope="col">Jenis Kelamin</th>
                  <th scope="col">Email</th>
                  <th scope="col">Kontak</th>
                  <th scope="col">Nama Dokter</th>
                  <th scope="col">Biaya Konsultasi</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Waktu</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                global $con;

                $query = "SELECT l.dokter, p.pid, p.fname, p.lname, p.gender, p.email, p.kontak, j.ID, j.tanggal, j.waktu, l.diagnosa, l.alergi, l.resep, l.status_pembayaran, d.tarif, j.status_dokter, j.status_pasien, j.status_pemeriksaan FROM appointment j INNER JOIN pasien p on j.pid = p.pid INNER JOIN laporan l on p.pid = l.pid INNER JOIN dokter d on d.username = l.dokter";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                  <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['pid']; ?></td>
                    <td><?php echo $row['fname']; ?></td>
                    <td><?php echo $row['lname']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['kontak']; ?></td>
                    <td><?php echo $row['dokter']; ?></td>
                    <td><?php echo $row['tarif']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><?php echo $row['waktu']; ?></td>
                    <td>
                      <?php if (($row['status_pasien'] == 1) && ($row['status_dokter'] == 1) && ($row['status_pemeriksaan'] == 0)) {
                        echo "Aktif";
                      }
                      if (($row['status_pasien'] == 1) && ($row['status_dokter'] == 1) && ($row['status_pemeriksaan'] == 1)) {
                        echo "Selesai";
                      }

                      if (($row['status_pasien'] == 0) && ($row['status_dokter'] == 1) && ($row['status_pemeriksaan'] == 0)) {
                        echo "Dibatalkan oleh pasien";
                      }

                      if (($row['status_pasien'] == 1) && ($row['status_dokter'] == 0) && ($row['status_pemeriksaan'] == 0)) {
                        echo "Dibatalkan oleh dokter";
                      }
                      ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <br>
          </div>

          <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>

          <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
            <form class="form-group" method="post" action="admin-panel1.php">
              <div class="row">
                <div class="col-md-4"><label>Nama Dokter:</label></div>
                <div class="col-md-8"><input type="text" class="form-control" name="dokter" onkeydown="return alphaOnly(event);" required></div><br><br>
                <div class="col-md-4"><label>Spesialisasi:</label></div>
                <div class="col-md-8">
                  <select name="spesialisial" class="form-control" id="spesialisial" required="required">
                    <option value="head" name="spesialis" disabled selected>Pilih Spesialisasi</option>
                    <option value="Umum" name="spesialis">Umum</option>
                    <option value="Jantung" name="spesialis">Jantung</option>
                    <option value="Penyakit Dalam" name="spesialis">Penyakit Dalam</option>
                    <option value="Pencernaan" name="spesialis">Pencernaan</option>
                  </select>
                </div><br><br>
                <div class="col-md-4"><label>Email:</label></div>
                <div class="col-md-8"><input type="email" class="form-control" name="demail" required></div><br><br>
                <div class="col-md-4"><label>Password:</label></div>
                <div class="col-md-8"><input type="password" class="form-control" onkeyup='check();' name="dpassword" id="dpassword" required></div><br><br>
                <div class="col-md-4"><label>Konfirmasi Password:</label></div>
                <div class="col-md-8" id='cpass'><input type="password" class="form-control" onkeyup='check();' name="cdpassword" id="cdpassword" required>&nbsp &nbsp<span id='message'></span> </div><br><br>


                <div class="col-md-4"><label>Biaya Konsultasi:</label></div>
                <div class="col-md-8"><input type="text" class="form-control" name="tarif" required></div><br><br>
              </div>
              <input type="submit" name="docsub" value="Tambah Dokter" class="btn btn-primary">
            </form>
          </div>

          <div class="tab-pane fade" id="list-settings1" role="tabpanel" aria-labelledby="list-settings1-list">
            <form class="form-group" method="post" action="admin-panel1.php">
              <div class="row">

                <div class="col-md-4"><label>Email:</label></div>
                <div class="col-md-8"><input type="email" class="form-control" name="demail" required></div><br><br>

              </div>
              <input type="submit" name="docsub1" value="Hapus Dokter" class="btn btn-primary" onclick="confirm('Yakin untuk menghapus')">
            </form>
          </div>


          <div class="tab-pane fade" id="list-staff" role="tabpanel" aria-labelledby="list-astaf-list">
            <form class="form-group" method="post" action="admin-panel1.php">
              <div class="row">
                <div class="col-md-4"><label>Nama:</label></div>
                <div class="col-md-8"><input type="text" class="form-control" name="nama" onkeydown="return alphaOnly(event);" required></div><br><br>
                <div class="col-md-4"><label>Username:</label></div>
                <div class="col-md-8"><input type="text" class="form-control" name="username" required></div><br><br>
                <div class="col-md-4"><label>Password:</label></div>
                <div class="col-md-8"><input type="password" class="form-control" onkeyup='check();' name="dpassword" id="dpassword" required></div><br><br>
                <div class="col-md-4"><label>Konfirmasi Password:</label></div>
                <div class="col-md-8" id='cpass'><input type="password" class="form-control" onkeyup='check();' name="cdpassword" id="cdpassword" required>&nbsp &nbsp<span id='message'></span> </div><br><br>
              </div>
              <input type="submit" name="stafsub" value="Tambah Staff" class="btn btn-primary">
            </form>
          </div>
          <div class="tab-pane fade" id="list-staff1" role="tabpanel" aria-labelledby="list-staff1-list">
            <form class="form-group" method="post" action="admin-panel1.php">
              <div class="row">

                <div class="col-md-4"><label>Username:</label></div>
                <div class="col-md-8"><input type="text" class="form-control" name="username" required></div><br><br>

              </div>
              <input type="submit" name="stafsub1" value="Hapus Staff" class="btn btn-primary" onclick="confirm('Yakin untuk menghapus')">
            </form>
          </div>
          <div class="tab-pane fade" id="list-attend" role="tabpanel" aria-labelledby="list-attend-list">...</div>




        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>
</body>

</html>