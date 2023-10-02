

<div class="col-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><b><i class="fa-solid fa-tags"></i> Document List</b></h3>
        </div>

        <div class="card-body">
            <table id="datatable" class="table table-striped table-bordered table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Lead Id</th>
                        <th>Title</th>
                        <th>Document Type</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if(!empty($document_type)): ?>
                    <?php $__currentLoopData = $document_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        <td><?php echo e($key+1); ?></td>
                        <td><a href="/lead/view?id=<?php echo e($list['lead_id']); ?>"><?php echo e($list['lead_id']); ?></a></td>
                        <td><?php echo e($list['document_name']); ?> ( <a  target="_blank" href="/uploads/<?php echo e($list['file_name']); ?>"><?php echo e($list['file_size']); ?></a> )</td>
                        <td><?php echo e(ucwords(str_replace('_',' ',$list['document_type']))); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($list['created_at'])->format('d-M-Y H:i A')); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($list['updated_at'])->format('d-M-Y H:i A')); ?></td>
                        <td>
                            <ul class="list-inline m-0">
                                

                                <?php if($list['document_type'] == 'signed_application'): ?>

<!-- data-toggle="modal" data-filename="<?php echo e($list['file_name']); ?>" -->
                                <li class="list-inline-item">
                                   <!--  <a href="signed-application/<?php echo e($list['lead_id']); ?>" style="cursor: pointer;" data-target="#myModal"  class="open_model"><i class="fa fa-eye fa-lg "></i></a> -->

                                    <a target="_blank" href="/generate-pdf/<?php echo e($list['lead_id']); ?>" style="cursor: pointer;" ><i class="fa fa-eye fa-lg "></i></a>


                                </li>
                                <?php else: ?>


                                <li class="list-inline-item">
                                    <a data-toggle="modal" data-filename="<?php echo e($list['file_name']); ?>" style="cursor: pointer;" data-target="#myModal"  class="open_model"><i class="fa fa-eye fa-lg "></i></a>


                                </li>
                                <?php endif; ?>

                                <li class="list-inline-item">
                                    <form method="POST" action="<?php echo e(route('document.delete', $list['id'])); ?>">
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

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-edit" aria-hidden="true"></i> Edit Document</h3>
              </div>
              <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="<?php echo e(route('document.update')); ?>" id="updateDocument">
                <?php echo csrf_field(); ?>
                  <input type="hidden" name="document_id" id="document_id">

                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" required class="form-control" id="title" name="document_name" placeholder="Title">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Document Type</label>

                                        <select class="form-control" name="document_type" id="document_type">
                                             <?php if(!empty($document_types)): ?> <?php $__currentLoopData = $document_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($type['type_title_url']); ?>"><?php echo e(ucfirst($type['title'])); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>
                                        </select>
                                    </div>


                                    <div class="form-group">
                      <label for="exampleInputEmail1">File Upload</label>

                                            <input type="file"  name="file_name" class="form-control">
                                            <span>(gif|jpeg|png|txt|doc|docx|xlsx|xls|pdf|wav|mp3)</span>
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



        <div class="modal fade " id="myModal" role="dialog">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              
            </div>
            <div class="modal-body" >
             <div id="show_popup">
                 
             </div>
            </div>
            <div class="modal-footer justify-content-between">
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>



<script>
    $('.show_confirm').click(function(event)
    {
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();

        swal(
        {
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
    var old_file = $(this).data('old_file');

    var title = $(this).data('title');
    var document_type = $(this).data('type');

    $('#ajaxModel').modal('show');
    $('#document_id').val(id);
    $('#old_file').val(old_file);

    $('#title').val(title);
    $('#document_type').val(document_type);

  });


      $('.open_model').click(function () {

        var html = "";
        var filename = $(this).data('filename');

        html+='<embed src="/uploads/'+filename+'" width="1000px" height="1000px">';
        $('#show_popup').html(html);
        $('#myModal').modal('show');
    });
</script>

  
<?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/documents/list.blade.php ENDPATH**/ ?>