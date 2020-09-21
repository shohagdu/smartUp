<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php 
	extract($_GET);
	print_r($_GET);
	$title = $this->db->query("select * from mainctg where id=$id")->row()->category;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
	<head>
		<base href="<?php echo base_url();?>"/>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title><?php echo $title;?></title>
		<meta name="robots" content="index, nofollow" />
		<link rel="shortcut icon" href="img/favicon.ico"  type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="reports_css/reports.css"/>
		<link rel="stylesheet" type="text/css" href="reports_css/monthlyreport.css"/>
		<link rel="stylesheet" media="screen,projection" type="text/css" href="datepicker/jquery-ui.css" />
		<script src="datepicker/jquery-1.9.1.js"></script>
		<script src="datepicker/jquery-ui.js"></script>
	</head>
	<?php
		// some execution here.....
		$query = $this->db->query("select * from subctg where mc_id=$id order by id asc")->result();

	?>
	<body>
	
		<div class="fix stracture wrapper1"> 
			<div class="fix top-side">
				
				<div class="fix footer">
					<div style="text-indent: 10px;">
						<p> 
							<span><?php echo $tika;?>. <?php echo $title;?> : </span>
						</p>
					</div>
					<table cellpadding="0" cellspacing="0" width="97%" style="margin: 0px auto; border-collapse:collapse;table-layout: auto;" >
						
						<tr>
							<td class="tblhead" style="width: 260px;">বিবরণ</td>
							<td class="tblhead" style="width: 120px;;">নিজস্ব তহবিল টাকা</td>
							<td class="tblhead" style="width: 120px;">উন্নয়ন তহবিল টাকা</td>
							<td class="tblhead" style="width: 80px;">মোট টাকা</td>
							<td class="tblhead">পূর্ববর্তী মাস</td>
						</tr>
						<?php
							foreach($query as $row):
							$personal=0.00;
							$develop=0.00;
							$ledgerTbl2 = $this->db->query("select vtype,catid,fundtype,sum(cr) as total from ledger where vtype='C' and catid=$row->mc_id and fundtype=2 and year(payment_date)='$year' and month(payment_date)='$month'")->row();
							$ledgerTbl1 = $this->db->query("select vtype,catid,fundtype,sum(cr) as total from ledger where vtype='C' and catid=$row->mc_id and fundtype=1 and year(payment_date)='$year' and month(payment_date)='$month'")->row();
							$preMonth = $this->db->query("select vtype,catid,fundtype,sum(cr) as total from ledger where vtype='C' and catid=$row->mc_id and year(payment_date)='$year' and month(payment_date)='$month'-1")->row();
						?>
						<tr>
							<td class="tbldis indent"><?php echo $row->sub_title;?></td>
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
							
							<td class="tblhead right"><?php echo number_format($totalPersonal,2);?></td>
							<td class="tblhead right"><?php echo number_format($totalDevelop,2);?></td>
							<td class="tblhead right"><?php echo number_format($allpdTotal,2);?></td>
							<td class="tblhead right"><?php echo number_format($totalOldMonth,2);?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>