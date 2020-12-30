<div id="content" class="col-lg-10 col-sm-10">
	<link href="all/custom_js/application_form.css" rel="stylesheet" type="text/css" media="all" />
	<?php 
		extract($_GET);
	?>

	<div class="row">
		<div class="col-md-12"> 
			<div class="panel panel-primary">
				<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">অন্যান্য সনদ এর জন্য আবেদন ফরম</div>
				<div class="panel-body all-input-form">

				
					<form action="index.php/Applicant/otherserviceapplication_action" method="post" id="defaultForm" class="form-horizontal">

                        <div class="row"  style="margin-top: 10px;">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="Picture" class="col-sm-3 control-label">ছবি</label>
                                    <div class="col-sm-5" style="margin-top:3px;">
                                        <input type="file" name="file" class="form-control input-file-sm" />
                                    </div>
                                    <div class="col-sm-4" id="UPLOAD">
                                        <img src="<?php echo base_url('library/profile/default.jpg') ?>" id="image" width="180"  height="170" class="img-thumbnail" />
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                            </div>
                        </div>
						
						<div class="row">
							<div class="col-sm-12" style="margin-bottom:10px;margin-top:10px;"> 
								<div class="form-group"> 
									<label for="Service List" class="col-sm-3 control-label"> সেবা সমহু  <span>*</span></label>
									<div class="col-sm-3">
										<select name="serviceList" id="serviceList" class="form-control" required onchange="serviceSelect(this.value);" >
											<option value="0">চিহ্নিত করুন</option>
											<?php 
												$qy = $this->db->select("id,listName")->from("otherservicelist")->where("status",1)->order_by("id","asc")->get()->result();
												foreach($qy as $serviceInfo):
											?>
												<option value="<?php echo $serviceInfo->id;?>"><?php echo $serviceInfo->listName;?></option>
											<?php 
												endforeach;
											?>
										</select>
									</div>
									<label for="Delivery-type" class="col-sm-3 control-label"> সরবরাহের ধরণ  <span>*</span></label>
									<div class="col-sm-3">
										<select name="delivery_type" id="delivery_type" class="form-control" required >
											<option value="2">অতি জরুরী </option>
											<option value="1">জরুরী</option>
											<option value="3" selected>সাধারন</option>
											
										</select>
									</div>
									
								</div>
							</div>
						</div>
						
						<div id="other_info" style="">
							<div class="row">
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="Income Measured" class="col-sm-6 control-label">আয়ের পরিমান( ইংরেজিতে ) </label>
										<div class="col-sm-6">
											<input type="text" name="incomeAmount" id="incomeAmount" class="form-control"  onkeypress="return checkaccnumber(event);"  placeholder="" />
											<span class="sub-hints">বি.দ্র. : বার্ষিক আয়ের প্রত্যয়ন পত্র এর জন্য!</span>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="Publish Name" class="col-sm-6 control-label">প্রকাশে নাম</label>
										<div class="col-sm-6">
											<input type="text" name="publishName" id="publishName" class="form-control"  placeholder="" />
											<span class="sub-hints">বি.দ্র. : একই নামের প্রত্যয়ন পত্র এর জন্য!</span>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="Work Placed" class="col-sm-6 control-label">কর্ম ক্ষেত্রের নাম</label>
										<div class="col-sm-6">
											<input type="text" name="workPlace" id="workPlace" class="form-control"  placeholder="" />
											<span class="sub-hints">বি.দ্র. : অনুমতি পত্র এর জন্য! যেমন: পুলিশ.</span>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="Death-date" class="col-sm-6 control-label">মৃত্যু তারিখ </label>
										<div class="col-sm-6 date">
											<div class="input-group input-append date" id="deathPicker">
												<input type="date" class="form-control" name="ddfb" />
												<span class="sub-hints">বি.দ্র. : মৃত্যুর সনদ পত্রের জন্য</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div id="mukti_part_posso" style="">
							<div class="row">
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="mukti name" class="col-sm-6 control-label">মুক্তিযোদ্ধার নাম</label>
										<div class="col-sm-6">
											<input type="text" name="mukti_name" id="mukti_name" class="form-control"  placeholder="" />
											<span class="sub-hints">বি.দ্র. : মুক্তিযোদ্ধা সনদ পত্র এর জন্য!</span>
										</div>
									</div>
								</div>
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="gejet no" class="col-sm-6 control-label">গেজেট নং</label>
										<div class="col-sm-6">
											<input type="text" name="gejet_no" id="gejet_no" class="form-control"  placeholder="ইংরেজিতে প্রদান করুন" />
											<span class="sub-hints">বি.দ্র. : মুক্তিযোদ্ধা সনদ পত্র এর জন্য! </span>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="mukti sonshod sonod no" class="col-sm-3 control-label">মুক্তিযোদ্ধা সংসদের সনদ নং</label>
										<div class="col-sm-9">
											<input type="text" name="m_sonshod_sonod" id="m_sonshod_sonod" class="form-control"  placeholder="" />
											<span class="sub-hints">বি.দ্র. : মুক্তিযোদ্ধা সনদ পত্র এর জন্য!</span>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="Sector No" class="col-sm-6 control-label">সেক্টর নং </label>
										<div class="col-sm-6">
											<input type="text" name="sector" id="sector" class="form-control"  placeholder="ইংরেজিতে প্রদান করুন" />
											<span class="sub-hints">বি.দ্র. : মুক্তিযোদ্ধা সনদ পত্র এর জন্য!</span>
										</div>
									</div>
								</div>
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="Mukti sonod" class="col-sm-6 control-label">মুক্তিবার্তা নং </label>
										<div class="col-sm-6">
											<input type="text" name="mukti_sonod" id="mukti_sonod" class="form-control"  placeholder="ইংরেজিতে প্রদান করুন" />
											<span class="sub-hints">বি.দ্র. : মুক্তিযোদ্ধা সনদ পত্র এর জন্য! </span>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="relation" class="col-sm-6 control-label">মুক্তিযোদ্ধার সাথে সম্পর্ক</label>
										<div class="col-sm-6">
											<input type="text" name="relation" id="relation" class="form-control"  placeholder="যেমন: কন্যার পুত্র(নাতিন)" />
											<span class="sub-hints">বি.দ্র. : মুক্তিযোদ্ধা সনদ পত্র এর জন্য!</span>
										</div>
									</div>
								</div>
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="Short Relation" class="col-sm-6 control-label">সংক্ষেপে</label>
										<div class="col-sm-6">
											<input type="text" name="short_rel" id="short_rel" class="form-control"  placeholder="যেমন: দাদা/ নানা/" />
											<span class="sub-hints">বি.দ্র. : মুক্তিযোদ্ধা সনদ পত্র এর জন্য! </span>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div id="only_mukti_part" style="">
							<div class="row">
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="Sector No" class="col-sm-6 control-label">সেক্টর নং </label>
										<div class="col-sm-6">
											<input type="text" name="sector2" id="sector2" class="form-control"  placeholder="ইংরেজিতে প্রদান করুন" />
											<span class="sub-hints">বি.দ্র. : মুক্তিযোদ্ধা সনদ পত্র এর জন্য!</span>
										</div>
									</div>
								</div>
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="Mukti sonod" class="col-sm-6 control-label">মুক্তিবার্তা নং </label>
										<div class="col-sm-6">
											<input type="text" name="mukti_sonod2" id="mukti_sonod2" class="form-control"  placeholder="ইংরেজিতে প্রদান করুন" />
											<span class="sub-hints">বি.দ্র. : মুক্তিযোদ্ধা সনদ পত্র এর জন্য! </span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6"> 
								<div class="form-group">
									<label for="National-id-english" class="col-sm-6 control-label">ন্যাশনাল আইডি (ইংরেজিতে)  </label>
									<div class="col-sm-6">
										<input type="text" name="nationid" id="nid" class="form-control" maxlength='17' onkeypress="return checkaccnumber(event);"  placeholder="" />
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="Birth-no" class="col-sm-6 control-label">জন্ম নিবন্ধন নং ( ইংরেজিতে ) </label>
									<div class="col-sm-6">
										<input type="text" name="bcno" id="bcno" class="form-control" maxlength="17" onkeypress="return checkaccnumber(event);"  placeholder="" />
									</div>
								</div>
							</div>
						</div>
					
						<div class="row">
							<div class="col-sm-6"> 
								<div class="form-group">
									<label for="Passport-no" class="col-sm-6 control-label">পাসপোর্ট নং ( ইংরেজিতে ) </label>
									<div class="col-sm-6">
										<input type="text" name="pno" id="pno" class="form-control" maxlength='17' placeholder=""/>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="Birth-date" class="col-sm-6 control-label">জম্ম তারিখ  <span>*</span></label>
									<div class="col-sm-6 date">
										<div class="input-group input-append date" id="">
											<input type="date" class="form-control" name="dofb" />
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Name-english" class="col-sm-3 control-label">নাম ( ইংরেজিতে )   <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="ename" id="name" class="form-control" placeholder="" required />
									</div>
									<label for="Name-bangla" class="col-sm-3 control-label">নাম ( বাংলায় )  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bname" id="bname" class="form-control" placeholder="" required />
									</div>
								</div>
							</div>
						</div>
		
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group"> 
									<label for="Gender" class="col-sm-3 control-label">লিঙ্গ   <span>*</span></label>
									<div class="col-sm-3">
										<select name="gender" id="gender" class="form-control" required onchange="testshowHide(this.value);" >
											<option value="">চিহ্নিত করুন</option>
											<option value="male">পুরুষ</option>
											<option value="female">মহিলা</option>
											<option value="others">অন্যান্য</option>
										</select>
									</div>
									<label for="Marital-status" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক  <span>*</span></label>
									<div class="col-sm-3">
										<select name="mstatus" id="mstatus" class="form-control" required  >
											<option value="">চিহ্নিত করুন</option>
											<option value="1">বিবাহিত</option>
											<option value="2">অবিবাহিত</option>
											<option value="3">বিপত্নীক / বিধবা</option>
											<option value="4">তালাকপ্রাপ্ত</option>
											<option value="5">দরকার নাই</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row" id="wife" style="display: none;" data-topic="1" >
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Wife-name-english" class="col-sm-3 control-label">স্ত্রীর  নাম (ইংরেজিতে)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="eWname" id="eWname" class="form-control" placeholder="" />
									</div>
									<label for="Wife-name-bangla" class="col-sm-3 control-label">স্ত্রীর নাম (বাংলায়) <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bWname" id="bWname" class="form-control" placeholder="" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row" id="husband" style="display: none;" data-topic="2" >
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Husband-name-english" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে) <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="eHname" id="eHname" class="form-control" placeholder="" />
									</div>
									<label for="Husband-name-bangla" class="col-sm-3 control-label"> স্বামী নাম (বাংলায়) <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bHname" id="bHname" class="form-control" placeholder="" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Father-name-english" class="col-sm-3 control-label">পিতার নাম (ইংরেজিতে)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="efname" id="efname" class="form-control" placeholder="" required />
									</div>
									<label for="Father-name-bangla" class="col-sm-3 control-label">পিতার নাম (বাংলায়)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bfname" id="bfname" class="form-control" placeholder="" required />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Mother-name-english" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="emname" id="mname" class="form-control" placeholder="" required />
									</div>
									<label for="Mother-name-bangla" class="col-sm-3 control-label">মাতার নাম (বাংলায়)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bmane" id="emane" class="form-control" placeholder="" required />
									</div>
								</div>
							</div>
						</div>
					
						<div class="row">
							<div class="col-sm-6"> 
								<div class="form-group">
									<label for="profession" class="col-sm-6 control-label">পেশা</label>
									<div class="col-sm-6">
										<input type="text" name="ocupt" id="occupation" class="form-control" placeholder="" maxlength="500" />
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="Education-qualification" class="col-sm-6 control-label">শিক্ষাগত যোগ্যতা</label>
									<div class="col-sm-6">
										<input type="text" name="qualification" id="qualification" class="form-control" placeholder=""  maxlength="500" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="Religion" class="col-sm-6 control-label">ধর্ম    <span>*</span></label>
									<div class="col-sm-6">
										<select name="religion" class="form-control" required >
											<option value=''>চিহ্নিত করুন</option>
											<option value='ইসলাম'>ইসলাম</option>
											<option value='হিন্দু'>হিন্দু</option>
											<option value='বৌদ্ধ ধর্ম'>বৌদ্ধ ধর্ম</option>
											<option value='খ্রিস্ট ধর্ম'>খ্রিস্ট ধর্ম</option>
											<option value='অন্যান্য'>অন্যান্য</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="Resident" class="col-sm-6 control-label">বাসিন্দা    <span>*</span></label>
									<div class="col-sm-6">
										<select name="bashinda" id='bs' class="form-control" onchange="basinda_show_hide(this.value);" required >
											<option value=''>চিহ্নিত করুন</option>
											<option value='1'>অস্থায়ী</option>
											<option value='2'>স্থায়ী</option>
										</select>
									</div>
								</div>	
							</div>	
						</div>
						
						<div class="row">
							<div class="col-sm-12"> 
								<div class="app-heading"> 
									বর্তমান ঠিকানা
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
											<label for="District-english" class="col-sm-6 control-label">জেলা </label>
											<div class="col-sm-6">
												<input type="text" name="p_dis" id="p_dis" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana-english" class="col-sm-6 control-label">উপজেলা/থানা</label>
											<div class="col-sm-6">
												<input type="text" name="p_thana" id="p_thana" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office-english" class="col-sm-6 control-label">পোষ্ট অফিস </label>
											<div class="col-sm-6">
												<input type="text" name="p_postof" id="p_postof" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no-english" class="col-sm-6 control-label">ওয়ার্ড নং</label>
											<div class="col-sm-6">
												<input type="text" name="p_wordno" id="p_wordno" class="form-control" onkeypress="return checkaccnumber(event);"  placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-block-sector-english" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="p_rbs" id="p_rbs" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village-english" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
											<div class="col-sm-6">
												<input type="text" name="p_gram" id="p_gram" class="form-control" placeholder=""/>
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
												<input type="text" name="pb_dis" id="pb_dis" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana-bangla" class="col-sm-6 control-label">উপজেলা/থানা</label>
											<div class="col-sm-6">
												<input type="text" name="pb_thana" id="pb_thana" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office-bangla" class="col-sm-6 control-label">পোষ্ট অফিস </label>
											<div class="col-sm-6">
												<input type="text" name="pb_postof" id="pb_postof" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no-bangla" class="col-sm-6 control-label">ওয়ার্ড নং</label>
											<div class="col-sm-6">
												<input type="text" name="pb_wordno" id="pb_wordno" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-block-sector-bangla" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="pb_rbs" id="pb_rbs" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village-bangla" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
											<div class="col-sm-6">
												<input type="text" name="pb_gram" id="pb_gram" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row" id="permaHeading">
							<div class="col-sm-12" style="text-align:center;"> 
								<div class="app-heading"> 
									স্থায়ী  ঠিকানা
								</div>
							</div>
						</div>
						
						<div class="row" id="permanentAddress">
							<div class="col-sm-6">
								<div class="col-sm-offset-6 col-sm-6">
									<div class="app-sub-heading"> 
										( ইংরেজিতে )
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="District-english" class="col-sm-6 control-label">জেলা </label>
											<div class="col-sm-6">
												<input type="text" name="per_dis" id="per_dis" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana-english" class="col-sm-6 control-label">উপজেলা/থানা</label>
											<div class="col-sm-6">
												<input type="text" name="per_thana" id="per_thana" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office-english" class="col-sm-6 control-label">পোষ্ট অফিস </label>
											<div class="col-sm-6">
												<input type="text" name="per_postof" id="postof" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no-english" class="col-sm-6 control-label">ওয়ার্ড নং</label>
											<div class="col-sm-6">
												<input type="text" name="per_wordno" id="per_wordno" class="form-control" onkeypress="return numtest();"  placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-block-sector-english" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="per_rbs" id="per_rbs" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village-english" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
											<div class="col-sm-6">
												<input type="text" name="per_gram" id="per_gram" class="form-control" placeholder=""/>
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
												<input type="text" name="perb_dis" id="perb_dis" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana-bangla" class="col-sm-6 control-label">উপজেলা/থানা</label>
											<div class="col-sm-6">
												<input type="text" name="perb_thana" id="perb_thana" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office-bangla" class="col-sm-6 control-label">পোষ্ট অফিস </label>
											<div class="col-sm-6">
												<input type="text" name="perb_postof" id="perb_postof" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no-bangla" class="col-sm-6 control-label">ওয়ার্ড নং</label>
											<div class="col-sm-6">
												<input type="text" name="perb_wordno" id="perb_wordno" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-block-sector-bangla" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="perb_rbs" id="perb_rbs" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village-bangla" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
											<div class="col-sm-6">
												<input type="text" name="perb_gram" id="perb_gram" class="form-control" placeholder=""/>
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
										<input type="text" name="mob" id="mob" class="form-control"  placeholder="ইংরেজিতে প্রদান করুন" onkeypress=""  required />
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="Email" class="col-sm-6 control-label">ইমেল </label>
									<div class="col-sm-6">
										<input type="text" name="email" id="email" class="form-control" placeholder=""/>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Designation" class="col-sm-3 control-label">সংযুক্তি (যদি থাকে)</label>
									<div class="col-sm-9">
										<textarea name="attachment" class="form-control" rows="5" id="attachment" placeholder="উদাহরন: মুক্তিযোদ্ধা সন্তান, বিধবা, উপজাতি .....ইত্যাদি"></textarea>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-offset-6 col-sm-6 button-style"> 
								<button type="submit" name="save" id="submit_button" class="btn btn-primary">দাখিল করুন</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!-- row end--->
	
	<script src="all/custom_js/otherService_form.js" type="text/javascript"></script>
	<style type="text/css"> 
		.sub-hints{
			font-size: 12px;
			margin-top: 5px;
			font-style: italic;
			opacity: 0.8;
			text-align: center;
			color: red;
		}
	</style>
</div><!--/#content.col-md-10-->