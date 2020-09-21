<html>
	<head>
		<base href='<?php echo base_url();?>'/>
		<meta charset="utf-8">
	</head>
	<body>
		<?php 
			extract($_GET);
			$id=chop($id,'/');
			$qY=$this->db->select('*')->from('personalinfo')->where('sha1(sonodno)',$id)->get();
			$row=$qY->row();
			$fsonod=str_split($row->sonodno);
		?>
		  <!------header div start here---->
		<table  align="left" height="120px" cellpadding="0" cellspacing='0' style="border-bottom:0px solid black;width:100%;border:0px solid;">
		  	<tr>
				<td style="width:1.5in; text-align:center;"><img src="logo_images/logo.png" height="80px" width="80px"/></td>
				<td style="text-align:center;font-family:SolaimanLipi;thoma;"><font style="font-size:21px;letter-spacing:2px; font-weight:bold; color:blue; width:5.5in;"><?php echo $all_data->full_name;?></font>  <br />
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

		 <!----header div close here---->
		 
		 <table align="center"  style="height:42px; width:100%; border:1px; margin-top:20px;margin-bottom:20px;">
			<tr>
				<td style="text-align:center; padding-top:20px;"><font style="font-weight:bold; font-size:29px;"><u>নাগরিকত্ব সনদপত্র</u></font></td>
			</tr>
		 </table>
		 
		 <div id="sonod_number">
		 
			<table border=1 style=" height:30px; width:100%" cellpadding="0" cellspacing="0">
				<tr>
					
					<td style="width:200px; text-align:center; font-size:20px; font-weight:bold;">নাগরিকত্ব সনদ  নং :</td>
					<?php for($i=0;$i<strlen($row->sonodno);$i++){?>	
					<td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $this->web->ceb($fsonod[$i])?></td>
					<?php }?>
				</tr>
			</table>
		
			<table border="0" style="height:200px; width:100% ;  padding-left:20px;" cellspacing="0">
				<tr>
					<td  colspan="2" align="left" style="font-size:18px; padding-left:50px; padding-top:30px;">এই মর্মে প্রত্যয়ন করা যাচ্ছে যে,</td>
				</tr>
				<tr>
					<td  style="font-size:16px; padding-left:50px; font-color:black; width:180px; ">নাম  </font>  </td>
					<td><font style="font-size:18px;  font-weight:bold;">: <?php echo $row->name?></font></td>
				</tr>
					<?php 
							if(($row->gender=='female') && ($row->mstatus==1) && ($row->bhname !="")){
						?>
						<tr height="18px">
							<td style="font-size: 17px; text-indent:55px">স্বামীর নাম</td>
							<td><font style="font-size:17px; ">: <?php echo $row->bhname?></font></td>
						</tr>
						<?php }?>
					
					<tr>
						<td  style="font-size:16px; padding-left:50px; ">পিতা </td>
						<td><font style="font-size:18px;  font-weight:bold;">: <?php echo $row->bfname?> </font></td>
					</tr>
					
					
					<tr>
						<td  style="font-size:16px;padding-left:50px; ">মাতা </td>
						<td><font style="font-size:18px;  font-weight:bold;">:  <?php echo $row->mname?> </font></td>
					</tr>
					
					
                    <tr>
					    <td nowrap align="left" style="font-size:20px; padding-left:50px; vertical-align:top; ">বর্তমান ঠিকানা </td>
						<td><p style="padding-top:0px;line-height:35px;font-size:18px;  font-weight:bold;" class='bold'>
						&nbsp;  গ্রামঃ <?php echo $row->pb_gram?><br>
						                  &nbsp; ডাকঘরঃ <?php echo $row->pb_postof?><br>
						                &nbsp;   থানাঃ <?php echo $row->pb_thana?><br>
						                &nbsp;   জেলাঃ <?php echo $row->pb_thana?> </p></td> 
					</tr>
					
					
					<tr>
					    <td nowrap align="left" style="font-size:20px; padding-left:50px; vertical-align:top; ">স্থায়ী ঠিকানা </td>
						<td><p style="padding-top:0px; line-height:35px;font-size:18px;  font-weight:bold;" class='bold'>
						&nbsp;  গ্রামঃ <?php echo $row->perb_gram?><br>
						            &nbsp; ডাকঘরঃ <?php echo $row->pb_postof?><br>
						                &nbsp;   থানাঃ <?php echo $row->pb_thana?><br>
						                &nbsp;   জেলাঃ <?php echo $row->pb_dis?> </p></td> 
					</tr>
					<tr>
					    <td  nowrap style="font-size:16px; padding-left:50px; width:50px; height:40px; ">ওয়ার্ড নং </td>
						<td><font style="font-size:18px;  font-weight:bold;">: <?php echo $this->web->conArray($row->p_wordno)?></font></td>
					</tr>

					<?php if(isset($row->bnid) && $row->bnid!='0'){?>
					<tr>
					    <td  nowrap style="font-size:16px; padding-left:50px; width:50px; height:40px; ">ন্যাশনাল আইডি নং </td>
						<td><font style="font-size:18px;  font-weight:bold;">:  <?php echo $row->nationid?></font></td>
					</tr>	
					<?php } else if(isset($row->bbcno) && $row->bbcno!='0'){?>
					<tr>
					    <td  nowrap style="font-size:16px; padding-left:50px; width:50px; height:40px; ">জন্ম নিবন্ধন নং  </td>
						<td><font style="font-size:18px;  font-weight:bold;">:  <?php echo $row->bbcno?></font></td>
					</tr>	
					<?php } else if(isset($row->bpno) && $row->bpno!='0'){?>
					<tr>
					    <td  nowrap style="font-size:16px; padding-left:50px; width:50px; height:40px; ">পাসপোর্ট নং </td>
						<td><font style="font-size:18px;  font-weight:bold;">:  <?php echo $row->bpno?></font></td>
					</tr>	<?php }?>
			</table>
			</table>
			<table class='atro' height="80px" style="padding-top:40px;width:100%;">
			      <tr>
					<td style="font-size:20px;  padding-left:30px;"> অত্র ইউনিয়ন এর একজন <?php if($row->bashinda=='2') echo "স্থায়ী"; else "অস্থায়ী";?> বাসিন্দা। তিনি জম্মগত ভাবে বাংলাদেশী এবং আমার পরিচিত। </td>
				  </tr>
				  <tr>
					<td colspan="2" align="left" style="padding-left:28px; font-size:20px;"> আমি তাহার সর্বাঙ্গীণ  মঙ্গল ও উন্নতি কামনা করি।</td>
				  </tr>
			</table>
		</div>		
		</body>
	
</html>