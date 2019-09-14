<?php

  class AdminModel extends CI_Model
  {
    public function getJenis(){
      return $this->db->get('tbl_jenis')->result_array();
    }
    public function insertHakAkses($data){
      $this->db->insert('tbl_jenis',$data);
    }
    public function getNamaHakAsesById($id){
      $this->db->select('nama');
      return $this->db->get_where('tbl_jenis',['id'=>$id])->row_array();
    }
    public function deleteHakAkses($id){
      $this->db->delete('tbl_jenis',['id'=>$id]);
    }
    public function getDataHakAksesById($id){
      return $this->db->get_where('tbl_jenis',['id'=>$id])->row_array();
    }
    public function editHakAkses($data){
      $this->db->set('nama',$data['nama']);
      $this->db->where('id',$data['id']);
      $this->db->update('tbl_jenis');
    }
    public function getRoleAccess($id){
      return $this->db->get_where('tbl_jenis',['id'=>$id])->row_array();
    }
    
  }
 ?>
