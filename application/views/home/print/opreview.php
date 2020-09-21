<script>
	window.onbeforeunload = function(){ return 'আপনি যদি পেজটি  Reload দেন তাহলে আপনাকে নতুন করে ডাটা এন্ট্রি দিতে হবে.';};
</script>
<?php
if(isset($_GET['scode'])){$scode=$this->input->get('scode',TRUE);}
else if(isset($_GET['pcode'])){ $scode=$this->input->get('pcode',TRUE); }
else {$scode=$this->session->userdata('sCode');}
$scode=chop($scode,'/');
$query=$this->db->select('*')->from('otherserviceinfo')->where('trackid',$scode)->get();
$row=$query->row();
$serviceId = $row->serviceId;
$query2=$this->db->select('listName')->from('otherservicelist')->where('id',$serviceId)->get()->row();
$listName = $query2->listName;
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
<base href="<?php echo base_url();?>">
	<meta charset="UTF-8">
	<title><?php echo $listName;?> এর আবেদন পত্র</title>
	<link rel="stylesheet" type="text/css" href="certificate_css/citizen.css" media="all" />
	<link href="certificate_css/print_for.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div style="left:300px;top:5px;position:middle;background:#666;" align="center" id="bar">
	<?php if($this->session->userdata('sCode')){?>
		<a href="" style="margin-right:50px;" title="Back Home Page">
			<img src="<?php echo base_url();?>img/home.png">
		</a>
	<?php }?>
	<a  target='_blank' href="<?php if($this->session->userdata('sCode') || ($_GET['pcode'])){?>javaScript:window.print();<?php } if(isset($_GET['scode'])){?>home/ppreview?pcode=<?php echo $scode;}?>">
		<img src="<?php echo base_url();?>library/print.png"/>
	</a>
</div>
<br/>
	<div class="full"> 
		<div id="wrapper" <?php if(isset($_GET['scode'])){?>style="width:700px;"<?php }?>>
						<!-----------top area start--------------->
			<div class="top_area" <?php if(isset($_GET['scode'])){?> style="width:683px;" <?php }?>>
				<div class="fix structure top_section">
					<div id="top_left">
						<img src="logo_images/logo.png" alt="logo" height="130px" width="130px" />
					</div>
					<div id="top_mid">
						<h2><?php echo $all_data->full_name;?></h2>
						<p><?php echo $all_data->gram;?>  <br />
						
						<?php 
							$ch = $this->db->count_all('setup_tbl');
							if($ch!=0):
						?>
							<?php echo $all_data->thana;?>,&nbsp;<?php echo $all_data->district;?>-<?php echo $all_data->postal_code;?><br />
							ফোন :  <?php echo $all_data->phone;?>,&nbsp;<?php echo $all_data->mobile;?>
						</p>
						
						<?php 
							endif;
						?>
						
					</div>
					<div id="top_right">
						<img src="<?php echo $row->profile?>" alt="image" />
					</div>
				</div>
			</div>
						<!-----------top area end--------------->
						
						
						<!-----------header area start--------------->
			<div class="header_area">
				<div class="fix structure header_section"> 
					<h2><?php echo $listName;?>  এর আবেদন  পত্র </h2>
					<span> আবেদনের তারিখ: <input type="text" name="" id="" readonly value="<?php $cdate=date('d/m/Y',strtotime($row->insert_time));echo $this->web->banDate($cdate);?>"/></span>
				</div>
			</div>
				<!-----------header area end--------------->
			
				<!-----------application area start--------------->
			
			<div class="app_area">
				<div class="fix structure app_section">
					<div id="app_section_left">
						<form>
							<p> ট্রেকিং আইডি নং - </p><span> <input type="text" name="tra_no" id="" readonly value='<?php echo $row->trackid;//echo $this->web->conArray($row->trackid);?>' <?php if(isset($_GET['scode'])){?>style="left:-80px;"<?php }?>/> </span>
						</form>
					</div>
					<div id="app_section_right">
						<table class="table1">
							<tr>
								<td>&nbsp; নাম (বাংলা)</td>
								<td colspan="3" style="border-left:none;border-bottom:none;"><span>&nbsp;:&nbsp;<?php echo $row->name?></span></td>
							</tr>
							<tr>
								<td>&nbsp; নাম  (ইংরেজী)</td>
								<td colspan="3" style="border-left:none;"><span>&nbsp;:&nbsp;<?php echo ucfirst($row->ename)?></span></td>
							</tr>
				
							
							
							<?php 
								if(($row->gender=='female') && ($row->mstatus==1)){
									?>
							<tr>
								<td>&nbsp;স্বামীর নাম</td>
								<td colspan="3" style="border-left:none;"><span>&nbsp;:&nbsp; <?php echo $row->bhname?></span></td>
							</tr>
							
							<?php 
							}else{
							?>
							<tr>
								<td>&nbsp;পিতারন নাম</td>
								<td colspan="3" style="border-left:none;"><span>&nbsp;:&nbsp; <?php echo $row->bfname?></span></td>
							</tr>
							
							<?php 
							}
							?>
							
							
							
							
							<tr>
								<td>&nbsp;মাতার নাম</td>
								<td colspan="3" style="border-left:none;border-bottom:none;"><span>&nbsp;:&nbsp;<?php echo $row->mname?></span></td>
							</tr>
							<tr>
								<td>&nbsp;জন্ম তারিখ </td>
								<td style="border-left:none;"><span>&nbsp;:&nbsp;<?php $Cdate=$row->dofb;echo $this->web->banDate($Cdate);?></span></td>
								<td style="border-left:none; border-right:none;">ন্যাশনাল আইডি কার্ড নং </td>
								<td style="border-left:none;"><span>&nbsp;:&nbsp;<?php echo $this->web->banDate($row->nationid);?></span></td>
							</tr>
							<tr>
								<td>&nbsp;ধর্ম</td>
								<td style="border-left:none;"><span>&nbsp;:&nbsp;<?php echo $row->religion?></span></td>
								<?php 
									if($listName=='মুক্তিযোদ্ধা সনদ' || $listName=='মুক্তিযোদ্ধা ওয়ারিশ সনদ'){
								?>
								<td style="border-left:none;">সেক্টর নং </td>
								<td style="border-left:none;"><span>&nbsp;:&nbsp;<?php echo $this->web->banDate($row->sector_no);?></span></td>
								<?php }else{?>
								<td style="border-left:none;">জন্মসনদ নং </td>
								<td style="border-left:none;"><span>&nbsp;:&nbsp;<?php echo $this->web->banDate($row->bcno);?></span></td>
								<?php }?>
							</tr>
							<tr>
								<td>&nbsp;বৈবাহিক অবস্থা </td>
								<td style="border-left:none;"><span>&nbsp;:&nbsp;<?php if($row->mstatus=='1') echo 'বিবাহিত'; 
										if($row->mstatus=='2') echo 'অবিবাহিত'; ?></span></td>
										
								<?php 
									if($listName=='মুক্তিযোদ্ধা সনদ' || $listName=='মুক্তিযোদ্ধা পোষ্য সনদ'){
								?>
								<td style="border-left:none;border-bottom:none;">মুক্তিবার্তা নং </td>
								<td style="border-left:none;border-bottom:none;"><span>&nbsp;:&nbsp;<?php echo $this->web->banDate($row->mukti_sonod)?></span></td>
								<?php }else{?>
								<td style="border-left:none;border-bottom:none;">পাসপোর্ট নং </td>
								<td style="border-left:none;border-bottom:none;"><span>&nbsp;:&nbsp;<?php echo $this->web->banDate($row->pno)?></span></td>
								<?php }?>
							</tr>
							
							<tr style="height:100px;">
								<td valign="top">&nbsp;বর্তমান ঠিকানা</td>
								<td colspan="3" style="border-left:none;">
									<p> 
										&nbsp;:&nbsp; গ্রাম/মহল্লা  : <?php echo $row->pb_gram;?>,&nbsp;&nbsp;&nbsp;রোড/ব্লক/সেক্টর  : <?php echo $row->pb_rbs;?><br />
										&nbsp;&nbsp;&nbsp;&nbsp;পোষ্ট অফিস :<?php echo $row->pb_postof;?>,&nbsp;&nbsp;&nbsp;ওয়ার্ড নং : <?php echo $row->pb_wordno;?><br />
										&nbsp;&nbsp;&nbsp;&nbsp;থানা : <?php echo $row->pb_thana;?> <br /> 
										&nbsp;&nbsp;&nbsp;&nbsp;জেলা  : <?php echo $row->pb_dis;?>
									</p>
								</td>
							</tr>
							<tr style="height:100px;">
								<td valign="top" style="border-bottom:none;">&nbsp;স্থায়ী ঠিকানা</td>
								<td colspan="3" style="border-left:none; border-bottom:none;">
									<p> 
										&nbsp;:&nbsp; গ্রাম/মহল্লা  : <?php echo $row->perb_gram;?>,&nbsp;&nbsp;&nbsp;রোড/ব্লক/সেক্টর  : <?php echo $row->perb_rbs;?><br />
										&nbsp;&nbsp;&nbsp;&nbsp;পোষ্ট অফিস :<?php echo $row->perb_postof;?>,&nbsp;&nbsp;&nbsp;ওয়ার্ড নং : <?php echo $row->perb_wordno;?><br />
										&nbsp;&nbsp;&nbsp;&nbsp;থানা : <?php echo $row->perb_thana;?> <br /> 
										&nbsp;&nbsp;&nbsp;&nbsp;জেলা  : <?php echo $row->perb_dis;?>
									</p>
								</td>
							</tr>
							
						</table>
					</div>
				</div>
			</div>
				<!-----------application area end--------------->
			<div class="attach_area"> 
				<div class="fix structure attach_section"> 
					<table border='0' class="attach_table" width='95%' height='70px' cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0px auto;table-layout:fixed;"> 
						<tr valign='top'> 
							<td width='8%' style="font-size:18px;font-weight:700;font-style:normal;text-indent:20px;">সংযুক্তি</td>
							<td width='91%' style='font-size:16px;font-weight:normal;font-style:normal;text-indent:5px;'>:&nbsp;  <?php echo $row->attachment;?></td>
						</tr>
					</table>
				</div>
			</div>	
				
				<!-----------instraction area start--------------->
			<div class="ins_area">
				<div class="fix structure ins_section">
					<div class="hr_style"> </div>
					<h2> নির্দেশনাবলী / Instruction  </h2>
					
					
					<ol style="padding-left:40px;list-style:none;">
						<li> ১) &nbsp; এলাকার গন্যমান্য ২ জন ব্যাক্তি এবং ওয়ার্ড মেম্বার কর্তৃক  সত্যায়িত করে পরিষদে জমা ।</li>
						<li> ২) &nbsp;১ কপি পাসপোর্ট সাইজ ছবি,(সত্যায়িত)</li>
						<li>৩)&nbsp; আবেদন পত্রের অবস্থান জানার জন্য <font style="color:blue;">http://<?php echo $this->web->getUrl();?>/Otrack</font>  প্রবেশ করান  এবং অবস্থাটি জানুন ।</li>
					</ol>
				</div>
			</div>
				<!-----------instraction area end--------------->
				
			<!-----------app_sign area start--------------->
			<div class="app_sign_area">
				<div class="fix structure app_sign_section">
					<div class="sign_app"> 
						<div class="sign_app_inner"> 
								আবেদনকারীর স্বাক্ষর
						</div>
					</div>
					<div class="app_sign_section_inner"> 
						<h2> সত্যায়ন / verification </h2>
					<table class="table3" cellspacing="0" cellpadding="0"> 
						<tr>
							<td colspan="3"></td>
							<td rowspan="4" style="height:140px;width:160px; border-top:1px solid black; border-left:1px solid black;">
								<br/>
								<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2F<?php echo $all_data->web_link;?>/index.php/home/opreview?pcode=<?php echo $row->trackid;?>%2F&choe=UTF-8" style="height:120px;width:130px;">
							</td>
						</tr>
						<tr style="height:30px;">
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><input type="text" name="first_person" disabled></td>
							<td><input type="text" name="second_person" disabled></td>
							<td><input type="text" name="third_person" disabled></td>
						</tr>
						
						<tr>
							<td style="border-bottom:1px solid black;">স্বাক্ষর <br />ইউপি চেয়ারম্যান</td>
							<td style="border-bottom:1px solid black;">স্বাক্ষর <br />ওয়ার্ড মেম্বার </td>
							<td style="border-bottom:1px solid black;">স্বাক্ষর <br />গন্যমান্য ব্যাক্তি</td>
						</tr>
							
					</table>
					</div>
					
					
				</div>
			</div>
			<!-----------app_sign area end--------------->
			
			
			<!------------------ footer area start-------------------->
			<div class="footer_area">
				<div class="fix structure footer_section">
					<div id="footer_section_left">
						<p> <?php echo $all_data->web_link;?><br />
						
							E-mail:&nbsp;&nbsp;<?php echo $all_data->email;?>
							
						</p>
						
					</div>
					<div id="footer_section_right">
						<p> Develop By: Datacenter Bangladesh <br />
							www.datacenter.com.bd
						</p>
					</div>
				</div>
			</div>
			<!------------------ footer area end-------------------->
			
		</div>
	</div>
</body>
</html>
<?php $this->session->unset_userdata('sCode');
//if(!strlen($scode)){redirect('show','location');}
?>