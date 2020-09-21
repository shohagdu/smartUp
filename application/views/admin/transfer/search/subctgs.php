	<?php
		extract($_GET);
		if(isset($_GET['sc']) && $_GET['sc']==2){
		$ad=2;
		}
		//$query=$this->db->query("select * from subctg where mc_id='$id'");
		$query=$this->db->select('*')->from('subctg')->where('mc_id',$id)->get();
		$result=$query->result();
		if($query->num_rows()>0){
	?>
	<div class="form-group">
		<label class="control-label col-sm-3" for="Sub Category">Sub Category</label>
		<div class="col-sm-9"> 
			<select name="subcat<?php echo $ad?>" class="form-control">
				<option value=''>--Select---</option>
				<?php
					foreach ($result as $row):
				?>
				<option value="<?php echo $row->id;?>"><?php echo $row->sub_title;?>(&nbsp;<?php echo $this->web->sctgBalance($row->id);?>&nbsp;)</option>
				
				<?php endforeach;?>
			</select>
		</div>
	</div>
	<?php }?>
