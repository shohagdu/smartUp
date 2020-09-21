<div id="content" class="col-lg-10 col-sm-10">
		<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url();?>library/mystyle.css" />
		<script type="text/javascript" src="<?php echo base_url();?>library/custom.js"></script>
	
		<script type="text/javascript">
			$(document).ready(function(){
			$('#validall').submit(function() {
			$.post(
					"index.php/setup_section/newAccEntry",
					$("#validall").serialize(),
					function(data){
					if(data==1){
						$('#hidemessage').fadeIn('slow').delay(1000).fadeOut('slow');
						setTimeout(function(){					
						window.location="index.php/setup_section/newAccEntry";
						},1000)
					}
					else if(data==11){ alert('This account alerady exist');}					
					//else if(data==12){ alert('Please Entry Data');}					
				});
			return false;
			});
			});
		</script>
		<div class="row box">
			<div class="col-lg-12 col-sm 12" style="margin-bottom: 10px;"> 
				<h3 class="tit" style="margin-top:0px;padding:6px">New Account Entry</h3>
			</div>
			<div class="col-lg-12 col-sm-12"> 
				<form action="index.php/setup_section/newAccEntry" method="post" id="validall" class="daily form-horizontal" role="form">
					<div class="form-group">
						<label class="control-label col-sm-2" for="From Account">Accounts Name</label>
						<div class="col-sm-4"> 
							<input type="text"  class="form-control" name="name" id="name"/>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="To Account">Reference Number</label>
						<div class="col-sm-4"> 
							<input type="text"  class="form-control" name="acno" id="acno"/>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="To Account">Opening Balance</label>
						<div class="col-sm-4"> 
							<input type="text" class="form-control" onkeypress="return checkaccnumber(event);" name="balance" id="balance"  />
						</div>
					</div>
					<div class="clearfix"></div>
					
					<div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-1">
							<input type="submit" value="Add" class="btn btn-info btn-sm"/>
						</div>
						<div class="col-sm-3">
							<div class="row">
							<div class="col-md-12" style="min-height:30px;display:none;" id="hidemessage">
								<div class="alert alert-success alert-sm" >
									<strong>Successfully! Add Account</strong>
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
					});
					
					function account_show(mid){
						//alert(mid);
						$.ajax({
							url:"Setup_section/account_info_show",
							type:"POST",
							data:{mid:mid},
							success:function(data){
								//alert(data);
								var spdata=data.split("|");
								document.getElementById("id").value=spdata[0];
								document.getElementById("maccount_name").value=spdata[1];
								document.getElementById("mref_number").value=spdata[2];
							}
						});
					}
				</script>
				<script type="text/javascript"> 
					$("document").ready(function(){
						$('#account_show_id').submit(function() {
							$.post(
							"index.php/Setup_section/updateAccountInfo",
							$("#account_show_id").serialize(),
							function(data){
								if(data==1)
								{
									alert('Successfully Updated'); 
									location.reload();
								} 
								
								else if(data==5)
								{
									alert('দয়া করে সকল input box সঠিক ভাবে পূরন করুন !!!!!!!!!');
								}
								else{
									alert(data);
								}
							});
							return false;
						});
					});
				</script>
				
				
				
				<div style="padding:4px;width:100%;font-family:tahoma;" class="table-responsive">
					<h3 style="margin-bottom: 20px;">View All Account Information</h3>
					<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>  
								<th width="20">Nr.</th>
								<th>Accounts Name</th>
								<th>Ref Number</th>
								<th>Last Update</th>	    
								<th>Balance</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$nr1=1;
								$query=$this->db->query("SELECT * from acinfo");
								$res=$query->result();
								foreach ($res as $row):
							?>
							<tr>
								<td><?php echo $nr1++; ?></td>
								<td>
									<a class="outline" href="<?php echo $row->id;?>" data-toggle="modal" data-target="#myModal" onclick="account_show(<?php echo $row->id;?>);">
									<?php echo @$row->acname?></a>
								</td>
								<td><?php echo @$row->acno?></td>
								<td><?php echo date('Y-m-d g:i:A',strtotime($row->last_update))?></td>       
								<td><?php echo $row->balance; $total+=$row->balance?></td> 	
				    
							</tr>
							<?php  endforeach;?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan='4' align='right' style="text-align:right;"><b>Total</b>&nbsp;:</td>
								<td style="font-weight:bolder;font-size: 14px;"><?php echo number_format($total,2)?></td>
							</tr>
						</tfoot>
						
					</table>
				</div>
			</div>
			<!--- end bank transer list -------->
		</div> <!-- /row box -->
		
		
		<div class="container">
			<!-- Modal -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Account Name Information Update</h4>
						</div>
						<div class="modal-body modal-global-custom-style">
							<form action="Setup_section/updateAccountInfo" method="post" class="form-horizontal" id="account_show_id">
								<input type="hidden" name="id" id="id" />
								
								<div class="form-group">
									<label for="account Name" class="col-sm-3 control-label">Account Name <span style="color: red;">*</span></label>
									<div class="col-sm-9">
										<input type="text" name="account_name" class="form-control" id="maccount_name" required />
									</div>
								</div>
								<div class="form-group">
									<label for="Ref Number" class="col-sm-3 control-label">Ref Number <span style="color: red;">*</span></label>
									<div class="col-sm-9">
										<input type="text" name="ref_number" class="form-control" id="mref_number" readonly />
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-9">
										<button type="submit" class="btn btn-primary btn-sm">Update</button>
									</div>
								</div>
							</form>			
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!--/#content.col-md-0-->
<style type="text/css"> 
	a.outline{
		outline: 0px;
	}
</style>
