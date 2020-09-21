
		<script type="text/javascript"> 
			$(document).ready(function() {
				$('#example').DataTable({
					"lengthMenu": [[50,100,200, -1], [50,100,200, "All"]]
				});
			});
			function delete_function(){
				return confirm('Are you sure delete this?');
			}
		</script>
		<script type="text/javascript">
			function toggle(source) {
				var n,i;
				var checkboxes1 = document.getElementsByName('itam[]');

				for(var i=0, n=checkboxes1.length;i<n;i++) {
					checkboxes1[i].checked = source.checked;
				}
			}
		</script>
		<div class="row" style="margin-top: 30px;"> 
			<div class="col-lg-8 col-sm-8"> 
				<h3> ভোটারদের তালিকা </h3>
			</div>
			<div class="col-lg-4 col-sm-4 pull-right" style="padding-top: 15px;"> 
				<a href="Manage/addVoter">
					<button type="button" class="btn-success btn-sm pull-right">নতুন যোগ করুন</button>
				</a>
			</div>
		</div>
		<div style="padding:4px;width:100%;font-family:tahoma;">
			<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

				<thead>
					<tr>
						<th> 
							<input type="checkbox" id="checkallrole"  onClick="toggle(this)" value="" name="checkall">
						</th>
						<th>নং</th>
						<th>ছবি</th>
						<th>ন্যাশনাল আইডি </th>
						<th>নাম</th>
						<th>পিতা/স্বামীর নাম</th>
						<th>জন্ম তারিখ</th>
						<th>গ্রাম</th>
						<th>মোবাইল</th>
						<th>Action</th>
					</tr>
				</thead>
				
				<tbody>
					<?php 
						$nr=1;
						foreach ($row as $value):
					?>
					<tr>
						<td><input type="checkbox"  value="<?php echo $value->id;?>" name="itam[]"></td>
						<td><?php echo $nr;?></td>
						<td>
							<img src="<?php echo $value->pic;?>" height='35' width='40' class="img-thumbnail"/>
						</td>
						<td><?php echo @$value->national_id;?></td>
						<td><?php echo @$value->bangla_name;?></td>
						<td><?php echo @$value->father_name;?></td>
						<td><?php echo @$value->date_of_birth;?></td>
						<td><?php echo @$value->gram; ?></td>
						<td><?php echo @$value->mobile ?></td>
						<td>
							<a href="<?php echo base_url('Manage/editVoter').'/'.md5($value->id);?>" data-toggle="tooltip" title="Edit" class="btn btn-primary btn-sm">
								<i class="glyphicon glyphicon-pencil" style="font-size: 10px"></i>
							</a> &nbsp;
							<a onclick="return delete_function();" href="<?php echo base_url('Manage/deleteVoter').'/'.$value->id;?>" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-sm">
								<i class="glyphicon glyphicon-trash" style="font-size: 10px" ></i>
							</a>
						</td>
					</tr>
					<?php $nr++; endforeach;?>	
				</tbody>
			</table>
		</div>	