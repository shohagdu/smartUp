<?php
	//some execution here...........
	$rid = $this->uri->segment(3); 
	$data = array( "id" => $rid );
	$query = $this->db->get_where("acl",$data);
	
	$num = $query->num_rows();

if( $num ):
	$role_info = $query->row();
	$widget = explode(",", $role_info->widget);
?>

	<style type="text/css">
		#m_tbl	tr:nth-child(even) {background: #F4F4F4;}
		#m_tbl	tr:nth-child(odd) {background: #F9F9F9;}
		#m_tbl tr td{border: 2px solid #EAE8E4;}
		#m_tbl{width: 100%;color:black;}
		#m_tbl tr td{border:1px solid white;color:black;text-align: left;font-size: 16px;padding-left: 10px;font-family:tahoma;}
		#m_tbl tr th{border:1px solid white;text-align: center;color:#333333;font-size: 14px;background: #EAEAEA;font-family:tahoma;}
		#m_tbl tr td input{text-align: center;}

		.sub_section{padding-left: 70px !important; color: #333;}
		.sub_heading{font-weight:bolder;font-size: 18px;}
		
		input[type=checkbox]
		{
		  /* Double-sized Checkboxes */
		  -ms-transform: scale(1); /* IE */
		  -moz-transform: scale(1); /* FF */
		  -webkit-transform: scale(1.5); /* Safari and Chrome */
		  -o-transform: scale(1.5); /* Opera */
		  padding: 10px;
		}
	</style>

	<script type="text/javascript">
		function toggle(source) {
			var n,i;
			var checkboxes1 = document.getElementsByName('role[]');

			for(var i=0, n=checkboxes1.length;i<n;i++) {
				checkboxes1[i].checked = source.checked;
			}
		}
	</script>


	<div id="content" class="col-lg-10 col-sm-10">
		<div class="row"> 
			<div class="col-lg-12 col-sm-12 col-xs-12">
				<button class="btn btn-custom-head btn-block btn-sm " style="font-size:16px;margin-bottom:20px;">User Role Widget Update</button>
			</div>
		</div>


		<div class="row" style="padding:4px;width:100%;border:2px solid lightgray;margin-left:0px;">
			<div class="table-responsive" style="padding: 20px;box-sizing: border-box;">
				<form action="index.php/role/roleUpdateSubmit" method="POST" >
					<table cellspacing="2" class="table" style="margin-top:15px;" >
						<thead>
							<tr style="border:1px solid #eee;background:#f9f9f9;height:35px;">
								<td colspan="6" style="padding-left:30px;">
									<p style="font-size: 18px; font-weight: bolder;">Enter Your Role Name :</p>
									<input  type="text" name="role_name" required placeholder="Enter Role Name"  style="text-align:left;width:340px;font-size: 18px;" class='form-control' value="<?php echo $role_info->role_name ?>" />
								</td>
							</tr>

							<tr>
								<td colspan="6" style="height:10px;background:#fff;"></td>
							</tr>

							<tr style="height:20px;">
								<th style="text-align:left;">All Widget &nbsp;&nbsp;
									<input type="checkbox" id="checkallrole"  onClick="toggle(this)" value="" name="checkall">
									<input type="hidden" value="<?php echo $rid ?>" name="role_id" />
								</th>
								<th>View</th> 
								<th>Edit</th>
								<th>Process</th> 
								<th style="padding:0px;margin:0px;">
									<table style="width:100%;">
										<tr>
											<th colspan="3" style="font-size:16px;">প্রিন্ট</th>
										</tr>
										<tr>
											<th>বাংলা সার্টিফিকেট</th>
											<th>ইংলিশ সার্টিফিকেট</th>
											<th>মানি রিসিপ্ট</th>
										</tr>
									</table>
				
								</th>  
							</tr> 
						</thead> 
						
						<tbody>
							<tr style="background:#EAEAEA;color:#999999;font-size:16px;font-weight:bold;">
								<td colspan="5">Application Section</td>
							</tr>
							<tr>
								<td colspan="5" class="sub_heading">নাগরিক আবেদন</td>
							</tr>
							<tr>
								<td class="sub_section"> নতুন আবেদনকারীগণ </td>
								<td><input type="checkbox"  value="nagorickapplicant" name="role[]"  <?php if(in_array("nagorickapplicant", $widget)):echo "checked";endif; ?>></td>
								<td><input type="checkbox"  value="nagorickInfo" name="role[]" <?php if(in_array("nagorickInfo", $widget)):echo "checked";endif; ?>></td>
								<td><input type="checkbox"  value="nagorickGenarate" name="role[]" <?php if(in_array("nagorickGenarate", $widget)):echo "checked";endif; ?>></td>
							</tr>	
	<!-- certificate -->
							<tr>
								<td class="sub_section"> সনদ প্রদানকারিগণ </td>
								<td><input type="checkbox"  value="nagorickapplicant" name="role[]" <?php if(in_array("nagorickapplicant", $widget)):echo "checked";endif; ?>></td>
								<td><input type="checkbox"  value="nagorickInfo" name="role[]" <?php if(in_array("nagorickInfo", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td style="padding:0px;margin:0px;">
									<table style="width:100%;">
										<tr>
											<td style="width:170px;padding-top: 10px;"><input type="checkbox"  value="nagorickBangla" name="role[]" <?php if(in_array("nagorickBangla", $widget)):echo "checked";endif; ?>></td>
											<td style="padding-left:20px;padding-top: 10px;"><input type="checkbox"  value="nagorickEnglish" name="role[]" <?php if(in_array("nagorickEnglish", $widget)):echo "checked";endif; ?>></td>
											<td style="padding-top: 10px;"><input type="checkbox"  value="nagorickMoneyReceipt" name="role[]"  <?php if(in_array("nagorickMoneyReceipt", $widget)):echo "checked";endif; ?>></td>
										</tr>
									</table>
								</td>
							</tr>
	<!-- certificate end -->
	<!-- trad licese section -->

							<tr>
								<td colspan="5" class="sub_heading">  ট্রেড লাইসেন্স আবেদন</td>
							</tr>
							<!-- new applicant -->
							<tr>
								<td class="sub_section"> নতুন আবেদনকারীগণ </td>
								<td><input type="checkbox"  value="tradelicenseapplicant" name="role[]"  <?php if(in_array("tradelicenseapplicant", $widget)):echo "checked";endif; ?>></td>
								<td><input type="checkbox"  value="tradelicenseInfo" name="role[]" <?php if(in_array("tradelicenseInfo", $widget)):echo "checked";endif; ?>></td>
								<td><input type="checkbox"  value="tradelicenseGenarate" name="role[]" <?php if(in_array("tradelicenseGenarate", $widget)):echo "checked";endif; ?>></td>
								<td style="padding:0px;margin:0px;"></td>
							</tr>

							<!--  license given -->
							<tr>
								<td class="sub_section"> সনদ প্রদানকারিগণ </td>
								<td><input type="checkbox"  value="tradelicenseapplicant" name="role[]"  <?php if(in_array("tradelicenseapplicant", $widget)):echo "checked";endif; ?>></td>
								<td><input type="checkbox"  value="tradelicenseInfo" name="role[]" <?php if(in_array("tradelicenseInfo", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td style="padding:0px;margin:0px;">
									<table style="width:100%;">
										<tr>
											<td style="width:170px;padding-top: 10px;"><input type="checkbox"  value="tradelicenseBangla" name="role[]" <?php if(in_array("tradelicenseBangla", $widget)):echo "checked";endif; ?>></td>
											<td style="padding-left:20px;padding-top: 10px;"><input type="checkbox"  value="tradelicenseEnglish" name="role[]" <?php if(in_array("tradelicenseEnglish", $widget)):echo "checked";endif; ?>></td>
											<td style="padding-top: 10px;"><input type="checkbox"  value="tradelicenseMoneyReceipt" name="role[]" <?php if(in_array("tradelicenseMoneyReceipt", $widget)):echo "checked";endif; ?>></td>
										</tr>
									</table>
								</td>
							</tr>
							<!-- nobayon applicant -->
							<tr>
								<td class="sub_section"> নবায়ন আবেদনকারীগ্ণ </td>
								<td></td>
								<td></td>
								<td></td>
								<td style="padding:0px;margin:0px;"></td>
							</tr>
							<!-- expired trade -->
							<tr>
								<td class="sub_section"> মেয়াদ উত্তীর্ণ ট্রেড লাইসেন্স </td>
								<td><input type="checkbox"  value="tradelicenseapplicant" name="role[]" <?php if(in_array("tradelicenseapplicant", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>						
	<!-- warish section -->
							<tr>
								<td colspan="5" class="sub_heading">  ওয়ারিশ আবেদন </td>
							</tr>
							<!-- new applicant -->
							<tr>
								<td class="sub_section"> নতুন আবেদনকারীগণ </td>
								<td><input type="checkbox"  value="warishapplicant" name="role[]" <?php if(in_array("warishapplicant", $widget)):echo "checked";endif; ?>></td>
								<td><input type="checkbox"  value="warishInfo" name="role[]" <?php if(in_array("warishInfo", $widget)):echo "checked";endif; ?>></td>
								<td><input type="checkbox"  value="warishGenarate" name="role[]" <?php if(in_array("warishGenarate", $widget)):echo "checked";endif; ?>></td>
								<td style="padding:0px;margin:0px;"></td>
							</tr>

							<!--  license given -->
							<tr>
								<td class="sub_section"> সনদ প্রদানকারিগণ </td>
								<td><input type="checkbox"  value="warishapplicant" name="role[]" <?php if(in_array("warishapplicant", $widget)):echo "checked";endif; ?>></td>
								<td><input type="checkbox"  value="warishInfo" name="role[]" <?php if(in_array("warishInfo", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td style="padding:0px;margin:0px;">
									<table style="width:100%;">
										<tr>
											<td style="width:170px;padding-top: 10px;"><input type="checkbox"  value="warishBangla" name="role[]" <?php if(in_array("warishBangla", $widget)):echo "checked";endif; ?>></td>
											<td style="padding-left:20px;padding-top: 10px;"><input type="checkbox"  value="warishEnglish" name="role[]" <?php if(in_array("warishEnglish", $widget)):echo "checked";endif; ?>></td>
											<td style="padding-top: 10px;"><input type="checkbox"  value="warishMoneyReceipt" name="role[]" <?php if(in_array("warishMoneyReceipt", $widget)):echo "checked";endif; ?>></td>
										</tr>
									</table>
								</td>
							</tr>
	<!-- warish section end -->

	<!-- collaction section start -->
							<tr style="background:#EAEAEA;color:#999999;font-size:16px;font-weight:bold;">
								<td colspan="5">Collection Section</td>
							</tr>
							<!-- daily tk -->
							<tr>
								<td class="sub_section"> দৈনিক জমা </td>
								<td><input type="checkbox"  value="dailySubmit" name="role[]" <?php if(in_array("dailySubmit", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>	

							<!-- revenue taken -->
							<tr>
								<td class="sub_section">  কর আদায় </td>
								<td><input type="checkbox"  value="taxCollection" name="role[]" <?php if(in_array("taxCollection", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
	<!-- collection section end -->

	<!-- transfer section start -->
							<tr style="background:#EAEAEA;color:#999999;font-size:16px;font-weight:bold;">
								<td colspan="5">Transfer Section</td>
							</tr>
							<tr>
								<td colspan="5" class="sub_heading"> টাকার বিনিময় </td>
							</tr>
						<!-- bank transfer -->
							<tr class="sub_section">
								<td class="sub_section">ব্যাংকের টাকা বিনিময় </td>
								<td><input type="checkbox"  value="bankTransfers" name="role[]"  <?php if(in_array("bankTransfers", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
					<!-- fund transfer -->
							<tr>
								<td class="sub_section">ফান্ডের টাকা বিনিময়</td>
								<td><input type="checkbox" value="fundTransfers" name="role[]" <?php if(in_array("fundTransfers", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
	<!-- transfer section end -->

	<!-- report section start -->
							<tr style="background:#EAEAEA;color:#999999;font-size:16px;font-weight:bold;">
								<td colspan="5">Report Section</td>
							</tr>
							<!-- roshid -->
							<tr>
								<td colspan="5" class="sub_heading">  রশিদ সমূহ </td>
							</tr>
							<!-- all roshid -->
							<tr>
								<td class="sub_section">সকল রশিদ সমূহ</td>
								<td><input type="checkbox" value="allroshid" name="role[]" <?php if(in_array("allroshid", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td><!--<input type="checkbox" value="holdingEmpCh" name="role[]">--></td>
								<td>
									<table style="width:100%;">
										<tr>
											<td style="width:170px;"></td>
											<td style="padding-left:20px;"></td>
											<td><input type="checkbox"  value="tradelicenseMoneyReceipt" name="role[]"  <?php if(in_array("tradelicenseMoneyReceipt", $widget)):echo "checked";endif; ?>></td>
										</tr>
									</table>
								</td>
							</tr>
							<!-- trade license roshid -->
							<tr>
								<td class="sub_section"> ট্রেড লাইসেন্স রশিদ </td>
								<td><input type="checkbox" value="tradelicense_tab_roshid" name="role[]"  <?php if(in_array("tradelicense_tab_roshid", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td>
									<table style="width:100%;">
										<tr>
											<td style="width:170px;"></td>
											<td style="padding-left:20px;"></td>
											<td><input type="checkbox"  value="tradelicenseMoneyReceipt" name="role[]"  <?php if(in_array("tradelicenseMoneyReceipt", $widget)):echo "checked";endif; ?>></td>
										</tr>
									</table>
								</td>
							</tr>
							<!-- bosot vita kor roshid -->
							<tr>
								<td class="sub_section">বসতভিটার কর রশিদ</td>
								<td><input type="checkbox" value="bosodbitakor_tab_roshid" name="role[]"  <?php if(in_array("bosodbitakor_tab_roshid", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td>
									<table style="width:100%;">
										<tr>
											<td style="width:170px;"></td>
											<td style="padding-left:20px;"></td>
											<td><input type="checkbox"  value="bosodbitakorMoneyReceipt" name="role[]"  <?php if(in_array("bosodbitakorMoneyReceipt", $widget)):echo "checked";endif; ?>></td>
										</tr>
									</table>
								</td>
							</tr>
							<!-- pesa jibi kor -->
							<tr>
								<td class="sub_section">পেশাজীবি কর রশিদ</td>
								<td><input type="checkbox" value="peshajibikor_tab_roshid" name="role[]" <?php if(in_array("peshajibikor_tab_roshid", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td>
									<table style="width:100%;">
										<tr>
											<td style="width:170px;"></td>
											<td style="padding-left:20px;"></td>
											<td><input type="checkbox"  value="peshaMoneyReceipt" name="role[]"  <?php if(in_array("peshaMoneyReceipt", $widget)):echo "checked";endif; ?>></td>
										</tr>
									</table>
								</td>
							</tr>
							<!-- daily joma roshid -->
							<tr>
								<td class="sub_section">দৈনিক জমা রশিদ</td>
								<td><input type="checkbox" value="dailycollection_tab_roshid" name="role[]" <?php if(in_array("dailycollection_tab_roshid", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td>
									<table style="width:100%;">
										<tr>
											<td style="width:170px;"></td>
											<td style="padding-left:20px;"></td>
											<td><input type="checkbox"  value="dailyCollectionMoneyReceipt" name="role[]"  <?php if(in_array("dailyCollectionMoneyReceipt", $widget)):echo "checked";endif; ?>></td>
										</tr>
									</table>
								</td>
							</tr>
							<!-- citizen certificate roshid -->
							<tr>
								<td class="sub_section">নাগরিক সনদ রশিদ</td>
								<td><input type="checkbox" value="nagoriksonod_tab_roshid" name="role[]"  <?php if(in_array("nagoriksonod_tab_roshid", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td>
									<table style="width:100%;">
										<tr>
											<td style="width:170px;"></td>
											<td style="padding-left:20px;"></td>
											<td><input type="checkbox"  value="" name="role[]"></td>
										</tr>
									</table>
								</td>
							</tr>
							<!-- warish certificate roshid -->
							<tr>
								<td class="sub_section">ওয়ারিশ সনদ রশিদ</td>
								<td><input type="checkbox" value="warishsonod_tab_roshid" name="role[]" <?php if(in_array("dailyCollectionMoneyReceipt", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td>
									<table style="width:100%;">
										<tr>
											<td style="width:170px;"></td>
											<td style="padding-left:20px;"></td>
											<td><input type="checkbox"  value="" name="role[]"></td>
										</tr>
									</table>
								</td>
							</tr>
							<!-- trade license bosot vita kor -->
							<tr>
								<td class="sub_section"> ট্রেড লাইসেন্সধারির বসত ভিটা কর </td>
								<td><input type="checkbox" value="trade_bosodbitakor_tab_roshid" name="role[]"  <?php if(in_array("trade_bosodbitakor_tab_roshid", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td>
									<table style="width:100%;">
										<tr>
											<td style="width:170px;"></td>
											<td style="padding-left:20px;"></td>
											<td><input type="checkbox"  value="tradeBosodbitakorMoneyReceipt" name="role[]"  <?php if(in_array("tradeBosodbitakorMoneyReceipt", $widget)):echo "checked";endif; ?>></td>
										</tr>
									</table>
								</td>
							</tr>
	<!-- report section end -->
	<!-- daily collection report -->
							<tr>
								<td colspan="5" class="sub_heading"> দৈনিক হিসাবের রিপোর্ট </td>
							</tr>
							<!-- daily collection -->
							<tr>
								<td class="sub_section">দৈনিক কালেকশন</td>
								<td><input type="checkbox" value="dailyCollection" name="role[]" <?php if(in_array("dailyCollection", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<!-- daily vat collection -->
							<tr>
								<td class="sub_section">দৈনিক ভ্যাট কালেকশন</td>
								<td><input type="checkbox" value="dailyVatCollection" name="role[]"  <?php if(in_array("dailyVatCollection", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<!-- daily bank hisab -->
							<tr>
								<td class="sub_section">দৈনিক ব্যাংক বিবরণ</td>
								<td><input type="checkbox" value="dailyBankDetails" name="role[]"  <?php if(in_array("dailyBankDetails", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<!-- main sector details -->
							<tr>
								<td class="sub_section">মূল খাতের বিবরণ </td>
								<td><input type="checkbox" value="dailyMainLedger" name="role[]"  <?php if(in_array("dailyMainLedger", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<!-- others sector details -->
							<tr>
								<td class="sub_section">আনুসাঙ্গিক খাতের বিবরণ</td>
								<td><input type="checkbox" value="dailySubLedger" name="role[]"  <?php if(in_array("dailySubLedger", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<!-- badgut hiseb -->
							<tr>
								<td colspan="5" class="sub_heading"> বাজেট </td>
							</tr>
	<!-- report section end -->

	<!-- management section start -->
							<tr style="background:#EAEAEA;color:#999999;font-size:16px;font-weight:bold;">
								<td colspan="5">Management Section</td>
							</tr>
							<!-- admin manage -->
							<tr>
								<td colspan="5" class="sub_heading">  Admin ম্যানেজ </td>
							</tr>
							<!-- employee list -->
							<tr>
								<td class="sub_section">কর্মকর্তার তালিকা</td>
								<td><input type="checkbox" value="employeeList" name="role[]"  <?php if(in_array("employeeList", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<!-- employee management -->
							<tr>
								<td class="sub_section">কর্মকর্তার ব্যবস্থাপনা </td>
								<td><input type="checkbox" value="employeeManage" name="role[]" <?php if(in_array("employeeManage", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<!-- role create -->
							<tr>
								<td class="sub_section">Role Create</td>
								<td><input type="checkbox" value="role" name="role[]" <?php if(in_array("role", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<!-- role list create -->
							<tr>
								<td class="sub_section">Role List</td>
								<td><input type="checkbox" value="role_list" name="role[]"  <?php if(in_array("role_list", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<!-- end admin management -->

							<!-- website management start -->
							<tr>
								<td colspan="5" class="sub_heading">  ওয়েব সাইট ম্যানেজ </td>
							</tr>
							<!-- up employee and staff -->
							<tr>
								<td class="sub_section">ইউপি  কর্মকর্তা ও কর্মচারী</td>
								<td><input type="checkbox" value="webSiteUpMemberList" name="role[]"  <?php if(in_array("webSiteUpMemberList", $widget)):echo "checked";endif; ?>></td>
								<td><input type="checkbox" value="webSiteUpMemberUpdate" name="role[]"<?php if(in_array("webSiteUpMemberUpdate", $widget)):echo "checked";endif; ?>></td>
								<td><input type="checkbox" value="webSiteUpMemberDelete,webSiteUpMembterAdd" name="role[]" <?php if(in_array("webSiteUpMemberDelete", $widget)):echo "checked";elseif(in_array("webSiteUpMembterAdd", $widget)):echo "checked";endif; ?>></td>
								<td></td>
							</tr>
							<!-- chairman message -->
							<tr>
								<td class="sub_section">চেয়ারম্যান ম্যাসেজ</td>
								<td><input type="checkbox" value="charimanMessage" name="role[]"  <?php if(in_array("charimanMessage", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<!-- news manage -->
							<tr>
								<td class="sub_section">খবর ম্যানেজ</td>
								<td><input type="checkbox" value="newsManage" name="role[]" <?php if(in_array("newsManage", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<!-- slide manage -->
							<tr>
								<td class="sub_section">Slide ম্যানেজ</td>
								<td><input type="checkbox" value="dynamicSlide" name="role[]" <?php if(in_array("dynamicSlide", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<!--- up map ----->
							<tr>
								<td class="sub_section">ইউপি  ম্যাপ</td>
								<td><input type="checkbox" value="upMap" name="role[]" <?php if(in_array("upMap", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							
							<!-- union porishod -->
							<tr>
								<td class="sub_section">ইউনিয়ন পরিষদ</td>
								<td><input type="checkbox" value="unionPorishad" name="role[]" <?php if(in_array("unionPorishad", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<!-- website section end -->

							<!-- website tools start -->
							<tr>
								<td class="sub_section"> ওয়েব সাইট টুলস্</td>
								<td colspan="4"><input type="checkbox" value="toolSetting" name="role[]" <?php if(in_array("toolSetting", $widget)):echo "checked";endif; ?>></td>
							</tr>
							<!-- website tools end -->
	<!-- management section end -->

	<!-- setup section start -->
							<tr style="background:#EAEAEA;color:#999999;font-size:16px;font-weight:bold;">
								<td colspan="5">Setup Section</td>
							</tr>
							<!-- setup menu -->
							<tr>
								<td colspan="5" class="sub_heading">   সেটআপ মেনু </td>
							</tr>
							
							
							<!-- acounting setup -->
							<tr>
								<td class="sub_section">একাউন্টিং সেটআপ</td>
								<td><input type="checkbox" value="newAccEntry" name="role[]" <?php if(in_array("newAccEntry", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							
							<!-- main sector add -->
							<tr>
								<td class="sub_section">আয়ের মূল খাত </td>
								<td><input type="checkbox" value="mainCtgEntry" name="role[]" <?php if(in_array("mainCtgEntry", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<!-- others sector add -->
							<tr>
								<td class="sub_section">আয়ের আনুসাঙ্গিক খাত</td>
								<td><input type="checkbox" value="SubCtgEntry" name="role[]" <?php if(in_array("SubCtgEntry", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<!-- costing sector -->
							<tr>
								<td class="sub_section">খরচের  মূল খাত</td>
								<td><input type="checkbox" value="ExpCtgEntry" name="role[]" <?php if(in_array("ExpCtgEntry", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<!-- costing cause -->
							<tr>
								<td class="sub_section">খরচের আনুসাঙ্গিক খাত  </td>
								<td><input type="checkbox" value="ExpSubCtgEntry" name="role[]" <?php if(in_array("ExpSubCtgEntry", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<!-- end setup menu -->

							<!-- setting menu start -->
							<tr>
								<td colspan="5" class="sub_heading">Settings Menu</td>
							</tr>

							<!-- password change -->
							<tr>
								<td class="sub_section">প্রোফাইল পরিবর্তন</td>
								<td><input type="checkbox" value="changePassword" name="role[]"  <?php if(in_array("changePassword", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<!-- profile change -->
							<tr>
								<td class="sub_section">এডমিন প্রোফাইল </td>
								<td><input type="checkbox" value="adminProfile" name="role[]" <?php if(in_array("adminProfile", $widget)):echo "checked";endif; ?>></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
	<!-- ends settings menu -->
							<tr>
								<td colspan="5"></td>
							</tr>
						</tbody>
					</table>

					<table>
						<tr>
							<td>
								<input type="submit" name="update"  Value="Update" class="btn btn-info btn-sm" style="font-family:tahoma;margin-left:350px;margin-bottom:10px;margin-top:10px;" />
							</td>
						</tr>
					</table>
				</form>
			</div><!---- end table-responsive----->
		</div><!---/ end row -------->
	</div><!--- col-sm-10------>	
</div>
<?php else: ?>
	<div>
		<pre style="color:red;">Sorry !.No ACL Information found.Bad request.</pre>
	</div>
<?php endif; ?>