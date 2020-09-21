<style>
	#globalmsg{
		width:400px;
		height: 100px;
		position: absolute;
		top: 150px;
		left: 22%;
		background:#000 url(cross.png) no-repeat right top;
		padding:3px 0px;
		display: none;
		border:1px solid #333;
		cursor:pointer;
		z-index:999;
	}

	#globalmsg p{
		padding:5px;
		margin:0px;
		color:#fff;
	}
	#globalmsg p.done, p.done{
		background: url(done.png) no-repeat left center;
		padding-left:30px;
		margin-left:10px;
		line-height:24px;
	}
</style>
<link rel="stylesheet" type="text/css" href="all/custom_js/application_form.css" media="all" />
<div id="content" class="col-lg-10 col-sm-10">
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading" style="font-size: 18px; font-weight: bold;text-align: center;">বসত ভিটার ফি পরিশোধ  ফরম</div>
			<div class="panel-body" style="min-height: 500px;">
				<div class="row" style="border-bottom: 1px solid #ddd;margin-bottom: 20px;">
					
					<div class="col-sm-4">
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">নাম</label>
							<div class="col-sm-8 col-xs-8 custom-info-text highlight-green"> : <?php echo !empty($tax_member_info->name) ? $tax_member_info->name : '';?></div>
						</div>
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">পিতার নাম</label>
							<div class="col-sm-8 col-xs-8 custom-info-text highlight-green">:  <?php echo !empty($tax_member_info->fathername) ? $tax_member_info->fathername : '' ;?></div>
						</div>
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">জন্ম নিবন্ধন নং</label>
							<div class="col-sm-8 col-xs-8 custom-info-text">:  <?php echo !empty($tax_member_info->birth_certificate_id) ? $tax_member_info->birth_certificate_id : '' ; ?> </div>								
						</div>
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">পরিচয় পত্র নং</label>
							<div class="col-sm-8 col-xs-8 custom-info-text"> : <?php echo !empty($tax_member_info->national_id) ? $tax_member_info->national_id : '' ; ?> </div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">গ্রাম </label>
							<div class="col-sm-8 col-xs-8 custom-info-text highlight-green">: <?php echo !empty($tax_member_info->village) ? $tax_member_info->village : '' ; ?>  </div>
						</div>
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">ওয়ার্ড নং</label>
							<div class="col-sm-8 col-xs-8 custom-info-text">:  <?php echo !empty($tax_member_info->wordno) ? $tax_member_info->wordno : '' ; ?> </div>
						</div>
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">হোল্ডিং নং</label>
							<div class="col-sm-8 col-xs-8 custom-info-text highlight-red">: <?php echo !empty($tax_member_info->holding_no) ? $tax_member_info->holding_no : '' ; ?>  </div>
						</div>
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">দাগ নং</label>
							<div class="col-sm-8 col-xs-8 custom-info-text highlight-red">:  <?php echo !empty($tax_member_info->dag_no) ? $tax_member_info->dag_no : '' ; ?> </div>
						</div>
					</div>
					<div class="col-sm-5">
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4">বসতভিটার ধরন - পেশা - করের শ্রেনী</label>
							<div class="col-sm-8 col-xs-8 custom-info-text highlight-green"> : <?php echo !empty($tax_member_info->rate_sheet_label) ? $tax_member_info->rate_sheet_label : '' ; ?>  </div>
						</div>
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">ধার্যকৃত টাকা</label>
							<div class="col-sm-8 col-xs-8 custom-info-text highlight-red"> : <?php echo !empty($tax_member_info->amount) ? $tax_member_info->amount : '' ; ?>  </div>
						</div>
						<div class="clearfix form-group no-margin">
							<label class="control-label col-sm-4 col-xs-4 custom-label-text">মোবাইল নং</label>
							<div class="col-sm-8 col-xs-8 custom-info-text">:  <?php echo !empty($tax_member_info->mobile_number) ? $tax_member_info->mobile_number : '' ; ?></div>
						</div>
					</div>
				</div>
				<?php if($fiscal_year['status'] === 'error'):?>
				<div class="row">
					<div class='col-sm-12'>
						<h3 style="color: red; font-size: 15px;text-align: center;"><?php echo $fiscal_year['message'];?></h3>
					</div>
				</div>
				<?php else: ?>
				<div class="row"> 
					<form action="Admin/payment_action_holding_tax" method="post" id="holdingPaymetFormId" class="form-horizontal" >
						<div class="col-sm-7" style="border-right: 2px solid #ddd; min-height: 350px;">
							<div class="col-sm-4 more-highlight fiscal-year-heading">
								<label for="Fiscal Year">অর্থবছর</label>
							</div>
							<div class="col-sm-4 more-highlight holding-type-heading">
								<label for="Holding Type">বসতভিটার ধরন</label>
							</div>
							<div class="col-sm-4 more-highlight amount-heading">
								<label for="Holding Amount">টাকার পরিমান</label>
							</div>
							
							<div class="form-group" data-ratesheet-index="0">
								<div class="col-sm-4 custom-padding">
									<!--<input type="hidden" name="fiscalYear[0].year" class="form-control" id="fiscalYear_0" value="<?php echo $current_fiscal_year['data']->id;?>" />-->
									<select name="fiscalYear[0].year" class="form-control" id="fiscalYear_0">
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
								<div class="col-sm-4 custom-padding">
									<!--<input type="hidden" name="holdingType[0].type" class="form-control" id="holdingType_0" value="<?php echo $tax_member_info->rate_id; ?>" />-->
									<select name="holdingType[0].type" class="form-control holdingType" id="holdingType_0">
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
								<div class="col-sm-3 custom-padding">
									<input type="text" name="holdingAmount[0].amount" class="form-control" id="holdingAmount_0" value="<?php echo !empty($tax_member_info->amount) ? $tax_member_info->amount : '' ; ?>" readonly />
								</div>
								<div class="col-sm-1 custom-padding">
									<button type="button" class="btn btn-default addButton"><span class="glyphicon glyphicon-plus"></span></button>
								</div>
							</div>

							<!-- The template for adding new field -->
							<div class="form-group hide" id="holdingTemplate">
								<div class="col-sm-4 custom-padding">
									<select  name="year" class="form-control">
										<option value="">চিহ্নিত করুন</option>
										<?php 
											if($fiscal_year['status'] === 'success'):
												foreach ($fiscal_year['data'] as $year):
													?>
													<option value="<?php echo $year->id;?>"> <?php echo $year->full_year;?> </option>
													<?php 
												endforeach;
											endif;
										?>
									</select>
								</div>
								<div class="col-sm-4 custom-padding">
									<select name="type" class="form-control holdingType">
										<option value="">চিহ্নিত করুন</option>
										<?php 
											if($rate_sheet['status'] === 'success'):
												foreach ($rate_sheet['data'] as $rate):
													?>
													<option value="<?php echo $rate->rid;?>"> <?php echo $rate->rate_sheet_label;?> </option>
													<?php 
												endforeach;
											endif;
										?>
									</select>
								</div>
								<div class="col-sm-3 custom-padding">
									<input type="text" name="amount" class="form-control" value="" readonly />
								</div>
								<div class="col-sm-1 custom-padding">
									<button type="button" class="btn btn-default removeButton"><span class="glyphicon glyphicon-minus"></span></button>
								</div>
							</div>
						</div>	
						
						<div class="col-sm-5"> 
							<div class="clearfix"></div>
							<div class="form-group">
								<label class="control-label col-sm-4 col-xs-4 " style="text-align:right;white-space:nowrap;">পরিশোধের তারিখ <span class="red-color">*</span></label>
								<div class="col-sm-8 col-xs-8">
									<div class="input-group input-append date">
										<input type="text" class="form-control" name="paymentDate"  id="paymentDate" value="<?php echo date('Y-m-d');?>" />
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4 col-xs-4" style="text-align:right">বই নম্বর <span class="red-color">*</span></label>
								<div class="col-sm-8 col-xs-8">
									<input type="text" name="bookNumber" id="bookNumber" class="form-control">
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4 col-xs-4 " style="text-align:right">মানি রসিদ নম্বর<span class="red-color">*</span></label>
								<div class="col-sm-8 col-xs-8">
									<input type="text" name="moneyNumber"  id="moneyNumber" class="form-control"  />
								</div>
								<div class="clearfix"></div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4 col-xs-4 " style="text-align:right;">মোট টাকা<span class="red-color">*</span></label>
								<div class="col-sm-8 col-xs-8">
									<input type="text" name="totalAmount" id="totalAmount" class="form-control" value="<?php echo !empty($tax_member_info->amount) ? $tax_member_info->amount : '' ; ?>" readonly />
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4 col-xs-4 " style="text-align:right;">মওকুফ  টাকা <span class="red-color">*</span></label>
								<div class="col-sm-8 col-xs-8">
									<input type="text" name="discount" id="discount" class="form-control" />
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4 col-xs-4 " style="text-align:right;">পরিশোধিত টাকার পরিমান<span class="red-color">*</span></label>
								<div class="col-sm-8 col-xs-8">
									<input type="text" name="paymentAmount" id="paymentAmount" class="form-control" value="<?php echo !empty($tax_member_info->amount) ? $tax_member_info->amount : '' ; ?>" readonly />
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group"> 
								<div class="col-sm-12 col-xs-12"> 
									<!--<div style="display:none;" id="successMessageModal">
										<div class="alert alert-success alert-sm xs-font" >
											<strong id="successTextModal"></strong>
										</div>
								   </div>-->
								   <div style="display:none;" id="errorMessageModal">
										<div class="alert alert-danger alert-sm xs-font" >
											<strong id="errorTextModal"></strong>
										</div>
								   </div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4 col-xs-4 " style="text-align:right;"></label>
								<div class="col-sm-1 col-xs-4">
									<input type="submit" name="submitBtn" value="Payment" class="btn btn-info btn-sm" id="save_tlicence">
									<input type="hidden" name="gtype" value="newBosod">
									<input type="hidden" name="dagNo" value="<?php echo $tax_member_info->dag_no;?>">
									<input type="hidden" name="holdingNo" value="<?php echo $tax_member_info->holding_no;?>">
								</div>
							</div>
						</div>
					</form>
					<div id="globalmsg">Hello</div>
				</div>
				<?php endif;?>
			</div>
		</div>
	</div>
</div><!--/#content.col-md-0-->
<script src="all/custom_js/holdingPayment_form.js" type="text/javascript"></script>