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
        <div class="box box-solid">
          <div class="box-body">
            <?= $this->session->flashdata('pesan')?>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="txtnama" class="form-control" value="<?= $user['nama'] ?>" readonly>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="txtemail" class="form-control" value="<?= $user['email'] ?>" readonly>
            </div>
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <input type="text" name="txtjekel" class="form-control"
                value="<?php
                  if($user['jekel']=='L'){
                    echo 'Laki-Laki';
                  }elseif($user['jekel']=='P'){
                    echo 'Perempuan';
                  }else{
                    echo '';
                  }
                ?>"
              readonly>
            </div>
            <div class="form-group">
              <label>No Telepon</label>
              <input type="text" name="txtemail" class="form-control" value="<?= $user['notelp'] ?>" readonly>
            </div>
            <div class="form-group">
              <a href="<?= base_url('akun/ubahProfile') ?>" class="btn btn-primary">Edit Profile</a>
              <a href="<?= base_url('akun/gantiPassword') ?>" class="btn btn-warning">Ganti Password</a>
            </div>
          </div>
        </div>
      </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
