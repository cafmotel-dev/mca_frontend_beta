<?php $__env->startSection('title', 'Lead Source List'); ?>

<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo e(url('/dashboard')); ?>">Home</a></li>
            <li class="breadcrumb-item active">Lead Source</li>
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
              <h3 class="card-title"><b><i class="fa fa-tasks" aria-hidden="true"></i> Lead Source List</b> </h3>
            </div>
          <div class="card-body"> 

            <table id="datatable" class="table table-striped table-bordered table-hover" style="width:100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Site Url</th>
                    <th>Unique Id</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <?php if(!empty($lead_source)): ?>
                  <?php $__currentLoopData = $lead_source; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                  <tr>
                    <td><?php echo e($key+1); ?></td>
                    <td><?php echo e($list->source_title); ?></td>

                    <td><?php echo e($list->url); ?></td>
                    <td><?php echo e($list->unique_id); ?></td>
                    <td><?php if($list->status == 1): ?>
                          <span class="badge badge-success">Active</span>
                          <?php else: ?>
                          <span class="badge badge-danger">Inactive</span>
                          <?php endif; ?>
                      </td>
                    
                    <td>
                      <ul class="list-inline m-0">
                        <li class="list-inline-item">
                          <a href="javascript:void(0)" data-toggle="tooltip"  data-id="<?php echo e($list->id); ?>" data-url="<?php echo e($list->url); ?>" data-sourcetitle="<?php echo e($list->source_title); ?>"" data-original-title="Edit" class="edit"><i class="fa fa-edit edit fa-lg"></i></a>
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
              <h3 class="card-title"><i class="fa fa-plus-square fa-lg" aria-hidden="true"></i> Add Lead Source Url</h3>
            </div>

            <form method="post" id="addLeadStatus" >
              <?php echo csrf_field(); ?>
              <div class="card-body">

                <div class="form-group">
                  <label for="exampleInputEmail1">Lead Source Title</label>
                  <input type="text" required class="form-control"  name="source_title" placeholder="Source Title">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Lead Source Url</label>
                  <input type="text" required class="form-control"  name="url" placeholder="Url">
                </div>

              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
                <a onclick="window.location.reload();" type="button" class="btn btn btn-warning waves-effect waves-light" data-dismiss="modal"><i class="fa-solid fa-arrows-rotate"></i> Reset</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>


  <div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
           <div class="modal-content card card-primary">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-edit" aria-hidden="true"></i> Edit Lead Source Url</h3>
            </div>
            <div class="modal-body">
            <form method="post" action="<?php echo e(route('leadsource.update')); ?>" id="updateLeadStatus">
              <?php echo csrf_field(); ?>
                   <input type="hidden" name="lead_source_id" id="id">

              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Lead Source Title</label>
                  <input type="text" required class="form-control"  name="source_title" id="source_title" placeholder="Source Title">
                </div>


                <div class="form-group">
                  <label for="exampleInputEmail1">Lead Source Url</label>
                  <input type="text" required class="form-control" id="url" name="url" placeholder="Title">
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Update</button>
                <a  type="button" class="btn btn btn-warning waves-effect waves-light" data-dismiss="modal"><i class="fa fa-reply fa-lg"  aria-hidden="true"></i> Cancel</a>
              </div>
            </form>
          </div>
          </div>

          </div>
        </div>
    </div>
</div>




  <script>
    $(document).ready(function ()
    {
      $('#datatable').DataTable();
    });
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
  <script type="text/javascript">
    $('.show_confirm').click(function(event)
    {
      var form =  $(this).closest("form");
      var name = $(this).data("name");
      event.preventDefault();
      swal({
        title: `Are you sure you want to delete this record?`,
        text: "If you delete this, it will be gone forever.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        }).then((willDelete)=>
        {
          if (willDelete)
          {
            form.submit();
      $('#loading').show();
            
          }
        }
      );
    });

    $('.edit').click(function ()
    {
      var id = $(this).data('id');
      var url = $(this).data('url');
      var source_title = $(this).data('sourcetitle');

      var color = $(this).data('color');

      $('#ajaxModel').modal('show');
      $('#id').val(id);
      $('#url').val(url);
      $('#source_title').val(source_title);

      $('#color_code').val(color);

    });

  </script>

  <script>
    $(function()
    {
        $("#datatable").on("change", ".toggle-class", function ()
        {
            $('#loading').show();
            var status = $(this).prop('checked') == true ? 1 : 0; 
            var lead_status_id = $(this).data('id');             

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/changeLeadStatus/'+lead_status_id+'/'+status,
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
</script>

<script>
  $(document).ready(function()
  {
    $('#addLeadStatus,#updateLeadStatus').submit(function()
    {
      $("#ajaxModel").hide();
      $('#loading').show();
    });
  })
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/lead-source/list.blade.php ENDPATH**/ ?>