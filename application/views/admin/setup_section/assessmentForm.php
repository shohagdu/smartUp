<div id="content" class="col-lg-10 col-sm-10">
	<div class="panel panel-default">
		<div class="panel-heading">এ্যাসেসমেন্ট  ফরম</div>
		<div class="panel-body">			
			<div class="col-lg-12 col-sm-12"> 
				<script type="text/javascript"> 
					$(document).ready(function() {
						$('#example').DataTable( {
							"lengthMenu": [[ 100,200, -1], [ 100,200, "All"]]
						} );
					} );
				</script>
				<div style="padding:4px;width:100%;font-family:tahoma;" class="table-responsive">
					
					<table id="example" class="table table-striped table-bordered  nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>  
								<th width="20">ক্র.নং</th>
								<th>মালিকের নাম</th>
								<th>হোল্ডিং নম্বর</th>
								<th>দাগ নম্বর</th>
								<th>ওয়ার্ড নং</th>
								<th>বসতভিটার ধরন - পেশা - করের শ্রেনী</th>	    
								<th>ধার্যকৃত কর</th>	    
								<th>অ্যকশন</th>	    
								
							</tr>
						</thead>
						<tbody>
							<?php 
								$nr1=1;
								if($list_of_holding_tax['status'] === 'success'):
									foreach ($list_of_holding_tax['data'] as $row):
										?>
										<tr>
											<td><?php echo $nr1++; ?></td>
											<td><?php echo $row->name; ?></td>
											<td><?php echo $row->holding_no; ?></td>
											<td><?php echo $row->dag_no; ?></td>
											<td><?php echo $row->wordno; ?></td>
											<td><?php echo $row->rate_sheet_label; ?></td>
											<td><?php echo $row->amount; ?></td>
											<td>
												<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="modelStatus('<?php echo md5($row->rid); ?>')" data-target="#modelStatus" ><i class="glyphicon glyphicon-pencil"></i></button>
											</td>
										</tr>
										<?php
									endforeach;
								endif;
							?>
						</tbody>
					</table>
				</div>
			</div>
		<!--- end bank transer list -------->
		</div> <!-- /row box -->
	</div>
</div>