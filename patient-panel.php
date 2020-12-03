<!DOCTYPE html>
<?php
include('func.php');
include('newfunc.php');
$con = mysqli_connect("localhost", "root", "", "myhmsdb");


$pid = $_SESSION['pid'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$fname = $_SESSION['fname'];
$gender = $_SESSION['gender'];
$lname = $_SESSION['lname'];
$kontak = $_SESSION['kontak'];




if (isset($_POST['app-submit'])) {
  $pid = $_SESSION['pid'];
  $username = $_SESSION['username'];
  $email = $_SESSION['email'];
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $gender = $_SESSION['gender'];
  $kontak = $_SESSION['kontak'];
  $dokter = $_POST['dokter'];
  $email = $_SESSION['email'];
  $tarif = $_POST['tarif'];
  $tanggal = $_POST['tanggal'];
  $waktu = $_POST['waktu'];
  $keluhan = $_POST['keluhan'];
  $cur_date = date("Y-m-d");
  date_default_timezone_set('Asia/Kolkata');
  $cur_time = date("H:i:s");
  $waktu1 = strtotime($waktu);
  $tanggal1 = strtotime($tanggal);

  if (date("Y-m-d", $tanggal1) >= $cur_date) {
    if ((date("Y-m-d", $tanggal1) == $cur_date and date("H:i:s", $waktu1) > $cur_time) or date("Y-m-d", $tanggal1) > $cur_date) {
      $check_query = mysqli_query($con, "select waktu from appointment where dokter='$dokter' and tanggal='$tanggal' and waktu='$waktu'");

      if (mysqli_num_rows($check_query) == 0) {
        $query = mysqli_query($con, "insert into appointment(pid,dokter,tanggal,waktu,keluhan,status_pasien,status_dokter, status_pemeriksaan) values('$pid','$dokter','$tanggal','$waktu','$keluhan' ,'1','1', '0')");

        if ($query) {
          echo "<script>alert('Berhasil membuat janji');</script>";
        } else {
          echo "<script>alert('Gagal membuat janji, silahkan coba lagi!');</script>";
        }
      } else {
        echo "<script>alert('Dokter tidak tersedia di hari itu, silahkan pilih lain hari!');</script>";
      }
    } else {
      echo "<script>alert('Pilih tanggal yang sesuai!');</script>";
    }
  } else {
    echo "<script>alert('Pilih tanggal yang sesuai!');</script>";
  }
}

if (isset($_GET['cancel'])) {
  $query = mysqli_query($con, "update appointment set status_pasien='0' where ID = '" . $_GET['ID'] . "'");
  if ($query) {
    echo "<script>alert('Janji berhasil dibatalkan');</script>";
  }
}





function generate_bill()
{
  $con = mysqli_connect("localhost", "root", "", "myhmsdb");
  $pid = $_SESSION['pid'];
  $output = '';
  $query = mysqli_query($con, "select p.pid,p.ID,p.fname,p.lname,p.dokter,p.tanggal,p.waktu,p.diagnosa,p.alergi,p.resep,a.tarif from laporan p inner join appointment a on p.ID=a.ID and p.pid = '$pid' and p.ID = '" . $_GET['ID'] . "'");
  while ($row = mysqli_fetch_array($query)) {
    $output .= '
    <label> Patient ID : </label>' . $row["pid"] . '<br/><br/>
    <label> Appointment ID : </label>' . $row["ID"] . '<br/><br/>
    <label> Patient Name : </label>' . $row["fname"] . ' ' . $row["lname"] . '<br/><br/>
    <label> dokter Name : </label>' . $row["dokter"] . '<br/><br/>
    <label> Appointment Date : </label>' . $row["tanggal"] . '<br/><br/>
    <label> Appointment Time : </label>' . $row["waktu"] . '<br/><br/>
    <label> diagnosa : </label>' . $row["diagnosa"] . '<br/><br/>
    <label> Allergies : </label>' . $row["alergi"] . '<br/><br/>
    <label> resep : </label>' . $row["resep"] . '<br/><br/>
    <label> Fees Paid : </label>' . $row["tarif"] . '<br/>
    
    ';
  }

  return $output;
}



function get_spesialiss()
{
  $con = mysqli_connect("localhost", "root", "", "myhmsdb");
  $query = mysqli_query($con, "select username,spesialis from dokter");
  $docarray = array();
  while ($row = mysqli_fetch_assoc($query)) {
    $docarray[] = $row;
  }
  return json_encode($docarray);
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








  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <a class="navbar-brand" href="#"> Rumah Sakit Karya SBD </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
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

      .btn-primary {
        background-color: #3c50c1;
        border-color: #3c50c1;
      }
    </style>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Keluar</a>
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
    <h3 style="margin-left: 40%;  padding-bottom: 20px; font-family: 'IBM Plex Sans', sans-serif;"> Selamat Datang <?php echo $username ?>
    </h3>
    <div class="row">
      <div class="col-md-4" style="max-width:25%; margin-top: 3%">
        <div class="list-group" id="list-tab" role="tablist">
          <a class="list-group-item list-group-item-action active" id="list-dash-list" data-toggle="list" href="#list-dash" role="tab" aria-controls="home">Dashboard</a>
          <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Buat Janji</a>
          <a class="list-group-item list-group-item-action" href="#app-hist" id="list-pat-list" role="tab" data-toggle="list" aria-controls="home">Riwayat Janji</a>
          <a class="list-group-item list-group-item-action" href="#list-pres" id="list-pres-list" role="tab" data-toggle="list" aria-controls="home">Resep</a>

        </div><br>
      </div>
      <div class="col-md-8" style="margin-top: 3%;">
        <div class="tab-content" id="nav-tabContent" style="width: 950px;">


          <div class="tab-pane fade  show active" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">
            <div class="container-fluid container-fullw bg-white">
              <div class="row">
                <div class="col-sm-4" style="left: 5%">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-terminal fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;"> Buat Janji</h4>
                      <script>
                        function clickDiv(id) {
                          document.querySelector(id).click();
                        }
                      </script>
                      <p class="links cl-effect-1">
                        <a href="#list-home" onclick="clickDiv('#list-home-list')">
                          Buat Janji
                        </a>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-sm-4" style="left: 10%">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;">Riwayat Janji</h2>

                        <p class="cl-effect-1">
                          <a href="#app-hist" onclick="clickDiv('#list-pat-list')">
                            Riwayat Janji
                          </a>
                        </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-4" style="left: 20%;margin-top:5%">
                <div class="panel panel-white no-radius text-center">
                  <div class="panel-body">
                    <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-list-ul fa-stack-1x fa-inverse"></i> </span>
                    <h4 class="StepTitle" style="margin-top: 5%;">Resep</h2>

                      <p class="cl-effect-1">
                        <a href="#list-pres" onclick="clickDiv('#list-pres-list')">
                          Lihat Resep
                        </a>
                      </p>
                  </div>
                </div>
              </div>


            </div>
          </div>





          <div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
            <div class="container-fluid">
              <div class="card">
                <div class="card-body">
                  <center>
                    <h4>Buat Janji</h4>
                  </center><br>
                  <form class="form-group" method="post" action="patient-panel.php">
                    <div class="row">

                      <!-- <?php

                            $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                            $query = mysqli_query($con, "select username,spesialis from dokter");
                            $docarray = array();
                            while ($row = mysqli_fetch_assoc($query)) {
                              $docarray[] = $row;
                            }
                            echo json_encode($docarray);

                            ?> -->


                      <div class="col-md-4">
                        <label for="spesialis">Spesialisasi:</label>
                      </div>
                      <div class="col-md-8">
                        <select name="spesialis" class="form-control" id="spesialis">
                          <option value="" disabled selected>Pilih Bidang</option>
                          <?php
                          display_spesialiss();
                          ?>
                        </select>
                      </div>

                      <br><br>

                      <script>
                        document.getElementById('spesialis').onchange = function foo() {
                          let spesialis = this.value;
                          console.log(spesialis)
                          let docs = [...document.getElementById('dokter').options];

                          docs.forEach((el, ind, arr) => {
                            arr[ind].setAttribute("style", "");
                            if (el.getAttribute("data-spesialis") != spesialis) {
                              arr[ind].setAttribute("style", "display: none");
                            }
                          });
                        };
                      </script>

                      <div class="col-md-4"><label for="dokter">Dokter:</label></div>
                      <div class="col-md-8">
                        <select name="dokter" class="form-control" id="dokter" required="required">
                          <option value="" disabled selected>Pilih Dokter</option>

                          <?php display_docs(); ?>
                        </select>
                      </div><br /><br />


                      <script>
                        document.getElementById('dokter').onchange = function updateFees(e) {
                          var selection = document.querySelector(`[value=${this.value}]`).getAttribute('data-value');
                          document.getElementById('tarif').value = selection;
                        };
                      </script>

                      <div class="col-md-4"><label for="consultancyfees">
                          Biaya
                        </label></div>
                      <div class="col-md-8">

                        <input class="form-control" type="text" name="tarif" id="tarif" readonly="readonly" />
                      </div><br><br>

                      <div class="col-md-4"><label>Tanggal</label></div>
                      <div class="col-md-8"><input type="date" class="form-control datepicker" name="tanggal"></div><br><br>

                      <div class="col-md-4"><label>Waktu</label></div>
                      <div class="col-md-8">

                        <select name="waktu" class="form-control" id="waktu" required="required">
                          <option value="" disabled selected>Pilih Waktu</option>
                          <option value="08:00:00">8:00</option>
                          <option value="10:00:00">10:00</option>
                          <option value="12:00:00">12:00</option>
                          <option value="14:00:00">14:00</option>
                          <option value="16:00:00">16:00</option>
                        </select>

                      </div> <br><br>
                      <div class="col-md-4"><label for="">
                          Keluhan
                        </label></div>
                      <div class="col-md-8">

                        <input class="form-control" type="text" name="keluhan" id="keluhan" />
                      </div><br><br>
                      <div class="col-md-4">
                        <input type="submit" name="app-submit" value="Buat Janji" class="btn btn-primary" id="inputbtn">
                      </div>
                      <div class="col-md-8"></div>
                    </div>
                  </form>
                </div>
              </div>
            </div><br>
          </div>

          <div class="tab-pane fade" id="app-hist" role="tabpanel" aria-labelledby="list-pat-list">

            <table class="table table-hover">
              <thead>
                <tr>

                  <th scope="col">Nama Dokter</th>
                  <th scope="col">Biaya</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Waktu</th>
                  <th scope="col">Status Saat Ini</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                global $con;

                $query = "SELECT j.ID , j.dokter , d.tarif , j.tanggal , j.waktu , j.status_pasien , j.status_dokter , j.status_pemeriksaan FROM appointment j INNER JOIN dokter d on j.dokter = d.username where  j.pid= $pid";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {

                ?>
                  <tr>
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

                    <td>
                      <?php if (($row['status_pasien'] == 1) && ($row['status_dokter'] == 1) && ($row['status_pemeriksaan'] == 0)) { ?>


                        <a href="patient-panel.php?ID=<?php echo $row['ID'] ?>&cancel=update" onClick="return confirm('Yakin untuk membatalkan ?')" title="Batalkan" tooltip-placement="top" tooltip="Remove"><button class="btn btn-danger">Batal</button></a>
                      <?php } else {

                        echo "-";
                      } ?>

                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <br>
          </div>



          <div class="tab-pane fade" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">

            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Nama Dokter</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Waktu</th>
                  <th scope="col">Diagnosa</th>
                  <th scope="col">Alergi</th>
                  <th scope="col">Resep</th>
                  <th scope="col">Pembayaran</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                global $con;

                $query = "SELECT l.ID , l.dokter , j.tanggal , j.waktu , l.diagnosa, l.alergi, l.resep, l.status_pembayaran FROM appointment j INNER JOIN laporan l on j.pid = l.pid where  j.pid= $pid";

                $result = mysqli_query($con, $query);
                if (!$result) {
                  echo mysqli_error($con);
                }


                while ($row = mysqli_fetch_array($result)) {
                ?>
                  <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['dokter']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><?php echo $row['waktu']; ?></td>
                    <td><?php echo $row['diagnosa']; ?></td>
                    <td><?php echo $row['alergi']; ?></td>
                    <td><?php echo $row['resep']; ?></td>
                    <td>

                      <?php if ($row['status_pembayaran'] = !"Sudah") { ?>


                        <button class="btn btn-danger">Belum Melakukan Pembayaran</button>
                      <?php } else { ?>

                        <button class="btn btn-success">Sudah Melakukan Pembayaran</button>
                      <?php } ?>
                    </td>


                  </tr>
                <?php }
                ?>
              </tbody>
            </table>
            <br>
          </div>




          <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
          <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
            <form class="form-group" method="post" action="func.php">
              <label>dokters name: </label>
              <input type="text" name="name" placeholder="Enter dokters name" class="form-control">
              <br>
              <input type="submit" name="doc_sub" value="Add dokter" class="btn btn-primary">
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js">
  </script>



</body>

</html>