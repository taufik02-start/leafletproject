<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  class Menu extends CI_Controller{
    public function __construct(){
      parent::__construct();
      is_logged_in();
      $this->load->model("authentikasiModel","aunt");
      $this->load->model("menuModel","menu");
    }
    // menampilkan menu dan menambahkan menu baru
    public function index(){
      $data['user']=$this->aunt->getUser();
      $data['judul'] = 'Pengaturan Menu';
      $data['menu'] =$this->menu->getMenu();
      $this->load->view('template/dashboard/header',$data);
      $this->load->view('template/dashboard/sidebar');
      $this->load->view('admin/menu');
      $this->load->view('template/dashboard/footer');
      $this->load->view('template/dashboard/script');
    }
    public function addMenu(){
      $data['user']=$this->aunt->getUser();
      $data['judul'] = 'Add Menu';
      //validasi form
      $this->form_validation->set_rules('menu','Menu','required',[
        'required'=>'Menu tidak boleh kosong'
      ]);
      //ketika validasi gagal kembali ke submenu
      if($this->form_validation->run()==false){
        $this->load->view('template/dashboard/header',$data);
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('admin/addmenu');
        $this->load->view('template/dashboard/footer');
        $this->load->view('template/dashboard/script');
      }
      //ketika validasi berhasil insert ke database tbl_user_sub_menu
      else{
        $data=[
          "menu"=>htmlspecialchars($this->input->post('menu',true))
        ];
        $this->menu->insertMenu($data);
        $this->session->set_flashdata('pesan','Ditambahkan');
        $this->session->set_flashdata('judul',$data['menu']);
        redirect('menu');
      }
    }
    public function editMenu($id){
      $data['user']=$this->aunt->getUser();
      $data['judul'] = 'Edit Menu';
      $data['menu']=$this->menu->getMenuById($id);
      $this->form_validation->set_rules('menu','Menu','required',[
        'required'=>'Menu tidak boleh kosong'
      ]);
      //ketika validasi gagal kembali ke submenu
      if($this->form_validation->run()==false){
        $this->load->view('template/dashboard/header',$data);
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('admin/editmenu');
        $this->load->view('template/dashboard/footer');
        $this->load->view('template/dashboard/script');
      }
      //ketika validasi berhasil insert ke database tbl_user_sub_menu
      else{
        $data=[
          "menu"=>htmlspecialchars($this->input->post('menu',true))
        ];
        $this->menu->editMenu($data);
        $this->session->set_flashdata('pesan','Diedit');
        $this->session->set_flashdata('judul',$data['menu']);
        redirect('menu');
      }
    }
    public function deleteMenu($id){
      $this->menu->deleteMenu($id);
      $this->session->set_flashdata('pesan','Dihapus');
      redirect('menu');
    }
    // menampilkan submenu dan menambahkan submenu baru
    public function subMenu(){
      $data['user']=$this->aunt->getUser();
      $data['judul'] = 'Pengaturan Submenu';
      $data['submenu'] = $this->menu->getSubMenu();
      $this->load->view('template/dashboard/header',$data);
      $this->load->view('template/dashboard/sidebar');
      $this->load->view('admin/submenu');
      $this->load->view('template/dashboard/footer');
      $this->load->view('template/dashboard/script');
    }
    public function addSubMenu(){
      $data['user']=$this->aunt->getUser();
      $data['judul'] = 'Add Sub Menu';
      $data['menu']=$this->menu->getMenu();
      //validasi form
      $this->form_validation->set_rules('title','Title','required',[
        'required'=>'Title tidak boleh kosong'
      ]);
      $this->form_validation->set_rules('menuid','Menu','required',[
        'required'=>'Menu tidak boleh kosong'
      ]);
      $this->form_validation->set_rules('url','Url','required',[
        'required'=>'Url tidak boleh kosong'
      ]);
      $this->form_validation->set_rules('icon','Icon','required',[
        'required'=>'Icon tidak boleh kosong'
      ]);
      //ketika validasi gagal kembali ke submenu
      if($this->form_validation->run()==false){
        $this->load->view('template/dashboard/header',$data);
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('admin/addsubmenu');
        $this->load->view('template/dashboard/footer');
        $this->load->view('template/dashboard/script');
      }
      //ketika validasi berhasil insert ke database tbl_user_sub_menu
      else{
        $judul = htmlspecialchars($this->input->post('title',true));
        $data=[
          "menu_id"=>htmlspecialchars($this->input->post('menuid',true)),
          "title"=>$judul,
          "url"=>htmlspecialchars($this->input->post('url',true)),
          "icon"=>htmlspecialchars($this->input->post('icon',true)),
          "aktif"=>htmlspecialchars($this->input->post('status',true))
        ];
        $this->menu->insertSubMenu($data);
        $this->session->set_flashdata('pesan','Ditambahkan');
        $this->session->set_flashdata('judul',$judul);
        redirect('menu/subMenu');
      }
    }
    public function editSubmenu($id){
      $data['user']=$this->aunt->getUser();
      $data['judul'] = 'Edit Sub Menu';
      $data['submenu'] = $this->menu->getSubMenuById($id);
      $data['menu']=$this->menu->getMenu();
      //validasi form
      $this->form_validation->set_rules('title','Title','required',[
        'required'=>'Title tidak boleh kosong'
      ]);
      $this->form_validation->set_rules('url','Url','required',[
        'required'=>'Url tidak boleh kosong'
      ]);
      $this->form_validation->set_rules('icon','Icon','required',[
        'required'=>'Icon tidak boleh kosong'
      ]);
      //ketika validasi gagal kembali ke submenu
      if($this->form_validation->run()==false){
        $this->load->view('template/dashboard/header',$data);
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('admin/editsubmenu');
        $this->load->view('template/dashboard/footer');
        $this->load->view('template/dashboard/script');
      }
      //ketika validasi berhasil insert ke database tbl_user_sub_menu
      else{
        $judul = htmlspecialchars($this->input->post('title',true));
        $data=[
          "id"=>$id,
          "menu_id"=>htmlspecialchars($this->input->post('menuid',true)),
          "title"=>$judul,
          "url"=>htmlspecialchars($this->input->post('url',true)),
          "icon"=>htmlspecialchars($this->input->post('icon',true)),
          "aktif"=>htmlspecialchars($this->input->post('status',true))
        ];
        $this->menu->editDataSubMenu($data);
        $this->session->set_flashdata('pesan','Diedit');
        $this->session->set_flashdata('judul',$judul);
        redirect('menu/subMenu');
      }
    }
    public function deleteSubMenu($id){
        $data= $this->menu->getTitleSubMenu($id);
        $this->session->set_flashdata('judul',$data['title']);
        $this->db->delete('tbl_user_sub_menu',['id'=>$id]);
        $this->session->set_flashdata('pesan','Dihapus');
        redirect('menu/subMenu');
    }
  }
?>
