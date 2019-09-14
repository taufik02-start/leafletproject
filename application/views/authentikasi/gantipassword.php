<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg" style="font-size:25px">Ganti Password</p>
    <form method="post" action="<?=base_url('authentikasi/gantiPassword')?>">
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" id="password1" name="password1" >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?= form_error('password1','<small class="text-danger pl-3">','</small>');?>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Repeat Password" id="password2" name="password2" >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?= form_error('password2','<small class="text-danger pl-3">','</small>');?>
      </div>
	     <div class="social-auth-links text-center">
       <input type="submit" class="btn btn-block btn-primary btn-flat" value="Ganti Password">
    </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
