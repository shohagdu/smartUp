	<?php
		$uid = $this->session->userdata("id");
		$udata =array("id" => $uid);
		$rid = $this->db->get_where("admin",$udata)->row();
	?>
	
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
			<button class="btn btn-custom-head btn-block btn-sm " style="font-size:16px;margin-bottom:20px;">কর্মচারী ও কর্মকর্তাগণের তালিকা</button>
		</div>
	</div>
	<div class="row" style="margin-bottom: 10px;"> 
		<div class="col-sm-3 pull-right"> 
			<a href="Manage/employeeManage" <?php $this->chk->acl('employeeManage'); ?>>
				<button type="button" class="btn-success btn-sm pull-right">কর্মকর্তার ব্যবস্থাপনা</button>
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
					<th>মোবাইল</th>
					<th>ই-মেইল</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$num=1;
					foreach($row as $value):
					$user_name=$value->username;
					if($user_name!='abs_rana'):
				?>
				<tr>
					<td><?php echo $num++;?></td>
					<td><?php echo $value->fullname;?></td>
					<td><?php echo $value->desig; ?></td>
					<td><?php echo $value->mobile ?></td>
					<td><?php echo $value->email;?></td>
					<td>
						<a <?php if($rid->role_id != 1):echo "style='cursor:no-drop;'";else:if($value->role_id==1){echo "style='cursor:no-drop;'";}else{?> href='Manage/employeeManageUpdate?id=<?php echo md5($value->id);?>'<?php }endif; ?> >
							<button type="button" <?php if($rid->role_id != 1):echo "disabled";elseif($value->role_id==1):echo "disabled";endif;?> name="button" class="btn  btn-info btn-sm" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil" style="font-size: 10px"></i></button>
						</a> 
							
						</a> &nbsp;

						<a <?php if($rid->role_id != 1):echo "style='cursor:no-drop;'";else:if($value->role_id==1){echo "style='cursor:no-drop;'";}else {?> href="Manage/employeeDelete/<?php echo $value->id?>" <?php } endif;?>>
							<button type="submit"  <?php if($rid->role_id != 1):echo "disabled";elseif($value->role_id==1):echo "disabled";else:echo "name=\"del\" onclick=\"return delete_function();\"";endif; ?> class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash" style="font-size: 10px" ></i></button>
						</a>

					</td>
				</tr>
				<?php endif;endforeach;?>
			</tbody>
		</table>
	</div>
</div><!--/#content.col-md-0-->
<style type="text/css"> 
	a:hover{
		text-decoration: none;
	}
</style>