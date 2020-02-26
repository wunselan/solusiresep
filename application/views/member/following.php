<style>
@media (max-width: 992px) {
 .title {
   margin-top: 70px;
 }

 .social-description{
   padding-left: 0px !important;
   padding-right: 0px !important;
   width: 100px !important;
 }
 .follow{
   height: 60px;
   width: 60px;
 }
 .tombol-lihat{
   padding-left:50px !important;
 }
 .uname{
   padding-left:10px;
   width: 146px;
 }
}
@media (min-width: 992px) {
 .follow{
   height: 70px;
   width: 70px;
 }
 .tombol-lihat{
   margin-left:700px;
 }
 .img-follow{
   max-width:12% !important;
    padding-right:0px !important;
 }
 .uname{
   padding-left:10px;
   width: 191px;
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
            <div class="social-description text-center" style="color:white;">
              <h2><?php echo $total_rows?></h2>
              <p>Resep</p>
            </div>
          </a>
          <a href="<?php echo base_url('/teman/follow/'.$profile[0]['username'].'/'.$profile[0]['id_user'])?>">
            <div class="social-description text-center" style="color:white;">
              <h2><?php echo $total_rows_follow?></h2>
              <p>Mengikuti</p>
            </div>
          </a>
          <a href="<?php echo base_url('/teman/follower/'.$profile[0]['username'].'/'.$profile[0]['id_user'])?>">
            <div class="social-description text-center" style="color:white;">
              <h2><?php echo $total_rows_follower?></h2>
              <p>Diikuti</p>
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="button-container">
          <?php
          if(isset($_SESSION['id_user'])){
            if ($_SESSION['id_user']=== $profile[0]['id_user']){?>
              <form action="<?php echo base_url('/teman/follow/'.$profile[0]['username'].'/'.$profile[0]['id_user'])?>" method="post">
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
          <?php  }?>
        </div>
      <div class="row" style="margin-top:40px">
        <div class="card">
          <div class="card-header col-md-12 text-center">
            <h3 style="margin-bottom: 0px; margin-top:20px;">Mengikuti</h3>
          </div>
          <div class="card-body">
            <?php foreach($follow as $f){ ?>
            <div class="row" style=" padding:30px;">
              <div class="img-follow text-center" id="foto-following">
                <img src="/resepmu/application/assets/img/user/<?=$f['user_foto']?>" alt="Circle Image" class="rounded-circle follow" >
              </div>
              <div class="uname" style="">
                <h4 class="card-title" style="margin-top: 0px; margin-bottom:0px;"><?php echo $f['username']?></h4>
                <p class="card-text"><?php echo $f['nama']?></p>
              </div>
              <div class="text-right tombol-lihat" style="">
                <a href="<?php echo base_url('/user/profile/'.$f['username'].'/'.$f['id_user'])?>" class="btn btn-primary">Lihat</a>
              </div>
            </div>
            <hr>
            <?php }?>


        </div>
        </div>
      </div>
    </div>
  </div>
</body>
