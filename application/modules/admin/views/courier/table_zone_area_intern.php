								<div class="space-6"></div>
								<table class="display wrap dt-tables" cellspacing="0" width="100%" value="<?php echo base_url('admin/'.$class.'/zone_area_intern/'.$id_courier.'/0')?>">
									<thead>
						            <tr>
							            <th>#</th>					            									
										<th class="center no-sort">
											<input type="checkbox" class="ace ace-checkbox-2" id="chkzoneall"/>
											<span class="lbl"></span>
										</th>
										<th>ID</th>																											
										<th>Country</th>	
										<th class="no-sort">
											<label>
												<input type="checkbox" class="ace ace-checkbox-2" id="weight"/>
												<span class="lbl"> Weight First</span>
											</label> 
										</th>	
										<th class="no-sort">
											<label>
												<input type="checkbox" class="ace ace-checkbox-2" id="wglast"/>
												<span class="lbl"> Weight Last</span>
											</label> 
										</th>	
										<th class="no-sort">
											<label>
												<input type="checkbox" class="ace ace-checkbox-2" id="margin"/>
												<span class="lbl"> Margin</span>
											</label> 
										</th>	
										<th class="no-sort">
											<label>
												<input type="checkbox" class="ace ace-checkbox-2" id="price"/>
												<span class="lbl"> Price (<?php echo $_SESSION['symbol']?>)</span>
											</label> 
										</th>																																																																													
									</tr>
			       				 </thead>
			       				 <thead>
									<tr>
										<td></td>
										<td></td>
										<td><input type="text" id="2" class="search-input"></td>
										<td><input type="text" id="3" class="search-input"></td>	
										<td></td>	
										<td></td>	
										<td></td>	
										<td></td>																													
									</tr>
								</thead>	
								</table>
								<div class="space-10"></div>
								<button class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Save</button>	
<script type="text/javascript">
$(document).ready(function(){		
	loaddatatable(".dt-tables");		
});
$("#chkzoneall").on('click',function(e){
	if (this.checked){
		$(".chkrow0").prop('checked',true);
	}else{
		$(".chkrow0").prop('checked',false);
	}
})
$("#weight").on('click',function(e){
	var val = document.getElementById('wf1').value;	
	if (this.checked){		
		$(".wght").val(val);//mengisi pada dari nilai urut yang pertama
	}else{
		$(".wght").val('');
	}
})
$("#wglast").on('click',function(e){
	var val = document.getElementById('wl1').value;	
	if (this.checked){		
		$(".wghl").val(val);//mengisi pada dari nilai urut yang pertama
	}else{
		$(".wghl").val('');
	}
})
$("#price").on('click',function(e){
	var val = document.getElementById('prc1').value;	
	if (this.checked){		
		$(".prce").val(val);//mengisi pada dari nilai urut yang pertama
	}else{
		$(".prce").val('');
	}
})
$("#margin").on('click',function(e){
	var val = document.getElementById('mrg1').value;	
	if (this.checked){		
		$(".mrg").val(val);//mengisi pada dari nilai urut yang pertama
	}else{
		$(".mrg").val('');
	}
})
</script>  