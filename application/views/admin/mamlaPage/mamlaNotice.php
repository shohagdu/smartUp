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
				"Admin/mamlaInformationSubmit",
				$("#mamlaData").serialize(),  
					function(data){
						if(data==10){alert('মামলার আইডি error!!!!');}
						else if(data==9){alert("বিষয় প্রদান করুন ");}
						else if(data==8){alert("মামলা এবং শুনানীর তারিখ ঠিকমত প্রদান করুন ");	 }
						else if(data==7){alert("বাদী এবং বিবাদীর তথ্য ঠিকভাবে পূবন করুন");}
						
						else if(data==1)
						{
							alert('আপনার মামলা সঠিকভাবে সম্পাদন হয়েছে ');
							window.location='Admin/mamlaNotice';
							window.open('Admin/mamlaNoticePrint', '_blank')
						}
						
						else{
							alert(data);
						}
						
				 });
			return false;
			});
		});
		function subjectAndStatus(id){
			//alert(id);
			$.ajax({
				url:"Admin/subjectAndStatusInfo",
				type:"POST",
				data:{id:id},
				success:function(data){
					//alert(data);
					var spdata = data.split("|");
					document.getElementById("hid").value=spdata[0];
					document.getElementById("msubject").value=spdata[1];
					document.getElementById("mstatus").value=spdata[2];
					document.getElementById("mcomments").value=spdata[3];
				}
			});
		}
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
		<style>
			#content ul li{background:none;}
			.container{width:100%;}
			.label-style{
				text-align:right;
				font-size: 16px;
				line-height: 31px;
				font-weight: normal;
			}
			.sub-heading-style{
				font-size: 18px;
				text-indent: 25px;
			}
			.sub-title-style{
				font-size: 14px;
				text-indent: 20px;
				font-weight: bold;
			}
			
			a.action{
				text-decoration:none;
				outline:0;
			}
			a.action:hover{
				text-decoration:none;
				color:red;
				outline:0;
			}
			a.underline:hover{
				text-decoration:underline;
			}
			.modal-global-custom-style{
				color:#333333;
			}
			.modal-global-custom-style p{
				border:1px solid #eee;
				padding:5px;
				margin-bottom:10px;
			}
			a.link-style{
				outline:0;
				text-decoration:none;
			}
			a.link-style:hover{
				text-decoration:underline;
			}
		</style>
		<div class="row box" style="padding-bottom:20px;margin-top:10px;">
			<div class="container"> 
				<ul class="nav nav-tabs" id="myTab">
					<li class="active"><a data-toggle="tab" href="#menu" style="font-size:14px;">মামলার নোটিশ ফরম</a></li>
					<li><a data-toggle="tab" href="#menu1" style="font-size:14px;">নোটিশের তালিকা</a></li>
				</ul>
				<div class="tab-content" style="margin-top:20px;"> 
					<div id="menu" class="tab-pane fade in active" style="background:none;">
						<div class="panel panel-default">
							<div class="panel-heading">মামলার নোটিশের আবেদন ফরম:</div>
							<div class="panel-body">
								<form action="Admin/mamlaInformationSubmit" method="post" id="mamlaData" >
									<div class="EntryData">
										<div class="form-group">
											<label for="mamla no" class="control-label col-sm-2 col-xs-4 label-style">মামলা নং</label>
											<div class="col-sm-4 col-xs-8">
												<input type="text" name="mamlaNo" id="mamlaNo" value="<?php echo $this->mgenerate->get_mamal_no();?>" readonly class="form-control">
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="form-group">
											<label for="subject" class="control-label col-sm-2 col-xs-4 label-style">বিষয়</label>
											<div class="col-sm-8 col-xs-8">
												<input type="text" name="subject" id="subject" class="form-control">
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="form-group">
											<label for="mamla date" class="control-label col-sm-2 col-xs-4 label-style">মামলার তারিখ</label>
											<div class="col-sm-4 col-xs-8">
												<input type="text" name="mamla_date" id="mamla_date" value="<?php echo date('m/d/Y'); ?>" class="form-control">
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="form-group">
											<label for="sunanir date" class="control-label col-sm-2 col-xs-4 label-style">শুনানীর তারিখ</label>
											<div class="col-sm-4 col-xs-8">
												<input type="text" name="sunani_date" id="sunani_date" class="form-control">
											</div>
											<div class="clearfix"></div>
										</div>
										
										<div class="form-group">
											<div class="col-sm-10 col-xs-12">
												<div class="panel panel-default">
													<div class="panel-heading sub-heading-style">বাদীর তথ্য:</div>
													<div class="panel-body">
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
																		<input type="text" name="badi_gram" id="badi_gram" class="form-control" disabled>
																	</div>
																	<div class="col-sm-4"> 
																		<input type='checkbox' id='recom' value='1' />&nbsp;হাঁ (সবাই একই গ্রামের)
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
											<div class="col-sm-10 col-xs-12">
												<div class="panel panel-default">
													<div class="panel-heading sub-heading-style">বিবাদীর তথ্য:</div>
													<div class="panel-body">
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
																		<input type="text" name="bibadi_gram" id="bibadi_gram" class="form-control" disabled >
																	</div>
																	<div class="col-sm-4"> 
																		<input type='checkbox' id='recom22' value='1' />&nbsp;হাঁ (সবাই একই গ্রামের)
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
												<input type="submit" name="submitBtn" value="Genarate" class="btn btn-info btn-sm">
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</form>
							</div><!--- body end--->
						</div><!--- panel default end------>
					</div><!--- menu end-->
				<!----new client--------for বসতভিটার কর-------end--------------->
				<!----old client----for বসতভিটার কর-----------start--------------->
					<div id="menu1" class="tab-pane fade">
						<div class="panel panel-default">
							<div class="panel-heading">সকল মামলার তালিকা</div>
							<div class="panel-body">			
								<div class="col-lg-12 col-sm-12"> 
									<script type="text/javascript"> 
										$(document).ready(function() {
											$('#example').DataTable( {
												"order": [[ 0, "desc" ]]
												//"lengthMenu": [[ 100,200, -1], [ 100,200, "All"]]
												
											} );
										} );
									</script>
									
									
									
									<div style="padding:4px;width:100%;font-family:tahoma;" class="table-responsive">
										
										<table id="example" class="table table-striped table-bordered  nowrap" cellspacing="0" width="100%">
											<thead>
												<tr> 
													<th>মামলা নং</th>
													<th>সনদ নং</th>
													<th>বিষয়</th>
													<th>আবেদনের তারিখ</th>
													<th>শুনানীর তারিখ</th>    
													<th>অবস্থা</th>    
													<th>Action</th>	    
													
												</tr>
											</thead>
											<tbody>
												<?php foreach ($mamlaInfo as $row): ?>
												<tr>
													<td><?php echo $row->mamla_no ?></td>
													<td>
														<a href="Admin/editMamla?id=<?php echo sha1($row->id);?>">
															<?php echo $row->mamla_sonod ?>
														</a>	
													</td>
													<td>
														<a class="action underline" href="<?php echo $row->id;?>" data-toggle="modal" data-target="#myModal" onclick="subjectAndStatus(<?php echo $row->id;?>);">
															<?php
																if(strlen($row->subject)>50){
																	echo substr(($row->subject),0,50)."....";
																}else{
																	echo substr(($row->subject),0,50);
																}
															?>
														</a>	
													</td>
													<td><?php echo $row->mamla_date?></td>
													<td><?php echo $row->sunani_date?></td>
													<td>
														<a class="action underline" href="<?php echo $row->id;?>" data-toggle="modal" data-target="#myModal" onclick="subjectAndStatus(<?php echo $row->id;?>);">
															<?php echo $this->manageAdmin->getStatus($row->status);?>
														</a>
													</td>
													
													<td>
														<a href='admin/mamlaNoticePrint?id=<?php echo sha1($row->id)?> 'class="btn btn-success btn-sm" target='_blank'>Print</a>
														
													</td>
												</tr>
												</form>
												<?php  
													endforeach;
												
												?>
											</tbody>
											
											
										</table>
										
									</div>
								</div>
							<!--- end bank transer list -------->
							</div> <!-- /row box -->
						</div>
					</div>
							<!----old client----for বসতভিটার কর-----------end--------------->	
				</div><!--- /tab content------>
			</div><!-- /container------->
		</div><!-- /row box---->
		
		<div class="container">
			<!-- Modal -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">মামলার তথ্য</h4>
						</div>
						<div class="modal-body modal-global-custom-style">
							<form action="Admin/updateMamlaStatus" method="post" class="form-horizontal">
								<input type="hidden" name="hid" id="hid" />
								<div class="form-group">
									<label for="Sort" class="col-sm-2 control-label">বিষয় <span>*</span></label>
									<div class="col-sm-10">
										<textarea name="subject" class="form-control" rows="3" id="msubject" readonly  required></textarea>
									</div>
								</div>
								<div class="form-group">
									<label for="Sort" class="col-sm-2 control-label">অবস্থা</label>
									<div class="col-sm-10">
									
										<select name="status" id="mstatus" class="form-control">
											<option value="1">চলমান</option>
											<option value="2">সম্পাদিত</option>
											<option value="3">বাতিল</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="name" class="col-sm-2 control-label">মন্তব্য <span>*</span></label>
									<div class="col-sm-10">
										<textarea name="comments" class="form-control" rows="5" id="mcomments"></textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-primary">আপডেট করুন</button>
									</div>
								</div>
							</form>			
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>	
</div><!--/#content.col-md-0-->
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