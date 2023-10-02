<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in | <?php echo e(env('PORTAL_NAME1')); ?>  <?php echo e(env('PORTAL_NAME2')); ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('asset/plugins/fontawesome-free/css/all.min.css')); ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo e(asset('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('asset/dist/css/adminlte.min.css')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('asset/img/favicon.png')); ?>">
  
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="col-md-12">
    <div class="alert alert-danger" id="alert-errors" style="display: none"></div>
    <div class="alert alert-success" id="alert-success" style="display: none"></div>
    <?php if(session()->has('message')): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <?php echo e(session()->get('message')); ?>

            <?php echo e(session()->forget('message')); ?>

            <?php echo e(session()->save()); ?>

        </div>
    <?php endif; ?>
    <?php if(session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <?php echo e(session()->get('success')); ?>

            <?php echo e(session()->forget('success')); ?>

            <?php echo e(session()->save()); ?>

        </div>
    <?php endif; ?>
    <?php if(count($errors) > 0 or session()->has('error-title')): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <?php if(session()->has('error-title')): ?>
                <?php echo e(session()->get('error-title')); ?>

                <?php echo e(session()->forget('error-title')); ?>

                <?php echo e(session()->save()); ?>

            <?php endif; ?>
            <?php if(count($errors) > 0): ?>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="" class="h1"><b><?php echo e(env('PORTAL_NAME1')); ?></b> <?php echo e(env('PORTAL_NAME2')); ?></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form method="POST" action="<?php echo e(url('/')); ?>">
            <?php echo csrf_field(); ?>
        <div class="input-group mb-3">
          <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" placeholder="Email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" placeholder="Password" required autocomplete="current-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <?php /*?> <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
             <?php */?>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->

     <?php /*?> <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <?php */?>
     
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\mca_crm\mca-crm-frontend\resources\views/login/login.blade.php ENDPATH**/ ?>