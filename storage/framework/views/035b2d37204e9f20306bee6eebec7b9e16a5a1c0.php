<?php $__env->startSection('title', 'Add User'); ?>
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
                            <a href="<?php echo e(url('/users')); ?>" class="btn btn btn-primary waves-effect waves-light reset" ><i class="fa fa-eye"></i> Show Users</a> 
                        </div>
                        <hr>

                        <form method="post">
                            <?php echo csrf_field(); ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">First name <span style="color: red;">*</span></label>
                                            <input type="text" name="first_name" value="<?php echo e(old('first_name')); ?>" class="form-control" id="first_name" required placeholder="Enter First Name" />
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Last Name <span style="color: red;">*</span></label>
                                            <input type="text" name="last_name" value="<?php echo e(old('last_name')); ?>" class="form-control" id="last_name" required placeholder="Enter First Name" />
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email <span style="color: red;">*</span></label>
                                            <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control" id="email" placeholder="Enter Email" required />
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Password <span style="color: red;">*</span></label>

                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="password" value="<?php echo e(old('password')); ?>" autocomplete="new-password" id="password" required />
                                            <div class="input-group-prepend">
                                                <button type="button" onclick="document.getElementById('password').value =  getPassword()" class="btn btn-danger">Auto Generate</button>
                                            </div>
                                            <!-- /btn-group -->
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label>SIP Extension </label>
                                        <div class="input-group mb-3">
                                            <input
                                                type="text"
                                                class="form-control <?php $__errorArgs = ['sip_extension'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                name="sip_extension"
                                                value="<?php echo e(old('sip_extension')); ?>"
                                                id="sip_extension"
                                                data-inputmask="'mask': ['9999', '9999']"
                                                data-mask
                                            />
                                            <div class="input-group-prepend">
                                                <button type="button" onclick="document.getElementById('sip_extension').value =  getExtension(1000,9999)" class="btn btn-danger">Auto Generate</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fax</label>
                                            <input type="text" class="form-control" onkeypress="return isNumberKey($(this));"  value="<?php echo e(old('fax')); ?>" name="fax" id="fax" id="exampleInputEmail1" placeholder="Enter Fax" />
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone <span style="color: red;">*</span></label>
                                            <input name="mobile" id="mobile" value="<?php echo e(old('mobile')); ?>" type="text" class="form-control phone_number" data-inputmask="'mask': '(999) 999-9999'" data-mask="" required />
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Role</label>
                                            <select class="form-control" id="role" name="role">
                                                <?php if(!empty($roles)): ?> 
                                                <?php if(Session::get("userLevel") > 9): ?>
                                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e(old('role') == $role['id'] ? "selected" : ""); ?> value="<?php echo e($role['id']); ?>"><?php echo e(ucfirst($role['name'])); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                <?php else: ?>
                                                <option <?php echo e(old('role') == 2 ? "selected" : ""); ?> value="2">Agent</option>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Select Group</label>
                                            <select class="form-control" name="team_group" id="team_group">
                                                <?php if(!empty($group)): ?> <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e(old('team_group') == $team['id'] ? "selected" : ""); ?> value="<?php echo e($team['id']); ?>"><?php echo e(ucfirst($team['title'])); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date Of Birth (mm/dd/yyyy)</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="date" name="date_of_birth" value="<?php echo e(old('date_of_birth')); ?>" id="date_of_birth" class="form-control " data-target="#reservationdate" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Start Date (mm/dd/yyyy)</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="date" name="start_date" value="<?php echo e(old('start_date')); ?>" id="start_date" class="form-control " data-target="#reservationdate" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- /.col -->

                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>

                            <div class="modal-footer">
                                <a href="/users" type="button" class="btn btn btn-danger waves-effect waves-light" data-dismiss="modal"><i class="fa fa-reply"></i> Cancel</a>
                                <a onclick="window.location.reload();" type="button" class="btn btn btn-warning waves-effect waves-light" data-dismiss="modal"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</a>
                                <button type="submit" name="submit" class="btn btn btn-primary waves-effect waves-light"><i class="fa fa-edit edit"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<script src="<?php echo e(asset("asset/js/user_setting_js.js")); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/users/add.blade.php ENDPATH**/ ?>