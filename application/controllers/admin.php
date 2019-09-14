<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  class Admin extends CI_Controller{
    public function __construct(){
      parent::__construct();
      is_logged_in();
      $this->load->model("authentikasiModel","aunt");
      $this->load->model('adminmodel',"admin");
    }
    public function index(){
      $data['user']= $this->aunt->getUser();
      $data['judul'] = 'Dashboard';
      $this->load->view('template/dashboard/header',$data);
      $this->load->view('template/dashboard/sidebar');
      $this->load->view('admin/admin');
      $this->load->view('template/dashboard/footer');
      $this->load->view('template/dashboard/script');
    }
    // public function setHakAkses(){
    //   $data['user']= $this->aunt->getUser();
    //   $data['judul'] = 'Hak Akses';
    //   $data['jenis']=$this->admin->getJenis();
    //   $this->load->view('template/dashboard/header',$data);
    //   $this->load->view('template/dashboard/sidebar',$data);
    //   $this->load->view('admin/hakakses');
    //   $this->load->view('template/dashboard/footer');
    //   $this->load->view('template/dashboard/script');
    // }
    public function hakAkses(){
      $data['user']= $this->aunt->getUser();
      $data['judul'] = 'Hak Akses';
      $data['jenis']= $this->admin->getJenis();
      $this->load->view('template/dashboard/header',$data);
      $this->load->view('template/dashboard/sidebar');
      $this->load->view('admin/hakakses');
      $this->load->view('template/dashboard/footer');
      $this->load->view('template/dashboard/script');
    }
    public function addHakAkses(){
      $data['user']= $this->aunt->getUser();
      $data['judul'] = 'Add Hak Akses';
      $this->form_validation->set_rules('txtjenishakakses','Hak Akses','required',[
        'required'=>'Hak akses tidak boleh kosong'
      ]);
      if($this->form_validation->run()==false){
        $this->load->view('template/dashboard/header',$data);
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('admin/addhakakses');
        $this->load->view('template/dashboard/footer');
        $this->load->view('template/dashboard/script');
      }
      else{
        $data=[
          "nama"=>htmlspecialchars($this->input->post('txtjenishakakses',true))
        ];
        $this->admin->insertHakAkses($data);
        $this->session->set_flashdata('pesan','Ditambahkan');
        $this->session->set_flashdata('judul',$data['nama']);
        redirect('admin/hakAkses');
      }
    }
    public function editHakAkses($id){
      $data['user']= $this->aunt->getUser();
      $data['judul'] = 'Edit Hak Akses';
      $this->form_validation->set_rules('txtjenishakakses','Hak Akses','required',[
        'required'=>'Hak akses tidak boleh kosong'
      ]);
      if($this->form_validation->run()==false){
        $data['hakakses'] = $this->admin->getDataHakAksesById($id);
        $this->load->view('template/dashboard/header',$data);
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('admin/edithakakses');
        $this->load->view('template/dashboard/footer');
        $this->load->view('template/dashboard/script');
      }
      else{
        $data=[
          "id"=>$id,
          "nama"=>htmlspecialchars($this->input->post('txtjenishakakses',true))
        ];
        $this->admin->editHakAkses($data);
        $this->session->set_flashdata('pesan','Diubah');
        $this->session->set_flashdata('judul',$data['nama']);
        redirect('admin/hakAkses');
      }
    }
    public function deleteHakAkses($id){
      $nama = $this->admin->getNamaHakAsesById($id);
      $this->admin->deleteHakAkses($id);
      $this->session->set_flashdata('pesan','Dihapus');
      $this->session->set_flashdata('judul',$nama['nama']);
      redirect('admin/hakAkses');
    }
    public function jenisHakAkses($id){
      $data['user']= $this->aunt->getUser();
      $data['judul'] = 'Role Access';
      $data['role']= $this->admin->getRoleAccess($id);
      $this->load->model('menuModel','menu');
      $data['menu'] = $this->menu->getMenuNotAdmin();
      $this->load->view('template/dashboard/header',$data);
      $this->load->view('template/dashboard/sidebar');
      $this->load->view('admin/roleakses');
      $this->load->view('template/dashboard/footer');
      $this->load->view('template/dashboard/script');
    }
    public function gantiAkses(){
      $roleid = $this->input->post('roleId');
      $menuid = $this->input->post('menuId');
      $data=[
        "jenis_id"=>$roleid,
        "menu_id"=>$menuid
      ];
      $result=$this->db->get_where('tbl_user_access_menu',$data);
      if($result->num_rows()<1){
        $this->db->insert('tbl_user_access_menu',$data);
      }else{
        $this->db->delete('tbl_user_access_menu',$data);
      }
      $this->session->set_flashdata('pesan','
        <script>
        Swal.fire({
            title: "Hak Akses",
            text:"Access Change",
            type:"success"
          }
        );
        </script>
      ');
    }
  }

?>
