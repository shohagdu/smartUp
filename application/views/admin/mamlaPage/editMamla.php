<script>
	// for date......... datepicker function ...........
	// mamla date....
	$(function() {
		$("#mamla_date").datepicker();
	});
	// sunani date....
	$(function() {
		$("#sunani_date").datepicker();
	});
 
</script>

	<!----new client--------for বসতভিটার কর-------start--------------->
	<script>
		$(document).ready(function(){
		$('#mamlaData').submit(function(){ 
			$.post(
				"Admin/editAllmamlaInfo",
				$("#mamlaData").serialize(),  
					function(data){
						if(data==9){alert("বিষয় প্রদান করুন ");}
						else if(data==8){alert("মামলা এবং শুনানীর তারিখ ঠিকমত প্রদান করুন ");	 }
						
						
						else if(data==1)
						{
							alert('আপনার মামলা সঠিকভাবে আপডেট হয়েছে ');
							window.location='Admin/mamlaNotice';
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
	
	<script type="text/javascript"> 
		/*============ number test function start ===============*/
		function numtest(){
			return event.charCode >= 48 && event.charCode <= 57;
		}
		/*============ number test function end===============*/
	</script>
	<!---- tradel license bosotbita kor start----------->

	<div id="content" class="col-lg-10 col-sm-10">
		<!----
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-xs-12"> 
				<button class="btn btn-custom-head btn-block btn-sm" style="font-size:16px;margin-bottom:10px;">মামলার নোটিশ</button>
			</div>
		</div>----->
		
		<div class="row box" style="padding-bottom:20px;margin-top:10px;">
			<div class="panel panel-default">
				<div class="panel-heading">মামলার নোটিশের তথ্য আপডেট করুন <span class="pull-right"><a href="Admin/mamlaNotice">Back</a></span></div>
				<div class="panel-body">
					<form action="Admin/editAllmamlaInfo" method="post" id="mamlaData" >
						<div class="EntryData">
							<div class="form-group">
								<label for="mamla no" class="control-label col-sm-2 col-xs-4 label-style">মামলা নং</label>
								<div class="col-sm-4 col-xs-8">
									<input type="text" name="mamlaNo" id="mamlaNo" value="<?php echo $mamlaInfo->mamla_no;?>" readonly class="form-control">
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<label for="subject" class="control-label col-sm-2 col-xs-4 label-style">বিষয়</label>
								<div class="col-sm-8 col-xs-8">
									<input type="text" name="subject" id="subject" value="<?php echo $mamlaInfo->subject;?>" class="form-control">
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<label for="mamla date" class="control-label col-sm-2 col-xs-4 label-style">মামলার তারিখ</label>
								<div class="col-sm-4 col-xs-8">
									<input type="text" name="mamla_date" id="mamla_date" value="<?php echo $mamlaInfo->mamla_date; ?>" class="form-control">
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<label for="sunanir date" class="control-label col-sm-2 col-xs-4 label-style">শুনানীর তারিখ</label>
								<div class="col-sm-4 col-xs-8">
									<input type="text" name="sunani_date" id="sunani_date" value="<?php echo $mamlaInfo->sunani_date;?>" class="form-control">
								</div>
								<div class="clearfix"></div>
							</div>
							
							<div class="form-group">
								<div class="col-sm-12 col-xs-12">
									<div class="panel panel-default">
										<div class="panel-heading sub-heading-style">বাদীর তথ্য:</div>
										<div class="panel-body">
											<div id="queryData" style="margin-bottom: 20px;">
												<div class="row"> 
													<div class="col-sm-12 col-xs-12">
														<div class="form-group">
															<div class="col-sm-3 col-sm-offset-2 ">নাম</div>
															<div class="col-sm-3 ">পিতার নাম</div>
															<div class="col-sm-2 ">গ্রাম</div>
														</div>
													</div>
												</div>
												<div class="row"> 
													<div class="col-sm-12 col-xs-12">
														<div class="form-group">
														<?php 
															$nr = 1;
															foreach($badiInfo as $badi_row):
														?>
															<div class="col-sm-3 col-sm-offset-1" style="margin-bottom: 15px;">
																<input type="text" name="badin" id="badin<?php echo $nr;?>" value="<?php echo $badi_row->badi_name;?>" class="form-control" />
															</div>
															<div class="col-sm-3" style="margin-bottom: 15px;">
																<input type="text" name="badif" id="badif<?php echo $nr;?>" value="<?php echo $badi_row->badi_father_name;?>" class="form-control" />
															</div>
															<div class="col-sm-3" style="margin-bottom: 15px;">
																<input type="text" name="badig" id="badig<?php echo $nr;?>"  value="<?php echo $badi_row->gram;?>" class="form-control classbadiGramArry" />
															</div>
															<div class="col-sm-1" style="margin-bottom: 15px;">
																<input type="button" onclick="unOnebadi(<?php echo $badi_row->id?>,badin<?php echo $nr?>.value,badif<?php echo $nr?>.value,badig<?php echo $nr?>.value);" value="Update" class="btn btn-success btn-sm" />
															</div>
															<div class="col-sm-1" style="margin-bottom: 15px;">
																<input type="button" onclick="badiDel(<?php echo $badi_row->id?>);" value="Delete" class="btn btn-danger btn-sm" />
															</div>
														<?php $nr++;endforeach;?>	
														</div>
													</div>
												</div>
											</div>
										
										
											<div class="row"> 
												<div class="col-sm-12 col-xs-12">
													<div class="form-group">
														<div class="col-sm-3 col-sm-offset-2 ">নাম</div>
														<div class="col-sm-3 ">পিতার নাম</div>
														<div class="col-sm-2 ">গ্রাম</div>
													</div>
												</div>
											</div>
											<div class="row"> 
												<div class="col-sm-12 col-xs-12">
													<div class="form-group">
														<div class="col-sm-3 col-sm-offset-1">
															<input type="text" name="badi_name[]" id="badiName" class="form-control" />
														</div>
														<div class="col-sm-3">
															<input type="text" name="badi_father[]" id="badiFather" class="form-control" />
														</div>
														<div class="col-sm-3">
															<input type="text" name="badi_gram_arry[]" id="badiGramArry" class="form-control classbadiGramArry" />
														</div>
														<div class="col-sm-2">
															<input type="button" onclick="addRow(this.form);" value="যোগ করুন" class="btn btn-primary btn-sm" />
														</div>
													</div>
												</div>
											</div>
											<div class="row"> 
												<div class="col-sm-12 col-xs-12" id="itemRows">
													
												</div>
											</div>
											<div class="clearfix"></div>
											<div class="row" style="margin-top:20px;">
												<div class="col-sm-12"> 
													<div class="form-group">
														<label for="Village" class="control-label col-sm-1 col-xs-4 label-style">গ্রাম</label>
														<div class="col-sm-3 col-xs-8">
															<input type="text" name="badi_gram" id="badi_gram" class="form-control" value="<?php echo $mamlaInfo->badi_gram;?>" <?php if($mamlaInfo->badi_gram ==""):?>disabled <?php endif;?>>
														</div>
														<div class="col-sm-4"> 
															<input type='checkbox' id='recom' value='1' <?php if($mamlaInfo->badi_gram !=""):?> checked <?php endif;?> />&nbsp;হাঁ (সবাই একই গ্রামের)
														</div>
														<div class="clearfix"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>	
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<div class="col-sm-12 col-xs-12">
									<div class="panel panel-default">
										<div class="panel-heading sub-heading-style">বিবাদীর তথ্য:</div>
										<div class="panel-body">
											<div id="queryData22" style="margin-bottom: 20px;">
												<div class="row"> 
													<div class="col-sm-12 col-xs-12">
														<div class="form-group">
															<div class="col-sm-3 col-sm-offset-2 ">নাম</div>
															<div class="col-sm-3 ">পিতার নাম</div>
															<div class="col-sm-2 ">গ্রাম</div>
														</div>
													</div>
												</div>
												<div class="row"> 
													<div class="col-sm-12 col-xs-12">
														<div class="form-group">
														<?php 
															$ns = 1;
															foreach($bibadiInfo as $bibadi_row):
														?>
															<div class="col-sm-3 col-sm-offset-1" style="margin-bottom: 15px;">
																<input type="text" name="bibadin" id="bibadin<?php echo $ns;?>" value="<?php echo $bibadi_row->bibadi_name;?>" class="form-control" />
															</div>
															<div class="col-sm-3" style="margin-bottom: 15px;">
																<input type="text" name="bibadif" id="bibadif<?php echo $ns;?>" value="<?php echo $bibadi_row->bibadi_father_name;?>" class="form-control" />
															</div>
															<div class="col-sm-3" style="margin-bottom: 15px;">
																<input type="text" name="bibadig" id="bibadig<?php echo $ns;?>"  value="<?php echo $bibadi_row->gram;?>" class="form-control classbibadiGramArry" />
															</div>
															<div class="col-sm-1" style="margin-bottom: 15px;">
																<input type="button" onclick="unOnebibadi(<?php echo $bibadi_row->id?>,bibadin<?php echo $ns?>.value,bibadif<?php echo $ns?>.value,bibadig<?php echo $ns?>.value);" value="Update" class="btn btn-success btn-sm" />
															</div>
															<div class="col-sm-1" style="margin-bottom: 15px;">
																<input type="button" onclick="bibadiDel(<?php echo $bibadi_row->id?>);" value="Delete" class="btn btn-danger btn-sm" />
															</div>
														<?php $ns++;endforeach;?>	
														</div>
													</div>
												</div>
											</div>
											<div class="row"> 
												<div class="col-sm-12 col-xs-12">
													<div class="form-group">
														<div class="col-sm-3 col-sm-offset-2 ">নাম</div>
														<div class="col-sm-3 ">পিতার নাম</div>
														<div class="col-sm-2 ">গ্রাম</div>
													</div>
												</div>
											</div>
											<div class="row"> 
												<div class="col-sm-12 col-xs-12">
													<div class="form-group">
														<div class="col-sm-3 col-sm-offset-1">
															<input type="text" name="bibadi_name[]" id="bibadiName" class="form-control" />
														</div>
														<div class="col-sm-3">
															<input type="text" name="bibadi_father[]" id="bibadiFather" class="form-control" />
														</div>
														<div class="col-sm-3">
															<input type="text" name="bibadi_gram_arry[]" id="bibadiGramArry" class="form-control classbibadiGramArry" />
														</div>
														<div class="col-sm-2">
															<input type="button" onclick="addRow22(this.form)" value="যোগ করুন" class="btn btn-primary btn-sm" />
														</div>
													</div>
												</div>
											</div>
											<div class="row"> 
												<div class="col-sm-12 col-xs-12" id="itemRows22">
													
												</div>
											</div>
											<div class="clearfix"></div>
											<div class="row" style="margin-top:20px;">
												<div class="col-sm-12"> 
													<div class="form-group">
														<label for="Village" class="control-label col-sm-1 col-xs-4 label-style">গ্রাম</label>
														<div class="col-sm-3 col-xs-8">
															<input type="text" name="bibadi_gram" id="bibadi_gram" value="<?php echo $mamlaInfo->bibadi_gram;?>" class="form-control" <?php if($mamlaInfo->bibadi_gram==""):?> disabled <?php endif;?> >
														</div>
														<div class="col-sm-4"> 
															<input type='checkbox' id='recom22' value='1' <?php if($mamlaInfo->bibadi_gram !=""):?> checked <?php endif;?> />&nbsp;হাঁ (সবাই একই গ্রামের)
														</div>
														<div class="clearfix"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>	
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 col-xs-4" style="text-align:right"></label>
								<div class="col-sm-4 col-xs-8">
									<input type="hidden" name="hid" value="<?php echo $mamlaInfo->id;?>" />
									<input type="submit" name="submitBtn" value="Genarate" class="btn btn-info btn-sm">
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</form>
				</div><!--- body end--->
			</div><!--- panel default end------>
		</div><!-- /row box---->
	</div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
<script type="text/javascript"> 
	var rowNum22 = 0;
	function addRow22(frm){
		var bibadi_name = document.getElementById("bibadiName").value;
		var bibadi_father= document.getElementById("bibadiFather").value;
		if(bibadi_name==""){
			alert("দু:খিত! বিবাদীর নাম দিতে হবে");
		}
		else if(bibadi_father==""){
			alert("দু:খিত! বিবাদীর পিতার নাম দিতে হবে");
		}
		else{
			rowNum22 ++;
			var row = '<div id="rowNum'+rowNum22+'" class="form-group"  style="margin-top:15px;"><div class="col-sm-3 col-sm-offset-1"   style="margin-top:15px;"><input type="text" name="bibadi_name[]" value="'+frm.bibadiName.value+'" class="form-control" /></div><div class="col-sm-3"   style="margin-top:15px;"><input type="text" name="bibadi_father[]" value="'+frm.bibadiFather.value+'" class="form-control" /></div><div class="col-sm-3"   style="margin-top:15px;"><input type="text" name="bibadi_gram_arry[]" value="'+frm.bibadiGramArry.value+'" class="form-control classbibadiGramArry" /></div><div class="col-sm-2"   style="margin-top:15px;"><input type="button" value="Remove" class="btn btn-danger btn-sm" onclick="removeRow22('+rowNum22+');" /></div></div>';
			jQuery('#itemRows22').append(row);
			frm.bibadiName.value = '';
			frm.bibadiFather.value = '';
			frm.bibadiGramArry.value = '';
		}
	}
	function removeRow22(rnum){
		jQuery('#rowNum22'+rnum).remove();
	}
</script>

<script type="text/javascript"> 
	var rowNum = 0;
	function addRow(frm){
		var badi_name = document.getElementById("badiName").value;
		var badi_father= document.getElementById("badiFather").value;
		if(badi_name==""){
			alert("দু:খিত! বাদীর নাম দিতে হবে");
		}
		else if(badi_father==""){
			alert("দু:খিত! বাদীর পিতার নাম দিতে হবে");
		}
		else{
			rowNum ++;
			var row = '<div id="rowNum'+rowNum+'" class="form-group"  style="margin-top:15px;"><div class="col-sm-3 col-sm-offset-1"   style="margin-top:15px;"><input type="text" name="badi_name[]" value="'+frm.badiName.value+'" class="form-control" /></div><div class="col-sm-3"   style="margin-top:15px;"><input type="text" name="badi_father[]" value="'+frm.badiFather.value+'" class="form-control" /></div><div class="col-sm-3"   style="margin-top:15px;"><input type="text" name="badi_gram_arry[]" value="'+frm.badiGramArry.value+'" class="form-control classbadiGramArry" /></div><div class="col-sm-2"   style="margin-top:15px;"><input type="button" value="Remove" class="btn btn-danger btn-sm" onclick="removeRow('+rowNum+');" /></div></div>';
			jQuery('#itemRows').append(row);
			frm.badiName.value = '';
			frm.badiFather.value = '';
			frm.badiGramArry.value = '';
		}
	}
	function removeRow(rnum){
		jQuery('#rowNum'+rnum).remove();
	}
	$(document).ready(function(){
		$('#recom').click(function()
		{
			//If checkbox is checked then disable or enable input
			if ($(this).is(':checked'))
			{
				$("#badi_gram").removeAttr("disabled"); 
				$("#badi_gram").val('');
				$(".classbadiGramArry").attr("readonly","readonly");
				$(".classbadiGramArry").val('');
			}
			//If checkbox is unchecked then disable or enable input
			else
			{
				$("#badi_gram").attr("disabled","disabled");
				$("#badi_gram").val('');
				$(".classbadiGramArry").removeAttr("readonly","readonly");
				$(".classbadiGramArry").val('');
			}
		});
		// for bibadi
		$('#recom22').click(function()
		{
			//If checkbox is checked then disable or enable input
			if ($(this).is(':checked'))
			{
				$("#bibadi_gram").removeAttr("disabled"); 
				$("#bibadi_gram").val('');
				$(".classbibadiGramArry").attr("readonly","readonly");
				$(".classbibadiGramArry").val('');
			}
			//If checkbox is unchecked then disable or enable input
			else
			{
				$("#bibadi_gram").attr("disabled","disabled");
				$("#bibadi_gram").val('');
				$(".classbibadiGramArry").removeAttr("readonly","readonly");
				$(".classbibadiGramArry").val('');
			}
		});
	});
	
</script>
<script>
	function unOnebadi(id,name,father,gram) 
	{
		var conf = confirm("Are you sure to Modify?");
		if(conf == false) return;
		var path = "index.php/Admin/onebadiup?id="+id+"&badi_name="+name+"&badi_father_name="+father+"&badi_gram="+gram;
		var xmlhttp = window.XMLHttpRequest?new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange = triggered;
		xmlhttp.open("GET", path,true);
		xmlhttp.send(null);
		function triggered()
		{
			if (xmlhttp.readyState == 4){
				alert(xmlhttp.responseText);
				window.location.reload();
			}
			else
			{}
		}
	};
	function badiDel(id)
		{
			var conf = confirm("Are you want to Delete?");
			if(conf == false) return;
			var path = "index.php/Admin/badidelete?id="+id;
			var xmlhttp = window.XMLHttpRequest?new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.onreadystatechange = triggered;
			xmlhttp.open("GET", path,true);
			xmlhttp.send(null);
			function triggered()
			{
				if (xmlhttp.readyState == 4){
					alert(xmlhttp.responseText);
					window.location.reload();
				}
				else
				{}
			}
		};
</script>
<script>
	function unOnebibadi(id,name,father,gram) 
	{
		var conf = confirm("Are you sure to Modify?");
		if(conf == false) return;
		var path = "index.php/Admin/onebibadiup?id="+id+"&bibadi_name="+name+"&bibadi_father_name="+father+"&bibadi_gram="+gram;
		var xmlhttp = window.XMLHttpRequest?new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange = triggered;
		xmlhttp.open("GET", path,true);
		xmlhttp.send(null);
		function triggered()
		{
			if (xmlhttp.readyState == 4){
				alert(xmlhttp.responseText);
				window.location.reload();
			}
			else
			{}
		}
	};
	function bibadiDel(id)
		{
			var conf = confirm("Are you want to Delete?");
			if(conf == false) return;
			var path = "index.php/Admin/bibadidelete?id="+id;
			var xmlhttp = window.XMLHttpRequest?new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.onreadystatechange = triggered;
			xmlhttp.open("GET", path,true);
			xmlhttp.send(null);
			function triggered()
			{
				if (xmlhttp.readyState == 4){
					alert(xmlhttp.responseText);
					window.location.reload();
				}
				else
				{}
			}
		};
</script>