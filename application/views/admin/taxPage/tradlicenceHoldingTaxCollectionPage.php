<script type="text/javascript"> 
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
	function numtest(){
			return event.charCode >= 48 && event.charCode <= 57;
		}
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