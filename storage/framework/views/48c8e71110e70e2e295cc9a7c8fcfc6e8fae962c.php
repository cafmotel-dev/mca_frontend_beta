<?php $__env->startSection('title', 'Lists List'); ?>
<?php $__env->startSection('content'); ?> 
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(url('/dashboard')); ?>">Home</a></li>
              <li class="breadcrumb-item active">Lists</li>
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
                <h3 class="card-title"><b><i class="fa fa-tasks" aria-hidden="true"></i> Lists</b> </h3>
              </div>

              <div class="card-body"> <!-- display table-striped -->
                <table id="datatable" class="table table-striped table-bordered table-hover" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php if(!empty($lists)): ?>
                    <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($key+1); ?></td>
                      <td><?php echo e($list->title); ?></td>

                     

                      <td>
                        <ul class="list-inline m-0">
                          <li class="list-inline-item">
                            <a href="list/<?php echo e($list->id); ?>/edit"  class="edit"><i class="fa fa-edit edit fa-lg"></i></a>
                          </li>

                          <li class="list-inline-item">
                            <form method="POST" action="<?php echo e(route('group.delete', $list->id)); ?>">
                              <?php echo csrf_field(); ?>
                              <input name="_method" type="hidden" value="DELETE">
                              <a style="color:red;" type="submit" class="show_confirm" data-toggle="tooltip" title='Delete'><i class="fa fa-trash fa-lg"></i></a>
                          </form>
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
                 <h3 class="card-title"><b><i class="fa fa-tasks" aria-hidden="true"></i> Upload List</b> </h3>
              </div>

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
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
                  <a onclick="window.location.reload();" type="button" class="btn btn btn-warning waves-effect waves-light" data-dismiss="modal"><i class="fa-solid fa-arrows-rotate"></i> Reset</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

        
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
    $('#addLeads').submit(function()
    {
      $('#loading').show();
    });
  })

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/lists/list.blade.php ENDPATH**/ ?>