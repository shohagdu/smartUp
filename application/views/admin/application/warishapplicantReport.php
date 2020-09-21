
		<script type="text/javascript"> 
			$(document).ready(function() {
				$('#example').DataTable({
					//"order": true
					<?php if($_GET['napply']=='5'):?>
					"order": [[ 7, "desc" ]]
					<?php endif; ?>
					
					<?php if($_GET['napply']=='new'):?>
					"order": [[ 6, "desc" ]]
					<?php endif; ?>
				});
			} );
			$(function() {
				$("#dofb").datepicker({ dateFormat: 'yy-mm-dd' });
			});
		</script>
		<div style="padding:4px;width:100%;" id="showdata">
			<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

				<thead>
					<tr style="font-size: 13px !important; font-family: SolaimanLipi;font-style: normal;">
						<th>নাম</th>
						<th>ট্র্যাকিং নং</th>
						<?php if($_GET['napply']=='5'):?>
							<th>সনদ নং</th>
						<?php endif;?>
						<th>সরবরাহের ধরণ </th>
						<th>মোট ওয়ারিশ</th>
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
					foreach($query as $row):
				?>
					<tr style="font-size: 13px !important; font-family: SolaimanLipi;font-style: normal;">
						<td style="white-space:normal;">
							<a href="Update/warishInfo?id=<?php echo md5($row->id);?>" <?php $this->chk->acl('warishInfo'); ?>><?php echo $row->bname?></a>
						</td>
						<td>
							<a href="Update/warishInfo?id=<?php echo md5($row->id);?>" <?php $this->chk->acl('warishInfo'); ?>><?php echo @$row->trackid?></a>
						</td>
						<?php if($_GET['napply']=='5'):?>
							<td>
								<?php echo $row->sonodno;?>
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
							<a href="javascript: void(0);">
								<?php echo $this->applicant->tWarish($row->trackid)?></font>
							</a>
						</td>
						<td>
							<?php echo @$row->mobile?>
						</td>
						<td>
							<?php  echo $date=date("d M, Y",strtotime($row->insert_time));?>
						</td>
						<td>
							<?php if($this->applicant->exPrintwcc($row->trackid)=='Print'){?>
								<a href='Certificate/warishBangla?id=<?php echo sha1($row->trackid)?>'  class="btn btn-primary btn-sm" <?php $this->chk->acl('warishBangla'); ?> target='_blank'>বাংলা</a>
								<a href='Certificate/warishEnglish?id=<?php echo sha1($row->trackid)?>' <?php $this->chk->acl('warishEnglish'); ?> class="btn btn-info btn-sm" target='_blank'>ইংরেজী</a>
							<?php } else {?>
								<a href='Genarate/warishGenarate?id=<?php echo sha1($row->id)?>' <?php $this->chk->acl('warishGenarate'); ?> class="btn btn-info btn-sm">
									<?php echo $this->applicant->exPrintwcc($row->trackid);?>
								</a>
							<?php }?>
						</td>
						
						<?php if($_GET['napply']=='5'):?>
							<td>
								<a href='Money_receipt/warishMoneyReceipt?id=<?php echo sha1($row->trackid)?>' <?php $this->chk->acl('warishMoneyReceipt'); ?> class="btn btn-success btn-sm" target='_blank'>Print</a>
							</td>
						<?php endif;?>
					</tr>
				<?php 
					endforeach;
				?>	
				</tbody>
			</table>
		</div>