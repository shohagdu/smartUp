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
				<button class="btn btn-custom-head btn-block btn-sm " style="font-size:16px;margin-bottom:20px;">SMS Role Widget </button>
			</div>
		</div>


		<div class="row" style="padding:4px;width:100%;border:2px solid lightgray;margin-left:0px;">
			<div class="table-responsive" style="padding: 20px;box-sizing: border-box;">
				<form action="index.php" method="POST" >
					<table cellspacing="2" class="table" style="margin-top:15px;" >
						<thead>

							<tr>
								<td colspan="6" style="height:5px;background:#fff;"></td>
							</tr>

							<tr style="height:20px;">
								<th style="text-align:left;">All Widget &nbsp;&nbsp;
									<input type="checkbox" id="checkallrole"  onClick="toggle(this)" value="" name="checkall">
								</th>
								<th><b style="font-size: 18px;">On</b></th> 
								<th><b style="font-size: 18px;">Off</b></th> 
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
								<td><input type="checkbox"  value="nagorickSmsOn" name="role[]"></td>
								<td><input type="checkbox"  value="nagorickSmsOff" name="role[]"></td>
							</tr>	
	<!-- certificate -->
							<tr>
								<td class="sub_section"> সনদ প্রদানকারিগণ </td>
								<td><input type="checkbox"  value="nagorickSmsOn" name="role[]"></td>
								<td><input type="checkbox"  value="nagorickSmsOff" name="role[]"></td>
							</tr>
	<!-- certificate end -->
	<!-- trad licese section -->

							<tr>
								<td colspan="5" class="sub_heading">  ট্রেড লাইসেন্স আবেদন</td>
							</tr>
							<!-- new applicant -->
							<tr>
								<td class="sub_section"> নতুন আবেদনকারীগণ </td>
								<td><input type="checkbox"  value="tradelicenseSmsOn" name="role[]"></td>
								<td><input type="checkbox"  value="tradelicenseSmsOff" name="role[]"></td>
							</tr>

							<!--  license given -->
							<tr>
								<td class="sub_section"> সনদ প্রদানকারিগণ </td>
								<td><input type="checkbox"  value="tradelicenseSmsOn" name="role[]"></td>
								<td><input type="checkbox"  value="tradelicenseSmsOff" name="role[]"></td>
							</tr>
							<tr>
								<td colspan="5" class="sub_heading"> ওয়ারিশ আবেদন</td>
							</tr>
							<!-- new applicant -->
							<tr>
								<td class="sub_section"> নতুন আবেদনকারীগণ </td>
								<td><input type="checkbox"  value="oarishSmsOn" name="role[]"></td>
								<td><input type="checkbox"  value="oarishSmsOff" name="role[]"></td>
							</tr>

							<!--  license given -->
							<tr>
								<td class="sub_section"> সনদ প্রদানকারিগণ </td>
								<td><input type="checkbox"  value="oarishSmsOn" name="role[]"></td>
								<td><input type="checkbox"  value="oarishSmsOff" name="role[]"></td>
							</tr>
							
						</tbody>
					</table>

					<table>
						<tr>
							<td>
								<input type="submit" name="add"  Value="Submit" class="btn btn-info btn-sm" style="font-family:tahoma;margin-left:350px;margin-bottom:10px;margin-top:10px;" />
							</td>
						</tr>
					</table>
				</form>
			</div><!---- end table-responsive----->
		</div><!---/ end row -------->
	</div><!--- col-sm-10------>	
</div>	