<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= $judul ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><?= $judul ?></li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="box">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahData"><i class="fas fa-plus"></i>Tambah Data</button>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <table class="table table-bordered">
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Nama</th>
                  <th class="text-center">Latitude</th>
                  <th class="text-center">Longitude</th>
                  <th class="text-center">Luas</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Jumlah</th>
                  <th class="text-center">Jarak</th>
                  <th class="text-center">Action</th>
                </tr>
              </table>
            </div>
          </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Modal -->
<div class="modal fade" id="modalTambahData" tabindex="-1" role="dialog" aria-labelledby="TambahData" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="TambahData">Form Input Data Lahan Perkebunan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="" action="<?php echo base_url() ?>tambah_aksi" method="post">
          <div class="form-group">
            <label>Kode Kecamatan</label>
            <input type="text" name="txtkodekec" class="form-control">
          </div>
          <div class="form-group">
            <label>Nama Kecamatan</label>
            <input type="text" name="txtnamakece" class="form-control">
          </div>
          <div class="form-group">
            <label>Latitude</label>
            <input type="text" name="txtlatitudekec" class="form-control">
          </div>
          <div class="form-group">
            <label>Longitude</label>
            <input type="text" name="txtlongitudekec" class="form-control">
          </div>
          <div class="form-group">
            <label>Luas</label>
            <input type="text" name="txtluas" class="form-control">
          </div>
          <div class="form-group">
            <label>Status</label>
            <input type="text" name="txtstatus" class="form-control">
          </div>
          <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="txtstatus" class="form-control" min=0>
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="reset" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal-->
