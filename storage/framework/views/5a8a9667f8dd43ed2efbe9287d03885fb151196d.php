
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Merchant | Details</title>
<script src="<?php echo e(url('asset/js/toastr.min.js')); ?>"></script><!-- pusher min js-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

   <script src="https://code.jquery.com/jquery-3.6.0.js"></script> 
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('asset/plugins/fontawesome-free/css/all.min.css')); ?>">
  <script src="https://kit.fontawesome.com/6160ccab2c.js" crossorigin="anonymous"></script>

  <!-- Theme style -->
   <link rel="stylesheet" href="<?php echo e(asset('asset/dist/css/adminlte.min.css')); ?>">

<link rel="icon" type="image/png" href="<?php echo e(asset('asset/img/favicon.png')); ?>">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo e(asset('asset/js/jquery.signature.js')); ?>"></script>
  
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('asset/js/jquery.signature.css')); ?>">
  
    <style>
        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
    </style>

</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white" style="background: #007bff;">
    <div class="container-fluid">
      <a href="#" class="navbar-brand">
        <img src="<?php echo e(asset('asset/img/white-logo.png')); ?>"  alt="AdminLTE Logo" class="brand-image " style="opacity: 1.8;width:75px;">
      </a>
        <span class="" style="color:white;float:right; font-weight: 600; font-size: 20px;">Merchant Details</span>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

     

     
    </div>
  </nav>
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
    <div class="alert alert-danger" id="alert-errors" style="display: none"></div>
    <div class="alert alert-success" id="alert-success" style="display: none"></div>
    <?php if(session()->has('message')): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <?php echo e(session()->get('message')); ?>

            <?php echo e(session()->forget('message')); ?>

            <?php echo e(session()->save()); ?>

        </div>
    <?php endif; ?>
    <?php if(session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <?php echo e(session()->get('success')); ?>

            <?php echo e(session()->forget('success')); ?>

            <?php echo e(session()->save()); ?>

        </div>
    <?php endif; ?>
    <?php if(count($errors) > 0 or session()->has('error-title')): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <?php if(session()->has('error-title')): ?>
                <?php echo e(session()->get('error-title')); ?>

                <?php echo e(session()->forget('error-title')); ?>

                <?php echo e(session()->save()); ?>

            <?php endif; ?>
            <?php if(count($errors) > 0): ?>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Personal Details</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Document Lists</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">

                    <form method="post">
                                <?php echo csrf_field(); ?>
                                <div class="card-body">
                                    <div class="row">
                                        <input type="hidden" name="old_signature" value="<?php echo e($lead['signature_image']); ?>" />

                                        <?php if(!empty($labels)): ?>
                                            <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($label->status == 1): ?>
                                                 <?php if($label->label_title_url != 'lead_unique_url'): ?>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label
                                                                for=""><?php if($label->data_type == 'select_option'): ?>
                                                                    Select
                                                                <?php endif; ?> <?php echo e($label->title); ?> <?php if($label->data_type == 'date'): ?> (mm/dd/yyyy) <?php endif; ?> <?php if($label->merchant_required == 1): ?>
                                                                    <span style="color: red;">*</span>
                                                                <?php endif; ?></label>

                                                            <?php if($label->label_title_url == 'country'): ?>
                                                                 <select class="form-control" name="country" id="country" <?php if($label->merchant_required == 1): ?> required
                                                                       <?php endif; ?>
                                                                        data-country="<?php echo e($lead['country']); ?>">
                                                                    <option value="US">United States</option>
                                                                    <option value="IN">India</option>
                                                                </select>
                                                            <?php elseif($label->label_title_url == 'state'): ?>
                                                                <div class="input-daterange input-group">
                                                                <span id="state-code"
                                                                          data-state="<?php echo e($lead['state']); ?>"><input
                                                                            class="form-control" type="text" id="state"
                                                                            name="state"></span>
                                                                </div>

                                                            <?php elseif($label->data_type == 'select_option'): ?>
                                                                <?php
                                                                    $values = $label['values'];
                                                                    $arr = json_decode($values);
                                                                ?>
                                                                <?php if(!empty($arr)): ?>
                                                                    <select class="form-control"
                                                                            name="<?php echo e($label->column_name); ?>">
                                                                        <?php
                                                                            foreach($arr as $val)
                                                                            {
                                                                        ?>
                                                                        <option
                                                                            value="<?php echo e($val); ?>"><?php echo e(ucwords($val)); ?></option>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                <?php endif; ?>
                                                            <?php elseif($label->data_type == 'date'): ?>
                                                                <input type="date" name="<?php echo e($label->column_name); ?>"
                                                                       
                                                                       class="form-control" value="<?php echo e($lead[$label->column_name]); ?>"
                                                                       
                                                                       <?php if($label->merchant_required == 1): ?> required
                                                                       <?php endif; ?> placeholder="Enter <?php echo e($label->title); ?>"/>

                                                             <?php elseif($label->data_type == 'datetime-local'): ?>
                                                                <input type="datetime-local" name="<?php echo e($label->column_name); ?>"
                                                                       
                                                                       class="form-control" value="<?php echo e($lead[$label->column_name]); ?>"
                                                                       
                                                                       <?php if($label->merchant_required == 1): ?> required
                                                                       <?php endif; ?> placeholder="Enter <?php echo e($label->title); ?>"/>

                                                            <?php elseif($label->data_type == 'email'): ?>
                                                                <input type="email" name="<?php echo e($label->column_name); ?>"
                                                                       
                                                                       class="form-control" value="<?php echo e($lead[$label->column_name]); ?>"
                                                                       
                                                                       <?php if($label->merchant_required == 1): ?> required
                                                                       <?php endif; ?> placeholder="Enter <?php echo e($label->title); ?>"/>



                                                            <?php else: ?>
                                                                <input type="text" name="<?php echo e($label->column_name); ?>" value="<?php echo e($lead[$label->column_name]); ?>"
                                                                       <?php if($label->data_type == 'number'): ?> oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" <?php endif; ?>
                                                                       value=""
                                                                       class="form-control  <?php if($label->data_type == 'phone_number'): ?> phone_number <?php endif; ?> " 
                                                                       <?php if($label->data_type == 'phone_number'): ?> onkeypress="return isNumberKey($(this));"
                                                                       <?php endif; ?> <?php if($label->merchant_required == 1): ?> required
                                                                       <?php endif; ?> placeholder="Enter <?php echo e($label->title); ?>"/>

                                                            <?php endif; ?>

                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                         <div class="col-md-12">
                                        <div class="row">
                                            <?php if(!empty($lead['signature_image'])): ?>
                                         <div class="col-md-6">
                            <label class="" for="">Signature Image</label>
                            <br/>
                            <div><img src="<?php echo e(asset('/uploads/signature/')); ?>/<?php echo e($lead['signature_image']); ?>" /></div>
                            <br/>
                        </div>
                        <?php endif; ?>

                                         <div class="col-md-6">
                            <label class="" for="">Signature</label>
                            <br/>
                            <div id="sig" ></div>
                            <br/>
                            <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                            <textarea id="signature64" name="signed" style="display: none"></textarea>
                        </div>
                        </div>

</div>
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-body -->

                                <div class="modal-footer">
                                    

                                    <a onclick="window.location.reload();" type="button"
                                       class="btn btn btn-warning waves-effect waves-light" data-dismiss="modal"><i
                                            class="fa fa-refresh" aria-hidden="true"></i> Reset</a>
                                    <button type="submit" name="submit" value="personal_information"
                                            class="btn btn btn-primary waves-effect waves-light"><i
                                            class="fa fa-edit edit"></i> Update
                                    </button>
                                </div>
                            </form>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
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
                                                <option value="">Select Document Type</option>

                                             <?php if(!empty($document_types)): ?> <?php $__currentLoopData = $document_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <?php if($type->status == 1): ?>

                                                <option value="<?php echo e($type->type_title_url); ?>"><?php echo e(ucfirst($type->title)); ?></option>
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
                   
                    
                  <?php echo $__env->make("merchant.list", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

                     </div>
                </div>
                  </div>
                  <!-- /.tab-pane -->

                 
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>

       
          
          </div>
        <footer class="main-footer">
  <strong>Copyright &copy; 2020-<?php echo e(date('Y')); ?> <a href="#"><?php echo e(env('PRODUCT_NAME')); ?></a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block"></div>
</footer>
        </div>
        <!-- /.row -->


      </div><!-- /.container-fluid -->

    </div>
    <!-- /.content -->


  </div>
  <!-- /.content-wrapper -->


</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->

    <script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>
  
    <script>

     

     

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }

    </script>
    <script src="<?php echo e(asset('asset/js/country-states.js')); ?>"></script>

    <script>
        (function () {
            //country code for selected option
            let user_country_code = $("#country").data('country');
            let user_state_code = $("#state-code").data('state');
            let country_list = country_and_states['country'];
            let states_list = country_and_states['states'];

            // country name drop down
            let option = '';
            option += '<option value="">Select Country</option>';
            for (let country_code in country_list) {
                // set selected option user country
                let selected = (country_code == user_country_code) ? ' selected' : '';
                option += '<option value="' + country_code + '"' + selected + '>' + country_list[country_code] + '</option>';
            }
            document.getElementById('country').innerHTML = option;

            // state name drop down
            let text_box = '<input type="text" class="form-control" class="input-text" id="state">';
            let state_code_append_id = document.getElementById("state-code");

            function create_states_dropdown() {
                let country_code = document.getElementById("country").value;
                let states = states_list[country_code];
                // invalid country code or no states add textbox
                if (!states) {
                    state_code_append_id.innerHTML = text_box;
                    return;
                }
                let option = '';
                if (states.length > 0) {
                    option = '<select class="form-control" name="state" id="state" style="width:100%">\n';
                    for (let i = 0; i < states.length; i++) {
                        let selected_state = (states[i].name == user_state_code) ? ' selected' : '';
                        option += '<option value="' + states[i].name + '"' + selected_state + '>' + states[i].name + '</option>';
                    }
                    option += '</select>';
                } else {
                    // create input textbox if no states
                    option = text_box
                }
                state_code_append_id.innerHTML = option;
            }

            // country change event
            const country_select = document.getElementById("country");
            country_select.addEventListener('change', create_states_dropdown);

            create_states_dropdown();
        })();
    </script>


<script src="<?php echo e(url('asset/js/sweetalert.min.js')); ?>"></script>
<script src="<?php echo e(asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('asset/plugins/input-mask/jquery.inputmask.js')); ?>"></script>
<script>
  $(document).ready(function ()
  {
    setTimeout(function() {
        $('.alert').fadeOut('fast');
    }, 3000);
    
    $('.phone_number').inputmask("(999) 999-9999");
    //$('#datatable').DataTable();
  });
</script>

 <script>
    j=1;
      
         function myFunction(val)
         {
            var clientId = <?php echo $clientId;?>;
             $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: "<?php echo e(url('/types/post')); ?>",
                  method: 'post',
                  data: {
                     type: jQuery('#type_'+val).val(),clientId:clientId
                  },
                  success: function(result){
                    var length = result.values.length;

                    var option='';

                    for(i=0;i<length;i++)
                    {
                        option +="<option value='"+result.values[i]+"'>"+result.values[i]+"</option>";
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
                                              

 html +='<option value="<?php echo e($type->type_title_url); ?>"><?php echo e(ucfirst($type->title)); ?></option>';

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


</body>
</html>

<?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/merchant/index.blade.php ENDPATH**/ ?>