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
            <form class="" action="<?php echo base_url('menu/addMenu') ?>" method="post">
              <div class="form-group">
                <label>Menu</label>
                <input type="text" name="menu" class="form-control">
                <?= form_error('menu','<small class="text-danger pl-3">','</small>');?>
              </div>
              <button type="submit" class="btn btn-primary">Save</button>
              <a href="<?=base_url('menu') ?>" class="btn btn-danger">Cancel</a>
            </form>
          </div>
        </div>
      </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
