	<body>
		<div class="limiter">
			<div class="container-login100">
				<div class="row wrap-login100 ml-1 mr-1 mt-1 mb-1">
					<div class="row mt-3 mb-3">
						<span class="login100-form-title">
							Login Cloud Bank Sumut
						</span>
					</div>

					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6 set-logo-login js-tilt" data-tilt>
							<div class="login100-pic">
								<img src="<?php echo base_url();?>/assets/images/banksumut.png" alt="IMG">
							</div>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6 set-form-login">							
							<form class="config-form settings-form" action="<?php echo base_url('login') ?>" method="POST">
								<?= csrf_field(); ?>
								<?php 
									$alertError = session()->getFlashdata('error');									
									if ($alertError){ 
								?>
									<div class="alert alert-danger" role="alert" id="alertBox">
										<?php echo $alertError; ?>
									</div>
								<?php } ?>							

								<div class="wrap-input100 validate-input mr-top-1" data-validate="Email is required">
									<input class="input100" type="text" name="email" placeholder="Email">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="fa fa-envelope" aria-hidden="true"></i>
									</span>
								</div>
								<div class="wrap-input100 validate-input" data-validate="Password is required">						
									<input class="input100" type="password" id="password-input" name="password" placeholder="Password">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="fa fa-lock" aria-hidden="true"></i>
									</span>
								
									<div class="col-2 add-i-show-hide-pass" id="hidePass" style="display:none;">	
										<a onclick="hideShow()" >					
											<svg  xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
												<path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
												<path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
												<path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
											</svg>
										</a>
									</div>
									<div class="col-2 add-i-show-hide-pass" id="showPass" style="display:flex;">
										<a onclick="hideShow()">
											<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
												<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
												<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
											</svg>
										</a>
									</div>
								</div>
								

								<div class="container-login100-form-btn">
									<button class="login100-form-btn">
										Login
									</button>
								</div>

								<div class="text-center p-t-12">
									<span class="txt1">
										Forgot						
									<a class="txt2" href="#">
										Email / Password?
									</a>
									</span>
								</div>
							</form>
						</div>
					</div>

					<div class="row">
						<div class="set-footer-login footer-login mt-3 mb-3">
							<span>© 2023 Copyright:<a class="text-black" href="https://teknacloud.id/"> PT. Tekna Digital Informatika</a></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="<?php echo base_url();?>/assets/plugins/jQuery/jquery-3.6.3.min.js"></script>

		
		<script>
			// MENAMPILKAN DAN MENYEMBUNYIKAN PASSWORD.
			var hidePass = document.getElementById('hidePass');
			var showPass = document.getElementById('showPass');
			
			function hideShow(){
				if(hidePass.style.display == "none"){
					hidePass.style.display = "flex";
					showPass.style.display = "none"
					$('#password-input').attr('type', 'text');
					
				}else{
					hidePass.style.display = "none";
					showPass.style.display = "flex";				
					$('#password-input').attr('type', 'password');
				}
			}
			// EFFEK DARI ALERT.
			$(document).ready(function() {				
				// $("#alertBox").hide();
				// 	$("#alertBox").fadeTo(2000, 500).slideUp(500, function() {
				// 	$("#alertBox").slideUp(1000);
				// });
			});
		</script>
	</body>
</html>