<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg" style="font-size:25px">Register</p>
    <form method="post" action="<?= base_url('authentikasi/register') ?>">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama" value="<?=set_value('nama')?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <?= form_error('nama','<small class="text-danger pl-3">','</small>');?>
      </div>
	  <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Email" name="email" id="email" value="<?=set_value('email')?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?= form_error('email','<small class="text-danger pl-3">','</small>');?>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password1" id="password1" value="<?=set_value('password1')?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?= form_error('password1','<small class="text-danger pl-3">','</small>');?>
      </div>
	  <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Repeat Password" name="password2" id="password2" value="<?=set_value('password2') ?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?= form_error('password2','<small class="text-danger pl-3">','</small>');?>
      </div>
	     <div class="social-auth-links text-center">
       <input type="submit" class="btn btn-block btn-primary btn-flat" value="Register" name="btnSubmit">
    </div>
    </form>
    <!-- /.social-auth-links -->
    Sudah punya akun? <a href="<?= base_url('authentikasi')?>" class="text-center">Login</a>
  </div>
  <!-- /.login-box-body -->
</div>
