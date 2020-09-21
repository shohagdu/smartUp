<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable();
	});
</script>


<div id="content" class="col-lg-10 col-sm-10">
	<div class="row"> 
		<div class="col-lg-12 col-sm-12 col-xs-12">
			<button class="btn btn-custom-head btn-block btn-sm " style="font-size:16px;margin-bottom:20px;">All User Role</button>
		</div>
	</div>

<?php
	$role = $this->db->get("acl")->result();
	$si = 0;
?>

	<div class="row" style="padding:4px;width:100%;">
		<div class="table-responsive">
			<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" id="example">
				<thead>
					<tr>
						<td>SI</td>
						<td>Role Name</td>
						<td>Create Date</td>
						<td>Action</td>
					</tr>
				</thead>
				<tbody>
				<?php foreach($role as $r):$si++; ?>
					<tr>
						<td><?php echo $si; ?></td>
						<td><?php echo $r->role_name ?></td>
						<td><?php echo $r->ins_date ?></td>
						<td>
							<a <?php if($r->role_id==1){echo "style='cursor:no-drop;'";}else{echo "href='role/roleUpdate/$r->id'";} ?> >
								<button type="button" <?php if($r->role_id==1){echo "disabled";}?> name="button" class="btn  btn-info btn-sm" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil" style="font-size: 10px"></i></button>
							</a> 
								
							</a> &nbsp;
							
							<a <?php if($rid->role_id != 1):echo "style='cursor:no-drop;'";else:if($value->role_id==1){echo "style='cursor:no-drop;'";}else {?> href="Manage/employeeDelete/<?php echo $value->id?>" <?php } endif;?>>
							
							<a <?php if($r->role_id==1){echo "style='cursor:no-drop;'";} else{?> href="role/roleDelete/<?php echo $r->id;?>"<?php }?>>
								<button type="submit"  <?php if($r->role_id==1){echo "disabled";}else{echo "name=\"del\" onclick=\"return confirm('Are you sure to delete this role ?');\"";} ?> class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash" style="font-size: 10px" ></i></button>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<style type="text/css"> 
	a:hover{
		text-decoration: none;
	}
</style>