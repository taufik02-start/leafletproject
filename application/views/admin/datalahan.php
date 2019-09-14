<!-- Sweet Alert-->
<div class="flash-data" data-flashdata="<?=$this->session->flashdata('pesan')?>"
  data-flashjudul="<?=$this->session->flashdata('judul')?>" data-flashtitle="Lahan">
</div>
<!-- And Sweet Alert-->
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
    <div class="box box-primary">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <a href="<?= base_url('data/addLahan')?>" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Add Data</a>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <table class="table table-bordered text-center" id="datatable">
                <thead>
                  <tr class="bg-primary">
                    <th>No</th>
                    <th>Kecamatan</th>
                    <th>Luas Lahan (ha)</th>
                    <th>Status Lahan</th>
                    <th>Jumlah Kelapa(Kg)</th>
                    <th>Koordinat TK Kelapa</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i=1;
                  foreach ($listlahan as $lahan):?>
                    <tr>
                      <td><?=$i ?></td>
                      <td><?=$lahan['nama_kecamatan']?></td>
                      <td><?=number_format($lahan['luas_lahan'],0,',','.')?></td>
                      <td><?=$lahan['status_lahan']?></td>
                      <td><?=number_format($lahan['jumlah_kelapa'],0,',','.')?></td>
                      <td><?=$lahan['latitude'].','.$lahan['longitude']?></td>
                      <td>
                        <a href="<?=base_url('data/editLahan/').$lahan['kode']?>" class="btn btn-warning"><i class="far fa-edit mr-2"></i></a>
                        <a href="<?=base_url('data/deleteLahan?kode=').$lahan['kode']?>" class="btn btn-danger btn-hapus"><i class="fas fa-trash mr-2"></i></a>
                      </td>
                    </tr>
                  <?php
                  $i++;
                  endforeach;?>
                </tbody>
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
        <h4 class="modal-title" id="TambahData">Form Input Data Lahan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="" action="<?php echo base_url()?>" method="post">
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
