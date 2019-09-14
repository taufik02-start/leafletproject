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
        <div class="box box-success">
          <div class="box-body">
            <form class="" action="<?php echo base_url('data/addLahan')?>" method="post">
              <div class="form-group">
                <label>Kode Kecamatan</label>
                <input type="text" name="txtkodekec" class="form-control">
                <?= form_error('txtkodekec','<small class="text-danger pl-3">','</small>');?>
              </div>
              <div class="form-group">
                <label>Nama Kecamatan</label>
                <input type="text" name="txtnamakec" class="form-control">
                <?= form_error('txtnamakec','<small class="text-danger pl-3">','</small>');?>
              </div>
              <div class="form-group">
                <label>Luas Lahan (ha)</label>
                <input type="number" name="txtluas" class="form-control">
                <?= form_error('txtluas','<small class="text-danger pl-3">','</small>');?>
              </div>
              <div class="form-group">
                <label>Status Lahan</label>
                <input type="text" name="txtstatus" class="form-control">
                <?= form_error('txtstatus','<small class="text-danger pl-3">','</small>');?>
              </div>
              <div class="form-group">
                <label>Latitude</label>
                <input type="text" name="txtlatitude" class="form-control">
                <?= form_error('txtlatitude','<small class="text-danger pl-3">','</small>');?>
              </div>
              <div class="form-group">
                <label>Longitude</label>
                <input type="text" name="txtlongitude" class="form-control">
                <?= form_error('txtlongitude','<small class="text-danger pl-3">','</small>');?>
              </div>
              <button type="submit" class="btn btn-primary">Save</button>
              <a href="<?=base_url('data/lahan') ?>" class="btn btn-danger">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
