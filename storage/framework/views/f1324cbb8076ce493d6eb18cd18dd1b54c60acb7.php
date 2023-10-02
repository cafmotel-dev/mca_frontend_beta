<?php $__env->startSection('title', 'Edit Lender'); ?>
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
                                            <input type="text" name="lender_name" value="<?php echo e(old('lender_name', $lender['lender_name'])); ?>" class="form-control" id="lender_name" required placeholder="Enter Lender Name" />
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email <span style="color: red;">*</span></label>
                                            <input type="email" name="email" value="<?php echo e(old('email', $lender['email'])); ?>" class="form-control" id="email" placeholder="Enter Email" required />
                                        </div>
                                    </div>

                                      <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone </label>
                                            <input name="phone" id="phone" value="<?php echo e(old('phone', $lender['phone'])); ?>" type="text" class="form-control phone_number" data-inputmask="'mask': '(999) 999-9999'" data-mask="" required />
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Contact person <span style="color: red;">*</span></label>
                                            <input type="text" name="contact_person" value="<?php echo e(old('contact_person', $lender['contact_person'])); ?>" class="form-control" id="contact_person" required placeholder="Enter Contact Person" />
                                        </div>
                                    </div>

                                      <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Address </label>
                                            <input type="text" name="address" value="<?php echo e(old('address', $lender['address'])); ?>" class="form-control" id="address" required placeholder="Enter Address" />
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">State</label>

                                            <select class="form-control" name="state" id="state">
                                                                    <option <?php if($lender['state'] == 'AL'): ?> selected <?php endif; ?>   value="AL">Alabama</option>
                                                                        <option <?php if($lender['state'] == 'AK'): ?> selected <?php endif; ?>   value="AK">Alaska</option>
                                                                        <option <?php if($lender['state'] == 'AS'): ?> selected <?php endif; ?>   value="AS">American Samoa</option>
                                                                        <option <?php if($lender['state'] == 'AZ'): ?> selected <?php endif; ?>   value="AZ">Arizona</option>
                                                                        <option <?php if($lender['state'] == 'AR'): ?> selected <?php endif; ?>   value="AR">Arkansas</option>
                                                                        <option <?php if($lender['state'] == 'AE-A'): ?> selected <?php endif; ?>   value="AE-A">Armed Forces Africa</option>
                                                                        <option <?php if($lender['state'] == 'AA'): ?> selected <?php endif; ?>   value="AA">Armed Forces Americas</option>
                                                                        <option <?php if($lender['state'] == 'AE-C'): ?> selected <?php endif; ?>   value="AE-C">Armed Forces Canada</option>
                                                                        <option <?php if($lender['state'] == 'AE-E'): ?> selected <?php endif; ?>   value="AE-E">Armed Forces Europe</option>
                                                                        <option <?php if($lender['state'] == 'AE-M'): ?> selected <?php endif; ?>   value="AE-M">Armed Forces Middle East</option>
                                                                        <option <?php if($lender['state'] == 'AP'): ?> selected <?php endif; ?>   value="AP">Armed Forces Pacific</option>
                                                                        <option <?php if($lender['state'] == 'CA'): ?> selected <?php endif; ?>   value="CA">California</option>
                                                                        <option <?php if($lender['state'] == 'CO'): ?> selected <?php endif; ?>   value="CO">Colorado</option>
                                                                        <option <?php if($lender['state'] == 'CT'): ?> selected <?php endif; ?>   value="CT">Connecticut</option>
                                                                        <option <?php if($lender['state'] == 'DE'): ?> selected <?php endif; ?>   value="DE">Delaware</option>
                                                                        <option <?php if($lender['state'] == 'DC'): ?> selected <?php endif; ?>   value="DC">District of Columbia</option>
                                                                        <option <?php if($lender['state'] == 'FM'): ?> selected <?php endif; ?>   value="FM">Federated States of Micronesia</option>
                                                                        <option <?php if($lender['state'] == 'FL'): ?> selected <?php endif; ?>   value="FL">Florida</option>
                                                                        <option <?php if($lender['state'] == 'GA'): ?> selected <?php endif; ?>   value="GA">Georgia</option>
                                                                        <option <?php if($lender['state'] == 'GU'): ?> selected <?php endif; ?>   value="GU">Guam</option>
                                                                        <option <?php if($lender['state'] == 'HI'): ?> selected <?php endif; ?>   value="HI">Hawaii</option>
                                                                        <option <?php if($lender['state'] == 'ID'): ?> selected <?php endif; ?>   value="ID">Idaho</option>
                                                                        <option <?php if($lender['state'] == 'IL'): ?> selected <?php endif; ?>   value="IL">Illinois</option>
                                                                        <option <?php if($lender['state'] == 'IN'): ?> selected <?php endif; ?>   value="IN">Indiana</option>
                                                                        <option <?php if($lender['state'] == 'IA'): ?> selected <?php endif; ?>   value="IA">Iowa</option>
                                                                        <option <?php if($lender['state'] == 'KS'): ?> selected <?php endif; ?>   value="KS">Kansas</option>
                                                                        <option <?php if($lender['state'] == 'KY'): ?> selected <?php endif; ?>   value="KY">Kentucky</option>
                                                                        <option <?php if($lender['state'] == 'LA'): ?> selected <?php endif; ?>   value="LA">Louisiana</option>
                                                                        <option <?php if($lender['state'] == 'ME'): ?> selected <?php endif; ?>   value="ME">Maine</option>
                                                                        <option <?php if($lender['state'] == 'MD'): ?> selected <?php endif; ?>   value="MD">Maryland</option>
                                                                        <option <?php if($lender['state'] == 'MA'): ?> selected <?php endif; ?>   value="MA">Massachusetts</option>
                                                                        <option <?php if($lender['state'] == 'MI'): ?> selected <?php endif; ?>   value="MI">Michigan</option>
                                                                        <option <?php if($lender['state'] == 'MN'): ?> selected <?php endif; ?>   value="MN">Minnesota</option>
                                                                        <option <?php if($lender['state'] == 'MS'): ?> selected <?php endif; ?>   value="MS">Mississippi</option>
                                                                        <option <?php if($lender['state'] == 'MO'): ?> selected <?php endif; ?>   value="MO">Missouri</option>
                                                                        <option <?php if($lender['state'] == 'MT'): ?> selected <?php endif; ?>   value="MT">Montana</option>
                                                                        <option <?php if($lender['state'] == 'NE'): ?> selected <?php endif; ?>   value="NE">Nebraska</option>
                                                                        <option <?php if($lender['state'] == 'NV'): ?> selected <?php endif; ?>   value="NV">Nevada</option>
                                                                        <option <?php if($lender['state'] == 'NH'): ?> selected <?php endif; ?>   value="NH">New Hampshire</option>
                                                                        <option <?php if($lender['state'] == 'NJ'): ?> selected <?php endif; ?>   value="NJ">New Jersey</option>
                                                                        <option <?php if($lender['state'] == 'NM'): ?> selected <?php endif; ?>   value="NM">New Mexico</option>
                                                                        <option <?php if($lender['state'] == 'NY'): ?> selected <?php endif; ?>   value="NY">New York</option>
                                                                        <option <?php if($lender['state'] == 'NC'): ?> selected <?php endif; ?>   value="NC">North Carolina</option>
                                                                        <option <?php if($lender['state'] == 'ND'): ?> selected <?php endif; ?>   value="ND">North Dakota</option>
                                                                        <option <?php if($lender['state'] == 'MP'): ?> selected <?php endif; ?>   value="MP">Northern Mariana Islands</option>
                                                                        <option <?php if($lender['state'] == 'OH'): ?> selected <?php endif; ?>   value="OH">Ohio</option>
                                                                        <option <?php if($lender['state'] == 'OK'): ?> selected <?php endif; ?>   value="OK">Oklahoma</option>
                                                                        <option <?php if($lender['state'] == 'OR'): ?> selected <?php endif; ?>   value="OR">Oregon</option>
                                                                        <option <?php if($lender['state'] == 'PA'): ?> selected <?php endif; ?>   value="PA">Pennsylvania</option>
                                                                        <option <?php if($lender['state'] == 'PR'): ?> selected <?php endif; ?>   value="PR">Puerto Rico</option>
                                                                        <option <?php if($lender['state'] == 'MH'): ?> selected <?php endif; ?>   value="MH">Republic of Marshall Islands</option>
                                                                        <option <?php if($lender['state'] == 'RI'): ?> selected <?php endif; ?>   value="RI">Rhode Island</option>
                                                                        <option <?php if($lender['state'] == 'SC'): ?> selected <?php endif; ?>   value="SC">South Carolina</option>
                                                                        <option <?php if($lender['state'] == 'SD'): ?> selected <?php endif; ?>   value="SD">South Dakota</option>
                                                                        <option <?php if($lender['state'] == 'TN'): ?> selected <?php endif; ?>   value="TN">Tennessee</option>
                                                                        <option <?php if($lender['state'] == 'TX'): ?> selected <?php endif; ?>   value="TX">Texas</option>
                                                                        <option <?php if($lender['state'] == 'UT'): ?> selected <?php endif; ?>   value="UT">Utah</option>
                                                                        <option <?php if($lender['state'] == 'VT'): ?> selected <?php endif; ?>   value="VT">Vermont</option>
                                                                        <option <?php if($lender['state'] == 'VI'): ?> selected <?php endif; ?>   value="VI">Virgin Islands of the U.S.</option>
                                                                        <option <?php if($lender['state'] == 'VA'): ?> selected <?php endif; ?>   value="VA">Virginia</option>
                                                                        <option <?php if($lender['state'] == 'WA'): ?> selected <?php endif; ?>   value="WA">Washington</option>
                                                                        <option <?php if($lender['state'] == 'WV'): ?> selected <?php endif; ?>   value="WV">West Virginia</option>
                                                                        <option <?php if($lender['state'] == 'WI'): ?> selected <?php endif; ?>   value="WI">Wisconsin</option>
                                                                        <option <?php if($lender['state'] == 'WY'): ?> selected <?php endif; ?>   value="WY">Wyoming</option>
                                                                </select>
                                           
                                        </div>
                                    </div>

                                      <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">City </label>
                                            <input type="text" name="city" value="<?php echo e(old('city', $lender['city'])); ?>" class="form-control" id="city" required placeholder="Enter City" />
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/lenders/edit.blade.php ENDPATH**/ ?>