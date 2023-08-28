<?php 
    //Get id & name user for this account.
    $id_user = session()->get('id_user'); 
    $user_name = session()->get('user_name'); 
    $user_level = session()->get('level');     
?> 
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <h1 class="app-page-title mb-0">Ticket</h1>
                    </div>
                  <!-- Container for searching or filtering with input text box and select option -->
					<div class="col-sm-12 col-md-8 col-lg-8">
						<form class="table-search-form row gx-1">
							<div class="col-sm-12 col-md-8 col-lg-8">
								<input class="mt-06rem input-filtering" type="text" id="searchTicket" name="searchticket" class="form-control" placeholder="Search Keyword">
							</div>									
							<div class="col-sm-12 col-md-4 col-lg-4">								    
								<select class="form-select select-option-filtering" id="filteringPriority">
									<option value="" selected>Filter Ticket</option>
									<option value="REQUEST">REQUEST</option>
									<option value="LOW">LOW</option>
                                    <option value="MODERATE">MODERATE</option>
                                    <option value="HIGH">HIGH</option>
                                    <option value="CRITICAL">CRITICAL</option>																		  
								</select>
							</div>							
						</form>					                
					</div>
				  <!-- End, container for searching or filtering with input text box and select option -->
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <!-- Ubah dengan sweatalert2 -->
                        <!-- <div class="col-sm-12 col-md-6 col-lg-6"> -->
                        <!-- Start, alert bootstrap ================================================================-->
                            <?php 
                                $notifError = session()->getFlashdata('liveErrorChatNotif');
                                // $notifSuccess = session()->getFlashdata('liveSuccessChatNotif');
                                if(isset($notifError)) { 
                            ?>
                                <div class="alert alert-danger" role="alert" id="alertBox">
                                    <?php echo $notifError; ?>
                                </div> 
                            <?php //}else if(isset($notifSuccess)) { ?>
                                <!-- <div class="alert alert-success" role="alert" id="alertBox">
                                    <?php //echo $notifSuccess ?>
                                </div> -->
                            <?php } ?> 
                        <!-- End, alert bootstrap ==================================================================-->
                        <!-- </div> -->
                      <!-- End Ubah dengan sweatalert2 -->

                      <!-- Tab Navigasi Ticket =================================================================== -->
                        <div class="container pt-3 pb-3">
                            <div class="row">
                                <div class="col-12 mt-2">
                                    <?php if($user_level == "Client"){ ?>
                                      <!-- Nav Tab List Ticket Client =======================================================-->
                                        <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs-ticket nav flex-column flex-sm-row">
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <a class="flex-sm-fill text-sm-center nav-link active app-utility-item-custome-ticket" id="tickets-open-tab" data-bs-toggle="tab" href="#statOPENTicket" role="tab" aria-controls="statOPENTicket" aria-selected="true">
                                                    Open
                                                    <span id="count_unread_notif_ticket" class="icon-badge-custome-ticket new-ticket m-mt-01" hidden><!-- from ajax --></span>
                                                </a> 
                                            </div>  
                                            <div class="col-sm-12 col-md-4 col-lg-4">                                     
                                                <a class="flex-sm-fill text-sm-center nav-link" id="tickets-closed-tab" data-bs-toggle="tab" href="#statCLOSEDTicket" role="tab" aria-controls="statCLOSEDTicket" aria-selected="false">
                                                    Closed
                                                </a>
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <!-- Button New & Cancel Ticket ========================================================= -->
                                                <a id="createNewTicket" class="btn app-btn-secondary addBtnTicket" data-bs-toggle="collapse" data-bs-target="#formNewTicket" aria-expanded="false" aria-controls="formNewTicket">                                        
                                                    Add Ticket
                                                </a>
                                                <a hidden id="cancelCreateTicket" class="btn app-btn-secondary addBtnTicket" data-bs-toggle="collapse" data-bs-target="#formNewTicket" aria-expanded="false" aria-controls="formNewTicket">
                                                    Cancel 
                                                </a>   
                                                <!-- End Button New & Cancel Ticket ===================================================== -->  
                                            </div>
                                        </nav>
                                      <!-- End Nav Tab List Ticket Client ===================================================-->
                                    <?php }else if($user_level == "Cs"){ ?>
                                      <!-- Nav Tab List Ticket CS =======================================================-->
                                        <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs-ticket nav flex-column">
                                            <div class="row mb-1">
                                                <div class="col-sm-12 col-md-4 col-lg-4">
                                                    <a class="flex-sm-fill text-sm-center nav-link" id="tickets-unassigned" data-bs-toggle="tab" href="#unassignedTicket" role="tab" aria-controls="unassignedTicket" aria-selected="false">
                                                        Unassigned                                                    
                                                    </a> 
                                                </div>  
                                                <div class="col-sm-12 col-md-4 col-lg-4">                                     
                                                    <a class="flex-sm-fill text-sm-center nav-link active app-utility-item-custome-ticket" id="tickets-assigned" data-bs-toggle="tab" href="#assignedTicket" role="tab" aria-controls="assignedTicket" aria-selected="true">
                                                        Assigned
                                                        <span id="count_unread_notif_assigned_ticket_CS" class="icon-badge-custome-ticket new-ticket m-mt-01" hidden><!-- from ajax --></span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-12 col-md-4 col-lg-4">                                     
                                                    <a class="flex-sm-fill text-sm-center nav-link" id="tickets-archive" data-bs-toggle="tab" href="#archiveTicket" role="tab" aria-controls="archiveTicket" aria-selected="false">
                                                        Archive
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-sm-12 col-md-4 col-lg-4">
                                                    <a class="flex-sm-fill text-sm-center nav-link app-utility-item-custome-ticket" id="my-tickets-open" data-bs-toggle="tab" href="#myOpenTicket" role="tab" aria-controls="myOpenTicket" aria-selected="false">
                                                        My Ticket
                                                        <span id="count_unread_notif_my_ticket_CS" class="icon-badge-custome-ticket new-ticket m-mt-01" hidden><!-- from ajax --></span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-12 col-md-4 col-lg-4">
                                                    <a class="flex-sm-fill text-sm-center nav-link app-utility-item-custome-ticket" id="my-tickets-closed" data-bs-toggle="tab" href="#myClosedTicket" role="tab" aria-controls="myClosedTicket" aria-selected="false">
                                                        My Archive
                                                    </a>
                                                </div>
                                                <div class="col-sm-12 col-md-4 col-lg-4">
                                                    <!-- Button New & Cancel Ticket ========================================================= -->
                                                    <a id="createNewTicket" class="btn app-btn-secondary addBtnTicket" data-bs-toggle="collapse" data-bs-target="#formNewTicket" aria-expanded="false" aria-controls="formNewTicket">                                        
                                                        Add Ticket
                                                    </a>
                                                    <a hidden id="cancelCreateTicket" class="btn app-btn-secondary addBtnTicket" data-bs-toggle="collapse" data-bs-target="#formNewTicket" aria-expanded="false" aria-controls="formNewTicket">
                                                        Cancel 
                                                    </a>   
                                                    <!-- End Button New & Cancel Ticket ===================================================== -->  
                                                </div>
                                            </div>
                                        </nav>
                                      <!-- End Nav Tab List Ticket CS ===================================================-->
                                    <?php }else if($user_level == "Admin"){ ?>
                                      <!-- Nav Tab List Ticket Admin =======================================================-->
                                        <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs-ticket nav flex-column flex-sm-row">
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <a class="flex-sm-fill text-sm-center nav-link active app-utility-item-custome-ticket" id="admin_tickets-open-tab" data-bs-toggle="tab" href="#statAdminOPENTicket" role="tab" aria-controls="statAdminOPENTicket" aria-selected="true">
                                                    Open
                                                    <span id="count_unread_notif_ticket" class="icon-badge-custome-ticket new-ticket m-mt-01" hidden><!-- from ajax --></span>
                                                </a> 
                                            </div>  
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <a class="flex-sm-fill text-sm-center nav-link" id="admin_tickets-closed-tab" data-bs-toggle="tab" href="#statAdminCLOSEDTicket" role="tab" aria-controls="statAdminCLOSEDTicket" aria-selected="false">
                                                    Closed
                                                </a>
                                            </div>
                                        </nav>
                                      <!-- End Nav Tab List Ticket Admin ===================================================-->
                                    <?php } ?>
                                </div>                                
                            </div>                               
                        </div>
                      <!-- End Tab Navigasi Ticket =============================================================== -->

                      <!-- Form New Ticket ======================================================================= -->
                        <div id="formNewTicket" class="accordion-collapse collapse border-0">
                            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('liveChat')?>">
                                <?= csrf_field(); ?> <!-- Proteksi input form -->
                                <div class="app-card-header p-3 border-bottom-0">   
                                  <!-- Select Option form-->
                                    <div class="row mb-4">
                                        <label><h3>Create New Ticket</h3></label>
                                    <!-- Select option subject -->                                        
                                        <div class="form-group" id="subjectOption">
                                            <label for="subjectChat" class="col-form-label">Subject</label>                                            
                                            <select class="form-control js-states form-select" id="subjectChat" name="subjectChat">
                                                <option value="" selected disabled></option>
                                                <option value="Sub_1">Sub 1</option>
                                                <option value="Sub_2">Sub 2</option>
                                                <option value="Sub_3">Sub 3</option>
                                                <option value="Sub_4">Sub 4</option>
                                                <option value="Sub_5">Sub 5</option>
                                                <option value="Sub_6">Sub 6</option>
                                                <option value="Sub_7">Sub 7</option>
                                                <option value="Sub_8">Sub 8</option>
                                                <option value="Sub_9">Sub 9</option>
                                                <option value="Sub_10">Sub 10</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        <!-- Other subject -->
                                        <div class="form-group" id="subjectOther" hidden>
                                            <label for="subjectChatOther" class="col-form-label">Subject</label>
                                            <div class="input-group fg-custome">
                                                <input type="text" class="form-control input-subject" id="subjectChatOther" name="subjectChatOther" placeholder="Enter other subject">                                           
                                                <a class="btn app-btn-secondary" id="cancelOther">
                                                    X
                                                </a>
                                            </div>
                                        </div>
                                    <!-- End select option subject -->                                   

                                    <!-- Select option type ticket -->                                    
                                        <div class="form-group">
                                            <label for="ticket" class="col-form-label">Ticket Type</label>
                                            <select class="form-control form-select" id="ticket" name="ticket" required oninvalid="this.setCustomValidity('Please select one of the following options')" oninput="setCustomValidity('')"> 
                                                <option value="" selected disabled></option>
                                                <option value="type-1">Type 1</option>
                                                <option value="type-2">Type 2</option>
                                                <option value="type-3">Type 3</option>
                                                <option value="type-4">Type 4</option>
                                                <option value="type-5">Type 5</option>
                                            </select>
                                        </div>                                    
                                    <!-- Select option type ticket -->

                                    <!-- Select option select destination user id ================================== -->
                                        <?php if(session()->get('level') == "Admin"){ ?>
                                            <div class="form-group">
                                                <label for="ticket" class="col-form-label">Destination</label>                                        
                                                <select class="form-control form-select" id="du_id" name="du_id" required oninvalid="this.setCustomValidity('Please select destination')" oninput="setCustomValidity('')">
                                                    <!-- <option value="" selected disabled></option> -->
                                                </select>
                                            </div> 
                                        <?php }?> 
                                    <!-- End select option select destination user id ============================== -->

                                    <!-- Select option priority -->
                                        <div class="form-group"> 
                                            <label for="Priority" class="col-form-label">Priority</label>
                                            <select class="form-control form-select" id="priority" name="priority" required oninvalid="this.setCustomValidity('Please select one of the following options')" oninput="setCustomValidity('')">
                                                <option value="" selected disabled></option>
                                                <option value="CRITICAL">CRITICAL</option>
                                                <option value="HIGH">HIGH</option>
                                                <option value="MODERATE">MODERATE</option>
                                                <option value="LOW">LOW</option>
                                                <option value="REQUEST">REQUEST</option>
                                            </select>
                                        </div> 
                                    <!-- End select option priority --> 
                                    </div>
                                  <!-- End select option form-->
                                  <!-- Button submit-->
                                    <div class="row mb-3"> 
                                        <div class="col-12">
                                            <button type="submit" class="btn app-btn-primary width-100">Create</button>
                                        </div>
                                    </div>
                                  <!-- End button submit-->
                                </div>
                            </form>
                        </div>
                      <!-- End Form New Ticket =================================================================== -->

                        <?php if($user_level == "Client"){ ?>
                        <!-- Tab Content Client ================================================================== -->
                            <div class="tab-content container-box-ticket mb-3" id="orders-table-tab-content">
                            <!-- Open Ticket ==================================================================-->
                                <div class="tab-pane fade show active " id="statOPENTicket" role="tabpanel" aria-labelledby="tickets-open-tab"></div>
                            <!-- End Open Ticket ==============================================================-->

                            <!-- Closed Ticket ================================================================-->
                                <div class="tab-pane fade" id="statCLOSEDTicket" role="tabpanel" aria-labelledby="tickets-closed-tab"></div>
                            <!-- End Closed Ticket ============================================================-->

                            <!-- All Ticket ===================================================================-->
                                <div class="tab-pane fade" id="statALLTicket" role="tabpanel" aria-labelledby="tickets-all-tab"></div>
                            <!-- End All Ticket ===============================================================-->
                            </div>
                        <!-- End Tab Content Client ============================================================== -->
                        <?php }else if($user_level == "Cs"){ ?>
                        <!-- Tab Content CS ================================================================== -->
                            <div class="tab-content container-box-ticket mb-3" id="orders-table-tab-content-cs">
                            <!-- Unassigned Ticket ==================================================================-->
                                <div class="tab-pane fade" id="unassignedTicket" role="tabpanel" aria-labelledby="tickets-unassigned"></div>
                            <!-- End Unassigned Ticket ==============================================================-->
                            <!-- Closed Ticket ================================================================-->
                                <div class="tab-pane fade show active" id="assignedTicket" role="tabpanel" aria-labelledby="tickets-assigned"></div>
                            <!-- End Closed Ticket ============================================================-->
                            <!-- Closed Ticket ================================================================-->
                                <div class="tab-pane fade" id="archiveTicket" role="tabpanel" aria-labelledby="tickets-archive"></div>
                            <!-- End Closed Ticket ============================================================-->
                            <!-- My Ticket Open ===============================================================-->
                                <div class="tab-pane fade" id="myOpenTicket" role="tabpanel" aria-labelledby="my-tickets-open"></div>
                            <!-- End My Ticket Open ===========================================================-->
                            <!-- My Ticket Closed =============================================================-->
                                <div class="tab-pane fade" id="myClosedTicket" role="tabpanel" aria-labelledby="my-tickets-closed"></div>
                            <!-- End My Ticket Closed =========================================================-->
                            </div>
                        <!-- End Tab Content CS ============================================================== -->  
                        <?php }else if($user_level == "Admin"){ ?>
                        <!-- Tab Content Client ================================================================== -->
                            <div class="tab-content container-box-ticket mb-3" id="orders-table-tab-content">
                            <!-- Open Ticket ==================================================================-->
                                <div class="tab-pane fade show active " id="statAdminOPENTicket" role="tabpanel" aria-labelledby="admin_tickets-open-tab"></div>
                            <!-- End Open Ticket ==============================================================-->

                            <!-- Closed Ticket ================================================================-->
                                <div class="tab-pane fade" id="statAdminCLOSEDTicket" role="tabpanel" aria-labelledby="admin_tickets-closed-tab"></div>
                            <!-- End Closed Ticket ============================================================-->
                            </div>
                        <!-- End Tab Content Client ============================================================== -->
                        <?php } ?> 
                    </div>

                  <!-- Console Chat ============================================================================== -->
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <!-- Header Console Ticket ================================================================= -->
                        <div class="container pt-3">
                            <div class="row header-console" >
                                <div class="col-8" id="headerInfoConsole">
                                    <!-- Header console, Show information Ticket in here (Display data on javascript) -->
                                </div>
                              <!-- Button Close =====================================================================-->
                                <div class="col-4 header-console-child-btn-closed">
                                    <a class="btn app-btn-set-close" id="btn_closed">Close Ticket</a>                                    
                                </div>
                              <!-- End button Close =================================================================-->
                            </div>                               
                        </div>
                      <!-- End Header Console Ticket ============================================================= -->

                    <!-- Form Console ============================================================================ -->
                      <!-- Body Console Ticket =================================================================== --> 
                        <form id="chat_activity_form">   
                            <?= csrf_field(); ?>     
                          <!-- Chat Console Section ==============================================================-->
                            <div class="col-md-12 form-group">
                                <div class="form-control style-display-box-activity-chat srollbar" name="chat_activity" id="chat_activity">
                                    <div class="" id="chat_data"></div> <!-- MENAMPILKAN DATA PERCAKAPAN YANG DIKLOMPOKAN DALAM TANGGAL YANG SAMA -->
                                </div>
                            </div> 
                          <!-- End Chat Console Section ========================================================== -->
                      <!-- End Body Console Ticket =============================================================== -->
                      <!-- Footer Console Ticket ================================================================= -->
                          <!-- Attachment Section ================================================================ -->
                            <div class="col-sm-12 col-md-6 col-lg box-border-file mt-15" id="container-img-file">
                                <!-- <a class="btn app-btn-cancel" id="btn_cancel">Cancel</a> -->
                                <label id="btn_cancel" class="app-btn-cancel">                                      
                                    <a class="" id="btn_cancel">                                        
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                    </svg>
                                    </a>
                                </label>
                                <label id="sendFile" class="icon-send-file" >                                      
                                    <a class="" id="btn_send"> <!-- id="btn_send" pada tombol ini sama dengan id pada tombol send di send input chat. hal tersebut dimungkinkan karena kedua tombol ini ditampilkan tidak bersamaan, jika satu tampil yang lain di hidden dan sebaliknya. --> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-send-fill " viewBox="0 0 16 16">
                                            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                                        </svg>
                                    </a>
                                </label>
                                <div class="attachment-file">
                                    <div class="show-icon-image-file" id="image_file"></div>
                                </div>                                
                                <span class="input-value-file text-center" id="name-file"></span>
                            </div>
                          <!-- End Attachment Section ============================================================ -->
                            
                            <div class="container box-border-input mt-15" id="footer_console">  
                              <!-- Input Chat Section -->                                          
                                <div class="col-md-12 form-group "> 
                                    <textarea type="text" 
                                    oninput="onInput(this)" 
                                    onkeydown="onKeyDown(this)" 
                                    onkeyup="onKeyUp(this)" 
                                    onkeypress="onKeyPress(this)" 
                                    onpaste="onPaste(this)" 
                                    oncut="onCut(this)" 
                                    onundo="onUndo(this)" 
                                    onredo="onRedo(this)"
                                    class="form-control style-input-box-activity-chat div-input-text" name="input_chat" id="input_chat" row="20" placeholder="Chat..."></textarea>
                                </div>
                                <input class="form-control input-file-position inputfile" type="file" id="file" name="file"/>
                              <!-- End Input Chat Section -->

                              <!-- Btn Attach, Btn Send Chat Section --> 
                                <label id="attachIcon" class="icon-attachment-file" for="file" >
                                    <a class="" >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-paperclip " viewBox="0 0 16 16">
                                            <path d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z"/>
                                        </svg>
                                    </a>  
                                </label>
                                <label id="sendIcon" class="icon-send-chat" >                                      
                                    <a class="" id="btn_send"> <!-- id="btn_send" pada tombol ini sama dengan id pada tombol send di send file. hal tersebut dimungkinkan karena kedua tombol ini ditampilkan tidak bersamaan, jika satu tampil yang lain di hidden dan sebaliknya. -->                                       
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-send-fill " viewBox="0 0 16 16">
                                            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                                        </svg>
                                    </a>
                                </label>
                              <!-- End Btn Attach, Btn Send Chat Section -->
                            </div>                                        
                        </form>                                                          
                      <!-- End Footer Console Ticket =============================================================== -->
                    <!-- End Form Console ========================================================================== -->
                    </div>                     
                  <!-- End Console Chat ============================================================================ -->
                </div>
            </div>
        </div>
    </div>
   
    
    <script>
      // DEFINISI VARIABLE GLOBAL =================================================================================
        var userID = "<?php echo $id_user; ?>";
        var alertTakeTiketJs = "<?php echo session()->getFlashdata('taken'); ?>";
        var level = "<?php echo $user_level; ?>";         
        var param, idUserClient, id_chat_ticket, paramClosedTicket, paramIDChatTicket, mYt;
        var base_url = "<?php echo base_url();?>";
        var createNewTicket = document.getElementById('createNewTicket');
        var cancelCreateTicket = document.getElementById('cancelCreateTicket');
        var countUnreadNotifTicket = document.getElementById("count_unread_notif_ticket"); // UNTUK OPEN TIKET CLIENT.
        var countUnreadNotifAssignTicketCs = document.getElementById('count_unread_notif_assigned_ticket_CS'); // UNTUK NAV-TAB ASSIGNED TIKET CS.
        var countUnreadNotifMyTicketCs = document.getElementById('count_unread_notif_my_ticket_CS'); // UNTUK NAV-TAB MY TIKET CS.
        
        // BAGIAN HEADER CONSOLE ==================================================================================       
        var btnClosed = document.getElementById('btn_closed');

        // BAGIAN BODY CONSOLE ====================================================================================
        var chatActivity = document.getElementById('chat_activity');
        document.getElementById('file').value='';

        // BAGIAN FOOTER CONSOLE ==================================================================================
        var containImgExt = document.getElementById("container-img-file");
        var imageExt = document.getElementById("image_file");
        var fotConsole = document.getElementById("footer_console");
        var inputChat = document.getElementById('input_chat');        
        var btnSend = document.getElementById('btn_send');        

        // SELECT OPTION SUBJECT DAN OTHER INPUT SUBJECT ==========================================================
        var optionSelect = document.getElementById('subjectOption');        
        var otherOption = document.getElementById('subjectOther');
        var selectSubject = document.getElementById('subjectChat');        
      // ==========================================================================================================

      // MENAMPILKAN DAN MENYEMBUNYIKAN INPUT TEXT PADA FOOTER CONSOLE ============================================
        function hideFooterConsole() { fotConsole.style.opacity = 0; }// MENYEMBUNYIKAN INPUT TEXT PADA FOOTER CONSOLE.        
        function showFooterConsole() { fotConsole.style.opacity = 1; } // MENAMPILKAN INPUT TEXT PADA FOOTER CONSOLE.        
      // ==========================================================================================================

      // MENAMPILKAN NAMA FILE YANG DIPILIH =======================================================================
        (function(e,t,n){
            var r=e.querySelectorAll("html")[0];
            r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")
            
        })(document,window,0);  
        ;( function ( document, window, index )
        {
            var inputs = document.querySelectorAll( '.inputfile' );
            Array.prototype.forEach.call( inputs, function( input )
            {
                var label	 = input.nextElementSibling,
                    labelVal = label.innerHTML;
                input.addEventListener( 'change', function( e )
                {
                    // TAMPILKAN NAMA FILE.
                    var fileName = '';
                    document.querySelector('#name-file').textContent  = fileName;
                    if( this.files && this.files.length > 1 ){
                        fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                    }else{
                        fileName = e.target.value .split( '\\' ).pop();
                    }

                    // AMBIL NAMA FILE.
                    if( fileName ){
                        document.querySelector( '#name-file' ).textContent  = fileName; 
                    }else{
                        label.innerHTML = labelVal;
                    }                        

                    // TAMPILKAN GAMBAR.
                    var new_image = new Image(200);                               
                    let ext;
                    if( fileName )
                    {            
                        // Get extention from file                       
                        ext =  fileName.split(".").pop();

                        // SEMBUNYIKAN INPUT TEXT SAAT MENGIRIM FILE.
                        hideFooterConsole();

                        // BERSIHKAN FILE YANG SUDAH DIKIRIM SEBELUMNYA DARI CONTAINER UPLOAD FILE.
                        document.getElementById("image_file").innerHTML = '';

                        // TAMPILKAN GAMBAR PADA CONTAINER UPLOAD FILE SESUAI EKSTENSI FILE.                   
                        if(ext == 'pdf'){
                            containImgExt.style.display ="block";
                            new_image.src = '<?php echo base_url()?>/assets/images/icons/pdf.png';
                            imageExt.appendChild(new_image);
                            setTimeout(function() {
                                containImgExt.style.opacity = 1;
                            }, 500);
                        }else if(ext == 'doc'){
                            containImgExt.style.display ="block";
                            new_image.src = '<?php echo base_url()?>/assets/images/icons/doc.png';
                            imageExt.appendChild(new_image);
                            setTimeout(function() {
                                containImgExt.style.opacity = 1;
                            }, 500);	
                        }else if(ext == 'docx'){
                            containImgExt.style.display ="block";
                            new_image.src = '<?php echo base_url()?>/assets/images/icons/docx.png';
                            imageExt.appendChild(new_image);
                            setTimeout(function() {
                                containImgExt.style.opacity = 1;
                            }, 500);	
                        }else if(ext == 'txt'){ 
                            containImgExt.style.display ="block";
                            new_image.src = '<?php echo base_url()?>/assets/images/icons/txt.png';
                            imageExt.appendChild(new_image);	
                            setTimeout(function() {
                                containImgExt.style.opacity = 1;
                            }, 500);
                        }else if(ext == 'jpg'){ 
                            containImgExt.style.display ="block";
                            new_image.src = URL.createObjectURL(input.files[0]);
                            imageExt.appendChild(new_image);	
                            setTimeout(function() {
                                containImgExt.style.opacity = 1;
                            }, 500);
                        }else if(ext == 'jpeg'){ 
                            containImgExt.style.display ="block";
                            new_image.src = URL.createObjectURL(input.files[0]);
                            imageExt.appendChild(new_image);	
                            setTimeout(function() {
                                containImgExt.style.opacity = 1;
                            }, 500);
                        }else if(ext == 'png'){ 
                            containImgExt.style.display ="block";
                            new_image.src = URL.createObjectURL(input.files[0]);
                            imageExt.appendChild(new_image);	
                            setTimeout(function() {
                                containImgExt.style.opacity = 1;
                            }, 500);
                        }else{
                            containImgExt.style.display ="block";
                            new_image.src = '<?php echo base_url()?>/assets/images/icons/unknown.png';
                            imageExt.appendChild(new_image);
                            setTimeout(function() {
                                containImgExt.style.opacity = 1;
                            }, 500);
                        }
                    }                
                }); 
                // Firefox bug fix
                input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
                input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
            });        
        }( document, window, 0 ));              
      // ==========================================================================================================

        $(document).ready(function() {            
            // DEFAULT, ATUR NONAKTIF =============================================================================        
                document.getElementById('btn_closed').disabled = true;
                document.getElementById('input_chat').disabled = true;
                document.getElementById('file').disabled = true;
                document.getElementById('btn_send').disabled = true;
                document.getElementById('chat_activity').style.backgroundColor='var(--bs-nav-bg-color)';                
            // ====================================================================================================
            
            // DEFAULT, ATUR MENYEMBUNYIKAN SELECT OPTION PADA FORM NEW TICKET ====================================
                optionSelect.hidden = false;
                otherOption.hidden = true;                
            // ====================================================================================================
            

            //  ===================================SET INTERVAL TO RUNNING FUNCTION================================
                // MENJALANKAN FUNGSI, SAAT HALAMAN DI TAMPILKAN. 
                if(level == "Cs"){
                    loopUnassignTicket(); // MEMPERBAHARUI PERULANGAN CARD TICKET (TIKET YANG BELUM DITUGASKAN PADA CS).
                    getCountNotifTicketCs(); // MEMERIKSA PESAN DENGAN STATUS UNREAD, JIKA ADA TAMPILKAN NOTIF "NEW" PADA NAV-TAB MY TICKET CS.
                }
                loopMsgOpenTicket();  // PERULANGAN CARD TICKET (SISI CLIENT DAN CS).
                getCountNotifTicket(); // MEMERIKSA PESAN DENGAN STATUS UNREAD, JIKA ADA TAMPILKAN NOTIF "NEW" PADA NAV-TAB OPEN TICKET CLIENT DAN ASSIGN TICKET CS.
                
                // MENJALANKAN FUNGSI DENGAN INTERVAL WAKTU YANG DIATUR, UNTUK UPDATE INFORMASI TERBARU UNTUK DITAMPILKAN PADA HALAMAN.
                setInterval(function(){ 
                    // KOSONGKAN ELEMENT DENGAN ID BERIKUT, SEBELUM DILAKUKAN UPDATE DATA BARU (MENCEGAH DATA GANDA DITAMPILKAN).
                        // ADMIN
                        $("#statAdminOPENTicket").empty();
                        $("#statAdminCLOSEDTicket").empty();
                        // CLIENT
                        $("#statOPENTicket").empty();
                        $("#statCLOSEDTicket").empty();
                        // CS
                        $("#assignedTicket").empty();
                        $("#archiveTicket").empty();
                        $("#myOpenTicket").empty(); 
                        $("#myClosedTicket").empty();
                        $("#unassignedTicket").empty();
                    // ===========================================================================================================
                    if(level == "Cs"){
                        loopUnassignTicket(); // MEMPERBAHARUI PERULANGAN CARD TICKET (TIKET YANG BELUM DITUGASKAN PADA CS).
                        getCountNotifTicketCs(); // MEMERIKSA PESAN DENGAN STATUS UNREAD, JIKA ADA TAMPILKAN NOTIF "NEW" PADA NAV-TAB MY TICKET CS.
                    }                                         
                    loopMsgOpenTicket();  // PERULANGAN CARD TICKET (SISI CLIENT DAN CS).                    
                    getCountNotifTicket(); // MEMERIKSA PESAN DENGAN STATUS UNREAD, JIKA ADA TAMPILKAN NOTIF "NEW" PADA NAV-TAB OPEN TICKET CLIENT DAN ASSIGN TICKET CS.
                    
                }, 60000);
            //  =======================================================================================
        });        
    </script>