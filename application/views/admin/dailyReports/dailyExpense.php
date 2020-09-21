<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
	<head>
		<base href="<?php echo base_url();?>"/>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>দৈনিক খরচের রিপোর্ট</title>
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
		$fdate=$this->input->get('fdate',TRUE);if (empty($fdate)) $fdate=date('Y-m-d');
		$tdate=$this->input->get('tdate',TRUE);if (empty($tdate)) $tdate=date('Y-m-d');
		if(isset($_GET['ctg'])){
		 $ctg=$this->input->get('ctg',true);
		if($ctg==""){$query=$this->db->query("select * from dailyexp where date(payment_date) between '$fdate' AND '$tdate' order by id desc");}
		else {$query=$this->db->query("select * from dailyexp where date(payment_date) between '$fdate' AND '$tdate'AND catid='$ctg' order by id desc");}
		}
		else{$query=$this->db->query("select * from dailyexp where date(payment_date) between '$fdate' AND '$tdate' order by id desc ");}
		$result=$query->result();
		$record=$this->db->affected_rows();
		
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
								$q=$this->db->select('*')->from('exphead');				
								$out=$q->get()->result();					
								foreach ($out as $crow):
							?>					
							<option value="<?php echo $crow->id?>" <?php if($crow->id==$ctg){ echo "Selected";} ?> ><?php echo $crow->title;?></option>				
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
			<h3>Daily Expense Report</h3>
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
					<?php $nr=1;foreach ($result as $row): ?>
					<tr>
						<td><?php echo $nr?></td>
						<td><?php echo $row->voucherno?></td>
						<td class="first"><?php echo date('d/m/y', strtotime($row->payment_date))?></td>
						<td><?php echo $row->des;  echo " (".$row->purpose.")"?></td>
						<td style="text-align:left"><?php $total+=$row->amount;echo $row->amount;?></td>
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