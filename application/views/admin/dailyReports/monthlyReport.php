<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
	<head>
		<base href="<?php echo base_url();?>"/>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>মাসিক প্রতিবেদন</title>
		<meta name="robots" content="index, nofollow" />
		<link rel="shortcut icon" href="img/favicon.ico"  type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="reports_css/reports.css"/>
		<link rel="stylesheet" type="text/css" href="reports_css/monthlyreport.css"/>
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
		$monthArray = array(
			'01'	=> 'January',
			'02'	=> 'February',
			'03'	=> 'March',
			'04'	=> 'April',
			'05'	=> 'May',
			'06'	=> 'June',
			'07'	=> 'July',
			'08'	=> 'August',
			'09'	=> 'September',
			'10'	=> 'October',
			'11'	=> 'November',
			'12'	=> 'December'
		);
		$cyearr = date('Y');
		if(isset($_GET['userYear'])):$yearr=$this->input->get('userYear',TRUE);else: $yearr=date('Y'); endif;
		if(isset($_GET['userMonth'])):$monthh=$this->input->get('userMonth',TRUE);else: $monthh=date('m'); endif;
		$query = $this->db->query("select id,fund_id,category from mainctg order by id asc")->result();
		$query2 = $this->db->query("select id,fund,title from exphead order by id asc")->result();

	?>
	<body>
		<div id="bar">
			<div class="barcon">
				<form action="" method="get">
					<p align="right"  style="width: 60%">
						<select name="userYear" id="" style="width: 80px;">
							<option value="<?php echo $cyearr;?>" <?php echo ($yearr==$cyearr)? 'SELECTED':''; ?>><?php echo $cyearr;?></option>
							<?php 
								for($i=1;$i<=4;$i++):
								$val=$cyearr-$i;
							?>
							<option value="<?php echo $val;?>" <?php echo ($val==$yearr)? 'SELECTED':''; ?>><?php echo $val;?></option>
							<?php endfor;?>
						</select>
						<select name="userMonth" id="">
							<?php 
								foreach($monthArray as $key=> $value):
							?>
							<option value="<?php echo $key;?>" <?php echo ($key==$monthh)? "selected" : '';?>><?php echo $value;?></option>
							<?php endforeach;?>
						</select>
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
						<span>মাসিক প্রতিবেদন</span>
					</p>
				</div>
				<div class="fix footer">
					<table cellpadding="0" cellspacing="0" width="97%" style="margin: 0px auto; border-collapse:collapse;table-layout: auto;" >
						
						<tr>
							<td rowspan="2" class="tblhead" style="width: 260px;">বিবরণ</td>
							<td rowspan="2" class="tblhead" style="width: 20px;">টীকা</td>
							<td colspan="3" class="tblhead">নভেম্বর মাস</td>
							<td rowspan="2" class="tblhead">পূর্ববর্তী মাস</td>
						</tr>
						<tr> 
							<td class="tblhead" style="width: 120px;;">নিজস্ব তহবিল টাকা</td>
							<td class="tblhead" style="width: 120px;">উন্নয়ন তহবিল টাকা</td>
							<td class="tblhead" style="width: 80px;">মোট টাকা</td>
						</tr>
						<tr>
							<td class="tbldis">
								<h2 class="table-sub-heading">প্রাপ্তিঃ</h2>
							</td>
							<td class="tbldis"></td>
							<td class="tbldis"></td>
							<td class="tbldis"></td>
							<td class="tbldis"></td>
							<td class="tbldis"></td>
						</tr>
						<?php
							$tika = 0;
							foreach($query as $row):
							++$tika;
							$personal=0.00;
							$develop=0.00;
							$subctgTbl = $this->db->query("select count(mc_id) as total from subctg where mc_id=$row->id")->row()->total;
							$ledgerTbl2 = $this->db->query("select vtype,catid,fundtype,sum(cr) as total from ledger where vtype='C' and catid=$row->id and fundtype=2 and year(payment_date)='$yearr' and month(payment_date)='$monthh'")->row();
							$ledgerTbl1 = $this->db->query("select vtype,catid,fundtype,sum(cr) as total from ledger where vtype='C' and catid=$row->id and fundtype=1 and year(payment_date)='$yearr' and month(payment_date)='$monthh'")->row();
							$preMonth = $this->db->query("select vtype,catid,fundtype,sum(cr) as total from ledger where vtype='C' and catid=$row->id and year(payment_date)='$yearr' and month(payment_date)='$monthh'-1")->row();
						?>
						<tr>
							<td class="tbldis indent"><?php echo $row->category;?></td>
							<td class="tbldis center">
								<a href="DailyReports/incomeTicaInfo?id=<?php echo $row->id;?>&year=<?php echo $yearr;?>&month=<?php echo $monthh; ?>&tika=<?php echo $tika; ?>" target="_blank">
									<?php if($subctgTbl >=2): echo $tika; endif;?>
								</a>
							</td>
							<td class="tbldis right">
								<?php 
									$personal = $ledgerTbl2->total; 
									$totalPersonal += $personal;
									echo number_format($personal,2);
								?>
							</td>
							<td class="tbldis right">
								<?php 
									$develop = $ledgerTbl1->total;
									$totalDevelop += $develop;
									echo number_format($develop,2);
								?>
							</td>
							
							
							<td class="tbldis right">
								<?php 
									$pdtotal = $personal+$develop; 
									$allpdTotal +=$pdtotal;
									echo number_format($pdtotal,2);
								?>
							</td>
							<td class="tbldis right">
								<?php
									$oldMonth = $preMonth->total;
									$totalOldMonth += $oldMonth;
									echo number_format($oldMonth,2);
								?>
							</td>
						</tr>
						<?php endforeach;?>
						<tr>
							<td class="tblhead">মোট টাকার পরিমান</td>
							<td class="tblhead"></td>
							<td class="tblhead right"><?php echo number_format($totalPersonal,2);?></td>
							<td class="tblhead right"><?php echo number_format($totalDevelop,2);?></td>
							<td class="tblhead right"><?php echo number_format($allpdTotal,2);?></td>
							<td class="tblhead right"><?php echo number_format($totalOldMonth,2);?></td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" width="97%" style="margin: 2px auto; border-collapse:collapse;table-layout: auto;" >
					
						<tr>
							<td class="tbldis"  style="width: 264px;">
								<h2 class="table-sub-heading">ব্যয়ঃ</h2>
							</td>
							<td class="tbldis" style="width: 30px;"></td>
							<td class="tbldis" style="width: 124px;"></td>
							<td class="tbldis" style="width: 124px;"></td>
							<td class="tbldis" style="width: 84px;"></td>
							<td class="tbldis"></td>
						</tr>
						<?php
							foreach($query2 as $row2):
							$expPersonal=0.00;
							$expDevelop=0.00;
							$expTbl = $this->db->query("select count(pid) as total from expurpose where pid=$row2->id")->row()->total;
							$ledgerTbl4 = $this->db->query("select vtype,catid,fundtype,sum(dr) as total from ledger where vtype='D' and catid=$row2->id and fundtype=2 and year(payment_date)='$yearr' and month(payment_date)='$monthh'")->row();
							$ledgerTbl3 = $this->db->query("select vtype,catid,fundtype,sum(dr) as total from ledger where vtype='D' and catid=$row2->id and fundtype=1 and year(payment_date)='$yearr' and month(payment_date)='$monthh'")->row();
							$expPreMonth = $this->db->query("select vtype,catid,fundtype,sum(dr) as total from ledger where vtype='D' and catid=$row2->id and year(payment_date)='$yearr' and month(payment_date)='$monthh'-1")->row();
						?>
						<tr>
							<td class="tbldis indent"><?php echo $row2->title; ?></td>
							<td class="tbldis center"><?php if($expTbl >=2): echo ++$tika; endif;?></td>
							<td class="tbldis right">
								<?php 
									$expPersonal = $ledgerTbl4->total; 
									$expTotalPersonal += $expPersonal;
									echo number_format($expPersonal,2);
								?>
							</td>
							<td class="tbldis right">
								<?php 
									$expDevelop = $ledgerTbl3->total;
									$expTotalDevelop += $expDevelop;
									echo number_format($expDevelop,2);
								?>
							</td>
							<td class="tbldis right">
								<?php 
									$expPdtotal = $expPersonal+$expDevelop; 
									$expAllpdTotal +=$expPdtotal;
									echo number_format($expPdtotal,2);
								?>
							</td>
							<td class="tbldis right">
								<?php
									$oldMonth = $expPreMonth->total;
									$expTotalOldMonth += $oldMonth;
									echo number_format($oldMonth,2);
								?>
							</td>
						</tr>
						<?php endforeach;?>
						<tr>
							<td class="tblhead">মোট টাকার পরিমান</td>
							<td class="tblhead"></td>
							<td class="tblhead right"><?php echo number_format($expTotalPersonal,2);?></td>
							<td class="tblhead right"><?php echo number_format($expTotalDevelop,2);?></td>
							<td class="tblhead right"><?php echo number_format($expAllpdTotal,2);?></td>
							<td class="tblhead right"><?php echo number_format($expTotalOldMonth,2);?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>