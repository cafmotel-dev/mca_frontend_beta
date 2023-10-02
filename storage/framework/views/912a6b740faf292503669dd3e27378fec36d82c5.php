
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a style="height: 55px;" href="<?php echo e(url('/dashboard')); ?>" class="brand-link"><!--<?php echo e(Session::get('logo')); ?>-->
      <img style="margin-left: 1.8rem" src="<?php echo e(url('/')); ?>/uploads/logo/logo-white_crm.png" alt="AdminLTE Logo" class="brand-image" style="opacity: 1.8; max-height: 40px;">
     <!--  <span class="brand-text font-weight-light"><?php echo e(env('PORTAL_NAME1')); ?> <?php echo e(env('PORTAL_NAME2')); ?></span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo e(asset('asset/dist/img/user2-160x160.jpg')); ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo e(Session::get('first_name')); ?> <?php echo e(Session::get('last_name')); ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo e(url('/dashboard')); ?>" class="nav-link  <?php if($uri_segments_parameter == 'dashboard'): ?> active <?php endif; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <?php if(Session::get("userLevel") > 5): ?>
           <li class="nav-item <?php if($uri_segments_parameter == 'roles' || $uri_segments_parameter == 'users' ||  $uri_segments_parameter == 'groups'): ?> menu-open <?php endif; ?>">
            <a href="#" class="nav-link <?php if($uri_segments_parameter == 'roles' || $uri_segments_parameter == 'users' ||  $uri_segments_parameter == 'groups'): ?> active <?php endif; ?> ">
              <i class="nav-icon fa fa-users"></i>
              <p>
                User Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                 <li class="nav-item">
            <a href="<?php echo e(url('/users')); ?>" class="nav-link <?php if($uri_segments_parameter == 'users'): ?> active <?php endif; ?>">
              <i class="nav-icon fa fa-user-plus"></i>
              <p>
                Users
              </p>
            </a>
          </li>

            <li class="nav-item">
            <a href="<?php echo e(url('/roles')); ?>" class="nav-link <?php if($uri_segments_parameter == 'roles'): ?> active <?php endif; ?>">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Roles
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="<?php echo e(url('/groups')); ?>" class="nav-link <?php if($uri_segments_parameter == 'groups'): ?> active <?php endif; ?>">
              <i class="nav-icon fa fa-tasks" aria-hidden="true"></i>
              <p>
                Groups
              </p>
            </a>
          </li>

            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo e(url('/lists')); ?>" class="nav-link <?php if($uri_segments_parameter == 'lists'): ?> active <?php endif; ?>">
              <i class="nav-icon fa fa-tasks" aria-hidden="true"></i>
              <p>
                Lists
              </p>
            </a>
          </li>
          <?php endif; ?>


       

          

          <li class="nav-item">
            <a href="<?php echo e(url('/leads')); ?>" class="nav-link <?php if($uri_segments_parameter == 'leads'): ?> active <?php endif; ?>">
              <i class="nav-icon fa fa-tasks" aria-hidden="true"></i>
              <p>
                Leads
              </p>
            </a>
          </li>



          
         
         <?php if(Session::get("userLevel") > 5): ?>

         <!--  <li class="nav-item">
            <a href="<?php echo e(url('/documents')); ?>" class="nav-link <?php if($uri_segments_parameter == 'documents'): ?> active <?php endif; ?>">
              <i class="nav-icon fa fa-tasks" aria-hidden="true"></i>
              <p>
                Documents
              </p>
            </a>
          </li> -->
          <!-- <li class="nav-item <?php echo e((request()->is('smtps')) ? 'menu-is-opening menu-open':''); ?> "> -->

          <li class="nav-item <?php if($uri_segments_parameter == 'labels' || $uri_segments_parameter == 'dids' || $uri_segments_parameter == 'lead-source' || $uri_segments_parameter == 'document-types' || $uri_segments_parameter == 'lead-status'  || $uri_segments_parameter == 'smtps' || $uri_segments_parameter == 'email-templates' || $uri_segments_parameter == 'pdf-templates' || $uri_segments_parameter == 'lenders'): ?> menu-open <?php endif; ?>">
            <a href="#" class="nav-link <?php if($uri_segments_parameter == 'labels' || $uri_segments_parameter == 'dids' || $uri_segments_parameter == 'document-types' || $uri_segments_parameter == 'lead-status'  || $uri_segments_parameter == 'smtps' || $uri_segments_parameter == 'email-templates'): ?> active <?php endif; ?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

               <?php /*?><li class="nav-item">
                <a href="{{url('/template-types')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Template Types</p>
                </a>
              </li>
              <?php */ ?>


               <li class="nav-item">
                <a href="<?php echo e(url('/lenders')); ?>" class="nav-link <?php if($uri_segments_parameter == 'lenders'): ?> active <?php endif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lenders </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo e(url('/email-templates')); ?>" class="nav-link <?php if($uri_segments_parameter == 'email-templates'): ?> active <?php endif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Email Templates </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo e(url('/pdf-templates')); ?>" class="nav-link <?php if($uri_segments_parameter == 'pdf-templates'): ?> active <?php endif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pdf Templates </p>
                </a>
              </li>
              
              <li class="nav-item ">
                <a href="<?php echo e(url('/smtps')); ?>" class="nav-link <?php if($uri_segments_parameter == 'smtps'): ?> active <?php endif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SMTP</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link <?php if($uri_segments_parameter == ''): ?> active <?php endif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SMS Configuration</p>
                </a>
              </li>

             

          <li class="nav-item">
            <a href="<?php echo e(url('/lead-status')); ?>" class="nav-link <?php if($uri_segments_parameter == 'lead-status'): ?> active <?php endif; ?>">
              <i class="nav-icon fa fa-tasks" aria-hidden="true"></i>
              <p>
                Lead Status
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo e(url('/dids')); ?>" class="nav-link <?php if($uri_segments_parameter == 'dids'): ?> active <?php endif; ?>">
              <i class="nav-icon fa fa-phone" aria-hidden="true"></i>
              <p>
                DID
              </p>
            </a>
          </li>

         

          <li class="nav-item">
            <a href="<?php echo e(url('/labels')); ?>" class="nav-link <?php if($uri_segments_parameter == 'labels'): ?> active <?php endif; ?>">
              <i class="nav-icon fa-solid fa-tags"></i>
              <p>
                Labels
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="<?php echo e(url('/lead-source')); ?>" class="nav-link <?php if($uri_segments_parameter == 'lead-source'): ?> active <?php endif; ?>">
              <i class="nav-icon fa-solid fa-tags"></i>
              <p>
                Lead Source
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="<?php echo e(url('/document-types')); ?>" class="nav-link <?php if($uri_segments_parameter == 'document-types'): ?> active <?php endif; ?>">
              <i class="nav-icon fa-solid fa-tags"></i>
              <p>
                Document Types
              </p>
            </a>
          </li>

            </ul>
          </li>

          

          <?php endif; ?>

          

          <li class="nav-item">
            <a href="<?php echo e(url('/logout')); ?>" class="nav-link <?php if($uri_segments_parameter == 'logout'): ?> active <?php endif; ?>">
              <i class="nav-icon fa fa-power-off"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<?php /**PATH C:\xampp\htdocs\mca_crm\mca-crm-frontend\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>