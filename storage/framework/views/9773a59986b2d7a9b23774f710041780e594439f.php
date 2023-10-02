<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>

<style>
  
  #container {
    height: 400px;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}
</style>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <style>
    span.circle
    {
      border-radius: 50%;
      -moz-border-radius: 50%;
      -webkit-border-radius: 50%;
      color: #6e6e6e;
      display: inline-block;
      font-weight: bold;
      line-height: 80px;
      margin-right: 25px;
      text-align: center;
      width: 80px;
      font-size: 25px;
    }

    .title-lead
    {
      width: 80px;
      color: #6e6e6e;
      font-weight: bold;
      text-align: center;
      line-height: 20px;
      font-size: 15px;
    }

  </style>

  <section class="content">
    <div class="container-fluid">
      <div class="row row_position">
        <?php
        $count_status = 0;
        $json =array();
        $i=0;
        ?>

        <?php if(!empty($lead_status)): ?>
          <?php $__currentLoopData = $lead_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($lead->view_on_dashboard == 1 && $lead->status == 1): ?>
            <?php $__currentLoopData = $lead_status_count['leadstatus']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
              if($lead->lead_title_url == $count->lead_status)
              {
                $count_status = $count->total_lead_status;
                $json[$i]['y'] = $count->total_lead_status;
                break;
              }
              else
              $count_status = 0;
              ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php
                $json[$i]['name'] = strtoupper(str_replace("_",' ',$lead->title));
                $json[$i]['y'] = $count_status;
                $json[$i]['color'] = $lead->color_code;




            ?>

            <div class="col-md-1 col-sm-6 col-12" id="<?php echo $lead->id; ?>">

              <span class="circle" style="background-color: <?php echo e($lead->color_code); ?>;color:white;cursor: pointer;"><?php echo e($count_status); ?></span>
              <h4 style="color: <?php echo e($lead->color_code); ?>;" class="title-lead"><?php echo e(strtoupper(str_replace("_",' ',$lead->title))); ?></h4>
            </div>
          <?php endif; ?>
          <?php
          $i++;
          ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
      </div>
      <hr>

      <?php //echo json_encode($json);die; ?>

     



  

      <div class="row">
        <?php echo $__env->make("leads.leads_datatable", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
      </div>
    </div>
  </section>
</div>

<?php //$json = "{name: 'New Lead',y:10,color:'green'}";

//echo "<pre>";print_r($json);die;
?>
<script>

  Highcharts.chart('container', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45
        }
    },
    title: {
        text: 'Lead Status'
    },
    /*subtitle: {
        //text: '3D donut in Highcharts'
    },*/
    plotOptions: {
        pie: {
            innerSize: 100,
            depth: 45
        }
    },
    series: [{
        name: 'Count',
        data: <?php echo json_encode($json); ?>
    }]
});
   $(".row_position").sortable({
            delay: 150,
            stop: function() {
                var selectedData = new Array();
                $('.row_position>div').each(function() {
                    selectedData.push($(this).attr("id"));
                });
                updateOrder(selectedData);
            }
        });

    function updateOrder(data) {

            $.ajaxSetup({
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }});
            $.ajax({
                url: "<?php echo e(url('/update-lead-status/displayorder')); ?>",
                type:'post',
                data:{display_order:data},
                success:function(data){
                   toastr.success('Display Order is changed Successfully.');
                }
            })
        }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mca_crm\brightny-frontend\resources\views/dashboard/dashboard.blade.php ENDPATH**/ ?>