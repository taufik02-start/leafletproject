<?php
  /**
   *
   */
  class LahanModel extends CI_Model
  {
    public function getDataLahan(){
      return $this->db->get('tbl_lahan')->result_array();
    }
  }


 ?>
