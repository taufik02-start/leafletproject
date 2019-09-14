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
            <form action="<?php echo base_url('data/addMesin')?>" method="post">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="txtnama" class="form-control">
                <?= form_error('txtnama','<small class="text-danger pl-3">','</small>');?>
              </div>
              <div class="form-group">
                <label>Potensi</label>
                <input type="number" name="txtpotensi" class="form-control">
                <?= form_error('txtpotensi','<small class="text-danger pl-3">','</small>');?>
              </div>
              <button type="submit" class="btn btn-primary">Save</button>
              <a href="<?=base_url('data/mesin') ?>" class="btn btn-danger">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>  
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
