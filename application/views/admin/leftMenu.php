<div class="ch-container">
    <div class="row">
        
        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas" style="">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Main Menu</li>
                        <li>
							<a class="ajax-link" href="Admin">
								<i class="glyphicon glyphicon-home"></i>
								<span> ড্যাশবোর্ড</span>
							</a>
                        </li>
						<li class="nav-header hidden-md">Application Section</li>
						<li class="accordion">
                            <a href="javascript:void(0);"><i class="glyphicon glyphicon-user"></i><span> &nbsp;আবেদন ফরম</span> &nbsp;<i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="Applicant/nagorickApplication">নাগরিক আবেদন ফরম</a></li>
								<li style="font-size: 12px;"><a href="Applicant/tradelicenseApplication">ট্রেড লাইসেন্স আবেদন ফরম</a></li>
								<li><a href="Applicant/warishApplication">ওয়ারিশ আবেদন ফরম</a></li>
								<li style="font-size: 12px;"><a href="Applicant/otherServiceApplication">অন্যান্য সনদের আবেদন ফরম  </a></li>
                            </ul>
                        </li>
						<li class="accordion">
                            <a href="javascript:void(0);"><i class="glyphicon glyphicon-user"></i><span> &nbsp; নাগরিক আবেদন</span> &nbsp;<i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="Applicant/nagorickapplicant?napply=new" <?php $this->chk->acl('nagorickapplicant'); ?>>নতুন আবেদনকারীগন</a></li>
								<li><a href="Applicant/nagorickapplicant?napply=5" <?php $this->chk->acl('nagorickapplicant'); ?>>সনদ গ্রহণকারীগন</a></li>
                            </ul>
                        </li>
						<li class="accordion">
                            <a href="javascript:void(0);"><i class="glyphicon glyphicon-user"></i><span>&nbsp; ট্রেড লাইসেন্স আবেদন</span>&nbsp;<i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="Applicant/tradelicenseapplicant?napply=new" <?php $this->chk->acl('tradelicenseapplicant'); ?>>নতুন আবেদনকারীগন</a></li>
								<li><a href="Applicant/tradelicenseapplicant?napply=5" <?php $this->chk->acl('tradelicenseapplicant'); ?>>সনদ গ্রহণকারীগন</a></li>
								<li><a href="Applicant/reNewTradelicense">নবায়ন আবেদনকারীগন</a></li>
								<li><a href="Applicant/tradelicenseapplicant?napply=expire"<?php $this->chk->acl('tradelicenseapplicant'); ?>>মেয়াদ উত্তীর্ণ ট্রেড লাইসেন্স</a></li>
                            </ul>
                        </li>
						<li class="accordion">
                            <a href="javascript:void(0);"><i class="glyphicon glyphicon-user"></i><span> &nbsp; ওয়ারিশ আবেদন</span>&nbsp;<i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="Applicant/warishapplicant?napply=new" <?php $this->chk->acl('warishapplicant'); ?>>নতুন আবেদনকারীগন</a></li>
								<li><a href="Applicant/warishapplicant?napply=5" <?php $this->chk->acl('warishapplicant'); ?> >সনদ গ্রহণকারীগন</a></li>
                            </ul>
                        </li>
						<li class="accordion">
                            <a href="javascript:void(0);"><i class="glyphicon glyphicon-user"></i><span> &nbsp; অন্যান্য সেবাসমূহ</span> &nbsp;<i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="Applicant/otherService?napply=new">নতুন আবেদনকারীগন</a></li>
								<!--<li style="font-size: 13px;"><a href="Applicant/otherService?napply=5">সনদ গ্রহণকারীগন</a></li>-->
								<?php 
									$qy = $this->db->select("id,listName")->from("otherservicelist")->where("status",1)->order_by("id","asc")->get();
									
									$service = $qy->result();
									foreach($service as $serviceShow):
								?>
								<li style="font-size: 13px;"><a href="Applicant/otherService?napply=5&service=<?php echo $serviceShow->id;?>"><?php echo $serviceShow->listName;?></a></li>
								<?php 
									endforeach;
								?>
                            </ul>
                        </li>
                        <li class="accordion">
                            <a href="javascript:void(0);"><i class="glyphicon glyphicon-tags"></i><span> &nbsp;খাদ্য বান্ধব কর্মসূচি</span> &nbsp;<i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="FoodController" >আবেদনকারীগন </a></li>
                                <li><a href="FoodController/foodCollection"> খাদ্য সংগ্রহ </a></li>
                                <li><a href="FoodController/foodProgram">কর্মসূচি সমূহ </a></li>
                                <li><a href="FoodController/issuingAuthority">ইস্যুকারীর তথ্য</a></li>
                                <li><a href="FoodController/dealerInfo">ডিলারের তথ্য</a></li>
                                <li><a  href="DailyReports/foodApplicantReport" target="_blank">রিপোর্ট আবেদনকারীগন </a></li>
                                <li><a href="DailyReports/foodCollectionReport" target="_blank">রিপোর্ট খাদ্য সংগ্রহ</a></li>
                            </ul>
                        </li>
                         <li class="accordion">
                            <a href="javascript:void(0);"><i class="glyphicon glyphicon-tags"></i><span> &nbsp;ভিজিডি খাদ্য বিতরণ</span> &nbsp;<i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="VgdController" >সদস্য গন </a></li>
                                <!--
                                <li><a href="VgdController/distributesRecord"> বিতরণের তথ্য সমূহ </a></li>
                                -->
                                <li><a href="VgdController/setupInfo">সেটিংস সমূহ </a></li>
                                <!--
                                <li><a  href="DailyReports/vgdApplicantReport" target="_blank">সদস্যেদের রিপোর্ট </a></li>
                                 -->
                                <li><a href="DailyReports/vgdDistributesReport" target="_blank">বিতরণের রিপোর্ট</a></li>

                            </ul>
                        </li>

						<li>
							<a class="ajax-link" href="Admin/mamlaNotice">
								<i class="glyphicon glyphicon-tags"></i> &nbsp;
								<span>মামলার নোটিশ তৈরি </span>
							</a> 
						</li>
						
						<li class="nav-header hidden-md">Collection Section</li>
						
						<li>
							<a class="ajax-link" href="Admin/dailySubmit" <?php $this->chk->acl('dailySubmit'); ?>>
								<i class="glyphicon glyphicon-inbox"></i> &nbsp;
								<span> দৈনিক জমা </span>
							</a>
						</li>
						<li>
							<a class="ajax-link" href="Admin/dailyExp">
								<i class="glyphicon glyphicon-inbox"></i> &nbsp;
								<span> দৈনিক খরচ </span>
							</a>
						</li>
						
						<li class="nav-header hidden-md">TAX Collection Section</li>
						<li class="accordion">
                            <a href="javascript:void(0);"><i class="glyphicon glyphicon-tags"></i><span> &nbsp;কর</span> &nbsp;<i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="nav nav-pills nav-stacked">
								<li><a href="Admin/taxCollection" <?php $this->chk->acl('taxCollection'); ?>>কর আদায় </a></li>
								<li><a href="Setup_section/assessmentForm"<?php $this->chk->acl('assessmentForm'); ?>> ট্যাক্স  এ্যাসেসমেন্ট  ফরম </a></li>
								<li style="font-size: 12px;"><a href="DailyReports/daily_holding_tax_report"  target='_blank' <?php $this->chk->acl('dailyCollection'); ?>>দৈনিক বসতভিটার প্রতিবেদন</a></li>
								<li style="font-size: 11px;"><a href="DailyReports/yearly_holding_tax_report"  target='_blank' <?php $this->chk->acl('dailyCollection'); ?>>বাৎসরিক বসতভিটার প্রতিবেদন</a></li>
								<li style="font-size: 11px;"><a href="DailyReports/holding_tax_unrealized_report"  target='_blank' <?php $this->chk->acl('dailyCollection'); ?>>অনাদায়ী বসতভিটার প্রতিবেদন</a></li>
								<li style="font-size: 12px;"><a href="DailyReports/holding_tax_list"  target='_blank' <?php $this->chk->acl('dailyCollection'); ?>>হোল্ডিং টেক্সধারীদের তালিকা</a></li>
                            </ul>
                        </li>
						
						<li class="nav-header hidden-md">Transfer Section</li>
						
						<li class="accordion">
                            <a href="javascript:void(0);"><i class="glyphicon glyphicon-usd"></i><span> টাকার বিনিময়</span>&nbsp;<i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="nav nav-pills nav-stacked">
								<li><a href="Transfer/bankTransfers" <?php $this->chk->acl('bankTransfers'); ?>>ব্যাংকের টাকা বিনিময়</a></li>
								<li><a href="Transfer/fundTransfers" <?php $this->chk->acl('fundTransfers'); ?>>ফান্ডের টাকা বিনিময়</a></li>
                            </ul>
                        </li>
						<li class="nav-header hidden-md">Report Section</li>
						<li class="accordion">
                            <a href="javascript:void(0);"><i class="glyphicon glyphicon-book"></i><span> &nbsp;রশিদ সমূহ</span> &nbsp;<i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="nav nav-pills nav-stacked">
								<li><a href="Money_receipt/allroshid" <?php $this->chk->acl('allroshid'); ?>>সকল রশিদ সমূহ</a></li>
								<li><a href="javascript:void(0)" onclick="tablclick('tradelicens');"> ট্রেড লাইসেন্স রশিদ</a></li>
								<li><a href="javascript:void(0)" onclick="tablclick('bosotvita');">বসতভিটার কর রশিদ</a></li>
								<li><a href="javascript:void(0)" onclick="tablclick('peshazibikor');">পেশাজীবি কর রশিদ</a></li>
								<li><a href="javascript:void(0)" onclick="tablclick('dailycollection');">দৈনিক জমা রশিদ</a></li>
								<li><a href="javascript:void(0)" onclick="tablclick('dailyExpense');">দৈনিক খরচের রশিদ</a></li>
								
								<li><a href="javascript:void(0)" onclick="tablclick('nagoriksonod');">নাগরিক সনদ রশিদ</a></li>
								<li><a href="javascript:void(0)" onclick="tablclick('warishsonod');">ওয়ারিশ সনদ রশিদ</a></li>
								<li><a href="javascript:void(0)" onclick="tablclick('trade_bosodbitakor');">ট্রেড লাইসেন্সধারির বসত ভিটা কর</a></li>
                            </ul>
                        </li>
						<li class="accordion">
                            <a href="javascript:void(0);"><i class="glyphicon glyphicon-list-alt"></i> দৈনিক হিসাবের রিপোর্ট</span> <i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="nav nav-pills nav-stacked">
								<li><a href="DailyReports/dailyCollection"  target='_blank' <?php $this->chk->acl('dailyCollection'); ?>>দৈনিক কালেকশন</a></li>
								<li><a href="DailyReports/dailyVatCollection"  target='_blank' <?php $this->chk->acl('dailyVatCollection'); ?>>দৈনিক ভ্যাট কালেকশন</a></li>
								<li><a href="DailyReports/dailyExpense"  target='_blank' >দৈনিক খরচ</a></li>
								<li><a href="DailyReports/dailyBankDetails" <?php $this->chk->acl('dailyBankDetails'); ?>>দৈনিক ব্যাংক বিবরণ</a></li>
								<li><a href="DailyReports/dailyMainLedger" <?php $this->chk->acl('dailyMainLedger'); ?>>মূল খাতের বিবরণ</a></li>
								<li><a href="DailyReports/dailySubLedger" <?php $this->chk->acl('dailySubLedger'); ?>>আনুসাঙ্গিক খাতের বিবরণ</a></li>
                            </ul>
                        </li>
						<li class="accordion">
                            <a href="javascript:void(0);"><i class="glyphicon glyphicon-book"></i><span> &nbsp;প্রতিবেদন</span>&nbsp;<i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="nav nav-pills nav-stacked">
								<li style="font-size: 12px;"><a href="DailyReports/dailyShortReport"  target='_blank' <?php $this->chk->acl('dailyCollection'); ?>>দৈনিক ট্রেড লাইসেন্স প্রতিবেদন</a></li>
								<li><a href="DailyReports/monthlyReport" target="_blank">মাসিক প্রতিবেদন</a></li>
								<li><a href="DailyReports/yearlyReport" target="_blank">বাৎসরিক প্রতিবেদন</a></li>
                            </ul>
                        </li>
						
						<!--
						<li class="accordion">
                            <a href="javascript:void(0);"><i class="glyphicon glyphicon-user"></i><span> &nbsp;বাজেট</span>&nbsp;<i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="nav nav-pills nav-stacked">
								<li><a href="javascript:void(0)"></a></li>
								<li><a href="javascript:void(0)"></a></li>
								<li><a href="javascript:void(0)"></a></li>
								<li><a href="javascript:void(0)"></a></li>
                            </ul>
                        </li>-->
						<li class="nav-header hidden-md">Manage Section</li>
						<li class="accordion">
                            <a href="javascript:void(0);"><i class="glyphicon glyphicon-user"></i><span> &nbsp; ইউজার ম্যানেজমেন্ট</span>&nbsp;<i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="nav nav-pills nav-stacked">
								<li><a href="Manage/employeeList" <?php $this->chk->acl('employeeList'); ?>>ইউজার তালিকা</a></li>
								<li><a href="Manage/employeeManage" <?php $this->chk->acl('employeeManage'); ?>>নতুন ইউজার তৈরী </a></li>
								<li><a href="role/role" <?php $this->chk->acl('role'); ?>>Role Create</a></li>
								<li><a href="role/role_list" <?php $this->chk->acl('role_list'); ?>>Role List</a></li>
                            </ul>
                        </li>
						
						<li class="accordion">
                            <a href="javascript:void(0);"><i class="glyphicon glyphicon-globe"></i><span> &nbsp;ওয়েব সাইট ম্যানেজ</span>&nbsp;<i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="nav nav-pills nav-stacked">
								<li><a href="Manage/webSiteUpMemberList" <?php $this->chk->acl('webSiteUpMemberList'); ?>>ইউপি  কর্মকর্তা ও কর্মচারী</a></li>
								<li><a href="Manage/charimanMessage" <?php $this->chk->acl('charimanMessage'); ?>>চেয়ারম্যান ম্যাসেজ</a></li>
								<li><a href="Admin/newsManage" <?php $this->chk->acl('newsManage'); ?>>খবর ম্যানেজ</a></li>
								<li><a href="Admin/dynamicSlide" <?php $this->chk->acl('dynamicSlide'); ?>>কভার ফটো পরিবর্তন </a></li>
								<li><a href="Admin/logoManage" <?php $this->chk->acl('dynamicSlide'); ?>>লগো পরিবর্তন </a></li>
								<li><a href="Admin/upMap" <?php $this->chk->acl('upMap'); ?>>ইউপি  ম্যাপ</a></li>
								<li><a href="Manage/unionPorishad" <?php $this->chk->acl('unionPorishad'); ?>>ইউনিয়ন পরিষদের তালিকা </a></li>
                            </ul>
                        </li>
						<li>
							<a class="ajax-link" href="Admin/toolSetting">
								<i class="glyphicon glyphicon-wrench"></i> &nbsp;
								<span> কনট্রোল টুলস্</span>
							</a>
						</li>	
						<li class="accordion">
                            <a  class="ajax-link" href="javascript:void(0);">&nbsp;<span> ওয়েব সিকুরিটি সেটিং</span> &nbsp;<i class="glyphicon glyphicon-chevron-down"></i></a>
							 <ul class="nav nav-pills nav-stacked">
								 <li><a href="Security/security_setup">Primary Setting</a></li>
								<li><a href="Security/security_question_setting">Security Question</a></li>
							 </ul>
						</li>
						
						<li class="nav-header hidden-md">Setup Section</li>
						<li class="accordion">
                            <a href="javascript:void(0);"><i class="glyphicon glyphicon-edit"></i><span>&nbsp; সেটআপ মেনু</span> &nbsp;<i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="nav nav-pills nav-stacked">
								<li><a href="index.php/setup_section/newAccEntry" <?php $this->chk->acl('newAccEntry'); ?>>একাউন্টিং সেটআপ</a></li>
								<li><a href="index.php/setup_section/rateSheet" <?php $this->chk->acl('rateSheet'); ?>>ট্রেডলাইসেন্সের ফি নির্ধারণ</a></li>
								<li><a href="index.php/setup_section/holdingRateSheet" <?php $this->chk->acl('holdingRateSheet'); ?>>বসতভিটার ফি নির্ধারণ  </a></li>
								<li><a href="index.php/setup_section/mainCtgEntry" <?php $this->chk->acl('mainCtgEntry'); ?>>আয়ের মূল খাত </a></li> 
								<li><a href="index.php/setup_section/SubCtgEntry" <?php $this->chk->acl('SubCtgEntry'); ?>>আয়ের  আনুসাঙ্গিক খাত</a></li>
								<li><a href="index.php/setup_section/ExpCtgEntry" <?php $this->chk->acl('ExpCtgEntry'); ?>>খরচের মূল খাত   </a></li>
								<li><a href="index.php/setup_section/ExpSubCtgEntry" <?php $this->chk->acl('ExpSubCtgEntry'); ?>>খরচের আনুসাঙ্গিক খাত </a></li>
								<li><a href="index.php/setup_section/memberAddForm" <?php $this->chk->acl('memberAddForm'); ?>>ওয়ার্ড মেম্বার যোগ করুন</a></li>
								<li><a href="index.php/setup_section/holdingRateSheetLevel">বসতভিটার  ধরন</a></li>
								<li><a href="index.php/setup_section/occupation">পেশা</a></li>
								<li><a href="index.php/setup_section/classification">শ্রেণী</a></li>
                            </ul>
                        </li>
						<li class="accordion">
						 <a href="javascript:void(0);"><i class="glyphicon glyphicon-cog"></i><span> &nbsp;এস এম এস সেটিংস</span>&nbsp;<i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="nav nav-pills nav-stacked">
								<li>
								<a href="setup/sms_config">&nbsp;SMS API Configuration</a></li>
                                <li>
								<a href="setup/type_of_messages">&nbsp;Type of Messages</a></li> 
                                 <li><a href="setup/sms_notification_setting">&nbsp; কখন এস এম এস যাবে</a></li>              		
                            </ul>
						
						</li>
						<li class="accordion">
                            <a href="javascript:void(0);"><i class="glyphicon glyphicon-cog"></i><span> &nbsp;ইউজার প্রোফাইল সেটিং</span>&nbsp;<i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="nav nav-pills nav-stacked">
								<li><a href="index.php/setup_section/adminProfile" <?php $this->chk->acl('adminProfile'); ?>>ইউজার প্রোফাইল </a></li>
                                <li><a href="index.php/setup_section/changeProfile" <?php $this->chk->acl('changePassword'); ?>>প্রোফাইল পরিবর্তন</a></li>
                                <li><a href="index.php/setup_section/changePassword" <?php $this->chk->acl('changePassword'); ?>>পাসওয়ার্ড পরিবর্তন</a></li>
                            </ul>
                        </li>
						
						<li class="nav-header hidden-md">Needful Software Download</li>
						<li style="font-size: 12px;">
							<a class="ajax-link" href="https://anydesk.com/download" target="_blank">
								<i class="glyphicon glyphicon-download-alt"></i> &nbsp;
								<span>AnyDesk Download</span>
							</a>
						</li>
						<li style="font-size: 12px;">
							<a class="ajax-link" href="http://filehippo.com/download_teamviewer/download/91d209e756f960ecc9a4dd9e5f480e25/" target="_blank">
								<i class="glyphicon glyphicon-download-alt"></i> &nbsp;
								<span>TeamViewer Download</span>
							</a>
						</li>
                    </ul>
                    <label id="for-is-ajax" for="is-ajax"><input id="is-ajax" type="hidden"><!-- Ajax on menu--></label>
					<li class="nav-header hidden-md"><p style="text-align: right;letter-spacing: 1px;">version 4.0.2</p></li>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>