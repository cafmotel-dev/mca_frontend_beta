<?php $__env->startSection('title', 'Label List'); ?>

<?php $__env->startSection('content'); ?>


    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/dashboard')); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Labels</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make("layouts.messaging", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><b><i class="fa-solid fa-tags"></i> Label List</b></h3>
                            </div>

                            <div class="card-body">
                                <table id="datatable" class="table table-striped table-bordered table-hover" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                       <!--  <th>Slug</th> -->
                                        <th>Required</th>
                                        <th>Edit Mode</th>

                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php if(!empty($labels)): ?>
                                        <?php
                                        $title_order = $labels;
                                        function compareByTitle($a, $b)
                                        { 
                                            return strcmp($a->title, $b->title);
                                        }

                                        usort($title_order, 'compareByTitle');
                                        ?>
                                        <?php $__currentLoopData = $title_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key+1); ?></td>
                                                <td><?php echo e($list->title); ?></td>
                                                <!-- <td><?php echo e($list->label_title_url); ?></td> -->
                                                <td><?php if($list->required == 1): ?>
                                                        <span class="badge badge-success">Yes</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger">No</span>
                                                    <?php endif; ?>
                                                </td>

                                                <td><?php if($list->edit_mode == 0): ?>
                                                        <span class="badge badge-info">System</span>
                                                    <?php endif; ?>

                                                    <?php if($list->edit_mode == 1): ?>
                                                        <span class="badge badge-success">System & Merchant</span>
                                                    <?php endif; ?>
                                                </td>



                                                <td><?php if($list->status == 1): ?>
                                                        <span class="badge badge-success">Active</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger">Inactive</span>
                                                    <?php endif; ?>
                                                </td>

                                                <td>
                                                    <ul class="list-inline m-0">
                                                        <li class="list-inline-item">
                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                               data-id="<?php echo e($list->id); ?>" data-title="<?php echo e($list->title); ?>" data-datatype="<?php echo e($list->data_type); ?>" data-required="<?php echo e($list->required); ?>" data-merchantrequired="<?php echo e($list->merchant_required); ?>" data-editmode="<?php echo e($list->edit_mode); ?>" data-values="<?php echo e($list->values); ?>"
                                                               data-original-title="Edit" class="edit"><i style="font-weight: bold;"
                                                                    class="fa fa-edit edit fa-lg"></i></a>
                                                        </li>
                                                        
                                                        <li class="list-inline-item">
                                                          <form method="POST" action="<?php echo e(route('label.delete', $list->id)); ?>">
                                                            <?php echo csrf_field(); ?>
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <a style="color:red;" type="submit" class="show_confirm" data-toggle="tooltip" title='Delete'><i style="font-weight: bold;" class="fa fa-trash fa-lg"></i></a>
                                                        </form>
                                                        </li> 

                                                        <li class="list-inline-item">
                                                            <label class="switch"><input data-id="<?php echo e($list->id); ?>"
                                                                                         class="toggle-class"
                                                                                         type="checkbox"
                                                                                         data-onstyle="success"
                                                                                         data-offstyle="danger"
                                                                                         data-toggle="toggle"
                                                                                         data-on="Active"
                                                                                         data-off="InActive" <?php echo e($list->status ? 'checked' : ''); ?>><span
                                                                    class="slider_button round"></span>
                                                            </label>
                                                        </li>

                                                        <li class="list-inline-item">
                                                            <a title="View On Lead" href="javascript:void(0)" data-toggle="tooltip"
                                                               data-id="<?php echo e($list->id); ?>" data-view="<?php echo e($list->view_on_lead); ?>" 
                                                               data-original-title="Edit" class="view">
                                                               <?php if($list->view_on_lead == 1): ?>
                                                               <i style="color: green;
    font-weight: bold;"  class="fa fa-eye fa-lg"></i>
                                                               <?php else: ?>
                                                               <i style="opacity: 0.6;cursor: pointer;color: red;
    font-weight: bold;" class="fa fa-eye-slash fa-lg"></i>

                                                               <?php endif; ?>  </a>
                                                        </li>


                                                    </ul>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card card-primary collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Add label</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus fa-lg"></i></button>
                                </div>
                            </div>

                            <div class="card-body" style="display: none;">
                                <form method="post" id="addLabel">
                                    <?php echo csrf_field(); ?>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" required class="form-control" name="title" placeholder="Title">
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Data Type</label>
                                                <select class="form-control data_type" name="data_type" required>
                                                    <option value="select_option">Select Option</option>
                                                    <option value="currency">Currency</option>
                                                    <option value="date">Date</option>
                                                    <option value="datetime-local">Datetime</option>
                                                    <option value="email">Email</option>
                                                    <option value="number">Number</option>
                                                    <option value="phone_number">Phone number</option>
                                                    <option selected value="text">Text</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Edit Mode</label>
                                                <select class="form-control" name="edit_mode" id="edit_mode_add">
                                                    <option value="0">System</option>
                                                    <option value="1">System & Merchant</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div id="select_choices_container">
                                            <span>
                                                <i>Input comma-separated values</i>
                                            </span>
                                            <textarea class="form-control" id="select_choices" placeholder="Write your selection choices..."
                                                  name="select_choices"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Editable By Agent</label>
                                                <select class="form-control" name="required">
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6" style="display: none;" id="merchant_add">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Editable By Merchant</label>
                                                <select class="form-control" name="merchant_required">
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit
                                        </button>
                                        <a onclick="window.location.reload();" type="button"
                                        class="btn btn btn-warning waves-effect waves-light" data-dismiss="modal"><i
                                        class="fa-solid fa-arrows-rotate"></i> Reset</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                   

                
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-eye fa-lg" aria-hidden="true"></i>  Display Order (Drag & Drop) </h3>
                            </div>

                            <table class="table table-bordered">
                                <tr>
                                    <th>Title</th>
                                </tr>

                                <tbody class="row_position">
                                    <?php if(!empty($labels)): ?>
                                    <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr id="<?php echo $list->id; ?>">
                                        <td style="cursor: pointer;"><?php echo $list->title ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="ajaxModel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-edit" aria-hidden="true"></i> Edit Label </h3>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?php echo e(route('label.update')); ?>" id="updateLabel">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="label_id" id="label_id">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" required class="form-control" id="title" name="title"
                                           placeholder="Title">
                                </div>

                                <div class="row">
                                        <div class="col-6">

                                <div class="form-group">
                                        <label for="exampleInputEmail1">Data Type</label>
                                        <select class="form-control" name="data_type" id="data_type">
                                            <option value="currency">Currency</option>
                                            <option value="date">Date</option>
                                            <option value="datetime-local">Datetime</option>
                                            <option value="email">Email</option>
                                            <option value="number">Number</option>
                                            <option value="phone_number">Phone number</option>
                                            <option value="text">Text</option>
                                        </select>

                                    </div>
                                </div>
                                  <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Edit Mode</label>
                                                <select class="form-control" name="edit_mode" id="edit_mode_edit">
                                                    <<option value="0">System</option>
                                                    <<option value="1">System & Merchant</option>


                                                </select>
                                            </div>
                                        </div>
                            </div>
                                    <div class="form-group">
                                        <div id="select_choices_container_edit">
                                            <span>
                                                <i>Input comma-separated values</i>
                                            </span>
                                            <textarea class="form-control" id="select_choices_edit" placeholder="Write your selection choices..."
                                                  name="select_choices"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Editable By Agent</label>
                                                <select class="form-control" name="required" id="required">
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>

                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6" id="merchant_show" style="display: none;">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Editable By Merchant</label>
                                                <select class="form-control" name="merchant_required" id="merchant_required">
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>

                                                    
                                                </select>
                                            </div>
                                        </div>


                                     
                                    </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"
                                                                                 aria-hidden="true"></i> Update
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
    </div>

    <style>
        #select_choices{
            width: 100%;
        }
        #select_choices_container,#select_choices_container_edit span{
            font-size: 12px;
        }
    </style>


    
    <script type="text/javascript">

        $("#edit_mode_edit").change(function(){
                $("#merchant_show").hide();

            var mode = $("#edit_mode_edit").val();
            if(mode == 1)
            {
                $("#merchant_show").show();
            }
            else
            {
                $("#merchant_show").hide();
            }

        });

        $("#edit_mode_add").change(function(){
                $("#merchant_add").hide();

            var mode = $("#edit_mode_add").val();
            if(mode == 1)
            {
                $("#merchant_add").show();
            }
            else
            {
                $("#merchant_add").hide();
            }

        });


        $(".row_position").sortable({
            delay: 150,
            stop: function() {
                var selectedData = new Array();
                $('.row_position>tr').each(function() {
                    selectedData.push($(this).attr("id"));
                });
                updateOrder(selectedData);
            }
        });
        function updateOrder(data) {

            $.ajaxSetup({
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }});
            $.ajax({
                url: "<?php echo e(url('/update/displayorder')); ?>",
                type:'post',
                data:{display_order:data},
                success:function(data){
                   toastr.success('Display Order is changed Successfully.');
                }
            })
        }
    </script>

     <script>
    $(document).ready(function ()
    {
      $('#datatable').DataTable();
    });
  </script>
    <script type="text/javascript">
        $('.show_confirm').click(function (event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();

            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        $('#loading').show();
                    }
                }
            );
        });

        $('.edit').click(function () {
            var id = $(this).data('id');
            var title = $(this).data('title');
            var data_type = $(this).data('datatype');
            var required = $(this).data('required');
            var merchant_required = $(this).data('merchantrequired');

            var edit_mode = $(this).data('editmode');
            if(edit_mode == 1)
            {
                $("#merchant_show").show();

            }
            var values = $(this).data('values');



            $('#ajaxModel').modal('show');
            $('#label_id').val(id);
            $('#title').val(title);
            $('#data_type').val(data_type);
            if(data_type == 'select_option')
            {
                $('#data_type').val(data_type);
                $("#select_choices_container_edit").show();
                $('#select_choices_edit').val(values);
            }
            else
            {
                $("#select_choices_container_edit").hide();
                $('#select_choices_edit').val("");
            }
            $('#required').val(required);
            $('#merchant_required').val(merchant_required);

            $('#edit_mode_edit').val(edit_mode);



        });

        $(function () {
            $("#datatable").on("change", ".toggle-class", function () {
                $('#loading').show();
                var status = $(this).prop('checked') == true ? 1 : 0;
                var label_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeLabelStatus/' + label_id + '/' + status,
                    success: function (data) {
                        if (data.status == 'true') {
                            $('#loading').show();
                            console.log(data.success);
                            window.location.reload(1);
                        } else {

                        }

                    }
                });
            })

             $("#datatable").on("click", ".view", function () {
                // $('#loading').show();
                var view_on_lead = $(this).data('view');
                if(view_on_lead == 1)
                    view_on_lead=0;
                else
                    view_on_lead=1;
                var label_id = $(this).data('id');

              

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeViewOnLead/' + label_id + '/' + view_on_lead,
                    success: function (data) {
                        if (data.status == 'true') {
                            $('#loading').show();
                            console.log(data.success);
                            window.location.reload(1);
                        } else {

                             $('#loading').show();
                            console.log(data.success);
                            window.location.reload(1);

                        }

                    }
                });
            })
        })

        $(document).ready(function () {
            $('#addLabel,#updateLabel').submit(function () {
                $("#ajaxModel").hide();
                $('#loading').show();
            });

            $("#select_choices_container").hide();
            $("#select_choices_container_edit").hide();


            $( ".data_type" ).change(function() {
                var val = $(".data_type").val();
                if(val=="select_option"){
                    $("#select_choices_container").show();
                } else {
                    $("#select_choices_container").hide();
                }
            });

            $( "#data_type" ).change(function() {
                var val = $("#data_type").val();
                if(val=="select_option"){
                    $("#select_choices_container_edit").show();
                } else {
                    $("#select_choices_container_edit").hide();
                }
            });
        })

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/labels/list.blade.php ENDPATH**/ ?>