<div id="content" class="col-lg-10 col-sm-10">
	<script type="text/javascript"> 
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
	<div class="row"> 
		<div class="col-lg-12 col-sm-12 col-xs-12">
			<button class="btn btn-custom-head btn-block btn-sm " style="font-size:16px;margin-bottom:20px;"> নবায়নের  জন্য আবেদনকারীগণ  </button>
			
		</div>
	</div>
	
	<div style="padding:4px;width:100%;">
		<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
		
			<thead>
				<tr style="font-size: 13px !important; font-family: SolaimanLipi;font-style: normal;">
					<th>ছবি</th>
					<th>প্রতিষ্ঠানের নাম</th>
					<th>ট্র্যাকিং নং</th>
					<th>সনদ নং</th>
					<th>সরবরাহের ধরণ </th>
					<th>মোবাইল</th>
					<th>মেয়াদ উত্তীর্ণ তারিখ</th>
					<th>আবেদনের তারিখ</th>
					<th>অ্যকশন</th>
				</tr>
			</thead>
			
			<tbody>
			<?php foreach($query as $row): ?>
				<tr style="font-size: 13px !important; font-family: SolaimanLipi;font-style: normal;">
					<td>
						<img src="<?php if($row->profile !=''): echo $row->profile; else: echo "default.jpg";endif;?>" height='40' width='45'/>
					</td>
					<td style="white-space:normal;">
						<a href="Update/tradelicenseInfo?id=<?php echo md5($row->id)?>" <?php $this->chk->acl('tradelicenseInfo'); ?>><?php echo $row->bcomname?></a>
					</td>
					<td>
						<?php echo $row->trackid?>
					</td>
					
						<td>
							<?php echo $row->sno?>
						</td>
					
					<td>
						<?php 
						if($row->dtype==1) $dtype="জরুরী"; 
						if($row->dtype==2) $dtype="অতি জরুরী"; 
						if($row->dtype==3) $dtype="সাধারন"; echo $dtype;
						?>
					</td>
					<td>
						<?php echo $row->mobile?>
					</td>
					<td style="white-space:normal;color: red;font-weight: bolder;">
						<?php echo date('d M, Y',strtotime($row->expire_date));?>
					</td>
					<td>
						<?php echo date('d M, Y',strtotime($row->renew_utime));?>
					</td>
					<td>
						<a href='index.php/RenewTradeLicense/RenewTradeLicenGenerate?id=<?php echo sha1($row->trackid)?>'  class="btn btn-success btn-sm">Re Genarate</a>
					</td>
					
				</tr>
			<?php 
				endforeach;
			?>	
			</tbody>
		</table>
	</div>
</div><!--/#content.col-md-0-->