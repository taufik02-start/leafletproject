<?php
  /**
   *
   */
  class menuModel extends CI_Model
  {
    public function getSubMenu(){
      $query = "SELECT tbl_user_sub_menu.*,if(aktif=1,'Aktif','Tidak Aktif') as 'keterangan' ,tbl_user_menu.menu
                FROM tbl_user_sub_menu JOIN tbl_user_menu
                ON tbl_user_sub_menu.menu_id=tbl_user_menu.id
              ";
      return $this->db->query($query)->result_array();
    }
    public function getMenu(){
      return $this->db->get('tbl_user_menu')->result_array();
    }
    public function getMenuNotAdmin(){
      $this->db->where('id !=',1);
      return $this->db->get('tbl_user_menu')->result_array();
    }
    public function insertMenu($data){
      $this->db->insert("tbl_user_menu",$data);
    }
    public function getMenuById($id){
      return $this->db->get_where('tbl_user_menu',['id'=>$id])->row_array();
    }
    public function deleteMenu($id){
      $this->db->delete('tbl_user_menu',['id'=>$id]);
    }
    public function editMenu($data){
      $this->db->set('menu',$data['menu']);
      $this->db->where('id',$data['id']);
      $this->db->update('tbl_user_menu');
    }
    public function insertSubMenu($data){
      $this->db->insert('tbl_user_sub_menu',$data);
    }
    public function getSubMenuById($id){
      return $this->db->get_where('tbl_user_sub_menu',['id'=>$id])->row_array();
    }
    public function editDataSubMenu($data){
      $this->db->set('menu_id',$data['menu_id']);
      $this->db->set('title',$data['title']);
      $this->db->set('url',$data['url']);
      $this->db->set('icon',$data['icon']);
      $this->db->set('aktif',$data['aktif']);
      $this->db->where('id',$data['id']);
      $this->db->update('tbl_user_sub_menu');
    }
    public function getTitleSubMenu($id){
      $this->db->select('title');
      return $this->db->get_where('tbl_user_sub_menu',['id'=>$id])->row_array();
    }
  }

?>
