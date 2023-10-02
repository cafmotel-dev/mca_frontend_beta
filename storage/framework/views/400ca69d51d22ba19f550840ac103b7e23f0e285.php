<?php $__env->startSection('title', 'Group List'); ?>
<?php $__env->startSection('content'); ?> 
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(url('/dashboard')); ?>">Home</a></li>
              <li class="breadcrumb-item active">Group</li>
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
                <h3 class="card-title"><b><i class="fa fa-tasks" aria-hidden="true"></i> Group List</b> </h3>
              </div>

              <div class="card-body"> <!-- display table-striped -->
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
                    <?php if(!empty($groups)): ?>
                    <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                            <a href="javascript:void(0)" data-toggle="tooltip"  data-id="<?php echo e($list->id); ?>" data-title="<?php echo e($list->title); ?>" data-original-title="Edit" class="edit"><i class="fa fa-edit edit fa-lg"></i></a>
                          </li>

                          <li class="list-inline-item">
                            <form method="POST" action="<?php echo e(route('group.delete', $list->id)); ?>">
                              <?php echo csrf_field(); ?>
                              <input name="_method" type="hidden" value="DELETE">
                              <a style="color:red;" type="submit" class="show_confirm" data-toggle="tooltip" title='Delete'><i class="fa fa-trash fa-lg"></i></a>
                          </form>
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
                <h3 class="card-title"><i class="fa fa-plus-square fa-lg" aria-hidden="true"></i> Add Group Title</h3>
              </div>

              <form method="post" id="addGroup" >
                <?php echo csrf_field(); ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" required class="form-control"  name="title" placeholder="Title">
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
      </div>
    </section>

        <div class="modal fade" id="ajaxModel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content card card-primary">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-edit" aria-hidden="true"></i> Edit Group Title</h3>
              </div>
              <div class="modal-body">
                <form method="post" action="<?php echo e(route('group.update')); ?>" id="updateGroup">
                <?php echo csrf_field(); ?>
                  <input type="hidden" name="group_id" id="group_id">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" required class="form-control" id="title" name="title" placeholder="Title">
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
    var title = $(this).data('title');
    $('#ajaxModel').modal('show');
    $('#group_id').val(id);
    $('#title').val(title);
  });

  $(function()
  {
    $("#datatable").on("change", ".toggle-class", function ()
    {
      $('#loading').show();
      var status = $(this).prop('checked') == true ? 1 : 0; 
      var group_id = $(this).data('id');             

      $.ajax({
        type: "GET",
        dataType: "json",
        url: '/changeGroupStatus/'+group_id+'/'+status,
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
    $('#addGroup,#updateGroup').submit(function()
    {
      $("#ajaxModel").hide();
      $('#loading').show();
    });
  })

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/groups/list.blade.php ENDPATH**/ ?>