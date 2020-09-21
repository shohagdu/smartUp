		<div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="datetime"> 
						<h3>Welcome, <span class="show-date-time">Today, <?php echo date('d M, Y')?> </span></h3>
					</div>
				</div>
			</div>
			
			<div class="row"  style="background: #FBFDFE"> 
				<form action='' method='post' class="form-horizontal">
				
				 <table class='table'>
				    <tr>
					   <td>
					     <textarea name='qy' rows='10' cols='80' style='float:left;text-align:left;margin:0;padding:0;'>
						 <?php echo set_value('qy',true);?>
						 </textarea>
					   </td>
				    </tr>
					<tr>
					  
					  <td><input type='submit' value='Query' class='btn btn-primary'/></td>
					</tr>  
				 </table>
				</form>
				<?php
					  if($_POST):
						extract($_POST);
						$qy=trim($qy);
						$query = $this->db->query("$qy");
						$index=array();
						$string =array();
						foreach ($query->result_array() as $row)
						{
							foreach($row as $key=>$val){
								$index[].=$key;
								}
						}
					 ?>
				<table class='table border-hover'>
				<tr>
				  <?php foreach (array_unique($index) as $field):?>
				  <th><?php echo $field?></th>
				  <?php endforeach;?>
				</tr>
				<?php foreach ($query->result() as $value):?>
					<tr>
					<?php foreach (array_unique($index) as $field):?>
					  <td><?php echo $value->$field?></td>
					  <?php endforeach;?>
					</tr>
				 <?php endforeach;?>
				</table>
				<?php  endif; ?>
			</div>
			
			
		</div><!--/#content.col-md-0-->
	</div><!--/fluid-row-->

	<hr/>
	
  

	
	