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
        <div class="box box-primary">
          <div class="box-body">
            <form class="" action="<?php echo base_url('menu/addsubmenu') ?>" method="post">
              <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control">
                <?= form_error('title','<small class="text-danger pl-3">','</small>');?>
              </div>
              <div class="form-group">
                <label>Menu</label>
                <select class="form-control" name="menuid">
                  <option value="">Pilih Menu</option>
                  <?php foreach ($menu as $m):?>
                    <option value="<?= $m['id']?>"><?= $m['menu']?></option>
                  <?php endforeach;?>
                </select>
                <?= form_error('menuid','<small class="text-danger pl-3">','</small>');?>
              </div>
              <div class="form-group">
                <label>Url</label>
                <input type="text" name="url" class="form-control">
                <?= form_error('url','<small class="text-danger pl-3">','</small>');?>
              </div>
              <div class="form-group">
                <label>Icon</label>
                <input type="text" name="icon" class="form-control">
                <?= form_error('icon','<small class="text-danger pl-3">','</small>');?>
              </div>
              <div class="form-group">
                <label>Status</label>
                <br>
                <input type="radio" name="status" class="form-check-input" value="1" checked>
                <label class="form-check-label mr-3">Aktif</label>
                <input type="radio" name="status" class="form-check-input" value="0">
                <label class="form-check-label">Tidak Aktif</label>
              </div>
              <button type="submit" class="btn btn-primary">Save</button>
              <a href="<?=base_url('menu/submenu') ?>" class="btn btn-danger">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
