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
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-body">
            <?=$this->session->flashdata('pesan')?>
            <h4>Jenis Akses : <?=$role['nama']?></h4>
            <table class="table table-bordered text-center">
              <tr class="bg-primary">
                <th>No</th>
                <th>Menu</th>
                <th>Akses</th>
              </tr>
              <?php
                $i =1;
                foreach ($menu as $m):?>
                  <tr>
                    <td><?= $i?></td>
                    <td><?= $m['menu'] ?></td>
                    <td>
                      <input type="checkbox" name="status" class="form-check-input"
                        <?=set_access($role['id'],$m['id']);?> data-roleid="<?=$role['id'] ?>"
                        data-menuid="<?=$m['id'] ?>"
                      >
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
<script>
  $('.form-check-input').on('click',function(){
    const roleId = $(this).data('roleid');
    const menuId = $(this).data('menuid');
    $.ajax({
      url:"<?=base_url('admin/gantiAkses'); ?>",
      type:'post',
      data:{
        menuId:menuId,
        roleId:roleId
      },
      success:function(){
        document.location.href="<?=base_url('admin/jenisHakAkses/')?>"+roleId;
      }
    });
  });
</script>
