
<div id="content" class="col-lg-10 col-sm-10">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="col-sm-8"><div class="row"> <?php echo (!empty($title)?$title:''); ?></div></div>
                    <div class="col-sm-4">
                        <a href="FoodController" class="btn-success btn-xs pull-right"><i class="glyphicon glyphicon-list-alt"></i> তালিকা সমূহ
                        </a>

                    </div>
                    <div class="clearfix"></div>

                </div>
                <div class="panel-body all-input-form">
                    <form action="FoodController/newApplicantInfoAction" method="post"  id="foodApplicnatInfoForm" enctype="multipart/form-data" class="form-horizontal">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group" >
                                    <div class="col-sm-8" >
                                        <div class="form-group">
                                            <label for="NID" class="col-sm-4 control-label"> <span></span></label>
                                            <div class="col-sm-6">
                                                <input type="text"  name="n_id" id="n_id"  class="form-control medium-font-inupt" placeholder="জাতীয় পরিচয় পত্র  নম্বর   প্রদান করূন"  />
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" name="n_id" onclick="verifyNIDInfo()" id="n_id"  class="btn btn-primary btn-md" > Search </button>
                                            </div>
                                        </div>
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
                                            <label for="cardNo" class="col-sm-4 control-label">কার্ড নম্বর  <span>*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="cardNo" id="cardNo" class="form-control medium-font-inupt fixed_test_valid" placeholder="কার্ড নম্বর প্রদান করূন"  >


                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Full Name" class="col-sm-4 control-label">কার্ডধারীর নাম  <span>*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="full_name" id="full_name" class="form-control medium-font-inupt fixed_test_valid" placeholder="নাম প্রদান করূন" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Husband Name" class="col-sm-4 control-label">পিতা/স্বামীর  <span>*</span></label>
                                            <div class="col-sm-3">
                                                <select name="guardina_type" id="guardina_type" class="form-control medium-font-inupt fixed_test_valid">
                                                    <option value="" style="" > চিহ্নিত করুন </option>
                                                    <option value="1"> পিতা </option>
                                                    <option value="2">স্বামী</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-5">
                                                <div id="fatherInfo">
                                                    <input type="text" name="guardina_name" id="guardina_name" class="form-control medium-font-inupt fixed_test_valid"placeholder="পিতা নাম প্রদান করূন" />
                                                </div>
                                                <div id="spouseInfo" style="display:none;">
                                                    <input type="text" name="spouse_name" id="spouse_name" class="form-control medium-font-inupt fixed_test_valid"placeholder="স্বামীর নাম প্রদান করূন" />
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="date of birth" class="col-sm-4 control-label">জম্ম তারিখ  <span>*</span></label>
                                            <div class="col-sm-8">
                                                <input type='text' name='dofb' id='dofb' class="form-control medium-font-inupt fixed_test_valid dateFormatDate" placeholder="01-01-1980 জম্ম তারিখ প্রদান করুন ।" />
                                            </div>
                                        </div>




                                    </div>
                                    <div class="col-sm-4 text-center" id="img_div">
                                        <img src="img/default/default.jpg" id="image" name="pic" class="img-thumbnail" style="height:160px;width:180px;margin-bottom:5px;" />
                                        <input type="file" name="image" onchange="loadFile(event)" id="img_id" class ="form-control">
                                        <input type="hidden" name="old_image" id="old_image">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row medium-font">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-11">
                                        <div class="form-group">
                                            <label for="village" class="col-sm-2 control-label">গ্রাম  <span>*</span></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="village" id="village" class="form-control medium-font-inupt fixed_test_valid"placeholder="গ্রামের নাম প্রদান করূন" />
                                            </div>
                                            <label for="Full Name" class="col-sm-2 control-label">ওয়ার্ড নং  <span>*</span></label>
                                            <div class="col-sm-4">
                                                <select name="wordNo" id="wordNo" class="form-control medium-font-inupt fixed_test_valid"  >
                                                    <option value="">ওয়ার্ড নং চিহ্নিত করূন</option>
                                                    <?php
                                                        for($i=1;$i<=50;$i++){
                                                            echo '<option value="'.$i.'"> ওয়ার্ড নং - '.$i.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="Post Office" class="col-sm-2 control-label">ডাকঘর  <span>*</span></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="post_office" id="post_office" class="form-control medium-font-inupt fixed_test_valid"placeholder="ডাকঘর  প্রদান করূন" />
                                            </div>
                                            <label for="upazilas" class="col-sm-2 control-label">উপজেলা<span>*</span></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="upazila" id="upazila" class="form-control medium-font-inupt fixed_test_valid"placeholder="উপজেলা প্রদান করূন" />
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="Full Name" class="col-sm-2 control-label">জেলা  <span>*</span></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="district" id="district" class="form-control medium-font-inupt fixed_test_valid"placeholder="জেলা প্রদান করূন" />
                                            </div>
                                            <label for="occupation" class="col-sm-2 control-label">পেশা  <span>*</span></label>
                                            <div class="col-sm-4">
                                                <select name="occupation" id="occupation" class="form-control medium-font-inupt fixed_test_valid"  >
                                                    <option value="">পেশা চিহ্নিত করূন</option>
                                                    <?php
                                                    if(!empty($occupation)){
                                                        foreach ($occupation as $occupa){
                                                            echo '<option value="'.$occupa->id.'"  >'.$occupa->title.'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row medium-font">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="Dealar Name" class="col-sm-3 control-label">ডিলারের নাম  <span>*</span></label>
                                    <div class="col-sm-4">
                                        <div class="row">

                                            <select name="dealer_name" id="dealer_name" class="form-control medium-font-inupt fixed_test_valid">
                                                <option value="" style="" >ডিলারের নাম সিলেক্ট করুন </option>
                                                <?php
                                                    if(!empty($dealers)){
                                                        foreach ($dealers as $dealer){
                                                            echo '<option value="'.$dealer->id.'"  >'.$dealer->name.'</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <label for="Mobile" class="col-sm-2 control-label">কার্ডধারীর মোবাইল    <span>*</span></label>
                                    <div class="col-sm-3">
                                        <input type="text" name="mobile" id="mobile" class="form-control medium-font-inupt fixed_test_valid" placeholder="কার্ডধারীর মোবাইল নম্বর  প্রদান করূন" maxlength="11" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="row medium-font">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="distibutorShopInfo" class="col-sm-3 control-label">খাদ্যশস্য সরবরাহের দোকানের নাম ও অবস্থান  <span>*</span></label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <textarea type="text" name="distibutorShopInfo" id="distibutorShopInfo" class="form-control  medium-font-inupt fixed_test_valid" placeholder="খাদ্যশস্য সরবরাহের দোকানের নাম ও অবস্থান" /></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        -->
                        <div class="row medium-font">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="issueingAuthority" class="col-sm-3 control-label">ইস্যুকারী কর্তৃপক্ষ <span>*</span></label>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <select name="issueingAuthority" id="issueingAuthority" class="form-control medium-font-inupt fixed_test_valid">
                                                <option value="" style="" >ইস্যুকারী কর্তৃপক্ষের নাম সিলেক্ট করুন </option>
                                                <?php
                                                if(!empty($issuing_authority)){
                                                    foreach ($issuing_authority as $authority){
                                                        echo '<option value="'.$authority->id.'"  >'.$authority->name.'</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <label for="cardIssueDt" class="col-sm-2 control-label">কার্ড ইস্যুর তারিখ  <span>*</span></label>
                                    <div class="col-sm-3">
                                        <input type='text' name='cardIssueDt' id='cardIssueDt' class="form-control medium-font-inupt fixed_test_valid dateFormatDate" placeholder="কার্ড ইস্যুর তারিখ Exp: 01-01-1980" />
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-offset-3 col-sm-2">
                                <input type="hidden" id="is_verify" name="is_verify" value="1">
                                <input type="hidden" id="api_data" name="api_data" >
                                <input type="hidden" id="food_applicant_info_submit" name="food_applicant_info_submit" value='yes' >
                                <button type='submit' id="submitBtn" name='food_applicant_info' class="btn btn-success btn-sm"><i class="glyphicon glyphicon-ok-sign"></i> যোগ করুন</button>
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


