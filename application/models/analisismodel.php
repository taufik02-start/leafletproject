<?php
  /**
   *
   */
  class AnalisisModel extends CI_Model
  {
    public function simpanData($data){
      return $this->db->insert('tbl_detail_permintaan',$data);
    }
    public function listPermintaan($email){
      $query = "SELECT tbl_lahan.*,tbl_detail_permintaan.email
                FROM tbl_lahan INNER JOIN tbl_detail_permintaan
                ON tbl_lahan.kode=tbl_detail_permintaan.kode
                WHERE tbl_detail_permintaan.email='$email'
              ";
      return $this->db->query($query)->result();
    }
    public function listLahanByKode($kode){
      $this->db->where('kode',$kode);
      return $this->db->get('tbl_lahan')->result();
    }
    public function hapusData($kode){
        $this->db->where('kode', $kode);
        $hasil = $this->db->delete('tbl_detail_permintaan');
        return $hasil;
    }
    public function getJumlahDagingKelapa($email){
      $this->db->select_sum('jumlah_kelapa');
      $this->db->from('tbl_lahan');
      $this->db->join('tbl_detail_permintaan','tbl_lahan.kode = tbl_detail_permintaan.kode');
      $this->db->where('email',$email);
      return $this->db->get()->row_array();
      // $query = "SELECT sum(jumlah_kelapa)AS 'jumlah_kelapa'
      //           FROM tbl_lahan INNER JOIN tbl_permintaan
      //           ON tbl_lahan.kode=tbl_permintaan.kode
      //           WHERE tbl_permintaan.email='$email'
      //         ";
      //
      // return $this->db->query($query)->result_array();
    }
  }

 ?>
