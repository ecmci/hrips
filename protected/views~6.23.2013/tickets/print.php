<?php $this->pageTitle="I.T. Incident Report - Period $model->from to $model->to"; ?>

<style type="text/css">
table.letter-width{
  width:8.5in;
}
div.wrapper{
    width:825px;   
    height:auto;
    padding:1px; 
	  margin-left:50px;
}

</style>
<script type="text/javascript">
$(document).ready(function() {   
  var data = [
		    { label: "North America",  data: 38, color: "#88bbc8"},
		];
  /* $.plot(placeholder, data, options) */
  $.plot($(".incidents-pies"), data, 
		{
			series: {
				pie: { 
					show: true,
					innerRadius: 0.4,
					highlight: {
						opacity: 0.1
					},
					radius: 1,
					stroke: {
						color: '#fff',
						width: 8
					},
					startAngle: 2,
				    combine: {
	                    color: '#353535',
	                    threshold: 0.05
	                },
	                label: {
	                    show: true,
	                    radius: 1,
	                    formatter: function(label, series){
	                        return '<div class="pie-chart-label">'+label+'&nbsp;'+Math.round(series.percent)+'%</div>';
	                    }
	                }
				},
				grow: {	active: false}
			},
			legend:{show:false},
			grid: {
	            hoverable: true,
	            clickable: true
	        },
	        tooltip: true, //activate tooltip
			tooltipOpts: {
				content: "%s : %y.1"+"%",
				shifts: {
					x: -30,
					y: -50
				}
			}
		});
});         
</script>

<div class="wrapper">
  <div class="row page-header">
      <h1 class="center">I.T. Incident Report</h1>
      <h5>Period <?php echo $model->from." to ".$model->to; ?> </h5>
  </div>
  <?php /*
  <div class="row-fluid">
    <div class="span6">
       <?php
		    $this->beginWidget('zii.widgets.CPortlet', array(
  			 'title'=>"<i class='icon-folder-open'></i> Incident Category Overview",
  	   ));?>
            <div class="incidents-pie" style="height: 250px;width:100%;margin-top:15px; margin-bottom:15px;"></div>
       <?php $this->endWidget();?>
    </div>
    <div class="span6">
       <?php
		    $this->beginWidget('zii.widgets.CPortlet', array(
  			 'title'=>"<i class='icon-folder-open'></i> Reported Problems Per Day",
  	   ));?>
            <div class="visitors-chart" style="height: 250px;width:100%;margin-top:15px; margin-bottom:15px;"></div>
       <?php $this->endWidget();?>
    </div>  
  </div>
  */ ?>
  <div class="row">
    <?php
		$this->beginWidget('zii.widgets.CPortlet', array(
  			'title'=>"<i class='icon-folder-open'></i> Summary",
  	));?>
    <table class="table table-bordered table-striped table-condensed">
    <thead>
    <tr><th>Case#</th><th>Category</th><th>Status</th><th>Reported By</th><th>Handled By</th><th>Opened</th><th>Closed</th></tr>
    </thead>
    <tbody>
      <?php foreach($model->search()->data as $data){ ?>
      <tr>
          <td><?php echo $data->id; ?></td>
          <td><?php echo $data->category->name; ?></td>
          <td><?php echo $data->status; ?></td>
          <td><?php echo $data->reportedBy->getFullName(); ?></td>
          <td><?php echo $data->createdBy->getFullName(); ?></td>
          <td><?php echo $data->created_timestamp; ?></td>
          <td><?php echo $data->closed_timestamp; ?></td>
      </tr>
      <?php } ?>
    </tbody>
    </table>
    <?php $this->endWidget();?>
  </div>
</div>
