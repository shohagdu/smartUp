<div id="content" class="col-lg-10 col-sm-10">
	<script type="text/javascript"> 
		$(document).ready(function() {
			$('#example').DataTable();
		} );
		function delete_function(){
			return confirm('Are you sure delete this?');
		}
	</script>
	<div class="row"> 
		<div class="col-lg-12 col-sm-12 col-xs-12">
			<button class="btn btn-custom-head btn-block btn-sm " style="font-size:16px;margin-bottom:20px;">ইউনিয়ন চেয়ারম্যান, মেম্বার ও কর্মচারীরদের তালিকা </button>
		</div>
	</div>
	<div class="row" style="margin-bottom: 10px;"> 
		<div class="col-sm-3 pull-right"> 
			<a href="Manage/webSiteUpMembterAdd" <?php $this->chk->acl('webSiteUpMembterAdd'); ?>>
				<button type="button" class="btn-success btn-sm pull-right">নতুন যোগ করুন</button>
			</a>
		</div>
	</div>
	<div style="padding:4px;width:100%;">
		<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

			<thead>
				<tr>
					<th>ক্রমিক নং</th>
					<th>নাম</th>
					<th>পদবী</th>
					<th>এরিয়া</th>
					<th>আসন নং</th>
					<th>Status</th>
					<th>মোবাইল</th>
					<th>ই-মেইল</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					// some execution here................
					$num=1;
					foreach($row as $value):
					
					// for designation .................
					$d=$value->designation;
					if($d==1){
						$dd = '<span style="color: #DF7401;font-weight:bolder;">ইউপি চেয়ারম্যান</span>';
					}
					else if($d==2){
						$dd='<span style="color: #FA8258;font-weight: bolder;"> সচিব </span>';
					}
					else if($d==3){
						$dd='<span style="color: #B18904; font-weight: bolder;">মেম্বার</span>';
					}
					else if($d==4){
						$dd='<span style="color: #FAAC58; font-weight: bolder;"> উদ্যোক্তা </span>';
					}
					else if($d==5){
						$dd='<span style="color: #8A4B08; font-weight: bolder;"> গ্রামপুলিশ </span>';
					}
					else {
						$dd=="";
					}
					// for status.............
					$aa=$value->status;
					if($aa==1){
						$aaa='<span style="color:green;font-weight:bold;">Active</span>';
					}
					else if($aa==0){
						$aaa='<span style="color:red;font-weight:bold;">Inactive</span>';
					}
				?>
				<tr>
					<td><?php echo $num++;?></td>
					<td style="white-space: normal;"><p><?php echo $value->full_name;?></p></td>
					<td><p><?php echo $dd;?></p></td>
					<td style="white-space: normal;"><p><?php echo $value->barea;?></p></td>
					<td><p style="color: #DF3A01; font-weight:bolder;"><?php echo $value->vno;?></p></td>
					<td><p><?php echo $aaa;?></p></td>
					<td><p><?php echo $value->mobile;?></p></td>
					<td><p><?php echo $value->email;?></p></td>
					<td>
						<a href="<?php echo base_url('Manage/webSiteUpMemberUpdate').'/'.$value->id;?>" <?php $this->chk->acl('webSiteUpMemberUpdate'); ?> data-toggle="tooltip" title="Edit" class="btn btn-primary btn-sm">
							<i class="glyphicon glyphicon-pencil" style="font-size: 10px"></i>
						</a> &nbsp;
						<a onclick="return delete_function();" <?php $this->chk->acl('webSiteUpMemberDelete'); ?> href="<?php echo base_url('Manage/webSiteUpMemberDelete').'/'.$value->id;?>" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-sm">
							<i class="glyphicon glyphicon-trash" style="font-size: 10px" ></i>
						</a>
					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div><!--/#content.col-md-0-->