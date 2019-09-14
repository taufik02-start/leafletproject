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
            <form action="<?php echo base_url('akun/ubahProfile') ?>" method="post">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= $user['nama'] ?>">
                <?= form_error('nama','<small class="text-danger pl-3">','</small>');?>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?= $user['email'] ?>" readonly>
              </div>
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <br><input type="radio" name="jekel" class="form-check-input" value="L" <?php echo ($user['jekel']=='L')?'checked':'checked'?>>
                <label class="form-check-label mr-3">Laki-Laki</label>
                <input type="radio" name="jekel" class="form-check-input" value="P" <?php echo ($user['jekel']=='P')?'checked':''?>>
                <label class="form-check-label">Perempuan</label>
              </div>
              <div class="form-group mt-k3">
                <label>No Telepon</label>
                <input type="text" name="notelp" class="form-control" value="<?= $user['notelp'] ?>">
                <?= form_error('notelp','<small class="text-danger pl-3">','</small>');?>
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
