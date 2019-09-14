<!-- Sweet Alert-->
<div class="flash-data" data-flashdata="<?=$this->session->flashdata('pesan')?>"
  data-flashjudul="<?=$this->session->flashdata('judul')?>" data-flashtitle="User">
</div>
<!-- End Sweet Alert-->
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
    <div class="box box-primary">
        <div class="box-body">
          <a href="<?=base_url('data/addUser') ?>" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Add Data</a>
          <table class="table table-bordered text-center" id="datatable">
            <thead>
              <tr class="bg-primary">
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No Telpon</th>
                <th>Jekel</th>
                <th>Level</th>
                <th>Status</th>
                <th>Tgl Daftar</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i=1;
              foreach ($listuser as $users):?>
                <tr>
                  <td><?= ++$start ?></td>
                  <td><?=$users['nama']?></td>
                  <td><?=$users['email']?></td>
                  <td><?=$users['notelp']?></td>
                  <td><?=$users['Jekel']?></td>
                  <td><?=$users['Jenis']?></td>
                  <td><?=$users['Status']?></td>
                  <td><?=$users['tgl_daftar'] ?></td>
                  <td>
                    <a href="<?=base_url('data/editUser/').$users['id']?>" class="btn btn-warning"><i class="far fa-edit mr-2"></i></a>
                    <a href="<?=base_url('data/deleteUser/').$users['id']?>" class="btn btn-danger btn-hapus"><i class="fas fa-trash mr-2"></i></a>
                  </td>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>
          <?= $this->pagination->create_links();?>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
