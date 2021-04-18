<script type="text/javascript" src="library/customize.js"></script>
<div id="content" class="col-lg-12 col-sm-12" style="margin-top:20px;">
    <div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="col-sm-8"><div class="row"> <?php echo (!empty($heading)?$heading:''); ?></div></div>
                <div class="col-sm-4">
                    <button type="button"  data-toggle="modal" onclick="addVGDCircleInfo()" data-target="#vgdCircleModal" class="btn btn-success btn-xs pull-right"><i class="glyphicon glyphicon-plus"></i> নতুন যোগ করুন </button>

                </div>
                <div class="clearfix"></div>

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="exampleNew" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="3%">S/L</th>
                            <th>ভিজিডি  চক্রের নাম</th>
                            <th >তালিকাভুক্তির তারিখ</th>
                            <th >কার্ড বিতরণের তারিখ </th>
                            <th >ধরন</th>
                            <th width="15%">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                        if(!empty($record)){
                            foreach ($record as $row){
                                ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row->title ?></td>
                                    <td><?php echo (!empty($row->issue_dt)?date('d-m-Y',strtotime($row->issue_dt)):'') ?></td>
                                    <td><?php echo (!empty($row->distributes_dt)?date('d-m-Y',strtotime($row->distributes_dt)):'') ?></td>
                                    <td><?php echo ($row->food_type==1)?"চাল":"অন্যান্য"; ?></td>
                                    <td>
                                        <button type="button" data-toggle="modal"  data-target="#vgdCircleModal" onclick="editVGDcircleInfo('<?php echo $row->id  ?>')" name="update" class="btn btn-info btn-xs" title="Edit"><i class="glyphicon glyphicon-pencil"></i> Edit </button>

                                        <button type="button" name="delete" title="Delete" onclick="DeleteVGDcircleInfo('<?php echo $row->id  ?>')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Delete</button>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="vgdCircleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-sm-8">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo (!empty($add_title)?$add_title:'') ?></h5>
                </div>
                <div class="col-sm-4">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="vgdCircleForm" autocomplete="off"  >
                    <div class="form-group">
                        <label class="control-label" style="text-align:right;">ভিজিডি চক্রের নাম  <span class="red-color">*</span></label>
                        <input type="text" name="name" id="name" placeholder="ভিজিডি চক্রের নাম প্রদান করুন" class="form-control">

                    </div>
                    <div class="form-group">
                        <label class="control-label" for="" style="text-align:right">উপকারভোগী তালিকাভুক্তির তারিখ <span class="red-color">*</span></label>
                        <input type="text" name="cardIssueDt" placeholder="উপকারভোগী তালিকাভুক্তির তারিখ" id="cardIssueDt" class="form-control dateFormatDate">

                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="" style="text-align:right">ভিজিডি কার্ড বিতরণের তারিখ <span class="red-color">*</span></label>

                            <input type="text" name="cardDistributesDt" placeholder="ভিজিডি কার্ড বিতরণের তারিখ" id="cardDistributesDt" class="form-control dateFormatDate">
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="" style="text-align:right">খাদ্যের ধরন <span class="red-color">*</span></label>

                            <select name="foodType" id="foodType" class="form-control">
                                <option value="">চিহ্নিত করুন</option>
                                <option value="1">চাল</option>
                                <option value="2">অন্যান্য</option>
                            </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="" style="text-align:right">বাস্তবায়নকারী কর্তৃপক্ষ
                            <span class="red-color">*</span></label>
                            <select name="implementing_authority" id="implementing_authority" class="form-control medium-font-inupt fixed_test_valid">
                                <option value="" style="" >বাস্তবায়নকারী কর্তৃপক্ষের নাম সিলেক্ট করুন </option>
                                <?php
                                if(!empty($implementAuth)){
                                    foreach ($implementAuth as $implementAuthority){
                                        echo '<option value="'.$implementAuthority->id.'"   >'.$implementAuthority->name.'</option>';
                                    }
                                }
                                ?>
                            </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="" style="text-align:right">দায়িত্বপ্রাপ্ত কর্মকর্তা * <br/>(মহিলা বিষয়ক কর্মকর্তা) <span class="red-color">*</span></label>
                            <select name="responsible_officer" id="responsibleOfficer" class="form-control medium-font-inupt fixed_test_valid">
                                <option value="" style="" >দায়িত্বপ্রাপ্ত কর্মকর্তার নাম সিলেক্ট করুন </option>
                                <?php
                                if(!empty($responsibleOfficer)){
                                    foreach ($responsibleOfficer as $responsibleOfficers){

                                        echo '<option value="'.$responsibleOfficers->id.'" >'.$responsibleOfficers->name.'</option>';
                                    }
                                }
                                ?>
                            </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="" style="text-align:right">উপজেলা নির্বাহি অফিসারের নাম<span class="red-color">*</span></label>

                            <select name="responsible_uno_info" id="responsible_uno_info" class="form-control medium-font-inupt fixed_test_valid">
                                <option value="" style="" >উপজেলা নির্বাহি অফিসারের  নাম সিলেক্ট করুন </option>
                                <?php
                                if(!empty($responsibleUNO)){
                                    foreach ($responsibleUNO as $uno){
                                        echo '<option value="'.$uno->id.'"  >'.$uno->name.'</option>';
                                    }
                                }
                                ?>
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="status">স্ট্যাটাস</label>
                        <select class="form-control" id="statusVGD" name="status" >
                            <option value="">Select</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-6 col-xs-6">
                            <input type="hidden" name="updateId" id="updateIdVGD">
                            <input type="hidden" name="submit_info" id="submit_info" value="yes">
                            <button type="button" onclick="updateVGDCircleInfo()" name="submitBtn" value="" class="btn btn-info btn-md"><i class="glyphicon glyphicon-ok-circle"></i>  <span id="saveBtnLevelCircle"></span> </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <div id="output_error"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>