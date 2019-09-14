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
          <div class="row mt-2">
            <div class="col-md-12">
              <table class="table table-bordered text-center" id="datatable">
                <thead>
                  <tr class="bg-primary">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i=1;
                  foreach ( $pilihanUser as $peminat):?>
                    <tr>
                      <td><?=$i ?></td>
                      <td><?=$peminat['nama']?></td>
                      <td><?=$peminat['email']?></td>
                      <td><?=$peminat['tanggal']?></td>
                      <td>
                        <a href="" class="btn btn-warning"><i class="far fa-edit mr-2"></i></a>
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
