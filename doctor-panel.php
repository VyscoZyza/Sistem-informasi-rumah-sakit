<!DOCTYPE html>
<?php
include('func1.php');
$con = mysqli_connect("localhost", "root", "", "myhmsdb");
$dokter = $_SESSION['dname'];

if (isset($_GET['done'])) {
  $query = mysqli_query($con, "update appointment set status_pemeriksaan='1' where ID = '" . $_GET['ID'] . "'");
  if ($query) {
    echo "<script>alert('Selesai!');</script>";
  }
}
if (isset($_GET['cancel'])) {
  $query = mysqli_query($con, "update appointment set status_dokter='0' where ID = '" . $_GET['ID'] . "'");
  if ($query) {
    echo "<script>alert('Berhasil dibatalkan');</script>";
  }
}



?>
<html lang="en">

<head>


  <title>Rumah Sakit Karya SBD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <a class="navbar-brand" href="#"></i>Rumah Sakit Karya SBD</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <style>
      .btn-outline-light:hover {
        color: #25bef7;
        background-color: #f8f9fa;
        border-color: #f8f9fa;
      }
    </style>

    <style>
      .bg-primary {
        background: -webkit-linear-gradient(left, #3931af, #00c6ff);
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
      <form class="form-inline my-2 my-lg-0" method="post" action="search.php">
        <input class="form-control mr-sm-2" type="text" placeholder="Cari" aria-label="Search" name="kontak">
        <input type="submit" class="btn btn-outline-light" id="inputbtn" name="search_submit" value="Cari">
      </form>
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
    <h3 style="margin-left: 40%; padding-bottom: 20px;font-family:'IBM Plex Sans', sans-serif;"> Selamat Datang Dokter <?php echo $_SESSION['dname'] ?> </h3>
    <div class="row">
      <div class="col-md-4" style="max-width:18%;margin-top: 3%;">
        <div class="list-group" id="list-tab" role="tablist">
          <a class="list-group-item list-group-item-action active" href="#list-dash" role="tab" aria-controls="home" data-toggle="list">Dashboard</a>
          <a class="list-group-item list-group-item-action" href="#list-app" id="list-app-list" role="tab" data-toggle="list" aria-controls="home">Janji</a>
          <a class="list-group-item list-group-item-action" href="#list-pres" id="list-pres-list" role="tab" data-toggle="list" aria-controls="home"> Lihat Laporan </a>

        </div><br>
      </div>
      <div class="col-md-8" style="margin-top: 3%;">
        <div class="tab-content" id="nav-tabContent" style="width: 950px;">
          <div class="tab-pane fade show active" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">

            <div class="container-fluid container-fullw bg-white">
              <div class="row">

                <div class="col-sm-4" style="left: 10%">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-list fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;"> Lihat Janji</h4>
                      <script>
                        function clickDiv(id) {
                          document.querySelector(id).click();
                        }
                      </script>
                      <p class="links cl-effect-1">
                        <a href="#list-app" onclick="clickDiv('#list-app-list')">
                          Daftar Janji
                        </a>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-sm-4" style="left: 15%">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-list-ul fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;"> Resep</h4>

                      <p class="links cl-effect-1">
                        <a href="#list-pres" onclick="clickDiv('#list-pres-list')">
                          Lihat Laporan
                        </a>
                      </p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>


          <div class="tab-pane fade" id="list-app" role="tabpanel" aria-labelledby="list-home-list">

            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">ID Pasien</th>
                  <th scope="col">ID</th>
                  <th scope="col">Nama Depan</th>
                  <th scope="col">Nama Belakang</th>
                  <th scope="col">Jenis Kelamin</th>
                  <th scope="col">Email</th>
                  <th scope="col">Kontak</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Waktu</th>
                  <th scope="col">Keluhan</th>
                  <th scope="col">Status Saat Ini</th>
                  <th scope="col">Aksi</th>
                  <th scope="col">Resep</th>

                </tr>
              </thead>
              <tbody>
                <?php
                $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                global $con;
                $dname = $_SESSION['dname'];
                $query = "SELECT p.pid, j.ID, p.fname, p.lname, p.gender,p.email, p.kontak, j.tanggal, j.waktu, j.keluhan, j.status_pemeriksaan, j.status_pasien, j.status_dokter FROM appointment j INNER JOIN pasien p on j.pid = p.pid where j.dokter= '$dname';";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                  <tr>
                    <td><?php echo $row['pid']; ?></td>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['fname']; ?></td>
                    <td><?php echo $row['lname']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['kontak']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><?php echo $row['waktu']; ?></td>
                    <td><?php echo $row['keluhan']; ?></td>
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

                    <td>
                      <?php if (($row['status_pasien'] == 1) && ($row['status_dokter'] == 1) && ($row['status_pemeriksaan'] == 0)) { ?>


                        <a href="doctor-panel.php?ID=<?php echo $row['ID'] ?>&cancel=update" onClick="return confirm('Yakin untuk membatalkan ?')" title="Batalkan" tooltip-placement="top" tooltip="Remove"><button class="btn btn-danger">X</button></a>

                        <a href="doctor-panel.php?ID=<?php echo $row['ID'] ?>&done=update" onClick="return confirm('Yakin selesai?')" title="Selesai" tooltip-placement="top" tooltip="Remove"><button class="btn btn-success">V</button></a>

                      <?php } else {

                        echo "-";
                      } ?>


                    </td>

                    <td>

                      <?php if (($row['status_pasien'] == 1) && ($row['status_dokter'] == 1) && ($row['status_pemeriksaan'] == 0)) { ?>

                        <a href="input-resep.php?ID=<?php echo $row['ID'] ?>&pid=<?php echo $row['pid'] ?>&dname=<?php echo $row['pid'] ?>" <button class="btn btn-success">Input</button></a>
                      <?php }
                      if (($row['status_pasien'] == 1) && ($row['status_dokter'] == 1) && ($row['status_pemeriksaan'] == 1)) { ?>

                        <a href="resep.php?ID=<?php echo $row['ID'] ?>" tooltip-placement="top" tooltip="Remove" title="lihat">
                          <button class="btn btn-success">Detail</button></a>
                      <?php } else {

                        echo "-";
                      } ?>

                    </td>


                  </tr></a>
                <?php } ?>
              </tbody>
            </table>
            <br>
          </div>



          <div class="tab-pane fade" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">
            <table class="table table-hover">
              <thead>
                <tr>

                  <th scope="col">ID Pasien</th>
                  <th scope="col">Nama Depan</th>
                  <th scope="col">Nama Belakang</th>
                  <th scope="col">ID</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Waktu</th>
                  <th scope="col">Diagnosa</th>
                  <th scope="col">Alergi</th>
                  <th scope="col">Resep</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                global $con;

                $query = "SELECT p.pid, p.fname, p.lname, j.ID, j.tanggal, j.waktu, l.diagnosa, l.alergi, l.resep FROM appointment j INNER JOIN pasien p on j.pid = p.pid INNER JOIN laporan l on p.pid = l.pid where j.dokter = '$dname'";

                $result = mysqli_query($con, $query);
                if (!$result) {
                  echo mysqli_error($con);
                }


                while ($row = mysqli_fetch_array($result)) {
                ?>
                  <tr>
                    <td><?php echo $row['pid']; ?></td>
                    <td><?php echo $row['fname']; ?></td>
                    <td><?php echo $row['lname']; ?></td>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><?php echo $row['waktu']; ?></td>
                    <td><?php echo $row['diagnosa']; ?></td>
                    <td><?php echo $row['alergi']; ?></td>
                    <td><?php echo $row['resep']; ?></td>

                  </tr>
                <?php }
                ?>
              </tbody>
            </table>
          </div>


          <div class="tab-pane fade" id="list-app" role="tabpanel" aria-labelledby="list-pat-list">

            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Nama Depan</th>
                  <th scope="col">Nama Belakang</th>
                  <th scope="col">Email</th>
                  <th scope="col">Kontak</th>
                  <th scope="col">Nama Dokter</th>
                  <th scope="col">Biaya Konsultasi</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Waktu</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                global $con;

                $query = "select * from appointment;";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {


                ?>
                  <tr>
                    <td><?php echo $row['fname']; ?></td>
                    <td><?php echo $row['lname']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['kontak']; ?></td>
                    <td><?php echo $row['dokter']; ?></td>
                    <td><?php echo $row['tarif']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><?php echo $row['waktu']; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <br>
          </div>





          <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
          <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
            <form class="form-group" method="post" action="patient-panel1.php">
              <div class="row">
                <div class="col-md-4"><label>Nama Dokter:</label></div>
                <div class="col-md-8"><input type="text" class="form-control" name="dokter" required></div><br><br>
                <div class="col-md-4"><label>Password:</label></div>
                <div class="col-md-8"><input type="password" class="form-control" name="dpassword" required></div><br><br>
                <div class="col-md-4"><label>Email:</label></div>
                <div class="col-md-8"><input type="email" class="form-control" name="demail" required></div><br><br>
                <div class="col-md-4"><label>Biaya Konsultasi:</label></div>
                <div class="col-md-8"><input type="text" class="form-control" name="tarif" required></div><br><br>
              </div>
              <input type="submit" name="docsub" value="Add dokter" class="btn btn-primary">
            </form>
          </div>
          <div class="tab-pane fade" id="list-attend" role="tabpanel" aria-labelledby="list-attend-list">...</div>
        </div>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>
</body>

</html>