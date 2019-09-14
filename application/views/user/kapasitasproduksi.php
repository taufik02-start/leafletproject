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
    <form  method="post" action="<?=base_url('lahan/analisisMesin') ?>">
      <div class="row">
        <div class="col-md-5">
          <div class="box box-success">
              <div class="box-body">
                <div class="form-group">
                  <label>Jumlah Kelapa</label>
                  <input type="text" name="jumlahkelapa" class="form-control" value="<?=number_format($jumlahkelapa,0,',','.')?>" readonly>
                </div>
                <div class="form-group">
                  <label>Rendemen Santan</label>
                  <input type="text" name="rendemensantan" class="form-control"  value="0,56" readonly>
                </div>
                <div class="form-group">
                  <label>Rendemen VCO</label>
                  <input type="text" name="rendemenvco" class="form-control"  value="0,35" readonly>
                </div>
                <div class="form-group">
                  <label>Jumlah Daging Kelapa</label>
                  <input type="text" name="jumlahmesin" class="form-control"  value="<?=number_format($jumlahdagingkelapa,0,',','.')?>" readonly>
                </div>
                <div class="form-group">
                  <label>Pilih Jenis Mesin</label>
                  <select class="form-control" name="jenisMesin" id="jenisMesin">
                    <option>Pilh Mesih Centifuse</option>
                    <option value="100">Centifuse 100 Liter</option>
                    <option value="150">Centifuse 150 Liter</option>
                    <option value="200">Centifuse 200 Liter</option>
                    <option value="300">Centifuse 300 Liter</option>
                  </select>
                  <?= form_error('jenisMesin','<small class="text-danger pl-3">','</small>');?>
                </div>
              </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="box box-primary">
              <div class="box-body">
                <div class="form-group">
                  <label>Frekuensi Pemutaran</label>
                  <input type="text" name="frekuensipemutaran" class="form-control" id="frekuensipemutaran" readonly>
                  <?= form_error('frekuensipemutaran','<small class="text-danger pl-3">','</small>');?>
                </div>
                <div class="form-group">
                  <label>Frekuensi Pemutaran dalam Satu Hari</label>
                  <input type="text" name="frekuensiperhari" class="form-control" id="frekuensiperhari" readonly>
                  <?= form_error('frekuensiperhari','<small class="text-danger pl-3">','</small>');?>
                </div>
                <div class="form-group">
                  <label>Jumlah Mesin Yang Dibutuhkan</label>
                  <input type="text" name="jumlahmesin" class="form-control" id="jumlahmesin" readonly>
                  <?= form_error('jumlahmesin','<small class="text-danger pl-3">','</small>');?>
                </div>
                <div class="form-group">
                  <label>Jumlah VCO yang Dihasilkan (Bulan)</label>
                  <input type="text" name="jumlahvco" class="form-control" id="jumlahvco" readonly>
                  <?= form_error('jumlahvco','<small class="text-danger pl-3">','</small>');?>
                </div>

                <!-- <div class="form-group">
                  <label>Biaya Produksi</label>
                  <input type="text" name="" class="form-control" readonly>
                </div> -->
              </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <input type="submit" class="btn btn-primary" name="submit" value="selanjutnya">
          <a href="" class="btn btn-danger">Kembali</a>
        </div>
      </div>
    </from>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
  $(document).ready(function(){
    var base_url = "<?=base_url()?>";
    $("#jenisMesin").change(function(){
        var kemampuan = $("#jenisMesin").val();
        $.ajax({
          type:'post',
          url:base_url+"lahan/getHasilByMesin",
          async:true,
          dataType:"JSON",
          data:{mesin:kemampuan},
          error:function(){
            document.getElementById("frekuensiperhari").value="";
            document.getElementById("frekuensipemutaran").value="";
            document.getElementById("jumlahmesin").value="";
            document.getElementById("jumlahvco").value="";
          },
          success:function(data){
            document.getElementById("frekuensiperhari").value=data.pemutaranperhari;
            document.getElementById("frekuensipemutaran").value=data.frekunesi;
            document.getElementById("jumlahmesin").value=data.jumlahmesin;
            document.getElementById("jumlahvco").value=data.jumlahvco+" Liter";
          }
        })
      });
  });
</script>
