<?php
	
	include_once __DIR__.'/../data_access/shopLocationsDAO.php';
	
	class Util{
		
		/* This method is used for generation of a string, that could be later converted to DOM. It represents a paginated table which is filled 
		   with data from $places. */
		public function create_shop_location_table_string($places,$current_page,$max_records,$enable_footer){
			
			$places_count = count((new shopLocationsDAO())->get_all());
			$pages_count = ceil($places_count/$max_records);
			
			$return_string = '
				<table id="places-table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Address</th>
							<th>Distance in km</th>
							<th>Latitude</th>
							<th>Longitude</th>
						</tr>
					</thead>';
					
					if($enable_footer){
						
						$i=1;
						$previous_page=$current_page;
						if($current_page > 1){
							$previous_page=$current_page-1;
						}
						$table_footer = '
									<tfoot>
										<tr>
											<td colspan="5">
												<div id="paging">
													<ul>';
													
													$previous_page_element='<li onclick="get_page('.($previous_page).');">
															<a href="javascript:void(0);">
																<span>Previous</span>
															</a>
														</li>';
														$table_footer=$table_footer.$previous_page_element;
														$table_footer_numbers = '';
														while($i <= $pages_count){
							
															$table_footer_numbers = $table_footer_numbers.'
															<li onclick="get_page('.$i.');">
																<a href="javascript:void(0);"';
																if($i==$current_page){
																	$table_footer_numbers = $table_footer_numbers.' class="active"';
																}
																$table_footer_numbers = $table_footer_numbers.'>
																	<span>'.$i.'</span>
																</a>
															</li>';
															$i++;
														}
														$next_page=$current_page;
														if($current_page < $pages_count){
															$next_page=$current_page+1;
														}
															$table_footer = $table_footer.$table_footer_numbers;
															$table_footer = $table_footer.'
															<li id="next-link" onclick="get_page('.($next_page).');">
																<a href="javascript:void(0);">
																	<span>Next</span>
																</a>
															</li>
															
															
													</ul>
												</div>
											</tr>
										</tfoot>';
						$return_string = $return_string.$table_footer;
					}
					
					$table_body = '<tbody>';
									
					foreach($places as $shopLocation){
						$table_body = $table_body.'<tr id="row-"'.$shopLocation->get_id().'>';
						$table_body = $table_body.'<td>'.$shopLocation->get_name().'</td>';
						$table_body = $table_body.'<td>'.$shopLocation->get_address().'</td>';
						$table_body = $table_body.'<td>'.number_format((float)$shopLocation->get_distance(), 2, '.', '').'</td>';
						$table_body = $table_body.'<td>'.$shopLocation->get_latitude().'</td>';
						$table_body = $table_body.'<td>'.$shopLocation->get_longitude().'</td>';
						$table_body = $table_body.'</tr>';
										
					}
					$table_body = $table_body.'</tbody>';
					$return_string = $return_string.$table_body;
					$return_string = $return_string.'</table>';
					return $return_string;
		}
		
	}

?>