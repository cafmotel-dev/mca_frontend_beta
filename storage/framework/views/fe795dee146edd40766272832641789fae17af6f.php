<?php $__env->startSection('title', 'Edit User'); ?>
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

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="modal-footer">
              <a href="<?php echo e(url('/users')); ?>" class="btn btn btn-primary waves-effect waves-light reset" ><i class="fa fa-plus"></i> Show Users</a> 
            </div>
            <hr>

            <form method="post">
              <?php echo csrf_field(); ?>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">First name <span style="color:red;">*</span></label>
                      <input type="text" name="first_name" value="<?php echo e(old('first_name', $user['first_name'])); ?>" class="form-control" id="first_name" placeholder="Enter First Name">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Last Name <span style="color:red;">*</span></label>
                      <input type="text" name="last_name" value="<?php echo e(old('last_name', $user['last_name'])); ?>" class="form-control" id="last_name" placeholder="Enter First Name">
                    </div>
                  </div>

                  <!-- <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email <span style="color:red;">*</span></label>
                      <input type="text" readonly name="email" value="<?php echo e(old('email', $user['email'])); ?>" class="form-control" id="email" placeholder="Enter Email">
                    </div>
                  </div> -->

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Fax</label>
                      <input type="text" class="form-control"  onkeypress="return isNumberKey($(this));" id="fax" name="fax" value="<?php echo e(old('fax', $user['fax'])); ?>"  placeholder="Enter Fax">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Mobile <span style="color:red;">*</span></label>
                      <input type="text" class="form-control phone_number" id="mobile" name="mobile" value="<?php echo e(old('mobile', $user['mobile'])); ?>" placeholder="Enter Phone Number">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Role</label>
                      <select class="form-control" id="role" name="role">
                        <?php if(!empty($roles)): ?>
                        <?php if(Session::get("userLevel") > 9): ?>
                          <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if($user['role'] == $role['id']): ?> selected <?php endif; ?> value="<?php echo e($role['id']); ?>"><?php echo e(ucfirst($role['name'])); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <option <?php if($user['role'] == 2): ?> selected <?php endif; ?> value="2">Agent</option>
                        <?php endif; ?>
                        <?php endif; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Select Group</label>
                      <select class="form-control" name="team_group" id="team_group">
                        <?php if(!empty($group)): ?>
                          <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if($user['team_group'] == $team['id']): ?> selected <?php endif; ?> value="<?php echo e($team['id']); ?>"><?php echo e($team['title']); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3">
                      <div class="form-group">
                          <label>Date Of Birth (mm/dd/yyyy)</label>
                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                              <input type="date" value="<?php echo e(old('mobile', $user['date_of_birth'])); ?>"  name="date_of_birth" id="date_of_birth" class="form-control " data-target="#reservationdate" />
                          </div>
                      </div>
                  </div>

                  <div class="col-md-3">
                      <div class="form-group">
                          <label>Start Date (mm/dd/yyyy)</label>
                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                              <input type="date" name="start_date" value="<?php echo e(old('mobile', $user['start_date'])); ?>" id="start_date" class="form-control " data-target="#reservationdate" />
                          </div>
                      </div>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <a href="/users" type="button" class="btn btn btn-danger waves-effect waves-light" data-dismiss="modal"><i class="fa fa-reply"></i> Cancel</a>

                <a onclick="window.location.reload();" type="button" class="btn btn btn-warning waves-effect waves-light" data-dismiss="modal"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</a>

                <button type="submit" name="submit" class="btn btn btn-primary waves-effect waves-light"><i class="fa fa-check-square-o fa-lg"></i> Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/users/edit.blade.php ENDPATH**/ ?>