
<?php $__env->startSection('title', 'View Lead Info'); ?>

<?php $__env->startSection('content'); ?>
<style>
            div.scrollable-table-wrapper
            {
                height: 500px;
                overflow: auto;

                thead tr th
                {
                    position: sticky;
                    top: 0;
                }
            }
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                   
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('/dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active">View Leads</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="card card-primary">
                    <div class="card-header" style="height: 40px;">
                    <h3 class="card-title" style="font-weight:bold;">
                        <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($label->column_name == 'first_name'): ?>
                                      <i class="fa fa-user-plus" aria-hidden="true"></i>  <?php echo e(ucfirst($lead[$label->column_name])); ?>

                                    <?php endif; ?>
                                    <?php if($label->column_name == 'last_name'): ?>
                                        &nbsp;<?php echo e(ucfirst($lead[$label->column_name])); ?>

                                    <?php endif; ?>

                                     <?php if($label->column_name == 'phone'): ?>

                                     <?php if(is_numeric($lead[$label->column_name])): ?>
                                        &nbsp; <i class="fa fa-phone"></i> <?php echo e(ucfirst($lead[$label->column_name])); ?>

                                    <?php endif; ?>
                                        
                                        

                                    <?php endif; ?>
                                  
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                               

                               </h3>


                    <div class="pull-right">

                                    <a title="Edit Lead" style="float: right!important;color:black;padding: 0px 0px;font-weight: bold;color:white" class="btn btn-sm" href="/leads/<?php echo e($lead_id); ?>/edit"><i class="fa fa-edit fa-lg"></i> </a>
                                </div>
                    </div>

                    <form class="form-horizontal">
                        <div class="card-body">
                            <div class="table-responsive">
                                 <table id="datatable" class="table table-striped table-bordered table-hover" style="width:100%">
                                    <tbody>
                                        <?php if(!empty($labels)): ?>
                                        <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($label->status == 1): ?>

                                        <?php if($label->column_name != 'lead_unique_url'): ?>

                                        <tr style="text-transform: capitalize;">
                                            <th style="">
                                                <?php echo e($label->title); ?>

                                            </th>
                                            <td > 
                                               <?php if($label->data_type == 'phone_number'): ?> 
                                                <?php
                                                if(is_numeric($label->column_name))
                                                $output = \App\Helper\Helper::phone_number($lead[$label->column_name]) ;
                                                else
                                                $output = '-';
                                                ?>
                                                <?php echo e($output); ?>

                                           


                                            <?php elseif($label->data_type == 'currency'): ?> 
                                            <?php echo e(number_format($lead[$label->column_name])); ?>


                                            <?php else: ?>
                                            <?php echo e($lead[$label->column_name]); ?>

                                            <?php endif; ?>


                                            </td>

                                        </tr>
                                        <?php endif; ?>


                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php
                                        $old_created = strtotime($lead['created_at']);
                                        $new_created = date('M-d-Y h:i:s A', $old_created);
                                        $old_modified = strtotime($lead['updated_at']);
                                        $new_modified = date('M-d-Y h:i:s A', $old_modified);
                                        $lead_type = $lead['lead_type'];
                                        if( $lead_type == 'hot')
                                        {
                                            $style ="background-color:#a90329!important;color:#fff;text-align:center;";
                                        }
                                        else if( $lead_type == 'warm')
                                        {
                                            $style ="background-color:#c79121!important;color:#fff;text-align:center;";
                                        } 
                                        else if( $lead_type == 'cold')
                                        {
                                            $style ="background-color:#12679b!important;color:#fff;text-align:center;";
                                        }
                                        else
                                        {
                                            $style="text-align:center;";
                                        } 
                                        ?>

                                        <tr>
                                            <th>
                                                Lead Status
                                            </th>
                                            <td >
                                                <select class="form-control" onchange="updateLeadStatus(this.value,<?php echo e($lead['id']); ?>,'<?php echo e($lead['lead_type']); ?>')"  name="lead_status" id="lead_status">
                                                    <?php if(!empty($lead_status)): ?>
                                                        <?php $__currentLoopData = $lead_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($status->lead_title_url); ?>" <?php if($lead['lead_status'] == $status->lead_title_url): ?> selected="selected" <?php endif; ?> ><?php echo e($status->title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>
                                                Lead Type
                                            </th>
                                            <td>
                                                <select class="form-control" name="lead_type" id="lead_type" onchange="updateLeadStatus('<?php echo e($lead['lead_status']); ?>',<?php echo e($lead['id']); ?>,this.value)">
                                                    <option value="">Select Lead Type</option>
                                                    <option <?php if($lead['lead_type'] == 'hot'): ?> selected="selected" <?php endif; ?> value="hot">Hot</option>
                                                    <option <?php if($lead['lead_type'] == 'warm'): ?> selected="selected" <?php endif; ?> value="warm">Warm</option>
                                                    <option <?php if($lead['lead_type'] == 'cold'): ?> selected="selected" <?php endif; ?> value="cold">Cold</option>

                                                </select></td>
                                        </tr>



                                        <tr>
                                            <th>
                                                Created At
                                            </th>
                                            <td > <?php echo e($new_created); ?> </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                Updated At
                                            </th>
                                            <td > <?php echo e($new_modified); ?> </td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-md-5">
                <div class="card card-primary">
                    <div class="card-header" style="height: 40px;">
                        <h3 class="card-title" style="font-weight:bold;"> <i class="fas fa-comments"></i> Notes</h3>
                    </div>

                    <form class="form-horizontal">
                        <div class="card-body">
                            <div class="form-group">
                                <textarea type="text" name="notes" class="form-control" id="notes" required placeholder="Notes" ></textarea>
                            </div>
                        <button type="button" class="btn btn-primary submitNotes" style="float:right;" >Save</button>
                        </div>

                        
                        <div class="card-body">
                            <div class="tab-content scrollable-table-wrapper">
                                <div class="tab-pane active" id="timeline">

                                    <div class="timeline timeline-inverse ">
                                        <?php if(!empty($notification)): ?>
                                        <?php $__currentLoopData = $notification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="time-label" style="margin-bottom: 5px !important;margin-right: 0px !important;">
                                            <span class="bg-danger">
                                                <?php
                                                    $old_date_timestamp = strtotime($message->created_at);
                                                    $new_date = date('d M. Y-h:i:s A', $old_date_timestamp);
                                                    $explode = explode('-',$new_date);
                                                    $date = $explode[0];
                                                    $time = $explode[1];
                                                ?>
                                                <?php echo e($date); ?>

                                                
                                            </span>
                                            <span class="time"><i class="far fa-clock"></i> <b><?php echo e($time); ?></b></span>
                                        </div>

                                        <div  style="margin-bottom: 5px !important;margin-right: 0px !important;">
                                            <i class="<?php if($message->type == '1'): ?> fas fa-comments bg-warning <?php elseif($message->type == '0'): ?> fas fa-refresh bg-warning <?php endif; ?>"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header"><a href="#">
                                                    <?php if($message->user_id != '0'): ?>
                                                    <?php if(!empty($users)): ?>
                                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($list->id == $message->user_id): ?>
                                                    <?php echo e($list->first_name); ?>

                                                    <?php echo e($list->last_name); ?> 
                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                    <?php else: ?>
                                                    
                                                    <?php endif; ?>

                                                </a><?php if($message->type == '1'): ?>  <?php echo $message->message; ?> <?php elseif($message->type == '0'): ?> <?php echo $message->message; ?> <?php endif; ?></h3>
                                               
                                               <!--  <span class="time"><i class="far fa-clock"></i> <b><?php echo e($time); ?></b></span> -->
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </form>
                </div>

                
           
               
            </div>

            <div class="col-md-2">
                <div class="card card-primary">
                    <div class="card-header" style="height: 40px;">
                    <h3 class="card-title" style="font-weight:bold;">Lead Summary</h3>
                    </div>

                    <form class="form-horizontal">
                        <div class="card-body">

                            <a style="cursor: pointer;"  data-email="<?php echo e($lead['email']); ?>" data-leadid="<?php echo e($lead['id']); ?>"  class="btn btn-primary btn-block btn-sm show_confirms "><i class="fa fa-envelope "></i> Lead Details</a>
                            <?php /* ?>
                            <a style="cursor: pointer;"  data-email="{{$lead['email']}}" data-leadid="{{$lead['id']}}"  class="btn btn-success btn-block btn-sm show_confirms "><i class="fa fa-commenting "></i> Comments</a>

                            <a style="cursor: pointer;"  data-email="{{$lead['email']}}" data-leadid="{{$lead['id']}}"  class="btn btn-danger btn-block btn-sm show_confirms "><i class="fa fa-refresh "></i> Updates</a>

                            <a style="cursor: pointer;"  data-email="{{$lead['email']}}" data-leadid="{{$lead['id']}}"  class="btn btn-warning btn-block btn-sm show_confirms "><i class="fa fa-tasks "></i> Activities</a>
                            <?php */ ?>
                            <a style="cursor: pointer;"  href="/document/<?php echo e($lead_id); ?>" class="btn btn-block btn-success btn-sm show_confirms "><i class="fa fa-file-word-o "></i> Documents</a>

                            <a style="cursor: pointer;"  data-email="<?php echo e($lead['email']); ?>" data-leadid="<?php echo e($lead['id']); ?>"  class="btn btn-danger btn-block btn-sm "><i class="fa fa-calendar "></i> Calender</a>

                        </div>
                    </form>
                </div>

                <div class="card card-primary">
                    <div class="card-header" style="height: 40px;">
                    <h3 class="card-title" style="font-weight:bold;">CRM Utilities</h3>
                    </div>

                    <form class="form-horizontal">
                        <div class="card-body">

                            <a style="cursor: pointer;font-size:13px;"  data-email="<?php echo e($lead['email']); ?>" data-leadid="<?php echo e($lead['id']); ?>"  class="btn btn-primary btn-block btn-sm btn_send_email "><i class="fa fa-envelope "></i> Send Email</a>

                            <a target="_blank" style="cursor: pointer;font-size:13px;" href="/generate-pdf/<?php echo e($lead['id']); ?>" class="btn btn-danger btn-block btn-sm  "><i class="fa fa-file-pdf-o "></i> Generate Application</a>

                            <a style="cursor: pointer;font-size:13px;"  data-email="<?php echo e($lead['email']); ?>" data-leadid="<?php echo e($lead['id']); ?>"  class="btn btn-warning btn-block btn-sm show_confirms "><i class="fas fa-sms "></i> Send Text</a>

                            <a style="cursor: pointer;font-size:13px;"  data-email="<?php echo e($lead['email']); ?>" data-leadid="<?php echo e($lead['id']); ?>"  class="btn btn-danger btn-block btn-sm show_confirms "><i class="fa fa-phone "></i> Call Lead</a>

                            <a style="cursor: pointer;font-size:13px;"   class="btn btn-info btn-block btn-sm show_confirms "><i class="fa-solid fa-file-invoice"></i> Generate Invoice</a>

                            
                           
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </section>
    <?php echo $__env->make("send-email-popup.email-popup", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<script>
    var sel = $("#lead_status").val();
    var type = $("#lead_type").val();

    function updateLeadStatus(lead_status,lead_id,lead_type)
    {
        var result = confirm("Want to Change?");
        if (result)
        {
            $("#loading").show();
        $.ajaxSetup({
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }});

        jQuery.ajax({
            url: "<?php echo e(url('/update/lead-status')); ?>",
            method: 'post',
            data:
            {
                lead_id: lead_id,lead_status:lead_status,lead_type:lead_type
            },
            success: function(result)
            {
        $("#loading").hide();

                swal("Success!", "Lead Status Changed", "success")
                window.location.reload(1);
            }});
        }
        else
        {
            $("#lead_status").val(sel);
            $("#lead_type").val(type);

        }
    }
    
    $(document).on("click", ".submitNotes", function ()
    {
        var flag = 1;
        var notes = $("#notes").val();
        

        if (notes == '')
        {
            $("#alert-errors").html("Please enter some note");
            $("#alert-errors").show();
            $("#mail_driver").focus();
            flag = 0;
            return false;
        }
        

        if(flag == 1)
        {
            $("#loading").show();
        }


        $("#smtpResponce").show();
        var el = this;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/notification/add',
            data:
            {
                message: notes,
                type: 1,
                lead_id: <?php echo e($lead_id); ?>

            },

            type: 'get',
            dataType:"json",
            success: function (response)
            {
                if (response =='1')
                {
                    $('#loading').hide();
                    $(".checkSetting").attr("disabled", "disabled"); 
                    swal("Success!", "Notes Added Successfully", "success")
                    setTimeout(function()
                    {
                        window.location.reload(1);
                    }, 2000);
                }
                else
                {
                    $('#loading').hide();
                    swal("Warning!", "Something Went Wrong", "warning")

                }
        }
        });
    });
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/leads/view.blade.php ENDPATH**/ ?>