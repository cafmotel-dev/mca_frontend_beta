<?php $__env->startSection('title', 'Add Lender'); ?>
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
                        <li class="breadcrumb-item active">Lenders</li>
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
                            <a href="<?php echo e(url('/lenders')); ?>" class="btn btn btn-primary waves-effect waves-light reset" ><i class="fa fa-eye"></i> Show Lenders</a> 
                        </div>
                        <hr>

                        <form method="post">
                            <?php echo csrf_field(); ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Lender name <span style="color: red;">*</span></label>
                                            <input type="text" name="lender_name" value="<?php echo e(old('lender_name')); ?>" class="form-control" id="lender_name" required placeholder="Enter Lender Name" />
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email <span style="color: red;">*</span></label>
                                            <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control" id="email" placeholder="Enter Email" required />
                                        </div>
                                    </div>

                                      <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone </label>
                                            <input name="phone" id="phone" value="<?php echo e(old('mobile')); ?>" type="text" class="form-control phone_number" data-inputmask="'mask': '(999) 999-9999'" data-mask="" required />
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Contact person <span style="color: red;">*</span></label>
                                            <input type="text" name="contact_person" value="<?php echo e(old('contact_person')); ?>" class="form-control" id="contact_person" required placeholder="Enter Contact Person" />
                                        </div>
                                    </div>

                                      <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Address </label>
                                            <input type="text" name="address" value="<?php echo e(old('address')); ?>" class="form-control" id="address" required placeholder="Enter Address" />
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">State</label>

                                            <select class="form-control" name="state" id="state">
                                                                    <option value="AL">Alabama</option>
                                                                        <option value="AK">Alaska</option>
                                                                        <option value="AS">American Samoa</option>
                                                                        <option value="AZ">Arizona</option>
                                                                        <option value="AR">Arkansas</option>
                                                                        <option value="AE-A">Armed Forces Africa</option>
                                                                        <option value="AA">Armed Forces Americas</option>
                                                                        <option value="AE-C">Armed Forces Canada</option>
                                                                        <option value="AE-E">Armed Forces Europe</option>
                                                                        <option value="AE-M">Armed Forces Middle East</option>
                                                                        <option value="AP">Armed Forces Pacific</option>
                                                                        <option value="CA">California</option>
                                                                        <option value="CO">Colorado</option>
                                                                        <option value="CT">Connecticut</option>
                                                                        <option value="DE">Delaware</option>
                                                                        <option value="DC">District of Columbia</option>
                                                                        <option value="FM">Federated States of Micronesia</option>
                                                                        <option value="FL">Florida</option>
                                                                        <option value="GA">Georgia</option>
                                                                        <option value="GU">Guam</option>
                                                                        <option value="HI">Hawaii</option>
                                                                        <option value="ID">Idaho</option>
                                                                        <option value="IL">Illinois</option>
                                                                        <option value="IN">Indiana</option>
                                                                        <option value="IA">Iowa</option>
                                                                        <option value="KS">Kansas</option>
                                                                        <option value="KY">Kentucky</option>
                                                                        <option value="LA">Louisiana</option>
                                                                        <option value="ME">Maine</option>
                                                                        <option value="MD">Maryland</option>
                                                                        <option value="MA">Massachusetts</option>
                                                                        <option value="MI">Michigan</option>
                                                                        <option value="MN">Minnesota</option>
                                                                        <option value="MS">Mississippi</option>
                                                                        <option value="MO">Missouri</option>
                                                                        <option value="MT">Montana</option>
                                                                        <option value="NE">Nebraska</option>
                                                                        <option value="NV">Nevada</option>
                                                                        <option value="NH">New Hampshire</option>
                                                                        <option value="NJ">New Jersey</option>
                                                                        <option value="NM">New Mexico</option>
                                                                        <option value="NY">New York</option>
                                                                        <option value="NC">North Carolina</option>
                                                                        <option value="ND">North Dakota</option>
                                                                        <option value="MP">Northern Mariana Islands</option>
                                                                        <option value="OH">Ohio</option>
                                                                        <option value="OK">Oklahoma</option>
                                                                        <option value="OR">Oregon</option>
                                                                        <option value="PA">Pennsylvania</option>
                                                                        <option value="PR">Puerto Rico</option>
                                                                        <option value="MH">Republic of Marshall Islands</option>
                                                                        <option value="RI">Rhode Island</option>
                                                                        <option value="SC">South Carolina</option>
                                                                        <option value="SD">South Dakota</option>
                                                                        <option value="TN">Tennessee</option>
                                                                        <option value="TX">Texas</option>
                                                                        <option value="UT">Utah</option>
                                                                        <option value="VT">Vermont</option>
                                                                        <option value="VI">Virgin Islands of the U.S.</option>
                                                                        <option value="VA">Virginia</option>
                                                                        <option value="WA">Washington</option>
                                                                        <option value="WV">West Virginia</option>
                                                                        <option value="WI">Wisconsin</option>
                                                                        <option value="WY">Wyoming</option>
                                                                </select>
                                           
                                        </div>
                                    </div>

                                      <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">City </label>
                                            <input type="text" name="city" value="<?php echo e(old('city')); ?>" class="form-control" id="city" required placeholder="Enter City" />
                                        </div>
                                    </div>


                                   

                                    

                                    <!-- /.col -->

                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>

                            <div class="modal-footer">
                                <a href="/lenders" type="button" class="btn btn btn-danger waves-effect waves-light" data-dismiss="modal"><i class="fa fa-reply"></i> Cancel</a>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/lenders/add.blade.php ENDPATH**/ ?>