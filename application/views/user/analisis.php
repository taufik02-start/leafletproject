<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= $judul ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><?= $judul  ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-7">
        <img src="<?= base_url('asset/dist/img/peta.png') ?>" alt="">
      </div>
      <div class="col-md-5">
        <div class="box box-success">
          <div class="box-body ">
            <div class="row">
              <div class="col-md-12">
                <h3 class="text-center">Potensi Lahan</h3>
              </div>
              <div class="col-md-4">
                Kecamatan
              </div>
              <div class="col-md-8">
                <select class="form-control" name="" id="kecamatan">
                  <option value="null">--Pilih Kecamatan--</option>
                  <?php foreach ($kecamatan as $kec ):?>
                    <option value="<?= $kec['kode']?>"><?= $kec['nama_kecamatan']?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-4">
                Luas
              </div>
              <div class="col-md-8">
                <input type="text" name="txtLuas" class="form-control" id="luas" disabled>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-4">
                Status
              </div>
              <div class="col-md-8">
                <input type="text" name="txtstatus" class="form-control" id="status" disabled>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-4">
                Jumlah Kelapa
              </div>
              <div class="col-md-8">
                <input type="text" name="txtkelapa" class="form-control" id="jumlahkelapa" disabled>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-4">
                &nbsp;
              </div>
              <div class="col-md-8">
                <input type="submit" name="" class="btn btn-success" value="Simpan" id="btnsimpan">
                <input type="reset" name="" class="btn btn-danger" value="Batal">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="box box-primary">
        <div class="box-body">
          <div class="row mt-3">
            <div class="col-md-12">
              <table class="table table-bordered text-center" id='table-investasi'>
                <thead>
                  <tr class="bg-primary">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Luas</th>
                    <th>Status</th>
                    <th>Jumlah Kelapa</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="data">

                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <a href="<?=base_url('lahan/analisisMesin') ?>" class="btn btn-primary mr-3" id="btn-next">Selanjutnya</a>
              <input type="reset" name="btncancel" value="Batal" class="btn btn-danger btn-size">
            </div>
          </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
$(document).ready(function(){
  var base_url = "<?=base_url()?>";
  $("#kecamatan").change(function(){
      var kode_lahan = $("#kecamatan").val();
      $.ajax({
        type:'post',
        url:base_url+"lahan/getLahanByKode",
        async:true,
        dataType:"JSON",
        data:{kode:kode_lahan},
        success:function(data){
          document.getElementById("luas").value=data[0].luas_lahan+" ha";
          document.getElementById("status").value=data[0].status_lahan;
          document.getElementById("jumlahkelapa").value=data[0].jumlah_kelapa;
        }
      })
    });
  tampilLahan();
  function tampilLahan(){
          $.ajax({
              type  : 'post',
              url   : base_url+"lahan/tampilDataPermintaan",
              async : true,
              dataType : 'JSON',
              success : function(data){
                  var html = '';
                  var i;
                  for(i=0; i<data.length; i++){
                    var kode = data[i].kode;
                    var namakecamatan = data[i].nama_kecamatan;
                    var luas = data[i].luas_lahan;
                    var status = data[i].status_lahan;
                    var jumlahkelapa = data[i].jumlah_kelapa;
                    var nomor = i +1;
                      html += '<tr>'+
                              '<td>'+nomor+'</td>'+
                              '<td>'+namakecamatan+'</td>'+
                              '<td>'+luas+'</td>'+
                              '<td>'+status+'</td>'+
                              '<td>'+jumlahkelapa+'</td>'+
                              '<td>'+
                              '<a href="javascript:void(0);" class="btn btn-danger item_delete" data-kode="'+kode+'">Hapus</a>'+
                              '</td>'+
                              '</tr>';
                  }
                  $('#data').html(html);
              }
          });
      }
      $('#btnsimpan').on('click',function(){
        var kode_lahan = document.getElementById('kecamatan').value;
        $.ajax({
          type :"POST",
          url:base_url+"lahan/insertDataPermintaan",
          dataType:"JSON",
          data:{kode:kode_lahan},
          error:function(){
            alert("data sudah ada di tabel");
          },
          success: function(){
            tampilLahan();
            document.getElementById("kecamatan").selectedIndex="0";
            document.getElementById("luas").value="";
            document.getElementById("status").value="";
            document.getElementById("jumlahkelapa").value="";
          }});
          return false;
        });
      $('#data').on('click','.item_delete',function(){
      var kode_lahan = $(this).data("kode");
      $.ajax({
        type : "POST",
        url:base_url+"lahan/delete",
        dataType:"JSON",
        data : {kode: kode_lahan},
        success: function(){
          tampilLahan();
        }});
        return false;
        });
    });
</script>
