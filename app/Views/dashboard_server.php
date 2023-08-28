    <div class="app-wrapper">
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    <h1 class="app-page-title">
					Server
				</h1>			
				<div class="app-card app-card-orders-table shadow-sm mb-5">
					
					<div class="app-card-body p-2 pt-2">
						<div class="table-responsive">
							<table id="server_tabels" class="table app-table-hover mb-0 text-left">
								<thead>
									<tr>
										<th class="cell"></th>
										<th class="cell">Host Name</th>
										<th class="cell">Server ID</th>
										<th class="cell">Host Server</th>
										<th class="cell">Power Status</th>
										<th class="cell">Action</th>
									</tr>
								</thead>
								<tbody id="body_server_tables">									
								</tbody>
							</table>
						</div>						       
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script>
		// VARIABLE GLOBAL =================================================================================
		var table_srv;
		// =================================================================================================

		$(document).ready(function(){
			tabelDataServer();
		});
	</script>

	<!-- catatan -->
	<!-- 1. tambahkan search box pada halaman server, untuk mencari data yang ada pada data table. -->