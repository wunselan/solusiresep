<!DOCTYPE html>
<html lang="en">
<style media="screen">
  img .card-img-top{
    height:50%;
  }
  .anyClass1 {
  max-height:500px;
  overflow-y: scroll;
  }
  .sidebar-collapse .navbar-collapse:before{
    background:linear-gradient(#f96332 100%, #fff 90%) !important;
  }
</style>

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="/resepmu/application/assets/img/apple-icon.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <link rel="icon" type="image/png" href="/resepmu/application/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Resep Masakmu
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/themes/fontawesome-stars-o.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="<?= base_url('application/assets/css/bootstrap.min.css')?>" rel="stylesheet" />
  <link href="<?= base_url('application/assets/css/now-ui-kit.css?v=1.3.0')?>" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?= base_url('application/assets/demo/demo.css')?>" rel="stylesheet" />
  <link href="/resepmu/application/assets/sweetalert/sweetalert.css" rel="stylesheet">
</head>
<body>
  <header>
  <nav class="navbar navbar-expand-lg fixed-top bg-primary">
      <div class="container ">
        <div class="navbar-translate">
    			<a style="font-size:15px;" class="navbar-brand" href="<?php echo base_url('resep/halamanutama');?>">RESEP•MU</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars" style="color:white"></span>
          </button>
    		</div>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('resep/halamanutama')?>">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="dropdown-toogle nav-link" id="dropdown01" data-toggle="dropdown" href="#">Notification <div class="badge badge-primary"><?php if($total_notif>0 && $notif[0]['status']==0){ echo $total_notif; }?></div> </a>
              <div class="dropdown-menu anyClass1" aria-labelledby="dropdown01">
                <?php
                if (empty($notif)) {
                        echo  "<p class='dropdown-item'>Anda tidak memiliki notifikasi.</p>";
                }else{ foreach ($notif as $n){
                  if($n['jenis']=="komentar"){?>
                <a class="dropdown-item" href="<?php echo base_url('user/updatenotif/'.$n['id_notifikasi'])?>">
                  <p><?php echo $n['create_add']?><br/>
                  <?php echo $n['memberi_notif']?> mengomentari resep anda.</p>
                </a>
                <div class="dropdown-divider"></div>
              <?php }else if($n['jenis']=="follow"){ ?>
                <a class="dropdown-item" href="<?php echo base_url('user/updatenotif/'.$n['id_notifikasi']);?>">
                  <p><?php echo $n['create_add']?><br/>
                  <?php echo $n['memberi_notif']?> mengikuti anda.</p>
                </a>
                <div class="dropdown-divider"></div>
              <?php }}}?>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle fa fa-user-circle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="<?php echo base_url('/user/profile/'.$this->session->userdata('username').'/'.$_SESSION['id_user'])?>">Profile</a>
                <a class="dropdown-item" href="<?php echo base_url('/user/logout') ?>">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <!--   Core JS Files -->
  <script src="<?= base_url('application/assets/js/core/jquery.min.js')?>" type="text/javascript"></script>
  <script src="<?= base_url('application/assets/js/core/popper.min.js')?>" type="text/javascript"></script>
  <script src="<?= base_url('application/assets/js/jquery.barrating.min.js')?>" type="text/javascript"></script>
  <script src="<?= base_url('application/assets/js/core/bootstrap.min.js')?>" type="text/javascript"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="<?= base_url('application/assets/js/plugins/bootstrap-switch.js')?>"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="<?= base_url('application/assets/js/plugins/nouislider.min.js')?>" type="text/javascript"></script>
  <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
  <script src="<?= base_url('application/assets/js/plugins/bootstrap-datepicker.js')?>" type="text/javascript"></script>
  <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
  <script src="<?= base_url('application/assets/js/now-ui-kit.js?v=1.3.0')?>" type="text/javascript"></script>
  <script src="/resepmu/application/assets/sweetalert/sweetalert.min.js"></script>
  <script src="/resepmu/application/assets/sweetalert/jquery.sweet-alert.custom.js"></script>
</body>
</html>
