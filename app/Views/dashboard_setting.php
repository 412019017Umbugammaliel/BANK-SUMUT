    <div class="app-wrapper">	
        <!--app-content-->    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
            <!--container-fluid-->
		    <div class="container-xl">			    
			    <h1 class="app-page-title">Settings</h1>
			    <hr class="mb-4"> 

				<div class="row g-4 settings-section">
	                <div class="col-12 col-md-4">
		                <h3 class="section-title">Themes</h3>
		                <div class="section-intro">....</div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-account app-card-settings shadow-sm p-4">
						    <div class="app-card-body">
								<?php
									$colorSelected = session()->get('themes');
									if($colorSelected == 'green_light'){ 
										$selectedGreen = 'selected';
										$selectedBlue = NULL;
									}else if($colorSelected == 'blue_light'){
										$selectedGreen = NULL;
										$selectedBlue = 'selected';
									}else{
										$selectedGreen = 'selected';
										$selectedBlue = NULL;
									}

								?>
							    <form class="settings-form" action="<?php echo site_url('themes')?>" method="POST">
								    <div class="form-select-holder mb-3">
										<label class="form-check-label">Color Themes</label>
										<select class="form-select" name="themes" id="themes">
											<option value="blue_light" <?php echo $selectedBlue?>>Blue</option>
											<option value="green_light" <?php echo $selectedGreen?>>Green</option>
										</select> 
									</div>									
									<div class="mt-3">
									    <button type="submit" class="btn app-btn-primary" >Save Changes</button>
									</div>
							    </form>
						    </div>						    
						</div>
	                </div>
                </div>
			    <hr class="my-4">
			</div>
		</div>
	</div>
	   