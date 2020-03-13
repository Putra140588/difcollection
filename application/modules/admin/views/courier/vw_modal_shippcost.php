		
									<div class="modal-dialog">
										<div class="modal-content" style="width:800px;top:10%;left:50%;margin-left:-400px;">											
											<div class="modal-body">												
												<?php $this->load->view('vw_alert_notif')?>	
												<form id="<?php echo $id_form?>" class="form-horizontal" value="<?php echo base_url(MODULE.'/'.$class.'/proses_shippcost')?>#listshippcost">													
													<input type="hidden" class="msp_token" name="<?php echo csrf_token()['name']?>" value="<?php echo csrf_token()['hash']?>">
													<input type="hidden" name="id_shipping_cost" value="<?php echo isset($id_shipping_cost) ? $id_shipping_cost : ''?>">
													 <?php $this->load->view('vw_button_form')?>	
													 <div class="widget-body">
														<div class="widget-main padding-6 no-padding-left no-padding-right">
															<div class="space-6"></div>															
															<div class="form-group required">
																<label class="col-sm-4 control-label"> Country Name </label>
																<div class="col-sm-8">
																	<input type="text" readonly class="col-xs-10 col-sm-5" value="<?php echo isset($country_name) ? $country_name : ''?>" required/>
																</div>
															</div>																
															<div class="form-group required">
																<label class="col-sm-4 control-label"> Weight First</label>
																<div class="col-sm-8">
																	<input type="text" readonly placeholder="kg"  name="wf" id="wf" class="col-xs-3 col-sm-3" value="<?php echo isset($weight_first) ? $weight_first : ''?>" onkeypress="return decimals(event,this.id)" required/>
																</div>
															</div>
															<div class="form-group required">
																<label class="col-sm-4 control-label"> Weight Next</label>
																<div class="col-sm-8">
																	<input type="text" placeholder="kg"  name="wn" id="wn" class="col-xs-3 col-sm-3 clear"  onkeypress="return decimals(event,this.id)"/>
																</div>
															</div>
															<div class="form-group required">
																<label class="col-sm-4 control-label"> Weight Last</label>
																<div class="col-sm-8">
																	<input type="text" placeholder="kg"  name="wl" id="wl" class="col-xs-3 col-sm-3 clear"  onkeypress="return decimals(event,this.id)"/>
																</div>
															</div>
															
															<div class="form-group required">
																<label class="col-sm-4 control-label"> Margin</label>
																<div class="col-sm-8">
																	<input type="text" placeholder="<?php echo $_SESSION['symbol']?>"  name="margin" id="margin" class="col-xs-3 col-sm-3 clear" value="<?php echo isset($margin) ? $margin : ''?>" onkeypress="return decimals(event,this.id)"/>
																</div>
															</div>
															<div class="form-group required">
																<label class="col-sm-4 control-label"> Price First</label>
																<div class="col-sm-8">
																	<input type="text" placeholder="<?php echo $_SESSION['symbol']?>" name="price" id="price" class="col-xs-3 col-sm-3 clear" value="<?php echo isset($price) ? $price : ''?>" onkeypress="return decimals(event,this.id)"/> Price Last + margin
																	
																</div>
															</div>
														</div>
														<div class="page-header"><h1>List Shipp Cost</h1></div>
														<div id="listshippcost">
															<?php $this->load->view('courier/vw_table_list_shippcost')?>
														</div>
														<div class="space-10"></div>
														<input type="hidden" name="deletelist">
														<button class="btn btn-danger btn-sm" id="btndel" onclick="return confirm('Are you sure delete Shipp Cost?')"><i class="fa fa-trash"></i> Delete</button>

													</div>
												</form>
											</div>
											<div class="modal-footer">
												<button class="btn btn-sm" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Close
												</button>												
											</div>
										</div>
									</div>
<script type="text/javascript">
$(document).ready(function(){		
	$("#chkintrtall").on('click',function(e){
		if (this.checked){
			$(".rowintr").prop('checked',true);
		}else{
			$(".rowcost").prop('checked',false);
		}
	})
	$("#btndel").click(function(){
		$('input[name="deletelist"]').val(true);
	});	
});
</script>								