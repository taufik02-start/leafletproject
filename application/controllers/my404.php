<?php
  /**
   *
   */
  class My404 extends CI_Controller
  {
    public function index(){
      $this->load->view('notfound');
    }
  }
?>
