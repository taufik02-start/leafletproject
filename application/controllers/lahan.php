<?php

  class Lahan extends CI_Controller
  {
    public function __construct(){
      parent::__construct();
      is_logged_in();
      $this->load->model("authentikasiModel","aunt");
      $this->load->model('LahanModel','lahan');
      $this->load->model('AnalisisModel');
    }
    public function index(){
        $data['user']= $this->aunt->getUser();
        $data['judul'] ='Potensi Lahan';
        $data['potensilahan'] = $this->lahan->getDataLahan();
        $this->load->view('template/dashboard/header',$data);
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('user/potensilahan');
        $this->load->view('template/dashboard/footer');
        $this->load->view('template/dashboard/script');
    }
    public function jaraklahan(){
      $data['user']= $this->aunt->getUser();
      $data['judul'] ='Lokasi Pabrik';
      $this->load->view('template/dashboard/header',$data);
      $this->load->view('template/dashboard/sidebar');
      $this->load->view('user/jaraklahan');
      $this->load->view('template/dashboard/footer');
      $this->load->view('template/dashboard/script');
    }
    public function analisis(){
      $data['user']= $this->aunt->getUser();
      $data['kecamatan']=$this->db->get('tbl_lahan')->result_array();
      $data['judul'] ='Analisis';
      $this->load->view('template/dashboard/header',$data);
      $this->load->view('template/dashboard/sidebar');
      $this->load->view('user/analisis');
      $this->load->view('template/dashboard/footer');
      $this->load->view('template/dashboard/script');
    }
    public function getLahanByKode(){
      $data['user']= $this->aunt->getUser();
      $kode = $this->input->post('kode');
      $data=$this->AnalisisModel->listLahanByKode($kode);
      echo json_encode($data);
    }
    public function tampilDataPermintaan(){
      $data['user']= $this->aunt->getUser();
      $email = $data['user']['email'];
      $data=$this->AnalisisModel->listPermintaan($email);
      echo json_encode($data);
    }
    public function insertDataPermintaan(){
      $data['user']= $this->aunt->getUser();
      $kode = $this->input->post('kode');
      $data = array(
        'kode'=>$kode,
        'email'=>$data['user']['email'],
        'tanggal'=>date("Y-m-d")
      );
      $result = $this->AnalisisModel->simpanData($data);
      echo json_encode($result);
    }
    public function delete(){
      $kode = $this->input->post('kode');
      $data=$this->AnalisisModel->hapusData($kode);
      echo json_encode($data);
    }
    private function getJumlahKelapa(){
      $data['user']= $this->aunt->getUser();
      $data['jumlah_kelapa'] = $this->AnalisisModel->getJumlahDagingKelapa($data['user']['email']);
      $jumlah = (int)$data['jumlah_kelapa']['jumlah_kelapa'];
      return $jumlah;
    }
    private function getDagingKelapa(){
      $jumlah = $this->getJumlahKelapa();
      $hasil = $jumlah * 0.35;
      return $hasil;
    }
    private function getJumlahProduksi(){
      $w = floatval($this->getDagingKelapa());
      $q = $w * 0.56 * 0.35;
      return $q;
    }
    private function getFrekuensiPemutaran($mesin){
      $n = $this->getJumlahProduksi()/(0.35 * $mesin);
      return $n;
    }
    private function getJumlahPemutaranSehari($mesin){
      return $this->getFrekuensiPemutaran($mesin)/24;
    }
    private function getJumlahMesin($mesin){
      $hasil = $this->getJumlahPemutaranSehari($mesin)/14;
      return $hasil;
    }
    public function analisisMesin(){
      $data['user']= $this->aunt->getUser();
      $data['jumlahkelapa'] = $this->getJumlahKelapa();
      $data['jumlahdagingkelapa'] = $this->getDagingKelapa();
      if($data['jumlahkelapa']==0){
        redirect('lahan/analisis');
      }
      $this->form_validation->set_rules('frekuensipemutaran','Frekuensi Pemutaran','required',
                                        [
                                          'required'=>'Tidak boleh kosong'
                                        ]);
      $this->form_validation->set_rules('frekuensipemutaran','Frekuensi Pemutaran','required',
                                        [
                                          'required'=>'Tidak boleh kosong'
                                        ]);
      $this->form_validation->set_rules('frekuensiperhari','Frekuensi Pemutaran Perhari','required',
                                        [
                                          'required'=>'Tidak boleh kosong'
                                        ]);
      $this->form_validation->set_rules('jumlahmesin','Jumlah Mesin','required',
                                        [
                                          'required'=>'Tidak boleh kosong'
                                        ]);
      $this->form_validation->set_rules('jumlahvco','Jumlah VCO','required',
                                        [
                                          'required'=>'Tidak boleh kosong'
                                        ]);
      if($this->form_validation->run()==false){
        $data['judul'] ='Kapasitas Produksi';
        $data['mesin'] = $this->db->get('tbl_mesin')->result_array();
        $this->load->view('template/dashboard/header',$data);
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('user/kapasitasproduksi');
        $this->load->view('template/dashboard/footer');
        $this->load->view('template/dashboard/script');
      }else{
        $email = $data['user']['email'];
        $jumlahlahan = 2;
        $jumlahkelapa = $this->getJumlahKelapa();
        $jumlahdagingkelapa = $this->getDagingKelapa();
        $jumlahvco = $this->getJumlahProduksi();
        $mesin = htmlspecialchars($this->input->post('jenisMesin'));
        $jumlahmesin = $this->getJumlahMesin($mesin);
        $frekuensiperhari = $this->getJumlahPemutaranSehari($mesin);
        $frekuensibulanan = $this->getFrekuensiPemutaran($mesin);
        $data = [
          "email"=>$email,
          "jumlah_lahan"=>$jumlahlahan,
          "jumlah_kelapa"=>$jumlahkelapa,
          "jumlah_daging_kelapa"=>$jumlahdagingkelapa,
          "jumlah_vco"=>$jumlahvco,
          "kode_mesin"=>$mesin,
          "jumlah_mesin"=>$jumlahmesin,
          "frekuensi_hari"=>$frekuensiperhari,
          "frekuensi_bulan"=>$frekuensibulanan
        ];
        $this->db->delete('tbl_permintaan',['email'=>$email]);
        $this->db->insert('tbl_permintaan',$data);
        redirect('lahan/totalBiayaProduksi');
      }
    }
    public function getHasilByMesin(){
      $mesin = $this->input->post('mesin');
      $frekuensi = $this->getFrekuensiPemutaran($mesin);
      $pemutaranperhari = $this->getJumlahPemutaranSehari($mesin);
      $data = [
        'frekunesi'=>number_format($frekuensi,2,',','.'),
        'pemutaranperhari'=>number_format($pemutaranperhari,2,',','.'),
        'jumlahmesin'=>number_format($this->getJumlahMesin($mesin),0,',','.'),
        'jumlahvco'=>number_format($this->getJumlahProduksi(),2,',','.')
      ];
      echo json_encode($data);
    }
    public function totalBiayaProduksi(){
      $data['user']= $this->aunt->getUser();
      $data['lahan']= $this->db->get_where('tbl_permintaan',['email'=>$data['user']['email']])->row_array();
      $data['judul'] ='Total Biaya Produksi';
      $this->load->view('template/dashboard/header',$data);
      $this->load->view('template/dashboard/sidebar');
      $this->load->view('user/totalbiayaproduksi');
      $this->load->view('template/dashboard/footer');
      $this->load->view('template/dashboard/script');
    }
    public function hitungTotalBiayaProduksi(){
      $data['user']= $this->aunt->getUser();
      $hargavco =$this->input->post('hargavco');
      $jumvco = $this->input->post('jumvco');
      $pervcojual = $this->input->post('jumvcojual');
      $bypemkelapa = $this->input->post('bypemkelapa');
      $bytenkerja = $this->input->post('bytenkerja');
      $byutilitas = $this->input->post('byutilitas');
      $bypersedkelapa = $this->input->post('bypersedkelapa');
      $bypersedvco = $this->input->post('bypersedvco');
      $pervco = $this->input->post('pervco');
      $pervcot = $this->input->post('pervcot');
      $jumkelapa = $this->input->post('jumkelapa');
      $frekbul = $this->input->post('frekbul');
      $kapmesin = $this->input->post('kapmesin');
      $conbytenkerja = $this->convertByTgKerjaHari($bytenkerja);
      $jumvcojual = $this->getJumlahVcoDijual($jumvco,$pervcojual);
      $penjualanvco = $this->getPenjualanVco($jumvcojual,$hargavco);
      $pembeliankelapa = $this->getPembelianKelapa($jumkelapa,$bypemkelapa);
      $biayatenagakerja = $this->getBiayaTenagaKerja($frekbul,$conbytenkerja);
      $biayautilitas = $this->getBiayaUtilitas($byutilitas,$jumvco);
      $biayaperkelapa = $this->getBiayaPerKelapa();
      $biayapervco = $this->getBiayaPerVco($pervco,$pervcot,$bypersedvco);
      $biayaalat = $this->getBiayaAlat($kapmesin);
      $hasilk = abs($penjualanvco - ($pembeliankelapa+$biayatenagakerja+$biayautilitas+$biayaperkelapa+$biayapervco));
      $hasil = $hasilk - $biayaalat;
      echo number_format($hasil,2,',','.');
    }
    public function getJumlahVcoDijual($jumvco,$pervcojual){
      $hasil = ($jumvco/100)*$pervcojual;
      return $hasil;
    }
    public function getPenjualanVco($jumvcojual,$hargavco){
      $hasil = $jumvcojual * $hargavco;
      return $hasil;
    }
    public function getPembelianKelapa($jumkelapa,$bypemkelapa){
      $hasil = $jumkelapa * $bypemkelapa;
      return $hasil;
    }
    private function getBiayaTenagaKerja($frekbul,$bytenkerja){
      $hasil = $bytenkerja * $frekbul ;
      return $hasil;
    }
    private function getBiayaUtilitas($byutilitas,$jumvco){
      $hasil = $byutilitas * $jumvco;
      return $hasil;
    }
    private function getBiayaPerKelapa(){
      return 0;
    }
    private function getBiayaPerVco($pervco,$pervcot,$bypersedvco){
      $hasil = (($pervcot + $pervco)/2) * $bypersedvco;
      return $hasil;
    }
    private function convertByTgKerjaHari($bytenkerja){
      $hasil = $bytenkerja / 28;
      return $hasil;
    }
    private function getBiayaAlat($kapmesin){
      $b = 1.785;
      $d = 0.18;
      $a = 9.34;
      $pakamesin = pow($kapmesin,$b);
      $hasil = $d * $a * $pakamesin;
      return $hasil;
    }
    public function jarakPabrik(){
      $data['user']= $this->aunt->getUser();
      $data['kecamatan']=$this->db->get('tbl_lahan')->result_array();
      $data['judul'] ='Jarak ke Pabrik';
      $this->load->view('template/dashboard/header',$data);
      $this->load->view('template/dashboard/sidebar');
      $this->load->view('user/jarakpabrik');
      $this->load->view('template/dashboard/footer');
      $this->load->view('template/dashboard/script');
    }
    public function convertStringRp($value){
      $hasil = number_format($value,0,',','.');
      echo $hasil;
    }
    public function convertString($value){
      $hasil = number_format($value,2,',','.');
      echo $hasil;
    }
  }

?>
