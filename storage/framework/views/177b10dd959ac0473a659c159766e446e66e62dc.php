<footer class="main-footer">
  <strong>Copyright &copy; 2020-<?php echo e(date('Y')); ?> <a href="#"><?php echo e(env('PRODUCT_NAME')); ?></a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block"></div>
</footer>

<aside class="control-sidebar control-sidebar-dark"></aside>

</div>





<!-- AdminLTE App -->
<script src="<?php echo e(asset('asset/dist/js/adminlte.min.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->

<style>
  table.dataTable tbody th, table.dataTable tbody td {
    padding: 4px 10px; /* e.g. change 8x to 4px here */
}



</style>

<script src="<?php echo e(asset('asset/plugins/input-mask/jquery.inputmask.js')); ?>"></script>
<script>
  $(document).ready(function ()
  {
    $('.phone_number').inputmask("(999) 999-9999");
    $('#datatable').DataTable();
  });
</script>

<script src="<?php echo e(url('asset/js/sweetalert.min.js')); ?>"></script>
<script src="<?php echo e(asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('asset/plugins/select2/js/select2.full.min.js')); ?>"></script>


<script>
  <?php if($message = Session::get('message')): ?>
  toastr.info("<?php echo e($message); ?>");
  <?php endif; ?>

  <?php if($message = Session::get('success')): ?>
  toastr.success("<?php echo e($message); ?>");
  <?php endif; ?>

  <?php if($message = Session::get('error')): ?>
  toastr.error("<?php echo e($message); ?>");
  <?php endif; ?>

  <?php if(count($errors) > 0): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      toastr.error("<?php echo e($error); ?>");
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>

</script>

<script type="text/javascript">
  function isNumberKey(evt)
  {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
    return true;
  }

</script>


<script>
  $( function() {
    $( ".datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd'
        });
  } );
  </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/layouts/footer.blade.php ENDPATH**/ ?>