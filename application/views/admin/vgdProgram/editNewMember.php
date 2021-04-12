
<div id="content" class="col-lg-10 col-sm-10">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="col-sm-8"><div class="row"> <?php echo (!empty($title)?$title:''); ?></div></div>
                    <div class="col-sm-4">
                        <a href="VgdController" class="btn-success btn-xs pull-right"><i class="glyphicon glyphicon-list-alt"></i> সদস্যের তালিকা
                        </a>

                    </div>
                    <div class="clearfix"></div>

                </div>
                <div class="panel-body all-input-form">
                    <form action="#" method="post"  id="VgdApplicnatInfoForm" enctype="multipart/form-data" class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group" >
                                    <div class="col-sm-8" >
                                        <div class="form-group">
                                            <label for="NID" class="col-sm-4 control-label"> <span></span></label>
                                            <div class="col-sm-6">
                                                <input type="text"  value="<?php echo (!empty($info->nid)?$info->nid:''); ?>" name="n_id" id="n_id"  class="form-control medium-font-inupt" placeholder="জাতীয় পরিচয় পত্র  নম্বর   প্রদান করূন"  />
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" name="n_id" onclick="verifyNIDInfo()" id="n_id"  class="btn btn-primary btn-md" > Search </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <select name="vgd_cricle" id="vgd_cricle" class="form-control medium-font-inupt fixed_test_valid"  >
                                            <option value="">ভিজিটি চক্র চিহ্নিত করূন</option>
                                            <?php
                                            if(!empty($AllCircleInfo)){
                                                foreach ($AllCircleInfo as $circle){
                                                    $selectCircle=((!empty($info->vgd_cricle) && $info->vgd_cricle==$circle->id)?"selected":'');
                                                    echo '<option value="'.$circle->id.'"'.$selectCircle.'  >'.$circle->title.'</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div >
                                    <div class=" col-sm-12" >
                                        <div class="col-sm-offset-2 col-sm-8">
                                            <div  style="min-height:30px;display:none;" id="successMessage">
                                                <div class="alert alert-success alert-sm" >
                                                    <strong id="successText"></strong>
                                                </div>
                                            </div>
                                            <div  style="min-height:30px;display:none;" id="errorMessage">
                                                <div class="alert alert-danger alert-sm" >
                                                    <strong id="errorText"></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class ="clearfix"></div>
                                <div class="form-group">
                                    <div class="col-sm-8" >
                                        <div class="form-group">
                                            <label for="cardNo" class="col-sm-4 control-label">ভিজিটি কার্ড নম্বর  <span>*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?php echo (!empty($info->vgd_card_no)?$info->vgd_card_no:''); ?>" name="cardNo" id="cardNo" class="form-control medium-font-inupt fixed_test_valid" placeholder="ভিজিটি কার্ড নম্বর প্রদান করূন"  >


                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Full Name" class="col-sm-4 control-label">ভিজিটি সদস্যের নাম  <span>*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?php echo (!empty($info->name)?$info->name:''); ?>" name="full_name" id="full_name" class="form-control medium-font-inupt fixed_test_valid" placeholder="ভিজিটি সদস্যের প্রদান করূন" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Husband Name" class="col-sm-4 control-label">পিতা/স্বামীর  <span>*</span></label>
                                            <div class="col-sm-3">
                                                <select name="guardina_type" id="guardina_type" class="form-control medium-font-inupt fixed_test_valid">
                                                    <option value="" style="" > চিহ্নিত করুন </option>
                                                    <option value="1" <?php echo ((!empty($info->guardian_type) && $info->guardian_type==1)?"selected":'') ?>> পিতা </option>
                                                    <option value="2" <?php echo ((!empty($info->guardian_type) && $info->guardian_type==2)?"selected":'') ?>>স্বামী</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-5">
                                                <div id="fatherInfo">
                                                    <input type="text" name="guardina_name" id="guardina_name" value="<?php echo (!empty($info->gurdian_name)?$info->gurdian_name:''); ?>" class="form-control medium-font-inupt fixed_test_valid"placeholder="পিতা/স্বামী নাম প্রদান করূন" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="motherName" class="col-sm-4 control-label">মাতার নাম  <span>*</span></label>
                                            <div class="col-sm-8">
                                                <input type='text' value="<?php echo (!empty($info->mother_name)?$info->mother_name:''); ?>" name='motherName' id='motherName' class="form-control medium-font-inupt fixed_test_valid" placeholder="মাতার নাম প্রদান করুন ।" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 text-center" id="img_div">
                                        <div class="clearfix"></div>
                                        <img src="<?php echo (file_exists($info->pic)?base_url($info->pic):base_url('img/default/default.jpg')) ?> " id="image" name="pic" class="img-thumbnail" style="height:160px;width:180px;margin-bottom:5px;" />
                                        <input type="file" name="image" onchange="loadFile(event)" id="img_id" class ="form-control">
                                        <input type="hidden" value="<?php echo (!empty($info->pic)?$info->pic:'') ?>" name="old_image" id="old_image">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row medium-font">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="village" class="col-sm-3 control-label">জম্ম তারিখ  <span>*</span></label>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <input type='text' value="<?php echo (!empty($info->date_of_birth)?date('d-m-Y',strtotime($info->date_of_birth)):''); ?>" name='dofb' id='dofb' class="form-control medium-font-inupt fixed_test_valid dateFormatDate" placeholder="01-01-1980 জম্ম তারিখ প্রদান করুন ।" />
                                        </div>
                                    </div>
                                    <label for="Member Age" class="col-sm-2 control-label">আবেদনকারী সদস্যের বয়স  <span>*</span></label>
                                    <div class="col-sm-3">
                                        <input type='text' value="<?php echo (!empty($info->age)?$info->age:''); ?>" name='age' id='age' class="form-control medium-font-inupt fixed_test_valid " placeholder="বয়স প্রদান করূন" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="village" class="col-sm-3 control-label">গ্রাম  <span>*</span></label>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <input type="text" value="<?php echo (!empty($info->village)?$info->village:''); ?>" name="village" id="village" class="form-control medium-font-inupt fixed_test_valid"placeholder="গ্রামের নাম প্রদান করূন" />
                                        </div>
                                    </div>
                                    <label for="Full Name" class="col-sm-2 control-label">ওয়ার্ড নং  <span>*</span></label>
                                    <div class="col-sm-3">
                                        <select name="wordNo" id="wordNo" class="form-control medium-font-inupt fixed_test_valid"  >
                                            <option value="">ওয়ার্ড নং চিহ্নিত করূন</option>
                                            <?php
                                            for($i=1;$i<=50;$i++){
                                                $selectWard=((!empty($info->wordNo) && $info->wordNo==$i)?"selected":'');
                                                echo '<option value="'.$i.'"'.$selectWard.'> ওয়ার্ড নং - '.$i.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Post Office" class="col-sm-3 control-label">ডাকঘর  <span>*</span></label>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <input type="text" name="post_office" id="post_office" value="<?php echo (!empty($info->post_office)?$info->post_office:''); ?>" class="form-control medium-font-inupt fixed_test_valid"placeholder="ডাকঘর  প্রদান করূন" />
                                        </div>
                                    </div>
                                    <label for="upazilas" class="col-sm-2 control-label">উপজেলা<span>*</span></label>
                                    <div class="col-sm-3">
                                        <input type="text" value="<?php echo (!empty($info->upazila)?$info->upazila:''); ?>" name="upazila" id="upazila" class="form-control medium-font-inupt fixed_test_valid"placeholder="উপজেলা প্রদান করূন" />
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="Full Name" class="col-sm-3 control-label">জেলা  <span>*</span></label>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <input type="text" value="<?php echo (!empty($info->district)?$info->district:''); ?>" name="district" id="district" class="form-control medium-font-inupt fixed_test_valid"placeholder="জেলা প্রদান করূন" />
                                        </div>
                                    </div>
                                    <label for="Mobile" class="col-sm-2 control-label">কার্ডধারীর মোবাইল    <span>*</span></label>
                                    <div class="col-sm-3">
                                        <input type="text" value="<?php echo (!empty($info->mobile_no)?$info->mobile_no:''); ?>"  name="mobile" id="mobile" class="form-control medium-font-inupt fixed_test_valid" placeholder="কার্ডধারীর মোবাইল নম্বর  প্রদান করূন" maxlength="11" />
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row medium-font">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="implementing_authority" class="col-sm-3 control-label">বাস্তবায়নকারী কর্তৃপক্ষের নাম <span>*</span></label>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <select name="implementing_authority" id="implementing_authority" class="form-control medium-font-inupt fixed_test_valid">
                                                <option value="" style="" >বাস্তবায়নকারী কর্তৃপক্ষের নাম সিলেক্ট করুন </option>
                                                <?php
                                                if(!empty($implementAuth)){
                                                    foreach ($implementAuth as $implementAuthority){
                                                        $selectAuth=((!empty($circleInfo->implement_authority) && $circleInfo->implement_authority==$implementAuthority->id)?"selected":'');
                                                        echo '<option value="'.$implementAuthority->id.'" '.$selectAuth.'  >'.$implementAuthority->name.'</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <label for="Mobile" class="col-sm-2 control-label"> পরিবারের সদস্য সংখ্যা    <span>*</span></label>
                                    <div class="col-sm-3">
                                        <input type="text" value="<?php echo (!empty($info->total_family_member)?$info->total_family_member:''); ?>"   name="total_family_member" id="total_family_member" class="form-control medium-font-inupt fixed_test_valid" placeholder="পরিবারের সদস্য সংখ্যা  প্রদান করূন" maxlength="11" />
                                    </div>



                                </div>
                            </div>
                        </div>

                        <div class="row medium-font">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="responsible_uno_info" class="col-sm-3 control-label">উপজেলা নির্বাহি অফিসারের নাম <span>*</span></label>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <select name="responsible_uno_info" id="responsible_uno_info" class="form-control medium-font-inupt fixed_test_valid">
                                                <option value="" style="" >উপজেলা নির্বাহি অফিসারের  নাম সিলেক্ট করুন </option>
                                                <?php
                                                if(!empty($responsibleUNO)){
                                                    foreach ($responsibleUNO as $uno){
                                                        $selectUNO=((!empty($info->responsible_uno_info) && $info->responsible_uno_info==$uno->id)?"selected":'');
                                                        echo '<option value="'.$uno->id.'"'.$selectUNO.'  >'.$uno->name.'</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <label for="responsible_officer" class="col-sm-2 control-label">দায়িত্বপ্রাপ্ত কর্মকর্তা    <span>*</span>
                                        <span>(মহিলা বিষয়ক কর্মকর্তা)</span>
                                    </label>
                                    <div class="col-sm-3">
                                        <select name="responsible_officer" id="responsibleOfficer" class="form-control medium-font-inupt fixed_test_valid">
                                            <option value="" style="" >দায়িত্বপ্রাপ্ত কর্মকর্তার নাম সিলেক্ট করুন </option>
                                            <?php
                                            if(!empty($responsibleOfficer)){
                                                foreach ($responsibleOfficer as $responsibleOfficers){
                                                    $selectResponsibleOfficer=((!empty($info->responsible_officer) && $info->responsible_officer==$responsibleOfficers->id)?"selected":'');

                                                    echo '<option value="'.$responsibleOfficers->id.'"'.$selectResponsibleOfficer.'  >'.$responsibleOfficers->name.'</option>';
                                                }
                                            }
                                            ?>
                                        </select>

                                    </div>



                                </div>
                            </div>
                        </div>
                        <div class="row medium-font">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="issueingDate" class="col-sm-3 control-label">কার্ড ইস্যুর তারিখ <span>*</span></label>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <input type='text' name='cardIssueDt' id='cardIssueDt' class="form-control medium-font-inupt fixed_test_valid dateFormatDate" value="<?php echo ((!empty($info->card_issue_dt))?date('d-m-Y',strtotime($info->card_issue_dt)):''); ?>" placeholder="কার্ড ইস্যুর তারিখ Exp: 01-01-1980" />
                                        </div>
                                    </div>
                                    <label for="cardDistributeDt" class="col-sm-2 control-label">কার্ড বিতরণের তারিখ  <span>*</span></label>
                                    <div class="col-sm-3">
                                        <input type='text' name='cardDistributeDt' id='cardDistributeDt' class="form-control medium-font-inupt fixed_test_valid dateFormatDate" value="<?php echo ((!empty($info->card_distributes_dt))?date('d-m-Y',strtotime($info->card_distributes_dt)):''); ?>"placeholder="বিতরণের তারিখ Exp: 01-01-1980" />
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row medium-font">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="Dealar Name" class="col-sm-3 control-label">Status <span>*</span></label>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <select name="status" id="status" class="form-control medium-font-inupt fixed_test_valid">
                                                <option value="" style="" > সিলেক্ট করুন </option>
                                                <option value="1" <?php echo ((!empty($info->is_active) && $info->is_active==1)?"selected":'' ) ?> > Active </option>
                                                <option value="2" <?php echo ((!empty($info->is_active) && $info->is_active==2)?"selected":'' ) ?> > In-Active </option>
                                                <option value="3" <?php echo ((!empty($info->is_active) && $info->is_active==3)?"selected":'' ) ?> > Expired (মেয়াদ উত্তীর্ন) </option>


                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-offset-3 col-sm-2">
                                <input type="hidden" id="updateID" name="updateID" value="<?php echo (!empty($info->id)?$info->id:'') ?>">
                                <input type="hidden" id="is_verify" name="is_verify" value="1">
                                <input type="hidden" id="api_data" name="api_data" >
                                <input type="hidden" id="vgd_applicant_info" name="vgd_applicant_info" value='yes' >
                                <button type='submit' id="submitBtn" name='vgd_applicant_info' class="btn btn-success btn-md"><i class="glyphicon glyphicon-ok-sign"></i> আপডেট করুন</button>
                            </div>
                            <div class="col-sm-6 pull-left">
                                <span id="error_output" style="font-size:18px;font-family:comicsans-ms;color:red;"></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!--  panel primary----->
        </div>
    </div><!-- row end--->
</div><!--/#content.col-md-0-->


