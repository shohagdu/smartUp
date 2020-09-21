<style type="text/css"> 
.Holding-tax-data-not-found{
	font-size: 15px;
	font-weight: bolder;
	line-height: 41px;
}
.Holding-tax-data-not-found>a{
	color: red;
	text-decoration: underline;
}
</style>
<script src="all/custom_js/holdingRateSheet_form.js" type="text/javascript"></script>
<div id="content" class="col-lg-10 col-sm-10">
	<div class="panel panel-default">
		<div class="panel-heading">নতুন বসতভিটার  রেট যোগ করুন </div>
		<div class="panel-body">
			<label for="">
				<p class="hints-heading small-font red-color "></p>
			</label>
			<div class="col-lg-12 col-sm-12">
				<form action="index.php/setup_section/holdingRateSheet_action" method="post" id="holdingRateSheetFormId" class="daily form-horizontal" role="form">
					<div class="form-group">
						<label class="control-label col-sm-2" for="holdingLicense Type">বসতভিটার  ধরন</label>
						<div class="col-sm-6"> 
							<?php if($form_information['label']['status'] === 'error'):?>
							<p class="Holding-tax-data-not-found">বসতভিটার  ধরন খুজে পাওয়া যায় নাই। আগে বসতভিটার  ধরন <a href="index.php/setup_section/holdingRateSheetLevel">যোগ করুন</a>।</p>
							<?php else:?>
							<select name="holdingRateSheetLabel" class="form-control" id="holdingRateSheetLabel" required>
								<option value="">চিহ্নিত করুন</option>
								<?php foreach ($form_information['label']['data'] as $label_info):?>
									<option value="<?php echo $label_info->id;?>"> <?php echo $label_info->label;?> </option>
								<?php endforeach;?>
							</select>
							<?php endif;?>
						</div>
						<div class="clearfix" style="margin-top:50px;"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="Occupation">পেশা</label>
						<div class="col-sm-6"> 
							<?php if($form_information['occupation']['status'] === 'error'):?>
							<p class="Holding-tax-data-not-found">পেশা খুজে পাওয়া যায় নাই। আগে পেশা <a href="index.php/setup_section/occupation">যোগ করুন</a>।</p>
							<?php else:?>
							<select name="occupation" class="form-control" id="occupationId" required>
								<option value="">চিহ্নিত করুন</option>
								<?php foreach ($form_information['occupation']['data'] as $occupation):?>
									<option value="<?php echo $occupation->id;?>"> <?php echo $occupation->title;?> </option>
								<?php endforeach;?>
							</select>
							<?php endif;?>
						</div>
						<div class="clearfix" style="margin-top:50px;"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="Classification">করের শ্রেনী</label>
						<div class="col-sm-6"> 
							<?php if($form_information['classification']['status'] === 'error'):?>
							<p class="Holding-tax-data-not-found">করের শ্রেনী  ধরন খুজে পাওয়া যায় নাই। আগে করের শ্রেনী <a href="index.php/setup_section/classification">যোগ করুন</a>।</p>
							<?php else:?>
							<select name="classification" class="form-control" id="classificationId" required>
								<option value="">চিহ্নিত করুন</option>
								<?php foreach ($form_information['classification']['data'] as $cls):?>
									<option value="<?php echo $cls->id;?>"> <?php echo $cls->title;?> </option>
								<?php endforeach;?>
							</select>
							<?php endif;?>
						</div>
						<div class="clearfix" style="margin-top:50px;"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="Amount">ধার্যকৃত টাকার পরিমাণ </label>
						<div class="col-sm-6"> 
							<input type="text" required class="form-control" name="amount" id="amount" onkeypress="return checkaccnumber(event);" placeholder="ইংরেজীতে টাকার পরিমান প্রদান করুন " />
						</div>
						<div class="clearfix"></div>
					</div>
					<?php if($form_information['label']['status'] !== 'error' && $form_information['occupation']['status'] !== 'error' && $form_information['classification']['status'] !== 'error'): ?>
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
					<?php endif;?>
				</form>
			</div>
		</div>
	</div>	
	<!----- start list ------------->
	<div class="panel panel-default">
		<div class="panel-heading">বসতভিটার রেট সীট</div>
		<div class="panel-body">			
			<div class="col-lg-12 col-sm-12"> 
				<div style="padding:4px;width:100%;font-family:tahoma;" class="table-responsive">
					
					<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>  
								<th width="20">ক্র.নং</th>
								<th>বসতভিটার ধরন - পেশা - করের শ্রেনী</th>
								<th>ধার্যকৃত টাকার পরিমান</th>
								<th>অবস্থা</th>
								<th>সর্বশেষ আপডেট</th>	    
								<th>অ্যকশন</th>	    
								
							</tr>
						</thead>
						<tbody>
							<?php 
								$nr1=1;
								if($holding_rate_sheet['status'] === 'success'):
									foreach ($holding_rate_sheet['data'] as $row):
										?>
										<tr>
											<td><?php echo $nr1++; ?></td>
											<td><?php echo $row->label ?></td>
											<td><?php echo $row->amount ?></td>
											<td class="<?php echo $row->status; ?>"><?php echo $row->status; ?></td>
											<td><?php echo $row->created_date?></td>
											<td>
												<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="modelStatus('<?php echo md5($row->rid); ?>')" data-target="#modelStatus" ><i class="glyphicon glyphicon-pencil"></i></button>
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
		</div>
	</div><!-- /row box -->
</div><!--/#content.col-md-0-->

<div class="modal fade" id="modelStatus" role="dialog">
    <div class="modal-dialog">
		<div class="modal-content" style="padding-bottom:50px;">
			<div class="col-sm-12" style="margin-top:30px;">
				<div class="col-sm-12">
					 <button type="button" class="btn btn-default btn-block" style="background:#eee;">Update Information</button>
				</div>
			</div>
			<form action="index.php/setup_section/update_holding_rate_sheet_action" method="post" id="updateHoldingRateSheet" class="form-horizontal">
				<div class="col-sm-12" style="margin-top:20px;">
					<div class="form-group"> 
						<label class="col-sm-offset-1 col-sm-3">বসতভিটার ধরন - পেশা - করের শ্রেনী</label>
						<div class="col-sm-7">
							<input type="text" disabled class="form-control" name="holdingRateSheetLabel" id="holdingRateSheetLabelId" readonly />
						</div>
					</div>
				</div>	
				<div class="col-sm-12" style="margin-top:5px;">
					<div class="form-group">
						<label class="col-sm-offset-1 col-sm-3" style="font-size: 12px;">ধার্যকৃত টাকার পরিমাণ</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="amount" id="amountId" >
						</div>
					</div>	
				</div>	
				
				<div class="col-sm-12" style="margin-top:5px;">
					<div class="form-group">
						<label class="col-sm-offset-1 col-sm-3">অবস্থা</label>
						<div class="col-sm-7">
							<select class="form-control" id="statusShow" name="status"  ></select>
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
						   <div style="display:none;" id="warningMessageModal">
								<div class="alert alert-warning alert-sm xs-font" >
									<strong id="warningTextModal"></strong>
								</div>
						   </div>
						</div>
					</div>
				</div>	
			</form>
			<div class="modal-footer">
			</div>
		</div>
     </div>
 </div>