<?php
  /**
   *
   */
  class AuthentikasiModel extends CI_Model
  {
    public function simpanDataUser($data){
      $this->db->insert('tbl_user',$data);
    }
    public function getUser(){
      return $this->db->get_where('tbl_user',['email'=>
      $this->session->userdata('email')])->row_array();
    }
    public function editProfile($data){
      $this->db->set('nama',$data['nama']);
      $this->db->set('notelp',$data['notelp']);
      $this->db->set('jekel',$data['jekel']);
      $this->db->where('email',$data['email']);
      $this->db->update('tbl_user');
    }

  }

 ?>
