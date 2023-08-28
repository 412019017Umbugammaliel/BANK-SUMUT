	<body>
		<div class="limiter">
			<div class="container-login100">
				<div class="row wrap-login100 ml-1 mr-1 mt-1 mb-1">
					<div class="row mt-3 mb-2">
						<span class="login100-form-title">
							Device verification
						</span>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6 set-logo-login js-tilt">
							<div class="login100-pic" data-tilt>
								<img src="<?php echo base_url();?>/assets/images/banksumut.png" alt="IMG">
							</div>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6 set-form-login">
							<form class="config-form settings-form" action="<?php echo base_url('twoVerify') ?>" method="POST">
								<?= csrf_field(); ?>
								<?php 
									$alertError = session()->getFlashdata('error');
									if (isset($alertError)){ 
								?>
										<div class="alert alert-danger" role="alert" id="alertBox">
											<?php echo $alertError; ?>
										</div>					
								<?php } ?>

								<div class="wrap-input100 size-font text-center mt-3 pl-05 pr-05">
									<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
										<path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2H2Zm-2 9.8V4.698l5.803 3.546L0 11.801Zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586l-1.239-.757ZM16 9.671V4.697l-5.803 3.546.338.208A4.482 4.482 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671Z"/>
										<path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034v.21Zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791Z"/>
									</svg>
									<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-phone-fill" viewBox="0 0 16 16">
										<path d="M3 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V2zm6 11a1 1 0 1 0-2 0 1 1 0 0 0 2 0z"/>
									</svg>
									<p class="fontOtpReg">
										We just sent your authentication code via ......... to .........
									</p>                 
									<span>This OTP code will expire in 5 minutes!</span>
								</div>

								<div class="wrap-input100 validate-input mt-3" data-validate="OTP Code is required">						
									<input class="input100" type="text" id="otp-input" name="otp-input" placeholder="Device Verification Code " value="<?php echo session()->get('otp');?>">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock-fill" viewBox="0 0 16 16">
											<path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2z"/>
										</svg>
									</span>					
								</div>
								

								<div class="container-form-btn">
									<button class="login100-form-btn">
										Verify
									</button>
								</div>

								<div class="text-center p-t-12">
									<span class="txt1">												
										<a class="txt2" href="<?php echo base_url('reOtp'); ?>">
											Re-send the OTP code
										</a>
									</span>
								</div>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="set-footer-login footer-login mt-2 mb-3">
							<span>© 2023 Copyright:<a class="text-black" href="https://teknacloud.id/"> PT. Tekna Digital Informatika</a></span>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</body>
</html>