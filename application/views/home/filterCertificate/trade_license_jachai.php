<?php 
	extract($_GET);
	$id=chop($id,'/');
	$query=$this->db->select('*')->from('tradelicense')->where('sha1(sno)',$id)->get();
	$row=$query->row();
	$lQy=$this->db->select('*')->from('getlicense')->where('trackid',$row->trackid)->order_by('id','DESC')->limit(1)->get();
	$lrow=$lQy->row();
	$expire_date = $row->expire_date;
	$current_date = date("Y-m-d");
	if($current_date >= $expire_date ){
		$expire_style="background-color: #ddd; opacity: 0.3;";
	}
	
	
	// for expaire year............
	$expire_date_show = date('Y',strtotime($row->expire_date));
	$expire_full_date_show = date('d-m-Y',strtotime($row->expire_date));
	
	// for Financial year.....
	$second_year=$expire_date_show;
	$first_year=$expire_date_show-1;
?>
<html>
	<head>
		<base href="<?php echo base_url() ?>">
		<meta charset="utf-8">
	</head>
	<body>
		<div style="<?php echo $expire_style;?>"> 
			<table  height="120px" border="0px"  style="width:100%;margin:0px auto;" cellspacing="0" cellpadding="0">
				<tr>
					<td style="width:1.5in; text-align:center;"><img src="logo_images/logo.png" height="80px" width="80px"/></td>
					<td style="text-align:center;height:60px;font-family:SolaimanLipi;thoma;"><font style="font-size:21px;letter-spacing:2px; font-weight:bold; color:blue; width:5.5in;"><?php echo $all_data->full_name;?></font>  <br />
						<font style="font-size:12px; font-weight:bold;"><?php echo $all_data->gram;?> <br />
						<?php 
							$ch=$this->db->count_all('setup_tbl');
							if($ch!=0):
						?>
						<?php echo $all_data->thana;?>,&nbsp;<?php echo $all_data->district;?>-<?php echo $all_data->postal_code;?> <br />
						ফোন : <?php echo $all_data->phone;?>,&nbsp;<?php echo $all_data->mobile;?></font>
						<?php 
							endif;
						?>
					</td>
					<td style="width:1.5in;">
						<img src="<?php echo $row->profile;?>" height="80px" width="80px"/>
					</td>
				</tr>
			</table>
			<table height="50px" align="center" border="0" style="border-collapse:collapse;margin:0px auto; " cellpadding="0" cellspacing="0">
				<tr>
					<td><b style="font-size:18px; font-weight:bold;"><u>TRADE LICENSE (ট্রেড লাইসেন্স)</u></b></td>
				</tr>
			</table>
			<div class="clearfix"></div>
			<table  border="1px" style="width:100%;margin:0px auto;" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:20%;font-size:15px; text-align:center; font-weight:normal;">ট্রেড লাইসেন্স  নং :</td>
					<?php $fsonod=str_split($row->sno);
						for($i=0;$i<strlen($row->sno);$i++){?>	
						<td style="text-align:center; font-weight:bold;font-size:15px; "><?php echo $this->web->ceb($fsonod[$i])?></td>
					<?php }?>
				</tr>
			</table>
				
			<table  height="32px" border="0" style="width:100%;margin-top:10px;" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:30px;"></td>
					<td style=" font-size:16px; font-weight:bold;">ক্রমিক নং </td>
					<td style=" font-size:16px; font-weight:bold;">:&nbsp;<?php echo $this->web->banDate($lrow->bno)?></td>
					<td style=" font-size:16px; text-align:center; font-weight:bold;">ইস্যুকৃত তারিখ</td>
					<td style=" font-size:16px; font-weight:bold;">: &nbsp;<?php echo $this->web->banDate($row->issue_date);?></td>
					<td style=" font-size:16px; text-align:center; font-weight:bold;">মেয়াদকাল</td>
					<td style=" font-size:16px; font-weight:bold;">:&nbsp; <?php echo $this->web->banDate($row->expire_date);?> </td>
				</tr>
			</table>
				
				<?php 
					if($row->ownertype=="1"){
				?>
			<table width="99%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin:10px auto; ">
					<tr>
						<td style="width:160px; text-align:left;padding-left:30px; font-size:17px;">মালিকের নাম</td>
						<td  style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp; <?php echo $row->bwname;?></td>
					</tr>
					
					<?php 
						if(($row->gender=='female')&&($row->mstatus=='বিবাহিত')){
						?>
					<tr>
						<td style="width:160px; text-align:left;padding-left:30px; font-size:17px;">স্বামীর নাম</td>
						<td style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp; <?php echo  $row->bhname;//$row->bfname;?></td>
					</tr>
						<?php
						}else{
					?>
					
					
					<tr>
						<td style="width:160px; text-align:left;padding-left:30px; font-size:17px;">পিতার নাম</td>
						<td style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp; <?php echo  $row->bfname;//$row->bfname;?></td>
					</tr>
					<?php 
						}
					?>
					
					<tr>
						<td style="width:160px; text-align:left;padding-left:30px; font-size:17px;">মাতার নাম</td>
						<td  style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp; <?php echo $row->bmane;//$row->bmane;?></td>
					</tr>
					
					<tr>
						<td style="width:160px; text-align:left;padding-left:30px; font-size:17px; font-weight:bold;">
						<td style="font-weight:bold; font-size:18px; text-align:left;"></td>
					</tr>
					
			</table>
			<?php 
				}else{
			?>
			
			
			
			<table width="95%" cellpadding="0" cellspacing="0" border="1px" style="border-collapse:collapse;margin:10px auto;table-layout: fixed;height:75px;border:1px solid lightgray;" >
					<tr>
						<th style="padding-left:10px;font-weight:bold;text-align:left;font-size:16px;">মালিকের নাম</th>
						<th  style="padding-left:10px;font-weight:bold;text-align:left;font-size:16px;">পিতা/স্বামীর নাম</th>
						<th  style="padding-left:10px;font-weight:bold;text-align:left;font-size:16px;">মাতার নাম</th>
					</tr>
					<?php 
				  $name= $row->bwname;
				  $namef= $row->bfname;
				  $namem= $row->bmane;
				  $bhname1=$row->bhname;
				  $gender1=$row->gender;
				  $mstatus1=$row->mstatus;
					  
					$name1=explode(",",$name);
					
					$namef1=explode(",",$namef);
					$namem1=explode(",",$namem);
					$bhname2=explode(",",$bhname1);
					//print_r($bhname2);
					
					$gender2=explode(",",$gender1);
					$mstatus2=explode(",",$mstatus1);
					//print_r($mstatus2);
					//echo "<pre>";
					//print_r($name1);
					 $count=count($name1);
					 $k=1;
					for($i=0;$i<$count;$i++){
					
				?>
					
					<tr>
						<td style="padding-left:10px;font-size:15px;font-weight:normal;text-align:left;"><?php echo $name1[$i]; ?></td>
						<?php 
							//print_r($gender2[$i]);
							//print_r($mstatus2[$i]);
							//echo $bhname2[$i]."<br>" ;
							if(($gender2[$i]=='female')&&($mstatus2[$i]=='বিবাহিত')){
								if( !isset($temp) ):
									$temp = $i;
								endif;
						?>
						
						<td style="padding-left:10px;font-size:15px;font-weight:normal;text-align:left;"><?php echo $bhname2[$k] ." (স্বামী)"; ?></td>
						
						<?php 
							$k++;
							}else{
							?>
						
						<td style="padding-left:10px;font-size:15px;font-weight:normal;text-align:left;"><?php if( isset($temp) ):echo $namef1[$temp] ."  (পিতা)";$temp++;else:echo $namef1[$i] ."  (পিতা)";endif; ?></td>
						<?php 
							}
						?>
						
						<td style="padding-left:10px;font-size:15px;font-weight:normal;text-align:left;"><?php echo $namem1[$i] ?></td>
					</tr>
					<?php 
					}
					?>
							
					
			</table>
			
			
			<?php 
				}
			?>
			
			<table width="99%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin:10px auto; ">
			
				<tr>
					<td style="width:250px; text-align:left; font-size:18px;"></td>
					<td style="font-weight:normal; font-size:18px; text-align:left;"> </td>
				</tr>
				
				<tr>
					<td style="padding-left:30px;text-align:left; font-size:17px;">ব্যবসা প্রতিষ্ঠানের নাম</td>
					<td style="font-weight:bold; font-size:18px; text-align:left;">: &nbsp; <?php echo $row->bcomname;?></td>
				</tr>
				<?php 
					if($row->ownertype=="3"){
				?>
				<tr>
					<td style="padding-left:30px;text-align:left; font-size:17px;">পরিশোধিত মূলধন (লিঃ কো: ক্ষেত্রে) </td>
					<td style="font-weight:bold; font-size:20px; text-align:left;">: &nbsp;<?php echo $this->web->conArray($row->pay_amount)?></td>
				</tr>
				<?php

					}
					?>
				<tr>
					<td style="padding-left:30px; text-align:left; font-size:17px;">ব্যবসা প্রতিষ্ঠানের ঠিকানা</td>
					<td style="font-weight:bold; font-size:18px; text-align:left;">
						:&nbsp;&nbsp;&nbsp;<?php echo $row->bb_gram;?>,&nbsp;&nbsp;<?php echo $row->bb_rbs;?>,&nbsp;&nbsp;<?php echo $row->bb_postof;?>,&nbsp;&nbsp;<?php echo $row->bb_thana;?>,&nbsp;&nbsp;<?php echo $row->bb_dis."&nbsp;&nbsp;। ওয়ার্ড নং-".$row->bb_wordno;?>
					</td>
				</tr>
				
				<tr>
					<td style="padding-left:30px; text-align:left; font-size:17px;">মোবাইল </td>
					<td style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;&nbsp; <?php echo $row->mobile;?></td>
				</tr>
				<?php 
					if($row->email!=''){
				?>
				
				<tr>
					<td style="padding-left:30px; text-align:left; font-size:17px;"> ইমেইল (যদি থাকে)</td>
					<td style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;&nbsp;  <?php echo $row->email;?></td>
				</tr>
				<?php 
					}
				?>
				
				<tr>
					<td style="padding-left:30px; text-align:left; font-size:17px;">ব্যবসার ধরন</td>
					<td  style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;&nbsp; <?php echo $row->btype;?></td>
				</tr>
				
				<tr>
					<td style="padding-left:30px; text-align:left; font-size:17px; ">ট্রেড লাইসেন্স/নবায়ন ফি(বার্ষিক) </td>
					<td style="font-weight:bold; font-size:18px; text-align:left; ">:&nbsp; <?php echo $this->web->conArray($lrow->fee)?>টাকা &nbsp;</td>
				</tr>
				
				
				<tr>
					<td style="padding-left:30px; text-align:left; font-size:17px;">সাইনবোর্ড কর(বার্ষিক) </td>
					<td style="font-weight:bold; font-size:18px; text-align:left;">: &nbsp; <?php echo $this->web->conArray($lrow->sbfee)?> &nbsp;টাকা </td>
				</tr>
				
				<tr>
					<td style="padding-left:30px; text-align:left; font-size:17px;">ভ্যাট</td>
					<td style="font-weight:bold; font-size:18px; text-align:left;">: &nbsp; <?php echo $this->web->conArray($lrow->vat)?> &nbsp;টাকা </td>
				</tr>
			</table>
		
			<table cellpadding="0" cellspacing="0" border="0px" width="99%" style="border-collapse:collapse;margin:20px auto;">
				<tr>
					<td colspan="2" style="padding-left:20px;font-size:16px;">লাইসেন্সধারীর নিকট হইতে সকল বকেয়া পাওনা বিবিধ রশিদ নম্বর-<?php echo $this->web->conArray($lrow->vno);?> &nbsp;তাং &nbsp;<?php echo $this->web->banDate(date($row->issue_date)); ?> &nbsp;এর মাধ্যমে আদায় করিয়া&nbsp;&nbsp; <?php echo $this->web->banDate($first_year);?>-<?php echo $this->web->banDate($second_year);?> অর্থসালের জন্য ইউনিয়ন পরিষদের সীমার মধ্যে বৈধ ব্যবসা  করার অনুমতি দেওয়া হইল।</td>
				</tr>	
			</table>	
		</div>
		
		<?php if($current_date >= $expire_date ){?>
		<div class="message_div"> 
			<img src="img/expired/expired_5.png" alt="Expired tradelicense" />
		</div>
		<?php }?>
		
	</body>
	<style type="text/css"> 
		div.message_div{
			position: absolute;
			top: 42%;
			left: 35%;
			opacity: 0.9;
			z-index: 99999;
		}
	</style>
</html>