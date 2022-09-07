<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Aplikasi Kehadiran Siswa | Form Login</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/skin/skin-blue.css') ?>">
  </head>

  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html">Aplikasi <b>KEHADIRAN</b></a>
      </div>
      <div class="login-box-body">
        <p class="login-box-msg">Silakan login</p>
        
        <?php if (validation_errors() != ''): ?>
        <div class="alert alert-warning alter-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-warning"></i> Alert!</h4>
          <?php echo validation_errors(); ?>
        </div>
        <?php endif; ?>

        <?php echo form_open('auth/session') ?>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-sm-8">
            </div>
            <div class="col-sm-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
          </div>
        </form> <!--/end-form-->    
      </div>
    </div> <!--/login box -->
  </body>
  <script src="<?php echo base_url('js/jquery-2.2.3.min.js') ?>"></script>
  <script src="<?php echo base_url('js/jquery-2.2.3.min.js') ?>"></script>
</html>
