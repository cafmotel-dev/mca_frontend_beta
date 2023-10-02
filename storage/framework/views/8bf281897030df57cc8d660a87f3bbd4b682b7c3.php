<?php $__env->startSection('title', 'Document List'); ?>

<?php $__env->startSection('content'); ?>


    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/dashboard')); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Documents</li>
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
                        <form class="no-margin" id="fileupload"  method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>  Add
                                    Document
                                </h3>
                            </div>

                            <div class="card-body ">
                                <div id="websiteUrlWrapper">
                                <div class="form-row form-group">
                                    <div class="col-4">
                                         <input type="" required="" name="document_name[]" placeholder="Document Title" class="form-control">
                                    </div>

                                    <div class="col-4" id="div_0">
                                        <select class="form-control" name="document_type[]" onchange="myFunction('0')" id="type_0">
                                                <option value="">Select Type</option>

                                             <?php if(!empty($document_types)): ?> <?php $__currentLoopData = $document_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <?php if($type['status'] == 1): ?>
                                                <option value="<?php echo e($type['type_title_url']); ?>"><?php echo e(ucfirst($type['title'])); ?></option>
                                                <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>
                                        </select>
                                    </div>

                                       <div class="col-2" id="select_option_show_0" style="display: none;">
                                        <select class="form-control" name="type_value[]" id="select_option_0">
                                            
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <div class="input-group  input-group-sm ">
                                            <input type="file" required="" name="file_name[]" class="form-control">
                                            <span class="input-group-append">
                                                <button type="button" name="add" class="btn btn-success btn-sm add mb-3 "><i class="fa fa-plus" aria-hidden="true"></i> Add More </button>
                                            </span>
                                        </div>
                                    </div>


                                      

                                    
                                    
                                </div>
                            </div>



                            </div>



                             <div style="clear: both"></div>
                            <div class="modal-footer">
                               

                                <a onclick="window.location.reload();" type="button" class="btn btn btn-warning waves-effect waves-light" data-dismiss="modal"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</a> 
                                <button type="submit" name="submit" value="add" class="btn btn btn-primary waves-effect waves-light"><i class="fa fa-check-square-o"></i> Upload</button>
                            </div>

                          


                             
                            </div>
                        </form>
                        </div>
                   
                    
                   <?php echo $__env->make("documents.list", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                     </div>
                </div>
            </div>
        </section>

      
    </div>
    </div>

  <script>
    j=1;
       //  jQuery(document).ready(function(){
            /*jQuery('#type').change(function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: "<?php echo e(url('/grocery/post')); ?>",
                  method: 'post',
                  data: {
                     type: jQuery('#type').val()
                  },
                  success: function(result){
                    var length = result.values.length;

                    var option='';

                    for(i=0;i<=length;i++)
                    {
                        option +="<option value=''>"+result.values[i]+"</option>";
                    }

                    alert(option);

                    $("#select_option_show").show();
                    $("#select_option").html(option);

                  
                  }});
               });*/
           

         function myFunction(val)
         {
             $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: "<?php echo e(url('/type-value/post')); ?>",
                  method: 'post',
                  data: {
                     type: jQuery('#type_'+val).val()
                  },
                  success: function(result){
                    var length = result.values.length;

                    var option='';

                    for(i=0;i<length;i++)
                    {
                        option +="<option value=''>"+result.values[i]+"</option>";
                    }


                  $("#select_option_show_"+val).show();
                    $("#select_option_"+val).html(option);
                    $('#div_'+val).removeClass("col-4");

                    $('#div_'+val).addClass("col-2");

                  
                  }});
         }
 // }//);
  

$(document).on('click', '.add', function(){
        var html = '<div class="form-row form-group">';
        html +=' <div class="col-4"><input type="" required="" name="document_name[]" placeholder="Document Title" class="form-control"></div>';

        html +='<div class="col-4" id="div_'+j+'"><select class="form-control" id="type_'+j+'" onchange="myFunction('+j+')" name="document_type[]">';

      <?php if(!empty($document_types)): ?> <?php $__currentLoopData = $document_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <?php if($type['status'] == 1): ?>

                                              

 html +='<option value="<?php echo e($type['type_title_url']); ?>"><?php echo e(ucfirst($type['title'])); ?></option>';
<?php endif; ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>

        html +='</select></div> <div class="col-2"  id="select_option_show_'+j+'" style="display: none;"><select class="form-control" id="select_option_'+j+'" name="type_value[]"></select></div>';

       
        html += '<div class="col-4"><div class="input-group input-group-sm "><input type="file" required="" name="file_name[]" class="form-control"><span class="input-group-append"><button type="button" name="remove" class="btn btn-danger remove"><i class="fa fa-remove"></i></button></span></div></div>';
        $('#websiteUrlWrapper').append(html);
        ++j;
    });

    $(document).on('click', '.remove', function(){
        $(this).closest('.form-group').remove();
    });
</script>
  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/documents/lead-wise-documents.blade.php ENDPATH**/ ?>