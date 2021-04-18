<script type="text/javascript" src="library/customize.js"></script>
<div id="content" class="col-lg-12 col-sm-12" style="margin-top:20px;">
    <div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="col-sm-8"><div class="row"> <?php echo (!empty($heading)?$heading:''); ?></div></div>
                <div class="col-sm-4">
                    <button type="button"  data-toggle="modal" onclick="addFoodProgram()" data-target="#vgdMonthModal" class="btn btn-success btn-xs pull-right"><i class="glyphicon glyphicon-plus"></i> নতুন যোগ করুন </button>

                </div>
                <div class="clearfix"></div>

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="exampleNew1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="3%">S/L</th>
                            <th >ভিজিডি চক্র</th>
                            <th>মাসের নাম</th>
                            <th >স্ট্যাটাস</th>
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
                                    <td><?php echo (!empty($row->circle_title)?$row->circle_title:'') ?></td>
                                    <td><?php echo (!empty($row->title)?$row->title:'') ?></td>
                                    <td><?php echo ((!empty($row->is_active) && $row->is_active==1)?"Active":'Inactive'); ?></td>
                                    <td>
                                        <button type="button" data-toggle="modal"  data-target="#vgdMonthModal" onclick="editVgdMonth('<?php echo $row->id  ?>')" name="update" class="btn btn-info btn-xs" title="Edit"><i class="glyphicon glyphicon-pencil"></i> Edit </button>
                                        <button type="button" name="delete" title="Delete" onclick="DeleteFoodProgram('<?php echo $row->id  ?>')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Delete</button>
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
</div><!--/#content.col-md-0-->

<div class="modal fade" id="vgdMonthModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form action="FoodController/updateFoodProgram" method="post"  id="programInfoForm" enctype="multipart/form-data" >
                <div class="modal-body">
                    <div class="form-group">
                        <label for="person_amt">ভিজিডি চক্র</label>
                        <select class="form-control" name="vgdCircle" id="vgdCircle">
                            <option name="">চিহ্নিত করুন</option>
                            <?php
                            if(!empty($AllCircleInfo)){
                                foreach ($AllCircleInfo as $circle){
                                    echo '<option value="'.$circle->id.'"  >'.$circle->title.'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="programName">কর্মসূচির নাম</label>
                        <input type="text" name="programName"  class="form-control" id="programName"  placeholder="কর্মসূচির নাম">
                    </div>

                    <div class="form-group">
                        <label for="status">স্ট্যাটাস</label>
                        <select class="form-control" name="status" id="status" >
                            <option value="">Select</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" onclick="updateFoodProgram()" class="btn btn-primary"><i class="glyphicon glyphicon-ok-circle"></i> <span id="saveBtnLevel"></span></button>
                    <input type="hidden" name="submit_info" value="yes">
                    <input type="hidden" name="updateId"  id="updateId">
                    <input type="hidden" name="program_type"  id="program_type" value="2">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="output_error"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>