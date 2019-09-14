<?php
  class Analisis extends CI_Controller{
    public function __construct(){
      parent::__construct();
      $this->load->model('AnalisisModel');
      is_logged_in();
    }
    public function index(){
      $data['user']=$this->db->get_where('tbl_user',['email'=>
      $this->session->userdata('email')])->row_array();
      $data['judul'] ='Analisis';
      $this->load->view('template/dashboard/header',$data);
      $this->load->view('template/dashboard/sidebar',$data);
      $this->load->view('user/analisis');
      $this->load->view('template/dashboard/footer');
      $this->load->view('template/dashboard/script');
    }
    public function simpan(){
      $data = array(
        'kode'=>$this->input->post('kode'),
        'nama'=>$this->input->post('user'));
      $this->InvestasiModel->simpanData();
      echo json_encode($data);
    }
    public function tampilDataPermintaan(){
      $data=$this->AnalisisModel->listPermintaan();
      echo json_encode($data);
    }
    public function delete(){
      $data=$this->AnalisisModel->hapusData();
      echo json_encode($data);
    }
  }
 ?>
