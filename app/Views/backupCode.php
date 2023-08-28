<script>
                                  // COUNT UNREAD MESSAGE BASED ID TICKET ==============================================
                                    function getCountMsgIdTicket(){
                                        var countUnreadNotifCardTicket = document.getElementById("count_unread_notif_card_ticket_"+id_chat_ticket);
                                        console.log(countUnreadNotifCardTicket);
                                        var dataToSend = {id_chat : id_chat_ticket};
                                        console.log(dataToSend); 
                                        $.ajax({
                                            url: base_url+"/Home/getUnreadCountIdChat",
                                            type: 'GET',
                                            data: dataToSend,
                                            success: function(response) {
                                                console.log(id_chat_ticket, response); 
                                                countUnreadNotifCardTicket.textContent = response;       
                                                if(response == 0){
                                                    // Set style display none if no unread message in database.
                                                    countUnreadNotifCardTicket.hidden = true; 
                                                }else if(response >= 1){
                                                    // Set style display block if there are unread messages in database.                      
                                                    countUnreadNotifCardTicket.hidden = false;
                                                    // Get value from response, and save to countUnreadNotif.
                                                    countUnreadNotifCardTicket.textContent = response;
                                                }                    
                                            }
                                        });
                                    };
                                  // ===================================================================================
                                </script> 
                                <?php 
                                    foreach($ticket as $rowticket){ 
                                        if($rowticket['creator_id'] == $id_user){ // Cek id_user, who create the tickets.
                                            if($rowticket['ticketstatus'] == "OPEN"){ // Cek status ticket if OPEN, show ticket.
                                ?>
                                <div id="statOPENTicket" class="app-card shadow-sm mb-2 mr-1 ml-1">                                 
                                    <div class="app-card-body">
                                        <div class="row headerSubject">
                                            <span class=""><?php echo $rowticket['subject']?></span>
                                        </div>
                                        <div class="row bodySubject">
                                        </div>                                                                       
                                        <div class="row footerSubject">
                                            <div class="col-9 app-utility-item-custome-ticket">
                                                <span class="m-custome-ticket"><?php echo $rowticket['ticketstatus']?></span>                                           
                                                <span class="m-custome-ticket badge bg-danger"><?php echo $rowticket['priority']?></span>                                            
                                                <span class="badge bg-info"><?php echo $rowticket['id_chat']?></span>
                                                <span id="count_unread_notif_card_ticket_<?php echo $rowticket['id_chat']; ?>" class="icon-badge-custome-ticket" hidden><!-- from ajax --></span>
                                            </div>
                                            <div class="col-3 text-end">
                                                <button id="viewChat" 
                                                    class="btn-sm app-btn-secondary btn-secondary-view-ticket"                                                    
                                                    data-id_chat="<?php echo $rowticket['id_chat']?>" 
                                                    data-id_user = "<?php echo $id_user ?>"
                                                >
                                                    View
                                                </button>
                                            </div>
                                        </div>                                        
                                    </div>                                
                                </div>
                                <script> 
                                // Loping                                    
                                    var id_chat_ticket = "<?php echo $rowticket['id_chat']; ?>"; // Get id chat from lopping.
                                    rerunCountMsg();
                                    function rerunCountMsg(){
                                        getCountMsgIdTicket(); // Execute this function.
                                    }
                                    
                                    
                                </script>
                                <?php }}} ?>  

                                <?php 
                                    foreach($ticket as $rowticket){ 
                                        if($rowticket['creator_id'] == $id_user){ // Cek id_user, who create the tickets.
                                            if($rowticket['ticketstatus'] == "CLOSED"){ // Cek status ticket, if CLOSED show ticket.
                                ?>
                                <div class="app-card shadow-sm mb-2 mr-1 ml-1">
                                    <div class="app-card-body">
                                        <div class="row headerSubject">
                                            <span class=""><?php echo $rowticket['subject']?></span>
                                        </div>
                                        <div class="row bodySubject">
                                        </div>
                                        <div class="row footerSubject">
                                            <div class="col-9">
                                                <span class="m-custome-ticket"><?php echo $rowticket['ticketstatus']?></span>                                           
                                                <span class="m-custome-ticket badge bg-danger"><?php echo $rowticket['priority']?></span>                                            
                                                <span class="badge bg-info"><?php echo $rowticket['id_chat']?></span>
                                            </div>
                                            <div class="col-3 text-end">
                                                <button id="viewChat" 
                                                    class="btn-sm app-btn-secondary btn-secondary-view-ticket"                                                   
                                                    data-id_chat="<?php echo $rowticket['id_chat']?>" 
                                                    data-id_user = "<?php echo $id_user ?>"
                                                >
                                                    View
                                                </button>
                                            </div>
                                        </div>                                        
                                    </div>                                                                   
                                </div>                               
                                <?php }}} ?> 

                                <?php 
                                    foreach($ticket as $rowticket){ 
                                        if($rowticket['creator_id'] == $id_user){ // Cek id_user, who create the tickets.
                                            // Show all ticket, OPEN or Closed ticket.
                                ?>
                                <div class="app-card shadow-sm mb-2 mr-1 ml-1">                                 
                                    <div class="app-card-body">
                                        <div class="row headerSubject">
                                            <span class=""><?php echo $rowticket['subject']?></span>
                                        </div>
                                        <div class="row bodySubject">
                                        </div>
                                        <div class="row footerSubject">
                                            <div class="col-9">
                                                <span class="m-custome-ticket"><?php echo $rowticket['ticketstatus']?></span>                                           
                                                <span class="m-custome-ticket badge bg-danger"><?php echo $rowticket['priority']?></span>                                            
                                                <span class="badge bg-info"><?php echo $rowticket['id_chat']?></span>
                                            </div>
                                            <div class="col-3 text-end">
                                                <button id="viewChat" 
                                                    class="btn-sm app-btn-secondary btn-secondary-view-ticket"
                                                    data-id_chat="<?php echo $rowticket['id_chat']?>" 
                                                    data-id_user = "<?php echo $id_user ?>"
                                                >
                                                    View
                                                </button>
                                            </div>
                                        </div>                                        
                                    </div>                                
                                </div>
                                <?php }} ?>