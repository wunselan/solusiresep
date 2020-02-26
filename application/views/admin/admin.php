<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin-Resepmu</title>

  <!-- Custom fonts for this template -->
  <link href="http://localhost/resepmu/application/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="http://localhost/resepmu/application/assets/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="http://localhost/resepmu/application/assets/sweetalert/sweetalert.css" rel="stylesheet">
  <link href="http://localhost/resepmu/application/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
<style media="screen">
  .sidebar{
    background-color: #f96332 !important;
    background-image: linear-gradient(180deg,#f96332 10%,#f96332 100%) !important;
  }
  .page-item.active .page-link{
    background-color: #f96332 !important;
    border-color: #f96332 !important;
  }
</style>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('user/admin')?>">

        <div class="sidebar-brand-text mx-3">ADMIN RESEP•MU</div>
      </a>

      <hr class="sidebar-divider">

      <!-- Nav Item - Tables -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('user/admin')?>">
          <i class="fa fa-users" ></i>
          <span>Daftar Member</span></a>
      </li>
      <hr class="sidebar-divider">

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('resep/listresep')?> ">
        <i class="fa fa-birthday-cake"></i>
          <span>Daftar Resep</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->


    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">



          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                <i class="fa fa-user-circle" ></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                <a class="dropdown-item" href="<?php echo base_url('user/logout')?>">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 style="color:#f96332;"class="m-0 font-weight-bold ">Daftar Member</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nama</th>
                      <th>Jenis Kelamin</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Email</th>
                      <th>Nomor Telepon</th>
                      <th>Foto User</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($getUser->result() as $row) { ?>
                      <tr>
                        <td><?php echo $row->id_user ?></td>
                        <td><?php echo $row->nama ?></td>
                        <td><?php echo $row->jenis_kelamin ?></td>
                        <td><?php echo $row->username ?></td>
                        <td><?php echo $row->password ?></td>
                        <td><?php echo $row->email ?></td>
                        <td><?php echo $row->nomor_telepon ?></td>
                        <td><?php echo $row->user_foto ?></td>
                        <td>
                          <button data-id="<?php echo $row->id_user ?>" data-nama="<?php echo $row->nama ?>" data-jenis="<?php echo $row->jenis_kelamin ?>" data-username="<?php echo $row->username ?>"
                            data-password="<?php echo $row->password ?>" data-email="<?php echo $row->email ?>" data-telepon="<?php echo $row->nomor_telepon ?>"
                            data-foto=""<?php echo $row->user_foto?>
                            style="padding:6px; font-size:12px;" class="btn btn-primary btn-xs edit" data-title="Edit" data-toggle="modal" data-target="#edit" ><i class="fas fa-pencil-alt"></i></i></button>
                          <a href="#" style="padding:9px; font-size:8px; background-color:#d82a2a" id="hapus" data-uid='<?php echo base_url('user/delete_user/').$row->id_user?>' class="btn btn-primary">Hapus</a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <form class="form" method="post" id="form" action="" enctype="multipart/form-data">
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <small>Id User</small>
              <input class="form-control" id="id" type="text" placeholder="" disabled>
            </div>
            <div class="form-group">
              <small>Nama</small>
              <input class="form-control" name="nama" id="nama" type="text" placeholder="" required>
            </div>
            <div class="form-group">
              <small>Jenis Kelamin</small>
              <select style="margin-bottom:10px;" name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                <option value="Laki-laki" <?= $row->jenis_kelamin == "Laki-laki" ? "selected" : "" ?> style="color:black;">Laki-laki</option>
                <option value="Perempuan" <?= $row->jenis_kelamin == "Perempuan" ? "selected" : "" ?> style="color:black;">Perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <small>Username</small>
              <input class="form-control" name="username" id="username" type="text" placeholder="" disabled>
            </div>
            <div class="form-group">
              <small>Password</small>
              <input class="form-control" name="password" id="password" type="password" placeholder="" >
            </div>
            <div class="form-group">
              <small>Email</small>
              <input class="form-control email" name="email" id="email" type="email" placeholder="" required>
            </div>
            <div class="form-group">
              <small>Nomor Telepon</small>
              <input class="form-control" name="nomor_telepon" id="nomor_telepon" type="number" placeholder="" required>
            </div>
            <div class="input-group">
              <div class="input-group-prepend">
                <span style="width:75px; height:32px; font-size:8px;" class="input-group-text" id="inputGroupFileAddon01">Upload Foto</span>
              </div>
              <div class="custom-file">
                <input accept="image/*" type="file" id="user_foto" name="user_foto" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                <label style="font-size:12px;" class="custom-file-label" for="inputGroupFile01">Choose file</label>
              </div>
            </div>
          </div>
              <div class="modal-footer ">
            <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Simpan</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
          <!-- /.modal-dialog -->
  </div>
  </form>


  <!-- Bootstrap core JavaScript-->
  <script src="http://localhost/resepmu/application/assets/vendor/jquery/jquery.min.js"></script>
  <script src="http://localhost/resepmu/application/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="http://localhost/resepmu/application/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="http://localhost/resepmu/application/assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="http://localhost/resepmu/application/assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="http://localhost/resepmu/application/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="http://localhost/resepmu/application/assets/js/datatables-demo.js"></script>
  <script src="http://localhost/resepmu/application/assets/sweetalert/sweetalert.min.js"></script>
  <script src="http://localhost/resepmu/application/assets/sweetalert/jquery.sweet-alert.custom.js"></script>


<script>
var url = '<?php echo base_url('user/updateProfile_admin/')?>';
$(document).on('click','#hapus',function(e){
  e.preventDefault();
  var uid=$(this).data('uid');
  swal(
        {
            title: "Apakah anda yakin menghapus data ini?",
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
$("#dataTable").on("click", ".edit", function(e) {
    e.preventDefault();
    $('#id').val($(this).data('id'));
    $('#nama').val($(this).data('nama'));
    $('#jenis_kelamin').val($(this).data('jenis'));
    $('#username').val($(this).data('username'));
    $('#password').val($(this).data('password'));
    $('#email').val($(this).data('email'));
    $('#nomor_telepon').val($(this).data('telepon'));
    $('#user_foto').val($(this).data('foto'));
    $('#form').attr("action", url + $(this).data('id'));
});
$(document).ready(function () {
    $('#email').on({
        invalid: function (e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity("Email tidak valid");
             }
        },
        input: function(e) {
            e.target.setCustomValidity("");
        }
    });
});
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
});

</script>
</body>
</html>
