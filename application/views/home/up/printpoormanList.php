<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Print Poorman List</title>
	<style type="text/css"> 
		*{
			margin: 0px;
			padding: 0px;	
		}
		body{
			margin:0px;
			padding:0px;
			background-color:lightgray;
			font-family:solaimanLipi;
			font-size: 14px;
		}
		#main{
			min-height: 10.90in;;
			width: 8.3in;
			padding: 10px;
			background-color: #FFFFFF;
			margin: 0px auto;
			border: 0px solid red;
			overflow: hidden;
			display: table;
			clear: both;
		}
		#muri{
			height: 1.30in;
			width:8.38in;
			float: left;
			border:0px solid green;
			overflow: hidden;
			display: block;
		}
		#mydiv table tr td,th{
			border: 1px solid black;
		}
		@media print
			{  
				body{
					background-color: #FFFFFF !important;
				}
				.no-print, .no-print *
				{
					visibility:hidden;
					display: none;
				}
				table{
					background:none !important;
				}
			}
	</style>
</head>
<body>
	<div id="main"> 
		<div id="muri">
			<div style="background:#666;margin: 0px;padding: 0px;" align="center" id="bar" class="no-print">
					<a href="<?php echo base_url();?>" style="margin-right:50px;" title="Back Home Page">
						<img src="<?php echo base_url();?>img/home.png">
					</a>
				<a  target='_blank' href="javaScript:window.print();">
					<img src="<?php echo base_url();?>library/print.png"/>
				</a>
			</div>
			<table border="0px" width="100%" height="55px" cellspacing="0"  cellpadding="0" style="border-collapse:collapse;table-layout: fixed;">
				<tr>
					<td style="width: 1.5in; text-align:right;"></td>
					<td style="text-align:center;">
						<div class="headding-main"> 
							<font style="font-size: 120%; font-weight:bold; color:blue;"><?php echo $all_data->full_name;?></font>  <br />
							<font style="font-size: 80%; font-weight:bold;">
								<?php 
									$ch=$this->db->count_all('setup_tbl');
									if($ch!=0):
								?>
								<?php echo $all_data->thana;?>,&nbsp;<?php echo $all_data->district;?>-<?php echo $all_data->postal_code;?> <br />
								ওয়েব সাইট : <?php echo $all_data->web_link;?>
								<p style="font-size: 120%;font-weight: bold;text-decoration:underline;">দুস্থ / হতদরিদ্রদের তালিকা</p>
							</font>
							<?php 
								endif;
							?>
						</div>
					</td>
					<td style="width: 1.5in;"></td>
				</tr>
			</table>
		</div>
		<div id="mydiv"> 
			<table cellspacing='0' cellpadding="2" width="100%" border="0" style="text-indent:20px;border-collapse:collapse;"> 
				<tr>
					<th>ক্রমিক নং</th>
					<th>ন্যাশানাল আইডি</th>
					<th>নাম</th>
					<th>পিতার/ স্বামীর নাম</th>
					<th>ওয়ার্ড নং</th>
					<th>বয়স</th>
				</tr>
				<?php
					$num=0;
					$current_year=date("Y");
					foreach($poormans_record as $value):
					$num++;
				?>
				<tr>
					<td><?php echo $num;?></td>
					<td><?php echo @$value->national_id;?></td>
					<td><?php echo @$value->bangla_name;?></td>
					<td><?php echo @$value->father_name;?></td>
					<td><?php echo @$value->word_no;?></td>
					<td>
						<?php
							$age=date("Y",strtotime($value->date_of_birth));
							echo $show_age=$current_year-$age;
						?>
					</td>
				</tr>
				<?php 
					endforeach;
				?>
			</table>
		</div>
	</div>
</body>
</html>