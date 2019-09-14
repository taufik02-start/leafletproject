<body class="bg-gradient-primary">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">LOGIN KE AKUN ANDA</h1>
                  </div>
                  <?= $this->session->flashdata('pesan')?>
                  <form class="user" method="post" action="<?= base_url('authentikasi') ?>">
                    <div class="form-group">
                      <input type="type" class="form-control form-control-user" id="email" name="email" value = "<?= set_value('email')?>" placeholder="Masukan Email Anda">
                      <?= form_error('email','<small class="text-danger pl-3">','</small>');?>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukan Password Anda">
                      <?= form_error('password','<small class="text-danger pl-3">','</small>');?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?= base_url('authentikasi/lupaPassword') ?>">Lupa Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small">Belum punya akun? </a><a class="small" href="<?= base_url('authentikasi/register')?>">Buat Akun</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
