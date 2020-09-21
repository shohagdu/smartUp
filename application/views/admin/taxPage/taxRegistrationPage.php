<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/custom.css" media="all" />
<div class="row">
	<div class="col-sm-12"> 
		<div class="form-group">
			<label class="control-label col-xs-12 " style="text-decoration:underline;">
				<h3 style="font-size: 20px;color: gray;">বসতভিটার রেজিস্ট্রেশন ফরম :</h3> 
			</label>
			<label for="">
				<p class="hints-heading small-font red-color ">সকল "*" মার্ক ফিল্ড অবশ্যই প্রদান করতে হবে!  নাম্বার ইংরেজিতে প্রদান করুন। আমরা বাংলা, ইংরেজি দুই ভাবে সংরক্ষন করব।</p>
			</label>
		</div>
	</div>
</div>
<form action="Admin/newBosotbitaTaxCollection" method="post" id="holdingRegistrationFormId" class="form-horizontal" ><div class="clearfix"></div>
	<div class="form-group">
		<label class="control-label col-sm-2 col-xs-4" style="text-align:right;">নাম  <span class="red-color">*</span></label>
		<div class="col-sm-4 col-xs-8">
			<input type="text" name="name" id="name" class="form-control">
		</div>
		<label class="control-label col-sm-2 col-xs-4" for="" style="text-align:right">পিতার নাম <span class="red-color">*</span></label>
		<div class="col-sm-4 col-xs-8">
			<input type="text" name="fatherName" id="fatherName" class="form-control">
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2 col-xs-4" style="text-align:right">গ্রাম <span class="red-color">*</span></label>
		<div class="col-sm-4 col-xs-8">
			<input type="text" name="village" id="village" class="form-control">
		</div>
		<div class="visible-xs clearfix"></div>
		<label class="control-label col-sm-2 col-xs-4 " style="text-align:right">ওয়ার্ড নং <span class="red-color">*</span></label>
		<div class="col-sm-4 col-xs-8">
			<select name="wordNo" id="wordNo" class="form-control" >
				<option value="">চিহ্নিত করুন</option>
				<?php 
					if($member_info['status'] === 'success'):
						foreach ($member_info['data'] as $row):
							?>
							<option value="<?php echo $row->word_no;?>"> <?php echo $row->word_no .' ওয়ার্ড';?> </option>
							<?php 
						endforeach;
					endif;
				?>
			</select>	
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2 col-xs-4 " style="text-align:right">জাতীয় পরিচয় পত্র নং <span class="red-color"></span></label>
		<div class="col-sm-4 col-xs-8">
			<input type="text" name="nationalId"  id="nid" class="form-control" placeholder="ইংরেজীতে প্রদান করুন" />
		</div>
		<div class="visible-xs clearfix"></div>
		<label class="control-label col-sm-2 col-xs-4 " style="text-align:right">জন্ম নিবন্ধন নং <span class="red-color"></span></label>
		<div class="col-sm-4 col-xs-8">
			<input type="text" name="birthCertificateId" id="bid" class="form-control" placeholder="ইংরেজীতে প্রদান করুন" />
		</div>
		<div class="clearfix"></div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-sm-2 col-xs-4 " style="text-align:right">হোল্ডিং নং <span class="red-color">*</span></label>
		<div class="col-sm-4 col-xs-8">
			<input type="text" name="holdingNumber" id="holdingNumber" class="form-control" onkeypress="return numtest();" placeholder="ইংরেজীতে প্রদান করুন" />
		</div>
		<div class="visible-xs clearfix"></div>
		<label class="control-label col-sm-2 col-xs-4" style="text-align:right">দাগ নং <span class="red-color">*</span></label>
		<div class="col-sm-4 col-xs-8">
			<input type="text" name="dagNo" id="dagNo" class="form-control" onkeypress="return numtest();" placeholder="ইংরেজীতে প্রদান করুন" />
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2 col-xs-4 " style="text-align:right">বসতভিটার ধরন - পেশা - করের শ্রেনী<span class="red-color">*</span></label>
		<div class="col-sm-4 col-xs-8">
			<select name="rateSheet" id="rateSheet" class="form-control" >
				<option value="">চিহ্নিত করুন</option>
				<?php 
					if($rate_sheet['status'] === 'success'):
						foreach ($rate_sheet['data'] as $rate):
							?>
							<option value="<?php echo $rate->rid;?>"> <?php echo $rate->rate_sheet_label .' ('. $rate->amount.' টাকা)';?> </option>
							<?php 
						endforeach;
					endif;
				?>
			</select>	
		</div>
		<div class="visible-xs clearfix"></div>
		<label class="control-label col-sm-2 col-xs-4 " style="text-align:right;">মোবাইল নং <span class="red-color"></span></label>
		<div class="col-sm-4 col-xs-8">
			<input type="text" name="mobileNo" id="mobileNo" class="form-control" maxlength="11" placeholder="ইংরেজীতে প্রদান করুন">
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2 col-xs-4 " style="text-align:right;"></label>
		<div class="col-sm-1 col-xs-4">
			<input type="submit" name="submitBtn" value="Submit" class="btn btn-info btn-sm">
			<input type="hidden" name="gtype" value="newBosod">
		</div>
		<div class="col-sm-9 col-xs-8"> 
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
<script src="all/custom_js/holdingTax_form.js" type="text/javascript"></script>