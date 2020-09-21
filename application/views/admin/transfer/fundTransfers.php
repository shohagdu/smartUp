<div id="content" class="col-lg-10 col-sm-10">
	<script type="text/javascript">
		$(document).ready(function(){
			$('.fund_transfer').submit(function() {
				$.post(
					"Transfer/fund_transfer_action",
					$(".fund_transfer").serialize(),
					function(data){
						alert(data);
					}
				);
				return false;
			});
		});
	</script>	
	<div class="row box">
		<div class="col-lg-12 col-sm 12" style="margin-bottom: 10px;"> 
			<h3 class="tit" style="margin-top:0px;padding:6px">Inter Fund Transfer</h3>
		</div>
		<form action="Transfer/fund_transfer_action" method="post" class="fund_transfer form-horizontal" role="form">
			<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<label class="control-label col-sm-2" for="Fund">Fund</label>
					<div class="col-sm-10"> 
						<select name='fund_id' class="form-control" onchange="addinfo('Transfer/funwctg','f='+this.value);">
							<option value=''>--Select---</option>
							<option value='1'>Development</option>
							<option value='2'>Personal</option>
						</select>
					</div>
				</div>
				<div id="txtwr"> 
					
				</div>
				<div id="scat"> 
				
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="Accounts">Accounts</label>
					<label class="checkbox-inline control-label col-sm-1">
						<input type='checkbox' id='eac1' onclick="this.form.accounts.disabled=this.form.saccounts.disabled= !this.checked;"/>
					</label>
					<div class="col-sm-9">
						<select name="accounts" class="form-control" onchange="htmlData('Transfer/sContent','id='+this.value)" disabled >
							<option value=''>--Select---</option>
							<?php
								$aquery=$this->db->query("SELECT * from acinfo");
								$aresult=$aquery->result();
								foreach ($aresult as $row):
							?>
							<option value="<?php echo $row->acname;?>"><?php echo $row->acname;?>(&nbsp;<?php echo $this->web->acBalance($row->acno);?>&nbsp;)</option>
							<?php endforeach;?>
						</select>
					</div>
				</div>
				
				<div id="txtResult"> 
				
				</div>
				
				<div id="slip">
				
				</div>
				<!---------cheque ------->

				<!---------pay order------->

				<!---------DD order------->

				<!---------TT order------->
			</div>
			
			

			<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<label class="control-label col-sm-2" for="Fund">Fund</label>
					<div class="col-sm-10"> 
						<select name='sfund_id' class="form-control"onchange="addinfo2('Transfer/funwctg','f='+this.value+'&f2=1');">
							<option value=''>--Select---</option>
							<option value='1'>Development</option>
							<option value='2'>Personal</option>
						</select>
					</div>
				</div>
				<div id="txtwr2"> 
					
				</div>
				<div id="sscat"> 
				
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="Accounts">Accounts</label>
					<div class="col-sm-10">
						<select name="saccounts" class="form-control" onchange="acData('Transfer/sContent','id='+this.value+'&ac=2')" disabled >
							<option value=''>--Select---</option>
							<?php
								$aquery=$this->db->query("SELECT * from acinfo");
								$aresult=$aquery->result();
								foreach ($aresult as $row):
							?>
							<option value="<?php echo $row->acname;?>"><?php echo $row->acname;?>(&nbsp;<?php echo $this->web->acBalance($row->acno);?>&nbsp;)</option>
							<?php endforeach;?>
						</select>
					</div>
				</div>
				<div id="txtResult2">
				
				</div>
				
				<div id="sslip"> 
				
				</div>
				<!---------cheque ------->

				<!---------pay order------->

				<!---------DD order------->

				<!---------TT order------->
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-6"> 
				<div class="form-group">
					<label class="control-label col-sm-2" for="Amount">Amount</label>
					<div class="col-sm-10">
						<input type="text" name="amount" class="form-control" />
					</div>
				</div>
			</div>
			
			<div class="clearfix"></div>
			
			<div class="col-sm-6"> 
				<div class="form-group">
					<label class="control-label col-sm-2" for="Description">Description</label>
					<div class="col-sm-10">
						<input type="text" name="des" class="form-control" />
					</div>
				</div>
			</div>
			
			<div class="clearfix"></div>
			
			<div class="col-sm-6"> 
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<input type="submit" value="Transfer" class="btn btn-info"/>
					</div>
				</div>
			</div>
		</form>
	</div><!--- / row --->
</div><!--/#content.col-md-0-->