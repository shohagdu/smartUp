<script src="all/custom_js/wordMember_form.js" type="text/javascript"></script>
<div id="content" class="col-lg-10 col-sm-10">
	<!-------start word member add form ------------->
	<div class="panel panel-default">
		<div class="panel-heading">নতুন ওয়ার্ড এবং মেম্বার  যোগ করুন</div>
		<div class="panel-body">
			<div class="col-lg-12 col-sm-12"> 
				<form action="index.php/setup_section/word_member_action" method="post" id="insertWordMember" class="daily form-horizontal" role="form">
					<div class="form-group">
						<label class="control-label col-sm-2" for="Word no">ওয়ার্ড নং</label>
						<div class="col-sm-5"> 
							<input type="text" class="form-control" name="wordNo" id="word_no" onkeypress="return checkaccnumber(event);" placeholder="ইংরেজীতে প্রদান করুন Ex: 7"/>
						</div>
						<div class="col-sm-3"> 
							<span id="error1" style="color:red;font-size:12px;"></span>
							<span id="error2" style="color:green;font-size:12px;"></span>
							<span id="error3" style="color:red;font-size:12px;"></span>
						</div>
						<div class="clearfix" style="margin-top:50px;"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="Member name">মেম্বারে নাম</label>
						<div class="col-sm-5"> 
							<input type="text" required class="form-control" name="memberName" id="memberName" placeholder="" />
						</div>
						<div class="clearfix" style="margin-top:50px;"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="Member Father name">মেম্বারের পিতার নাম</label>
						<div class="col-sm-5"> 
							<input type="text" required class="form-control" name="memberFather" id="memberFather" placeholder="" />
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-1" style="position: relative; margin-left: 160px;">
							<div class="col-sm-12">
								<input type="submit" id="submitId" name="submitform" value="যোগ করুন" class="btn btn-info "/>
							</div>
						</div>
						<div class="col-sm-offset-1 col-sm-5">
							<div class="row">
								<div class="col-md-12" style="min-height:30px;display:none;" id="successMessage">
									<div class="alert alert-success alert-sm" >
										<strong id="successText"></strong>
									</div>
							   </div>
							   <div class="col-md-12" style="min-height:30px;display:none;" id="errorMessage">
									<div class="alert alert-danger alert-sm" >
										<strong id="errorText"></strong>
									</div>
							   </div>
						   </div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div><!--- end form------>
	<!----- start member list ------------->
	<div class="panel panel-default">
		<div class="panel-heading">ওয়ার্ড মেম্বারের তালিকা</div>
		<div class="panel-body">			
			<div class="col-lg-12 col-sm-12"> 
				<div style="padding:4px;width:100%;font-family:tahoma;" class="table-responsive">
					<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>  
								<th width="20">ক্র.নং</th>
								<th>ওয়ার্ড নং</th>
								<th>মেম্বারের নাম</th>
								<th>মেম্বারের পিতার নাম</th>
								<th>অবস্থা</th>	    
								<th>অ্যকশন</th>	    
								
							</tr>
						</thead>
						<tbody>
							<?php 
								$nr1=1;
								if($member_info['status'] === 'success'):
									foreach ($member_info['data'] as $row):
										?>
										<tr>
											<td><?php echo $nr1++; ?></td>
											<td><?php echo $row->word_no; ?></td>
											<td><?php echo $row->member_name; ?></td>
											<td><?php echo $row->member_father; ?></td>
											<td class="<?php echo $row->status; ?>"><?php echo $row->status; ?></td>
											<td>
												<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="modelStatus('<?php echo md5($row->id); ?>')" data-target="#modelStatus" ><i class="glyphicon glyphicon-pencil"></i></button>
												
												<button value="<?php echo md5($row->id);?>" class="btn btn-danger btn-sm deleteClass" data-toggle="tooltip" title="Delete"><i class="glyphicon glyphicon-trash" style="font-size: 10px" ></i></button>
												
												<!--<a  href="Setup_section/deleteMemberInfoRow/<?php echo md5($row->id);?>">
													<button type="submit" onclick="return delete_function();" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="glyphicon glyphicon-trash" style="font-size: 10px" ></i></button>
												</a>-->
											</td>
										</tr>
										<?php 
									endforeach;
								endif;
							?>
						</tbody>	
					</table>
				</div>
			</div>
		</div> <!-- end panel body -->
	</div><!--end panel-->
	<!-- star modal -------->
	<div class="modal fade" id="modelStatus" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content" style="padding-bottom:50px;">
				<div class="col-sm-12" style="margin-top:30px;">
					<div class="col-sm-12">
						 <button type="button" class="btn btn-default btn-block" style="background:#eee;">Update Information</button>
					</div>
				</div>
				<form action="index.php/setup_section/update_member_info_action" method="post" id="updateWordMember" class="form-horizontal">
					
					<div class="col-sm-12" style="margin-top:20px;">
						<div class="form-group"> 
							<label class="col-sm-offset-1 col-sm-3">ওয়ার্ড নং</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="wordNo" id="wordNoId" >
							</div>
						</div>
					</div>	
					<div class="col-sm-12" style="margin-top:5px;">
						<div class="form-group"> 
							<label class="col-sm-offset-1 col-sm-3">মেম্বারে নাম</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="memberName" id="memberNameId" >
							</div>

						</div>
					</div>
					<div class="col-sm-12" style="margin-top:5px;">
						<div class="form-group"> 
							<label class="col-sm-offset-1 col-sm-3" style="font-size: 12px;">মেম্বারের পিতার নাম</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="memberFather" id="memberFatherNameId" >
							</div>
						</div>
					</div>
					<div class="col-sm-12" style="margin-top:5px;">
						<div class="form-group"> 
							<label class="col-sm-offset-1 col-sm-3">অবস্থা</label>
							<div class="col-sm-7">
								<select class="form-control" id="statusShow" name="status"></select>
							</div>
						</div>
					</div>
					<div class="col-sm-12" style="margin-top:5px;">
						<div class="form-group"> 
							<label class="col-sm-4"></label>
							<div class="col-sm-3">
								<input type="hidden" name="hid" id="hid">
								<input type="submit" name="updateNow" value="Update" class="btn btn-success btn-sm">
								 <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
							</div>
							<div class="col-sm-5"> 
								<div style="display:none;" id="successMessageModal">
									<div class="alert alert-success alert-sm xs-font" >
										<strong id="successTextModal"></strong>
									</div>
							   </div>
							   <div style="display:none;" id="errorMessageModal">
									<div class="alert alert-danger alert-sm xs-font" >
										<strong id="errorTextModal"></strong>
									</div>
							   </div>
							</div>
						</div>
					</div>	
				</form>
				<div class="modal-footer"></div>
			</div>
		 </div>
	 </div><!--- end modal--->
</div><!-- #content end col-sm-10---->