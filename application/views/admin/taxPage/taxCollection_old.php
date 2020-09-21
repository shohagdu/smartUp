<script>
 function taxSelect(mstatus){
   // this function call boybahik obosthan id onclick event
  
 //  $("#clientDataPasha").trigger('reset');
   //var mstatus=ms;
   var holdingType= $("#holdingType").val();
   if(mstatus=='1'){
		$("#holdType").show();
		$(".EntryData").show(); 
		$("#enTrade1").hide();
		$("#enTrade2").hide();

		/*$("#txtHintTrade").hide(); 
		$("#txtHint").hide();*/
		
		//alert('feni');
		
		
		 $("#clientDataPasha").trigger('reset');
		 $("#tradeLicence").trigger('reset');
   }
   
   
   else if(mstatus=='2'){
		$("#enTrade1").show();
		$("#holdType").hide();
		$(".EntryData").hide(); 
		$("#enTrade2").hide();
		 $("#enHolding").hide();
		 
		 
		/*$("#txtHintTrade").hide(); */
		$("#textOldClient").hide(); 
		 
		/* $("#tradeLicence").trigger('reset');
		 $("#clientData").trigger('reset');*/
		  $("#tradeLicence").trigger('reset');
		 
   }else if(mstatus=='3'){
		$("#enTrade2").show();
		$("#enTrade1").hide();
		$("#holdType").hide();
		$(".EntryData").hide(); 
		$("#enHolding").hide();
		
		
		
		$("#textOldClient").hide();
		/*$("#txtHint").hide();*/
		 
		 /* $("#clientDataPasha").trigger('reset');
		  $("#clientData").trigger('reset');*/
		   $("#clientDataPasha").trigger('reset');
		 
		
   }

 
 }
 
 function hold(h){
	 if(h==1){
		 
		 $(".EntryData").show();
		 $("#holdType").show();
		 $("#enTrade2").hide();
		 $("#enTrade1").hide();
		 $("#enHolding").hide();
	 }
	 else if(h==2){
		$("#enHolding").show();
		$("#holdType").show();
		$(".EntryData").hide();
		$("#enTrade2").hide();
		$("#enTrade1").hide();
		
		
	 }
 }
 
	// for date......... datepicker function ...........
	$(function() {
		$("#dofb").datepicker();
	});
	$(function() {
		$(".payDate").datepicker();
	});
 
</script>

	<!----new client--------for বসতভিটার কর-------start--------------->
	<script>
		$(document).ready(function(){
		$('#clientData').submit(function(){ 
			$.post(
				"Admin/newBosotbitaTaxCollection",
				$("#clientData").serialize(),  
					function(data){
						if(data==4){alert('নাম দিতে হবে');}
						else if(data==5){alert('পিতার নাম দিতে হবে');}
						else if(data==6){alert('মোবাইল নাম্বাটা দিতে হবে');	 }
						else if(data==7){alert('দাগ নং দিতে হবে');	 }
						
						if(data==1)
						{
							alert('আপনার বসত ভিটার কর সঠিকভাবে গৃহীত হয়েছে');
							window.location='Admin/taxCollection';
							window.open('Money_receipt/bosodbitakorMoneyReceipt', '_blank')
							
						}
						if(data==3){
							//window.location='index.php/confirm/bosodNewConfirm';
							window.location='Confirm/newBosodbitaTaxConfirm';
						}
						else{
							alert(data);
						}
						
				 });
			 return false;
			 });
		});	
	</script>
	<!----new client--------for বসতভিটার কর-------end--------------->
	
	
	<!--------------- for old  বসতভিটার কর start ------------------>
	<script>
		$(document).ready(function(){
			$('#oldClientData').submit(function(){
				$.post(
					"Admin/oldBosotbitaTaxCollection",
					$("#oldClientData").serialize(),  
						function(data){ 
							if(data==4){alert('দু:খিত টাকার পরিমান দিতে হবে..');}
							if(data==5){alert('Enter Payment Date');}

							if(data==1)
							{
								alert('আপনার বসত ভিটার কর সঠিকভাবে গৃহীত হয়েছে');
								window.location='Admin/taxCollection';
								window.open('Money_receipt/bosodbitakorMoneyReceipt', '_blank')
							}
							if(data==3){
								window.location='Confirm/oldBosodbitaTaxConfirm';
								
							}
							/*if(data==6)
							{
								alert('দু:খিত পূর্বে বসত ভিটা কর নেয়া হয়েছে');
								window.location='index.php/admin/allroshid?id=1';
							}*/
							//else{alert(data);}
						});
				 return false;
			});
		});	
	</script>
	<script type="text/javascript"> <!--------this is for Client Search ------>
		$("document").ready(function(){
			$("#dagNoOld").keyup(function(){
				var dagNo=$("#dagNoOld").val();
				//alert(dagNo);
				if(dagNo.trim()==""){
					$('#oldClientData').trigger('reset');
					document.getElementById('error').innerHTML="";
					exit();
				}
				$.ajax({
					url:"Admin/searchHolding?id=1",
					data:{dagNo:dagNo},
					type:"GET",
					success:function(hr){
					//var result=hr.responseText;

					//alert(hr);
					if(hr==1){
						document.getElementById('error').innerHTML="আপনার দাগ নং টি সঠিক নয়";
						var dagno = document.getElementById('dagNoOld').value;
						$('#oldClientData').trigger('reset');
						document.getElementById('dagNoOld').value=dagno;
						}
						else{
							document.getElementById('error').innerHTML="";
							var d=hr.split(",");
							document.getElementById('showName').value=d[0];
							document.getElementById('showfather').value=d[1];
							document.getElementById('birhCerti').value=d[2];
							document.getElementById('nation').value=d[3];
							document.getElementById('showVillage').value=d[4];
							document.getElementById('showWord').value=d[5];
							document.getElementById('showMobile').value=d[6];
							document.getElementById('ShowdagNo1').value=d[7];

						}
					}
				});
			});
		});
	</script>
	
	<script><!--------------for  বসত ভিটা history ----------------->
		function showBosodStd(str) {
			if (str=="") {
				document.getElementById("showHistoryBosodbita").innerHTML="";
				return;
			}
			if (window.XMLHttpRequest) {
				xmlhttp=new XMLHttpRequest();
			} else { 
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("showHistoryBosodbita").innerHTML=xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET","Admin/historyBosod?q="+str,true);
			xmlhttp.send();
		}
	</script>
	
	
	<!--------------- for old  বসতভিটার কর end -------------------->
	
	
	<!------this is for Trade License pesha zibi kor start---------------->

	<script>
		$(document).ready(function(){
			$('#clientDataPasha').submit(function(){ 
				$.post(
				"Admin/peshaZibikorTaxCollection",
				$("#clientDataPasha").serialize(),  
				function(data){ 
					if(data==4){alert('দু:খিত টাকার পরিমান দিতে হবে..');}	
					if(data==5){alert('Enter  Payment Date');}	
					if(data==1)
					{
						alert('Successfully Inserted Your data');
						window.location='Admin/taxCollection';
						window.open('Money_receipt/peshaMoneyReceipt', '_blank');
					}
					if(data==3)
					{
						//alert('দু:খিত পূর্বে পেশাজীবি  কর নেয়া হয়েছে');
						window.location='Confirm/peshaTradeConfirm';
					}

					//else{alert(data);}
				});
				return false;
			});
		});	
	</script>
	<script type="text/javascript"> <!-- information search --->
		$("document").ready(function(){
			$("#tradLicenceId").keyup(function(){
				var tradLicenceId=$("#tradLicenceId").val();
				if(tradLicenceId.trim()==""){
					$('#clientDataPasha').trigger('reset');
					document.getElementById("errorTrede").innerHTML="";
					exit();
				}
				$.ajax({
					url:"Admin/searchTrade?id=1",
					data:{tradLicenceId:tradLicenceId},
					type:"GET",
					success:function(hr){
						if(hr==1){
							document.getElementById("errorTrede").innerHTML=" আপনার ট্রেড লাইসেন্সের নাম্বটা  সঠিক নয়";
							var licenseId = document.getElementById('tradLicenceId').value;
							$('#clientDataPasha').trigger('reset');
							document.getElementById('tradLicenceId').value=licenseId;
						}
						else{
							document.getElementById("errorTrede").innerHTML="";
							var d=hr.split(",");
							document.getElementById('tredeCompany').value=d[0];
							document.getElementById('tredeOwner').value=d[1];
							document.getElementById('tredeVillage').value=d[2];
							document.getElementById('tredeWord').value=d[3];
							document.getElementById('tredeMobile').value=d[4];
						}
					}
				});
			});
		});
	</script>
	
	<script> <!---পেশাজীবি history search----------------->
		function showUser(str) {
			if (str=="") {
				document.getElementById("showHistoryPeshazibikor").innerHTML="";
				return false;
			}
			if (window.XMLHttpRequest) {
				xmlhttp=new XMLHttpRequest();
			} else { 
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("showHistoryPeshazibikor").innerHTML=xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET","Admin/historyPesha?q="+str,true);
			xmlhttp.send();
		}
	</script>

	
	<!------this is for Trade License pesha zibi kor end---------------->
	
	
	<!---- tradel license bosotbita kor start----------->
	<script>
		$(document).ready(function(){
			$('#tradeLicenceBosodbita').submit(function(){ 
				$.post(
					"Admin/boshodbitakorTaxCollection",
					$("#tradeLicenceBosodbita").serialize(),  
						function(data){ 
							if(data=='4'){alert('দু:খিত টাকার পরিমান দিতে হবে..');}
							if(data=='5'){alert('Enter Your Payment Date');}
							if(data==1)
							{
								alert('Successfully Inserted Your data');
								window.location='Admin/taxCollection';
								window.open('Money_receipt/tradeBosodbitakorMoneyReceipt', '_blank')
							}
							if(data==3)
							{
								//window.location='index.php/admin/allroshid?id=3';
								window.location='Confirm/tradeBosodbitaTaxConfirm';
							}
							else{
								//alert(data);
							}
						});
				 return false;
			});
		});
	</script>
	
	<script type="text/javascript">
		$("document").ready(function(){
			$("#tradLicenceIdnew").keyup(function(){
				var tradLicenceIdnew=$("#tradLicenceIdnew").val();
				//alert(tradLicenceIdnew);
				if(tradLicenceIdnew.trim()==""){
					$('#tradeLicenceBosodbita').trigger('reset');
					document.getElementById('errorTradPasha').innerHTML="";
					exit();
				}
				$.ajax({
					url:"Admin/searchTradebosodbita?id=1",
					data:{tradLicenceIdNew:tradLicenceIdnew},
					type:"GET",
					success:function(hr){
						//var result=hr.responseText;
						// errorTradPasha
						if(hr==1){
							document.getElementById('errorTradPasha').innerHTML="আপনার ট্রেড লাইসেন্সের নাম্বটা সঠিক নয়";
							var licenseId = document.getElementById('tradLicenceIdnew').value;
							$('#tradeLicenceBosodbita').trigger('reset');
							document.getElementById('tradLicenceIdnew').value=licenseId;
						}
						else{
							document.getElementById('errorTradPasha').innerHTML="";
							var d=hr.split(",");

							document.getElementById('tredeCompanyTwo').value=d[0];
							document.getElementById('tredeOwnerTwo').value=d[1];
							document.getElementById('tredeVillageTwo').value=d[2];
							document.getElementById('tredeWordTwo').value=d[3];
							document.getElementById('tredeMobileTwo').value=d[4];
						}

					}
				});
			});
		});
	</script>
	<script>	<!---history ট্টেড লাইসেন্সের  bosodbita kor ----------------->
		function tradePhasa(str) {
			if (str=="") {
					document.getElementById("showTradeBosodbitakor").innerHTML="";
					return;
				}
			if (window.XMLHttpRequest) {

				xmlhttp=new XMLHttpRequest();
			} else { 
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("showTradeBosodbitakor").innerHTML=xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET","Admin/historyTradepesha?q="+str,true);
			xmlhttp.send();
		}
	</script>
	<script type="text/javascript"> 
		/*============ number test function start ===============*/
		function numtest(){
			return event.charCode >= 48 && event.charCode <= 57;
		}
		/*============ number test function end===============*/
	</script>
	<!---- tradel license bosotbita kor start----------->

	<div id="content" class="col-lg-10 col-sm-10">
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-xs-12"> 
				<button class="btn btn-custom-info btn-block btn-sm" style="font-size:16px;margin-bottom:10px;font-weight: bolder;">বসত ভিটা ও পেশাজীবি কর আদায়</button>
			</div>
		</div>
		<style>
			#content ul li{background:none;}
			.container{width:100%;}
		</style>
		<div class="row box" style="padding-bottom:20px;margin-top:10px;">
			<div class="container"> 
				<ul class="nav nav-tabs" id="myTab">
					<li class="active"><a data-toggle="tab" href="#menu" style="font-size:14px;">নতুন বসতভিটার কর  আদায়</a></li>
					<li><a data-toggle="tab" href="#menu1" style="font-size:14px;">পুরাতন বসতভিটার কর আদায়</a></li>
					<li><a data-toggle="tab" href="#menu2" style="font-size:14px;">ট্রেড লাইসেন্সধারির পেশাজীবি কর</a></li>
					<li><a data-toggle="tab" href="#menu3" style="font-size:14px;">ট্রেড লাইসেন্সধারির বসত ভিটা কর</a></li>
				</ul>
				<div class="tab-content"> 
				<!----new client--------for বসতভিটার কর-------start--------------->
					<div id="menu" class="tab-pane fade in active" style="background:none;">
						<form action="Admin/newBosotbitaTaxCollection" method="post" id="clientData" >
							<div class="EntryData">
								<div class="form-group">
									<label class="control-label col-xs-12 " style="text-decoration:underline;">
										<h3 style="font-size: 20px;color: gray;margin-bottom: 20px;">নতুন বসতভিটার কর আদায়:</h3> 
									</label>
								</div>
								<div class="clearfix"></div>
								<div class="form-group">
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right;">নাম</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="name" id="name" class="form-control">
									</div>
									<label class="control-label col-sm-2 col-xs-4" for="" style="text-align:right">পিতার নাম</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="fatherName" id="fatherName" class="form-control">
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2 col-xs-4 " style="text-align:right">জন্ম নিবন্ধন নং</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="nid" id="nid" class="form-control" />
									</div>
									<div class="visible-xs clearfix"></div>
									<label class="control-label col-sm-2 col-xs-4 " style="text-align:right">জাতীয় পরিচয় পত্র নং</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="bid"  id="bid" class="form-control" />
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right">গ্রাম</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="village" id="village" class="form-control">
									</div>
									<div class="visible-xs clearfix"></div>
									<label class="control-label col-sm-2 col-xs-4 " style="text-align:right">ওয়ার্ড নং</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="wordNo" id="wordNo" class="form-control" onkeypress="return numtest();" placeholder="ইংরেজীতে প্রদান করুন" >
										<!---
										<select name="wordNo" id="wordNo" class="form-control">
											<option value="0">---Select one----</option>
											<?php 
												$word_no = $this->db->query("SELECT * FROM word_member order by word_no asc")->result();
												foreach($word_no as $word){
											?>
												<option value="<?php echo $word->word_no;?>"><?php echo $word->word_no;?></option>
											<?php 
												}
											?>	
										</select>--->
										
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2 col-xs-4 " style="text-align:right">হোল্ডিং নং</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="holdingNumber" id="holdingNumber" class="form-control" onkeypress="return numtest();" placeholder="ইংরেজীতে প্রদান করুন" />
									</div>
									<div class="visible-xs clearfix"></div>
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right">দাগ নং</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="dagNo" id="dagNo" class="form-control" onkeypress="return numtest();" placeholder="ইংরেজীতে প্রদান করুন" />
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2 col-xs-4 " style="text-align:right;">মোবাইল নং</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="mobileNo" id="mobileNo" class="form-control" maxlength="11">
									</div>
									<div class="visible-xs clearfix"></div>
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right;">টাকার পরিমান</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="money" class="form-control" onkeypress="return numtest();" placeholder="ইংরেজীতে প্রদান করুন" />
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right;">Payment Date</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="payment_date" value="<?php echo date('m/d/Y'); ?>" class="form-control" id="dofb" >
									</div>
									<div class="visible-xs clearfix"></div>
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right"></label>
									<div class="col-sm-4 col-xs-8">
										<input type="submit" name="submitBtn" value="Save" class="btn btn-info btn-sm">
										<input type="hidden" name="gtype" value="newBosod">
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</form>
					</div>
				<!----new client--------for বসতভিটার কর-------end--------------->
				<!----old client----for বসতভিটার কর-----------start--------------->
					<div id="menu1" class="tab-pane fade">
						<form action="Admin/oldBosotbitaTaxCollection" method="post" id="oldClientData">
							<div class="form-group">
								<label class="control-label col-sm-12 col-xs-12" style="text-decoration:underline;">
									<h3 style="font-size: 20px;color: gray;margin-bottom: 20px;">পুরাতন বসতভিটার কর আদায়:</h3> 
								</label>
							</div>
							<div class="clearfix"></div>
							<div class="form-group" id="enHolding">
								<label class="control-label col-sm-3" style="text-align:right;padding-bottom:10px;"></label>
								<div class="col-sm-6 col-xs-12" style="padding-bottom:10px;">
									<input type="text" name="dagNoOld" id="dagNoOld" onkeyup="showBosodStd(this.value)" class="form-control" required placeholder="আপনার দাগ নং ইংরেজীতে  প্রদান করুন" onkeypress="return numtest();" />
								</div>
								<div class="clearfix"></div>
								<div class="col-sm-4"></div>
								<div class="col-sm-6 col-xs-12">
									<span id="error" style="font-size:20px;color:red;"></span>
								</div>
								
								<div class="clearfix"></div>
								
								<div class="form-group" style="margin-top: 10px;">
									<label class="control-label col-sm-2 col-xs-4 " style="text-align:right">নাম</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="showName" id="showName" class="form-control">
									</div>
									<div class="visible-xs clearfix"></div>
									<label class="control-label col-sm-2 col-xs-4 " style="text-align:right">পিতার নাম</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="showfather" id="showfather" class="form-control">
									</div>
									<div class="clearfix"></div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-2 col-xs-4 " style="text-align:right">জন্ম নিবন্ধন নং</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="birhCerti" id="birhCerti" class="form-control">
									</div>
									<div class="visible-xs clearfix"></div>
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right">জাতীয় পরিচয় পত্র</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="nation" id="nation" class="form-control">
									</div>
									<div class="clearfix"></div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-2 col-xs-4 " style="text-align:right">গ্রাম</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="showVillage" id="showVillage" class="form-control">
									</div>
									<div class="visible-xs clearfix"></div>
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right">ওয়ার্ড নং</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="showWord" id="showWord" class="form-control">
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right">দাগ নং </label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="ShowdagNo1" id="ShowdagNo1" class="form-control">
									</div>
									<div class="visible-xs clearfix"></div>
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right">মোবাইল নং</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="showMobile" id="showMobile" class="form-control">
									</div>
									<div class="clearfix"></div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right">Payment Date</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="payDate" id="payDate" value="<?php echo date('m/d/Y'); ?>" class="form-control  payDate">
									</div>
									<div class="visible-xs clearfix"></div>
									<label class="control-label col-sm-2 col-xs-4 " style="text-align:right">টাকার পরিমান</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="money" id="money" class="form-control"onkeypress="return numtest();" placeholder="ইংরেজীতে প্রদান করুন" />
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-2 " style="text-align:right"></label>
									<div class="col-xs-4" style="padding-bottom:10px;"></div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-3 col-sm-2 " style="text-align:right"></label>
									<div class="col-sm-4" ></div>
									<div class="col-sm-4 col-xs-9" >
										<input type="submit" name="moneyRecit" class="btn btn-info btn-sm" value="Money Receipt">
										<input type="hidden" name="moneyRec" value="MoneyReceipt">
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</form>
						<div class="row"> 
							<div class="col-lg-12 col-sm-12"> 
								<div id="showHistoryBosodbita"></div>
							</div>
						</div>
					</div>
				<!----old client----for বসতভিটার কর-----------end--------------->	
				
				<!----trade license এর পেশাজীবি কর start------------------------->
					<div id="menu2" class="tab-pane fade">
						<form action="Admin/peshaZibikorTaxCollection" method="post" id="clientDataPasha">	
							<div class="form-group">
								<label class="control-label col-sm-12 col-xs-12" style="text-decoration:underline;">
									<h3 style="font-size: 20px;color: gray;margin-bottom: 20px;">ট্রেড লাইসেন্সধারির পেশাজীবি কর আদায়</h3> 
								</label>
							</div>
							<div class="clearfix"></div>
							<div class="form-group" id="enTrade1">
								<label class="control-label col-sm-3 " style="text-align:right;padding-bottom:10px;"></label>
								<div class="col-sm-6 col-xs-12" style="padding-bottom:10px;">
									<input type="text" name="tradLicenceId" id="tradLicenceId" class="form-control" onkeyup="showUser(this.value)" required placeholder="আপনার ট্রেড লাইসেন্সের সনদের নাম্বাটা ইংরেজীতে প্রদান করুন" />
								</div>
								<div class="clearfix"></div>
								<div class="col-sm-4"></div>
								<div class="col-sm-6 col-xs-12">
									<span id="errorTrede" style="font-size:20px;color:red;"></span>
								</div>
								<div class="clearfix"></div>	
								<div class="form-group" style="margin-top: 10px;">
									<label class="control-label col-sm-2 col-xs-4 " style="text-align:right">প্রতিষ্টানের  নাম</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="tredeName" id="tredeCompany" class="form-control">
									</div>
									<div class="visible-xs clearfix"></div>
									<label class="control-label col-sm-2  col-xs-4 " style="text-align:right">মালিকানার ধরন</label>
									<div class="col-sm-4  col-xs-8">
										<input type="text" name="tredeOwner" id="tredeOwner" class="form-control"    >
									</div>
									<div class="clearfix"></div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-2 col-xs-4 " style="text-align:right">গ্রাম</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="tredeVillage" id="tredeVillage" class="form-control">
									</div>
									<div class="visible-xs clearfix"></div>
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right">ওয়ার্ড নং</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="tredeWord" id="tredeWord" class="form-control">
									</div>
									<div class="clearfix"></div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right">মোবাইল নং</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="tredeMobile" id="tredeMobile" class="form-control">
									</div>
									<div class="visible-xs clearfix"></div>
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right">টাকার পরিমান</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="tredemoney" id="tredemoney" class="form-control" onkeypress="return numtest();" placeholder="ইংরেজীতে প্রদান করুন" />
									</div>
									<div class="clearfix"> </div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right;">Payment Date</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="payment_date" value="<?php echo date('m/d/Y'); ?>" class="form-control payDate"  >
									</div>
									<div class="visible-xs clearfix"></div>
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right"></label>
									<div class="col-sm-4 col-xs-8" >
										<input type="submit" name="moneyRecit" class="btn btn-info btn-sm" value="Money Receipt">
										<input type="hidden" name="moneyRecit" value="MoneyReceipt">
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</form>
						<div class="row"> 
							<div class="col-lg-12 col-sm-12"> 
								<div id="showHistoryPeshazibikor"></div>
							</div>
						</div>
					</div>
				<!----trade license এর পেশাজীবি কর end------------------------->	
				<!----trade license এর বসতভিটার কর start------------------------->
					<div id="menu3" class="tab-pane fade">
						<form action="Admin/boshodbitakorTaxCollection" method="post" id="tradeLicenceBosodbita">
							<div class="form-group">
								<label class="control-label col-sm-12 col-xs-12" style="text-decoration:underline;">
									<h3 style="font-size: 20px;color: gray;margin-bottom: 20px;">ট্রেড লাইসেন্সধারির বসতভিটার কর আদায় :</h3> 
								</label>
							</div>
							<div class="clearfix"></div>
							<div class="form-group" id="enTrade2">
								<label class="control-label col-sm-3 " style="text-align:right;padding-bottom:10px;"></label>
								<div class="col-sm-6 col-xs-12" style="padding-bottom:10px;">
									<input type="text" name="tradLicenceId" id="tradLicenceIdnew" required onkeyup="tradePhasa(this.value)" class="form-control" placeholder="আপনার ট্রেড লাইসেন্সের সনদের নাম্বাটা ইংরেজীতে প্রদান করুন " />
								</div>
								<div class="clearfix"></div>
								<div class="col-sm-4" style="padding-bottom:10px;"></div>
								<div class="col-sm-6 col-xs-12">
									<span id="errorTradPasha" style="font-size:20px;color:red;"></span>
								</div>
								<div class="clearfix"></div>
								<div class="form-group" style="margin-top: 10px;">
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right">প্রতিষ্টানের  নাম</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="tredeName" id="tredeCompanyTwo" class="form-control">
									</div>
									<div class="visible-xs clearfix"></div>
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right">মালিকানার ধরন</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="tredeOwner" id="tredeOwnerTwo" class="form-control">
									</div>
									<div class="clearfix"></div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right">গ্রাম</label>
									<div class="col-sm-4  col-xs-8">
										<input type="text" name="tredeVillage" id="tredeVillageTwo" class="form-control">
									</div>
									<div class="visible-xs clearfix"></div>
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right">ওয়ার্ড নং</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="tredeWord" id="tredeWordTwo" class="form-control">
									</div>
									<div class="clearfix"></div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right">মোবাইল নং</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="tredeMobile" id="tredeMobileTwo" class="form-control">
									</div>
									<div class="visible-xs clearfix"></div>
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right">টাকার পরিমান</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="tredemoney" id="tredemoneyTwo" class="form-control" onkeypress="return numtest();" placeholder="ইংরেজীতে প্রদান করুন " />
									</div>
									<div class="clearfix"></div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right">Payment Date</label>
									<div class="col-sm-4 col-xs-8">
										<input type="text" name="payment_date" value="<?php echo date('m/d/Y'); ?>" class="form-control payDate"  >
									</div>
									<div class="visible-xs clearfix"></div>
									<label class="control-label col-sm-2 col-xs-4" style="text-align:right"></label>
									<div class="col-sm-4 col-xs-8" >
										<input type="submit" name="moneyRecit" class="btn btn-info btn-sm" value="Money Receipt">
										<input type="hidden" name="moneyRecit2" class="btn btn-success" value="MoneyReceipt">
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</form>
						<div class="row"> 
							<div class="col-lg-12 col-sm-12"> 
								<div id="showTradeBosodbitakor"></div>
							</div>
						</div>
					</div>
				<!----trade license এর বসতভিটার কর end------------------------->
				</div><!--- /tab content------>
			</div><!-- /container------->
		</div><!-- /row box---->
		<!-- <div class="row"> 
			<div class="col-lg-12 col-sm-12"> 
				<div id="txtHint"></div>
			</div>
		</div> -->
	</div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
