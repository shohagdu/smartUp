<html>
	<head>
		<base href='<?php echo base_url();?>'/>
		<meta charset="utf-8">
	</head>
	<body>
		<?php 
			extract($_GET);
			$id=chop($id,'/');
			$qY=$this->db->select('*')->from('otherserviceinfo')->where('sha1(sonodno)',$id)->get();
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
				<td style="text-align:center; padding-top:20px;"><font style="font-weight:bold; font-size:29px;"><u><?php echo $this->certificate->serviceNameShow($row->serviceId)->listName;?></u></font></td>
			</tr>
		 </table>
		 
		 <div id="sonod_number">
		 
			<table border=1 style=" height:30px; width:100%" cellpadding="0" cellspacing="0">
				<tr>
					
					<td style="width:200px; text-align:center; font-size:20px; font-weight:bold;">সনদ  নং :</td>
					<?php for($i=0;$i<strlen($row->sonodno);$i++){?>	
					<td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $this->web->ceb($fsonod[$i])?></td>
					<?php }?>
				</tr>
			</table>
		
			<table border="0" style="height:200px; width:100% ;  padding-left:20px;" cellspacing="0">
				<tr height="55px" style="">
					<?php 
						if($row->serviceId==2){
					?>
					<td colspan="2" align="left" style="font-size:17px; text-indent:50px;">এই মর্মে চারিত্রিক সনদ পত্র প্রদান করা যাইতেছে যে,</td>
					<?php 
						}elseif($row->serviceId==3){
					?>
					<td colspan="2" align="left" style="font-size:17px; text-indent:50px;">এই মর্মে অবিবাহিত সনদ পত্র প্রদান করা যাইতেছে যে,</td>
					<?php 
						}elseif($row->serviceId==4){
					?>
					<td colspan="2" align="left" style="font-size:17px; text-indent:50px;">এই মর্মে  ভূমিহীন সনদ পত্র প্রদান করা যাইতেছে যে,</td>
					<?php 
						}elseif($row->serviceId==10){
					?>
					<td colspan="2" align="left" style="font-size:17px; text-indent:50px;">এই মর্মে  অনুমতি প্রদান করিতেছি যে, </td>
					<?php 
						}else{
					?>
					<td colspan="2" align="left" style="font-size:17px; text-indent:50px;">এই মর্মে প্রত্যয়ন পত্র প্রদান  করা যাইতেছে যে,</td>
					<?php 
						}
					?>
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
			
			<?php 
				if($row->serviceId==1){
			?>
			<table class='atro' height="80px" style="padding-top:40px;width:100%;">
				  <tr height="50px">
					<td style="font-size:17px;  padding-left:30px;">তিনি গত-  <?php  $date=$row->ddfb;$deathDate=date('d-m-Y',strtotime($date));echo $this->web->banDate($deathDate); ?>  ইং তারিখে মৃত্যু বরণ করিয়াছেন। তিনি অত্র ইউনিয়নের <?php echo $row->pb_wordno;?>  নং ওর্য়াডের <font style="font-size:17px;"><?php
					if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
					?></font>   বাসিন্দা ছিলেন ।  </td>
				  </tr>
				  <tr height="30px">
					
					<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি মরহুমের রুহের মাগফেরাত কামনা করি।</td>
				  </tr>
			</table>
			<?php 
				}else if($row->serviceId==2){
			?>
			<table class='atro' height="80px" style="padding-top:40px;width:100%;">
				  <tr height="50px">
					<td style="font-size:17px;  padding-left:30px;">তিনি অত্র <?php echo $all_data->full_name;?> এর <?php echo $row->pb_wordno?> নং ওয়ার্ডের এর একজন <font style="font-size:17px;"><?php
					if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
					?></font>   বাসিন্দা। আমার জানা মতে, সে রাষ্ট্র বা সমাজ বিরোধী কাজের সাথে লিপ্ত নহে। তাহার স্বভাব ও নৈতিক চরিত্র ভাল এবং প্রশংসনীয় ।  </td>
				  </tr>
				  
				  <tr height="30px">
					
					<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
				  </tr>
			</table>
			<?php
				}elseif($row->serviceId==3){
			?>
			<table class='atro' height="80px" style="padding-top:40px;width:100%;">
				  <tr height="50px">
					<td style="font-size:16px;  padding-left:30px;">তিনি অত্র <?php echo $all_data->full_name;?> এর <?php echo $row->pb_wordno;?>নং ওয়ার্ডের <font style="font-size:17px;"><?php
					if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
					?></font>   বাসিন্দা।  আমার জানা মতে, তিনি এখন পর্যন্ত বিবাহ বন্ধনে আবদ্ধ হয়নি এবং সে রাষ্ট্র বা সমাজ বিরোধী কাজের সাথে লিপ্ত নহে। তাহার স্বভাব ও নৈতিক চরিত্র ভাল এবং প্রশংসনীয় । </td>
				  </tr>
				  
				  <tr height="30px">
					
					<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
				  </tr>
			</table>
			<?php 
				}elseif($row->serviceId==4){
			?>
			<table class='atro' height="80px" style="padding-top:40px;width:100%;">
				  <tr height="50px">
					<td style="font-size:17px;  padding-left:30px;">তিনি অত্র <?php echo $all_data->full_name;?> এর  <?php echo $row->pb_wordno;?>  নং ওর্য়াডের উল্লেখিত ঠিকানার একজন ভূমিহীন কৃষক।আমার জানা মতে, সে রাষ্ট্র বা সমাজ বিরোধী কাজের সাথে লিপ্ত নহে। তাহার স্বভাব ও নৈতিক চরিত্র ভাল এবং প্রশংসনীয় । </td>
				  </tr>
				  
				  <tr height="30px">
					
					<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
				  </tr>
			</table>
			<?php 
				}elseif($row->serviceId==5){
			?>
			<table class='atro' height="80px" style="padding-top:40px;width:100%;">
				  <tr height="50px">
					<td style="font-size:17px;  padding-left:30px;">তিনি অত্র <?php echo $all_data->full_name;?> এর অন্তগত <?php echo $row->pb_wordno;?>  নং ওর্য়াডের <font style="font-size:17px;"><?php
					if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
					?></font>   বাসিন্দা।   আমার জানামতে তাহার স্বামীর মৃত্যুর পর সে অদ্যবদী দ্বিতীয় বিবাহ বন্ধনে আবব্ধ হয় নাই । তাহার নৈতিক চরিত্র ভাল ।</td>
				  </tr>
				  
				  <tr height="30px">
					
					<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
				  </tr>
			</table>
			<?php } elseif($row->serviceId==6){?>
			
			<table class='atro' height="80px" style="padding-top:40px;width:100%;">
				  <tr height="50px">
					<td style="font-size:17px;  padding-left:30px;">তিনি অত্র <?php echo $all_data->full_name;?> এর <?php echo $row->pb_wordno;?> নং ওয়ার্ডের  <font style="font-size:17px;"><?php
					if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
					?></font>   বাসিন্দা।  আমার জানা মতে, জানামতে তার বার্ষিক আয়  <?php echo $this->web->banDate($row->incomeAmount);?>/ (<?php echo $this->bnc->bnConvert($row->incomeAmount)?> টাকা মাত্র) । </td>
				  </tr>
				  
				  <tr height="30px">
					
					<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
				  </tr>
			</table>
			
			<?php }elseif($row->serviceId==7){?>
			<table class='atro' height="80px" style="padding-top:40px;width:100%;">
				  <tr height="50px">
					<td style="font-size:17px;  padding-left:30px;">তিনি অত্র <?php echo $all_data->full_name;?> এর  অন্তগত <?php echo $row->pb_wordno;?> নং ওয়ার্ডের  <font style="font-size:17px;"><?php
					if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
					?></font>   বাসিন্দা।  আমার জানা মতে,  <?php echo $row->name;?> প্রকাশে <?php echo $row->publishName;?>  একই ব্যাক্তি উভয় নামে পরিচিত। </td>
				  </tr>
				  
				  <tr height="30px">
					
					<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
				  </tr>
			</table>
			
			<?php }elseif($row->serviceId==8){?>
			<table class='atro' height="80px" style="padding-top:40px;width:100%;">
				  <tr height="50px">
					<td style="font-size:17px;  padding-left:30px;">আমার জানামতে সে,  <?php echo $all_data->full_name;?> এর <?php echo $row->pb_wordno;?>নং ওয়ার্ডের  <font style="font-size:17px;"><?php
					if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
					?></font>   বাসিন্দা ও প্রকৃত বাকঁ ও শ্রবন প্রতিবন্ধী ।</td>
				  </tr>
				  
				  <tr height="30px">
					
					<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
				  </tr>
			</table>
			<?php }elseif($row->serviceId==9){?>
			
			<table class='atro' height="80px" style="padding-top:40px;width:100%;">
				  <tr height="50px">
					<td style="font-size:17px;  padding-left:30px;">আমার জানা মতে, তিনি  অত্র <?php echo $all_data->full_name;?> এর <?php echo $row->pb_wordno;?> নং ওয়ার্ডের সনাতন ধর্ম অবলম্বী একজন <font style="font-size:17px;"><?php
					if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
					?></font>   বাসিন্দা।  </td>
				  </tr>
				  
				  <tr height="30px">
					
					<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
				  </tr>
			</table>
			
			<?php }elseif($row->serviceId==10){?>
			<table class='atro' height="80px" style="padding-top:40px;width:100%;">
				  <tr height="50px">
					<td style="font-size:17px;  padding-left:30px;"><?php echo $row->name;?> কে  <?php echo $row->workPlace;?> যোগদান করার জন্য স্বেচ্ছায় অনুমতি প্রদান করলাম।  </td>
				  </tr>
				  
				  <tr height="30px">
					
					<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
				  </tr>
			</table>
			<?php }elseif($row->serviceId==11){?>
			<table class='atro' height="80px" style="padding-top:40px;width:100%;">
				  <tr height="50px">
					<td style="font-size:17px;  padding-left:30px;"> অত্র <?php echo $all_data->full_name;?> এর একজন <font style="font-size:17px;"><?php
					if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
					?></font>   বাসিন্দা।   সে আমার নিকট পরিচিত। তাহার নৈতিক চরিত্র ভাল।</td>
				  </tr>
				  
				  <tr height="30px">
					
					<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
				  </tr>
			</table>
			<?php }else{?>
			<table class='atro' height="80px" style="padding-top:40px;width:100%;">
				  <tr height="50px">
					<td style="font-size:17px;  padding-left:30px;">অত্র <?php echo $all_data->full_name;?> এর একজন <font style="font-size:17px;"><?php
					if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
					?></font>   বাসিন্দা। তিনি জন্মগতভাবে বাংলাদেশী এবং আমার পরিচিত।  </td>
				  </tr>
				  
				  <tr height="30px">
					
					<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার সর্বাঙ্গীণ  মঙ্গল ও উন্নতি কামনা করি।</td>
				  </tr>
			</table>
			<?php }?>
		</div>		
		</body>
	
</html>