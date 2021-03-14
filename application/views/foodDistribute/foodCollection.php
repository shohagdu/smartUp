<div id="content" class="col-lg-10 col-sm-10">
    <div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="col-sm-8"><div class="row"> <?php echo (!empty($title)?$title:''); ?></div></div>
                <div class="col-sm-4">
                    <button type="button"  data-toggle="modal" onclick="addFoodReceiveInfo()" data-target="#exampleModal" class="btn btn-success btn-xs pull-right"><i class="glyphicon glyphicon-plus"></i> নতুন যোগ করুন </button>

                </div>
                <div class="clearfix"></div>

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <form action="#" method="post"  id="searchingReceivedFoodForm"  class="form-horizontal" >
                        <div class="form-group">
                            <div class="col-sm-4">
                               <select name="dealerId"  class="form-control" id="dealerId">
                                   <option name="">Select Dealer</option>
                                   <?php
                                    if(!empty($dealerInfo)){
                                        foreach ($dealerInfo as $dealers){
                                            echo "<option value='$dealers->id'>$dealers->name</option>";
                                        }

                                    }
                                   ?>
                               </select>
                            </div>
                            <div class="col-sm-4">
                               <button class="btn btn-primary btn-md" onclick="searchingReceivedFood()" type="button" ><i class="glyphicon glyphicon-search"></i> Search</button>
                            </div>

                        </div>
                    </form>
                    <div id="show_result">
                        <table id="exampleNew" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="3%">S/L</th>
                                <th>Name</th>
                                <th nowrap="">Card No</th>
                                <th >NID</th>
                                <th >Mobile</th>
                                <th >Received Food</th>
                                <th >Dealer Name</th>
                                <th >Dealer Mobile</th>
                                <th >Receive Date</th>
                                <th width="15%">#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
                            if($record['status']=='success'){
                                foreach ($record['data'] as $row){
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row->name ?></td>
                                        <td><?php echo $row->card_no ?></td>
                                        <td><?php echo $row->nid ?></td>
                                        <td><?php echo $row->applicant_mobile ?></td>
                                        <td><?php echo $row->food_amount; echo (!empty($row->unit_id) && ($row->unit_id==1)?' Kg':'') ?></td>
                                        <td><?php echo $row->dealer_name ?></td>
                                        <td><?php echo $row->dealer_mobile ?></td>
                                        <td><?php echo (!empty($row->receive_dt)?date('d M, Y',strtotime($row->receive_dt)):'') ?></td>
                                        <td>
                                            <button type="button" data-toggle="modal"  data-target="#exampleModal" onclick="editFoodCollectionInfo('<?php echo $row->id  ?>')" name="update" class="btn btn-info btn-xs" title="Edit"><i class="glyphicon glyphicon-pencil"></i> Edit </button>
                                            <button type="button" name="delete" title="Delete" onclick="DeleteFoodCollectionInfo('<?php echo $row->id  ?>')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Delete</button>
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
</div><!--/#content.col-md-0-->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

            <form action="#" method="post"  id="foodCollectionForm" enctype="multipart/form-data" >
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">আবেদনকারীর নাম</label>
                        <input type="text" class="form-control" id="foodApplicantNameLabel" name="foodApplicantNameLabel"  placeholder="আবেদনকারীর নাম">
                        <input type="hidden" class="form-control" id="foodApplicantName" name="foodApplicantName"  >
                    </div>
                    <div class="form-group">
                        <label for="address">তারিখ</label>
                        <input type='text' name='collectionDt' id='collectionDt' class="form-control medium-font-inupt fixed_test_valid dateFormatDate" autocomplete="off" value="<?php date('d-m-Y') ?>" placeholder="কার্ড ইস্যুর তারিখ Exp: 01-01-1980" />
                    </div>

                    <div class="form-group" id="statuDiv">
                        <label for="status">স্ট্যাটাস</label>
                        <select class="form-control" id="status" name="status" >
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                    <input type="hidden" name="type" value="1">
                    <input type="hidden" name="submit_info" value="yes">
                    <input type="hidden" name="updateId" id="updateId">
                    <button type="button" onclick="updateFoodCollectionInfo()" class="btn btn-primary"><i class="glyphicon glyphicon-ok-circle"></i> <span id="saveBtnLevel"></span></button>
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
<style>
    .ui-autocomplete { z-index:2147483647; }
</style>


