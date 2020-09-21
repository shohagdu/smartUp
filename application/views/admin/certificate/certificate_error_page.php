<html>
	<head>
		<base href='<?php echo base_url();?>'/>
		<meta charset="utf-8">
		<title><?php echo $title;?></title>
		<link rel="stylesheet" type="text/css" href="certificate_css/nagorik.css">
		<style>
			@media print
			{    
				.no-print, .no-print *
				{
					visibility:hidden;
					
				}
				table{
					background:none;
				}	
			}
		</style>
	</head>
	<body>
		<div id="main" style="height:12.2in;width:8.5in;">
			<div id="main_second" style="height:12.2in;width:8.5in;">
				
				<div class="wrapper jolchap"  style="margin-top:3px;height:11.69in;width:8.2in">
					<div id="cert" style="height:11.69in;width:8.2in">
			 
						<table border="0px" width="98%" height="125px;" align="center"   style="border-collapse:collapse; margin:2px auto;"  >
							<tr>
								<td <?php if($logo==0) { ?> class="no-print" <?php } ?> style="width:1.5in; text-align:center;"><img src="logo_images/logo.png"height="100px" width="100px"/></td>
								<td <?php if($header==0) { ?> class="no-print" <?php } ?>  style="text-align:center;"><font style="font-size:20px;word-spacing: 4px;letter-spacing: 2px; font-weight:bold; color:blue;"><?php echo $all_data->full_name;?></font>  <br />
									<font style="font-size:12px; font-weight:bold;">
									<?php 
										$ch=$this->db->count_all('setup_tbl');
										if($ch!=0):
									?>
										<?php echo (!empty($all_data->gram) ? $all_data->gram. ', ' : '').(!empty($all_data->postal_code) ? 'পোস্টাল কোড: '. $this->web->banDate($all_data->postal_code). ', ' : '').(!empty($all_data->thana) ? 'উপজেলাঃ ' . $all_data->thana . ', '  : '').(!empty($all_data->district) ? 'জেলাঃ ' . $all_data->district : '');?>
										<br />
										<?php echo (!empty($all_data->mobile) ? 'মোবাইল: '. $this->web->banDate($all_data->mobile) . ', ' : '').(!empty($all_data->phone) ? $this->web->banDate($all_data->phone) : '');?> <br />
										 <?php echo (!empty($all_data->web_link) ? 'ওয়েব সাইট: ' . $all_data->web_link : '');?></font>
									<?php 
										endif;
									?>
								</td>
								<td style="width:1.5in; text-align:center;"></td>
							</tr>
						</table>

							<!----header div close here---->
			 
						 <table border="0px" width="98%" height="38px" style="border-collapse:collapse;margin:2px auto;" cellspacing="0" cellpadding="0" >
							<tr>
								<td style="text-align:center;"><font style="font-weight:bold; font-size:22px;"><u><?php echo $title;?></u></font></td>
							</tr>
						 </table>
			 
						 <div id="sonod_number">
						 
							<table border='0' align="center" height="25px" style="width:96%; border-color:lightgray;border-collapse:collapse;margin-top:10px;" cellpadding="0" cellspacing="0">
								<tr>
									<td>
										<p style="color: red; text-align: center; font-weight: bold;"><?php echo $message;?></p>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>