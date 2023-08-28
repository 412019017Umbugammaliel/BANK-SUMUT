	<div class="app-wrapper">
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">	
				<div class="row">
					<div class="col-sm-12 col-md-6 col-lg-6">
						<h1 class="app-page-title mb-0">Order</h1>
					</div>
				  <!-- Start, container for searching or filtering with input text box and select option -->
					<div class="col-sm-12 col-md-6 col-lg-6">
						<form class="table-search-form row gx-1">
							<div class="col-sm-12 col-md-8 col-lg-8">
								<input class="mt-06rem input-filtering" type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search orders">
							</div>									
							<div class="col-sm-12 col-md-4 col-lg-4">								    
								<select class="form-select select-option-filtering" id="status">
										<option value="0">All</option>
										<option value="Paid">Paid</option>
										<option value="Pending">Pending</option>
										<option value="Cancelled">Cancelled</option>										  
								</select>
							</div>
						</form>					                
					</div>
				  <!-- End, container for searching or filtering with input text box and select option -->
				</div>				
			</div>
			
		  <!--Start app card for table -->
			<div class="app-card shadow-sm mt-4 mb-5">
				<div class="app-card-body p-2 p-sm-3">					
					<table class="table table-striped display nowrap" id="order-table" style="width:100%">
						<thead>
							<tr>
								<th class="cell">Order</th>
								<th class="cell">Product</th>
								<th class="cell">Customer</th>
								<th class="cell">Date</th>
								<th class="cell">Status</th>
								<th class="cell">Total</th>
								<th class="cell"></th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($allOrder as $rowAllOrder){
									if($rowAllOrder['payment'] == 'Paid'){
										$stat = 'bg-success';
									}elseif($rowAllOrder['payment'] == 'Pending'){
										$stat = 'bg-warning';
									}else{
										$stat = 'bg-danger';
									}
							?>
							<tr>
								<td class="cell"><?php echo $rowAllOrder['order_code'];?></td>
								<td class="cell"><?php echo $rowAllOrder['product'];?></td>
								<td class="cell"><?php echo $rowAllOrder['customer'];?></td>
								<td class="cell"><?php echo $rowAllOrder['date'];?>&nbsp;<?php echo $rowAllOrder['time'];?></td>
								<td class="cell"><span class="badge <?php echo $stat;?>"><?php echo $rowAllOrder['payment']; ?></span></td>
								<td class="cell"><?php echo 'Rp.'.number_format($rowAllOrder['total'], 0, '', '.')?></td>
								<td class="cell"><a class="btn-sm btn-on-table app-btn-secondary" href="<?php echo base_url('inv')?>">View</a></td>
							</tr>
							<?php } ?>
						</tbody>	
											
					</table>				       
				</div>		
			</div>
		  <!-- End app card for table -->
						
			<script>	
				$(document).ready(function () {
				  // Function for activating fiture from datatable
					var tabel_orders = $('#order-table').DataTable({
						search: false, // Non active searching function
						dom: 'ltpr', // Hide search box from datatable. set it with char to display, if not set it will not show. (char => l - length changing input control, f - filtering input, t - The table!, i - Table information summary, p - pagination control, r - processing display element)
						// Set numbers of lines frome datatable
						lengthMenu: [
							[5, 10, 25, 50, -1],
							[5, 10, 25, 50, 'All'],
						],	
						columnDefs: [ // Define definitions for columns
							// Center align & noWrap the header content of column ....
							{ className: "dt-head-center dt-head-nowrap", targets: [ 0, 1, 2, 3, 4, 5, 6] },
							// Center align & noWrap the body content of columns ....
   							{ className: "dt-body-center", targets: [ 0, 3, 6 ] },
							{ className: "dt-body-nowrap", targets: [ 0, 1, 2, 3, 4, 5, 6 ] },
						],			
						autowidth: true, //Sets the auto-width where the datatable placeholders reside				
						scrollX: true, // Set active srollbar horizontal
						scrollY:"250px", // Set height from datatable
						paging: true, // Activate the button function to move the table page						
						"sPaginationType": "full_numbers", // Set model from paging button
					});
				  // End =====================================

				  	// Additional fitur outside datatable fiture:
				  // Auto seracing or filtering data with input text box.
					$('#search-orders').on('input', () => {            
						tabel_orders.search($("#search-orders").val()).draw();
					});
					// Auto searching or filtering with Select option with parameter paid,pending,cancelled.
					$('#status').on('change', () => {            
						tabel_orders.search($("#status").val()).draw();
					});
				  // End =====================================
				});
			</script>


<!-- <div class="col-auto">
	<div class="page-utilities">
		<div class="row g-2 justify-content-start justify-content-md-end align-items-center"> -->
			<!--row-->
			<!-- <div class="col-auto">						    
				<a class="btn app-btn-secondary" href="#">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
						<path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
					</svg>
					Download CSV
				</a>
			</div> -->
			<!-- end row -->
		<!-- </div>
	</div>
</div> -->