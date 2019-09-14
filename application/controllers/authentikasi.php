<?php
  /**
   *
   */
  defined('BASEPATH') OR exit('No direct script access allowed');
  class Authentikasi extends CI_Controller{
    public function __construct(){
      parent::__construct();
      $this->load->model('AuthentikasiModel');
    }
    public function index(){
      // jika user telah login kemudian dia kembali kelogin, arahkan lagi ke menu akun
      if($this->session->userdata('email')){
        redirect('akun');
      }
      $this->form_validation->set_rules('email','Email','required|trim|valid_email',
                                        [
                                          'required'=>'Email tidak boleh kosong',
                                          'is_unique'=>'Email sudah digunakan',
                                          'valid_email'=>'Email tidak valid'
                                        ]);
      $this->form_validation->set_rules('password','Password','required|trim',
                                        [
                                          'required'=>'Password tidak boleh kosong'
                                        ]);
      if($this->form_validation->run()==false){
        $data['judul'] = "Login";
        $this->load->view('template/authentikasi/header',$data);
        $this->load->view('authentikasi/login');
        $this->load->view('template/authentikasi/footer');
      }else{
        $this->login();
      }
    }
    private function login(){
      $email = $this->input->post('email',true);
      $password = $this->input->post('password',true);
      $user = $this->db->get_where('tbl_user',['email'=>$email])->row_array();
      if($user){
        if($user['aktivasi']==1){
          if(password_verify($password,$user['password'])){
              $data=[
                'email'=>$user['email'],
                'jenis_id'=>$user['jenis_id']
              ];
              $this->session->set_userdata($data);
              if($user['jenis_id']==1){
                redirect('admin');
              }else{
                redirect('lahan');
              }
          }else{
            $this->session->set_flashdata('pesan',
            '<script>
              Swal.fire({
                type:"error",
                title:"Oops...",
                text:"Email atau password salah"
              });
            </script>');
            redirect('authentikasi');
          }
        }else{
          $this->session->set_flashdata('pesan',
          '<script>
            Swal.fire({
              type:"error",
              title:"Oops...",
              text:"Akun belum diaktifkan, cek email anda!"
            });
          </script>');
          redirect('authentikasi');
        }
      }else{
        $this->session->set_flashdata('pesan',
        '<script>
          Swal.fire({
            type:"error",
            title:"Oops...",
            text:"Email belum terdaftar"
          });
        </script>');
        redirect('authentikasi');
      }
    }
    public function register(){
      if($this->session->userdata('email')){
        redirect('potensilahan');
      }
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
        $data['judul'] = "Register";
        $this->load->view('template/authentikasi/header',$data);
        $this->load->view('authentikasi/register');
        $this->load->view('template/authentikasi/footer');
      }else{
        $email = htmlspecialchars($this->input->post('email',true));
        $data=[
          'nama'=> htmlspecialchars($this->input->post('nama',true)),
          'email'=> $email,
          'password'=> password_hash($this->input->post('password1',true),PASSWORD_DEFAULT),
          'jenis_id'=>2,
          'aktivasi'=>0,
          'tgl_daftar'=>date("Y-m-d") //sebelumnya time()
        ];
        //token untuk verifikasi
        $token = base64_encode(random_bytes(32));
        $user_token = [
          'email'=>$email,
          'token'=>$token,
          'date_created'=>time()
        ];
        $this->AuthentikasiModel->simpanDataUser($data);
        $this->db->insert('tbl_token',$user_token);
        $this->_sendEmail($token,"verifikasi");
        $this->session->set_flashdata('pesan',
        '<script>
          Swal.fire({
            type:"success",
            title:"Register",
            text:"Akun berhasil didaftarkan, silahkan periksa email anda!"
          });
        </script>');
        redirect('authentikasi');
      }
    }
    public function logout(){
      $this->session->unset_userdata('email');
      $this->session->unset_userdata('jenis_id');
      redirect('authentikasi');
    }
    public function block(){
      //block user yang mengakses halaman yang bukan haknya
      $this->load->view('block');
    }
    private function _sendEmail($token,$tipe){
      //konfigurasi wajib untuk pengiriman email
      $config = [
        'mailtype'  => 'html',
        'charset'   => 'utf-8',
        'protocol'  => 'smtp',
        'smtp_host' => 'ssl://smtp.gmail.com',
        'smtp_user' => 'vcokabpadangpariaman@gmail.com',
        'smtp_pass' => '17juni99',
        'smtp_port' => 465,
        'smtp_timeout'=>'7',
        'newline'   => "\r\n",
      ];
      $this->email->initialize($config);
      $this->email->from('vcokabpadangpariaman@gmail.com','VCO Padang Pariaman'); //dari siapa
      $this->email->to($this->input->post('email'));// tujuanya kemana, kita ambil email dari user
      //jika tujuannya untuk verifikasi
      if($tipe == 'verifikasi'){
        $this->email->subject('Verifikasi Akun');
        $this->email->message('Klik link ini untuk mengaktifkan akun anda : <br>
                              <a href="'.base_url().'authentikasi/verifikasi?email='.$this->input->post('email').
                              '&token='.urlencode($token).'">Aktfikan Akun</a>
                              <br>Token tersebut hanya berlaku selama 3 jam<br>
                              Terimakasih telah mendaftar.'
                              );
      }
      elseif($tipe == 'lupapassword'){
        $this->email->subject('Lupa Password');
        $this->email->message('Klik link ini untuk mereset password akun anda : <br>
                              <a href="'.base_url().'authentikasi/resetpassword?email='.$this->input->post('email').
                              '&token='.urlencode($token).'">Reset Password</a>
                              <br>Token tersebut hanya berlaku selama 3 jam<br>
                              Terimakasih.'
                              );
      }
      if($this->email->send()){
        return true;
      }else {
        echo $this->email->print_debugger();
      }
    }
    public function verifikasi(){
      $email = $this->input->get('email');
      $token = $this->input->get('token');
      $user = $this->db->get_where('tbl_user',['email'=>$email])->row_array();
      if($user){
        $user_token = $this->db->get_where('tbl_token',['token'=>$token])->row_array();
        if($user_token){
          /*ketika token masih berumur kurang dari 3 jam, maka boleh
            aktifkan user jika emailnya ada kemudian delete data token
            lalu tampilkan pesan untuk tanda berhasil mendaftar
          */
          if(time()-$user_token['date_created']<(60*60*3)){
            $this->db->set('aktivasi',1);
            $this->db->where('email',$email);
            $this->db->update('tbl_user');
            $this->db->delete('tbl_token',['email'=>$email]);
            $this->session->set_flashdata('pesan',
            '<script>
              Swal.fire({
                type:"success",
                title:"Confirmasi Akun",
                text:"Confirmasi akun berhasil, Silahkan Login"
              });
            </script>');
            redirect('authentikasi');
          }
          // ketika token sudah expired
          else{
            //hapus data di tabel user dan token
            $this->db->delete('tbl_user',['email'=>$email]);
            $this->db->delete('tbl_token',['email'=>$email]);
            $this->session->set_flashdata('pesan',
            '<script>
              Swal.fire({
                type:"error",
                title:"Oops...",
                text:"Aktivasi akun gagal, Token Sudah Kadarluarsa"
              });
            </script>');
            redirect('authentikasi');
          }
        }
        //ketika token salah, ini terjadi jika user mencoba menganti token yang dikirim lewat URL
        else{
          $this->session->set_flashdata('pesan',
          '<script>
            Swal.fire({
              type:"error",
              title:"Oops...",
              text:"Aktivasi akun gagal, Token salah"
            });
          </script>');
          redirect('authentikasi');
        }
      }
      //ketika email salah, ini terjadi jika user mencoba menganti email yang dikirim lewat URL
      else{
        $this->session->set_flashdata('pesan',
        '<script>
          Swal.fire({
            type:"error",
            title:"Oops...",
            text:"Aktivasi akun gagal, email salah"
          });
        </script>');
        redirect('authentikasi');
      }
    }
    public function lupaPassword(){
      $this->form_validation->set_rules('email','Email','required|trim|valid_email',
                                        [
                                          'required'=>'Email tidak boleh kosong',
                                          'valid_email'=>'Email tidak valid'
                                        ]);
      if($this->form_validation->run()==false){
        $data['judul'] = "Lupa Password";
        $this->load->view('template/authentikasi/header',$data);
        $this->load->view('authentikasi/lupapassword');
        $this->load->view('template/authentikasi/footer');
      }else{
        $email = htmlspecialchars($this->input->post('email',true));
        $user = $this->db->get_where('tbl_user',['email'=>$email,'aktivasi'=>1])->row_array();
        if($user){
          $token = base64_encode(random_bytes(32));
          $user_token = [
            'email'=>$email,
            'token'=>$token,
            'date_created'=>time()
          ];
          $this->db->insert('tbl_token',$user_token);
          $this->_sendEmail($token,"lupapassword");
          $this->session->set_flashdata('pesan',
          '<script>
            Swal.fire({
              type:"success",
              title:"Reset Password",
              text:"Silahkan periksa email anda"
            });
          </script>');
          redirect('authentikasi');
        }
        else{
          $this->session->set_flashdata('pesan',
          '<script>
            Swal.fire({
              type:"error",
              title:"Oops...",
              text:"Email belum terdaftar atau belum aktif"
            });
          </script>');
          redirect('authentikasi/lupaPassword');
        }
      }
    }
    public function resetpassword(){
      $email = $this->input->get('email');
      $token = $this->input->get('token');
      $user = $this->db->get_where('tbl_user',['email'=>$email])->row_array();
      if($user){
        $user_token = $this->db->get_where('tbl_token',['token'=>$token])->row_array();
        if($user_token){
          /*ketika token masih berumur kurang dari 3 jam, maka boleh
            aktifkan user jika emailnya ada kemudian delete data token
            lalu tampilkan pesan untuk tanda berhasil mendaftar
          */
          if(time()-$user_token['date_created']<(60*60*3)){
            $this->session->set_userdata('reset_email',$email);
            $this->gantiPassword();
          }
          // ketika token sudah expired
          else{
            //hapus data di tabel token
            $this->db->delete('tbl_token',['email'=>$email]);
            $this->session->set_flashdata('pesan',
            '<script>
              Swal.fire({
                type:"error",
                title:"Oops...",
                text:"Reset Password gagal, Token Sudah Kadarluarsa"
              });
            </script>');
            redirect('authentikasi');
          }
        }
        //ketika token salah, ini terjadi jika user mencoba menganti token yang dikirim lewat URL
        else{
          $this->session->set_flashdata('pesan',
          '<script>
            Swal.fire({
              type:"error",
              title:"Oops...",
              text:"Reset Password gagal, Token salah"
            });
          </script>');
          redirect('authentikasi');
        }
      }
      //ketika email salah, ini terjadi jika user mencoba menganti email yang dikirim lewat URL
      else{
        $this->session->set_flashdata('pesan',
        '<script>
          Swal.fire({
            type:"error",
            title:"Oops...",
            text:"Reset Password gagal, email salah"
          });
        </script>');
        redirect('authentikasi');
      }
    }
    public function gantiPassword(){
      if(!$this->session->userdata('reset_email')){
        redirect('authentikasi');
      }
      $this->form_validation->set_rules('password1','Password','required|trim|min_length[6]|matches[password2]',
                                        [
                                          'required'=>'tidak boleh kosong',
                                          'matches'=>'Password harus sama',
                                          'min_length'=>'Password harus lebih 6 karakter'
                                        ]);
      $this->form_validation->set_rules('password2','Password','required|trim|matches[password1]',
                                        [
                                          'required'=>'tidak boleh kosong',
                                          'matches'=>'Password harus sama'
                                        ]);
      if($this->form_validation->run() == false){
        $data['judul'] = "Ganti Password";
        $this->load->view('template/authentikasi/header',$data);
        $this->load->view('authentikasi/gantipassword');
        $this->load->view('template/authentikasi/footer');
      }
      else{
        $email = $this->session->userdata('reset_email');
        $this->db->delete('tbl_token',['email'=>$email]);
        $passwordbaru = htmlspecialchars($this->input->post('password1',true));
        $enkrippassword = password_hash($passwordbaru,PASSWORD_DEFAULT);
        $this->db->set('password',$enkrippassword);
        $this->db->where('email',$email);
        $this->db->update('tbl_user');
        $this->session->unset_userdata('reset_email');
        $this->session->set_flashdata('pesan',
        '<script>
          Swal.fire({
            type:"success",
            title:"Reset Password",
            text:"Password berhasil diganti"
          });
        </script>');
        redirect('authentikasi');
      }
    }
  }
 ?>
