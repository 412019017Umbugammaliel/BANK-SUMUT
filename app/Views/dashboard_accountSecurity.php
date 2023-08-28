    <div class="app-wrapper"> 
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">			    
                <h1 class="app-page-title">My Account</h1>

<!-- LINE 1 =============================================================================================================================================================== -->
                <div class="row py-3">                    
                    <div class="col-12 col-md-12 col-lg-12">                       
                        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">                                                       
                          <!-- Card Header --> 
                            <div class="col-12">
                                <div class="app-card-header p-3">
                                    <div class="row align-items-center gx-3">
                                        <!-- Icon Profile -->
                                        <div class="col-auto">                                        
                                            <div class="app-icon-holder">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                </svg>
                                            </div>						                
                                        </div>   
                                        <!-- End Icon Profile -->                             
                                        <!-- Title Profile -->
                                        <div class="col-auto">
                                            <h4 class="app-card-title">Profile</h4>
                                        </div>
                                        <!-- End Title Profile -->
                                    </div>
                                </div>
                            </div>
                          <!-- End Card Header -->  
                            <div class="app-card-body px-4 w-100"> 
                                <div class="row"> 
  <!-- LEFT PHOTO ( FROM PHOTO ) ========================================================================================================================================== -->
                                    <div class="col-sm-12 p-3 col-md-3 col-lg-3"> 
                                        <div class="item">
                                            <div class="row justify-content-between align-items-center">     
                                                <div class="col-auto pxy">
                                                    <div class="row">
                                                        <div class="col-10 item-label mb-2"><strong>Photo</strong></div>
                                                        <div class="col-2 text-end" id="btn_closeIP" style="display:none;">
                                                            <a class="" onclick="closeBtnIP()" data-toggle="tooltip" title="Cancel">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="item-data position">
                                                        <?php 
                                                            
                                                            foreach($profile as $rowProfile){ 
                                                                // Cek apakah file image ada didalam directory.
                                                                $imgSrc = file_exists('assets/images/users/'.$rowProfile["foto"]);                                                              
                                                                // Kondisi apabila belum ada foto yang diupload ke database oleh pengguna.                                                              
                                                                if(empty($rowProfile['foto'])){
                                                                    $photoProfile = "user-default.png";
                                                                }else if(empty($imgSrc)){
                                                                $photoProfile = "user-broken-default.png";
                                                                }else if(isset($rowProfile['foto'])){
                                                                    $photoProfile = $rowProfile['foto'];
                                                                }
                                                        ?>  <!-- Menampilkan foto profile yang ada di database -->
                                                            <img class="profile-image-account rounded-circle pictureSize" id="PhotoProfile" name="PhotoProfile" src="assets/images/users/<?php echo $photoProfile;?>" alt="Photo Profile" onerror="this.src='assets/images/users/user-broken-default.png'">
                                                        <?php } ?>
                                                        <!-- Form upload/ update foto profile -->
                                                        <form action="<?php echo base_url('UpdatePhoto')?>" method="post" name="upload_image_form"  id="upload_image_form" enctype="multipart/form-data" accept-charset="utf-8">
                                                        <?= csrf_field(); ?>
                                                            <!--Icon Edit Camera-->
                                                            <div class="col text-end height-0"  id="btnChangePhoto" style="display:block;">
                                                                <input type="file" name="foto" id="foto" class="inputfile"/>
                                                                <label class="height-0" for="foto">
                                                                    <figure>
                                                                        <a class="btn-edit3" onclick="changePhoto()" data-toggle="tooltip" title="Change profile photo">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                                                                                <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                                                <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                                                                            </svg>
                                                                        </a>
                                                                    </figure>
                                                                </label>
                                                            </div>
                                                            <!-- Icon Save -->
                                                            <div class="col text-end height-0" onclick="validatePP()" id="btnSavefirst_name" style="display:none;">
                                                                <a class="btn-edit3" data-toggle="tooltip" title="Save your photo">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-save2-fill" viewBox="0 0 16 16">
                                                                        <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v6h-2a.5.5 0 0 0-.354.854l2.5 2.5a.5.5 0 0 0 .708 0l2.5-2.5A.5.5 0 0 0 10.5 7.5h-2v-6z"/>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                            <!-- Tombol submit di set none, agar tidak muncul dihalaman dashboard. -->
                                                            <button type="submit" id="submit" name="submit" style="display:none;"></button> 
                                                        </form>
                                                        <!--End Form upload/ update foto profile -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
  <!-- END LEFT PHOTO ( FROM PHOTO ) ====================================================================================================================================== -->
  <!-- RIGHT FORM ( FORM FIRST & LAST NAME ) ============================================================================================================================== -->
                                    <div class="col-sm-12 col-md-9 col-lg-9">
                                        <div class="row">
                                            <!-- FIRST NAME -->
                                            <div class="col-6">
                                                <div class="item border-bottom py-1 pt-3 my-0">
                                                    <div class="row justify-content-between align-items-center">
                                                        <!-- Condition View 1 -->
                                                        <?php                                                           
                                                            foreach($profile as $rowProfile){ ?>
                                                        <div class="col-auto col-10 firstView" id="first_name_x" style="display:block;">
                                                            <div class="item-label"><strong>First Name</strong></div>                                                           
                                                            <div class="item-data my-custom"><?php if(isset($rowProfile['first_name'])){echo $rowProfile['first_name'];}?></div>
                                                        </div>
                                                        <?php }?>
                                                        <!--Icon Edit-->
                                                        <div class="col-2 text-end"  id="btn_first_name_x" style="display:block;">
                                                            <a class="btn-edit2" onclick="changeFirstName()" data-toggle="tooltip" title="Change first name">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">                                                                
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                            </svg>
                                                            </a>
                                                        </div> 
                                                            
                                                        <!-- End Condition View 1 -->
                                                        <!-- Condition View 2 -->
                                                        <div class="col-10 secondView" id="first_name_y" style="display:none;">
                                                            <div class="item-label"><strong>First Name</strong></div>
                                                            <div class="item-data form-group" style="width: 100%;">
                                                                <input class="form-control" type="text" id="FirstName" name="FirstName" style="width:100%;" placeholder="<?php if(isset($rowProfile['first_name'])) {echo $rowProfile['first_name'];} ?>"/>
                                                            </div>
                                                        </div>
                                                        <!--Icon Save-->
                                                        <div class="col-2" id="btn_first_name_y" style="display:none;">
                                                            <div class="row">
                                                                <div class="col-12 text-end" id="btn_close" style="display:block;">
                                                                    <a class="btn-close1" onclick="closeBtn()" data-toggle="tooltip" title="Cancel">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                                                    </svg>
                                                                    </a>
                                                                </div>
                                                                <div class="col-12 text-end" >
                                                                    <a class="btn-edit5" onclick="validateFN()" data-toggle="tooltip" title="Save changes">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-save2-fill" viewBox="0 0 16 16">
                                                                            <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v6h-2a.5.5 0 0 0-.354.854l2.5 2.5a.5.5 0 0 0 .708 0l2.5-2.5A.5.5 0 0 0 10.5 7.5h-2v-6z"/>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>    
                                                        <!-- End Condition View 2 -->
                                                    </div>
                                                </div> 
                                            </div>
                                            <!-- End FIRST NAME -->  
                                                                                
                                            
                                            <!-- LAST NAME -->
                                            <div class="col-6">
                                                <div class="item border-bottom py-1 pt-3 my-0">
                                                    <div class="row justify-content-between align-items-center">
                                                        <!-- Condition View 1 -->
                                                        <?php foreach($profile as $rowProfile){ ?>
                                                        <div class="col-auto col-10 firstView" id="last_name_x" style="display:block;">
                                                            <div class="item-label"><strong>Last Name</strong></div>
                                                            <div class="item-data my-custom"><?php if(isset($rowProfile['last_name'])) {echo $rowProfile['last_name'];} ?></div>
                                                        </div>
                                                        <?php } ?>
                                                        <!--Icon Edit-->
                                                        <div class="col-2 text-end" id="btn_last_name_x" style="display:block;">
                                                            <a class="btn-edit2" onclick="changeLastName()" data-toggle="tooltip" title="Change last name">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <!-- End Condition View 1 -->
                                                        <!-- Condition View 2 -->
                                                        <div class="col-10 secondView" id="last_name_y" style="display:none;">
                                                            <div class="item-label"><strong>Last Name</strong></div>
                                                            <div class="item-data form-group">
                                                                <input class="form-control" type="text" id="LastName" name="LastName" style="width:100%;" placeholder="<?php if(isset($rowProfile['last_name'])) {echo $rowProfile['last_name'];} ?>"/>
                                                            </div>
                                                        </div>
                                                        <!--Icon Save-->
                                                        <div class="col-2" id="btn_last_name_y" style="display:none;">
                                                            <div class="row">
                                                                <div class="col-12 text-end" id="btn_close" style="display:block;">
                                                                    <a class="btn-close1" onclick="closeBtn()" data-toggle="tooltip" title="Cancel">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                                                    </svg>
                                                                    </a>
                                                                </div>
                                                                <div class="col-12 text-end" >
                                                                    <a class="btn-edit5" onclick="validateLN()" data-toggle="tooltip" title="Save changes">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-save2-fill" viewBox="0 0 16 16">
                                                                            <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v6h-2a.5.5 0 0 0-.354.854l2.5 2.5a.5.5 0 0 0 .708 0l2.5-2.5A.5.5 0 0 0 10.5 7.5h-2v-6z"/>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                        <!-- End Condition View 2 -->
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- End LAST NAME -->                                         
                                        </div>
  <!-- END RIGHT FORM ( FORM FIRST & LAST NAME ) ========================================================================================================================== -->                                     
  <!-- RIGHT FORM ( VIEW & EDIT EMAIL ) =================================================================================================================================== -->                                      
                                        <div class="item border-bottom py-1 my-3">
                                            <div class="row justify-content-between align-items-center">
                                                <!-- Condition View 1 -->
                                                <?php  foreach($profile as $rowProfile){ ?>
                                                <div class="col-auto col-10 firstView-1" id="email_x" style="display:block;">
                                                    <div class="item-label"><strong>Email</strong></div>
                                                    <div class="item-data my-custom"><?php if(isset($rowProfile['user_email'])) {echo $rowProfile['user_email'];} ?></div>
                                                </div>
                                                <?php } ?>
                                                <!--Icon Edit-->
                                                <div class="col-2 text-end" id="btn_email_x" style="display:block;">
                                                    <a class="btn-edit2a" onclick="changeEmail()" data-toggle="tooltip" title="Change email">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <!-- End Condition View 1 -->
                                                <!-- Condition View 2 -->
                                                <div class="col-10 secondView-1" id="email_y" style="display:none;">
                                                    <div class="item-label"><strong>Email</strong></div>
                                                    <div class="item-data form-group">
                                                        <input class="form-control" type="email" id="Email" name="Email" style="width:100%;" placeholder="<?php if(isset($rowProfile['user_email'])) {echo $rowProfile['user_email'];} ?>"/>
                                                    </div>
                                                </div>
                                                <!--Icon Save-->
                                                <div class="col-2" id="btn_email_y" style="display:none;">
                                                    <div class="row">
                                                        <div class="col-12 text-end" id="btn_close" style="display:block;">
                                                            <a class="btn-close1a" onclick="closeBtn()" data-toggle="tooltip" title="Cancel">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                                            </svg>
                                                            </a>
                                                        </div>
                                                        <div class="col-12 text-end" >
                                                            <a class="btn-edit5a" onclick="validateE()" data-toggle="tooltip" title="Save changes">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-save2-fill" viewBox="0 0 16 16">
                                                                    <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v6h-2a.5.5 0 0 0-.354.854l2.5 2.5a.5.5 0 0 0 .708 0l2.5-2.5A.5.5 0 0 0 10.5 7.5h-2v-6z"/>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Condition View 2 -->
                                            </div>
                                        </div>
  <!-- END RIGHT FORM ( VIEW & EDIT EMAIL ) =============================================================================================================================== -->
  <!-- RIGHT FORM ( VIEW & EDIT PHON NUMBER ) ============================================================================================================================= -->
                                        <div class="item border-bottom py-1 my-3">
                                            <div class="row justify-content-between align-items-center">
                                                <!-- Condition View 1 -->
                                                <?php foreach($profile as $rowProfile){ ?>
                                                <div class="col-auto col-10 firstView-1" id="phone_number_x" style="display:block;">
                                                    <div class="item-label"><strong>Phone Number</strong></div>
                                                    <div class="item-data my-custom" class="Phone"><?php if(isset($rowProfile['user_phone'])) {echo $rowProfile['user_phone'];} ?></div>
                                                </div>
                                                <?php } ?>
                                                <!--Icon Edit-->
                                                <div class="col-2 text-end" id="btn_phone_number_x" style="display:block;">
                                                    <a class="btn-edit2a" onclick="changePhoneNumber()" data-toggle="tooltip" title="Change phone number">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <!-- End Condition View 1 -->
                                                <!-- Condition View 2 -->
                                                <div class="col-10 secondView-1" id="phone_number_y" style="display:none;">
                                                    <div class="item-label"><strong>Phone Number</strong></div>
                                                    <div class="item-data  form-group">
                                                        <input class="form-control" type="tel" pattern="[0-9]" id="Phone" name="Phone" style="width:100%;" onkeypress="return hanyaAngka(event)" placeholder="<?php if(isset($rowProfile['user_phone'])) {echo $rowProfile['user_phone'];} ?>">
                                                    </div>
                                                </div>
                                                <!--Icon Save-->
                                                <div class="col-2" id="btn_phone_number_y" style="display:none;">
                                                    <div class="row">
                                                        <div class="col-12 text-end" id="btn_close" style="display:block;">
                                                            <a class="btn-close1a" onclick="closeBtn()" data-toggle="tooltip" title="Cancel">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                                            </svg>
                                                            </a>
                                                        </div>
                                                        <div class="col-12 text-end" >
                                                            <a class="btn-edit5a" onclick="validatePN()" data-toggle="tooltip" title="Save changes">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-save2-fill" viewBox="0 0 16 16">
                                                                    <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v6h-2a.5.5 0 0 0-.354.854l2.5 2.5a.5.5 0 0 0 .708 0l2.5-2.5A.5.5 0 0 0 10.5 7.5h-2v-6z"/>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Condition View 2 -->
                                            </div>
                                        </div>
                                    </div>
  <!-- END RIGHT FORM ( VIEW & EDIT PHON NUMBER ) ========================================================================================================================= -->       
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!-- END LINE 1 =========================================================================================================================================================== -->

<!-- LINE 2 =============================================================================================================================================================== -->
                <div class="row py-3">
                    <div class="col-12 col-md-12 col-lg-12">                      
                        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start"> 
                            <div class="col-12">                      
                                <div class="app-card-header p-3">
                                    <div class="row align-items-center gx-3">

                                      <!-- Icon Profile -->
                                        <div class="col-auto">                                        
                                            <div class="app-icon-holder">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-shield-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M5.443 1.991a60.17 60.17 0 0 0-2.725.802.454.454 0 0 0-.315.366C1.87 7.056 3.1 9.9 4.567 11.773c.736.94 1.533 1.636 2.197 2.093.333.228.626.394.857.5.116.053.21.089.282.11A.73.73 0 0 0 8 14.5c.007-.001.038-.005.097-.023.072-.022.166-.058.282-.111.23-.106.525-.272.857-.5a10.197 10.197 0 0 0 2.197-2.093C12.9 9.9 14.13 7.056 13.597 3.159a.454.454 0 0 0-.315-.366c-.626-.2-1.682-.526-2.725-.802C9.491 1.71 8.51 1.5 8 1.5c-.51 0-1.49.21-2.557.491zm-.256-.966C6.23.749 7.337.5 8 .5c.662 0 1.77.249 2.813.525a61.09 61.09 0 0 1 2.772.815c.528.168.926.623 1.003 1.184.573 4.197-.756 7.307-2.367 9.365a11.191 11.191 0 0 1-2.418 2.3 6.942 6.942 0 0 1-1.007.586c-.27.124-.558.225-.796.225s-.526-.101-.796-.225a6.908 6.908 0 0 1-1.007-.586 11.192 11.192 0 0 1-2.417-2.3C2.167 10.331.839 7.221 1.412 3.024A1.454 1.454 0 0 1 2.415 1.84a61.11 61.11 0 0 1 2.772-.815z"/>
                                                    <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                                </svg>
                                            </div>						                
                                        </div>   
                                      <!-- End icon Profile --> 

                                      <!-- Title Profile -->
                                        <div class="col-auto">
                                            <h4 class="app-card-title">Security</h4>
                                        </div>
                                      <!-- End title Profile -->

                                    </div>
                                </div>

                                <!-- End App Card Header --> 
                                <!-- App Card Body --> 

                                <div class="app-card-body px-4 w-100">

                                  <!-- Password -->
                                    <div class="item border-bottom py-1 my-3">
                                        <div class="row justify-content-between align-items-center"> 

                                          <!-- Condition View 1 -->
                                            <div class="col-auto col-10 firstView-1" id="password_x" style="display:block; margin-bottom:9.6px;">
                                                <div class="item-label"><strong>Password</strong></div>
                                                <div class="item-data my-custom-1">Change password here, this action requires you to relogin!</div> 
                                            </div>
                                            <!--Icon Edit-->
                                            <div class="col-2 text-end" id="btn_password_x" style="display:block;">
                                                <a class="btn-edit2a" onclick="changePassword()" data-toggle="tooltip" title="Changes passwords">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                    </svg>
                                                </a>
                                            </div>                            
                                          <!-- End Condition View 1 -->

                                          <!-- Condition View 2 -->
                                            <div class="col-10 secondView-1">
                                                <div class="row">
                                                    <div class="col-6" id="password_y" style="display:none;">                                           
                                                        <div class="item-label"><strong>New Password</strong></div>                                            
                                                        <div class="item-data form-group">
                                                            <input class="form-control" type="text" id="NewPassword" name="NewPassword" style="width:100%;" placeholder="**********"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-6" id="confirm_password_y" style="display:none;">
                                                        <div class="item-label"><strong>Confirm Password</strong></div>                                            
                                                        <div class="item-data form-group">
                                                            <input class="form-control" type="text" id="ConfirmPassword" name="ConfirmPassword" style="width:100%;" placeholder="**********">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="row">
                                                    <div class="col-12 text-end" id="btn_closePW" style="display:none;">
                                                        <a class="btn-close1b" onclick="cancelChangePassword()" data-toggle="tooltip" title="Cancel">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                                        </svg>
                                                        </a>
                                                    </div>
                                                    <div class="col-12 text-end" id="btn_password_y" style="display:none;">
                                                        <a class="btn-edit5a" onclick="validatePW()" data-toggle="tooltip" title="Save changes">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-save2-fill" viewBox="0 0 16 16">
                                                                <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v6h-2a.5.5 0 0 0-.354.854l2.5 2.5a.5.5 0 0 0 .708 0l2.5-2.5A.5.5 0 0 0 10.5 7.5h-2v-6z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                          <!-- End Condition View 1 -->

                                        </div>
                                    </div> 
                                  <!-- End Password -->

                                  <!-- Two-Factor Authentication -->
                                    <div class="item border-bottom py-1 my-3">
                                        <div class="row justify-content-between align-items-center">

                                          <!-- Condition View 1 ============================================================================= -->
                                            <div class="col-auto col-9" id="label_2_verification" style="display:block; margin-bottom:9.6px;">
                                                <div class="item-label"><strong>Two-Factor Authentication</strong></div>
                                                <div class="item-data my-custom-1">You haven't set up two-factor authentication. </div>
                                            </div>
                                            <div class="col-3 text-end" id="btn_setup_2_verification" >
                                                <button class="btn-sm app-btn-secondary btn-get-otp pl-04" id="btn_cencel_setup" style="display:none;" onclick="cancelOptionForOTP()">Cancel</button>
                                                <button class="btn-sm app-btn-secondary btn-get-otp" id="btn_setup" style="display:block;" onclick="showOptionForOTP()">Set up</button>
                                            </div>
                                          <!-- End Condition View 1 ========================================================================= --> 
                                            
                                          <!-- Condition View 2 ============================================================================= -->
                                            <form class="settings-form" id="optionForOTP" style="display:none;">
                                                <div class="row container-box mt-2 mb-2">
                                                    <div class="col-auto col-12 box-custome" >              
                                                        <div class="form-check form-switch mt-2">
                                                            <input class="form-check-input" type="checkbox" id="2FactorSMS" onclick="uncheckEmail()">
                                                            <label class="form-check-label" >Short message service (SMS)</label>
                                                        </div>
                                                        <div class="form-check form-switch mt-1">
                                                            <input class="form-check-input" type="checkbox" id="2FactorEmail" onclick="uncheckSms()">
                                                            <label class="form-check-label" >Elektronic Mail (Email)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>                                            
                                          <!-- End Condition View 2 ============================================================================= -->
                                            
                                          <!-- Condition Option 1 ============================================================================= -->
                                            <div class="col-9" id="sms_get_otp" style="display:none; margin-bottom:9.6px;">                                                 
                                                <div class="item-label">Register your phone number, to receive an OTP code.</div>
                                                <div class="row my-custom-1">                                           
                                                    <div class="col-auto item-data form-group pr-0 w-mw-1">
                                                        <select class="form-control form-select" id="Country_ID_Num " name="Country_ID_Num" style="width:100%;">                                                        
                                                            <option value="" selected>ID</option>
                                                            <option value="1">+1</option>
                                                            <option value="2">+2</option>
                                                            <option value="3">+3</option>
                                                            <option value="4">+4</option>
                                                            <option value="62">+62</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-auto item-data form-group pr-0 w-mw-2">
                                                        <input class="form-control" type="text" id="WhatsappNum" name="WhatsappNum" style="width:100%;" placeholder="62811xxxxxx">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3 text-end" id="sms_get_otp_1" style="display:none;">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button id="register_phoneNumbers" class="btn-sm app-btn-secondary btn-get-otp-1a pl-03">Register</button>
                                                    </div>
                                                </div>
                                            </div>                                           
                                          <!-- End Condition Option 1 ========================================================================= --> 
                                          
                                          <!-- Condition Option 2 ============================================================================= -->
                                            <div class="col-9" id="email_get_otp" style="display:none; margin-bottom:9.6px;">                                                 
                                                <div class="item-label">Register your email address, to receive an OTP code.</div>
                                                <div class="row my-custom-1">
                                                    <div class="col-auto item-data form-group pr-0" style="width:100%;">
                                                        <input class="form-control" type="text" id="emailAddress" name="emailAddress" style="width:100%;" placeholder="your_email@gmail.com">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3 text-end" id="email_get_otp_1" style="display:none;">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button id="register_emailAddress" class="btn-sm app-btn-secondary btn-get-otp-1a pl-03">Register</button>
                                                    </div>
                                                </div>
                                            </div>                                           
                                          <!-- End Condition Option 2 ========================================================================= --> 
                                        
                                        </div>
                                    </div>
                                  <!-- End Two-Factor Authentication -->

                                </div>
                            </div>                            						   
                        </div>
                    </div>
                </div>
<!-- END LINE 2 =========================================================================================================================================================== -->
            
            </div>
        </div>
    </div>
	    

<script>     
  // Automatic logout function, after changing password =======================
    // Menangkap session yang di buat saat user mengganti password.
    var autoLogout = "<?php if(!empty(session()->getFlashdata('automaticLogout'))) { echo session()->getFlashdata('automaticLogout'); } ?>"; 
    // Menjalankan fungsi autoLogOut(), apabila session berisi "logoutNow".
    if(autoLogout == "logoutNow"){
        autoLogOut();
    };
    function autoLogOut(){ 
        Swal.fire({
            title: 'Auto Logout!',
            html: 'Password changed <b style="color:#20c997;">successfully</b>!<br>The system will be closed in <strong></strong> seconds, please log in again',
            timer: 5000,
            allowOutsideClick: false,
            didOpen: () => {
                const content = Swal.getHtmlContainer()
                const $ = content.querySelector.bind(content)          

                Swal.showLoading()

                function toggleButtons () {
                stop.disabled = !Swal.isTimerRunning()
                resume.disabled = Swal.isTimerRunning()
                }
                // Penghitung waktu mundur di set 5000 md atau 5 detik
                timerInterval = setInterval(() => {
                    content.querySelector('strong')
                    .textContent = (Swal.getTimerLeft() / 1000)
                    .toFixed(0)
                }, 100)
            },
            willClose: () => {
                window.location.href='<?php echo base_url("logout")?>';
            }
        })  
    };
  //===========================================================================

  // Alert Success or Error update ============================================
    var notifUpdate = "<?php if(!empty(session()->getFlashdata('notif'))) { echo session()->getFlashdata('notif'); } ?>"; // Menangkap isi dari session notif.
    if(notifUpdate == ""){ // Apabila notifUpdate 
        // Tidak ada tindakan.
    }else{        
        if(notifUpdate == "trueFName"){
            var title = "success";
            var icon = "success";
            var massage = "First name changed successfully!";
        }else if(notifUpdate == "trueLName"){
            var title = "success";
            var icon = "success";
            var massage = "Last name changed successfully!";
        }else if(notifUpdate == "trueEmail"){
            var title = "success";
            var icon = "success";
            var massage = "Email changed successfully!";
        }else if(notifUpdate == "truePhone"){
            var title = "success";
            var icon = "success";
            var massage = "Phone number changed successfully!";
        }else if(notifUpdate == "falseUpdate"){
            var title = "error";
            var icon = "error";
            var massage = "Data failed to update!";
        }
        swal.fire({
            title: title,
            text: massage,
            icon: icon,
            timer: 3000
        });
    }
  //===========================================================================

  // Declare variable =========================================================
    // Image Profile
    var iconBtn_x = document.getElementById("btnChangePhoto");
    var iconBtn_y = document.getElementById("btnSavefirst_name"); 
    var btn_closeIP = document.getElementById('btn_closeIP');
    // First Name
    var first_name_x = document.getElementById("first_name_x");
    var first_name_y = document.getElementById("first_name_y");
    var btn_first_name_x = document.getElementById("btn_first_name_x");
    var btn_first_name_y = document.getElementById("btn_first_name_y");
    // Last Name
    var last_name_x = document.getElementById("last_name_x");
    var last_name_y = document.getElementById("last_name_y");
    var btn_last_name_x = document.getElementById("btn_last_name_x");
    var btn_last_name_y = document.getElementById("btn_last_name_y");
    // Email
    var email_x = document.getElementById("email_x");
    var email_y = document.getElementById("email_y");
    var btn_email_x = document.getElementById("btn_email_x");
    var btn_email_y = document.getElementById("btn_email_y");
    // Phone Number
    var phone_number_x = document.getElementById("phone_number_x");
    var phone_number_y = document.getElementById("phone_number_y");
    var btn_phone_number_x = document.getElementById("btn_phone_number_x");
    var btn_phone_number_y = document.getElementById("btn_phone_number_y");
    // Password   
    var password_x = document.getElementById("password_x");
    var btn_password_x = document.getElementById("btn_password_x");
    var password_y = document.getElementById("password_y");
    var confirm_password_y = document.getElementById("confirm_password_y"); 
    var btn_closePW = document.getElementById("btn_closePW");                         
    var btn_password_y = document.getElementById("btn_password_y");    
    // Two Faktor Verification
    var label_2_ver = document.getElementById("label_2_verification");
    var btn_label_2_ver = document.getElementById("btn_setup_2_verification");
    var get_otp = document.getElementById("get_otp");
    var btn_get_otp = document.getElementById("btn_get_otp");                          
    var submit_otp = document.getElementById("submit_OTP");
    var btn_submit_otp = document.getElementById("btn_submit_OTP");
    // Get OTP Code
    var FactorEmail =  document.getElementById("2FactorEmail");
    var FactorSms = document.getElementById("2FactorSMS");
    var btn_cencel_setup = document.getElementById('btn_cencel_setup');
    var btn_setup = document.getElementById('btn_setup');
    var optionForOTP = document.getElementById('optionForOTP');
    var sms_get_otp = document.getElementById('sms_get_otp');
    var sms_get_otp_1 = document.getElementById('sms_get_otp_1');
    var email_get_otp = document.getElementById('email_get_otp');
    var email_get_otp_1 = document.getElementById('email_get_otp_1');
  //===========================================================================

  // Image Profile (Menampilkan gambar sebelum disimpan) ======================
    // Menampilkan gambar yang dipilih untuk di update.
        // var tm_pilih = document.getElementById('foto');
        // var file = document.getElementById('foto');
        // tm_pilih.addEventListener('click', function () {
        //     file.click();
        // })
        // file.addEventListener('change', function () {
        //     gambar(this);
        // })
        // function gambar(a) {
        //     if (a.files && a.files[0]) {     
        //         var reader = new FileReader();    
        //         reader.onload = function (e) {
        //             document.getElementById('PhotoProfile').src=e.target.result;
        //         }    
        //         reader.readAsDataURL(a.files[0]);
        //     }
        // }
  //===========================================================================

  // Image Profile ============================================================
    // Fungsi untuk mengganti element dari label menjadi input text dengan bermain pada style display (none dan block) css.
    function changePhoto(){        
        btn_closeIP.style.display ="block";
        iconBtn_x.style.display = "none";
        iconBtn_y.style.display = "block";        
    }
    function validatePP(){// Alert for confirmation action.
        swal.fire({
            title: "Are you sure?",
            text: "You want to change the image.",
            icon: "warning",													
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Save!'
        })
        .then((result) => {
            if (result.isConfirmed){ // Jika tombol confirm di klik, maka jalankan fungsi dibawah.
                setInterval(function(){ // Melakukan proses klik tombol submit otomatis dengan interval waktu 100md / 0.1d.
                    document.getElementById('submit').click(); // Melakukan proses click pada tombol dengan id submit.
                }, 100); // Mengatur interval waktu.
            }
            if(result.isDismissed){ // Kondisi jika tombol cancel yang di klik, maka ubah kembali button save menjadi button camera, dengan mengatur style display (none dan block).
                var iconBtn_x = document.getElementById("btnChangePhoto");
                var iconBtn_y = document.getElementById("btnSavefirst_name");
                iconBtn_x.style.display = "block";
                iconBtn_y.style.display = "none";
                // var oldImage = "assets/images/users/<?php //echo $photoProfile;?>";
                // document.getElementById('PhotoProfile').src=oldImage;
            }
        });
    }
  //===========================================================================
  
  // First Name ===============================================================
    // Fungsi untuk mengganti element dari label menjadi input text dengan bermain pada style display (none dan block) css.
    function changeFirstName(){  
        // First Name
        first_name_x.style.display = "none";
        btn_first_name_x.style.display = "none";
        first_name_y.style.display = "block";
        btn_first_name_y.style.display = "block";
        // Last Name
        last_name_x.style.display = "block";
        btn_last_name_x.style.display = "block";
        last_name_y.style.display = "none";
        btn_last_name_y.style.display = "none";
        // Email
        email_x.style.display = "block";
        btn_email_x.style.display = "block";
        email_y.style.display = "none";
        btn_email_y.style.display = "none";
        // Phone Number
        phone_number_x.style.display = "block";
        btn_phone_number_x.style.display = "block";
        phone_number_y.style.display = "none";
        btn_phone_number_y.style.display = "none";
        // Password
        password_x.style.display = "block";
        btn_password_x.style.display = "block";
        password_y.style.display = "none";
        confirm_password_y.style.display = "none";
        btn_closePW.style.display = "none";
        btn_password_y.style.display = "none"; 
    }
    function validateFN(){ //Alert for confirmation action.
        var dataFirstName = document.getElementById("FirstName").value; // Mengambil nilai dari input text dengan id FirstName.
        if(dataFirstName == ""){ // Alert bila input belum di isi.
            swal.fire({
                title: "Enter your first name!",
                text: "You have not entered your first name!",
                icon: "warning"
            });
        }else{ // Alert bila input sudah di isi.
            swal.fire({
                title: "Are you sure?",
                text: "You want to change the first name.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Save!'
            })
            .then((result) => {
                if (result.isConfirmed) {	// Jika tombol confirm di klik, maka jalankan fungsi dibawah.                    
                    let arrFirst = JSON.stringify({"param" : "firstname","data" : dataFirstName}); // Membuat JSON yang berisi parameter firstname dan data yang akan di update.
                    window.location.href="<?php echo base_url('Home/prosesUpdateAccountSecurity')?>/"+arrFirst; // Mengirim JSON (arr) ke controller. 
                }
                /* Kondisi jika tombol cancel yang di klik, maka ubah kembali button save menjadi button edit. */
                if(result.isDismissed){  
                    first_name_x.style.display = "block";
                    btn_first_name_x.style.display = "block";
                    first_name_y.style.display = "none"; 
                    btn_first_name_y.style.display = "none";
                }
            });
        }
    }
  //===========================================================================

  // Last Name ================================================================
    // Fungsi untuk mengganti element dari label menjadi input text dengan bermain pada style display (none dan block) css.
    function changeLastName(){     
        // First Name
        first_name_x.style.display = "block";
        btn_first_name_x.style.display = "block";
        first_name_y.style.display = "none"; 
        btn_first_name_y.style.display = "none";
        // Last Name
        last_name_x.style.display = "none";
        btn_last_name_x.style.display = "none";
        last_name_y.style.display = "block";
        btn_last_name_y.style.display = "block";
        // Email
        email_x.style.display = "block";
        btn_email_x.style.display = "block";
        email_y.style.display = "none";
        btn_email_y.style.display = "none";
        // Phone Number
        phone_number_x.style.display = "block";
        btn_phone_number_x.style.display = "block";
        phone_number_y.style.display = "none";
        btn_phone_number_y.style.display = "none";  
        // Password
        password_x.style.display = "block";
        btn_password_x.style.display = "block";
        password_y.style.display = "none";
        confirm_password_y.style.display = "none";
        btn_closePW.style.display = "none";
        btn_password_y.style.display = "none";       
    }
    function validateLN(){ //Alert for confirmation action
        var dataLastName = document.getElementById("LastName").value;	// Mengambil nilai dari input text dengan id FirstName. 
        if(dataLastName == ""){ // Alert bila input belum di isi.
            swal.fire({
                title: "Enter your last name!",
                text: "You have not entered your last name!",
                icon: "warning"
            });
        }else{ // Alert bila input sudah di isi.
            swal.fire({
                title: "Are you sure?",
                text: "You want to change the last name.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Save!'
            })
            .then((result) => {
                if (result.isConfirmed){ // Jika tombol confirm di klik, maka jalankan fungsi dibawah.                    
                    let arrLast = JSON.stringify({"param" : "lastname","data" : dataLastName}); // Membuat JSON yang berisi parameter lastname dan data yang akan di update.
                    window.location.href="<?php echo site_url('Home/prosesUpdateAccountSecurity')?>/"+arrLast; // Mengirim JSON (arr) ke controller.
                }
                if(result.isDismissed){ // Kondisi jika tombol cancel yang di klik, maka ubah kembali button save menjadi button edit.
                    last_name_x.style.display = "block";
                    btn_last_name_x.style.display = "block";
                    last_name_y.style.display = "none";
                    btn_last_name_y.style.display = "none";
                }
            });
        }
    }
  //===========================================================================

  // Email ====================================================================
    // Fungsi untuk mengganti element dari label menjadi input text dengan bermain pada style display (none dan block) css.
    function changeEmail(){
        // First Name
        first_name_x.style.display = "block";
        btn_first_name_x.style.display = "block";
        first_name_y.style.display = "none"; 
        btn_first_name_y.style.display = "none";
        // Last Name
        last_name_x.style.display = "block";
        btn_last_name_x.style.display = "block";
        last_name_y.style.display = "none";
        btn_last_name_y.style.display = "none";
        // Email
        email_x.style.display = "none";
        btn_email_x.style.display = "none";
        email_y.style.display = "block";
        btn_email_y.style.display = "block";
        // Phone Number
        phone_number_x.style.display = "block";
        btn_phone_number_x.style.display = "block";
        phone_number_y.style.display = "none";
        btn_phone_number_y.style.display = "none";
        // Password
        password_x.style.display = "block";
        btn_password_x.style.display = "block";
        password_y.style.display = "none";
        confirm_password_y.style.display = "none";
        btn_closePW.style.display = "none";
        btn_password_y.style.display = "none"; 
    }
    function validateE(){ // Alert for confirmation action. 
        var emailPattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/; // Patern untuk beberapa bentuk format email.
        var dataEmail = document.getElementById("Email").value; // Mengambil nilai dari input text dengan id FirstName.       
        if(dataEmail == ""){ // Alert apabila input belum di isi.
            swal.fire({
                title: "Enter your email!",
                text: "You have not entered your email!",
                icon: "warning"
            });
        }else{ // Alert apabila input sudah di isi.
            if(!dataEmail.match(emailPattern)){ // Alert input email tidak sesuai dengan format.
                swal.fire({
                    title: "Wrong format email!",
                    html: "Please enter an email with the format name_email@gmail.com.",
                    icon: "warning",
                });
            }else{
                swal.fire({
                    title: "Are you sure?",
                    text: "You want to change your email.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Save!'
                })
                .then((result) => {        
                    if (result.isConfirmed) {	// Jika tombol confirm di klik, maka jalankan fungsi dibawah.                        
                        let arrEmail = JSON.stringify({"param" : "email","data" : dataEmail}); // Membuat JSON yang berisi parameter lastname dan data yang akan di update.
                        window.location.href="<?php echo site_url('Home/prosesUpdateAccountSecurity')?>/"+arrEmail; // Mengirim JSON (arr) ke controller.
                    }
                    if(result.isDismissed){ // Kondisi jika tombol cancel yang di klik, maka ubah kembali button save menjadi button edit.
                        email_x.style.display = "block";
                        btn_email_x.style.display = "block";
                        email_y.style.display = "none";
                        btn_email_y.style.display = "none";
                    }                                                  
                });
            }
        }
    }
  //===========================================================================

  // Phone Number =============================================================
    function hanyaAngka(event) {                                                
        var angka = (event.which) ? event.which : event.keyCode                                                  
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }                                              
    // Fungsi untuk mengganti element dari label menjadi input text dengan bermain pada style display (none dan block) css.
    function changePhoneNumber(){
        // First Name
        first_name_x.style.display = "block";
        btn_first_name_x.style.display = "block";
        first_name_y.style.display = "none"; 
        btn_first_name_y.style.display = "none";
        // Last Name
        last_name_x.style.display = "block";
        btn_last_name_x.style.display = "block";
        last_name_y.style.display = "none";
        btn_last_name_y.style.display = "none";
        // Email
        email_x.style.display = "block";
        btn_email_x.style.display = "block";
        email_y.style.display = "none";
        btn_email_y.style.display = "none";
        // Phone Number
        phone_number_x.style.display = "none";
        btn_phone_number_x.style.display = "none";
        phone_number_y.style.display = "block";
        btn_phone_number_y.style.display = "block"; 
        // Password
        password_x.style.display = "block";
        btn_password_x.style.display = "block";
        password_y.style.display = "none";
        confirm_password_y.style.display = "none";
        btn_closePW.style.display = "none";
        btn_password_y.style.display = "none";        
    }
    function validatePN(){ // Alert for confirmation action.
        var dataPhone = document.getElementById("Phone").value; // Mengambil nilai dari input text dengan id FirstName.
        if(dataPhone == ""){ // Alert apabila input belum di isi.
            swal.fire({
                title: "Enter your phone numbers!",
                text: "You have not entered your phone numbers!",
                icon: "warning"
            });
        }else{ // Alert apabila input sudah di isi.
            swal.fire({
                title: "Are you sure?",
                text: "You want to change your phone number.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Save!'
            })
            .then((result) => {
                if (result.isConfirmed){ //Jika tombol confirm di klik, maka jalankan fungsi dibawah. 
                    let arrPhone = JSON.stringify({"param" : "phone","data" : dataPhone}); // Membuat JSON yang berisi parameter lastname dan data yang akan di update.
                    const lengthPhoneNum = dataPhone.toString().length;
                    const regexPhoneNum12 = /^\+?([0]{1})([0-9]{3})\)?([0-9]{4})?([0-9]{4})$/; // Regex  untuk 12 digit no telepon.
                    const regexPhoneNum11 = /^\+?([0]{1})([0-9]{3})\)?([0-9]{3})?([0-9]{4})$/; // Regex  untuk 11 digit no telepon.
                    const regexPhoneNum10 = /^\+?([0]{1})([0-9]{3})\)?([0-9]{3})?([0-9]{3})$/; // Regex  untuk 10 digit no telepon.                    
                    if((!dataPhone.match(regexPhoneNum10)) && (!dataPhone.match(regexPhoneNum11)) && (!dataPhone.match(regexPhoneNum12))){ // Kondisi untuk memeriksa format nomor telepon yang dimasukan, wajib angka 0 diawal dan format 10 s/d 13 digit nomor.
                        swal.fire({
                            title: "Wrong format number!",
                            html: "Enter in the format 0 at the beginning of the phone number, '0xxx xxxx xxxx' without spaces.<br>Min 10 digit, Max 13 digit.",
                            icon: "warning",
                        });
                    }else{ // Kondisi jika semua terpenuhi, lanjut ke proses update nomor telepon.
                        window.location.href="<?php echo site_url('Home/prosesUpdateAccountSecurity')?>/"+arrPhone; // Mengirim JSON (arr) ke controller.
                    }                    
                }
                if(result.isDismissed){ // Kondisi jika tombol cancel yang di klik, maka ubah kembali button save menjadi button edit.
                    phone_number_x.style.display = "block";
                    btn_phone_number_x.style.display = "block";
                    phone_number_y.style.display = "none";
                    btn_phone_number_y.style.display = "none";
                }
            });
        }
    }
  //===========================================================================
  
  // Btn Close ================================================================
    function closeBtn(){
        // First Name
        first_name_x.style.display = "block";
        btn_first_name_x.style.display = "block";
        first_name_y.style.display = "none";
        btn_first_name_y.style.display = "none";
        // Last Name
        last_name_x.style.display = "block";
        btn_last_name_x.style.display = "block";
        last_name_y.style.display = "none";
        btn_last_name_y.style.display = "none";
        // Email
        email_x.style.display = "block";
        btn_email_x.style.display = "block";
        email_y.style.display = "none";
        btn_email_y.style.display = "none";
        // Phone Number
        phone_number_x.style.display = "block";
        btn_phone_number_x.style.display = "block";
        phone_number_y.style.display = "none";
        btn_phone_number_y.style.display = "none";
    }
    function closeBtnIP(){ 
        btn_closeIP.style.display = "none";
        iconBtn_x.style.display = "block";
        iconBtn_y.style.display = "none";
    }
  //===========================================================================

  // Password =================================================================                                            
    // Fungsi untuk mengganti element dari label menjadi input text dengan bermain pada style display (none dan block) css.    
    function changePassword(){   
        // First Name
        first_name_x.style.display = "block";
        btn_first_name_x.style.display = "block";
        first_name_y.style.display = "none";
        btn_first_name_y.style.display = "none";
        // Last Name
        last_name_x.style.display = "block";
        btn_last_name_x.style.display = "block";
        last_name_y.style.display = "none";
        btn_last_name_y.style.display = "none";
        // Email
        email_x.style.display = "block";
        btn_email_x.style.display = "block";
        email_y.style.display = "none";
        btn_email_y.style.display = "none";
        // Phone Number
        phone_number_x.style.display = "block";
        btn_phone_number_x.style.display = "block";
        phone_number_y.style.display = "none";
        btn_phone_number_y.style.display = "none";
        // Password     
        password_x.style.display = "none";
        btn_password_x.style.display = "none";
        password_y.style.display = "block";
        confirm_password_y.style.display = "block";
        btn_closePW.style.display = "block";
        btn_password_y.style.display = "block";
    }
    function cancelChangePassword(){        
        password_x.style.display = "block";
        btn_password_x.style.display = "block";
        password_y.style.display = "none";
        confirm_password_y.style.display = "none";
        btn_closePW.style.display = "none";
        btn_password_y.style.display = "none";
    }
    function validatePW(){  
        var NewPassword = document.getElementById("NewPassword").value; // Mengambil nilai dari OTP Code.
        var ConfirmPassword = document.getElementById("ConfirmPassword").value; // // Mengambil nilai dari OTP Code Categori.      
        if((NewPassword == "")||(ConfirmPassword == "")){ // input new password kosong, maka tampilkan alert.
            swal.fire({
            title: "Sorry",
            text: "Enter Password!",
            icon: "warning",
            });
        }else{ // Jika new password sudah terisi, lakukan konfirmasi untuk melanjutkan.
            const regexPassword = /^(?=.*([A-Z]){1,})(?=.*[!%^@#$&*]{1,})(?=.*[0-9]{1,})(?=.*[a-z]{1,}).{8,100}$/; //Regex untuk password minimal 1 huruf besar(A,B,C), 1 karakter khusus(@#$%), dan minimal 8 kharakter(xxxxxxxx).
            if(ConfirmPassword != NewPassword){
            swal.fire({
                title: "Sorry",
                text: "Passwords don't match!",
                icon: "warning",
            });
            }else if(!NewPassword.match(regexPassword)){
                swal.fire({
                    title: "Sorry",
                    text: "Wajib memiliki minimal 1 huruf besar, 1 karakter spesial, & minimal 8 digit!",
                    icon: "warning",
                });
                }else{
                swal.fire({
                    title: "Are you sure.",
                    text: "This action requires you to Login again!",
                    icon: "warning",													
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Save!'
                })
                .then((result) => {
                    if (result.isConfirmed){
                        // let arrPass = JSON.stringify({NewPassword}); // Membuat JSON yang berisi parameter password dan data yang akan di update.
                        window.location.href="<?php echo site_url('Home/prosesUpdatePassword')?>/"+NewPassword; // Mengirim JSON (arr) ke controller.
                    }
                    if(result.isDismissed){ // Kondisi jika tombol cancel yang di klik, maka ubah kembali button save menjadi button edit.
                        password_x.style.display = "block";
                        btn_password_x.style.display = "block";
                        password_y.style.display = "none";
                        confirm_password_y.style.display = "none";
                        btn_closePW.style.display = "none";
                        btn_password_y.style.display = "none";
                    }
                });
            }
        }
    }
  // ==========================================================================
  
  // Two-Factor Authentication ================================================
    // Optional for receive OTP Code ==========================================
        function uncheckEmail(){ 
            if(FactorSms.checked == true){
                FactorEmail.checked = false;
                sms_get_otp.style.display = "block";
                sms_get_otp_1.style.display = "block";
                email_get_otp.style.display = "none";
                email_get_otp_1.style.display = "none";
            }else if(FactorSms.checked == false){
                sms_get_otp.style.display = "none";
                sms_get_otp_1.style.display = "none";                
            }           
        }
        function uncheckSms(){ 
            if(FactorEmail.checked == true){
                FactorSms.checked = false; 
                sms_get_otp.style.display = "none";
                sms_get_otp_1.style.display = "none";
                email_get_otp.style.display = "block";
                email_get_otp_1.style.display = "block";
            }else if(FactorEmail.checked == false){
                email_get_otp.style.display = "none";
                email_get_otp_1.style.display = "none";
            }
        }
        function showOptionForOTP(){
            btn_cencel_setup.style.display = "block";
            btn_setup.style.display = "none";
            optionForOTP.style.display = "block";
        }
        function cancelOptionForOTP(){
            FactorEmail.checked = false;
            FactorSms.checked = false;
            btn_cencel_setup.style.display = "none";
            btn_setup.style.display = "block";
            optionForOTP.style.display = "none";
            sms_get_otp.style.display = "none";
            sms_get_otp_1.style.display = "none";
            email_get_otp.style.display = "none";
            email_get_otp_1.style.display = "none";
        }
    // ========================================================================  
  // ==========================================================================      
</script>