<script>
	window.onbeforeunload = function(){ return 'আপনি যদি পেজটি  Reload দেন তাহলে আপনাকে নতুন করে ডাটা এন্ট্রি দিতে হবে.';};
</script>
<?php
if(isset($_GET['scode'])){$scode=$this->input->get('scode',TRUE);}
else if(isset($_GET['pcode'])){ $scode=$this->input->get('pcode',TRUE);}
else {$scode=$this->session->userdata('trackid');}
$scode=chop($scode,'/');
$query=$this->db->select('*')->from('tradelicense')->where('trackid',$scode)->get();
$row=$query->row();
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
<base href="<?php echo base_url();?>"/>
	<meta charset="UTF-8">
	<title> Trade Application </title>
	<link rel="stylesheet" type="text/css" href="certificate_css/trade_application.css" media="all" />

<style type="text/css"> 
	body{
		font-family:tahoma, solaimanlipi;
		
	}
</style>
</head>
<body style="">

<div style="left:300px;margin-top:10px;position:middle;background:#666;" align="center" id="bar">
	<?php //if($this->session->userdata('sCode')){?>
		<a href="" style="margin-right:50px;" title="Back Home Page">
			<img src="<?php echo base_url();?>img/home.png">
		</a>
	<?php //}?>
	<a  target='_blank' href="javaScript:window.print();<?php if(isset($_GET['scode'])){?>home/tpreview?pcode=<?php echo $scode;}?>" title="Print">
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
						<p><?php echo $all_data->gram;?> <br/>
						
						<?php 
							$ch = $this->db->count_all('setup_tbl');
							if($ch!=0):
						?>
						
							<?php echo $all_data->thana;?>,&nbsp;<?php echo $all_data->district;?>-<?php echo $all_data->postal_code;?><br/>
							ফোন :  <?php echo $all_data->phone;?>,&nbsp;<?php echo $all_data->mobile;?>
						</p>
						<?php 
							endif;
						?>
					</div>
					<div id="top_right">
						<img src="<?php echo $row->profile?>" alt="image" width='140' height='120' style="padding-top:10px"/>
					</div>
				</div>
			</div>
						<!-----------top area end--------------->
						
						
						<!-----------header area start--------------->
			<div class="header_area">
				<div class="fix structure header_section"> 
					<h2> ট্রেড লাইসেন্স এর আবেদন  </h2>
					<span> আবেদনের তারিখ: <input type="text" name="" id="" readonly value="<?php $cdate=date('d/m/Y', strtotime($row->utime));echo $this->web->banDate($cdate);?>" /></span>
				</div>
			</div>
				<!-----------header area end--------------->
			
				<!-----------application area start--------------->
			
			<div class="app_area">
				<div class="fix structure app_section">
					<div id="app_section_left">
						<form>
							<p> ট্রেকিং আইডি নং - </p><span> <input type="text" name="tra_no" id="" value="<?php echo $row->trackid;//$this->web->conArray($row->trackid);?>"  <?php if(isset($_GET['scode'])){?>style="left:-80px;"<?php }?>/> </span>
						</form>
					</div>
					<div id="app_section_right">
						<table class="table1">
							<tr>
								<td>&nbsp;প্রতিষ্ঠানের নাম (বাংলা)</td>
								<td style="border-left:none;border-bottom:none;">&nbsp;:&nbsp;<input type="text" name="ins_name_ban" id="" readonly value="<?php echo $row->bcomname;?>" /></td>
							</tr>
							<tr>
								<td>&nbsp;প্রতিষ্ঠানের নাম  (ইংরেজী)</td>
								<td style="border-left:none;">&nbsp;:&nbsp;<input type="text" name="ins_name_eng" id="" readonly value="<?php echo $row->ecomname;?>" /></td>
							</tr>
							<tr>
								<td>&nbsp;মালিকের নাম (বাংলা)</td>
								<td style="border-left:none;">&nbsp;:&nbsp;<input type="text" name="onwer_name_bng" id="" readonly value="<?php echo chop($row->bwname,',');?>" /></td>
							</tr>
							<tr>
								<td>&nbsp;মালিকের নাম (ইংরেজী)</td>
								<td style="border-left:none;">&nbsp;:&nbsp;<input type="text" name="onwer_name_eng" id="" readonly value="<?php echo chop($row->ewname,',');?>" /></td>
							</tr>
							<tr>
								<td>&nbsp;ব্যবসার ধরন</td>
								<td style="border-left:none;">&nbsp;:&nbsp;
									<?php echo $row->btype;?>
									
								</td>
							</tr>
							<tr style="height:90px;">
								<td valign="top">&nbsp;ব্যবসার ঠিকানা</td>
								<td style="border-left:none;">
								<span> &nbsp;:&nbsp;
									গ্রাম/মহল্লা  :&nbsp<?php echo $row->bb_gram;?>,&nbsp; &nbsp;রোড/ব্লক/সেক্টর  :&nbsp;&nbsp;<?php echo $row->bb_rbs;?><br/>
									&nbsp;&nbsp;&nbsp;&nbsp;পোষ্ট অফিস :&nbsp;<?php echo $row->bb_postof;?>,&nbsp;&nbsp;ওয়ার্ড নং :&nbsp;<?php echo $row->bb_wordno;?>  <br />
									&nbsp;&nbsp;&nbsp;&nbsp;থানা :&nbsp;<?php echo $row->bb_thana;?> <br />
									&nbsp;&nbsp;&nbsp;&nbsp;জেলা :&nbsp;<?php echo $row->bb_dis;?> 
									
								</span>
									<!-----------------
									<textarea name="business_add" id="" cols="60" rows="3" >
									</textarea> ----------->
								</td>
							</tr>
							<tr>
								<td>&nbsp;ওয়ার্ড নং</td>
								<td style="border-left:none;">&nbsp;:&nbsp;<input type="text" name="word_no" id="" readonly value="<?php echo $row->bb_wordno;?>" /></td>
							</tr>
							<tr>
								<td>&nbsp;ভ্যাট রেজি: আইডি</td>
								<td style="border-left:none;">&nbsp;:&nbsp;<input type="text" name="taxt_id" id="" readonly value="<?php echo $this->web->banDate($row->vatid);?>" /></td>
							</tr>
							
							<tr>
								<td>&nbsp;মোবাইল</td>
								<td style="border-left:none;">&nbsp;:&nbsp;<input type="text" name="phone_number" id="" readonly value="<?php echo $this->web->banDate($row->mobile);?>" /></td>
							</tr>
							<tr style="border-bottom:none;">
								<td style="border-bottom:none;">&nbsp;ইমেল</td>
								<td style="border-left:none; border-bottom:none;">&nbsp;:&nbsp;<input type="text" name="email_no" id="" readonly value="<?php echo $row->email;?>" /></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
				
				
				<!-----------instraction area start--------------->
			<div class="ins_area">
				<div class="fix structure ins_section">
					<div class="ins_section_inner"> 
						<h2> নির্দেশনাবলী / Instruction  </h2>
						
						
						<ol style="padding-left:40px;list-style:none;">
							<li> ১) &nbsp;ট্রেড লাইসেন্স সংগ্রহের জন্য ২ কপি পাসপোর্ট সাইজ এর ছবি, ভাড়ার চুক্তিপত্র,ন্যাশনাল আইডি কার্ড এর ফটোকপি এবং একটি বিজনেস কার্ড নিয়ে &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;স্বশরীরে উপস্থিত হতে হবে।		
							</li>
							<li> ২) &nbsp;লাইসেন্সটি সংগ্রহের সময় আবেদনপত্রটি সঙ্গে আনতে হবে।</li>
							<li>৩)&nbsp; আবেদনের অবস্থান জানার জন্য <font style="color:blue;">http://<?php echo $this->web->getUrl();?>/Ttrack</font>  এ ট্রেকিং নম্বরটি বসাতে হবে।</li>
							<li>৪)&nbsp; আবেদন পত্রে যে কোন ধরনের সংশোধনের জন্য ইউনিয়ন পরিষদে যোগাযোগ করুন।</li>
						</ol>
					</div>
				</div>
			</div>
				<!-----------instraction area end--------------->
				
				<!-----------app_sign area start--------------->
			<div class="app_sign_area">
				<div class="fix structure app_sign_section">
					<div class="app_sign_section_inner"> 
						<h2>আবেদনকারীর সাক্ষর </h2>
						<table class="table3" cellspacing="0" cellpadding="0" style="border-collapse:collapse;margin:20px auto;table-layout:fixed;"> 
							<tr>
								<td></td>
								<td colspan="2"></td>
								<td rowspan="2" style="height:160px; width:160px; border-left:1px solid black;border-top:1px solid black;"><br />
									<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2F<?php echo $all_data->web_link;?>/index.php/home/tpreview?scode=<?php echo $row->trackid;?>%2F&choe=UTF-8" style="height:120px;width:130px;">
								</td>
								
							</tr>
							<tr style="height:55px;">
								<td style="border-bottom:1px solid black;"></td>
								<td style="border-bottom:1px solid black;"></td>
								<td style="border-bottom:1px solid black;"> <div id="name_sil" > <p style="padding-left:60px;"> সাক্ষর (সীলসহ) </p></div></td>
							</tr>	
						</table>
					</div>
					
					
				</div>
			
			<!-----------app_sign area end--------------->
			
			<!------------------ footer area start-------------------->
			<div class="footer_area">
				<div class="fix structure footer_section">
					<div id="footer_section_left">
						<p> <?php echo $all_data->web_link;?><br />
							E mail&nbsp;:&nbsp;<?php echo $all_data->email;?>
						</p>
					
					</div>
					<div id="footer_section_right" >
						<p style="font-size:10px;"> Develop By: Datacenter Bangladesh <br />
							www.datacenter.com.bd
						</p>
					</div>
				</div>
			</div>
			<!------------------ footer area end-------------------->
			
		</div>
	</div>
</body>
<?php
//$this->session->unset_userdata('trackid');
?>
</html>