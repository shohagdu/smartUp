<div id="content" class="col-lg-10 col-sm-10">
    <div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="col-sm-8"><div class="row"> <?php echo (!empty($title)?$title:''); ?></div></div>
                <div class="col-sm-4">
                    <a href="<?php echo base_url('FoodController/newApplicantInfo') ?>" class="btn btn-success btn-xs pull-right"><i class="glyphicon glyphicon-plus"></i> নতুন যোগ করুন </a>

                </div>
                <div class="clearfix"></div>

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <div class="col-sm-12" style="margin-bottom:20px">
                        <div class="row" >
                            <div class="form-group" >
                                <div class="col-sm-4">
                                    <select  name="dealer_id" id="dealer_id"  class="form-control medium-font-inupt"  >
                                        <option value="">Select Dealer</option>
                                        <?php
                                        if(!empty($dealerInfo)){
                                            foreach ($dealerInfo as $dealers){
                                                echo "<option value='$dealers->id'>$dealers->name</option>";
                                            }

                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <table id="food_distribute_applicant_data" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="3%">S/L</th>
                            <th width="5%">Image</th>
                            <th width="10%">ID</th>
                            <th width="10%">Card No</th>
                            <th width="10%">NID</th>
                            <th width="15%">Name</th>
                            <th width="10%">Father name</th>
                            <th width="10%">Mobile</th>
                            <th width="10%">Dealer Name</th>
                            <th width="12%">Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><!--/#content.col-md-0-->



