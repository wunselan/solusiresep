<style media="screen">
.anyClass {
height:400px;
overflow-y: scroll;
}
.komen {
  background-color:#f96332 !important;
  color:white !important;
}
@media (max-width: 992px) {
 .title {
   margin-top: 20px;
   font-size: 18px;
 }
  .img{
    height:200px; width:700px; padding-bottom:20px;
  }

}
@media (min-width: 992px) {
  .img{
    height:400px; width:700px; padding-bottom:20px;
  }
}
</style>
<body class="sidebar-collapse">
<div class="wrapper">
<div class="section section-about-us" style="padding:30px;">
  <div class="container">

    <div class="row" style="padding-top:30px;">
      <div class="text-center col-md-12">
        <h1 class="title" style="color:#2c2c2c;">Halaman Resep</h1>
      </div>

      <div class="col-md-12 text-center"style="padding-bottom:0px;">
        <img class="img" src="/resepmu/application/assets/img/resep/<?=$resep[0]["resep_foto"]?>">
        <h3><b><?php echo $resep[0]['nama_resep']?>

          <?php
            if(isset($_SESSION['id_user'])){
              if ($_SESSION['id_user']=== $resep[0]['id_user']){
          ?>
            <a href="<?php echo base_url("resep/editresep/".$resep[0]['id_resep']); ?>"><span class="fa fa-edit"></span></a>
          <?php
              }
            }
          ?>

        </b></h3>

      </div>
      <div class="col-12 text-center">
        <a href="<?php echo base_url("user/profile/".$resep[0]['username']."/".$resep[0]['id_user']); ?>"><h5><?php echo $resep[0]['nama']?></h5></a>
      </div>
      <div class="col-6 text-right">
        <h5><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $resep[0]['durasi']?> Menit</h5>
      </div>
      <div class="col-6 text-left">
        <h5><i class="fa fa-users" aria-hidden="true"></i> <?php echo $resep[0]['porsi']?> Orang</h5>
      </div>
      <div class="col-12">
        <?php
          if(isset($_SESSION['id_user'])){
            if ($_SESSION['id_user']=== $resep[0]['id_user']){
        ?>
          <a id="hapus" data-uid='<?php echo base_url('resep/delete_resep/').$resep[0]['id_resep']?>'><button  class="btn btn-primary btn-round float-right">Hapus Resep</button></a>
          <?php
              }
            }
          ?>
    </div>
      <div class="col-md-12 "style="padding-bottom:30px;">
        <h3><b>Bahan Makanan</b></h3>
        <p class="mb-0"><b><?php echo $resep[0]['bahan_makanan']?></b></p>
      </div>
      <div class="col-md-12 "style="padding-bottom:0px;">
        <h3><b>Langkah Memasak</b></h3>
        <p class="mb-0"><b><?php echo $resep[0]['langkah_memasak']?></b></p>
      </div>
    </div>
  </div>
</div>


<div class="container">
<div class="row" style="padding-top:30px;">
  <div class=" col-md-12">
<div class="card">
  <div class="col-sm-12 text-center" style="padding-top:20px;">
      <div class="">
          <figure>
              <figcaption class="ratings">

                  <p id="jml_rate" data-rating="<?php echo $avgRate?>" style="font-weight: bold">Rating Resep<span><br><?php echo $avgRate?>/5<select id="hasil_rate">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select></span></p>

              </figcaption>
          </figure>
      </div>
  </div>
							<div class="card-header">
								<ul class="nav nav-tabs " role="tablist">
								  <li class="nav-item">
									<a class="komen nav-link active" data-toggle="tab" href="#ulasan">Komentar</a>
								  </li>
								  <li class="nav-item">
                      <a class="komen nav-link" data-toggle="tab" href="#beri_rating">Beri Komentar dan Rating</a>
								  </li>

								</ul>
							</div>

							<div class="card-body anyClass">
								<!-- Tab panes -->
                <div class="tab-content">
                   <div id="ulasan" class="container tab-pane active"><br>
                      <?php $i=0;
                      if (empty($komentar)) {
                              echo  "<div class='col-md-12 text-center' ><h3><b>Tidak Memiliki Komentar</b></h3></div>";
                      }
                      foreach($komentar as $h){ ?>
                    <div class="comments-list">

                         <div class="media">
                              <div class="media-body" >
                              <hr>
                                <h4 class="media-heading user_name" style="margin-top:0px;"><br><?php echo $h['nama']?></h4>
                                <select data-rating="<?php echo $h['rating']?>" name="rate" class="<?php echo 'komentar-rating-'.$i++?>">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select>
                              <?php
                                if(isset($_SESSION['id_user'])){
                                  if ($_SESSION['id_user']=== $h['id_user']){
                              ?>

                                <a href="#" style="padding:9px; font-size:8px; background-color:#d82a2a" id="hapuskomentar" data-uid='<?php echo base_url('komentar/delete_komentar/').$h['id_komentar']?>' class="btn btn-primary float-right">Hapus</a>

                              <?php
                                  }
                                }
                              ?>
                              <?php echo $h['komentar']?>
                              </div>
                            </div>
                     </div>
                   <?php } ?>

                  </div>
                  <div id="beri_rating" class="container tab-pane fade"><br>
                    <form action="<?php echo base_url('komentar/komentar_rating/'.$resep[0]['id_resep'])?>" method="post">
                        <?php if(!isset($_SESSION['id_user'])){ ?>
                          <p>Login terlebih dahulu!</p>
                      <?php }elseif($isHasRated){ ?>
                          <p>Terima kasih anda sudah memberi komentar dan rating</p>
                        <?php } else{ ?>
                           Beri Rating
                              <select name="rate" id="example">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select>
                              <div data-for="message">
                                  <textarea class="form-control input" name="message" rows="2" data-form-field="Message" placeholder="Komentar" style="resize:none" id="message-form4-3" required></textarea>
                              </div>
                              <button style="margin-left: 0px; background-color:#f96332;" class="btn btn-form btn-secondary display-3" name="submit" type="submit">Kirim</button>
                            <?php } ?>
                      </form>
                  </div>
                </div>
						</div>
          </div>
        </div>
</div>

<script type="text/javascript">
   $(function() {
      $('#example').barrating({
        theme: 'fontawesome-stars-o',
        onSelect: function(value, text, event) {
    if (typeof(event) !== 'undefined') {
      // rating was selected by a user
      console.log(value);
    } else {
      // rating was selected programmatically
      // by calling `set` method
    }
  }
      });
      var rate = $("#jml_rate").data("rating");
      console.log(rate);
      $('#hasil_rate').barrating({
        theme: 'fontawesome-stars-o',
        readonly: true,
        initialRating: rate
      });
      var comment= <?php echo $i ?>;
      for (var i = 0; i < comment; i++) {
          var rate1 = $(".komentar-rating-"+i).data("rating");
          $('.komentar-rating-'+i).barrating({
            theme: 'fontawesome-stars-o',
            readonly: true,
            initialRating: rate1
          });
      }

   });

   $(document).ready(function(){
       $(document).on('click','#hapus',function(e){
         e.preventDefault();
         var uid=$(this).data('uid');
         swal(
               {
                   title: "Apakah anda yakin menghapus resep masakan ini?",
                   type: "warning",
                   showCancelButton: true,
                   confirmButtonColor: "#f96332",
                   cancelButtonText: "Tidak",
                   confirmButtonText: "Ya",
                   closeOnCancel: true,
                   closeOnConfirm: false
               },
               function (isConfirm) {
                 if (isConfirm) {
                   window.location=uid;
                 }                    }
           );
       });
   });
   $(document).ready(function(){
       $(document).on('click','#hapuskomentar',function(e){
         e.preventDefault();
         var uid=$(this).data('uid');
         swal(
               {
                   title: "Apakah anda yakin menghapus komentar ini?",
                   type: "warning",
                   showCancelButton: true,
                   confirmButtonColor: "#f96332",
                   cancelButtonText: "Tidak",
                   confirmButtonText: "Ya",
                   closeOnCancel: true,
                   closeOnConfirm: false
               },
               function (isConfirm) {
                 if (isConfirm) {
                   window.location=uid;
                 }                    }
           );
       });
   });

</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var elements = document.getElementsByTagName("textarea");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function(e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity("Data tidak boleh kosong");
            }
        };
        elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
        };
    }
})
</script>

</div>
</body>
