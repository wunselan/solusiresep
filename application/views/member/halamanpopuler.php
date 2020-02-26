<style>
@media (max-width: 992px) {
  .follow{
    padding:0px !important;
  }
 .title {
   margin-top: 70px;
   font-size: 18px;
 }
 .section-about-us{
   padding:30px !important;
 }
 .card {
   width: 8rem !important;
   height: 15rem !important;
   font-size: 8px;
 }
 .card-body{
   font-size: 7px;
 }
 .card-title{
   height: 36px;
}
.category{
  height:0px;
}
h4.title{
  margin-top:0px; padding-top:0px;
  font-size: 12px;
}
h1.title{
  margin-top: 48px;
}
span.resepuname{
  background-color:#b9b7b7e6 !important;
  height:40px;
}
input.uname{
  height:40px; background-color:#b9b7b7e6 !important; width:95px !important; border-top-right-radius: 40px !important; border-bottom-right-radius: 40px !important;
}
button.cr{
  margin-left: 20px;
  margin-top: 0px;
}
.crnm{
  width: 99% !important;
  margin:auto;
}
}

@media (min-width: 992px) {
  .follow{
    padding:0px !important;
  }
  .card {
    width: 15rem;
    height: 22rem;
    font-size: 12px;
  }
  .card-title{
    height: 73px;
  }
  .category{
     height:0px;
  }
  h4.title{
    margin-top:0px; padding-top:0px;
  }
  h1.title{
    margin-top: 48px;
  }
  span.resepuname{
    background-color:#b9b7b7e6 !important;
    height:40px;
  }
  input.uname{
    height:40px; background-color:#b9b7b7e6 !important; width:500px !important; border-top-right-radius: 40px !important; border-bottom-right-radius: 40px !important;
  }
  button.cr{
    margin-left: 20px;
    margin-top: 0px;
  }
  .crnm{
    width: 65% !important;
    margin:auto;
  }
}
</style>
<body class="sidebar-collapse">
  <div class="wrapper">
    <div class="page-header page-header-small">
      <div class="page-header-image" data-parallax="true" style="background-image: url('/resepmu/application/assets/img/backgroundutama1.jpg');">
      </div>
      <div class="content-center">
        <div class="container">
          <h1 class="title">Solusi resep masakan.</h1>
          <h4 style="" class="title">bingung mencari resep sesuai dengan bahan yang dimiliki? cari disini!</h4>
            <!-- berdasarkan bahan makanan -->
              <form class="" action="<?php echo base_url('resep/search');?>" method="get">
                <div class="text-center">
                  <div class="input-group no-border input-lg">
                    <div class="input-group-prepend">
                      <span style="background-color:rgba(255, 255, 255, 0.87)" class="input-group-text">
                        <i class="fa fa-pencil-square-o"></i>
                      </span>
                    </div>
                    <input style="background-color: rgba(255, 255, 255, 0.87);" type="text" value="" placeholder="Masukkan bahan makanan..." class="form-control" name="cariBahan" />

                  </div>
                  <button type="submit" class="btn btn-primary btn-round">Search</button>
                </div>
              </form>
            <!-- akhir berdasarkan bahan makanan -->
        </div>
      </div>
    </div>
    <div class="section section-about-us" style="padding:50px;">
      <div class="container">
        <div class="col-12 text-center">
          <h4 class="title">cari resep atau user.</h4>
        </div>
            <form class="" action="<?php echo base_url('resep/search_byname');?>" method="post">

                <div class="input-group no-border input-lg crnm">
                  <div class="input-group-prepend">
                    <span style="" class="input-group-text resepuname">
                      <i class="fa fa-user-circle"></i>
                    </span>
                  </div>
                  <input type="text" value="" placeholder="Masukkan nama resep atau username..." class="form-control uname" name="cari" />
                  <button style="" type="submit" class="btn btn-primary btn-round cr">Search</button>
                  </div>

            </form>

          <div class="row">
          <div class="col-12 text-right">
            <?php if (isset($_SESSION['id_user'])) : ?>
              <a href="<?php echo base_url('resep/tambahresep');?>" class="btn btn-primary btn-round float-right">+ Tambah Resep</a>
            <?php endif ?>
              </div>
          </div>
        <div class="row">
          <?php if (isset($_SESSION['id_user'])){    ?>
            <div class="col-4 follow text-right" style="margin-bottom: 20px">
              <a href="<?php echo base_url('resep/halamanutama');?>" class="btn btn-primary btn-round">Terbaru</a>
            </div>

            <div class="col-4 follow text-center" style="margin-bottom: 20px">
              <a href="<?php echo base_url('teman/resepfollowing/'.$_SESSION['id_user']);?>" class="btn btn-primary btn-round">Following</a>
            </div>

            <div class="col-4 follow text-left" style="margin-bottom: 20px">
              <a href="<?php echo base_url('resep/getPopuler');?>" class="btn btn-primary btn-round">Populer</a>
            </div>
            <div class="text-center col-md-12 col-sm-12">
              <h1 class="title" style="color:#2c2c2c; margin-top:0;">Populer</h1>
            </div>

            <?php
          }else{?>

          <div class="col-6 text-right" style="margin-bottom: 20px">
            <a href="<?php echo base_url('resep/halamanutama');?>" class="btn btn-primary btn-round">Terbaru</a>
          </div>
          <div class="col-6 text-left" style="margin-bottom: 20px">
            <a href="<?php echo base_url('resep/getPopuler');?>" class="btn btn-primary btn-round">Populer</a>
          </div>
          <div class="text-center col-md-12 col-sm-12">
            <h1 class="title" style="color:#2c2c2c; margin-top:0;">Populer</h1>
          </div>
          <?php }?>
          <?php foreach ($resep as $h) { ?>
          <div class="col-md-3 col-sm-3 col-6 text-center">
            <div class="card">
              <img class="card-img-top" style="height:50%;" src="/resepmu/application/assets/img/resep/<?=$h["resep_foto"]?>" alt="Card image cap">
              <div class="card-body text-center" style="padding-top: 0px;">
                <h4 class="card-title" style="margin-top: 10px;"><?php echo $h["nama_resep"]?></h4>
                <a href="<?php echo base_url('/user/profile/'.$h["username"].'/'.$h["id_user"])?>"><p class="category text-primary" ><?php echo $h["username"]?></p></a><br>
                <a href="<?php echo base_url('/resep/halaman_resep/'.$h["id_resep"])?>" class="btn btn-primary btn-lihat" style="margin-top: 0px;">Lihat</a>
              </div>
            </div>
          </div>
          <?php  } ?>
        </div>
        <div class="row justify-content-center" style="padding-top:30px;">
            <?php echo $halaman;?>
        </div>
      </div>
    </div>
  </div>
</body>
