<?php $__env->startSection('title', 'Document Type List'); ?>

<?php $__env->startSection('content'); ?>


    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/dashboard')); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Document type</li>
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
                                <h3 class="card-title"><b><i class="fa-solid fa-tags"></i> Document List</b></h3>
                            </div>

                            <div class="card-body">
                                <table id="datatable" class="table table-striped table-bordered table-hover" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php if(!empty($document_types)): ?>
                                        <?php $__currentLoopData = $document_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key+1); ?></td>
                                                <td><?php echo e($list->title); ?></td>
                                                
                                               

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
                                                               data-id="<?php echo e($list->id); ?>" data-title="<?php echo e($list->title); ?>"    data-values="<?php echo e($list->values); ?>"
                                                               data-original-title="Edit" class="edit"><i
                                                                    class="fa fa-edit edit fa-lg"></i></a>
                                                        </li>
                                                        

                                                        <li class="list-inline-item">
                            <label class="switch"><input data-id="<?php echo e($list->id); ?>" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" <?php echo e($list->status ? 'checked' : ''); ?>><span class="slider_button round"></span>
                          </label>
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
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-plus-square fa-lg" aria-hidden="true"></i> Add
                                    Document Type </h3>
                            </div>

                            <form method="post" id="addLabel">
                                <?php echo csrf_field(); ?>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" required class="form-control" name="title"
                                               placeholder="Title">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Select Values</label>
                                        <select class="form-control data_type" name="data_type">
                                            
                                            <option selected value="No">No</option>
                                            <option value="select_option">Yes</option>
                                        </select>

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
                </div>
            </div>
        </section>

        <div class="modal fade" id="ajaxModel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-edit" aria-hidden="true"></i> Edit Document Type </h3>
                    </div>
                    <div class="modal-body">
                       <form method="post" action="<?php echo e(route('documenttype.update')); ?>" id="updateDocumentType">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="documenttype_id" id="documenttype_id">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" required class="form-control" id="title" name="title"
                                           placeholder="Title">
                                </div>

                                <div class="form-group">
                                        <label for="exampleInputEmail1">Select Values</label>
                                        <select class="form-control" name="data_type" id="data_type">
                                            <option  value="No">No</option>
                                            <option value="select_option">Yes</option>
                                        </select>

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
            var values = $(this).data('values');


            if(values[0])
            {
            var data_type = 'select_option';
             $('#data_type').val(data_type);

             $('#data_type').val(data_type);
                $("#select_choices_container_edit").show();
                $('#select_choices_edit').val(values);

             
            }
            else
            {


            var data_type = 'No';

             $('#data_type').val(data_type);


            $("#select_choices_container_edit").hide();
                $('#select_choices_edit').val("");

             

            }



            $('#ajaxModel').modal('show');
            $('#documenttype_id').val(id);
            $('#title').val(title);
           
            $('#required').val(required);
            $('#display_order').val(display_order);



        });

   $(function()
  {
    $("#datatable").on("change", ".toggle-class", function ()
    {
      $('#loading').show();
      var status = $(this).prop('checked') == true ? 1 : 0; 
      var documenttype_id = $(this).data('id');             

      $.ajax({
        type: "GET",
        dataType: "json",
        url: '/changeDocumentTypeStatus/'+documenttype_id+'/'+status,
        success: function(data)
        {
          if(data.status == 'true')
          {
            $('#loading').show();
          console.log(data.success);
          window.location.reload(1);
          }
          else
          {
            
          }
          
        }
      });
    })
  })

  $(document).ready(function()
  {
    $('#addGroup,#updateDocumentType').submit(function()
    {
      $("#ajaxModel").hide();
      $('#loading').show();
    });
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/document-types/list.blade.php ENDPATH**/ ?>