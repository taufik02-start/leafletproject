<?php
  class JarakLahan extends CI_Controller{
    public function __construct(){
      parent::__construct();
      is_logged_in();
    }
    public function index(){
      $data['user']=$this->db->get_where('tbl_user',['email'=>
      $this->session->userdata('email')])->row_array();
      $data['judul'] ='Lokasi Pabrik';
      $this->load->view('template/dashboard/header',$data);
      $this->load->view('template/dashboard/sidebar',$data);
      $this->load->view('user/jaraklahan');
      $this->load->view('template/dashboard/footer');
      $this->load->view('template/dashboard/script');
    }
  }
