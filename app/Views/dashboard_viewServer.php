    <div class="app-wrapper">
        <!-- LINE 1 ================================================================================================================================================ -->
            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <!-- PENGATURAN DATA DAN TAMPILAN DARI SERVER BERDASARKAN LEVEL PENGGUNA ========== -->
                            <?php     
                                // TERIMA DATA DAN TAMPILKAN DATA DARI CONTROLLER UNTUK HALAMAN VIEW SERVER.
                                if (isset($id_user)){
                                    $idUserServer = $id_user;
                                }                                                   
                                    
                                // CEK LEVEL PENGGUNA
                                if(session()->get('level') == 'Admin'){ // KONDISI ADMIN
                                    $adminShow = NUll;  // TAMPILKAN
                                    $clientCSShow = 'hidden';
                                    $hiddenBtnCart = 'hidden';
                                    $hiddenPower = NULL; // TAMPILKAN
                                    $hideBtnCart = 'hidden';                                    
                                }else{     
                                    if(session()->get('level') == 'Cs'){ // KONDISI CS
                                        $adminShow = 'hidden';  
                                        $clientCSShow = NUll; // TAMPILKAN               
                                        $hiddenBtnCart = 'hidden'; // TAMPILKAN
                                        $hiddenPower = 'hidden'; // TAMPILKAN
                                        $hideBtnCart = 'hidden';
                                    }else if(session()->get('level') == 'Client'){ // KONDISI CLIENT
                                        $adminShow = 'hidden';  
                                        $clientCSShow = NUll; // TAMPILKAN               
                                        $hiddenBtnCart = NULL; // TAMPILKAN
                                        $hiddenPower = 'hidden'; // TAMPILKAN
                                        $hideBtnCart = NULL; // TAMPILKAN
                                    }
                                }                                
                            ?>
                        <!-- ============================================================================== -->
                        <!-- CARD SERVER DETAIL =========================================================== -->
                            <div class="app-card-body">
                                <h1 id="titleUserName"></h1>
                                <div class="row">
                                    <div class="col">

                                    <!-- SERVER ID ======================================================================================= -->
                                        <div class="row mt-3 h-line-viewServer bgColor">
                                            <div class="col-5 header-viewServer">Server ID</div>
                                            <div class="col-7 m-auto"><span id="serverID"></span></div>
                                        </div>
                                    <!-- ================================================================================================= -->

                                    <!-- HOST SERVER ===================================================================================== -->
                                        <div class="row h-line-viewServer">
                                            <div class="col-5 header-viewServer">Host Server</div>
                                            <div class="col-7 m-auto"><span id="hostServer"></span></div>
                                        </div>
                                    <!-- ================================================================================================= -->

                                    <!-- PRIMARY IP ====================================================================================== -->
                                        <div class="row h-line-viewServer bgColor">
                                            <div class="col-5 header-viewServer">Primary IP</div>
                                            <div class="col-7 m-auto"><span id="primaryIP"></span></div>
                                        </div>
                                    <!-- ================================================================================================= -->

                                    <!-- GATEWAY ========================================================================================= -->
                                        <div class="row h-line-viewServer">
                                            <div class="col-5 header-viewServer">Gateway</div>
                                            <div class="col-7 m-auto"><span id="gateway"></span></div>
                                        </div>
                                    <!-- ================================================================================================= -->

                                    <!-- DATA CENTER ===================================================================================== -->
                                        <div class="row h-line-viewServer bgColor">
                                            <div class="col-5 header-viewServer">
                                                Data Center
                                            </div>
                                        <!-- CLIENT & CS ========================================= -->
                                            <div class="col-3 m-auto" <?php echo $clientCSShow; ?>>
                                                <span id="showDC"></span>
                                                <span> Unit</span>
                                            </div>
                                            <div class="col-4 m-auto" <?php echo $clientCSShow; ?>>
                                                <i class="fas fa-edit fa-lg" style="color:var(--bs-primary);" id="dcChange" class="accordion-button btn btn-link"
                                                data-bs-toggle="collapse" data-bs-target="#DC-update" aria-expanded="false"
                                                aria-controls="DC-update" <?php echo $hideBtnCart; ?>></i>                                       
                                            </div>
                                        <!-- ===================================================== -->
                                        <!-- ADMIN =============================================== -->
                                            <div class="col-5 m-auto" <?php echo $adminShow; ?>>
                                                <div class="col-12"> 
                                                    <a class="" id="mineBtnDC">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M5.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        </svg>
                                                    </a>
                                                    <input type="text" class="inputAdmin2Digit" id="dcAdmin" value="0" maxlength="2" readonly/> 
                                                    <a class="" id="plusBtnDC">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                        </svg>
                                                    </a>
                                                    <span class="unit"> Unit</span>                                            
                                                </div>
                                            </div>
                                            <div class="col-2 m-auto" <?php echo $adminShow; ?>>
                                                <a class="" id="checkDCBtnAdmin">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        <!-- ===================================================== -->
                                        </div>
                                    <!-- KHUSUS CLIENT ========================================= -->
                                        <div id="DC-update" class="accordion-collapse collapse border-0" aria-labelledby="DC-update">
                                            <div class="row text-start form-group border-box">
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <label for="DC_size" class="col-form-label">
                                                        <i class="fa fa-microchip" aria-hidden="true"></i>
                                                        Select Data Center Size
                                                    </label>                                        
                                                    <select class="form-control js-states form-select" id="DC_size" name="DC_size">
                                                        <option value="" selected disabled></option>
                                                        <option value="1"> 1 unit</option>
                                                        <option value="2"> 2 unit</option>
                                                        <option value="3"> 3 unit</option>
                                                        <option value="4"> 4 unit</option>
                                                        <option value="5"> 5 unit</option>
                                                        <option value="6"> 6 unit</option>
                                                        <option value="7"> 7 unit</option>
                                                        <option value="8"> 8 unit</option>
                                                        <option value="9"> 9 unit</option>
                                                        <option value="10"> 10 unit</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="row">
                                                        <p style="text-align:justify;">You want to <span id="statDC-1" style="font-weight:bold;"></span> the Data Center to <span id="showValueDC" style="font-weight:bold;"></span>. <br> Click add to cart to <span id="statDC-2" style="font-weight:bold;"></span> Data Center, click the cancel button to cancel.</p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6 mb-2">
                                                            <a class="btn app-btn-danger" style="width:100%;" data-bs-toggle="collapse" data-bs-target="#DC-update">Cancel</a>
                                                        </div>
                                                        <div class="col-6 mb-2">
                                                            <a class="btn app-btn-primary" style="width:100%;" id="ChangeOrderDCSize" data-bs-toggle="collapse" data-bs-target="#DC-update">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                                </svg>
                                                                Add to Cart
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- ======================================================= -->
                                    <!-- ================================================================================================= -->

                                    <!-- WINDOWS LICENSE ===================================================================================== -->
                                        <div class="row h-line-viewServer">
                                            <div class="col-5 header-viewServer">
                                                Windows License
                                            </div>
                                        <!-- CLIENT & CS ========================================= -->
                                            <div class="col-3 m-auto" <?php echo $clientCSShow; ?>>
                                                <span id="showWL"></span>
                                                <span> Unit</span>
                                            </div>
                                            <div class="col-4 m-auto" <?php echo $clientCSShow; ?>>
                                                <i class="fas fa-edit fa-lg" style="color:var(--bs-primary);" id="wlChange" class="accordion-button btn btn-link"
                                                data-bs-toggle="collapse" data-bs-target="#WL-update" aria-expanded="false"
                                                aria-controls="WL-update" <?php echo $hideBtnCart; ?>></i>                                       
                                            </div>
                                        <!-- ===================================================== -->
                                        <!-- ADMIN =============================================== -->
                                            <div class="col-5 m-auto" <?php echo $adminShow; ?>>
                                                <div class="col-12"> 
                                                    <a class="" id="mineBtnWL">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M5.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        </svg>
                                                    </a>
                                                    <input type="text" class="inputAdmin2Digit" id="wlAdmin" value="0" maxlength="2"/> 
                                                    <a class="" id="plusBtnWL">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                        </svg>
                                                    </a>
                                                    <span class="unit"> Unit</span>                                            
                                                </div>
                                            </div>
                                            <div class="col-2 m-auto" <?php echo $adminShow; ?>>
                                                <a class="" id="checkWLBtnAdmin">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        <!-- ===================================================== -->
                                        </div>
                                    <!-- KHUSUS CLIENT ========================================= -->
                                        <div id="WL-update" class="accordion-collapse collapse border-0" aria-labelledby="WL-update">
                                            <div class="row text-start form-group border-box">
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <label for="WL_size" class="col-form-label">
                                                        <i class="fa fa-microchip" aria-hidden="true"></i>
                                                        Select Windows License
                                                    </label>                                        
                                                    <select class="form-control js-states form-select" id="WL_size" name="WL_size">
                                                        <option value="" selected disabled></option>
                                                        <option value="1"> 1 unit</option>
                                                        <option value="2"> 2 unit</option>
                                                        <option value="3"> 3 unit</option>
                                                        <option value="4"> 4 unit</option>
                                                        <option value="5"> 5 unit</option>
                                                        <option value="6"> 6 unit</option>
                                                        <option value="7"> 7 unit</option>
                                                        <option value="8"> 8 unit</option>
                                                        <option value="9"> 9 unit</option>
                                                        <option value="10"> 10 unit</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="row">
                                                        <p style="text-align:justify;">You want to <span id="statWL-1" style="font-weight:bold;"></span> the Data Center to <span id="showValueWL" style="font-weight:bold;"></span>. <br> Click add to cart to <span id="statWL-2" style="font-weight:bold;"></span> Data Center, click the cancel button to cancel.</p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6 mb-2">
                                                            <a class="btn app-btn-danger" style="width:100%;" data-bs-toggle="collapse" data-bs-target="#WL-update">Cancel</a>
                                                        </div>
                                                        <div class="col-6 mb-2">
                                                            <a class="btn app-btn-primary" style="width:100%;" id="ChangeOrderWLSize" data-bs-toggle="collapse" data-bs-target="#WL-update">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                                </svg>
                                                                Add to Cart
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- ======================================================= -->
                                    <!-- ================================================================================================= -->

                                    <!-- CPU ============================================================================================= -->
                                        <div class="row h-line-viewServer bgColor">
                                            <div class="col-5 header-viewServer">
                                                CPU
                                            </div>
                                        <!-- CLIENT & CS ========================================= -->
                                            <div class="col-3 m-auto" <?php echo $clientCSShow; ?>>
                                                <span id="showCPU"></span>
                                                <span> Core</span>
                                            </div>
                                            <div class="col-4 m-auto" <?php echo $clientCSShow; ?>>
                                                <i class="fas fa-edit fa-lg" style="color:var(--bs-primary);" id="cpuChange" class="accordion-button btn btn-link"
                                                data-bs-toggle="collapse" data-bs-target="#cpu-update" aria-expanded="false"
                                                aria-controls="cpu-update" <?php echo $hideBtnCart; ?>></i>                                       
                                            </div>
                                        <!-- ===================================================== -->
                                        <!-- ADMIN =============================================== -->
                                            <div class="col-5 m-auto" <?php echo $adminShow; ?>>
                                                <div class="col-12"> 
                                                    <a class="" id="mineBtnCPU">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M5.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        </svg>
                                                    </a>
                                                    <input type="text" class="inputAdmin2Digit" id="cpuAdmin" value="0" maxlength="2"/> 
                                                    <a class="" id="plusBtnCPU">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                        </svg>
                                                    </a>
                                                    <span class="unit"> Core</span>                                            
                                                </div>
                                            </div>
                                            <div class="col-2 m-auto" <?php echo $adminShow; ?>>
                                                <a class="" id="checkCPUBtnAdmin">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        <!-- ===================================================== -->
                                        </div>
                                    <!-- KHUSUS CLIENT ========================================= -->
                                        <div id="cpu-update" class="accordion-collapse collapse border-0" aria-labelledby="cpu-update">
                                            <div class="row text-start form-group border-box">
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <label for="CPU_size" class="col-form-label">
                                                        <i class="fa fa-microchip" aria-hidden="true"></i>
                                                        Select CPU Size
                                                    </label>                                        
                                                    <select class="form-control js-states form-select" id="CPU_size" name="CPU_size">
                                                        <option value="" selected disabled></option>
                                                        <option value="1"> 1 core</option>
                                                        <option value="2"> 2 core</option>
                                                        <option value="3"> 3 core</option>
                                                        <option value="4"> 4 core</option>
                                                        <option value="5"> 5 core</option>
                                                        <option value="6"> 6 core</option>
                                                        <option value="7"> 7 core</option>
                                                        <option value="8"> 8 core</option>
                                                        <option value="9"> 9 core</option>
                                                        <option value="10"> 10 core</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="row">
                                                        <p style="text-align:justify;">You want to <span id="statCPU-1" style="font-weight:bold;"></span> the CPU to <span id="showValueCPU" style="font-weight:bold;"></span>. <br> Click add to cart to <span id="statCPU-2" style="font-weight:bold;"></span> CPU size, click the cancel button to cancel.</p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6 mb-2">
                                                            <a class="btn app-btn-danger" style="width:100%;" data-bs-toggle="collapse" data-bs-target="#cpu-update">Cancel</a>
                                                        </div>
                                                        <div class="col-6 mb-2">
                                                            <a class="btn app-btn-primary" style="width:100%;" id="ChangeOrderCPUSize" data-bs-toggle="collapse" data-bs-target="#cpu-update">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                                </svg>
                                                                Add to Cart
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- ======================================================= -->
                                    <!-- ================================================================================================= -->

                                    <!-- MEMORY ========================================================================================== -->
                                        <div class="row h-line-viewServer">
                                            <div class="col-5  header-viewServer">
                                                Memory
                                            </div>  
                                        <!-- CLIENT & CS ========================================= -->
                                            <div class="col-3 m-auto" <?php echo $clientCSShow; ?>>
                                                <span id="showMemory"></span>
                                                <span> GB</span>
                                            </div>                                    
                                            <div class="col-4 m-auto" <?php echo $clientCSShow; ?>>  
                                                <i class="fas fa-edit fa-lg" style="color:var(--bs-primary);" id="memoryChange" class="accordion-button btn btn-link"
                                                data-bs-toggle="collapse" data-bs-target="#memory-update" aria-expanded="false"
                                                aria-controls="memory-update" <?php echo $hideBtnCart; ?>></i>                                       
                                            </div>
                                        <!-- ===================================================== -->
                                        <!-- ADMIN =============================================== -->
                                            <div class="col-5 m-auto" <?php echo $adminShow; ?>>
                                                <div class="col-12"> 
                                                    <a class="" id="mineBtnMemory">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M5.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        </svg>
                                                    </a>
                                                    <input type="text" class="inputAdmin2Digit" id="memoryAdmin" value="0" maxlength="2" readonly/> 
                                                    <a class="" id="plusBtnMemory">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                        </svg>
                                                    </a>
                                                    <span class="unit"> GB</span>                                            
                                                </div>                                        
                                            </div>
                                            <div class="col-2 m-auto" <?php echo $adminShow; ?>>
                                                <a class="" id="checkMemoryBtnAdmin">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        <!-- ===================================================== -->
                                        </div>
                                    <!-- KHUSUS CLIENT ========================================= -->
                                        <div id="memory-update" class="accordion-collapse collapse border-0" aria-labelledby="memory-update">
                                            <div class="row text-start form-group border-box">
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <label for="memoryCapacity" class="col-form-label">
                                                        <i class="fa fa-microchip" aria-hidden="true"></i>
                                                        Select Memory Capacity
                                                    </label>                                        
                                                    <select class="form-control js-states form-select" id="memoryCapacity" name="memoryCapacity">
                                                        <option value="" selected disabled></option>
                                                        <option value="1"> 1 GB</option>
                                                        <option value="2"> 2 GB</option>
                                                        <option value="4"> 4 GB</option>
                                                        <option value="6"> 6 GB</option>
                                                        <option value="8"> 8 GB</option>
                                                        <option value="16"> 16 GB</option>
                                                        <option value="32"> 32 GB</option>
                                                        <option value="64"> 64 GB</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="row">
                                                        <p style="text-align:justify;">You want to <span id="statMemory-1" style="font-weight:bold;"></span> the memory to <span id="showValueMemory" style="font-weight:bold;"></span>. <br> Click add to cart to <span id="statMemory-2" style="font-weight:bold;"></span> memory capacity, click the cancel button to cancel.</p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6 mb-2">
                                                            <a class="btn app-btn-danger" id="memmory_cancel" style="width:100%;" data-bs-toggle="collapse" data-bs-target="#memory-update">Cancel</a>
                                                        </div>
                                                        <div class="col-6 mb-2">
                                                            <a class="btn app-btn-primary" style="width:100%;" id="ChangeOrderMemorySize" data-bs-toggle="collapse" data-bs-target="#memory-update">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                                </svg>
                                                                Add to Cart
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- ======================================================= -->
                                    <!-- ================================================================================================= -->

                                    <!-- STORAGE ========================================================================================= -->
                                        <div class="row h-line-viewServer bgColor">
                                            <div class="col-5 header-viewServer">
                                                Storage
                                            </div>
                                        <!-- CLIENT & CS ========================================= -->
                                            <div class="col-3 m-auto" <?php echo $clientCSShow; ?>>
                                                <span id="showStorage"></span>
                                                <span> GB </span>
                                            </div>
                                            <div class="col-4 m-auto" <?php echo $clientCSShow; ?>>
                                                <i class="fas fa-edit fa-lg" style="color:var(--bs-primary);" id="storageChange" class="accordion-button btn btn-link"
                                                data-bs-toggle="collapse" data-bs-target="#storage-update" aria-expanded="false"
                                                aria-controls="storage-update" <?php echo $hideBtnCart; ?>></i>                                       
                                            </div>
                                        <!-- ===================================================== -->
                                        <!-- ADMIN =============================================== -->
                                            <div class="col-5 m-auto" <?php echo $adminShow; ?>>
                                                <div class="col-12"> 
                                                    <a class="" id="mineBtnStorage">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M5.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        </svg>
                                                    </a>
                                                    <input type="text" class="inputAdmin4Digit" id="storageAdmin" value="0" maxlength="4" readonly/> 
                                                    <a class="" id="plusBtnStorage">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                        </svg>
                                                    </a>
                                                    <span class="unit"> GB</span>                                            
                                                </div>
                                            </div>
                                            <div class="col-2 m-auto" <?php echo $adminShow; ?>>
                                                <a class="" id="checkStorageBtnAdmin">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        <!-- ===================================================== -->
                                        </div>
                                    <!-- KHUSUS CLIENT ========================================= -->
                                        <div id="storage-update" class="accordion-collapse collapse border-0" aria-labelledby="storage-update">
                                            <div class="row text-start form-group border-box">
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <label for="storage_size" class="col-form-label">
                                                        <i class="fa fa-microchip" aria-hidden="true"></i>
                                                        Select Storage Size
                                                    </label>                                        
                                                    <select class="form-control js-states form-select" id="storage_size" name="storage_size">
                                                        <option value="" selected disabled></option>
                                                        <option value="100"> 100 GB</option>
                                                        <option value="200"> 200 GB</option>
                                                        <option value="400"> 400 GB</option>
                                                        <option value="600"> 600 GB</option>
                                                        <option value="800"> 800 GB</option>
                                                        <option value="1000"> 1000 GB</option>
                                                        <option value="2000"> 2000 GB</option>
                                                        <option value="4000"> 4000 GB</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="row">
                                                        <p style="text-align:justify;">You want to <span id="statStorage-1" style="font-weight:bold;"></span> the Storage to <span id="showValueStorage" style="font-weight:bold;"></span>. <br> Click add to cart to <span id="statStorage-2" style="font-weight:bold;"></span> Storage size, click the cancel button to cancel.</p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6 mb-2">
                                                            <a class="btn app-btn-danger" style="width:100%;" data-bs-toggle="collapse" data-bs-target="#storage-update">Cancel</a>
                                                        </div>
                                                        <div class="col-6 mb-2">
                                                            <a class="btn app-btn-primary" style="width:100%;" id="ChangeOrderStorageSize" data-bs-toggle="collapse" data-bs-target="#storage-update">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                                </svg>
                                                                Add to Cart
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- ======================================================= -->
                                    <!-- ================================================================================================= -->

                                    <!-- SERVER COUNTRY ================================================================================== -->
                                        <div class="row h-line-viewServer">
                                            <div class="col-5 header-viewServer">Server Country</div>
                                            <div class="col-7 m-auto"><span id="serverLocation"></span></div>
                                        </div> 
                                    <!-- ================================================================================================= -->

                                    <!-- POWER STATUS ==================================================================================== -->
                                        <div class="row h-line-viewServer bgColor">
                                            <div class="col-5 header-viewServer">Power Status <span class="powerStatus"></span></div>
                                            <div class="col-7 m-auto">                                        
                                                <div class="form-check form-switch mb-1">                                     
                                                    <form class="settings-form">              
                                                        <input class="form-check-input" type="checkbox" style="width:35px; height:20px;" id="statusServer" <?php echo $hiddenPower;?> />                                                
                                                    </form>
                                                </div>
                                            </div>                              
                                        </div>
                                    <!-- ================================================================================================= -->

                                    </div>
                                </div>     
                            </div>
                        <!-- ============================================================================== -->
                        <!-- BUTTON CART ================================================================== -->
                            <div class="row justify-content-between">
                                <div class="col-auto pad-top-btn"><a class="btn app-btn-secondary" href="<?php echo base_url('server'); ?>">Back</a></div>
                                <div class="col-auto pad-top-btn">
                                    <a id="cekCartOrder" class="btn app-btn-primary" <?php echo $hiddenBtnCart; ?>>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        Check Cart
                                    </a>
                                </div>
                            </div>
                        <!-- ============================================================================== -->
                    </div>
                </div>
            </div>
        <!-- ======================================================================================================================================================= -->

        <!-- LINE 2 ================================================================================================================================================ -->
            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-4 mb-1">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <h1 class="app-page-title">
                                    Addvertising 1
                                </h1>
                            
                                <div class="app-card-body">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 mb-1">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <h1 class="app-page-title">
                                    Addvertising 2
                                </h1>
                            
                                <div class="app-card-body">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 mb-1">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <h1 class="app-page-title">
                                    Addvertising 3
                                </h1>
                            
                                <div class="app-card-body">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- ======================================================================================================================================================= -->    
    </div>

    <script>        
        // GLOBAL VARIABLE ======================================================
            // var id_user_server = "<?php //echo $idUserServer; ?>";
            const inputNilaiDC = document.getElementById('dcAdmin');
            const inputNilaiWL = document.getElementById('wlAdmin');
            const inputNilaiCPU = document.getElementById('cpuAdmin');
            const inputNilaiMemory = document.getElementById('memoryAdmin');
            const inputNilaiSDD = document.getElementById('storageAdmin');

            const limitInputValue = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
            const limitInputCPUValue = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
            const limitInputMemoryValue = [1, 2, 4, 6, 8, 16, 32, 64];
            const limitInputStorageValue = [100, 200, 400, 600, 800, 1000, 2000, 4000];

            var dataToSend, cpuSizeNow, 
                memorySizeNow, cpuOrder, memoryOrder, 
                selecetedCpuOrder, selectedMemoryOrder, 
                statCPU_1, statCPU_2, 
                statMemory_1, statMemory_2;

            // KODE OTORITAS, UNTUK ADMIN MERUBAH UKURAN (ATUR DEFAULT)
            var defaultAuthorityCode = 12345678;            
            
        // ======================================================================

            $(document).ready(function(){
                getDataServer(); // JALANKAN FUNGSI getDataServer, UNTUK MENAMPILKAN SELURUH DATA DARI DATABASE KE VIEW SERVER.
                
            });
</script>