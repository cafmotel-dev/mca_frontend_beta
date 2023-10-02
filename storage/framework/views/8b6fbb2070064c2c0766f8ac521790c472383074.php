<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from joblly-admin-template-dashboard.multipurposethemes.com/bs5/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Jul 2023 04:56:25 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://joblly-admin-template-dashboard.multipurposethemes.com/bs5/images/favicon.ico">

    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e(env('PORTAL_NAME1')); ?>  <?php echo e(env('PORTAL_NAME2')); ?></title>
    
	<!-- Vendors Style-->
	<link rel="stylesheet" href="<?php echo e(asset('assets/css/vendors_css.css')); ?>">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/css/skin_color.css')); ?>">
     <!-- Vendor JS -->
	<script src="<?php echo e(asset('assets/js/vendors.min.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/js/pages/chat-popup.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/icons/feather-icons/feather.min.js')); ?>"></script>
  </head>






<header class="main-header">
	<div class="d-flex align-items-center logo-box justify-content-start">
		<a href="#" class="waves-effect waves-light nav-link d-none d-md-inline-block mx-10 push-btn bg-transparent" data-toggle="push-menu" role="button">
			<i data-feather="menu"></i>
		</a>	
		<!-- Logo -->
		<a href="index.html" class="logo">
		  <!-- logo-->
		  <div class="logo-lg">
			  <span class="light-logo"><img src="assets/images/logo-dark-text.png" alt="logo"></span>
			  <span class="dark-logo"><img src="assets/images/logo-light-text.png" alt="logo"></span>
             
		  </div>
		</a>	
	</div>  
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
	  <div class="app-menu">
		<ul class="header-megamenu nav">
			<li class="btn-group nav-item d-md-none">
				<a href="#" class="waves-effect waves-light nav-link push-btn" data-toggle="push-menu" role="button">
					<i data-feather="menu"></i>
			    </a>
			</li>
		</ul> 
	  </div>
		
      <div class="navbar-custom-menu r-side">
        <ul class="nav navbar-nav">	
		  <li class="btn-group nav-item d-lg-flex d-none align-items-center">
			<p class="mb-0 text-fade pe-10 pt-5"><?php echo e(Session::get('companyName')); ?></p>
		  </li>
		  <li class="btn-group nav-item d-lg-inline-flex d-none">
			<a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link full-screen" title="Full Screen">
				<i data-feather="maximize"></i>
			</a>
		  </li>
          <!-- Control Sidebar Toggle Button -->	
		  <!-- <li class="btn-group nav-item d-inline-flex">
			<a href="#" data-toggle="control-sidebar" class="waves-effect waves-light nav-link full-screen" title="Setting">
				<i data-feather="settings"></i>
			</a>
		  </li>	 -->
		
		  <!-- User Account-->
          <li class="dropdown user user-menu">
            <a href="#" class="waves-effect waves-light dropdown-toggle" data-bs-toggle="dropdown" title="User">
				<i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
            </a>
            <ul class="dropdown-menu animated flipInX">
              <li class="user-body">
				 <a class="dropdown-item" href="#"><i class="ti-user text-muted me-2"></i> Profile</a>
				 <a class="dropdown-item" href="#"><i class="ti-wallet text-muted me-2"></i> My Wallet</a>
				 <a class="dropdown-item" href="#"><i class="ti-settings text-muted me-2"></i> Settings</a>
				 <div class="dropdown-divider"></div>
				 <a class="dropdown-item" href="#"><i class="ti-lock text-muted me-2"></i> Logout</a>
              </li>
            </ul>
          </li>	
        </ul>
      </div>
    </nav>
  </header>  <?php /**PATH C:\xampp\htdocs\mca_crm\mca-crm-frontend_beta\resources\views/layouts/header.blade.php ENDPATH**/ ?>