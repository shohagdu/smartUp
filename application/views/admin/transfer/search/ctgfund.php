	<?php 
		extract($_GET);
		if(isset($_GET['f2']) && $_GET['f2']==1){
		$con=2;$sc=2;
		}
	?>
	<div class="form-group">
		<label class="control-label col-sm-2" for="Category">Category</label>
		<div class="col-sm-10"> 
			<select name="catid<?php echo $con?>" class="form-control" onchange="sCategory<?php echo $con?>('Transfer/sCategory','id='+this.value+'&sc=<?php echo $sc?>');">
				<?php
					//$cquery=$this->db->select("select * from mainctg where fund_id=$f");
					$cquery=$this->db->select('*')->from('mainctg')->where('fund_id',$f)->get();
					$cresult=$cquery->result();
				?>
				<option value=''>--Select---</option>
				<?php 
					foreach ($cresult as $row):
				?>
				<option value="<?php echo $row->id?>"><?php echo $row->category?>(&nbsp;<?php echo $this->web->mctgBalance($row->id);?>&nbsp;)</option>
				
				<?php endforeach;?>
			</select>
		</div>
	</div>