<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Home extends CI_Controller{
    public function index(){
        $this->load->view('home/header');
        $this->load->view('home/navbar');
        $this->load->view('home/content');
        $this->load->view('home/footer');
    }
    public function loadArtikel(){
      $this->load->view('home/header');
      $this->load->view('home/navbar');
      $this->load->view('home/artikel');
      $this->load->view('home/footer');
    }
  }

?>
