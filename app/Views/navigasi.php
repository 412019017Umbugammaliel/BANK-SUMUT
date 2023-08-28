<?php 
    if (!empty(session()->get('foto'))){ $foto = session()->get('foto'); } else { $foto = 'user-default.png'; }; 
    if (!empty(session()->get('level'))){ $user_level = session()->get('level'); };
    if (!empty(session()->get('user_name'))){ $user_name = session()->get('user_name'); };
    if (!empty(session()->get('id_user'))){ $id_user = session()->get('id_user'); };
    if(isset($user_level) == "Client"){
        $hidden = "hidden";
    }else{
        $hidden = null;
    }
?>

<body class="app">
    <header class="app-header fixed-top">
      <!-- TOP NAVBAR ======================================================================================================================================== -->
        <div class="app-header-inner">
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
                                    <title>Menu</title>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                                </svg>
                            </a>
                        </div>
                        
                        <div class="search-mobile-trigger d-sm-none col">
                            <i class="search-mobile-trigger-icon fas fa-search"></i>
                        </div>

                      <!-- SEARCH BOX ======================================================================================================================== -->
                        <div class="app-search-box col">
                            <form class="app-search-form">
                                <input type="text" placeholder="Search..." name="search" class="form-control search-input">
                                <button type="submit" class="btn search-btn btn-primary" value="Search"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                      <!-- =================================================================================================================================== -->
                      
                        <div class="app-utilities col-auto">
                          <!-- CART NOTIFICATION ============================================================================================================ -->
                            <div class="app-utility-item app-notifications-dropdown dropdown">
                                <a class="dropdown-toggle no-toggle-arrow" id="notifications-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" title="cart_invoice">
                                    <svg class="icon-cart-nav" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <span id="notif_cart_invoice" class="icon-badge" hidden><!-- from ajax --></span>                     
                                </a>
                                <div class="dropdown-menu p-0" aria-labelledby="cart-dropdown-toggle">
                                    <div class="dropdown-menu-header p-3">
                                        <h5 class="dropdown-menu-title mb-0">Cart</h5>
                                    </div>
                                    <div class="dropdown-menu-content scrollbarNotification" id="cart_orderList">
                                    </div>
                                    <div class="dropdown-menu-footer p-2 text-center">
                                        <div class="row">
                                            <div class="col-6 text-start"><a href="">View All Order</a></div>
                                            <div class="col-6 text-end"><a href="">Print Invoice</a></div>  
                                        </div>                                       
                                    </div>
                                </div>
                            </div>
                          <!-- ============================================================================================================================== -->

                          <!-- MSG & LOG NOTIFICATION ======================================================================================================= -->
                            <div class="app-utility-item app-notifications-dropdown dropdown">
                                <a class="dropdown-toggle no-toggle-arrow" id="notifications-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" title="Notifications">
                                    <svg width="27" height="27" viewBox="0 0 16 16" class="bi bi-bell icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z" />
                                        <path fill-rule="evenodd" d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                                    </svg>
                                  <!-- NOTIFIKASI JUMLAH PESAN BARU ATAU YANG BELUM DIBACA ==================================================================== -->
                                    <span id="count_unread_notif_top" class="icon-badge" hidden><!-- PERHITUNGAN DARI AJAX --></span>
                                  <!-- ====================================================================================================================== -->
                                </a>

                                <div class="dropdown-menu p-0" aria-labelledby="notifications-dropdown-toggle">
                                    <div class="dropdown-menu-header p-3">
                                        <h5 class="dropdown-menu-title mb-0">Notifications</h5>
                                    </div>

                                  <!-- PERULANGAN NOTIFIKASI BARU ATAU YANG BELUM DIBACA ==================================================================== -->
                                    <div class="dropdown-menu-content scrollbarNotification" id="notif_list"> <!-- PERULANGAN DARI AJAX --></div>
                                  <!-- ====================================================================================================================== -->

                                  <!-- TEXT PINTAS KE TICKET PAGE DAN LOG PAGE ============================================================================== -->
                                    <div class="dropdown-menu-footer p-2 text-center">                                      
                                        <div class="row">
                                            <div class="col-6 text-start"><a href="<?php echo base_url('liveChat'); ?>">View all message</a></div>
                                            <div class="col-6 text-end" <?php echo $hidden; ?>><a href="<?php echo base_url('log'); ?>">View all log</a></div>  
                                        </div>                                      
                                    </div>
                                  <!-- ====================================================================================================================== -->
                                </div>

                            </div>
                          <!-- ============================================================================================================================== -->

                          <!-- SETTING PAGE ================================================================================================================= -->
                            <div class="app-utility-item hidden">
                                <a href="<?php echo base_url('setting'); ?>" title="Settings" >
                                    <svg width="27" height="27" viewBox="0 0 16 16" class="bi bi-gear icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z" />
                                        <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z" />
                                    </svg>
                                </a>
                            </div>
                          <!-- ============================================================================================================================== -->

                          <!-- PROFILE MENU ================================================================================================================= -->
                            <div class="app-utility-item app-user-dropdown dropdown">
                              <!-- FOTO PROFILE ============================================================================================================= -->
                                <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                    <img class="rounded-circle" src="<?php echo base_url();?>/assets/images/users/<?php echo $foto; ?>" alt="user profile">
                                </a>
                              <!-- ========================================================================================================================== -->

                              <!-- MENU DROPDOWN ============================================================================================================ -->
                                <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                  <!-- ACCOUNT AND SECURITY PAGE -->
                                    <li> 
                                        <a class="dropdown-item" href="<?php echo base_url('accScur'); ?>">
                                            <label>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person auto-mr-03 -mt-02" viewBox="0 0 16 16">
                                                    <path fill="currentColor" d="M5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/>  
                                                    <path fill="white" transform="matrix(.6 0 0 .6 3 2)" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                                </svg>
                                                
                                            </label>
                                            <label>
                                                Account
                                            </label>
                                        </a>
                                    </li>
                                  <!-- SETTING PAGE -->
                                    <li>
                                        <a class="dropdown-item" href="<?php echo base_url('setting'); ?>">
                                            <label>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear auto-mr-03 -mt-02" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z" />
                                                    <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z" />
                                                </svg>
                                            </label>
                                            <label>
                                                Settings
                                            </label>
                                        </a>
                                    </li>
                                  <!-- NOTIFIKASI PAGE -->
                                    <li> 
                                        <a class="dropdown-item" href="<?php echo base_url('message'); ?>">
                                            <label>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell auto-mr-03 -mt-02" viewBox="0 0 16 16">
                                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z" />
                                                    <path fill-rule="evenodd" d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                                                </svg>
                                            </label>
                                            <label>
                                                Notifikasi
                                            </label>                                            
                                        </a>
                                    </li>
                                  <!-- TICKET PAGE -->
                                    <li> 
                                        <a class="dropdown-item" href="<?php echo base_url('liveChat'); ?>">
                                            <label>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-headset auto-mr-03 -mt-02" viewBox="0 0 16 16">
                                                    <path d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5z"/>
                                                </svg>
                                            </label>
                                            <label>
                                                Ticket
                                            </label>
                                        </a>
                                    </li>
                                  <!-- PEMBATAS -->
                                    <li><hr class="dropdown-divider"></li>
                                  <!-- PINTAS LOG OUT -->
                                    <li> 
                                        <a class="dropdown-item" href="<?php echo base_url('logout'); ?>">
                                            <label>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-power auto-mr-03 -mt-02" viewBox="0 0 16 16">
                                                    <path d="M7.5 1v7h1V1h-1z"/>
                                                    <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z"/>
                                                </svg>
                                            </label>
                                            <label>
                                                Log Out
                                            </label>
                                        </a>
                                    </li>
                                </ul>
                              <!-- ========================================================================================================================== -->
                            </div>
                          <!-- ============================================================================================================================== -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <!-- =================================================================================================================================================== -->

      <!-- SIDE NAVBAR ======================================================================================================================================= -->
        <div id="app-sidepanel" class="app-sidepanel">
            <div id="sidepanel-drop" class="sidepanel-drop"></div>
            <div class="sidepanel-inner d-flex flex-column">
                <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                    </svg>
                </a>

              <!-- LOGO ====================================================================================================================================== -->
                <div class="app-branding">
                    <a class="app-logo" href="<?php echo base_url('/'); ?>"><img class="logo-icon" src="<?php echo base_url();?>/assets/images/banksumut.png" alt="logo"></a>
                </div>
              <!-- =========================================================================================================================================== -->
              
              <!-- PENGATURAN TAMPIL DAN SEMBUNYI TOMBOL BERDASARKAN LEVEL PENGUNA =========================================================================== -->
                <?php 
                    if(isset($user_level)){
                        if($user_level == "Admin")
                        {
                            $serverHidden = "";
                            $ticketHidden = "hidden";
                            $orderHidden = "";
                            $merchHidden = "hidden";
                            $helpHidden = "hidden";
                            $notifHidden = "";
                        }
                        else if($user_level == "Client")
                        {
                            $serverHidden = "";
                            $ticketHidden = "hidden";
                            $orderHidden = "";
                            $merchHidden = "";
                            $helpHidden = "";
                            $notifHidden = "hidden";
                        }
                        else if($user_level == "Cs")
                        {
                            $serverHidden = "";
                            $ticketHidden = "";
                            $orderHidden = "hidden";
                            $merchHidden = "hidden";
                            $helpHidden = "hidden";
                            $notifHidden = "hidden";
                        }
                    }
                ?>
              <!-- =========================================================================================================================================== -->

              <!-- MENU ====================================================================================================================================== -->
                <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                      <!-- DASHBOARD PAGE ==================================================================================================================== -->
                        <li class="nav-item">
                            <a class="nav-link <?php if (session()->get('active') == 'main') {echo 'active';} else {NULL;}; ?>" href="<?php echo base_url('main'); ?>">
                                <span class="nav-icon">
                                    <svg width="27" height="27" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
                                        <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>                        
                      <!-- SERVER PAGE ======================================================================================================================= -->
                        <li class="nav-item" <?php echo $serverHidden; ?>>
                            <a class="nav-link <?php if (session()->get('active') == 'server') {echo 'active';} else {NULL;}; ?>" href="<?php echo base_url('server'); ?>">
                                <span class="nav-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-server" viewBox="0 0 16 16">
                                        <path d="M1.333 2.667C1.333 1.194 4.318 0 8 0s6.667 1.194 6.667 2.667V4c0 1.473-2.985 2.667-6.667 2.667S1.333 5.473 1.333 4V2.667z" />
                                        <path d="M1.333 6.334v3C1.333 10.805 4.318 12 8 12s6.667-1.194 6.667-2.667V6.334a6.51 6.51 0 0 1-1.458.79C11.81 7.684 9.967 8 8 8c-1.966 0-3.809-.317-5.208-.876a6.508 6.508 0 0 1-1.458-.79z" />
                                        <path d="M14.667 11.668a6.51 6.51 0 0 1-1.458.789c-1.4.56-3.242.876-5.21.876-1.966 0-3.809-.316-5.208-.876a6.51 6.51 0 0 1-1.458-.79v1.666C1.333 14.806 4.318 16 8 16s6.667-1.194 6.667-2.667v-1.665z" />
                                    </svg>                                  
                                </span>                             
                                <span class="nav-link-text">Servers</span>
                            </a>
                        </li>
                      <!-- TICKET PAGE (Cs) ================================================================================================================== -->
                        <li class="nav-item" <?php echo $ticketHidden; ?>>
                            <a class="app-utility-item-custome nav-link <?php if (session()->get('active') == 'liveChat') {echo 'active';} else {NULL;}; ?>" href="<?php echo base_url('liveChat'); ?>">
                                <span class="nav-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-headset auto-mr-03 -mt-02" viewBox="0 0 16 16">
                                        <path d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5z"/>
                                    </svg>
                                </span>
                              <!-- NOTIFIKASI JUMLAH PESAN BARU ATAU YANG BELUM DIBACA ================================================================== -->
                                <span id="count_unread_ticket_side" class="icon-badge-customeTicket" hidden><!-- PERHITUNGAN DARI AJAX --></span>
                              <!-- ====================================================================================================================== -->
                                <span class="nav-link-text">Ticket</span>
                            </a>
                        </li>
                      <!-- ORDER PAGE ======================================================================================================================== -->
                        <li class="nav-item" <?php echo $orderHidden; ?>>
                            <a class="nav-link <?php if (session()->get('active') == 'order') {echo 'active';} else {NULL;}; ?>" href="<?php echo base_url('order'); ?>">
                                <span class="nav-icon">
                                    <svg width="27" height="27" viewBox="0 0 16 16" class="bi bi-card-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                        <path fill-rule="evenodd" d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z" />
                                        <circle cx="3.5" cy="5.5" r=".5" />
                                        <circle cx="3.5" cy="8" r=".5" />
                                        <circle cx="3.5" cy="10.5" r=".5" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">Orders</span>
                            </a>
                        </li>
                      <!-- MERCHANT PAGE ===================================================================================================================== -->
                        <li class="nav-item" <?php echo $merchHidden; ?>>
                            <a class="nav-link <?php if (session()->get('active') == 'merch'){echo 'active';}else{NULL;}; ?>" href="<?php echo base_url('merch'); ?>">
                                <span class="nav-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                                        <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">Merch</span>
                            </a>
                        </li>
                      <!-- SUB MENU OTHER ==================================================================================================================== -->
                        <li class="nav-item has-submenu">                            
                            <a class="nav-link submenu-toggle <?php if (session()->get('active') == 'subpage') {echo 'active';} else {NULL;}; ?>"  href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1" aria-expanded="false" aria-controls="submenu-1">
                                <span class="nav-icon">
                                    <svg width="27" height="27" viewBox="0 0 16 16" class="bi bi-files" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z" />
                                        <path d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">Other</span>
                                <span class="submenu-arrow">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </span>
                            </a>
                            <div id="submenu-1" class="collapse submenu submenu-1 <?php if (session()->get('subShow') == 'show') {echo 'show';} else {NULL;}; ?>" data-bs-parent="#menu-accordion">
                              <!-- SUB NAV ACCOUNT AND SECURITY ============================================================================================== -->
                                <ul class="submenu-list list-unstyled">
                                    <li class="submenu-item">
                                        <a class="submenu-link <?php if (session()->get('active1') == 'subpage2') {echo 'active';} else {NULL;}; ?>" href="<?php echo base_url('accScur'); ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" class="bi bi-person" viewBox="0 0 16 16">
                                                <path fill="currentColor" d="M5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/>
                                                <path fill="white" transform="matrix(.6 0 0 .6 3 2)" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                            </svg>                                            
                                            <span class="nav-link-text">Account & Security</span>
                                        </a>
                                    </li>
                                </ul>
                              <!-- SUB NAV NOTIFICATION (ADMIN) ============================================================================================== -->
                                <ul class="submenu-list list-unstyled" <?php echo $notifHidden; ?>>
                                    <li class="submenu-item">                                       
                                        <a id="notif_link" class="submenu-link app-utility-item-custome <?php if (session()->get('active1') == 'subpage3') {echo 'active';} else {NULL;}; ?>" href="<?php echo base_url('log'); ?>">
                                            <svg width="25" height="25" viewBox="0 0 16 16" class="bi bi-bell icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z" />
                                                <path fill-rule="evenodd" d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                                            </svg>
                                            <span id="count_unread_notif_side" class="icon-badge-custome" hidden><!-- from ajax --></span>
                                            <span class="nav-link-text"> Notification</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                      <!-- HELP PAGE ========================================================================================================================= -->
                        <li class="nav-item" <?php echo $helpHidden; ?>>
                            <a class="nav-link <?php if (session()->get('active')=='help'){echo 'active';}else{NULL;};?>" href="<?php echo base_url('help'); ?>">
                                <span class="nav-icon">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-question-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">Help</span>
                            </a>
                        </li>
                    </ul>
                </nav>
              <!-- =========================================================================================================================================== -->
              
              <!-- SETTING PAGE (FOOTER SIDE NAVBAR) ========================================================================================================= -->
                <div class="app-sidepanel-footer">
                    <nav class="app-nav app-nav-footer">
                        <ul class="app-menu footer-menu list-unstyled">
                            <li class="nav-item" id="Notification_Count">
                                <a class="nav-link" href="<?php echo base_url('setting'); ?>">
                                    <span class="nav-icon">
                                        <svg width="27" height="27" viewBox="0 0 16 16" class="bi bi-gear" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z" />
                                            <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-text">
                                        Settings
                                    </span> 
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
              <!-- =========================================================================================================================================== -->
            </div>
        </div>
      <!-- =================================================================================================================================================== -->
    </header>

<!-- MODAL NOTIFIKASI ========================================================================================================== -->
    <?php if(isset($user_level) == "Client"){ ?>
  <!-- MODAL UNTUK CLIENT ====================================================================================================== -->
    <div class="modal fade" id="messageShow" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="app-card shadow-sm">
                <div class="container app-card-body">
                    <div class="row headerSubject">
                        <div class="col-6 text-start">
                            <span class="" id="message_sbj"></span>
                        </div>
                        <div class="col-6 text-end">
                            <label class="label-modal-sender">From: <span id="show_user_name"></span></label>
                        </div>
                    </div>
                    <div class="row bodySubject">
                        <span id="show_desc_chat"></span>
                    </div>
                    <div class="row footerSubject">
                        <div class="col-9 app-utility-item-custome-ticket-modal">
                            <span class="m-custome-ticket" id="message_ticketstatus"></span>
                            <span class="m-custome-ticket badge bg-danger" id="message_priority"></span>
                            <span class="badge bg-info" id="show_id_chat"></span>
                        </div>
                        <div class="col-3 text-end">
                            <button type="submit" id="btn_close_submit" class="btn btn-close-modal" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!-- ========================================================================================================================= -->
    <?php }else if(isset($user_level) == "Admin"){ ?>
  <!-- MODAL UNTUK ADMIN ======================================================================================================= -->
    <!-- MODAL LOG ============================================================================================================= -->
        <div class="modal fade" id="logShow" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content modal-custome">
                    <div class="modal-header header-modal-custome">					
                        <div class="container container-header-modal">
                            <div class="row">
                                <div class="text-center"><h3 class="modal-title" id="show_idLog"></h3></div>							
                            </div>
                            <div class="row row-modal-1 mt-2 pb-2">
                                <div class="col-12 text-start">
                                    <span id="show_category"></span>
                                </div>													
                            </div>
                            <div class="row row-modal-2 mt-2">	

                            </div>
                        </div>					
                    </div>
                    <div class="modal-body row-body-custome">					
                        <p id="show_descLogActivity"></p>					
                    </div>
                    <div class="modal-footer row-footer-custome">
                        <div class="container">
                            <div class="row">
                                <div class="col-3 text-start">
                                    <a onclick="" id="delete_log" class="" data-toggle="tooltip" title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg>
                                    </a>								
                                </div>
                                <div class="col-6 text-center"><span class="span-date-footer-modal" id="show_dateTime"></span></div>
                                <div class="col-3 text-end"><button type="submit" id="btn_close_submit" class="btn btn-close-modal" data-bs-dismiss="modal" aria-label="Close">Close</button></div>
                            </div>
                        </div>					
                    </div>
                </div>
            </div>
        </div>
    <!-- ======================================================================================================================= --> 
    <!-- MODAL PESAN =========================================================================================================== -->
        <div class="modal fade" id="messageShow" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content modal-custome">
                    <div class="modal-header header-modal-custome">					
                        <div class="container container-header-modal">
                            <div class="row">
                                <div class="text-center"><h3 class="modal-title " id="show_user_name"></h3></div>							
                            </div>
                            <div class="row row-modal-1 mt-2 pb-2">
                                <div class="col-6 text-start">
                                    <span id="show_id_chat"></span>
                                </div>
                                <div class="col-6 text-end">
                                    <span id="message_id"></bspan>
                                </div>							
                            </div>						
                        </div>					
                    </div>				
                    <div class="modal-body row-body-custome">					
                        <p id="show_desc_chat"></p>					
                    </div>
                    <div class="modal-footer row-footer-custome">
                        <div class="container">
                            <div class="row">
                                <div class="col-3 text-start">
                                    <a id="delete_message" class=" " data-toggle="tooltip" title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.6rem" height="1.6rem" fill="currentColor" class="bi bi-trash3" viewBox="0 0 18 18">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg>
                                    </a>
                                    <a id="replay_message" class="ml-05" data-toggle="tooltip" title="Send Mail">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.6rem" height="1.6rem" fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 18 18">
                                            <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
                                            <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648Zm-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="col-6 text-center"><span class="span-date-footer-modal" id="show_date_chat"></span> <span class="span-date-footer-modal" id="show_time_chat"></span></div>
                                <div class="col-3 text-end"><button type="submit" id="btn_close_submit" class="btn btn-close-modal" data-bs-dismiss="modal" aria-label="Close">Close</button></div>
                            </div>
                        </div>					
                    </div>
                </div>
            </div>
        </div>
    <!-- ======================================================================================================================= -->
  <!-- ========================================================================================================================= -->
    <?php }else if(isset($user_level) == "Cs"){ ?>
  <!-- MODAL UNTUK CS ========================================================================================================== -->
    <div class="modal fade" id="messageShow" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content modal-custome">
                    <div class="modal-header header-modal-custome">					
                        <div class="container container-header-modal">
                            <div class="row">
                                <div class="text-center"><h3 class="modal-title " id="show_user_name"></h3></div>							
                            </div>
                            <div class="row row-modal-1 mt-2 pb-2">
                                <div class="col-6 text-start">
                                    <span id="show_id_chat"></span>
                                </div>
                                <div class="col-6 text-end">
                                    <span id="message_id"></bspan>
                                </div>							
                            </div>						
                        </div>					
                    </div>				
                    <div class="modal-body row-body-custome">					
                        <p id="show_desc_chat"></p>					
                    </div>
                    <div class="modal-footer row-footer-custome">
                        <div class="container">
                            <div class="row">
                                <div class="col-3 text-start">
                                    <a id="delete_message" class=" " data-toggle="tooltip" title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.6rem" height="1.6rem" fill="currentColor" class="bi bi-trash3" viewBox="0 0 18 18">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg>
                                    </a>
                                    <a id="replay_message" class="ml-05" data-toggle="tooltip" title="Send Mail">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.6rem" height="1.6rem" fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 18 18">
                                            <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
                                            <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648Zm-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="col-6 text-center"><span class="span-date-footer-modal" id="show_date_chat"></span> <span class="span-date-footer-modal" id="show_time_chat"></span></div>
                                <div class="col-3 text-end"><button type="submit" id="btn_close_submit" class="btn btn-close-modal" data-bs-dismiss="modal" aria-label="Close">Close</button></div>
                            </div>
                        </div>					
                    </div>
                </div>
            </div>
        </div>
  <!-- ========================================================================================================================= -->
    <?php } ?>
<!-- =========================================================================================================================== -->
  
    <script>
        var base_url = "<?php echo base_url();?>";
        var level = "<?php echo $user_level ?>";
        var userName = "<?php echo $user_name ?>";
        var id_user = "<?php echo $id_user ?>";
      // MENGAMBIL ID DARI ELEMENT UNTUK MENAMPILKAN JUMLAH PESAN BELUM TERBACA PADA NAVBAR ====
        var countUnreadNotifTicketSide = document.getElementById("count_unread_ticket_side");
        var countUnreadNotifSide = document.getElementById("count_unread_notif_side");
        var countUnreadNotifTop = document.getElementById("count_unread_notif_top");
      // =======================================================================================

        $(document).ready(function () {
            getCountNotifNav(); // MENJALANKAN FUNGSI MENGHITUNG SELURUH PESAN YANG BELUM DIBACA (form_live_chat_function.js).
            getLogMsg(); // MENJALANKAN FUNGSI UNTUK MENGAMBIL INFORMASI PESAN ATAU LOG YANG BELUM DIBACA KEDALAM LIST NOTIFIKASI NAVBAR (notification_function_1.js). 

            setInterval(function(){ // MENJALANKAN ULANG FUNGSI DENGAN INTERVAL WAKTU 1 MENIT.
                getCountNotifNav(); 
            }, 60000);
        })        
    </script>

    