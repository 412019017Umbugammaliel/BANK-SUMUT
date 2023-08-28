<?php 
	if(!empty(session()->get('user_name'))){$user = session()->get('user_name');}
	if(!empty(session()->get('level'))){$user_level = session()->get('level');}
?>

    <div class="app-wrapper">
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">			    
			    <h1 class="app-page-title">
                    Dashboard
                </h1>

            <!-- Welcome Card =================================================================================================== -->
			    <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                    <div class="inner">
					    <div class="app-card-body p-3 p-lg-4">
						    <h3 class="mb-3">
                                Selamat datang <?php echo $user;?>
                            </h3>
						    <div class="row gx-5 gy-3">
						        <div class="col-12 col-lg-8">							        
							        <div>
                                        Portal Cloud Bank Sumut.
                                    </div>
							    </div>
							    <div class="col-12 col-lg-4 text-center">
								    <a class="btn app-btn-primary" href="https://www.teknacloud.id/">
                                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-file-earmark-arrow-down me-2" fill="currentColor" xmlns="">
                                            <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                            <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
                                            <path fill-rule="evenodd" d="M8 6a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 10.293V6.5A.5.5 0 0 1 8 6z"/>
                                        </svg>
                                        Lihat Virtual Machine
                                    </a>
							    </div>
						    </div>
						    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					    </div>					    
				    </div>
			    </div>
			<!-- ================================================================================================================ -->
			<?php
				if($user_level == "Client"){ } // JANGAN TAMPILKAN JIKA LEVEL ADALAH CLIENT.
				else{ // TAMPILKAN CARD JIKA LEVEL ADMIN DAN CS.
			?>
            <!-- LIST CARD SERVERS (ADMIN) ====================================================================================== -->
			    <div class="row g-4 mb-4 ">					
					<div class="card-container-server">						
						<?php 	
							foreach($serverData as $rowSD){								
								// Kondisi untuk memberi nilai variabel $stat sebagai parameter pemberian warna latar untuk status pembayaran
								if(!empty($rowSD["power_status"] == 'ON')){
									$stat = 'bg-success';
								}elseif(!empty($rowSD["power_status"] == 'OFF')){
									$stat = 'bg-danger';
								}							
						?>
						<div class="app-card app-card-stat shadow-sm h-100 js-tilt cardServer card-child-server" 
							data-tilt data-tilt-glare="true"
							data-tilt-max-glare="50" 
							data-scale="1" 
							data-tilt-max="50"
							data-tilt-perspective="20000" 
							data-reset="true"
							data-shadow="true"
							color="green"
						>
							<div class="app-card-body p-3 p-lg-4 cardInner">
								<h4 class="stats-type mb-1" ><?php if(isset($rowSD["user_name"])) {echo $rowSD["user_name"];}?></h4>
								
								<label class="lcserver">Server ID</label>
								<h4 class="stats-type2 mfcserver1"><?php if(isset($rowSD["server_id"])) {echo $rowSD["server_id"];}?></h4>
								
								
								<label class="lcserver" style="font-size:10px;">Host Server</label>											
								<h4 class="stats-type1 mfcserver2"><?php if(isset($rowSD["host_server"])) {echo $rowSD["host_server"];}?></h4>

								<label class="lcserver" style="font-size:10px;">Primary IP</label>											
								<h4 class="stats-type1 mfcserver2"><?php if(isset($rowSD["primary_ip"])) {echo $rowSD["primary_ip"];}?></h4>
																			
								<div class="stats-meta text-success mfcserver3">
									<span class="badge <?php echo $stat;?>"><?php if(isset($rowSD["power_status"])) {echo $rowSD["power_status"];}?></span>
								</div>
							</div>
																	
							<!-- <a class="app-card-link-mask" href="#"></a> -->
						</div>
						<?php } ?>
					</div>					
				</div>
			<!-- ================================================================================================================ -->
			<?php } ?>


			</div>
		</div>
	</div>
	