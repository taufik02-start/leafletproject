</body>
<script>
  //script menampilkan peta
  var map = L.map('map').setView([-0.7296484, 100.2526167], 15);
  L.tileLayer(
'https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoidGF1ZmlrMDIiLCJhIjoiY2swaTZtZ2h2MDB4NDNtbnNsaW5ieWV0cyJ9.KjjM-HpmgKiDosjBvUHjlg', {
    tileSize: 512,
    zoomOffset: -1,
    attribution: '© <a href="https://www.mapbox.com/map-feedback/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
  L.marker([-0.7296484, 100.2526167]).addTo(map)
  .bindPopup('Gudang')
  .openPopup();
</script>
<!-- Swal -->
<script src="<?php echo base_url() ?>asset/bower_components/sweatalert/sweetalert2.all.min.js"></script>
<!-- MyScript -->
<script src="<?php echo base_url() ?>asset/myscript.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url() ?>asset/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url() ?>asset/bower_components/morris.js/morris.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>asset/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url() ?>asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url() ?>asset/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>asset/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $('#datatable').DataTable()({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script type="text/javascript">
    $('#editor').wysihtml5();
</script>
</html>
