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
            <?= $this->session->flashdata('pesan')?>
            <form class="" action="<?php echo base_url('data/addUser')?>" method="post">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?=set_value('nama')?>" placeholder="Nama Anda">
                <?= form_error('nama','<small class="text-danger pl-3">','</small>');?>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?=set_value('email')?>" placeholder="Email Anda">
                <?= form_error('email','<small class="text-danger pl-3">','</small>');?>
              </div>
              <div class="form-group">
                <label>Jenis Akses</label>
                <select class="form-control" name="jenisakses">
                  <?php foreach ($jenisakses as $akses):?>
                    <option value="<?= $akses['id']?>"><?= $akses['nama']?></option>
                  <?php endforeach;?>
                </select>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="password1" name="password1" value="<?=set_value('password1')?>" placeholder="Password">
                <?= form_error('password1','<small class="text-danger pl-3">','</small>');?>
              </div>
              <div class="form-group">
                <label>Repeat Password</label>
                <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                <?= form_error('password2','<small class="text-danger pl-3">','</small>');?>
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
