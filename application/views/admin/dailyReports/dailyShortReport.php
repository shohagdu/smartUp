<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
	<head>
		<base href="<?php echo base_url();?>"/>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>দৈনিক ট্রেড লাইসেন্স প্রতিবেদন</title>
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
			
			var pickerOpts1 = {
				dateFormat: $.datepicker.ATOM
				};	
				$("#fromdate").datepicker(pickerOpts);
			});
		</script>
	</head>
	<?php
		// some execution here........
		extract($_GET);
		$cDate=$this->input->get('cDate',TRUE);if (empty($cDate)) $cDate=date('Y-m-d');
		
		$query = $this->db->query("select m.trackid, m.fee, m.vat, m.status, m.payment_date ,t.sno, t.bcomname, t.bwname  from money as m left  join tradelicense as t on t.trackid=m.trackid where m.status in(1) and date(payment_date)='$cDate' order by inno")->result();

	?>
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
						<span>দৈনিক ট্রেড লাইসেন্স হিসাব</span>
					</p>
				</div>
				<div class="fix footer">
					<table cellpadding="0" cellspacing="0" width="97%" style="margin: 0px auto; border-collapse:collapse;table-layout: auto;" >
						<tr>
							<td colspan="5" class="tbltophead">
								<h2>দৈনিক ট্রেড লাইসেন্স হিসাব</h2>
							</td>
							<td colspan="3" class="tbltophead">
								<h3>তারিখঃ  <?php echo $this->web->banDate($cDate);?></h3>
							</td>
						</tr>
						<tr>
							<td class="tblhead" style="width: 20px;" >ক্রঃ নং</td>
							<td class="tblhead">প্রতিষ্ঠানের নাম</td>
							<td class="tblhead">মালিকের নাম</td>
							<td class="tblhead" style="width: 80px;">লাইসেন্স ফি</td>
							<td class="tblhead" style="width: 50px;">ভ্যাট</td>
							<td class="tblhead" style="width: 80px;">পেশাজীবী কর</td>
							<td class="tblhead" style="width: 60px;">বসতভিটা কর</td>
							<td class="tblhead" style="width: 60px;">সর্বমোট</td>
						</tr>
						<?php 
							$nr=1;
							$totalFee = 0;
							$totalVat = 0;
							$totalPesa = 0;
							$totalbosot = 0;
							$totalTotal = 0;
							foreach($query as $row):
							$trackid = $row->trackid;
							$wh1=array("status"=>3, "trackid"=>$trackid, "date(payment_date)"=>"$cDate");
							$wh2=array("status"=>2, "trackid"=>$trackid, "date(payment_date)"=>"$cDate");
							$query3=$this->db->get_where("money",$wh1);
							$aff3=$this->db->affected_rows();
							
							$query4=$this->db->get_where("money",$wh2);
							$aff4=$this->db->affected_rows();
							
							if($aff3==FALSE && $aff4==FALSE){
								$pesaTaka = '0.00';
								$bosotTaka = '0.00';
							}
							else if($aff3==TRUE && $aff4 == FALSE){
								$pesaTaka = $query3->row()->total;
								$bosotTaka = '0.00';
							}
							else if($aff3==FALSE && $aff4 == TRUE){
								$pesaTaka = '0.00';
								$bosotTaka = $query4->row()->total;
							}
							else if($aff3==TRUE && $aff4 == TRUE){
								$pesaTaka = $query3->row()->total;
								$bosotTaka = $query4->row()->total;
							}
							else {
								$pesaTaka = '0.00';
								$bosotTaka = '0.00';
							}
						?>
						<tr>
							<td class="tbldis"><?php echo $nr;?>  </td>
							<td class="tbldis"><?php echo $row->bcomname;?></td>
							<td class="tbldis"><?php echo $row->bwname;?></td>
							<td class="tbldis right"><?php $totalFee += $row->fee; echo $tempFee = $row->fee;?></td>
							<td class="tbldis right"><?php $totalVat += $row->vat;echo $tempVat = $row->vat;?></td>
							<td class="tbldis right"><?php $totalPesa += $pesaTaka; echo $pesaTaka;?></td>
							<td class="tbldis right"><?php $totalbosot += $bosotTaka; echo $bosotTaka;?></td>
							<td class="tbldis right"><?php $total = $tempFee+$tempVat+$pesaTaka+$bosotTaka; $totalTotal += $total; echo $total;?></td>
						</tr>
						<?php $nr++;endforeach;?>
						
						<tr>
							<td class="tblhead">**</td>
							<td class="tblhead">মোট টাকার পরিমান</td>
							<td class="tblhead">=</td>
							<td class="tblhead right"><?php echo number_format($totalFee,2);?></td>
							<td class="tblhead right"><?php echo number_format($totalVat,2);?></td>
							<td class="tblhead right"><?php echo number_format($totalPesa,2);?></td>
							<td class="tblhead right"><?php echo number_format($totalbosot,2);?></td>
							<td class="tblhead right"><?php echo number_format($totalTotal,2);?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>