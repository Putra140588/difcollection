<div class="main-content">
				<div class="main-content-inner">
				<?php $this->load->view('vw_header_index')?>
					<div class="page-content">						
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<?php $this->load->view('vw_alert_notif')?>																								
								<div class="widget-toolbar action-buttons">																
									<button onclick="javascript:window.location.href='<?php echo base_url(MODULE.'/'.$class.'/form')?>'" class="btn btn btn-white btn-primary btn-bold bigger-120 ace-icon fa fa-plus-square" data-rel="tooltip" data-placement="top" title="Add New"></button>		
								</div>								
								<div class="row ">									
									<div class="btn-export"></div>								
								</div>														
								<hr>
								<div class="space-6"></div>
								<table class="display wrap dt-tables" cellspacing="0" width="100%" value="<?php echo base_url('admin/'.$class.'/get_records')?>">
									<thead>
						            <tr>
							            <th>#</th>					            									
										<th>Function Code</th>
										<th>Function Name</th>	
										<th>Access By</th>																																														
										<th class="no-sort">Actions</th>																																																																			
									</tr>
			       				 </thead>
			       				 <thead>
									<tr>
										<td></td>
										<td><input type="text" id="1" class="search-input"></td>
										<td><input type="text" id="2" class="search-input"></td>	
										<td><input type="text" id="3" class="search-input"></td>																																																							
										<td></td>																																
									</tr>
								</thead>	
								</table>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
<script type="text/javascript">
$(document).ready(function(){		
	loaddatatable(".dt-tables");		
});
</script>  