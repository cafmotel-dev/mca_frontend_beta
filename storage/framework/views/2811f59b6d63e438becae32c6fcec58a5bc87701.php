<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e(env('PORTAL_NAME1')); ?>  <?php echo e(env('PORTAL_NAME2')); ?></title>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo e(asset('asset/plugins/fontawesome-free/css/all.min.css')); ?>">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo e(asset('asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('asset/plugins/jqvmap/jqvmap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('asset/dist/css/adminlte.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('asset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('asset/plugins/daterangepicker/daterangepicker.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('asset/plugins/summernote/summernote-bs4.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('asset/plugins/select2/css/select2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('asset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">

  <script src="https://kit.fontawesome.com/6160ccab2c.js" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  

  <link rel="stylesheet" href="<?php echo e(asset('asset/css/toastr.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('asset/dist/css/adminlte.css')); ?>">
  <script src="<?php echo e(url('asset/js/toastr.min.js')); ?>"></script><!-- pusher min js-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

   <script src="https://code.jquery.com/jquery-3.6.0.js"></script> 
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <link rel="icon" type="image/png" href="<?php echo e(asset('asset/img/favicon.png')); ?>">




    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
  

  <style>

    .fa
    {
      font-weight: bold !important;
    }
  .switch
  {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 22px;
  }

  .switch input
  {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider_button
  {
    position: absolute;
    cursor: pointer;
    top: 6px;
    left: 0;
    right: 0;
    bottom: -3px;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider_button:before
  {
    position: absolute;
    content: "";
    height: 15px;
    width: 15px;
    left: 4px;
    bottom: 2px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider_button
  {
    background-color: #00c0ef;
  }

  input:focus + .slider_button
  {
    box-shadow: 0 0 1px #00c0ef;
  }

  input:checked + .slider_button:before
  {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  .slider_button.round
  {
    border-radius: 34px;
  }

  .slider_button.round:before
  {
    border-radius: 50%;
  }

</style>

<style type="text/css">
.dialog-background
{
  background: none repeat scroll 0 0 rgba(244, 244, 244, 0.5);
  height: 100%;
  left: 0;
  margin: 0;
  padding: 0;
  position: absolute;
  top: 0;
  width: 100%;
  z-index: 100;
}

.dialog-loading-wrapper
{
  background: none repeat scroll 0 0 rgba(244, 244, 244, 0.5);
  border: 0 none;
  height: 100px;
  left: 50%;
  margin-left: -50px;
  margin-top: -50px;
  position: fixed;
  top: 50%;
  width: 100px;
  z-index: 9999999;
}

</style>
</head>



<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <h4 style="padding: 5px;font-weight: bold;" class="m-0"><i class="fa nav-icon fa fa-tasks" aria-hidden="true"></i> <?php echo e(ucwords(str_replace('-',' ',$uri_segments_parameter))); ?></h4>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a id="client-submenu" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><span class="badge badge-success"><?php echo e(Session::get('companyName')); ?></span></a>
      </li>

      <?php /*?>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <?php */ ?>

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 150px !important;">
          <div class="dropdown-divider"></div>

          <div class="dropdown-divider"></div>
          <a href="<?php echo e(url('/user/profile')); ?>" class="dropdown-item dropdown-footer" style="text-align:left !important;"><i class="fa fa-lock " aria-hidden="true"></i> Change Password</a>
          <div class="dropdown-divider"></div>

          <a href="<?php echo e(url('/user/profile')); ?>" class="dropdown-item dropdown-footer" style="text-align:left !important;"><i class="fa fa-edit "></i> Edit Profile</a>
          <div class="dropdown-divider"></div>

          <div class="dropdown-divider"></div>

          <a href="<?php echo e(url('/logout')); ?>" class="dropdown-item dropdown-footer" style="text-align:left !important;"><i class="fa fa-power-off " aria-hidden="true"></i> Logout</a>

        </div>

      </li>

    </ul>
  </nav>
<?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/layouts/header.blade.php ENDPATH**/ ?>