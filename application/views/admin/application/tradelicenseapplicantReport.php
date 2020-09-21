
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
						
						<?php if(($_GET['napply']=='new') || ($_GET['napply']=='5')):?>
						<th>ট্র্যাকিং নং</th>
						<?php endif;?>
						
						<?php if(($_GET['napply']=='5') || ($_GET['napply']=='expire')):?>
							<th>সনদ নং</th>
						<?php endif;?>
						
						<?php if(($_GET['napply']=='new') || ($_GET['napply']=='5')):?>
						<th>সরবরাহের ধরণ </th>
						<?php endif;?>
						
						<th>মোবাইল</th>
						<th>প্রতিষ্ঠানের নাম</th>
						
						<?php if($_GET['napply']=='new'):?>
							<th>আবেদনের তারিখ</th>
						<?php endif;?>
						<?php if($_GET['napply']=='5'):?>
							<th>জেনারেট তারিখ</th>
						<?php endif;?>
						
						<?php if($_GET['napply']=='expire'): ?>
						<th>ইস্যুকৃত তারিখ</th>
						<th>মেয়াদ উত্তীর্ণ তারিখ</th>
						<?php endif;?>
						
						
						<?php if(($_GET['napply']=='new') || ($_GET['napply']=='5')):?>
						<th>সার্টিফিকেট</th>
						<?php endif;?>
						
						<?php if($_GET['napply']=='expire'): ?>
						<th>অ্যকশন</th>
						<?php endif;?>
						
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
						<td>
							<img src="<?php if($row->profile !=''): echo $row->profile; else: echo "default.jpg";endif;?>" height='40' width='45'/>
						</td>
						<td style="white-space:normal;">
							<a href="Update/tradelicenseInfo?id=<?php echo md5($row->id)?>" <?php $this->chk->acl('tradelicenseInfo'); ?> target=""><?php echo $row->bwname?></a>
						</td>
						<?php if(($_GET['napply']=='new') || ($_GET['napply']=='5')):?>
						<td>
							<a href="Update/tradelicenseInfo?id=<?php echo md5($row->id)?>" <?php $this->chk->acl('tradelicenseInfo'); ?> target=""><?php echo $row->trackid?></a>
						</td>
						<?php endif;?>
						
						<?php if(($_GET['napply']=='5') || ($_GET['napply']=='expire')):?>
							<td>
								<?php echo $row->sno?>
							</td>
						<?php endif;?>
						<?php if(($_GET['napply']=='new') || ($_GET['napply']=='5')):?>
						<td>
							<?php 
							if($row->delivery_type==1) $dtype="জরুরী"; 
							if($row->delivery_type==2) $dtype="অতি জরুরী"; 
							if($row->delivery_type==3) $dtype="সাধারন"; echo $dtype;
							?>
						</td>
						<?php endif;?>
						<td>
							<?php echo @$row->mobile?>
						</td>
						<td style="white-space:normal;">
							<?php echo $row->bcomname?>
						</td>
						
						<?php if(($_GET['napply']=='new') || ($_GET['napply']=='5')):?>
						<td>
							<?php echo date('d M, Y',strtotime($row->utime));?>
						</td>
						<?php endif;?>
						
						<?php if($_GET['napply']=='expire'): ?>
						<td style="color: gray;font-weight: bolder;">
							<?php echo date('d M, Y',strtotime($row->issue_date));?>
						</td>
						<td style="color: red; font-weight: bolder;">
							<?php echo date('d M, Y',strtotime($row->expire_date));?>
						</td>
						<?php endif;?>
						
						<?php if(($_GET['napply']=='new') || ($_GET['napply']=='5')):?>
						<td>
							<?php if($this->applicant->rePrint($row->trackid)=='Print'){?>
								<a href='Certificate/tradelicenseBangla?id=<?php echo sha1($row->trackid)?>' <?php $this->chk->acl('tradelicenseBangla'); ?> target='_blank' class="btn btn-primary btn-sm">বাংলা </a>
								<a href='Certificate/tradelicenseEnglish?id=<?php echo sha1($row->trackid)?>' <?php $this->chk->acl('tradelicenseEnglish'); ?> target='_blank' class="btn btn-info btn-sm">ইংরেজী</a>
							<?php } else {?>
								<a href='Genarate/tradelicenseGenarate?id=<?php echo sha1($row->trackid)?>' <?php $this->chk->acl('tradelicenseGenarate'); ?> class="btn btn-info btn-sm"><?php echo $this->applicant->rePrint($row->trackid)?></a>
							<?php }?>
						</td>
						<?php endif;?>
						<?php if($_GET['napply']=='5'):?>
							<td>
								<a href='Money_receipt/tradelicenseMoneyReceipt?id=<?php echo sha1($row->trackid)?>' <?php $this->chk->acl('tradelicenseMoneyReceipt'); ?> class="btn btn-success btn-sm" target='_blank'>Print</a>
							</td>
						<?php endif;?>
						
						<?php if($_GET['napply']=='expire'): ?>
						<td>
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="viewStatus(<?php echo $row->id ?>)" data-target="#upDateCustomLogo" ><i class="glyphicon glyphicon-envelope"></i></button>
							<a href='index.php/RenewTradeLicense/RenewTradeLicenGenerate?id=<?php echo sha1($row->trackid)?>'  class="btn btn-success btn-sm">Re Genarate</a>
						</td>
						<?php endif;?>
					</tr>
				<?php 
					endforeach;
				?>	
				</tbody>
			</table>
		</div>