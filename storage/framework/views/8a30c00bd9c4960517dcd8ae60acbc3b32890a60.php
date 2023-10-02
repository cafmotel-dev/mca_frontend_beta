<link rel="stylesheet" href="https://www.jquery-az.com/boots/css/bootstrap-multiselect/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="https://www.jquery-az.com/boots/js/bootstrap-multiselect/bootstrap-multiselect.js"></script>

<style>
    .multiselect-container
    {
        width: 100%;
    }
</style>


<?php
    if (!empty(request()->input('start_date')))
    {
        $startDate = request()->input('start_date');
    }
    else
    {
        $current_date = date("Y-m-d"); 
        $str_date = strtotime(date("Y-m-d", strtotime($current_date)) . " -15 day");
        $startDate = date('Y-m-d', $str_date);
    }

    if (!empty(request()->input('end_date')))
    {
        $endDate = request()->input('end_date');
    }
    else
    {
        $endDate = date('Y-m-d');
    }

    $url_page = explode('?',str_replace('/','',$_SERVER['REQUEST_URI']));
    $url = $url_page[0];
?>

<div class="col-12">
    <div class="card card-primary">
       

        

        

            <div class="col-12">
                <form method="post" id="form">
                    <?php echo csrf_field(); ?>

                <?php /*?>    <div class="input-group input-group-lg mb-3" style="height:20px;">
            <input type="" readonly value="" class="form-control" >
            <div class="input-group-prepend">
                <a   type="button" class="btn btn btn-danger btn-sm" data-toggle="collapse" data-target="#demo"><i class="fa fa-search fa-lg" aria-hidden="true"></i></a> 
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action </button>
                <ul class="dropdown-menu" style="">
                    <li class="dropdown-item"><a class="new_prospect" id="new_prospect" href="{{url('/leads')}}/add"><i class="fa fa-plus"></i> New Lead</a></li>
                    @if(Session::get("userLevel") > 1)
                    <li class="dropdown-item"><a id="importLeadCSV" class="importLeadCSV" href="javascript:void(0)"><i class="fa fa-user"></i>  Import Leads</a></li>
                    <li class="dropdown-item">
                        <button style="color: #007bff;text-decoration: none;    border: yellowgreen;background-color: transparent;cursor: pointer;font-weight: 400;text-align: inherit;white-space: nowrap;"  type="submit" name="submit_download"  value="excel" ><i class="fa fa-file-text o"></i> Export Leads
                        </button>
                    </li> 
                    @endif
                </ul>
            </div>
        </div>

        <?php */ ?>
        <div class="modal-footer">
            <a   type="button" class="btn btn btn-warning waves-effect waves-light reset" data-toggle="collapse" data-target="#demo"><i class="fa fa-search fa-lg" aria-hidden="true"></i> Search</a> 

            <div class="input-group-prepend">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action
                </button>

                <div class="dropdown-menu">
                <a class="dropdown-item" id="new_prospect" href="<?php echo e(url('/leads')); ?>/add"><i class="fa fa-plus"></i> New Lead</a>

                <?php if(Session::get("userLevel") > 5): ?>
                <a id="importLeadCSV" class="dropdown-item importLeadCSV" href="javascript:void(0)"><i class="fa fa-user"></i>  Import Leads</a>

                <button class="dropdown-item"  type="submit" name="submit_download"  value="excel" ><i class="fa fa-file-text o"></i> Export Leads
                </button>
                <?php endif; ?>
                      
                    </div>
                  </div>
                    </div>

       

                    <div id="demo" class="collapse <?php if(!empty(request()->input('lead_status')) || !empty(request()->input('crm_id')) || !empty(request()->input('assigned_to')) || !empty(request()->input('first_name')) || !empty(request()->input('last_name')) || !empty(request()->input('email')) || !empty(request()->input('legal_company_name')) || !empty(request()->input('lead_type')) || !empty(request()->input('start_date')) || !empty(request()->input('end_date'))): ?> show <?php endif; ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="lead_status">From</label>
                                    <input class="form-control datepicker" value="<?php echo e(request()->input('start_date')); ?>" name="start_date" id="start_date" placeholder="From">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                        <label for="lead_status">To</label>
                                        <input class="form-control datepicker" value="<?php echo e(request()->input('end_date')); ?>" name="end_date" id="end_date" placeholder="To">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="lead_status">CRM Id</label>
                                    <input class="form-control" value="<?php echo e(request()->input('crm_id')); ?>" name="crm_id" id="crm_id" placeholder="CRM Id">   
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="lead_status">First Name</label>
                                    <input class="form-control" value="<?php echo e(request()->input('first_name')); ?>" name="first_name" id="first_name" placeholder="First Name">   
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="lead_status">Last Name</label>
                                    <input class="form-control" value="<?php echo e(request()->input('last_name')); ?>" name="last_name" id="last_name" placeholder="Last Name">          
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="lead_status">Phone Number</label>
                                    <input class="form-control" value="<?php echo e(request()->input('phone_number')); ?>" name="phone_number" id="phone_number" placeholder="Phone Number">          
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="lead_status">Email</label>
                                    <input class="form-control" value="<?php echo e(request()->input('email')); ?>" name="email" id="email" placeholder="Email">          
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="lead_status">Company Name</label>
                                    <input class="form-control" value="<?php echo e(request()->input('legal_company_name')); ?>" name="legal_company_name" id="legal_company_name" placeholder="Company Name">   
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="lead_status">Lead Status</label>
                                    <br>
                                    <select  name="lead_status[]" id="lead_status" multiple="multiple">
                                        <?php if(!empty($lead_status)): ?>
                                        <?php $__currentLoopData = $lead_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if(empty(request()->input('lead_status'))): ?> <?php elseif(in_array($status->lead_title_url, request()->input('lead_status'))): ?> selected <?php endif; ?> 
                                            value="<?php echo e($status->lead_title_url); ?>"><?php echo e($status->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <?php if(Session::get('userLevel') > 1): ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="assigned_to">Assigned To</label>
                                    <select class="form-control" name="assigned_to[]" id="assigned_to"  multiple="multiple">
                                        <?php if(Session::get("userLevel") > 5): ?>
                                        <?php if(!empty($users)): ?>
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(empty(request()->input('assigned_to'))): ?> <?php elseif(in_array($list->id, request()->input('assigned_to'))): ?> selected <?php endif; ?>  
                                                    value="<?php echo e($list->id); ?>"><?php echo e($list->first_name); ?> <?php echo e($list->last_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <option value="<?php echo e(Session::get("userId")); ?>"><?php echo e(Session::get("first_name")); ?> <?php echo e(Session::get("last_name")); ?></option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="assigned_to">Lead Type</label>
                                    <select class="form-control" name="lead_type[]" id="lead_type" multiple="multiple">
                                        <option <?php if(empty(request()->input('lead_type'))): ?> <?php elseif(in_array('hot', request()->input('lead_type'))): ?> selected <?php endif; ?>  value="hot">Hot</option>
                                        <option <?php if(empty(request()->input('lead_type'))): ?> <?php elseif(in_array('warm', request()->input('lead_type'))): ?> selected <?php endif; ?>   value="warm">Warm</option>
                                        <option <?php if(empty(request()->input('lead_type'))): ?> <?php elseif(in_array('cold', request()->input('lead_type'))): ?> selected <?php endif; ?>   value="cold">Cold</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="<?php echo e($url); ?>" class="btn btn btn-warning waves-effect waves-light reset" data-dismiss="modal"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</a>
                        <button type="submit" name="submit" class="btn btn btn-primary waves-effect waves-light"><i class="fa fa-edit edit" aria-hidden="true"></i> Submit</button>
                        <button type="submit" name="submit_download" class="btn btn-success waves-effect waves-light m-l-10" value="excel"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</button>
                    </div>

                     </div>
                </form>
                <hr style="background: #007bff;">
            </div>
       


        <?php
        if (!empty($leads))
        {
            if ($lower_limit == '0')
            {
                $lower_limit = 0;
            }

            if ($lower_limit > 0)
            {
                $lower_limit = $lower_limit - 10;
            }

            if($page == 1)
            {
                $currentPage = 1;
            }

            else
            {
                $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            }

            $perPage = 50;
            $paginator = new Illuminate\Pagination\LengthAwarePaginator($leads, $record_count, $perPage, $currentPage, ['path' => url($url)]);
        ?>

        <div class="card-body">

            <?php if(empty($view_on_leads)): ?>

            <div class="alert alert-warning alert-dismissible" id="show_10_sec">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-info"></i> Alert!</h5>
                  TO view Lead Columns please Click on  <a target="_blank" href="labels" style="text-decoration: none;" class="btn btn-success">Label</a> Menu and Click on  <i  class="fa fa-eye fa-lg"></i> button to Enable or Disable Lead Columns. You can select up to 12 Labels.
            </div>
            <?php endif; ?>

            <?php if(!empty($view_on_leads)): ?>
            <b>Total Rows :<?= $record_count ?></b>
            <table id="example2" class="table-responsive table table-striped table-bordered table-hover">
                <thead>
                    <tr style="text-align: center;">
                        
                        <th>CRM ID</th>
                        <?php $__currentLoopData = $view_on_leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th><?php echo e($view->title); ?></th>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                        <th>Status</th>
                        <th>Created</th>
                        <th>Modified</th>
                        <th>Assigned To</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $k = $lower_limit;
                    foreach ($paginator->items() as $key => $lead)
                    {

                        ?>
                        <tr>
                            <?php
                            if( $lead->lead_type == 'hot')
                            {
                                $style ="background-color:#a90329!important;color:#fff;text-align:center;";
                            }
                            else if( $lead->lead_type == 'warm')
                            {
                                $style ="background-color:#c79121!important;color:#fff;text-align:center;";
                            } 
                            else if( $lead->lead_type == 'cold')
                            {
                                $style ="background-color:#12679b!important;color:#fff;text-align:center;";
                            }
                            else
                            {
                                $style="text-align:center;";
                            } 

                            
                        ?>

                        <td style="<?php echo e($style); ?>"><?php echo e($lead->id); ?></td>
                        <?php if(!empty($view_on_leads)): ?>
                            <?php $__currentLoopData = $view_on_leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $property_name = $view->column_name;
                                if($view->column_name == 'currency')
                                $value = number_format($lead->$property_name);

                                elseif($view->column_name == 'phone')
                                if(is_numeric($lead->$property_name))
                                $value = \App\Helper\Helper::phone_number($lead->$property_name) ;
                                else
                                $value='-';
                                else
                                $value = $lead->$property_name;
                            ?>
                        <td>

                            <?php if(!empty($value)): ?> <?php echo e($value); ?> <?php else: ?> - <?php endif; ?>
                        </td> 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        
                        <td><?php if(isset($lead_status[$lead->lead_status])): ?><span class="right badge" style="background:<?php echo e($lead_status[$lead->lead_status]->color_code); ?>;color:#fff"> <?php echo e($lead_status[$lead->lead_status]->title); ?> </span> <?php else: ?> - <?php endif; ?></td>
                        <td><?php echo e(\App\Helper\Helper::changeDateFormate($lead->created_at,'M-d-Y h:i:s A')); ?></td>
                        <td><?php echo e(\App\Helper\Helper::changeDateFormate($lead->updated_at,'M-d-Y h:i:s A')); ?></td>

                        <td><?php echo e($users[$lead->assigned_to]->first_name); ?> <?php echo e($users[$lead->assigned_to]->last_name); ?></td>
                        <td>
                            <ul class="list-inline m-0">
                                <li class="list-inline-item">
                                    <a href="/leads/<?php echo e($lead->id); ?>/edit" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
                                </li>

                                <li class="list-inline-item">
                                    <a style="color:red;" type="submit" class="show_confirm" data-toggle="tooltip" data-id="<?php echo e($lead->id); ?>" title='Delete'><i class="fa fa-trash fa-lg"></i></a>
                                </li>

                                <li class="list-inline-item">
                                    <a style="cursor: pointer;"  class="show_confirms btn_send_email" data-toggle="tooltip" data-leadid="<?php echo e($lead->id); ?>" data-email="<?php echo e($lead->email); ?>"
                                        title='Send Mail'><i class="fa fa-envelope fa-lg" aria-hidden="true"></i></a>
                                </li>

                                <li class="list-inline-item">
                                    <a style="cursor: pointer;" href="/lead/view?id=<?php echo e($lead->id); ?>"  class="show_confirms" title='Send Mail'><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>

                <?php echo e($paginator->appends(Request::all())->links()); ?>


                <div>Showing <?php echo e(($paginator->currentpage()-1)*$paginator->perpage()+1); ?> to <?php echo e($paginator->currentpage()*$paginator->perpage()); ?> of  <?php echo e($paginator->total()); ?> entries </div>
            </table>
            <?php endif; ?>
        </div>
    <?php }
    else
    {?>
        <table id="example2" class="table table-striped table-bordered table-hover">
            <tr>
                <td colspan="2">No Data Available</td>
            </tr>
        </table>
        <?php
    }?>

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-upload" aria-hidden="true"></i> Upload Leads </h3>
                </div>
                <div class="modal-body">
                    <form id="addLeads" action="<?php echo e(url('/leads')); ?>/import" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" required class="form-control"  name="list_title" placeholder="Title">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Upload File</label>
                                <input type="file" required class="form-control"  name="list_file" placeholder="Title">
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> Upload
                            </button>

                            <a type="button" class="btn btn btn-warning waves-effect waves-light"
                               data-dismiss="modal"><i class="fa fa-reply fa-lg" aria-hidden="true"></i> Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make("send-email-popup.email-popup", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/javascript">
    $('#importLeadCSV').click(function ()
    {
        $('#ajaxModel').modal('show');
    });

    $('.show_confirm').click(function (event)
    {
        event.preventDefault();
        // var form = $(this).closest("form");
        var name = $(this).data("name");
        swal({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            }).then((willDelete) =>
            {
                if (willDelete)
                {
                    // form.submit();
                    $('#loading').show();
                    var leadId = $(this).data('id');
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        data: {"_token": "<?php echo e(csrf_token()); ?>"},
                        url: '/leads/' + leadId + '/delete',
                        success: function (data)
                        {
                            if (data.status == true)
                            {
                                $('#loading').hide();
                                console.log(data.status);
                                window.location.reload(1);
                            }
                            else
                            {}
                        }
                    });
                }
            });
        });

    $(document).ready(function()
    {
        $("#show_10_sec").delay(10000).hide(0);
        $('#lead_status,#assigned_to,#lead_type').multiselect({
            includeSelectAllOption: true,
            buttonWidth: 285,
        });
    });

    $(".reset").click(function()
    {
        $("#form").trigger('reset');
    });

    $(document).ready(function()
    {
        $('#addLeads').submit(function()
        {
            $('#loading').show();
            $('#ajaxModel').hide();
        });
    })


    $(function ()
    {
        $("#datatable").on("change", ".toggle-class", function ()
        {
            $('#loading').show();
            var status = $(this).prop('checked') == true ? 1 : 0;
            var user_id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/changeUserStatus/' + user_id + '/' + status,
                success: function (data)
                {
                    if (data.status == 'true')
                    {
                        $('#loading').show();
                        console.log(data.success);
                        window.location.reload(1);
                    }
                    else
                    {}
                }
            });
        })
    })
</script><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/leads/leads_datatable.blade.php ENDPATH**/ ?>