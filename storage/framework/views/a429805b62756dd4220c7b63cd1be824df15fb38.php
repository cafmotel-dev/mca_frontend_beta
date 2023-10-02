<?php $__env->startSection('title', 'User List'); ?>
<?php $__env->startSection('content'); ?> 

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo e(url('/dashboard')); ?>">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <?php echo $__env->make("layouts.messaging", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">

            <div class="modal-footer">
              <a href="<?php echo e(url('/user')); ?>/add" class="btn btn btn-primary waves-effect waves-light reset" ><i class="fa fa-plus"></i> Add User</a> 
            </div>

            <div class="card-body">
              <table id="datatable" class="table table-striped table-bordered table-hover" style="width:100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <?php if(Session::get("userLevel") > 5): ?>
                    <th>Password</th>
                    <?php endif; ?>

                    <th>SIP Extension</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>Action</th>
                  </tr>
                </thead>
                
                <tbody>

                  <?php if(!empty($users)): ?>
                  <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($list->user_level != 11): ?>

                  <tr>
                    <td><?php echo e($key+1); ?></td>
                    <td><?php echo e(ucfirst($list->first_name)); ?> <?php echo e(ucfirst($list->last_name)); ?></td>
                    <td><?php echo e($list->email); ?></td>


                    <?php if(Session::get("userLevel") > 5): ?>
                    <td>
                      <a id="hide_<?php echo e($key); ?>" onmouseover="textPassword(<?php echo e($key); ?>)" ><?php echo e(str_repeat("*", strlen($list->password_value))); ?></a>
                      <a style="display: none;" id="show_<?php echo e($key); ?>" onmouseout="textNormal(<?php echo e($key); ?>)"><?php echo e($list->password_value); ?></a>
                    </td>
                    <?php endif; ?>

                    <td><?php echo e($list->sip_extension); ?></td>

                    <td>
                      <?php if($list->status == 1): ?>
                      <span class="badge badge-success">Active</span>
                      <?php else: ?>
                      <span class="badge badge-danger">Inactive</span>
                      <?php endif; ?>
                    </td>
                    <td><?php echo e(ucfirst($list->role_name)); ?></td>
                    <td>
                      <ul class="list-inline m-0">
                        <li class="list-inline-item">
                          <a href="<?php echo e(url('/user')); ?>/<?php echo e($list->id); ?>/edit"  type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
                        </li>

                        <li class="list-inline-item">
                          <form method="POST" action="<?php echo e(route('user.delete', $list->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <input name="_method" type="hidden" value="DELETE">
                            <a style="color:red;" type="submit" class="show_confirm" data-toggle="tooltip" title='Delete'><i class="fa fa-trash fa-lg"></i></a>
                          </form>
                        </li>

                        <li class="list-inline-item">
                          <label class="switch"><input data-id="<?php echo e($list->id); ?>" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" <?php echo e($list->status ? 'checked' : ''); ?>><span class="slider_button round"></span>
                          </label>
                        </li>
                      </ul>
                    </td>
                  </tr>
                  <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div> 
          </div>
        </div>
      </div>
  </section>
</div>

<script src="<?php echo e(asset("asset/js/user_setting_js.js")); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/users/list.blade.php ENDPATH**/ ?>