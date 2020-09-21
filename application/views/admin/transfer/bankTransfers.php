<div id="content" class="col-lg-10 col-sm-10">
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url();?>library/mystyle.css" />
	<script type="text/javascript" src="<?php echo base_url();?>library/custom.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.daily').submit(function() {
			$.post(
					"index.php/Transfer/bankTransfers",
					$(".daily").serialize(),
					function(data){
					if(data=="1"){
					alert('Transfer Balance Successfully.');
					window.location='Transfer/bankTransfers';
					}	
					if(data=="2"){
					alert('Same Account Does\'t Transfer Balance');
					}	
					if(data=="3"){
					alert('You don\'t have sufficient Balance');
					}
				else{alert(data);}			
				});
			return false;
			});
		});
		$(function() {
			$("#tdate").datepicker({ dateFormat: 'dd-mm-yy' });
		});
	</script>
	<div class="row box">
		<div class="col-lg-12 col-sm 12" style="margin-bottom: 10px;"> 
			<h3 class="tit" style="margin-top:0px;padding:6px">Inter Bank Transfer</h3>
		</div>
		<div class="col-lg-12 col-sm-12"> 
			<form action="Transfer/bankTransfers" method="post" id="validall" class="daily form-horizontal" role="form">
				<div class="form-group">
					<label class="control-label col-sm-2" for="From Account">From Account</label>
					<div class="col-sm-4"> 
						<select name="faccount" class="form-control" onchange="htmlData('Transfer/faccount','ac='+this.value)">
							<option value="">---Select one---</option>
								<?php
									$query=$this->db->get('acinfo');
									$result=$query->result();
									foreach($result as $row):
								?>
							<option value="<?php echo $row->acno;?>"><?php echo $row->acname;?>(<?php echo $row->acno;?>)</option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="col-sm-2 show_amount"> 
						<span id="txtResult"></span>
					</div>
					<div class="clearfix"></div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="To Account">To Account</label>
					<div class="col-sm-4"> 
						<select name="taccount" class="form-control" onchange="slip('Transfer/taccount','ac='+this.value)">
							<option value="">---Select one---</option>
								<?php
									$query=$this->db->get('acinfo');
									$result=$query->result();
									foreach($result as $row):
								?>
							<option value="<?php echo $row->acno;?>"><?php echo $row->acname;?>(<?php echo $row->acno;?>)</option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="col-sm-2 show_amount"> 
						<span id="slip"></span>
					</div>
					<div class="clearfix"></div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="Amount">Amount</label>
					<div class="col-sm-4">
						<input type="text" name="amount" class="form-control" />
					</div>
					<div class="clearfix"></div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="Date">Date</label>
					<div class="col-sm-4">
						<input type="text" name="payment_date" id="tdate" class="form-control" />
					</div>
					<div class="clearfix"></div>
				</div>
			
				<div class="form-group"> 
					<div class="col-sm-offset-2 col-sm-4">
						<input type="submit" value="Transfer" class="btn btn-info"/>
					</div>
				</div>
			</form>
		</div>
		<!-- bank transfer list show ----------->
		<div class="col-lg-12 col-sm-12"> 
			<script type="text/javascript"> 
				$(document).ready(function() {
					$('#example').DataTable();
				} );
			</script>
			
			<?php 
				$nr=1;
				$q=$this->db->query("select * from ledger where  purpose  like '%Balance Transfer From%' AND balance>0 order by date(payment_date) DESC")->result();
			?>
			
			<div style="padding:4px;width:100%;font-family:tahoma;" class="table-responsive">
				<h3 style="margin-bottom: 20px;">Last <?php echo $this->db->affected_rows();?> Bank Transfer History</h3>
				<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Nr.</th>
							<th>Account Name</th>
							<th>Account No</th>
							<th>Transfer Date</th>
							<th>Balance</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$total=0;
							foreach ($q as $row):
						?>
						<tr>
							<td><?php echo $nr?></td>
							<td><?php echo $this->web->acname($row->ac)?></td>
							<td><?php echo $row->ac?></td>
							<td><?php echo date('d M Y',strtotime($row->payment_date))?></td>
							<td><?php echo $row->dr; $total+=$row->dr;?></td> 
						</tr>
						<?php $nr++; endforeach;?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan='4' align='right' style="text-align:right;"><b>Total</b>&nbsp;:</td>
							<td style="font-weight:bolder;font-size: 14px;"><?php echo number_format($total,2);?></td>
						</tr>
					</tfoot>
				</table>
				<!--<a href="index.php/Transfer/bankreports" class="btn btn-primary" style="float:right;">Print</a>-->
			</div>
		</div>
		<!--- end bank transer list -------->
	</div> <!-- /row box -->
</div><!--/#content.col-md-0-->