<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html >
<html >
	<head>
		<base href="<?php echo base_url();?>"/>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>দৈনিক কালেকশন রিপোর্ট</title>
		<meta name="robots" content="index, nofollow" />
		<link rel="shortcut icon" href="img/favicon.ico"  type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="reports_css/reports.css"/>
		<link rel="stylesheet" media="screen,projection" type="text/css" href="datepicker/jquery-ui.css" />
		<script src="datepicker/jquery-1.9.1.js"></script>
		<script src="datepicker/jquery-ui.js"></script>
		<script type="text/javascript">
		
			$(function(){
			var pickerOpts = {
					dateFormat: $.datepicker.ATOM
				};
			
			var pickerOpts1 = {
				dateFormat: $.datepicker.ATOM
				};	
				
				$("#fromdate").datepicker(pickerOpts);
				$("#todate").datepicker(pickerOpts1);
			});
		</script>
		<style type="text/css">
			.date{
				width:90px;
			}
			@media print {
				#bar{display:none;}
				#container th{border:1px solid #f1f1f1;}
			}
		</style>

	</head>
	<?php
		// some execution here........
		$total=0;
		
	?>
	<body>
		<div id="bar">
			<div class="barcon">
				<form action="" method="get">
					<p align="left"  style="width:100%">
						<span>From:</span>
						<input type="text" class="date" id="fromdate" name='fdate' value="<?php echo $fdate?>">
						<span>&nbsp; To:</span>
						<input type="text" class="date" id="todate" name='tdate' value="<?php echo $tdate?>">
						<span>&nbsp; Category:</span>
						<select name='ctg'>
							<option value="">---Select one---</option>					
							<?php 					
								foreach ($out as $crow):
							?>					
							<option value="<?php echo $crow->sub_title?>" <?php if($ctg==$crow->sub_title){echo "SELECTED";}?>><?php echo $crow->sub_title;?></option>				
							<?php endforeach;?>			
						</select>
						<input type="submit" value="Submit" class="submit">
					</p>
				</form>
				<p align="right" style="float:right;width:10%;position:relative;top:-20px;">
					<a href="javaScript:window.print();" title="Print"><img src="library/img/print.png"></a>
				</p>
			</div>
		</div>
		<div id="container">
			<h2><?php echo $all_data->full_name_english;?></h2>
			<h3>Daily Collection Report</h3>
			<h4>From <?php echo $fdate?> till <?php echo $tdate?></h4>
			<table cellspacing="0">
				<thead>
					<tr>
						<th width="20">Nr.</th>
						<th width="80">Voucher No</th>
						<th width="100">Payment Date</th>
						<th>Description</th>
						<th width="100">Amount</th>
					</tr>
				</thead>
				<tbody>
					<?php  $nr=1;foreach ($dailyReport as $row): ?>
					<tr>
						<td><?php echo $nr?></td>
						<td><?php echo $row->voucherno?></td>
						<td class="first"><?php echo date('d/m/y', strtotime($row->payment_date))?></td>
						<td>
							<?php
								if($row->status==1){
									echo $row->sub_title.'&nbsp;&raquo;&nbsp;'.$row->bcomname.'&nbsp;&raquo;SN#'.$row->bno;
								}elseif($row->status==2 || $row->status==3){
									echo $row->sub_title."".$row->showData; 
								}elseif($row->status==4){
									echo $row->sub_title."".$row->holding_info;
								}else{
									echo $row->sub_title;
								}
							?>
						</td>
						<td style="text-align:left"><?php $total+=$row->cr;echo $row->cr;?></td>
					</tr>
					<?php $nr++;endforeach;?>
					<?php if ($record==0){?>
					<tr>
						<td class="first">&nbsp;</td>
						<td colspan='2'>No Record Found</td>
						<td>&nbsp;</td>
					</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan='3'>&nbsp;</th>
						<th style="text-align:right">Total:</th>
						<th style="text-align:left"><?php echo number_format($total,2)?></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</body>
</html>