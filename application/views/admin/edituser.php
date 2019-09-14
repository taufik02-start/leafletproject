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
            <form class="" action="<?php echo base_url('data/editUser/').$listuser['id']?>" method="post">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?=$listuser['nama']?>" placeholder="Nama Anda">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?=$listuser['email']?>" placeholder="Email Anda" readonly>
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
              <div class="form-group">
                <label>Jenis Akses</label>
                <select class="form-control" name="jenisakses">
                  <?php foreach ($jenisakses as $akses):?>
                    <option value="<?= $akses['id']?>" <?php echo($listuser['jenis_id']==$akses['id'])? 'selected':''?>><?= $akses['nama']?></option>
                  <?php endforeach;?>
                </select>
              </div>
              <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="aktivasi">
                  <option value="0" <?php echo($listuser['aktivasi']==0)? 'selected':''?>>Tidak Aktif</option>
                  <option value="1" <?php echo($listuser['aktivasi']==1)? 'selected':''?>>Aktif</option>
                </select>
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
