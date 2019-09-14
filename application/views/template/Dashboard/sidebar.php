<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <?php
          $jenis = $this->session->userdata('jenis_id');
          $querymenu = "select tbl_user_menu.id,menu
                        from tbl_user_menu join tbl_user_access_menu
                        on tbl_user_menu.id = tbl_user_access_menu.menu_id
                        where tbl_user_access_menu.jenis_id=$jenis
                        order by tbl_user_access_menu.menu_id asc";
          $menu = $this->db->query($querymenu)->result_array();
        ?>
          <!-- looping menu -->
        <?php foreach ($menu as $m):?>
          <li class="header text-uppercase"><?php echo $m['menu'] ?></li>
          <?php
          $menuid = $m['id'];
          $querysubmenu = "select *
                        from tbl_user_sub_menu join tbl_user_menu
                        on tbl_user_sub_menu.menu_id = tbl_user_menu.id
                        where tbl_user_sub_menu.menu_id=$menuid
                        and tbl_user_sub_menu.aktif=1";
          $submenu = $this->db->query($querysubmenu)->result_array();
        ?>

        <?php foreach ($submenu as $sub) :?>
          <?php if($judul==$sub['title']) {?>
            <li class="active">
          <?php
            }
            else{?>
            <li>
            <?php } ?>
            <a href="<?= base_url($sub['url'])?>">
              <i class="<?= $sub['icon']?>"></i>&nbsp;&nbsp;<span><?= $sub['title'] ?></span>
            </a>
          </li>
        <?php endforeach; ?>
      <?php endforeach; ?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
