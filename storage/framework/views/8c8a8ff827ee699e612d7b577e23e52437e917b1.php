<?php $__env->startSection('title', 'Edit Email Template Details'); ?>

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
                        <li class="breadcrumb-item active">Email Template</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php echo $__env->make("layouts.messaging", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                            <h3 class="card-title"><i class="fa fa-server" aria-hidden="true"></i> <b>Add Email Template Info</b></h3> 
                            <a style="float:right;text-decoration:none" href="<?php echo e(url('/email-templates')); ?>" class="btn-danger btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Add"><i class="fa fa-eye"></i> Show Email Templates</a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" name="userform" id="userform" action="">
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Templete Name <span style="color: red;">*</span></label>
                                            <input type="text" name="template_name" value="<?php echo e(old('template_name', $email_template['template_name'])); ?>" class="form-control" id="template_name" required placeholder="Enter Template Name" />
                                        </div>
                                    </div>

                                     <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Lead Placeholders</label>
                                            <span id="setBoxValue" style="display:none;"></span>

                                            <select id="multiple_labels" class="form-control" autocomplete="off" >
                                                <option value="">Select to Insert</option>
                                                <?php $__currentLoopData = $label_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="[[<?php echo e($list->label_title_url); ?>]]"><?php echo e($list->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>;
                                            </select>
                                        </div>
                                    </div>

                                   <div class="col-md-2">
                                        <label>Sender Placeholders </label>
                                            <select id="multiple_names" class="form-control" autocomplete="off" >
                                                <option value="">Select to Insert</option>
                                                <?php $__currentLoopData = $user_column; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="[[<?php echo e($user_list); ?>]]"><?php echo e($user_list); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>;
                                            </select>
                                    </div>



                                    <div class="col-md-2">
                                        <label>Lead Status </label>
                                            <select id="lead_status" class="form-control" autocomplete="off" name="lead_status" >
                                                <option value="">Select to Insert</option>
                                                <?php $__currentLoopData = $lead_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if($email_template['lead_status'] == $list->lead_title_url ): ?> selected <?php endif; ?> value="<?php echo e($list->lead_title_url); ?>"><?php echo e($list->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>;
                                            </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label>Send Bcc </label>
                                            <select id="send_bcc" class="form-control" autocomplete="off" name="send_bcc" >
                                                <option <?php if($email_template['send_bcc'] == '1' ): ?> selected <?php endif; ?> value="1">Yes</option>
                                                <option <?php if($email_template['send_bcc'] == '0' ): ?> selected <?php endif; ?> value="0">No</option>

                                            </select>
                                    </div>

                                     

                                    <div class="col-md-9">
                                        <label>Subject </label>
                                            <input type="text" class="form-control" value="<?php echo e(old('subject', $email_template['subject'])); ?>" name="subject" id="subject_box" />
                                    </div>

                                    <div class="col-md-12">
                                        <label style="line-height:50px;">Templete Preview </label>
                                            <textarea type="text" class="form-control" name="template_html" value="" id="editor1" ><?php echo e($email_template['template_html']); ?></textarea>
                                    </div>


                                </div>


                            </div>
                            <div style="clear: both"></div>
                            <div class="modal-footer">
                                 <a href="/email_templates" type="button" class="btn btn btn-danger waves-effect waves-light" data-dismiss="modal"><i class="fa fa-reply"></i> Cancel</a>

                                <a onclick="window.location.reload();" type="button" class="btn btn btn-warning waves-effect waves-light" data-dismiss="modal"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</a>
                                <button type="submit" name="submit" value="add" class="btn btn btn-primary waves-effect waves-light"><i class="fa fa-edit edit"></i> Update</button>
                            </div>
                        </div><!-- /.box-body -->
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

<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<?php /*?><script src="{{ asset("asset/plugins/ckeditor/ckeditor.js") }}"></script> <?php */ ?>
<script language="javascript">
$(function () {
    CKEDITOR.config.autoParagraph = false;
    CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
    CKEDITOR.config.shiftEnterMode = CKEDITOR.ENTER_P;
    CKEDITOR.replace('editor1', {
        enterMode: CKEDITOR.ENTER_BR,
        filebrowserUploadUrl: "<?php echo e(route('start-dialing.upload', ['_token' => csrf_token() ])); ?>",
        filebrowserUploadMethod: 'form'
    });

    $("#multiple_labels").on('change', function () {
        console.log($(this).val());
        var hidden_box = $('#setBoxValue').html();
        if (hidden_box == 'subject_box') {

            var cursorPos = $('#subject_box').prop('selectionStart');
            var v = $('#subject_box').val();
            var textBefore = v.substring(0, cursorPos);
            var textAfter = v.substring(cursorPos, v.length);
            $('#subject_box').val(textBefore + $(this).val() + textAfter);
        } else {
            for (var i in CKEDITOR.instances) {
                CKEDITOR.instances[i].insertHtml($(this).val());
            }
        }
    });

    $("#multiple_names").on('change', function () {
        console.log($(this).val());
        var hidden_box = $('#setBoxValue').html();
        if (hidden_box == 'subject_box') {

            var cursorPos = $('#subject_box').prop('selectionStart');
            var v = $('#subject_box').val();
            var textBefore = v.substring(0, cursorPos);
            var textAfter = v.substring(cursorPos, v.length);
            $('#subject_box').val(textBefore + $(this).val() + textAfter);
        } else {

        for (var i in CKEDITOR.instances) {
            CKEDITOR.instances[i].insertHtml($(this).val());
        }
    }
    });

    $("#multiple_custom_names").on('change', function () {
        console.log($(this).val());
        var hidden_box = $('#setBoxValue').html();
        if (hidden_box == 'subject_box') {

            var cursorPos = $('#subject_box').prop('selectionStart');
            var v = $('#subject_box').val();
            var textBefore = v.substring(0, cursorPos);
            var textAfter = v.substring(cursorPos, v.length);
            $('#subject_box').val(textBefore + $(this).val() + textAfter);
        } else {

        for (var i in CKEDITOR.instances) {
            CKEDITOR.instances[i].insertHtml($(this).val());
        }

    }
    });

    CKEDITOR.instances['editor1'].on('contentDom', function () {
        this.document.on('click', function (event) {
            $('#setBoxValue').html('');
        });
    });
});

$('#subject_box').on('click', function () {
    $('#setBoxValue').html('subject_box');
});


</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/email-templates/edit.blade.php ENDPATH**/ ?>