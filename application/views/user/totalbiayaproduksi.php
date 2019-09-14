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
      <div class="col-md-12">
        <div class="box box-success">
            <div class="box-body">
              <form  method="post">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Harga VCO (Rp)</label>
                      <input type="text" name="hargavco" class="form-control uang" id="hargavco">
                    </div>
                    <div class="form-group">
                      <label>Jumlah VCO (L)</label>
                      <input type="text" name="jumlahvco" id="jumlahvco" class="form-control" data-jumlahvco="<?=$lahan['jumlah_vco'] ?>" value="<?=number_format($lahan['jumlah_vco'] ,2,',','.')?>" id="jumlahvco" readonly>
                    </div>
                    <div class="form-group">
                      <label>Jumlah VCO yang dijual (%)</label>
                      <input type="number" name="persentasejvco" class="form-control numberper" max="100" id="persentasejvco">
                    </div>
                    <div class="form-group">
                      <label>Biaya pembelian kelapa (Rp) / (Kg)</label>
                      <input type="text" name="biayapembeliankelapa" class="form-control uang" id="biayapembeliankelapa">
                    </div>
                    <div class="form-group">
                      <label>Jumlah pembelian kelapa dari petani (Kg)</label>
                      <input type="text" name="jumlahkelapa" id="jumlahkelapa" class="form-control" value="<?=number_format($lahan['jumlah_kelapa'],0,',','.') ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Biaya tenaga kerja (Rp)</label>
                      <input type="text" name="biayatenagakerja" class="form-control uang" id="biayatenagakerja">
                    </div>
                    <div class="form-group">
                      <label>Jumlah frekuensi pemutaran / Bulan</label>
                      <input type="text" name="frekuensipemutaran" id="frekuensipemutaran" class="form-control" value="<?=number_format($lahan['frekuensi_bulan'],2,',','.')?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Biaya utilitas (Rp)</label>
                      <input type="text" name="biayautilitas" class="form-control uang" id="biayautilitas">
                    </div>
                    <div class="form-group">
                      <label>Biaya Pesediaan kelapa (Rp) / Kg</label>
                      <input type="number" name="biayapersediaankelapa" class="form-control"  id="biayapersediaankelapa" readonly>
                    </div>
                    <div class="form-group">
                      <label>Persentase persediaan kelapa tiap periode (%)</label>
                      <input type="text" name="persenperkelapa" class="form-control" value="0" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Pesediaan kelapa pada akhir periode t-1 (Kg)</label>
                      <input type="text" name="persediaankeltk1" class="form-control" value="0" readonly>
                    </div>
                    <div class="form-group">
                      <label>Pesediaan kelapa pada akhir periode (Kg)</label>
                      <input type="text" name="persediaankelt" class="form-control" value="0" readonly>
                    </div>
                    <div class="form-group">
                      <label>Biaya persediaan VCO (Rp)</label>
                      <input type="text" name="biayapersediaanvco" class="form-control" id="biayapersediaanvco" readonly>
                    </div>
                    <div class="form-group">
                      <label>Persentase persediaan VCO tiap periode (%)</label>
                      <input type="text" name="" class="form-control" id="biayapersenvcot" readonly>
                    </div>
                    <div class="form-group">
                      <label>Pesediaan VCO pada akhir periode (L)</label>
                      <div class="row">
                        <div class="col-md-2">
                          <select class="form-control" name="periodevcot" id="periodevcot">
                            <option value="0">0</option>
                            <?php
                              for($i=1;$i<=12;$i++){?>
                                <option value="<?=$i?>" class="periodevcot" data-periode="<?=$i?>"><?=$i?></option>
                            <?php  }?>
                          </select>
                        </div>
                        <div class="col-md-10">
                          <input type="text" name="persediaanvco" class="form-control" id="persediaanvco" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Pesediaan VCO pada akhir periode t-1 (L)</label>
                      <div class="row">
                        <div class="col-md-2">
                          <input type="number" class="form-control" id="periodetk" readonly>
                        </div>
                        <div class="col-md-10">
                          <input type="text" name="persediaanvcot" class="form-control" id="persediaanvcot" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Koefisien depresiasi alat</label>
                      <input type="text" name="" class="form-control" value="0,18" disabled>
                    </div>
                    <div class="form-group">
                      <label>Koefisien harga alat</label>
                      <input type="text" name="" class="form-control"  value="9,34" disabled>
                    </div>
                    <div class="form-group">
                      <label>Kapasitas mesin centifuse (L)</label>
                      <input type="text" name="kapmesin" id="kapmesin" class="form-control" value="<?=$lahan['kode_mesin'] ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Koefisien eksponensial harga alat</label>
                      <input type="text" name="" class="form-control" value="1,785" readonly>
                    </div>
                    <input type="button" name="btnHitung" class="btn btn-success" id="btnHitung" value="Hitung">
                  </div>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Total Biaya Produksi (Rp)</label>
                <input type="text" name="totalbiayaproduksi" class="form-control" id="totalbiayaproduksi" readonly>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-5">
        <a href="<?=base_url('lahan/jarakPabrik')?>" class="btn btn-primary">Selanjutnya</a>
        <a href="" class="btn btn-danger">Kembali</a>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
  var persentasevco;
  var jumlahvco = $('#jumlahvco').data('jumlahvco');
  $(document).ready(function(){
    $('.uang').mask('000.000.000', {reverse: true});
    $('#periodevcot').change(function (){
      var e = document.getElementById("periodevcot");
      var periodet = e.options[e.selectedIndex].value;
      var periodetk =e.options[e.selectedIndex].value-1;
      var sisatk,sisat;
      document.getElementById('periodetk').value = periodetk;
      //teknis baru
      //periksa persentase jual sudah terisi atau belum
      if(periodet>0 && periodet < 2){
        //sisa t-1 = 0
        //sisa t = jumlahvco

        sisatk = 0;
        sisat = jumlahvco;
      }else if(periodet>0 && periodet >= 2){
        if(periodetk >0 && periodetk < 2){
          //sisa t-1 = persedentase sisa * jumlahvco
          sisatk = (persentasevco/100)*jumlahvco ;
          sisat = jumlahvco+sisatk;
        }
        else if(periodetk >0 && periodetk >= 2){
          //sisa t-1 = (jumlahvco + (persentase sisa * jumlahvco))  persentase sisa
          var sisasebelum = (persentasevco/100)*jumlahvco;
          sisatk = (persentasevco/100)*(jumlahvco+sisasebelum);
          sisat = jumlahvco+sisatk;
        }
      }else{
        // t-1 = 0
        // t=0
        sisatk = 0;
        sisat = 0;
        document.getElementById('periodetk').value = 0;
      }
      $.ajax({
          url:"<?=base_url('lahan/convertString/')?>"+sisat,
          success:function(data){
            document.getElementById('persediaanvco').value = data;
          }
      });
      $.ajax({
          url:"<?=base_url('lahan/convertString/')?>"+sisatk,
          success:function(data){
            document.getElementById('persediaanvcot').value = data;
          }
      });
      //teknis lama
    });
    $('#persentasejvco').change(function(){
      var persen = document.getElementById('persentasejvco').value;
      persentasevco = 100-persen;
      document.getElementById('biayapersenvcot').value=persentasevco;
    });
    $('#hargavco').change(function(){
      var harga = document.getElementById('hargavco').value;
      $.ajax({
          url:"<?=base_url('lahan/convertStringRp/')?>"+harga.replace('.','') * 0.2,
          success:function(data){
            document.getElementById('biayapersediaanvco').value = data;
          }
      });
    });
    $('#biayapembeliankelapa').change(function(){
      var harga = document.getElementById('biayapembeliankelapa').value;
      document.getElementById('biayapersediaankelapa').value=harga.replace('.','') * 0.2;
    });
    //limit input untuk persen
    $('.numberper').on('input',function(){
    var value = $(this).val();
      if ((value !== '') && (value.indexOf('.') === -1)) {
          $(this).val(Math.max(Math.min(value, 100), 0));
      }
    });
    $('#btnHitung').on('click',function(){
      var hargavco = document.getElementById('hargavco').value.replace('.','').replace('.','').replace('.','');
      var jumvcojual = document.getElementById('persentasejvco').value.replace('.','').replace('.','').replace('.','');
      var bypemkelapa = document.getElementById('biayapembeliankelapa').value.replace('.','').replace('.','').replace('.','');
      var bytenkerja = document.getElementById('biayatenagakerja').value.replace('.','').replace('.','').replace('.','');
      var byutilitas = document.getElementById('biayautilitas').value.replace('.','').replace('.','').replace('.','');
      var bypersedkelapa = document.getElementById('biayapersediaankelapa').value.replace('.','').replace('.','').replace('.','');
      var bypersedvco = document.getElementById('biayapersediaanvco').value.replace('.','').replace('.','').replace('.','');
      var pervco = document.getElementById('persediaanvco').value.replace('.','').replace('.','').replace('.','').replace(',','.');
      var pervcot = document.getElementById('persediaanvcot').value.replace('.','').replace('.','').replace('.','').replace(',','.');
      var jumvco = document.getElementById('jumlahvco').value.replace('.','').replace('.','').replace('.','').replace(',','.');
      var jumkelapa = document.getElementById('jumlahkelapa').value.replace('.','').replace('.','').replace('.','');
      var frekbul  = document.getElementById('frekuensipemutaran').value.replace('.','').replace('.','').replace('.','').replace(',','.');
      var kapmesin = document.getElementById('kapmesin').value;
      $.ajax({
        type:'post',
        url:'<?=base_url('lahan/hitungTotalBiayaProduksi')?>',
        data:{hargavco:hargavco,jumvcojual:jumvcojual,bypemkelapa:bypemkelapa,
              bytenkerja:bytenkerja,byutilitas:byutilitas,bypersedkelapa:bypersedkelapa,
              bypersedvco:bypersedvco,pervco:pervco,pervcot:pervcot,jumvco:jumvco,
              jumkelapa:jumkelapa,frekbul:frekbul,kapmesin:kapmesin
            },
        success:function(data){
          document.getElementById('totalbiayaproduksi').value=data;
        },
        error:function(data){
          console.log("error goblok");
        }
      });
    });
  });
</script>
