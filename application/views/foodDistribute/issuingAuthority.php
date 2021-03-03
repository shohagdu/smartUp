<div id="content" class="col-lg-10 col-sm-10">
    <div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="col-sm-8"><div class="row"> <?php echo (!empty($title)?$title:''); ?></div></div>
                <div class="col-sm-4">
                    <button type="button"  data-toggle="modal" onclick="addAuthorityInfo()" data-target="#exampleModal" class="btn btn-success btn-xs pull-right"><i class="glyphicon glyphicon-plus"></i> নতুন যোগ করুন </button>

                </div>
                <div class="clearfix"></div>

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="exampleNew" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="3%">S/L</th>
                            <th>নাম</th>
                            <th >ঠিকানা  </th>
                            <th >মোবাইল</th>
                            <th >পদবি</th>

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
                                    <td><?php echo $row->address ?></td>
                                    <td><?php echo $row->mobile ?></td>
                                    <td><?php echo $row->designation ?></td>
                                    <td>
                                        <button type="button" data-toggle="modal"  data-target="#exampleModal" onclick="editAuthorityInfo('<?php echo $row->id  ?>')" name="update" class="btn btn-info btn-xs" title="Edit"><i class="glyphicon glyphicon-pencil"></i> Edit </button>
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
            <form action="#" method="post"  id="authorityInfoForm" enctype="multipart/form-data" >
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">ইস্যুকারীর নাম</label>
                        <input type="text" class="form-control" id="name" name="name"  placeholder="ইস্যুকারীর নাম">
                    </div>
                    <div class="form-group">
                        <label for="address">ঠিকানা</label>
                        <textarea class="form-control" name="address" id="address" placeholder="ঠিকানা"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="mobile">মোবাইল নম্বর</label>
                        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="মোবাইল নম্বর">
                    </div>
                    <div class="form-group">
                        <label for="designation">পদবি</label>
                        <input type="text" class="form-control" name="designation" id="designation" placeholder="পদবি">
                    </div>


                    <div class="form-group">
                        <label for="status">স্ট্যাটাস</label>
                        <select class="form-control" id="status" name="status" >
                            <option value="">Select</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                    <input type="hidden" name="type" value="2">
                    <input type="hidden" name="submit_info" value="yes">
                    <input type="hidden" name="updateId" id="updateId">
                    <button type="button" onclick="updateAuthorityInfo()" class="btn btn-primary"><i class="glyphicon glyphicon-ok-circle"></i> <span id="saveBtnLevel"></span></button>
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



