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
        <div class="box box-danger">
          <div class="box-body">
            <?= $this->session->flashdata('pesan')?>
            <form action="<?php echo base_url('akun/gantiPassword') ?>" method="post">
              <div class="form-group">
                <label>Password Lama</label>
                <input type="password" name="txtpasswordlama" class="form-control">
                <?= form_error('txtpasswordlama','<small class="text-danger pl-3">','</small>');?>
              </div>
              <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="txtpassword1" class="form-control">
                <?= form_error('txtpassword1','<small class="text-danger pl-3">','</small>');?>
              </div>
              <div class="form-group">
                <label>Ulangi Password Baru</label>
                <input type="password" name="txtpassword2" class="form-control">
                <?= form_error('txtpassword2','<small class="text-danger pl-3">','</small>');?>
              </div>
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="<?=base_url('akun')?>" class="btn btn-danger">Batal</a>
            </form>
          </div>
        </div>
      </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
