<style media="screen">
.anyClass {
height:800px;
overflow-y: scroll;
}
@media (max-width: 992px) {
 .title {
   margin-top: 70px;
 }
 .anyClass {
 height:800px;
 overflow-y: scroll;
 }
}
</style>
<body class="login-page sidebar-collapse">
  <div class="page-header clear-filter" filter-color="orange">
    <div class="page-header-image" style="background-image:url(/resepmu/application/assets/img/login.jpg)"></div>
    <div class="content anyClass">
      <div class="container">
        <div class="col-md-4 ml-auto mr-auto">
          <div class="card card-login card-plain">
            <form class="form" method="post" action="<?php echo base_url('resep/updateresep/'.$resep[0]['id_resep']);?>" enctype="multipart/form-data">
              <div class="card-header text-center">
                  <h1 class="title">
                    <a>Tulis Resepmu</a>
                  </h1>
              </div>
              <div class="card-body">
                <div class="input-group no-border input-lg">
                  <input type="text" class="form-control" id="nama_resep" name="nama_resep" placeholder="Masukkan Nama Resep" value="<?php echo $resep[0]['nama_resep'] ?>" required />
                </div>
                <div class="input-group no-border input-lg">
                  <input type="number" class="form-control" id="durasi" name="durasi" placeholder="Masukkan Lama Durasi Memasak (Menit)" value="<?php echo $resep[0]['durasi'] ?>" required />

                </div>
                <div class="input-group no-border input-lg">
                  <input type="number" class="form-control" id="porsi" name="porsi" placeholder="Masukkan Jumlah Porsi Makanan" value="<?php echo $resep[0]['porsi'] ?>" required />
                </div>
                <div class="input_field_wrapper">
                <div class="input-group no-border input-lg">
                  <input type="text" placeholder="Masukkan Bahan Makanan" class="form-control" id="inputBahan"  />
                  <a href="javascript:void(0);" class="add_button" title="Add field"><button class=" btn btn-primary" style=" margin:5px;">+</button></a>
                </div>
                <div class="inp1">

                </div>
              </div>
              <div class="input_field_wrapper1">
              <div class="input-group no-border input-lg">
                <input type="text" placeholder="Masukkan Langkah Memasak" class="form-control" id="inputLangkah" />
                <a href="javascript:void(1);" class="add_button1" title="Add field"><button class=" btn btn-primary" style=" margin:5px;">+</button></a>
              </div>
              <div class="inp">

              </div>
            </div>
            <div class="input-group">
              <div class="input-group-prepend">
                <span style="width:75px; height:32px; font-size:8px;" class="input-group-text" id="inputGroupFileAddon01">Upload Foto</span>
              </div>
              <div class="custom-file">
                <input accept="image/*" type="file" id="resep_foto" name="resep_foto" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                <label style="font-size:12px;" class="custom-file-label" for="inputGroupFile01">Choose file</label>
              </div>
            </div>
              </div>
              <div class="card-footer text-center">
                <button type="submit" id="unggah" class="btn btn-primary btn-round btn-lg btn-block">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script type="text/javascript">
$(document).ready(function(){
    var maxFieldLimit = 10; //Input fields increment limitation
    var add_more_button = $('.add_button'); //Add button selector
    var Fieldwrapper = $('.inp1'); //Input field wrapper
    var test2 = '<?php echo $resep[0]['bahan_makanan'];?>'.split(", ");
    var x = 1; //Initial field counter is 1
    var item=test2;
    refreshItem1(item);

    function refreshItem1(arrItem){
      $('.inp1').html("");
      for (var i = 0; i < arrItem.length; i++) {
        var fieldHTML = '<div class="inp1 input-group no-border input-lg"><input type="text" class="bahan_makanan form-control" name="bahan_makanan[]" value="'+arrItem[i]+'" required /><a href="javascript:void(1);" class="remove_button" title="Remove field"><button class=" btn btn-primary" style=" margin:5px;">-</button></a></div>';
        $(Fieldwrapper).append(fieldHTML);
      }
    }

    $(add_more_button).click(function(e){ //Once add button is clicked
      e.preventDefault();
            x++; //Increment field counter
          //$(Fieldwrapper).append(fieldHTML); // Add field html
            item.push($('#inputBahan').val());
            refreshItem1(item);
            document.getElementById('inputBahan').value = '';

    });
    $(Fieldwrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        item.remove($(this).prev().val());
        refreshItem1(item);
        x--; //Decrement field counter
    });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    var maxFieldLimit = 10; //Input fields increment limitation
    var add_more_button = $('.add_button1'); //Add button selector
    var test = '<?php echo $resep[0]['langkah_memasak'];?>'.split("| ");
    var Fieldwrapper = $('.inp'); //Input field wrapper
     //New input field html
    var x = 1; //Initial field counter is 1
    var item =test;
    refreshItem(item);
    function refreshItem(arrItem){
      $('.inp').html("");
      for (var i = 0; i < arrItem.length; i++) {
        var fieldHTML = '<div class="inp input-group no-border input-lg"><div class="input-group-prepend"><span class="input-group-text">'+(i+1)+"."+'</span></div><input type="text" class="langkah_memasak form-control" name="langkah_memasak[]" value="'+arrItem[i]+'" required /><a href="javascript:void(1);" class="remove_button" title="Remove field"><button class=" btn btn-primary" style=" margin:5px;">-</button></a></div>';
        $(Fieldwrapper).append(fieldHTML);
      }
    }
    $(add_more_button).click(function(e){ //Once add button is clicked
        //if(x < maxFieldLimit){ //Check maximum number of input fields
        e.preventDefault();
            x++; //Increment field counter
            //var fieldHTML = '<div class="input-group no-border input-lg"><div class="input-group-prepend"><span class="input-group-text">1.</span></div><input type="text" class="form-control" name="langkah_memasak" value="" required /><a href="javascript:void(1);" class="remove_button" title="Remove field"><button class=" btn btn-primary" style=" margin:5px;">-</button></a></div>';
            item.push($('#inputLangkah').val());
            refreshItem(item);

            document.getElementById('inputLangkah').value = '';
            //$(Fieldwrapper).append(fieldHTML); // Add field html
        //}
    });

    $(Fieldwrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        //console.log($(this).prev().val());
        item.remove($(this).prev().val());
        refreshItem(item);
        x--; //Decrement field counter
    });

});
Array.prototype.remove = function() {
    var what, a = arguments, L = a.length, ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};
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
