													<table id="sample-table-1" class="table table-striped table-bordered table-hover">
															<thead>																
																<tr><th>#</th>
																	<th class="center no-sort">
																		<input type="checkbox" class="ace ace-checkbox-2" id="chkintrtall"/>
																		<span class="lbl"></span>
																	</th>
																	<th>Weight Next</th>
																	<th>Shipp Cost</th>
																	<th>Margin</th>
																</tr>																
															</thead>
															<tbody>
																<?php 
																	$no=1;
																	foreach ($sql as $row){
																		echo '<tr>
																				<td>'.$no.'</td>
																				<td><center>
																						<label>
																							<input type="checkbox" class="ace ace-checkbox-2 rowintr" name="chk[]" value="'.$row->id_international_shippcost.'"><span class="lbl"></span>
																							
																						</label>
																					</center>
																				</td>
																				<td>'.$row->weight_next.' kg</td>
																				<td>'.$row->cost_shipp.'</td>
																				<td>'.$row->margin_intr.'</td>
																			</tr>';
																		$no++;
																	}
																?>
															</tbody>
														</table>
														