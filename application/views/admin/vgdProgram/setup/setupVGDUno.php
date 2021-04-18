<script type="text/javascript" src="library/customize.js"></script>
<div id="content" class="col-lg-12 col-sm-12" style="margin-top:20px;">
    <div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="col-sm-8"><div class="row"> <?php echo (!empty($heading)?$heading:''); ?></div></div>
                <div class="col-sm-4">
                    <button type="button"  data-toggle="modal" onclick="addAuthorityInfo()" data-target="#responsibleUno" class="btn btn-success btn-xs pull-right"><i class="glyphicon glyphicon-plus"></i> নতুন যোগ করুন </button>

                </div>
                <div class="clearfix"></div>

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="exampleNew4" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="3%">S/L</th>
                            <th>নাম</th>
                            <th >পদবী</th>
                            <th >ঠিকানা</th>
                            <th >মোবাইল</th>
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
                                    <td><?php echo $row->name ?></td>
                                    <td><?php echo $row->designation ?></td>
                                    <td><?php echo $row->address ?></td>
                                    <td><?php echo $row->mobile ?></td>
                                    <td>
                                        <button type="button" data-toggle="modal"  data-target="#responsibleUno" onclick="editAuthorityInfoVGD('<?php echo $row->id  ?>')" name="update" class="btn btn-info btn-xs" title="Edit"><i class="glyphicon glyphicon-pencil"></i> Edit </button>
                                        <button type="button" name="delete" title="Delete" onclick="DeleteAuthorityInfo('<?php echo $row->id  ?>')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Delete</button>
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

<div class="modal fade" id="responsibleUno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form action="#" method="post"  id="authorityInfoForm" enctype="multipart/form-data" >
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name"> নাম</label>
                        <input type="text" class="form-control name" id="name" name="name"  placeholder="নাম">
                    </div>
                    <div class="form-group">
                        <label for="address"> পদবী</label>
                        <textarea class="form-control designation" name="designation" id="designation" placeholder="পদবী"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="address">ঠিকানা</label>
                        <textarea class="form-control address" name="address" id="address" placeholder="ঠিকানা"></textarea>
                    </div>


                    <div class="form-group">
                        <label for="mobile">মোবাইল নম্বর</label>
                        <input type="text" class="form-control mobile" name="mobile" id="mobile" placeholder="মোবাইল নম্বর">
                    </div>

                    <div class="form-group">
                        <label for="status">স্ট্যাটাস</label>
                        <select class="form-control status" id="status" name="status" >
                            <option value="">Select</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                    <input type="hidden" name="type" value="5">
                    <input type="hidden" name="submit_info" value="yes">
                    <input type="hidden" name="updateId" class="updateId" id="updateId">
                    <button type="button" onclick="updateAuthorityInfo()" class="btn btn-primary"><i class="glyphicon glyphicon-ok-circle"></i> <span class="saveBtnLevel"></span></button>
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



