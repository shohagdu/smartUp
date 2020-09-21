<div id="content" class="col-lg-10 col-sm-10">
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
	<div  class="row box" style="min-height:1000px;">
		<!-- Form -->
		<div class="col-lg-12 col-sm-12">
			<ul class="nav nav-tabs" id="myTab">
				<li class="active">
					<a data-toggle="tab" href="#voter" onclick="loadContent('Manage/voter_tab')">ভোটার তালিকা </a>
				</li>
				
				<li>
					<a data-toggle="tab" href="#fighter" onclick="loadContent('Manage/fighter_tab')">মুক্তিযোদ্ধাদের তালিকা </a>
				</li>
				<li>
					<a data-toggle="tab" href="#poorman" onclick="loadContent('Manage/poorman_tab')">দুস্থদের তালিকা </a>
				</li>
				<li>
					<a data-toggle="tab" href="#widow" onclick="loadContent('Manage/widow_tab')">বিধবাদের তালিকা </a>
				</li>
				<li>
					<a data-toggle="tab" href="#foreignMan" onclick="loadContent('Manage/foreignMan_tab')">প্রবাসীদের তালিকা </a>
				</li>
				<li>
					<a data-toggle="tab" href="#oldmanstipend" onclick="loadContent('Manage/oldmanstipend_tab')">বয়স্ক ভাতা </a>
				</li>
				<li>
					<a data-toggle="tab" href="#motherVata" onclick="loadContent('Manage/motherVata_tab')">মাতৃত্বকালীন ভাতা </a>
				</li>
				<li>
					<a data-toggle="tab" href="#autistic" onclick="loadContent('Manage/autistic_tab')">প্রতিবন্ধী ভাতা</a>
				</li>
				<li>
					<a data-toggle="tab" href="#autisticStudend" onclick="loadContent('Manage/autisticStudend_tab')">প্রতিবন্ধী ছাত্র/ছাত্রী</a>
				</li>
				
			</ul>

			<div class="tab-content" id="maincontent" style="">
				<div id="home" class="tab-pane fade in active">
					<div class="row" style="margin-top: 30px;"> 
						<div class="col-lg-8 col-sm-8"> 
							<h3>ভোটারদের তালিকা</h3>
						</div>
						<div class="col-lg-4 col-sm-4 pull-right" style="padding-top: 15px;"> 
							<a href="Manage/addVoter">
								<button type="button" class="btn-success btn-sm pull-right">নতুন যোগ করুন</button>
							</a>
						</div>
					</div>
					<div style="padding:4px;width:100%;">
						<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

							<thead>
								<tr>
									<th>ক্রমিক নং</th>
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
									<td><?php echo $nr;?></td>
									<td>
										<img src="<?php echo $value->pic;?>" height='40' width='45' class="img-thumbnail" />
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
				</div>
			</div>
		</div>
	</div>
</div><!--/#content.col-md-0-->