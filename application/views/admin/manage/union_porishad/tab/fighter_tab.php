
		<script type="text/javascript"> 
			$(document).ready(function() {
				$('#example').DataTable();
			} );
			function delete_function(){
				return confirm('Are you sure delete this?');
			}
		</script>
		<div class="row" style="margin-top: 30px;"> 
			<div class="col-lg-8 col-sm-8"> 
				<h3>মুক্তিযোদ্ধাদের তালিকা </h3>
			</div>
			<div class="col-lg-4 col-sm-4 pull-right" style="padding-top: 15px;"> 
				<a href="Manage/addFighter">
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
						<th>সেক্টর</th>
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
						<td><?php echo @$value->sector_no; ?></td>
						<td>
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#upDateFighter" onclick=" modal_show('<?php echo $value->national_id?>');" >
								<i class="glyphicon glyphicon-pencil" style="font-size: 10px"></i>
							</button>
							<a onclick="return delete_function();" href="<?php echo base_url('Manage/fighterDelete').'/'.$value->fid;?>" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-sm">
								<i class="glyphicon glyphicon-trash" style="font-size: 10px" ></i>
							</a>
						</td>
					</tr>
					<?php $nr++; endforeach;?>	
				</tbody>
			</table>
		</div>
		
		<div class="modal fade" id="upDateFighter" role="dialog">
			<div class="modal-dialog"  style="width: 70%;">
				<div class="modal-content" style="padding-bottom:50px;" id="modal_show_page">
				
				</div>
			</div>
		</div>
		
		<script type="text/javascript"> 
			function modal_show(nid){
				//alert(nid);
				$("#modal_show_page").css("height","600px");
				$("#modal_show_page").empty().append('<p align="center" style="margin-top:20%"><img src="library/ajax-loader.gif"></p>');
				
				url='manage/modalShow?national_id='+nid;
				$("#modal_show_page").load(url);
			}
		</script>