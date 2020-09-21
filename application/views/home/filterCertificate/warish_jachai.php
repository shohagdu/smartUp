<?php 
	$id=$_GET['tid'];
	$id=chop($id,'/');
	if($id==""){ echo '<p style="color:red;text-align:center;font-size:15px;">আপনার  ওয়ারিশ  সনদের নাম্বারটি প্রবেশ করুন</p>';exit;}
	$this->db->select('*')->from('tbl_warishesinfo')->where('sonodno',$id)->get();
	if($this->db->affected_rows()<1){ echo '<p style="color:red;text-align:center;font-size:15px;">আপনার  ওয়ারিশ  সনদের নাম্বারটি সঠিক না <br/>আপনি ইউনিয়ন পরিষদে যোগাযোগ করুন অথবা  <br/> ওয়ারিশ সনদের জন্য আবেদন করুন।</p>';exit;}
	else{	
?>
<html>
	<head>
	<meta charset="utf-8">
	<base href="<?php echo base_url();?>"/>
	</head>
	<body>
		<?php
			$qY=$this->db->select('*')->from('tbl_warishesinfo')->where('sonodno',$id)->get();
			$row=$qY->row();
			$fsonod=str_split($row->sonodno);
			$wQy=$this->db->select('*')->from('warishinfo')->where('trackid',$row->trackid)->get();
		?>
		
		  <!------header div start here---->
		 
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
				<td style="width:1.5in;"></td>
			</tr>
		</table>
		
		
		 
		 <!----header div close here---->
		 
		 <table align="center"  style="height:42px; border:1px; margin-top:5px; margin-bottom:15px;">
			<tr>
				<td style="padding-top:5px;"><font style="font-weight:bold; font-size:18px;"><u>ওয়ারিশ সনদপত্র</u></font></td>
			</tr>
		 </table>

		<table border="1" style=" height:30px; width:100% " cellpadding="0" cellspacing="0">
			<tr>
				<td style="width:200px; text-align:center; font-size:20px; font-weight:bold;">ওয়ারিশ সনদ  নং :</td>
				<?php for($i=0;$i<strlen($row->sonodno);$i++){?>	
				<td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $this->web->ceb($fsonod[$i])?></td>
				<?php }?>
			</tr>
		</table>
	
		<table border="0" style="height:300px; width:100%; padding-left:5px;" cellspacing="0">
				<tr>
					<td  colspan="4" align="left" style="font-size:18px;text-indent:50px; padding-top:5px;">এই মর্মে প্রত্যয়ণ  করা যাইতেছে  যে,</td>
				</tr>
				<tr>
					<td  style="font-size:18px; text-align:center; font-color:black; ">নাম   </td>
					<td><font style="font-size:18px;  font-weight:bold;">:  <?php echo $row->bname?></font></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td  style="font-size:18px; text-align:center; ">পিতা </td>
					<td><font style="font-size:18px;  font-weight:bold;">:   <?php echo $row->bfname?> </font></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td  style="font-size:18px; text-align:center;">মাতা </td>
					<td><font style="font-size:18px;  font-weight:bold;">:   <?php echo $row->bmane?> </font></td>
					<td></td>
					<td></td>
				</tr>
				<tr> 
					<td colspan="2" style="width:45%; padding-top:15px;">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr> 
								<td colspan="2"><p style="text-align:left;text-decoration:underline;font-size:18px;text-align:center;font-weight:bold;">  বর্তমান ঠিকানা  </p></td>
							</tr>
							<tr>
								<td style="width:148px;text-align:right; padding-right:10px; font-size:20px;">গ্রাম</td>
								<td><font style="font-size:18px;">: <?php echo $row->pb_gram?></font></td>
							</tr>
							<tr>
								<td style="width:158px;text-align:right; padding-right:10px; font-size:20px;">ডাকঘর</td>
								<td> <font style="font-size:18px;">: <?php echo $row->pb_postof?></font></td>
							</tr>
							<tr>
								<td style="width:158px;text-align:right; padding-right:10px; font-size:20px;">থানা</td>
								<td><font style="font-size:18px;">: <?php echo $row->pb_thana?></font></td>
							</tr>
							<tr>
								<td style="width:158px;text-align:right; padding-right:10px; font-size:20px;">জেলা</td>
								<td><font style="font-size:18px;">: <?php echo $row->pb_dis?></font> </td>
							</tr>
						</table>
					</td>
					<td colspan="2" style="width:55%;padding-top:15px;">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr> 
								<td colspan="2"><p style="text-align:left; text-decoration:underline;font-size:18px;padding-left:60px;font-weight:bold;"> স্থায়ী ঠিকানা </p> </td>
							</tr>
							<tr>
								<td style="width:100px;text-align:right; padding-right:10px; font-size:20px;">গ্রাম</td>
								<td><font style="font-size:18px;">: <?php echo $row->perb_gram?></font></td>
							</tr>
							<tr>
								<td style="text-align:right; padding-right:10px; font-size:20px;">ডাকঘর </td>
								<td><font style="font-size:18px;">: <?php echo $row->perb_postof?></font></td>
							</tr>
							<tr>
								<td style="text-align:right; padding-right:10px; font-size:20px;">থানা</td>
								<td><font style="font-size:18px;">: <?php echo $row->perb_thana?></font></td>
							</tr>
							<tr>
								<td style="text-align:right; padding-right:10px; font-size:20px;">জেলা</td>
								<td><font style="font-size:18px;">: <?php echo $row->perb_dis?></font>  </td>
							</tr>
						</table>
					</td>
				</tr>
				
			
				<tr>
					<td  nowrap style="font-size:18px; text-align:center;">ওয়ার্ড নং </td>
					<td><font style="font-size:18px;  font-weight:bold;">:  <?php echo $this->web->conArray($row->per_wordno)?></font></td>
					<td></td>
					<td></td>
				</tr>
				
				<tr>
					<td  nowrap style="font-size:18px; text-align:center;">ন্যাশনাল আইডি নং  </td>
					<td><font style="font-size:18px;  font-weight:bold;">:  <?php echo $row->bnid?></font></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="4"> 
						<font style="font-size:18px; padding-left:20px;"> অত্র ইউনিয়নের অধিবাসী ছিলেন। মৃত্যুকালে তিনি নিম্নলিখিত ওয়ারিশগনকে রাখিয়া মৃত্যু বরণ করেন।</font>
					</td>
				</tr>
		</table>
		<table cellpadding="0" cellspacing="0" style="min-height:100px; width:95%; margin-top:12px;font-size:14px;" border="1"> 
			<tr> 
				<th style="width:5%;text-align:center;">নং</th>
				<th style="width:60%;">নাম</th>
				<th style="width:19%;text-align:center;">সম্পর্ক</th>
				<th style="width:14%;text-align:center;">বয়স</th>
			</tr>
			<?php $i=1; $nr=0; foreach ($wQy->result() as $wrow):?>
					<tr>
						<td style="text-align:center;"><?php echo $this->web->ceb($i++)?></td>
						<td style=""><?php echo $wrow->w_name?></td>
						<td style="text-align:center;"><?php echo $wrow->w_relation?></td>
						<td style="text-align:center;" ><?php echo $this->web->conArray($wrow->w_age)?></td>
					</tr>
					<?php $nr++;endforeach;?>
					<?php //endfor;?>
					<tr>
					 <td></td>
					 <td colspan='3' style="text-align:right;padding-right:100px;">উত্তরাধিকারীর সংখা <span id=''>&nbsp;&nbsp;<?php echo $this->web->ceb($nr)?>&nbsp;&nbsp;</span>&nbsp;&nbsp;জন</td>
					</tr>
			
			
		</table>
			
			
		
		<script>
			<?php $nr=1; foreach ($wQy->result() as $wrow):?>
			document.getElementById('wn<?php echo $nr?>').innerHTML='<?php echo $wrow->w_name?>';
			document.getElementById('wrel<?php echo $nr?>').innerHTML='<?php echo $wrow->w_relation?>';
			document.getElementById('wage<?php echo $nr?>').innerHTML='<?php echo $this->web->conArray($wrow->w_age)?>';
			<?php $nr++;endforeach;?>
			document.getElementById('total').innerHTML='<?php echo $this->web->banDate($nr-1)?>';
			document.getElementById('intotal').innerHTML='<?php echo $this->web->banDate($nr-1)?>';
		</script>
			
			
	</body>
	
</html>

<?php 
}
?>