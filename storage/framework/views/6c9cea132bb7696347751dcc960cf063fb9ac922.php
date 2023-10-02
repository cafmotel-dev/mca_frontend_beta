<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from joblly-admin-template-dashboard.multipurposethemes.com/bs5/main/auth_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Jul 2023 04:59:49 GMT -->
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://joblly-admin-template-dashboard.multipurposethemes.com/bs5/images/favicon.ico">

    <title>Log in | <?php echo e(env('PORTAL_NAME1')); ?>  <?php echo e(env('PORTAL_NAME2')); ?> </title>
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="<?php echo e(asset('assets/css/vendors_css.css')); ?>">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/css/skin_color.css')); ?>">	

</head>
	
<body class="hold-transition theme-primary bg-img" style="background-image: url(assets/images/auth-bg/bg-1.jpg)">
	
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">	
			
			<div class="col-12">
				<div class="row justify-content-center g-0">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-white rounded10 shadow-lg">
							<div class="content-top-agile p-20 pb-0">
								<h2 class="text-primary"><?php echo e(env('PORTAL_NAME1')); ?> <?php echo e(env('PORTAL_NAME2')); ?></h2>
								<p class="mb-0">Sign in to start your session.</p>							
							</div>
							<div class="p-40">
                            <form method="POST" action="<?php echo e(url('/')); ?>">
                            <?php echo csrf_field(); ?>
            						<div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                                            <input id="email" type="email" class="form-control ps-15 bg-transparent <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" placeholder="Email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>

										</div>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
                                            <input id="password" type="password" class="form-control ps-15 bg-transparent <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" placeholder="Password" required autocomplete="current-password">

										</div>
									</div>
									
										<!-- /.col -->
										<!-- <div class="col-6">
										 <div class="fog-pwd text-end">
											<a href="javascript:void(0)" class="hover-warning"><i class="ion ion-locked"></i> Forgot pwd?</a><br>
										  </div>
										</div> -->
										<!-- /.col -->
										<div class="col-12 text-center">
										  <button type="submit" class="btn btn-danger mt-10">SIGN IN</button>
										</div>
										<!-- /.col -->
									  </div>
								</form>	
								<!-- <div class="text-center">
									<p class="mt-15 mb-0">Don't have an account? <a href="auth_register.html" class="text-warning ms-5">Sign Up</a></p>
								</div>	 -->
							</div>						
						</div>
						<!-- <div class="text-center">
						  <p class="mt-20 text-white">- Sign With -</p>
						  <p class="gap-items-2 mb-20">
							  <a class="btn btn-social-icon btn-round btn-facebook" href="#"><i class="fa fa-facebook"></i></a>
							  <a class="btn btn-social-icon btn-round btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
							  <a class="btn btn-social-icon btn-round btn-instagram" href="#"><i class="fa fa-instagram"></i></a>
							</p>	
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Vendor JS -->
	<script src="<?php echo e(asset('assets/js/vendors.min.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/js/pages/chat-popup.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/icons/feather-icons/feather.min.js')); ?>"></script>	

</body>

<!-- Mirrored from joblly-admin-template-dashboard.multipurposethemes.com/bs5/main/auth_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Jul 2023 04:59:49 GMT -->
</html>
<?php /**PATH C:\xampp\htdocs\mca_crm\mca-crm-frontend_beta\resources\views/login/login.blade.php ENDPATH**/ ?>