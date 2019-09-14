<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  /**
   *
   */
  class DataModel extends CI_Model
  {
    public function getUser($limit,$start){
      $this->db->select("tbl_user.id,tbl_user.nama,email,notelp,if(jekel='L','Laki-Laki',if(jekel='P','Perempuan','-')) AS 'Jekel',
                tbl_jenis.nama as 'Jenis',if(aktivasi=1,'Aktif','Tidak Aktif')AS 'Status',tgl_daftar");
      $this->db->from('tbl_user');
      $this->db->join('tbl_jenis','tbl_user.jenis_id = tbl_jenis.id');
      $this->db->limit($limit,$start);
      return $this->db->get()->result_array();
    }
    public function getJenisAkses(){
      $this->db->where('id !=',1);
      return $this->db->get('tbl_jenis')->result_array();
    }
    //untuk pengatuan pagination
    public function getTotalBarisUser(){
      return $this->db->get('tbl_user')->num_rows();
    }
    public function getDataUserById($id){
      return $this->db->get_where('tbl_user',['id'=>$id])->row_array();
    }
    public function editDataUser($data){
      $this->db->set('nama',$data['nama']);
      $this->db->set('notelp',$data['notelp']);
      $this->db->set('jekel',$data['jekel']);
      $this->db->set('jenis_id',$data['jenis_id']);
      $this->db->set('aktivasi',$data['aktivasi']);
      $this->db->where('id',$data['id']);
      $this->db->update('tbl_user');
    }
    public function deleteDataUser($id){
        $this->db->delete('tbl_user',['id'=>$id]);
    }
    public function getNamaUserById($id){
      $this->db->select('nama');
      return $this->db->get_where('tbl_user',['id'=>$id])->row_array();
    }
    public function insertDataLahan($data){
      $this->db->insert('tbl_lahan',$data);
    }
    public function getDataLahanByKode($kode){
      return $this->db->get_where('tbl_lahan',['kode'=>$kode])->row_array();
    }
    public function getNamaLahanByKode($kode){
      $this->db->select('nama_kecamatan');
      return $this->db->get_where('tbl_lahan',['kode'=>$kode])->row_array();
    }
    public function editDataLahan($data){
      $this->db->set('nama_kecamatan',$data['nama_kecamatan']);
      $this->db->set('luas_lahan',$data['luas_lahan']);
      $this->db->set('status_lahan',$data['status_lahan']);
      $this->db->set('jumlah_kelapa',$data['jumlah_kelapa']);
      $this->db->set('latitude',$data['latitude']);
      $this->db->set('longitude',$data['longitude']);
      $this->db->where('kode',$data['kode']);
      $this->db->update('tbl_lahan');
    }
    public function deleteDataLahan($kode){
      $this->db->delete('tbl_lahan',['kode'=>$kode]);
    }
    public function getDataMesin(){
      return $this->db->get('tbl_mesin')->result_array();
    }
    public function insertDataMesin($data){
      $this->db->insert('tbl_mesin',$data);
    }
    public function getDataMesinById($id){
      return $this->db->get_where('tbl_mesin',['id'=>$id])->row_array();
    }
    public function editDataMesin($data){
      $this->db->set('nama',$data['nama']);
      $this->db->set('potensi',$data['potensi']);
      $this->db->where('id',$data['id']);
      $this->db->update('tbl_mesin');
    }
    public function deleteDataMesin($id){
      $this->db->delete('tbl_mesin',['id'=>$id]);
    }
    public function getNamaMesinById($id){
      $this->db->select('nama');
      return $this->db->get_where('tbl_mesin',['id'=>$id])->row_array();
    }
  }

 ?>
