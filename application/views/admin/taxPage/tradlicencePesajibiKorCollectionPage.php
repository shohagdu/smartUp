<script type="text/javascript"> 
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