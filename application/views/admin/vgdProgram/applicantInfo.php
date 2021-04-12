<div id="content" class="col-lg-10 col-sm-10">
    <div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="col-sm-8"><div class="row"> <?php echo (!empty($title)?$title:''); ?></div></div>
                <div class="col-sm-4">
                    <a href="<?php echo base_url('VgdController/addNewMember') ?>" class="btn btn-success btn-xs pull-right"><i class="glyphicon glyphicon-plus"></i> নতুন যোগ করুন </a>

                </div>
                <div class="clearfix"></div>

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <div class="clearfix"></div>
                    <table id="vgd_applicant_data" class="table table-bordered table-striped">
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
                            <th width="12%">Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><!--/#content.col-md-0-->



