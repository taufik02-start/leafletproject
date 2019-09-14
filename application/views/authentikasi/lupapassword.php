<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?= $this->session->flashdata('pesan')?>
    <p class="login-box-msg" style="font-size:25px">Lupa Password</p>
    <form method="post" action="<?=base_url('authentikasi/lupaPassword')?>">
      <div class="form-group has-feedback">
        <input type="type" class="form-control" placeholder="Email" id="email" name="email" value = "<?=set_value('email')?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?= form_error('email','<small class="text-danger pl-3">','</small>');?>
      </div>
	     <div class="social-auth-links text-center">
       <input type="submit" class="btn btn-block btn-primary btn-flat" value="Reset Password">
    </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
