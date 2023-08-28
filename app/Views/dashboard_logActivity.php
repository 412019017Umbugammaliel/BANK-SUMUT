    <div class="app-wrapper">
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">			    
				<div class="row">
					<div class="col-sm-12 col-md-4 col-lg-4">
						<h1 class="app-page-title mb-0">Log Activity</h1>
					</div>					
				  <!-- FILTER DAN SEARCH BOX DATA TABLE ======================================================================== -->
					<div class="col-sm-12 col-md-8 col-lg-8">
						<form class="table-search-form row gx-1">
							<div class="col-sm-12 col-md-8 col-lg-8">
								<input class="mt-06rem input-filtering" type="text" id="search-log" name="searchorders" class="form-control search-orders" placeholder="Search orders">
							</div>									
							<div class="col-sm-12 col-md-4 col-lg-4">								    
								<select class="form-select select-option-filtering" id="log_status">
									<option value="0" selected>Filter by status</option>
									<option value="read">Read</option>
									<option value="unread">Unread</option>										  
								</select>
							</div>							
						</form>					                
					</div>
				  <!-- ========================================================================================================= -->
				</div>
              
			    <div class="../app-card mb-4 mt-3">
                    <div class="inner">
					  <!-- TAB NAVIGASI ======================================================================================== -->
						<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav flex-column flex-sm-row mb-1">							
							<a class="flex-sm-fill text-sm-center nav-link tab-active-button active" id="log-activity-tab" aria-selected="true">Log Activity</a>
						</nav>
					  <!-- ===================================================================================================== -->
					  <!-- TABEL LOG ACTIVITY ================================================================================== -->
						<div class="app-card-body p-2 p-sm-3">
							<table id="logactivity" class="table table-striped display nowrap active" style="width:100%">
								<thead>
									<tr class="text-nowrap">		
										<th></th>								
										<th>ID Log</th>
										<th>Category</th>
										<th>Description</th>
										<th>Date Time</th>
										<th>Status</th>
										<!-- <th>Description</th> -->
									</tr>
								</thead>
								<tbody id="body_tabel_notif_log">								
										
								</tbody>
							</table>
						</div>
					  <!-- ===================================================================================================== -->
					</div>					
			    </div>			  
			</div>			
		</div>
	</div>	
  
	<script>
	  // DATA UNTUK DITAMPILKAN KEDALAM MODAL (MODAL PADA NAVIGASI) ===========
	  	// GLOBAL VARIABLE ====================================================
			var idLog, category, status_read, userName, table_log;
		// ====================================================================
		// ONCLICK TOMBOL DETAIL LOG ACTIVITY =================================
			$(document).on('click','#btn_detailLog', function(){
				idLog = $(this).data('id_log');
				userName = $(this).data('user_name_log');
				category = $(this).data('category');
				var dateTime = $(this).data('date_time');
				var descLogActivity = $(this).data('desc_log_activity');
				status_read = $(this).data('status_read');
				$('#show_idLog').text(idLog);
				$('#show_category').text(category);
				$('#show_dateTime').text(dateTime);
				$('#show_descLogActivity').text(descLogActivity);
				
				markReadLog(); // JALANKAN FUNGSI markReadLog(), UNTUK MERUBAH STATUS LOG DARI UNREAD KE READ.
			});
	  	// ====================================================================
	 // ======================================================================= 
	  	$(document).ready(function(){
			getDataLog(); // JALANKAN FUNGSI getDataLog, UNTUK MENAMPILKAN SELURUH DATA LOG AKTIVITAS.
		});
	</script>