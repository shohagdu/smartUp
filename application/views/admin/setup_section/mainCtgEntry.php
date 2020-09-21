<div id="content" class="col-lg-10 col-sm-10">
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url();?>library/mystyle.css" />
	<script type="text/javascript" src="<?php echo base_url();?>library/custom.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
		$('#validall').submit(function() {
		$.post(
				"index.php/setup_section/mainCtgEntry",
				$("#validall").serialize(),
				function(data){
				if(data==1){
					$('#hidemessage').fadeIn('slow').delay(1000).fadeOut('slow');
					setTimeout(function(){					
					window.location="index.php/setup_section/mainCtgEntry";
					},1000)
				}
			});
		return false;
		});
		});
	</script>
	<div class="row box">
		<div class="col-lg-12 col-sm 12" style="margin-bottom: 10px;"> 
			<h3 class="tit" style="margin-top:0px;padding:6px">Main Category Entry</h3>
		</div>
		<div class="col-lg-12 col-sm-12"> 
			<form action="index.php/admin/addinmc" method="post" id="validall" class="daily form-horizontal" role="form">
				<div class="form-group">
					<label class="control-label col-sm-2" for="From Account">Main Category</label>
					<div class="col-sm-4"> 
						<input type='text' name='mctg' class='form-control'  />
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="To Account">Fund type</label>
					<div class="col-sm-4"> 
						<select name="fid" class="form-control" >
							<option value="-1">Select Fund</option>
							<option value="1">Development Fund</option>
							<option value="2">Personal Fund</option>   
						</select>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="form-group"> 
					<div class="col-sm-offset-2 col-sm-1">
						<input type="submit" value="Add" class="btn btn-info "/>
					</div>
					<div class="col-sm-3">
						<div class="row">
						<div class="col-md-12" style="min-height:30px;display:none;" id="hidemessage">
							<div class="alert alert-success alert-sm" >
								<strong>Successfully! Add Category</strong>
							</div>
					   </div>
					   </div>
					</div>
				</div>
			</form>
		</div>
		<!-- bank transfer list show ----------->
		<div class="col-lg-12 col-sm-12"> 
			<script type="text/javascript"> 
				$(document).ready(function() {
					$('#example').DataTable( {
						"lengthMenu": [[ 20, 50,100, -1], [ 20, 50,100, "All"]]
					} );
				} );
			</script>
			
			
			
			<div style="padding:4px;width:100%;font-family:tahoma;" class="table-responsive">
				
				<div class="col-lg-12 col-sm 12" style="margin-bottom: 10px;"> 
					<div class="row">
						<div class="tit" style="margin-top:0px;padding:10px;border-radius:5px;font-size:15px;font-weight:bold;">View All Main Categroy</div>
					</div>
				</div>
				<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
					<thead>
						<tr>  
							<th>Nr</th>
							<th>Main Category</th>  
							<th>Fund Type</th>
							<th>Balance</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$total=0;
							$nr=1;
							$query=$this->db->query("SELECT * FROM mainctg");
							$res=$query->result();
							foreach ($res as $row):
						?>
						<tr>
							<td><?php echo $nr;?></td>  
							<td><?php echo $row->category;?></td>	
							<td><?php if($row->fund_id=='1'){ echo 'Development';} else { echo 'Personal';}?></td>	   
							<td><?php echo number_format($row->balance,2);$total+=$row->balance;?></td>
						</tr>
						<?php $nr++; endforeach;?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan='3' align='right' style="text-align:right;"><b>Total</b>&nbsp;:</td>
							<td style="font-weight:bolder;font-size: 14px;"><?php echo number_format($total,2)?></td>
						</tr>
					</tfoot>
				</table>
				<!--<a href="index.php/Transfer/bankreports" class="btn btn-primary" style="float:right;">Print</a>-->
			</div>
		</div>
		<!--- end bank transer list -------->
	</div> <!-- /row box -->
</div><!--/#content.col-md-0-->
