
		<script type="text/javascript"> 
			$(document).ready(function() {
				$('#example').DataTable();
			});
			function delete_function(){
				return confirm('Are you sure delete this?');
			}
		</script>
		<div class="row" style="margin-top: 30px;"> 
			<div class="col-lg-8 col-sm-8"> 
				<h3>প্রতিবন্ধী ভাতা প্রাপ্তদের তালিকা </h3>
			</div>
			<div class="col-lg-4 col-sm-4 pull-right" style="padding-top: 15px;"> 
				<a href="Manage/addAutistic">
					<button type="button" class="btn-success btn-sm pull-right">নতুন যোগ করুন</button>
				</a>
			</div>
		</div>
		<div style="padding:4px;width:100%;font-family:tahoma;">
			<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

				<thead>
					<tr>
						<th>ক্রমিক নং</th>
						<th>ন্যাশনাল আইডি </th>
						<th>নাম</th>
						<th>পিতা/স্বামীর নাম</th>
						<th>গ্রাম</th>
						<th>ওয়ার্ড নং</th>
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
						<td><?php echo $nr;?></td>
						<td><?php echo @$value->national_id;?></td>
						<td><?php echo @$value->bangla_name;?></td>
						<td><?php echo @$value->father_name;?></td>
						<td><?php echo @$value->gram ?></td>
						<td><?php echo @$value->word_no; ?></td>
						<td><?php echo @$value->mobile ?></td>
						<td>
							<!--<a href="<?php echo base_url('Manage/editOldmanstipend').'/'.md5($value->id);?>" data-toggle="tooltip" title="Edit" class="btn btn-primary btn-sm">
								<i class="glyphicon glyphicon-pencil" style="font-size: 10px"></i>
							</a> &nbsp;-->
							<a onclick="return delete_function();" href="<?php echo base_url('Manage/autisticDelete').'/'.$value->aid;?>" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-sm">
								<i class="glyphicon glyphicon-trash" style="font-size: 10px" ></i>
							</a>
						</td>
					</tr>
					<?php $nr++; endforeach;?>	
				</tbody>
			</table>
		</div>	