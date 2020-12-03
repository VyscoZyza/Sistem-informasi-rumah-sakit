<!doctype html>
<html>

<head>
    <title>Sistem Basis Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <a class="navbar-brand" href="#"> Rumah Sakit Karya SBD </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <script>
            var check = function() {
                if (document.getElementById('password').value ==
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

    </nav>
    <div class="card">
        <div class="container" style="margin-top: 3%;">
            <div class="row">

                <?php
                $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                $id = $_GET['ID'];
                $query_mysql = mysqli_query($con, "SELECT l.dokter, p.pid, p.fname, p.lname, j.ID, j.tanggal, j.waktu, l.diagnosa, l.alergi, l.resep, l.status_pembayaran FROM appointment j INNER JOIN pasien p on j.pid = p.pid INNER JOIN laporan l on p.pid = j.pid WHERE l.ID = $id") or die(mysqli_error($connection));
                while ($row = mysqli_fetch_array($query_mysql)) {
                ?>
                    <div class="col-lg-12 mx-auto">
                        <div class="card card-signin my-5">
                            <div class="card-body">
                                <h5 class="card-title text-center">Resep</h5>
                                <form class="form-signing" action="update.php" method="post">
                                    <div class="form-label-group">
                                        <label>Nama</label>
                                        <input class="form-control" type="text" value="<?php echo $row['fname'], " ", $row['lname']  ?>" name="nama" id="nama" readonly="readonly" />
                                    </div><br>
                                    <div class="form-label-group">
                                        <label>Diagnosa</label>
                                        <textarea class="form-control" name="diagnosa" id="diagnosa" rows="3" readonly="readonly"><?php echo $row['diagnosa'] ?></textarea>
                                    </div><br>
                                    <div class="form-label-group">
                                        <label>Alergi</label>
                                        <textarea class="form-control" name="alergi" id="alergi" rows="3" readonly="readonly"><?php echo $row['alergi'] ?></textarea>
                                    </div><br>
                                    <label>Resep</label>
                                    <div class="form-label-group">
                                        <textarea class="form-control" name="resep" id="resep" rows="3" readonly="readonly"><?php echo $row['resep'] ?></textarea>
                                    </div><br>

                                    <br>

                                    <a class="btn btn-secondary btn-block " href="doctor-panel.php">Kembali</a>

                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
</body>

</html>