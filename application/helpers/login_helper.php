<?php
  function is_logged_in(){
    $ci = get_instance();
    if(!$ci->session->userdata('email')){
      redirect('authentikasi');
    }else{
      $jenis = $ci->session->userdata('jenis_id');
      $menu = $ci->uri->segment(1);
      $querymenu = $ci->db->get_where('tbl_user_menu',['menu'=>$menu])->row_array();
      $menu_id = $querymenu['id'];
      $useraccess = $ci->db->get_where('tbl_user_access_menu',['jenis_id'=>$jenis,'menu_id'=>$menu_id]);
      if($useraccess->num_rows()<1){
        redirect('authentikasi/block');
      }
    }
  }
  function set_access($jenis_id,$menu_id){
    $ci = get_instance();
    $result = $ci->db->get_where('tbl_user_access_menu',['jenis_id'=>$jenis_id,
                                              'menu_id'=>$menu_id]);
    if($result->num_rows()>0){
      return "checked = checked";
    }
  }
 ?>
