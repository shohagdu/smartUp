
		<script type="text/javascript"> 
			$(document).ready(function() {
				$('#example').DataTable();
			} );
			$(function() {
				$("#dofb").datepicker({ dateFormat: 'yy-mm-dd' });
			});
		</script>
		
		<div style="padding:4px;width:100%;">
			<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

				<thead>
					<tr style="font-size: 13px !important; font-family: SolaimanLipi;font-style: normal;">
						<th>ছবি</th>
						<th>নাম</th>
						<th>ট্র্যাকিং নং</th>
						<?php if($_GET['napply']=='5'):?>
							<th>সনদ নং</th>
						<?php endif;?>
						<th>সরবরাহের ধরণ </th>
						<th>মোবাইল</th>
						
						<?php if($_GET['napply']=='new'):?>
							<th>আবেদনের তারিখ</th>
						<?php endif;?>
						<?php if($_GET['napply']=='5'):?>
							<th>জেনারেট তারিখ</th>
						<?php endif;?>
						<th>সার্টিফিকেট</th>
						<?php if($_GET['napply']=='5'):?>
							<th>মানি রিসিট</th>
						<?php endif;?>
					</tr>
				</thead>
				
				<tbody>
					<?php 
						//print_r($query);
						foreach($query as $row):
					?>
					<tr style="font-size: 13px !important; font-family: SolaimanLipi;font-style: normal;">
						<td>
							<img src="<?php if($row->profile !=''): echo $row->profile; else: echo "default.jpg";endif;?>" height='40' width='45'/>
						</td>
						<td style="white-space:normal;">
							<a href="Update/nagorickInfo?id=<?php echo md5($row->id)?>" <?php $this->chk->acl('nagorickInfo'); ?> target=""><?php echo $row->name?></a>
						</td>
						<td>
							<a href="Update/nagorickInfo?id=<?php echo md5($row->id)?>" <?php $this->chk->acl('nagorickInfo'); ?> target=""><?php echo $row->trackid?></a>
						</td>
						<?php if($_GET['napply']=='5'):?>
							<td>
								<?php echo $row->sonodno?>
							</td>
						<?php endif;?>
						<td>
							<?php 
							if($row->delivery_type==1) $dtype="জরুরী"; 
							if($row->delivery_type==2) $dtype="অতি জরুরী"; 
							if($row->delivery_type==3) $dtype="সাধারন"; echo $dtype;
							?>
						</td>
						<td>
							<?php echo @$row->mobile?>
						</td>
						<td>
							<?php echo date('d M, Y',strtotime($row->insert_time))?>
						</td>
						<td>
							<?php if($this->applicant->exPrintPori($row->trackid)=='Print'){?>
						
								<a href='Certificate/nagorickBangla?id=<?php echo sha1($row->trackid)?>' <?php $this->chk->acl('nagorickBangla'); ?> target='_blank'  class="btn btn-primary btn-sm">বাংলা</a>
								<a href='Certificate/nagorickEnglish?id=<?php echo sha1($row->trackid)?>' <?php $this->chk->acl('nagorickEnglish'); ?> target='_blank'  class="btn btn-info btn-sm">ইংরেজী</a>
							<?php } else {?>
								<a href='Genarate/nagorickGenarate?id=<?php echo sha1($row->id)?>' <?php $this->chk->acl('nagorickGenarate'); ?> class="btn btn-info btn-sm" >
									<?php echo $this->applicant->exPrintPori($row->trackid)?>
								</a>
							<?php }?>
						</td>
						
						<?php if($_GET['napply']=='5'):?>
							<td>
								<a href='Money_receipt/nagorickMoneyReceipt?id=<?php echo sha1($row->trackid)?>' <?php $this->chk->acl('nagorickMoneyReceipt'); ?> class="btn btn-success btn-sm" target='_blank'>Print</a>
							</td>
						<?php endif;?>
					</tr>
					<?php 
						endforeach;
					?>	
				</tbody>
			</table>
		</div>
