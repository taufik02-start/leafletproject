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
          <div class="box-header with-border">
          <h3 class="box-title">Keterangan</h3>
        </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-2">
                <a class="boxKuning">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
              </div>
              <div class="col-md">
                Tanah ini bagus untuk kelapa
              </div>
            </div>
            <!-- <div class="row">
              <div class="col-md-2">
                <a class="boxKuning">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
              </div>
              <div class="col-md">
                Tanah ini bagus jika ditambah pupuk ...
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="box box-primary">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <a href ="#" class="btn btn-success pull-right">Print</a>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12">
              <table class="table table-bordered text-center">
                <tr class="bg-primary">
                  <th>No</th>
                  <th>Nama</th>
                  <th>Luas Lahan (ha)</th>
                  <th>Status</th>
                  <th>Jumlah Kelapa</th>
                </tr>

                <?php
                $i=1;
                foreach ($potensilahan as $pts):?>
                  <tr>
                    <td><?=$i ?></td>
                    <td><?=$pts['nama_kecamatan']?></td>
                    <td><?=number_format($pts['luas_lahan'],0,',','.')?></td>
                    <td><?=$pts['status_lahan']?></td>
                    <td><?=number_format($pts['jumlah_kelapa'],0,',','.')?></td>
                  </tr>
                <?php
                $i++;
                endforeach;?>
              </table>
            </div>
          </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!--Setting Maps-->
<script>
  var map = L.map('mapid').setView([-0.917311,100.4366864], 10);
  var base_url = "<?=base_url()?>";
  L.tileLayer('http://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributore'
  }).addTo(map);
  var myFeatureGroup = L.featureGroup().addTo(map).on("click",groupClick);
  var bangunanMarker;
  // script costum marker + pengambilan data dari database
  // $.getJSON(base_url+"potensilahan/getLahanJson", function(data){
  //   $.each(data, function(i, field){
  //     var latitude = parseFloat(data[i].latitude);
  //     var longitude = parseFloat(data[i].longitude);
  //     var icon_lahan = L.icon({
  //       iconUrl : base_url+"asset/dist/img/lahan.png",
  //       iconSize :[30,30]
  //     });
  //     bangunanMarker = L.marker([latitude,longitude],{icon:icon_lahan}).addTo(myFeatureGroup)
  //       .bindPopup(data[i].nama);
  //       bangunanMarker.kode = data[i].kode;
  //   });
  // });
  function groupClick(event){
    console.log(event.layer.kode);
  }
    $.getJSON(base_url+"asset/geojson/map.geojson", function(data){
      geoLayer = L.geoJson(data,{
        style: function(feature){
          return{
            fillOpacity:0.8,
            fillColor: 'white',
            weight:2,
            opacity:1,
            color:"black"
          };
        },
        onEachFeature: function(feuture,layer){
          var kode = feuture.properties.name;
          var latitude = parseFloat(feuture.properties.latitude);
          var longitude = parseFloat(feuture.properties.longitude);
          //disini ambil data dari database tambahkan tulisan
          var label = L.marker([latitude,longitude], {
            icon: L.divIcon({
              className: 'label',
              html: kode,
              iconSize: [100, 40]
            })
          }).addTo(map);
        }
      }).addTo(map);
    });
</script>
