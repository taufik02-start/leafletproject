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
      <div class="col-md-5">
        <div class="box box-success">
          <div class="box-body ">
            <div class="row">
              <div class="col-md-4">
                Lokasi Pabrik
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
            <div class="row mt-3">
              <div class="col-md-12">
                <table class="table table-bordered text-center">
                  <thead>
                    <tr class="bg-primary">
                      <th>No</th>
                      <th>Nama Kecamatan</th>
                      <th>Jarak</th>
                    </tr>
                  </thead>
                  <tbody class="data">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="map"></div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
  $('#kecamatan').on('change',function(){
    getJarak();
  });
  function getJarak(){
    $.ajax({
      url:'<?=base_url()?>'+'lahan/tampilDataPermintaan',
      async : true,
      dataType : 'JSON',
      success:function(data){
        myfunction(data);
      }
    });
  }
  function myfunction(data){
    for(var i=0;i<data.length;i++){
      var lat1=data[i].latitude;
      var lang1=data[i].longitude;
      var lat2=-0.8961947;
      var lang2=100.417438;
      var wayPoint1 = L.latLng(lat1,lang1);
      var wayPoint2 = L.latLng(lat2,lang2);
      tampilJalur(lat1,lang1,lat2,lang2);
      var nama_kecamatan = data[i].nama_kecamatan;
      rWP1 = new L.Routing.Waypoint;
      rWP1.latLng = wayPoint1;
      rWP2 = new L.Routing.Waypoint;
      rWP2.latLng = wayPoint2;
      var myRoute =  L.routing.mapbox('pk.eyJ1IjoidGF1ZmlrMDIiLCJhIjoiY2swaTZtZ2h2MDB4NDNtbnNsaW5ieWV0cyJ9.KjjM-HpmgKiDosjBvUHjlg');
      myRoute.route([rWP1, rWP2], function(err, routes) {
        distance = routes[0].summary.totalDistance / 1000;
        tampilTabelJarak(i,nama_kecamatan,distance);
      });
      console.log(nama_kecamatan);
    }
  }
  function tampilTabelJarak(i,nama_kecamatan,distance){
    var html;
    var nomor = i;
    html += '<tr>'+
            '<td>'+nomor+'</td>'+
            '<td>'+nama_kecamatan+'</td>'+
            '<td>'+distance+'</td>'
            '</tr>';
            $('.data').html(html);
  }
  function tampilJalur(lat1,long1,lat2,long2){
    var control = L.Routing.control({
    	waypoints: [
    		L.latLng(lat1, long1),
    		L.latLng(lat2, long2)
    	],show:false,
      createMarker: function() { return null; },
    	routeWhileDragging: false,
      addWaypoints:false,
    	reverseWaypoints: false,
    	showAlternatives: false,
    	altLineOptions: {
    		styles: [
    			{color: 'black', opacity: 0.15, weight: 9},
    			{color: 'white', opacity: 0.8, weight: 6},
    			{color: 'blue', opacity: 0.5, weight: 2},
    		]
    	},
      lineOptions: {
        styles: [{color: '#3670e3', opacity: 1, weight: 5}]
      },
    	router: L.Routing.mapbox('pk.eyJ1IjoidGF1ZmlrMDIiLCJhIjoiY2swaTZtZ2h2MDB4NDNtbnNsaW5ieWV0cyJ9.KjjM-HpmgKiDosjBvUHjlg')
    }).addTo(map);

    L.Routing.errorControl(control).addTo(map);
  }
</script>
