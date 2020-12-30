<link href="all/custom_js/application_form.css" rel="stylesheet" type="text/css" media="all" />
<!-- some information query -->

<div class="main_con"><!--Content Start-->
	<div class="row"><!--- row start--->
		<div class="col-md-9 left_con"><!-- left Content Start-->
			<div class="row">
				<div class="col-md-12"> 
					<div class="panel panel-primary">
						<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">ট্রেড লাইসেন্স আবেদন</div>
						<div class="panel-body all-input-form">
							<form action="index.php/home/tradelicenseapplication_action" method="post" id="defaultForm" enctype="multipart/form-data" class="form-horizontal">

                                <div class="row"  style="margin-top: 10px;">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="col-sm-9">
                                                <label for="Picture" class="col-sm-6 control-label">ছবি</label>
                                                <div class="col-sm-6" style="margin-top:3px;">
                                                    <input type="file" name="file" class="form-control input-file-sm" accept="image/jpeg, image/jpg, image/png" onchange="LoadFile(event);" />
                                                </div>
                                                <div class="clearfix"></div>
                                                <label for="Delivery-type" class="col-sm-6 control-label">সরবরাহের ধরণ  <span>*</span></label>
                                                <div class="col-sm-6">
                                                    <label class="radio-inline"><input type="radio" name="delivery_type" value="1">জরুরী</label>
                                                    <label class="radio-inline"><input type="radio" name="delivery_type" value="2" >অতি জরুরী  </label>
                                                    <label class="radio-inline"><input type="radio" name="delivery_type" value="3" checked="checked"> সাধারন</label>
                                                </div>
                                                <div class="clearfix"></div>
                                                <label for="Application-type" class="col-sm-6 control-label">আবেদনের ধরণ    <span>*</span></label>
                                                <div class="col-sm-6">
                                                    <label class="radio-inline"><input type="radio" name="app_type" id="new_app" value="1" checked="checked">নতুন আবেদন</label>
                                                </div>

                                            </div>
                                            <div class="col-sm-3" id="img_div">
                                                    <img src="<?php echo base_url('library/profile/default.jpg') ?>" class="img-thumbnail"  style="height: 100px" id="img_id">

                                            </div>
                                            <div class="clearfix"> </div>
                                        </div>
                                    </div>
                                </div>
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Owner-type" class="col-sm-3 control-label">প্রতিষ্ঠানের মালিকানার ধরণ <span>*</span></label>
											<div class="col-sm-9">
												<select name="ownertype" id="type_val" class="form-control">
													<?php $bY=$this->db->get("cmd");?>
													<option value="">চিহ্নিত করুন</option>
													<?php foreach($bY->result() as $row):?>
													<option value="<?php echo $row->id;?>"><?php echo $row->title;?></option>
													<?php endforeach;?>
												</select>
											</div>
										</div>
									</div>
								</div>
							
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Institute-english-name" class="col-sm-3 control-label">প্রতিষ্ঠানের নাম (ইংরেজিতে )   <span>*</span></label>
											<div class="col-sm-3">
												<input type="text" name="ecomname" id="ecomname" class="form-control" />
											</div>
											<label for="Institute-bangla-name" class="col-sm-3 control-label">প্রতিষ্ঠানের নাম (বাংলায়)   <span>*</span></label>
											<div class="col-sm-3">
												<input type="text" name="bcomname" id="bcomname" class="form-control" />
											</div>
										</div>
										
									</div>
								</div>
								<div id="clearall">
									<div class="row">
										<div class="col-sm-12"> 
											<div class="form-group">
												<label for="Owner-name-english" class="col-sm-3 control-label">মালিকের নাম ( ইংরেজিতে )   <span>*</span></label>
												<div class="col-sm-3">
													<input type="text" name="ewname[]" id="ewname" class="form-control" placeholder=""  />
												</div>
												<label for="Owner-name-bangla" class="col-sm-3 control-label">মালিকের নাম ( বাংলায় )  <span>*</span></label>
												<div class="col-sm-3">
													<input type="text" name="bwname[]" id="bwname" class="form-control" placeholder=""  />
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-12"> 
											<div class="form-group"> 
												<label for="Gender" class="col-sm-3 control-label">লিঙ্গ   <span>*</span></label>
												<div class="col-sm-3">
													<select name="gender[]" id="gender" class="form-control" required onchange="bybahik_obosthan_show1(this.value);" >
														<option value="">চিহ্নিত করুন</option>
														<option value="male">পুরুষ</option>
														<option value="female">মহিলা</option>
														<option value="others">অন্যান্য</option>
													</select>
												</div>
												<label for="Marital-status" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক  <span>*</span></label>
												<div class="col-sm-3">
													<select name="mstatus[]" id="mstatus" class="form-control" required onchange="bybahik_obosthan_show(this.value);" >
														<option value="">চিহ্নিত করুন</option>
														<option value="বিবাহিত">বিবাহিত</option>
														<option value="অবিবাহিত">অবিবাহিত</option>
														<option value="বিধবা">বিপত্নীক / বিধবা</option>
														<option value="তালাকপ্রাপ্ত">তালাকপ্রাপ্ত</option>
														<option value="নাই">দরকার নাই</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row" id="pitar_nam" style="display: block;">
										<div class="col-sm-12"> 
											<div class="form-group">
												<label for="Father-name-english" class="col-sm-3 control-label">পিতার নাম (ইংরেজিতে)  <span>*</span></label>
												<div class="col-sm-3">
													<input type="text" name="efname[]" id="efname" class="form-control" placeholder=""/>
												</div>
												<label for="Father-name-bangla" class="col-sm-3 control-label">পিতার নাম (বাংলায়)  <span>*</span></label>
												<div class="col-sm-3">
													<input type="text" name="bfname[]" id="bfname" class="form-control" placeholder="" />
												</div>
											</div>
										</div>
									</div>
									
									<div class="row samir_nam" style="display: none;">
										<div class="col-sm-12"> 
											<div class="form-group">
												<label for="Husband-name-english" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে)</label>
												<div class="col-sm-3">
													<input type="text" name="esname[]" id="esname" class="form-control" placeholder=""/>
												</div>
												<label for="Husband-name-bangla" class="col-sm-3 control-label"> স্বামীর নাম (বাংলায়)</label>
												<div class="col-sm-3">
													<input type="text" name="bsname[]" id="bsname" class="form-control" placeholder="" />
												</div>
											</div>
										</div>
									</div>
								
									<div class="row">
										<div class="col-sm-12"> 
											<div class="form-group">
												<label for="Mother-name-english" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে)  <span>*</span></label>
												<div class="col-sm-3">
													<input type="text" name="emname[]" id="emname" class="form-control" placeholder=""/>
												</div>
												<label for="Mother-name-bangla" class="col-sm-3 control-label">মাতার নাম (বাংলায়)  <span>*</span></label>
												<div class="col-sm-3">
													<input type="text" name="bmname[]" id="bmname" class="form-control" placeholder="" />
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row" id="other_owner" style="display: none;">
									<div class="col-sm-12"> 
										<div class="form-group">
											<div class="col-sm-3 col-sm-offset-9">
												<input type="button" class="btn btn-primary" id='natun' name="ncompany" onclick="addRow(this.form);" value='অন্যান্য মালিক' />
											</div>
										</div>
									</div>
								</div>
								
								<div id="itemRows"> 
									
								</div>

								<div class="row">
									<div class="col-sm-6"> 
										<div class="form-group">
											<label for="Vat-id" class="col-sm-6 control-label">ভ্যাট  আইডি (যদি থাকে) </label>
											<div class="col-sm-6">
												<input type="text" name="vatid" id="vatid" class="form-control" maxlength='17' placeholder="ইংরেজিতে"  onkeypress="return checkaccnumber(event);"  />
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="Tax-id" class="col-sm-6 control-label">ট্যাক্স আইডি (যদি থাকে)</label>
											<div class="col-sm-6">
												<input type="text" name="taxid" id="taxid" class="form-control" maxlength='17' placeholder="ইংরেজিতে"  onkeypress="return checkaccnumber(event);" />
											</div>
										</div>
										
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Business-type-bangla" class="col-sm-3 control-label">ব্যবসার ধরন (বাংলায়)  <span>*</span></label>
											<div class="col-sm-9">
												<input type="text" name="business_type" id="btypes" class="form-control" placeholder=""/>
											</div>
										</div>
										
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Business-type-English" class="col-sm-3 control-label">ব্যবসার ধরন (ইংরেজিতে)  <span>*</span></label>
											<div class="col-sm-9">
												<input type="text" name="business_type_english" id="btypes_english" class="form-control" placeholder=""/>
											</div>
										</div>
										
									</div>
								</div>
								
								<div class="row" id="inpucompany" style="display: none;">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Paid-up-capital" class="col-sm-3 control-label" style="color:red;">পরিশোধিত মূলধন (লিঃ কোম্পানির ক্ষেত্রে )<span> *</span></label>
											<div class="col-sm-3">
												<input type="text" name="pay_amount" value="0.00" class="form-control" placeholder=""/>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="app-heading"> 
											ব্যবসার ঠিকানা
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-6">
										<div class="col-sm-offset-6 col-sm-6">
											<div class="app-sub-heading"> 
												( ইংরেজিতে )
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-12"> 
												<div class="form-group">
													<label for="District" class="col-sm-6 control-label">জেলা </label>
													<div class="col-sm-6">
														<input type="text" name="be_dis" id="be_dis" class="form-control" placeholder=""/>
													</div>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-12"> 
												<div class="form-group">
													<label for="Thana" class="col-sm-6 control-label">উপজেলা/থানা</label>
													<div class="col-sm-6">
														<input type="text" name="be_thana" id="be_thana" class="form-control" placeholder=""/>
													</div>
												</div>
											</div>
										</div>
										
										
										<div class="row">
											<div class="col-sm-12"> 
												<div class="form-group">
													<label for="Post-office" class="col-sm-6 control-label">পোষ্ট অফিস </label>
													<div class="col-sm-6">
														<input type="text" name="be_postof" id="be_postof" class="form-control" placeholder=""/>
													</div>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-12"> 
												<div class="form-group">
													<label for="Word-no" class="col-sm-6 control-label">ওয়ার্ড নং</label>
													<div class="col-sm-6">
														<input type="text" name="be_wordno" id="be_wordno" class="form-control" onkeypress="return checkaccnumber(event);"  placeholder=""/>
													</div>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-12"> 
												<div class="form-group">
													<label for="Road-sector-block" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
													<div class="col-sm-6">
														<input type="text" name="be_rbs" id="be_rbs" class="form-control" placeholder=""/>
													</div>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-12"> 
												<div class="form-group">
													<label for="Village-english" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
													<div class="col-sm-6">
														<input type="text" name="be_gram" id="begram" class="form-control" placeholder=""/>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="col-sm-offset-6 col-sm-6">
											<div class="app-sub-heading"> 
												( বাংলায় )
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-12"> 
												<div class="form-group">
													<label for="District-bangla" class="col-sm-6 control-label">জেলা </label>
													<div class="col-sm-6">
														<input type="text" name="bb_dis" id="bb_dis" class="form-control" placeholder=""/>
													</div>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-12"> 
												<div class="form-group">
													<label for="Thana-bangla" class="col-sm-6 control-label">উপজেলা/থানা</label>
													<div class="col-sm-6">
														<input type="text" name="bb_thana" id="bb_thana" class="form-control" placeholder=""/>
													</div>
												</div>
											</div>
										</div>
										
										
										<div class="row">
											<div class="col-sm-12"> 
												<div class="form-group">
													<label for="Post-office-bangla" class="col-sm-6 control-label">পোষ্ট অফিস </label>
													<div class="col-sm-6">
														<input type="text" name="bb_postof" id="bb_postof" class="form-control" placeholder=""/>
													</div>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-12"> 
												<div class="form-group">
													<label for="Word-no-bangla" class="col-sm-6 control-label">ওয়ার্ড নং</label>
													<div class="col-sm-6">
														<input type="text" name="bb_wordno" id="bb_wordno" class="form-control" placeholder=""/>
													</div>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-12"> 
												<div class="form-group">
													<label for="Road-sector-block-bangla" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
													<div class="col-sm-6">
														<input type="text" name="bb_rbs" id="bb_rbs" class="form-control" placeholder=""/>
													</div>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-12"> 
												<div class="form-group">
													<label for="Village-bangla" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
													<div class="col-sm-6">
														<input type="text" name="bb_gram" id="bb_gram" class="form-control" placeholder=""/>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
					
								<div class="row">
									<div class="col-sm-12" style="text-align:center;"> 
										<div class="app-heading"> 
											যোগাযোগের ঠিকানা
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-6"> 
										<div class="form-group">
											<label for="Mobile" class="col-sm-6 control-label">মোবাইল    <span>*</span></label>
											<div class="col-sm-6">
												<input type="text" name="mob" id="mob" class="form-control" placeholder="ইংরেজিতে প্রদান করুন" required />
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="Phone" class="col-sm-6 control-label">ফোন (যদি থাকে ) </label>
											<div class="col-sm-6">
												<input type="text" name="phone" id="phone" class="form-control" onkeypress="return checkaccnumber(event);"  placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Email" class="col-sm-3 control-label">ইমেল</label>
											<div class="col-sm-3">
												<input type="text" name="email" id="email" class="form-control" placeholder=""/>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
	
								<div class="row">
									<div class="col-sm-offset-6 col-sm-6 button-style"> 
										<button type="submit" name="save" id="submit_button" class="btn btn-primary">দাখিল করুন</button>
									</div>
								</div>
							</form>
						</div><!-- panel-body-end---->
					</div><!--- end of panel primary--->
				</div><!-- end of col-md-12---->
			</div><!-- row end--->
		</div><!-- left Content End-->
		
		<script src="all/custom_js/tradelicense_form.js" type="text/javascript"></script>