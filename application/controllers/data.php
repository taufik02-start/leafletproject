<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  class Data extends CI_Controller{
    function __construct(){
      parent::__construct();
      is_logged_in();
      $this->load->model('dataModel','data');
      $this->load->model("authentikasiModel","aunt");
    }
    public function index(){
      $data['user']= $this->aunt->getUser();
      $config['base_url'] = "http://localhost/vco/data/index";
      $config['total_rows'] = $this->data->getTotalBarisUser();
      $config['per_page'] = 10;
      $this->pagination->initialize($config);
      $data['start'] = $this->uri->segment(3);
      $data['listuser']= $this->data->getUser($config['per_page'],$data['start']);
      $data['judul'] = 'Data User';
      $this->load->view('template/dashboard/header',$data);
      $this->load->view('template/dashboard/sidebar',$data);
      $this->load->view('admin/datauser');
      $this->load->view('template/dashboard/footer');
      $this->load->view('template/dashboard/script');
    }
    public function addUser(){
      $data['user']= $this->aunt->getUser();
      $this->form_validation->set_rules('nama','Nama','required|trim',
                                        [
                                          'required'=>'Nama tidak boleh kosong'
                                        ]);
      $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[tbl_user.email]',
                                        [
                                          'required'=>'Email tidak boleh kosong',
                                          'is_unique'=>'Email sudah digunakan',
                                          'valid_email'=>'Email tidak valid'
                                        ]);
      $this->form_validation->set_rules('password1','Password','required|trim|min_length[3]|matches[password2]',
                                        [
                                          'required'=>'Password tidak boleh kosong',
                                          'matches'=>'Password harus sama',
                                          'min_length'=>'Password harus lebih 6 karakter'
                                        ]);
      $this->form_validation->set_rules('password2','Password','required|trim|matches[password1]',
                                        [
                                          'required'=>'Password tidak boleh kosong',
                                          'matches'=>'Password harus sama'
                                        ]);
      if($this->form_validation->run()==false){
        $data['judul'] = 'Add Data User';
        $data['jenisakses'] = $this->data->getJenisAkses();
        $this->load->view('template/dashboard/header',$data);
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('admin/adduser');
        $this->load->view('template/dashboard/footer');
        $this->load->view('template/dashboard/script');
      }else{
        $nama = htmlspecialchars($this->input->post('nama',true));
        $data=[
          'nama'=> $nama,
          'email'=> htmlspecialchars($this->input->post('email',true)),
          'password'=> password_hash($this->input->post('password1',true),PASSWORD_DEFAULT),
          'jenis_id'=>$this->input->post('jenisakses',true),
          'aktivasi'=>1,
          'tgl_daftar'=>date("Y-m-d") //sebelumnya time()
        ];
        $this->aunt->simpanDataUser($data);
        $this->session->set_flashdata('pesan','Ditambahkan');
        $this->session->set_flashdata('judul',$nama);
        redirect('data');
      }
    }
    public function editUser($id){
      $data['user']= $this->aunt->getUser();
      $this->form_validation->set_rules('nama','Nama','required|trim',
                                        [
                                          'required'=>'Nama tidak boleh kosong'
                                        ]);
      $this->form_validation->set_rules('notelp','Nomor Telpon','required|numeric',
                                        [
                                          'required'=>'Nomor Telpon tidak boleh kosong',
                                          'numeric'=>'Hanya boleh diisi dengan angka'
                                        ]);
      if($this->form_validation->run()==false){
        $data['judul'] = 'Edit Data User';
        $data['jenisakses'] = $this->data->getJenisAkses();
        $data['listuser'] = $this->data->getDataUserById($id);
        $this->load->view('template/dashboard/header',$data);
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('admin/edituser');
        $this->load->view('template/dashboard/footer');
        $this->load->view('template/dashboard/script');
      }else{
        $nama = htmlspecialchars($this->input->post('nama',true));
        $data=[
          'nama'=> $nama,
          'notelp'=>htmlspecialchars($this->input->post('notelp',true)),
          'jekel'=>htmlspecialchars($this->input->post('jekel',true)),
          'jenis_id'=>htmlspecialchars($this->input->post('jenisakses',true)),
          'aktivasi'=>htmlspecialchars($this->input->post('aktivasi',true)),
          'id'=>$id
        ];
        $this->data->editDataUser($data);
        $this->session->set_flashdata('pesan','Diedit');
        $this->session->set_flashdata('judul',$nama);
        redirect('data');
      }
    }
    public function deleteUser($id){
      $nama = $this->data->getNamaUserById($id);
      $this->data->deleteDataUser($id);
      $this->session->set_flashdata('pesan','Dihapus');
      $this->session->set_flashdata('judul',$nama['nama']);
      redirect('data');
    }
    public function lahan(){
      $data['user']= $this->aunt->getUser();
      $this->load->model('LahanModel','lahan');
      $data['listlahan']= $this->lahan->getDataLahan();
      $data['judul'] = 'Data Lahan';
      $this->load->view('template/dashboard/header',$data);
      $this->load->view('template/dashboard/sidebar',$data);
      $this->load->view('admin/datalahan');
      $this->load->view('template/dashboard/footer');
      $this->load->view('template/dashboard/script');
    }
    public function getJumlahKelapabyLahan($luas){
      $jumlah = $luas * 1100;
      return $jumlah;
    }
    public function addLahan(){
      $data['user']= $this->aunt->getUser();
      $this->form_validation->set_rules('txtkodekec','Kode Kecamatan','required',
                                        [
                                          'required'=>'Kode Kecamatan tidak boleh kosong'
                                        ]);
      $this->form_validation->set_rules('txtnamakec','Nama Kecamatan','required',
                                        [
                                          'required'=>'Nama Kecamatan tidak boleh kosong'
                                        ]);
      $this->form_validation->set_rules('txtluas','Luas Lahan','required|numeric',
                                        [
                                          'required'=>'Luas Lahan tidak boleh kosong',
                                          'numeric'=>'Hanya boleh diisi dengan angka'
                                        ]);
      $this->form_validation->set_rules('txtstatus','Status Lahan','required',
                                        [
                                          'required'=>'Status Lahan tidak boleh kosong',
                                        ]);
      $this->form_validation->set_rules('txtlongitude','Longitude Titik Kumpul Kelapa','required',
                                        [
                                          'required'=>'Longitude titik kumpul kelapa tidak boleh kosong'
                                        ]);
      $this->form_validation->set_rules('txtlatitude','Latitude Titik Kumpul Kelapa','required',
                                        [
                                          'required'=>'Latitude titik kumpul kelapa tidak boleh kosong'
                                        ]);
      if($this->form_validation->run()==false){
          $data['judul'] = 'Add Data Lahan';
          $this->load->view('template/dashboard/header',$data);
          $this->load->view('template/dashboard/sidebar');
          $this->load->view('admin/addlahan');
          $this->load->view('template/dashboard/footer');
          $this->load->view('template/dashboard/script');
      }
      else{
        $kode = htmlspecialchars($this->input->post('txtkodekec',true));
        $namakecamatan = htmlspecialchars($this->input->post('txtnamakec',true));
        $luas = htmlspecialchars($this->input->post('txtluas',true));
        $status = htmlspecialchars($this->input->post('txtstatus',true));
        $jarak = htmlspecialchars($this->input->post('txtjarak',true));
        $latitude = htmlspecialchars($this->input->post('txtlatitude',true));
        $longitude = htmlspecialchars($this->input->post('txtlongitude',true));
        $data = [
          "kode"=>$kode,
          "nama_kecamatan"=>$namakecamatan,
          "luas_lahan"=>$luas,
          "status_lahan"=>$status,
          "jumlah_kelapa"=>$this->getJumlahKelapabyLahan($luas),
          "latitude" =>$latitude,
          "longitude"=>$longitude
        ];
        $this->data->insertDataLahan($data);
        $this->session->set_flashdata('pesan','Ditambahkan');
        $this->session->set_flashdata('judul',$namakecamatan);
        redirect('data/lahan');
      }
    }
    public function editLahan($kode){
      $data['user']= $this->aunt->getUser();
      $data['judul'] = 'Edit Data Lahan';
      $data['lahan'] = $this->data->getDataLahanByKode($kode);
      if(!$data['lahan']){
        redirect('data/lahan');
      }
      $this->form_validation->set_rules('txtnamakec','Nama Kecamatan','required',
                                        [
                                          'required'=>'Nama Kecamatan tidak boleh kosong'
                                        ]);
      $this->form_validation->set_rules('txtluas','Luas Lahan','required|numeric',
                                        [
                                          'required'=>'Luas Lahan tidak boleh kosong',
                                          'numeric'=>'Hanya boleh diisi dengan angka'
                                        ]);
      $this->form_validation->set_rules('txtstatus','Status Lahan','required',
                                        [
                                          'required'=>'Status Lahan tidak boleh kosong',
                                        ]);
      $this->form_validation->set_rules('txtlongitude','Longitude Titik Kumpul Kelapa','required',
                                        [
                                          'required'=>'Longitude titik kumpul kelapa tidak boleh kosong'
                                        ]);
      $this->form_validation->set_rules('txtlatitude','Latitude Titik Kumpul Kelapa','required',
                                        [
                                          'required'=>'Latitude titik kumpul kelapa tidak boleh kosong'
                                        ]);
      if($this->form_validation->run()==false){
        $data['judul'] = 'Edit Data Lahan';
        $this->load->view('template/dashboard/header',$data);
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('admin/editdatalahan');
        $this->load->view('template/dashboard/footer');
        $this->load->view('template/dashboard/script');
      }else{
        //proses update data
        $namakecamatan = htmlspecialchars($this->input->post('txtnamakec',true));
        $luas = htmlspecialchars($this->input->post('txtluas',true));
        $status = htmlspecialchars($this->input->post('txtstatus',true));
        $latitude = htmlspecialchars($this->input->post('txtlatitude',true));
        $longitude = htmlspecialchars($this->input->post('txtlongitude',true));
        $data = [
          "kode"=>$kode,
          "nama_kecamatan"=>$namakecamatan,
          "luas_lahan"=>$luas,
          "status_lahan"=>$status,
          "jumlah_kelapa"=>$this->getJumlahKelapabyLahan($luas),
          "latitude" =>$latitude,
          "longitude"=>$longitude
        ];
        $this->data->editDataLahan($data);
        $this->session->set_flashdata('pesan','Diedit');
        $this->session->set_flashdata('judul',$namakecamatan);
        redirect('data/lahan');
      }
    }
    public function deleteLahan(){
      $kode = $this->input->get('kode');
      $data = $this->data->getNamaLahanByKode($kode);
      $this->data->deleteDataLahan($kode);
      $this->session->set_flashdata('pesan','Dihapus');
      $this->session->set_flashdata('judul',$data['nama_kecamatan']);
      redirect('data/lahan');
    }
    public function pilihanUser(){
      $data['user']= $this->aunt->getUser();
      $this->db->select('nama,tbl_permintaan.email,tanggal');
      $this->db->from('tbl_permintaan');
      $this->db->join('tbl_user','tbl_user.email=tbl_permintaan.email');
      $data['pilihanUser'] = $this->db->get()->result_array();;
      $data['judul'] = "Data Pilihan User";
      $this->load->view('template/dashboard/header',$data);
      $this->load->view('template/dashboard/sidebar');
      $this->load->view('admin/datapilihanuser');
      $this->load->view('template/dashboard/footer');
      $this->load->view('template/dashboard/script');
    }
    public function mesin(){
      $data['user']= $this->aunt->getUser();
      $data['listmesin'] = $this->data->getDataMesin();
      $data['judul'] = "Data Mesin";
      $this->load->view('template/dashboard/header',$data);
      $this->load->view('template/dashboard/sidebar');
      $this->load->view('admin/dataalat');
      $this->load->view('template/dashboard/footer');
      $this->load->view('template/dashboard/script');
    }
    public function addMesin(){
      $data['user']= $this->aunt->getUser();
      $this->form_validation->set_rules('txtnama','Nama Mesin','required',
                                        [
                                          'required'=>'Nama mesin tidak boleh kosong'
                                        ]);
      $this->form_validation->set_rules('txtpotensi','Luas Lahan','required|numeric',
                                        [
                                          'required'=>'Potensi mesin tidak boleh kosong',
                                          'numeric'=>'Hanya boleh diisi dengan angka'
                                        ]);
      if($this->form_validation->run()==false){
          $data['judul'] = "Add Data Mesin";
          $this->load->view('template/dashboard/header',$data);
          $this->load->view('template/dashboard/sidebar');
          $this->load->view('admin/addmesin');
          $this->load->view('template/dashboard/footer');
          $this->load->view('template/dashboard/script');
      }else{
        $nama = htmlspecialchars($this->input->post('txtnama',true));
        $potensi = htmlspecialchars($this->input->post('txtpotensi',true));
        $data=[
          "nama"=>$nama,
          "potensi"=>$potensi
        ];
        $this->data->insertDataMesin($data);
        $this->session->set_flashdata('pesan','Ditambahkan');
        $this->session->set_flashdata('judul',$nama);
        redirect('data/mesin');
      }
    }
    public function editMesin($id){
      $data['user']= $this->aunt->getUser();
      $this->form_validation->set_rules('txtnama','Nama Mesin','required',
                                        [
                                          'required'=>'Nama mesin tidak boleh kosong'
                                        ]);
      $this->form_validation->set_rules('txtpotensi','Luas Lahan','required|numeric',
                                        [
                                          'required'=>'Potensi mesin tidak boleh kosong',
                                          'numeric'=>'Hanya boleh diisi dengan angka'
                                        ]);
      if($this->form_validation->run()==false){
        $data['judul'] = 'Edit Data Mesin';
        $data['mesin'] = $this->data->getDataMesinById($id);
        $this->load->view('template/dashboard/header',$data);
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('admin/editdatamesin');
        $this->load->view('template/dashboard/footer');
        $this->load->view('template/dashboard/script');
      }else{
        $nama = htmlspecialchars($this->input->post('txtnama',true));
        $potensi = htmlspecialchars($this->input->post('txtpotensi',true));
        $data=[
          "id"=>$id,
          "nama"=>$nama,
          "potensi"=>$potensi
        ];
        $this->data->editdataMesin($data);
        $this->session->set_flashdata('pesan','Diedit');
        $this->session->set_flashdata('judul',$nama);
        redirect('data/mesin');
      }
    }
    public function deleteMesin(){
      $id = $this->input->get('id');
      $data = $this->data->getNamaMesinById($id);
      $this->data->deleteDataMesin($id);
      $this->session->set_flashdata('pesan','Dihapus');
      $this->session->set_flashdata('judul',$data['nama']);
      redirect('data/mesin');
    }
    public function artikel(){
      $data['user']= $this->aunt->getUser();
      $data['listmesin'] = $this->data->getDataMesin();
      $data['judul'] = "Data Artikel";
      $this->load->view('template/dashboard/header',$data);
      $this->load->view('template/dashboard/sidebar');
      $this->load->view('admin/dataartikel');
      $this->load->view('template/dashboard/footer');
      $this->load->view('template/dashboard/script');
    }
    public function addArtikel(){
      $data['user']= $this->aunt->getUser();
      $data['judul'] = "Add Data Artikel";
      $this->load->view('template/dashboard/header',$data);
      $this->load->view('template/dashboard/sidebar');
      $this->load->view('admin/addArtikel');
      $this->load->view('template/dashboard/footer');
      $this->load->view('template/dashboard/script');
    }
  }
?>
