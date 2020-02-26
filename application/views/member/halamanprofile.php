<style>
@media (max-width: 992px) {
 .title {
   margin-top: 70px;
 }
 .card {
   width: 8rem !important;
   height: 15rem !important;
   font-size: 8px;
 }
 .social-description{
   padding-left: 0px !important;
   padding-right: 0px !important;
   width: 100px !important;
 }
 .card-img-top {
   height:95px;
 }
 .card-body{
   padding:11px !important;
 }
 .card-title{
   margin-bottom:9px !important;
   margin-top:5px !important;
   height: 24px;
 }
 p.nama{
   margin-top: 30px;
 }
 p.create{
   margin-top: 35px;
 }
}

@media (min-width: 992px) {
  .card-img-top {
    height:360px;
  }
}

</style>
<body class="profile-page sidebar-collapse">

  <div class="wrapper">
    <div class="page-header clear-filter page-header-small" filter-color="orange">
      <div class="page-header-image" data-parallax="true" style="background-image:url('/resepmu/application/assets/img/backgroundprofile.jpg');">
      </div>
      <div class="container">
        <div class="photo-container">
          <img src="/resepmu/application/assets/img/user/<?=$profile[0]['user_foto']?>" alt="">
        </div>
        <h3 class="title" style="margin-top: 0px; margin-bottom: 0px;"><?php echo $profile[0]['nama']?>
        <?php
          if(isset($_SESSION['id_user'])){
            if ($_SESSION['id_user']=== $profile[0]['id_user']){
        ?>
          <a href="<?php echo base_url("user/editprofile"); ?>"><span class="fa fa-edit"></span></a>
        <?php
            }
          }
        ?>


        </h3>
        <div class="row justify-content-center">
          <p style="margin-top: 0px; margin-bottom: 0px; padding-top:10px; padding-right:10px;"><?php echo $profile[0]['username'] ?></p>
          <p style="margin-top: 0px; margin-bottom: 0px; padding-top:10px; padding-left:10px;"><?php echo $profile[0]['jenis_kelamin']?></p>
        </div>

        <div class="content">
          <a href="<?php echo base_url('/user/profile/'.$profile[0]['username'].'/'.$profile[0]['id_user'])?>">
            <div class="social-description col-4" style="color:white;">
              <h2><?php echo $total_rows?></h2>
              <p>Resep</p>
            </div>
          </a>
          <a href="<?php echo base_url('/teman/follow/'.$profile[0]['username'].'/'.$profile[0]['id_user'])?>">
            <div class="social-description col-4" style="color:white;">
              <h2><?php echo $total_rows_follow?></h2>
              <p>Mengikuti</p>
            </div>
          </a>
          <a href="<?php echo base_url('/teman/follower/'.$profile[0]['username'].'/'.$profile[0]['id_user'])?>">
            <div class="social-description col-4" style="color:white;">
              <h2><?php echo $total_rows_follower?></h2>
              <p>Diikuti</p>
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="section" style="padding-right:30px; padding-left:30px;">
      <div class="container">
        <div class="button-container">
          <?php
          if(isset($_SESSION['id_user'])){
            if ($_SESSION['id_user']=== $profile[0]['id_user']){?>
              <form action="<?php echo base_url('/user/profile/'.$profile[0]['username'].'/'.$profile[0]['id_user'])?>" method="post">
                <button class="btn btn-primary btn-round btn-lg">Ikuti</button>
              </form>
            <?php }else if($ikuti == 0){ ?>

          <form action="<?php echo base_url('/teman/follow_action/'.$profile[0]['id_user'])?>" method="post">
            <input hidden name="username" value="<?php echo $profile[0]['username']?>"></input>
            <button class="btn btn-primary btn-round btn-lg">Ikuti</button>
          </form>
        <?php }else{?>
          <form action="<?php echo base_url('/teman/unfollow/'.$profile[0]['id_user'])?>" method="post">
            <input hidden name="username" value="<?php echo $profile[0]['username']?>"></input>
            <button class="btn btn-primary btn-round btn-lg">Berhenti Mengikuti</button>
          </form>
        <?php }}else{ ?>
          <form action="<?php echo base_url('/user/login')?>" method="post">
            <button class="btn btn-primary btn-round btn-lg">Ikuti</button>
          </form>
        <?php }?>
        </div>
        <div class="row" style="padding-top: 30px;">
          <?php
          if (empty($user)) {
                  echo  "<div class='col-md-12 text-center' ><h3><b>Tidak Memiliki Resep</b></h3></div>";
          }
          foreach ($user as $u): ?>

          <div class="col-6 text-center">
            <div class="card">
              <img class="card-img-top" src="/resepmu/application/assets/img/resep/<?php if (isset($u['resep_foto'])) {
                echo $u['resep_foto'];}?>" alt="Card image cap">
              <div class="card-body">
                <a href="<?php echo base_url('/resep/halaman_resep/'.$u["id_resep"])?>"><h4 class="card-title"><?php if (isset($u['nama_resep'])) {
                  echo $u['nama_resep'];}?></h4></a>
                <p class="card-text nama"><?php if (isset($u['username'])) {
                  echo $u['username'];}?></p>
                <p class="card-text create"><small class="text-muted">Dibuat: <?php if (isset($u['create_add'])) {
                  echo $u['create_add'];}?></small></p>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="row justify-content-center" style="padding-top:30px;">
            <?php echo $halaman;?>
        </div>
    </div>
  </div>
</body>
