<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  /**
   *
   */
  class Akun extends CI_Controller
  {
    public function __construct(){
      parent::__construct();
      is_logged_in();
      $this->load->model("authentikasiModel","aunt");
    }
    public function index(){
      if(!$this->session->userdata('email')){
        redirect('authentikasi');
      }
      else {
        $data['user']= $this->aunt->getUser();
        $data['judul'] ='Akun Saya';
        $this->load->view('template/dashboard/header',$data);
        $this->load->view('template/dashboard/sidebar',$data);
        $this->load->view('user/akunsaya');
        $this->load->view('template/dashboard/footer');
        $this->load->view('template/dashboard/script');
      }
    }
    public function ubahProfile(){
      $data['user']=$this->aunt->getUser();
      $this->form_validation->set_rules('nama','Nama','required',
                                        [
                                          'required'=>'Nama tidak boleh kosong'
                                        ]);
      $this->form_validation->set_rules('notelp','Nomor Telpon','required|numeric',
                                        [
                                          'required'=>'Nomor Telpon tidak boleh kosong',
                                          'numeric'=>'Hanya boleh diisi dengan angka'
                                        ]);
      if($this->form_validation->run()==false){
        $data['judul'] ='Edit Profil';
        $this->load->view('template/dashboard/header',$data);
        $this->load->view('template/dashboard/sidebar',$data);
        $this->load->view('user/editProfil');
        $this->load->view('template/dashboard/footer');
        $this->load->view('template/dashboard/script');
      }else{
        $nama = htmlspecialchars($this->input->post('nama',true));
        $email = $data['user']['email'];
        $notelpon = htmlspecialchars($this->input->post('notelp',true));
        $jekel = htmlspecialchars($this->input->post('jekel',true));
        $data=[
          "nama"=>$nama,
          "email"=>$email,
          "notelp"=>$notelpon,
          "jekel"=>$jekel
        ];
        $this->aunt->editProfile($data);
        $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade-show" role="alert">Edit data Berhasil
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('akun');
      }
    }
    public function gantiPassword(){
      $data['user']=$this->aunt->getUser();
      $this->form_validation->set_rules('txtpasswordlama','Password Lama','required|trim',
                                        [
                                          'required'=>'tidak boleh kosong'
                                        ]);
      $this->form_validation->set_rules('txtpassword1','Password','required|trim|min_length[6]|matches[txtpassword2]',
                                        [
                                          'required'=>'tidak boleh kosong',
                                          'matches'=>'Password harus sama',
                                          'min_length'=>'Password harus lebih 6 karakter'
                                        ]);
      $this->form_validation->set_rules('txtpassword2','Password','required|trim|matches[txtpassword1]',
                                        [
                                          'required'=>'tidak boleh kosong',
                                          'matches'=>'Password harus sama'
                                        ]);
      if($this->form_validation->run()==false){
        $data['judul'] ='Ganti Password';
        $this->load->view('template/dashboard/header',$data);
        $this->load->view('template/dashboard/sidebar',$data);
        $this->load->view('user/gantiPassword');
        $this->load->view('template/dashboard/footer');
        $this->load->view('template/dashboard/script');
      }else{
        $passwordlama = htmlspecialchars($this->input->post('txtpasswordlama',true));
        $passwordbaru = htmlspecialchars($this->input->post('txtpassword1',true));
        //ketika isi password lama tidak sama dengan password yang ada di database
        if(!password_verify($passwordlama,$data['user']['password'])){
          $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade-show" role="alert">Mohon isi password lama dengan benar
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          redirect('akun/gantiPassword');
        }else{
          // jika password yang baru sama dengan password lama
          if($passwordlama==$passwordbaru){
            $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade-show" role="alert">Password yang anda masukan sama dengan password sebelumnya
                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('akun/gantiPassword');
          }
          // jika berhasil
          else{
            $enkrippassword = password_hash($passwordbaru,PASSWORD_DEFAULT);
            $this->db->set('password',$enkrippassword);
            $this->db->where('email',$data['user']['email']);
            $this->db->update('tbl_user');
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade-show" role="alert">Edit data Berhasil
                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('akun');
          }
        }
      }
    }
  }
?>
