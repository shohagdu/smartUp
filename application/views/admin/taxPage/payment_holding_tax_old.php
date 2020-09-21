<style type="text/css"> 
	.custom-label-text{
		font-size: 15px;
		text-align: left;
	}
	.custom-info-text{
		font-size: 15px;
	}
	.no-margin{
		margin: 2px;
	}
</style>
<div id="content" class="col-lg-10 col-sm-10">
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading" style="font-size: 18px; font-weight: bold;text-align: center;">বসত ভিটার ফি পরিশোধ  ফরম</div>
			<div class="panel-body" style="min-height: 500px;">
				<div class="row"> 
					<div class="col-sm-7">
						<form action="Admin/payemt_action_holding_tax" method="post" id="holdingPaymetFormId" class="form-horizontal" >
						<div class="clearfix"></div>
							<div class="form-group">
								<label class="control-label col-sm-3 col-xs-4" style="text-align:right;">অর্থবছর<span class="red-color">*</span></label>
								<div class="col-sm-7 col-xs-8">
									<select name="fiscalYear" id="fiscalYear" class="form-control" >
										<option value="">চিহ্নিত করুন</option>
										<?php 
											if($fiscal_year['status'] === 'success'):
												foreach ($fiscal_year['data'] as $year):
													?>
													<option value="<?php echo $year->id;?>" <?php if((int)$year->is_current === 1):echo "selected";endif; ?>> <?php echo $year->full_year;?> </option>
													<?php 
												endforeach;
											endif;
										?>
									</select>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3 col-xs-4" style="text-align:right;">বসতভিটার ধরন<span class="red-color">*</span></label>
								<div class="col-sm-7 col-xs-8">
									<select name="holdingType" id="holdingType" class="form-control" disabled readonly>
										<option value="">চিহ্নিত করুন</option>
										<?php 
											if($rate_sheet['status'] === 'success'):
												foreach ($rate_sheet['data'] as $rate):
													?>
													<option value="<?php echo $rate->rid;?>" <?php if((int)$rate->rid === (int)$tax_member_info->rate_id):echo "selected";endif; ?>> <?php echo $rate->rate_sheet_label;?> </option>
													<?php 
												endforeach;
											endif;
										?>
									</select>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3 col-xs-4" style="text-align:right">বই নম্বর <span class="red-color">*</span></label>
								<div class="col-sm-7 col-xs-8">
									<input type="text" name="bookNumber" id="bookNumber" class="form-control">
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3 col-xs-4 " style="text-align:right">মানি রসিদ নম্বর<span class="red-color">*</span></label>
								<div class="col-sm-7 col-xs-8">
									<input type="text" name="moneyNumber"  id="moneyNumber" class="form-control"  />
								</div>
								<div class="clearfix"></div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-3 col-xs-4 " style="text-align:right">পরিশোধের তারিখ <span class="red-color">*</span></label>
								<div class="col-sm-7 col-xs-8">
									<div class="input-group input-append date">
										<input type="text" class="form-control" name="paymentDate"  id="paymentDate" value="<?php echo date('Y-m-d');?>" />
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
								</div>
		
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3 col-xs-4 " style="text-align:right;">টাকার পরিমান<span class="red-color">*</span></label>
								<div class="col-sm-7 col-xs-8">
									<input type="text" name="amount" id="amount" class="form-control" value="<?php echo !empty($tax_member_info->amount) ? $tax_member_info->amount : '' ; ?>" readonly />
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3 col-xs-4 " style="text-align:right;"></label>
								<div class="col-sm-1 col-xs-4">
									<input type="submit" name="submitBtn" value="Payment" class="btn btn-info btn-sm">
									<input type="hidden" name="gtype" value="newBosod">
									<input type="hidden" name="dagNo" value="<?php echo $tax_member_info->dag_no;?>">
									<input type="hidden" name="holdingNo" value="<?php echo $tax_member_info->holding_no;?>">
								</div>
								<div class="col-sm-8 col-xs-8"> 
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
								<div class="clearfix"></div>
							</div>
						</form>	
					</div>
					
					
					<div class="col-sm-5" style="border-left: 2px solid #ddd;"> 
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">নাম</label>
							<div class="col-sm-8 col-xs-8 custom-info-text"> : <?php echo !empty($tax_member_info->name) ? $tax_member_info->name : '';?></div>
						</div>
						
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">পিতার নাম</label>
							<div class="col-sm-8 col-xs-8 custom-info-text">:  <?php echo !empty($tax_member_info->fathername) ? $tax_member_info->fathername : '' ;?></div>
						</div>
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">জন্ম নিবন্ধন নং</label>
							<div class="col-sm-8 col-xs-8 custom-info-text">:  <?php echo !empty($tax_member_info->birth_certificate_id) ? $tax_member_info->birth_certificate_id : '' ; ?> </div>
							
						</div>
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text" style="white-space: nowrap">জাতীয় পরিচয় পত্র নং</label>
							<div class="col-sm-8 col-xs-8 custom-info-text"> : <?php echo !empty($tax_member_info->national_id) ? $tax_member_info->national_id : '' ; ?> </div>
						</div>
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">গ্রাম </label>
							<div class="col-sm-8 col-xs-8 custom-info-text">: <?php echo !empty($tax_member_info->village) ? $tax_member_info->village : '' ; ?>  </div>
						</div>
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">ওয়ার্ড নং</label>
							<div class="col-sm-8 col-xs-8 custom-info-text">:  <?php echo !empty($tax_member_info->wordno) ? $tax_member_info->wordno : '' ; ?> </div>
						</div>
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">হোল্ডিং নং</label>
							<div class="col-sm-8 col-xs-8 custom-info-text">: <?php echo !empty($tax_member_info->holding_no) ? $tax_member_info->holding_no : '' ; ?>  </div>
						</div>
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">দাগ নং</label>
							<div class="col-sm-8 col-xs-8 custom-info-text">:  <?php echo !empty($tax_member_info->dag_no) ? $tax_member_info->dag_no : '' ; ?> </div>
						</div>
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">বসতভিটার ধরন</label>
							<div class="col-sm-8 col-xs-8 custom-info-text" style="color: green; font-weight: bolder;"> : <?php echo !empty($tax_member_info->rate_sheet_label) ? $tax_member_info->rate_sheet_label : '' ; ?>  </div>
						</div>
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">ধার্যকৃত টাকা</label>
							<div class="col-sm-8 col-xs-8 custom-info-text" style="color: red; font-weight: bolder;"> : <?php echo !empty($tax_member_info->amount) ? $tax_member_info->amount : '' ; ?>  </div>
						</div>
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">মোবাইল নং</label>
							<div class="col-sm-8 col-xs-8 custom-info-text">:  <?php echo !empty($tax_member_info->mobile_number) ? $tax_member_info->mobile_number : '' ; ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!--/#content.col-md-0-->
<script src="all/custom_js/holdingPayment_form.js" type="text/javascript"></script>