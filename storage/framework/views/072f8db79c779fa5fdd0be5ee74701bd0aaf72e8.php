<?php $__env->startSection('title', 'Role List'); ?>

<?php $__env->startSection('content'); ?>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(url('/dashboard')); ?>">Home</a></li>
              <li class="breadcrumb-item active">Roles</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
       <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><b><i class="fa fa-users"></i> Role's List</b> </h3>
                <!-- <a style="float:right;" href="<?php echo e(url('/user')); ?>/add" class="btn btn-primary btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Add"><i class="fa fa-table"></i></a> -->

              </div>
              <!-- ./card-header -->
             <div class="card-body"> 
                <table id="datatable" class="table table-striped table-bordered table-hover" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Level</th>
                      <!-- <th>ACTION</th> -->
                    </tr>
                  </thead>

                  <tbody>
                    <?php if(!empty($roles)): ?>
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($list->level != 11): ?>
                    <tr>
                      <td><?php echo e($key+1); ?></td>
                      <td><?php echo e(ucwords($list->name)); ?></td>
                      <td><?php if($list->status == 1): ?>
                          <span class="badge badge-success">Active</span>
                          <?php else: ?>
                          <span class="badge badge-danger">Inactive</span>
                          <?php endif; ?>
                      </td>
                      <td><?php echo $list->level; ?></td>
                      <!-- <td>
                        <ul class="list-inline m-0">
                          <?php /*?><li class="list-inline-item">
                            <button class="btn btn-primary btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Add"><i class="fa fa-table"></i></button>
                          </li><?php */?>

                          <li class="list-inline-item">
                            <a href="<?php echo e(url('/user')); ?>/<?php echo e($list->id); ?>/edit" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                          </li>

                          <li class="list-inline-item">
                            <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                          </li>
                        </ul>
                      </td> -->
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
           
        </tbody>
       
    </table>
              
             </div> 
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/roles/list.blade.php ENDPATH**/ ?>