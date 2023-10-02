<?php $__env->startSection('title', 'Lender List'); ?>
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

  <?php echo $__env->make("layouts.messaging", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">

            <div class="modal-footer">
              <a href="<?php echo e(url('/lender')); ?>/add" class="btn btn btn-primary waves-effect waves-light reset" ><i class="fa fa-plus"></i> Add Lender</a> 
            </div>

            <div class="card-body">
              <table id="datatable" class="table table-striped table-bordered table-hover" style="width:100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact Person</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                
                <tbody>

                  <?php if(!empty($lenders)): ?>
                  <?php $__currentLoopData = $lenders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                  <tr>
                    <td><?php echo e($key+1); ?></td>
                    <td><?php echo e(ucfirst($list->lender_name)); ?></td>
                    <td><?php echo e($list->email); ?></td>
                    <td><?php echo e($list->contact_person); ?></td>
                    <td>
                      <?php if($list->status == 1): ?>
                      <span class="badge badge-success">Active</span>
                      <?php else: ?>
                      <span class="badge badge-danger">Inactive</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <ul class="list-inline m-0">
                        <li class="list-inline-item">
                          <a href="<?php echo e(url('/lender')); ?>/<?php echo e($list->id); ?>/edit"  type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
                        </li>

                        <!-- <li class="list-inline-item">
                          <form method="POST" action="<?php echo e(route('lender.delete', $list->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <input name="_method" type="hidden" value="DELETE">
                            <a style="color:red;" type="submit" class="show_confirm" data-toggle="tooltip" title='Delete'><i class="fa fa-trash fa-lg"></i></a>
                          </form>
                        </li> -->

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
      </div>
  </section>
</div>

<script>
  
  $(function () {
            $("#datatable").on("change", ".toggle-class", function () {
                $('#loading').show();
                var status = $(this).prop('checked') == true ? 1 : 0;
                var lender_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeLenderStatus/' + lender_id + '/' + status,
                    success: function (data) {
                        if (data.status == 'true') {
                            $('#loading').show();
                            console.log(data.success);
                            window.location.reload(1);
                        } else {

                        }

                    }
                });
            });
            });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/lenders/list.blade.php ENDPATH**/ ?>