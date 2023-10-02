<?php $__env->startSection('title', 'Edit Lead Info'); ?>


<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/dashboard')); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Edit Lead</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-tasks" aria-hidden="true"></i> <b>Edit Lead
                                        Info</b></h3>
                                <a style="float:right;text-decoration:none" href="<?php echo e(url('/leads')); ?>"
                                   class="btn-danger btn-sm" type="button" data-toggle="tooltip" data-placement="top"
                                   title="Add"><i class="fa fa-eye"></i> Show Leads</a>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="post">
                                <?php echo csrf_field(); ?>
                                <div class="card-body">
                                    <div class="row">

                                        <input type="hidden" readonly name="lead_unique_url" value="<?php echo e($lead['lead_unique_url']); ?>" />
                                        <input type="hidden" readonly name="unique_token" value="<?php echo e($lead['unique_token']); ?>" />



                                        <?php if(!empty($labels)): ?>
                                            <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($label->status == 1): ?>
                                                <?php if($label->column_name != 'lead_unique_url'): ?>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label
                                                                for=""><?php if($label->data_type == 'select_option'): ?>
                                                                    Select
                                                                <?php endif; ?> <?php echo e($label->title); ?> <?php if($label->data_type == 'date'): ?> (mm/dd/yyyy) <?php endif; ?> <?php if($label->required == 1): ?>
                                                                    <span style="color: red;">*</span>
                                                                <?php endif; ?></label>

                                                            <?php if($label->label_title_url == 'country'): ?>
                                                                <select class="form-control" name="country" id="country"
                                                                        data-country="<?php echo e($lead['country']); ?>">
                                                                    <option value="US">United States</option>
                                                                    <option value="IN">India</option>
                                                                </select>
                                                            <?php elseif($label->label_title_url == 'state'): ?>
                                                                <div class="input-daterange input-group">
                                                                    <span id="state-code"
                                                                          data-state="<?php echo e($lead['state']); ?>"><input
                                                                            class="form-control" type="text" id="state"
                                                                            name="state"></span>
                                                                </div>

                                                            <?php elseif($label->data_type == 'select_option'): ?>
                                                                <?php
                                                                    $values = $label->values;
                                                                    $arr = json_decode($values);
                                                                ?>
                                                                <?php if(!empty($arr)): ?>
                                                                    <select class="form-control"
                                                                            name="<?php echo e($label->column_name); ?>">
                                                                        <?php
                                                                            foreach($arr as $val)
                                                                            {
                                                                        ?>
                                                                        <option
                                                                            value="<?php echo e($val); ?>"><?php echo e(ucwords($val)); ?></option>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                <?php endif; ?>

                                                                <?php elseif($label->data_type == 'date'): ?>
                                                                <input type="date" name="<?php echo e($label->column_name); ?>"
                                                                       
                                                                       class="form-control" value="<?php echo e($lead[$label->column_name]); ?>"
                                                                       
                                                                       <?php if($label->required == 1): ?> required
                                                                       <?php endif; ?> placeholder="Enter <?php echo e($label->title); ?>"/>

                                                                <?php elseif($label->data_type == 'datetime-local'): ?>
                                                                <input type="datetime-local" name="<?php echo e($label->column_name); ?>"
                                                                       
                                                                       class="form-control" value="<?php echo e($lead[$label->column_name]); ?>"
                                                                       
                                                                       <?php if($label->required == 1): ?> required
                                                                       <?php endif; ?> placeholder="Enter <?php echo e($label->title); ?>"/>

                                                                <?php elseif($label->data_type == 'email'): ?>
                                                                <input type="email" name="<?php echo e($label->column_name); ?>"
                                                                       
                                                                       class="form-control" value="<?php echo e($lead[$label->column_name]); ?>"
                                                                       
                                                                       <?php if($label->required == 1): ?> required
                                                                       <?php endif; ?> placeholder="Enter <?php echo e($label->title); ?>"/>


                                                                <?php else: ?>
                                                                <input type="text" name="<?php echo e($label->column_name); ?>"
                                                                       <?php if($label->data_type == 'number' || $label->data_type == 'currency'): ?> oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" <?php endif; ?>
                                                                       value="<?php if(!empty($lead[$label->column_name])): ?> <?php echo e($lead[$label->column_name]); ?> <?php elseif($label->data_type == 'text'): ?> -  <?php endif; ?>"
                                                                       class="form-control <?php if($label->data_type == 'date'): ?> datepicker <?php endif; ?> <?php if($label->data_type == 'phone_number'): ?> phone_number <?php endif; ?> "
                                                                       <?php if($label->data_type == 'phone_number'): ?> onkeypress="return isNumberKey($(this));"
                                                                       <?php endif; ?> <?php if($label->required == 1): ?> required
                                                                       <?php endif; ?> placeholder="Enter <?php echo e($label->title); ?>"/>

                                                            <?php endif; ?>

                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                                
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="lead_status">Select Lead Status</label>
                                                <select class="form-control" name="lead_status" id="lead_status">
                                                    <?php if(!empty($lead_status)): ?>
                                                        <?php $__currentLoopData = $lead_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($status->lead_title_url); ?>" <?php if($lead['lead_status'] == $status->lead_title_url): ?> selected="selected" <?php endif; ?> ><?php echo e($status->title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="assigned_to">Assigned To</label>
                                                <select class="form-control" name="assigned_to" id="assigned_to">
                                                    <?php if(!empty($users)): ?>
                                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($user->id); ?>" <?php if($lead['assigned_to'] == $user->id): ?> selected="selected" <?php endif; ?> ><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="assigned_to">Lead Type</label>
                                                <select class="form-control" name="lead_type" id="lead_type">
                                                    <option value="">Select Lead Type</option>
                                                    <option <?php if($lead['lead_type'] == 'hot'): ?> selected="selected" <?php endif; ?> value="hot">Hot</option>
                                                    <option <?php if($lead['lead_type'] == 'warm'): ?> selected="selected" <?php endif; ?> value="warm">Warm</option>
                                                    <option <?php if($lead['lead_type'] == 'cold'): ?> selected="selected" <?php endif; ?> value="cold">Cold</option>

                                                </select>
                                            </div>
                                        </div>

                                         <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="lead_source">Select Lead Source</label>
                                                <select class="form-control" name="lead_source_id" id="lead_source_id">
                                                    <?php if(!empty($lead_source)): ?>
                                                        <?php $__currentLoopData = $lead_source; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($lead['lead_source_id'] == $source->unique_id): ?> selected="selected" <?php endif; ?>
                                                                value="<?php echo e($source->unique_id); ?>"><?php echo e($source->source_title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-body -->

                                <div class="modal-footer">
                                    <a href="/leads" type="button" class="btn btn btn-danger waves-effect waves-light"
                                       data-dismiss="modal"><i class="fa fa-reply"></i> Cancel</a>

                                    <a onclick="window.location.reload();" type="button"
                                       class="btn btn btn-warning waves-effect waves-light" data-dismiss="modal"><i
                                            class="fa fa-refresh" aria-hidden="true"></i> Reset</a>
                                    <button type="submit" name="submit"
                                            class="btn btn btn-primary waves-effect waves-light"><i
                                            class="fa fa-edit edit"></i> Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <style>
        #state-code {
            width: 100%;
        }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
    </style>
    <script src="<?php echo e(asset('asset/plugins/input-mask/jquery.inputmask.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/plugins/input-mask/jquery.inputmask.date.extensions.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/plugins/input-mask/jquery.inputmask.extensions.js')); ?>"></script>
    <script>

        $(document).ready(function () {
            $('#mobile').inputmask("(999) 999-9999");
        })

        function getExtension(min, max) {
            return Math.floor(Math.random() * (max - min)) + min;
        }

        function getIvrUserId(min, max) {
            return Math.floor(Math.random() * (max - min)) + min;
        }

        function getPassword() {
            var length = 10,
                charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
                retVal = "";
            for (var i = 0, n = charset.length; i < length; ++i) {
                retVal += charset.charAt(Math.floor(Math.random() * n));
            }
            return retVal;
        }

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }

    </script>

    <script src="<?php echo e(asset('asset/js/country-states.js')); ?>"></script>

    <script>

        (function () {
            //country code for selected option
            let user_country_code = $("#country").data('country');
            let user_state_code = $("#state-code").data('state');
            let country_list = country_and_states['country'];
            let states_list = country_and_states['states'];

            // country name drop down
            let option = '';
            option += '<option>Select Country</option>';
            for (let country_code in country_list) {
                // set selected option user country
                let selected = (country_code == user_country_code) ? ' selected' : '';
                option += '<option value="' + country_code + '"' + selected + '>' + country_list[country_code] + '</option>';
            }
            document.getElementById('country').innerHTML = option;

            // state name drop down
            let text_box = '<input type="text" class="form-control" class="input-text" id="state">';
            let state_code_append_id = document.getElementById("state-code");

            function create_states_dropdown() {
                let country_code = document.getElementById("country").value;
                let states = states_list[country_code];
                // invalid country code or no states add textbox
                if (!states) {
                    state_code_append_id.innerHTML = text_box;
                    return;
                }
                let option = '';
                if (states.length > 0) {
                    option = '<select class="form-control" name="state" id="state" style="width:100%">\n';
                    for (let i = 0; i < states.length; i++) {
                        let selected_state = (states[i].name == user_state_code) ? ' selected' : '';
                        option += '<option value="' + states[i].name + '"' + selected_state + '>' + states[i].name + '</option>';
                    }
                    option += '</select>';
                } else {
                    // create input textbox if no states
                    option = text_box
                }
                state_code_append_id.innerHTML = option;
            }

            // country change event
            const country_select = document.getElementById("country");
            country_select.addEventListener('change', create_states_dropdown);

            create_states_dropdown();
        })();
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/leads/edit.blade.php ENDPATH**/ ?>