<?php $__env->startSection('title', 'Leads List'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header" style="padding: 0px !important;">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/dashboard')); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Leads</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <?php echo $__env->make("layouts.messaging", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                            <?php echo $__env->make("leads.leads_datatable", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
       

    </div>


    <script type="text/javascript">
        $('.show_confirm').click(function (event) {
            event.preventDefault();
            // var form = $(this).closest("form");
            var name = $(this).data("name");

            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                    if (willDelete) {
                        // form.submit();
                        $('#loading').show();
                        var leadId = $(this).data('id');

                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            data: {
                                "_token": "<?php echo e(csrf_token()); ?>"
                            },
                            url: '/leads/' + leadId + '/delete',
                            success: function (data) {
                                // console.log(data,data.status);
                                if (data.status == true) {
                                    $('#loading').hide();
                                    console.log(data.status);
                                    window.location.reload(1);
                                } else {

                                }
                            }
                        });
                    }
                }
            );
        });

    </script>

    <script>
        $(function () {
            $("#datatable").on("change", ".toggle-class", function () {
                $('#loading').show();
                var status = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeUserStatus/' + user_id + '/' + status,
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
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/leads/list.blade.php ENDPATH**/ ?>