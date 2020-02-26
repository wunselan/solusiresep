<style>
@media (max-width: 992px) {
 .title {
   font-size: 18px;
 }
 .footer{
   margin-top: 300px;
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
}
@media (min-width: 992px) {
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
}

</style>

<body class="sidebar-collapse">
<div class="wrapper">
<div class="section section-about-us" style="padding:20px;">
  <div class="container">

    <div class="row" style="padding-top:40px;">


      <div class="text-center col-md-12">
        <h1 class="title" style="color:#2c2c2c;">Pencarian</h1>
      </div>
      <div class="col-md-12">
        <h6>Hasil Pencarian: <?php echo $this->input->get('cariBahan')?></b></h6>
      </div>
      <?php $jumlah=0;
      foreach($hasil as $h){ if(++$jumlah == 6) break; ?>
      <div class="col-md-3 col-6 text-center">
        <div class="card">
          <img class="card-img-top" style="height:50%;" src="/resepmu/application/assets/img/resep/<?=$h["resep_foto"]?>" alt="Card image cap">
          <div class="card-body" style="padding-top: 0px;">
            <h4 class="card-title" style="margin-top: 10px;"><?php echo $h["nama_resep"]?></h4>
            <a href="<?php echo base_url('/user/profile/'.$h["username"].'/'.$h["id_user"])?>"><p class="category text-primary" ><?php echo $h["nama"]?></p></a><br>
            <a href="<?php echo base_url('/resep/halaman_resep/'.$h["id_resep"])?>" class="btn btn-primary" style="margin-top: 0px;">Lihat</a>
          </div>
        </div>
      </div>
      <?php  } ?>
    </div>
  </div>
</div>
</div>
</body>
