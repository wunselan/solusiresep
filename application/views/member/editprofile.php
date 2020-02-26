<body class="profile-page sidebar-collapse">
  <div class="section section-signup" style="background-image: url('/resepmu/application/assets/img/backgroundeditprof.jpg'); background-size: cover; background-position: top center; min-height: 700px;">
    <div class="container">
      <div class="row">
        <div class="card card-signup" data-background-color="orange" style="opacity: 0.96">
          <form class="form" method="post" action="<?php echo base_url('user/updateProfile');?>" enctype="multipart/form-data">
            <div class="card-header text-center">
              <h3 class="card-title title-up">Edit Profile</h3>
            </div>
            <div class="card-body">
              <div class="input-group no-border">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-user-circle"></i>
                  </span>
                </div>
                <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" value="<?php echo $user[0]['nama'] ?>" required>
              </div>
              <div>
                <i class="fa fa-venus-mars"></i>
                <label style="font-size: 12px" for="jenis_kelamin"> Jenis Kelamin:</label>
                  <select style="margin-bottom:10px;" name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                    <option value="Laki-laki" <?= $user[0]['jenis_kelamin'] == "Laki-laki" ? "selected" : "" ?> style="color:black;">Laki-laki</option>
                    <option value="Perempuan" <?= $user[0]['jenis_kelamin'] == "Perempuan" ? "selected" : "" ?> style="color:black;">Perempuan</option>
                  </select>
              </div>
              <div class="input-group no-border">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-user-circle"></i>
                  </span>
                </div>
                <input type="text" name="username" value="<?php echo $user[0]['username'] ?>" placeholder="Masukkan Username" class="form-control" disabled required />
              </div>
              <div class="input-group no-border">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-lock"></i>
                  </span>
                </div>
                <input type="password" name="password" value="<?php echo $user[0]['password'] ?>" class="form-control" placeholder="Masukkan Password" required>
              </div>
              <div class="input-group no-border">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-envelope"></i>
                  </span>
                </div>
                <input type="text" class="form-control" name="email" value="<?php echo $user[0]['email'] ?>" placeholder="Masukkan Email" oninvalid="if (this.value == ''){this.setCustomValidity('This field is required!')} if (this.value != ''){this.setCustomValidity('The email you entered is invalid!')}" oninput="setCustomValidity('')" required="">
              </div>
              <div class="input-group no-border">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-phone"></i>
                  </span>
                </div>
                <input type="number" class="form-control" value="<?php echo $user[0]['nomor_telepon'] ?>" name="nomor_telepon" placeholder="Masukkan Nomor Telepon" required>
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span style="width:75px; height:32px; font-size:8px;" class="input-group-text" id="inputGroupFileAddon01">Upload Foto</span>
                </div>
                <div class="custom-file">
                  <input accept="image/*" type="file" name="user_foto" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01"  >
                  <label style="font-size:12px;" class="custom-file-label" for="inputGroupFile01">Choose File</label>
                </div>
              </div>
            </div>
            <div class="card-footer text-center">
              <button type="submit" class="btn btn-neutral btn-round btn-lg">Simpan</button>
              <?php echo validation_errors('<div class="error">', '</div>'); ?>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
document.addEventListener("DOMContentLoaded", function() {
  console.log("DOM loaded");
    var elements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function(e) {
          if(e.target.validity.badInput){
            e.target.setCustomValidity("Masukan harus angka");
            return;
          }
            if (e.target.validity.valueMissing) {
                e.target.setCustomValidity("Data tidak boleh kosong");
                return;
            }

        };
        elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
        };
    }
})
</script>
