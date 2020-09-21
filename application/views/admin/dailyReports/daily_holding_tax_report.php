<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
<head>
	<base href="<?php echo base_url();?>"/>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>দৈনিক বসতভিটার প্রতিবেদন</title>
	<meta name="robots" content="index, nofollow" />
	<link rel="shortcut icon" href="img/favicon.ico"  type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="reports_css/reports.css"/>
	<link rel="stylesheet" type="text/css" href="reports_css/dailyreport.css"/>
	<link rel="stylesheet" media="screen,projection" type="text/css" href="datepicker/jquery-ui.css" />
	<script src="datepicker/jquery-1.9.1.js"></script>
	<script src="datepicker/jquery-ui.js"></script>
	<script type="text/javascript">
		$(function(){
			var pickerOpts = {
				dateFormat: $.datepicker.ATOM
			};	
			$("#fromdate").datepicker(pickerOpts);
		});
	</script>
</head>
<body>
	<div id="bar">
		<div class="barcon">
			<form action="" method="get">
				<p align="right"  style="width: 60%">
					<input type="text" class="date" id="fromdate" name='cDate' value="<?php echo $cDate?>">
					<input type="submit" value="Submit" class="submit">
				</p>
			</form>
			<p align="right" style="float:left;width:10%;">
				<a href="javaScript:window.print();" title="Print"><img src="library/img/print.png"></a>
			</p>
		</div>
	</div>

	<div class="fix stracture wrapper1"> 
		<div class="fix top-side">
			<div class="fix heading">
				<h2><?php echo $all_data->full_name;?></h2>
				<h4><?php echo $all_data->gram;?></h4>
				<p class="highilight">
					<span>দৈনিক বসত ভিটার কর আদায় প্রতিবেদন</span>
				</p>
				<h4 style="font-size: 15px;">তারিখঃ  <?php echo $this->web->banDate($cDate);?></h4>
			</div>
			<div class="fix footer">
				<table cellpadding="0" cellspacing="0" width="99%" style="margin: 0px auto; border-collapse:collapse;table-layout: auto;" >
					<tr>
						<td class="tbl-head" style="width: 20px;">ক্রঃ</td>
						<td class="tbl-head" style="width: 70px;">অর্থ সাল</td>
						<td class="tbl-head">নাম</td>
						<td class="tbl-head" style="width: 50px;">হোল্ডিং নং</td>
						<td class="tbl-head" style="width: 30px;">বই</td>
						<td class="tbl-head" style="width: 60px;">মানি রসিদ</td>
						<td class="tbl-head" style="width: 40px;">ভাউচার</td>
						<td class="tbl-head">বসতভিটার ধরন - পেশা - করের শ্রেনী</td>
						<td class="tbl-head" style="width: 73px;">টাকার পরিমান</td>
					</tr>
					<?php if($report['status'] === 'error'):?>
					<tr height='10'>
						<td colspan="9"><p style="text-indent: 10px;">No record found</p></td>
					</tr>
					<?php else: $sl=1; foreach($report['data'] as $row):?>
					<tr>
						<td class="tbldis"><?php echo $sl++;?></td>
						<td class="tbldis"><?php echo $row->fiscal_year;?></td>
						<td class="tbldis"><?php echo $row->name;?></td>
						<td class="tbldis right"><?php echo $row->holding_no;?></td>
						<td class="tbldis right"><?php echo $row->book_number;?></td>
						<td class="tbldis right"><?php echo $row->money_receipt;?></td>
						<td class="tbldis right"><?php echo $row->invoice;?></td>
						<td class="tbldis"><?php echo $row->rate_sheet_label;?></td>
						<td class="tbldis right"><?php echo number_format($row->amount, 2);?></td>
					</tr>
					<?php endforeach;endif;?>
					<tr>
						<td colspan="7"></td>
						<td class="tbl-head right">মোট টাকার পরিমান</td>
						<td class="tbl-head right"><?php echo number_format($report['total_amount'],2);?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>