<div class="flash-data" data-flashdata="<?=$this->session->flashdata('pesan')?>"
  data-flashjudul="<?=$this->session->flashdata('judul')?>" data-flashtitle="Menu">
</div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= $judul ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><?= $judul?></li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-5">
        <div class="box box-primary">
          <div class="box-body">
            <a href="<?=base_url('menu/addMenu') ?>" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Add Data</a>
            <table class="table table-bordered text-center">
              <tr class="bg-primary">
                <th>No</th>
                <th>Menu</th>
                <th>Action</th>
              </tr>
              <?php
                $i =1;
                foreach ($menu as $m):?>
                  <tr>
                    <td><?= $i?></td>
                    <td><?= $m['menu'] ?></td>
                    <td>
                      <a href="<?=base_url('menu/editMenu/').$m['id'] ?>" class="btn btn-warning"><i class="far fa-edit mr-2"></i></a>
                      <a href="<?=base_url('menu/deleteMenu/').$m['id']?>" class="btn btn-danger btn-hapus"><i class="fas fa-trash mr-2"></i></a>
                    </td>
                  </tr>
                <?php
                  $i++;
                  endforeach ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
