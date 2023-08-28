// =====================================LOAD UNREAD MESSAGES & LOG INTO THE LIST===================================
    // Function load data new or unread notification message and log, in list notification on navbar top.
    function getLogMsg(){
        var ImgOrIcon = document.getElementById('notif_list');
        
        var icon;
        Promise.all([ // Promise.all([]) DI GUNAKAN UNTUK MENGEKSEKUSI BEBERAPA PERMINTAAN AJAX, DAN MENUNGGU HINGGA SELURUH PERMINTAAN AJAX SELESAI.
            $.ajax({ 
                url: base_url+"/Home/getMsg",
                type: 'GET',
            }),
            $.ajax({
                url: base_url+"/Home/getLog",
                type: 'GET',
            })
        ]).then(function(results) {
            var msgResponse = results[0];
            var logResponse = results[1];
            
            var data = [];
            // Combines both responses into one array
            data.push(...msgResponse);
            data.push(...logResponse);
            // Removes all child elements from notif_list
            while (ImgOrIcon.firstChild) {
                ImgOrIcon.removeChild(ImgOrIcon.firstChild);
            }

            // Loop to display data
            $.each(data, function(index, item) {
                if(level == "Admin"){
                    if(item.categori_notif == 'message' ){
                        var notifItem = document.createElement('div');
                        notifItem.classList.add('item', 'p-3');
                        notifItem.innerHTML =   '<div class="row gx-2 justify-content-between align-items-center">'+
                                                        '<div class="col-auto">'+
                                                            '<img class="profile-image rounded-circle" src="'+base_url+'/assets/images/users/'+item.foto+'" alt="ImgOrIcon">'+ 
                                                        '</div>'+
                                                        '<div class="col">'+
                                                            '<div class="info">'+
                                                                '<div class="desc">new message from '+item.user_name+'</div>'+
                                                                '<div class="meta"></div>'+
                                                            '</div>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<a class="link-mask" id="link_shortcut_msg" data-priority ="'+ item.priority +'" data-ticketstatus ="'+ item.ticketstatus +'" data-subject="'+ item.subject +'" data-id_chat-msg = "'+item.id_chat+'" data-message_id-msg = "'+item.message_id+'" data-user_name-msg = "'+item.user_name+'" data-id_user-msg = "'+item.id_user+'" data-desc_chat-msg = "'+item.desc_chat+'" data-date_chat-msg = "'+item.date_chat+'" data-time_chat-msg = "'+item.time_chat+'" data-bs-toggle="modal" data-bs-target="#messageShow"></a>';
                                                
                        ImgOrIcon.appendChild(notifItem);
                        
                    }else if(item.categori_notif == 'log' ){                        
                        if(item.category == 'Level_3'){
                            icon = '<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-toggle-on" viewBox="0 0 16 16">'+
                                        '<path d="M5 3a5 5 0 0 0 0 10h6a5 5 0 0 0 0-10H5zm6 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>'+
                                    '</svg>';
                        }else if(item.category == 'Level_4'){
                            icon = '<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">'+
                                        '<path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0Zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708ZM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11Z"/>'+
                                    '</svg>';
                        }else if(item.category == 'Level_5'){
                            icon = '<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">'+
                                        '<path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>'+
                                    '</svg>';
                        }
                        var notifItem = document.createElement('div');
                        notifItem.classList.add('item', 'p-3');
                        notifItem.innerHTML =   '<div class="row gx-2 justify-content-between align-items-center">'+
                                                        '<div class="col-auto">'+
                                                            '<label class="profile-image">'+icon+'</label>'+
                                                        '</div>'+
                                                        '<div class="col">'+
                                                            '<div class="info">'+
                                                                '<div class="desc">'+item.desc_log_activity+'</div>'+
                                                                '<div class="meta"></div>'+
                                                            '</div>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<a class="link-mask" id="link_shortcut_log" data-id_user-log = "'+item.id_user+'" data-id_log-log = "'+item.id_log+'" data-desc_log_activity-log = "'+item.desc_log_activity+'" data-date_time-log = "'+item.date_time+'" data-category-log = "'+item.category+'" data-bs-toggle="modal" data-bs-target="#logShow"></a>';
                                                
                        ImgOrIcon.appendChild(notifItem) // Displays the newly created element.                     
                    }
                }
                if(level == "Cs"){
                    console.log('cek',item)
                    if(item.categori_notif == 'message' ){                        
                        var notifItem = document.createElement('div');
                        notifItem.classList.add('item', 'p-3');
                        notifItem.innerHTML =   '<div class="row gx-2 justify-content-between align-items-center">'+
                                                        '<div class="col-auto">'+
                                                            '<img class="profile-image rounded-circle" src="'+base_url+'/assets/images/users/'+item.foto+'" alt="ImgOrIcon">'+ 
                                                        '</div>'+
                                                        '<div class="col">'+
                                                            '<div class="info">'+
                                                                '<div class="desc">new message from '+item.user_name+'</div>'+
                                                                '<div class="meta"></div>'+
                                                            '</div>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<a class="link-mask" id="link_shortcut_msg" data-priority ="'+ item.priority +'" data-ticketstatus ="'+ item.ticketstatus +'" data-subject="'+ item.subject +'" data-id_chat-msg = "'+item.id_chat+'" data-message_id-msg = "'+item.message_id+'" data-user_name-msg = "'+item.user_name+'" data-id_user-msg = "'+item.id_user+'" data-desc_chat-msg = "'+item.desc_chat+'" data-date_chat-msg = "'+item.date_chat+'" data-time_chat-msg = "'+item.time_chat+'" data-bs-toggle="modal" data-bs-target="#messageShow"></a>';
                                                
                        ImgOrIcon.appendChild(notifItem);
                    }
                }
                if(level == "Client"){
                    if(item.categori_notif == 'message' ){
                        var notifItem = document.createElement('div');
                        notifItem.classList.add('item', 'p-3');
                        notifItem.innerHTML =   '<div class="row gx-2 justify-content-between align-items-center">'+
                                                    '<div class="col-auto">'+
                                                        '<img class="profile-image rounded-circle" src="'+base_url+'/assets/images/users/'+item.foto+'" alt="ImgOrIcon">'+ 
                                                    '</div>'+
                                                    '<div class="col">'+
                                                        '<div class="info">'+
                                                            '<div class="desc">new message from '+item.user_name+'</div>'+
                                                            '<div class="meta"></div>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                                // KLIK UNTUK DITAMPILKAN KEDALAM MODAL.
                                                '<a class="link-mask" id="link_shortcut_msg" data-priority ="'+ item.priority +'" data-ticketstatus ="'+ item.ticketstatus +'" data-subject="'+ item.subject +'" data-id_chat-msg = "'+item.id_chat+'" data-message_id-msg = "'+item.message_id+'" data-user_name-msg = "'+item.user_name+'" data-id_user-msg = "'+item.id_user+'" data-desc_chat-msg = "'+item.desc_chat+'" data-date_chat-msg = "'+item.date_chat+'" data-time_chat-msg = "'+item.time_chat+'" data-bs-toggle="modal" data-bs-target="#messageShow"></a>';
                                                
                        ImgOrIcon.appendChild(notifItem);
                    }
                }
            });
        });
    };
// ================================================================================================================


// =====================================DISPLAY DATA TO MODAL======================================================
    // The modal is placed in navigation.php so that it can be accessed from all pages. 
    // Prepare data for dispaly to modal, from list notifikasi in navbar top.
    // ================================MSG==========================
        // Prepare data for modal message detail.
        var messageID, dtl_id_chat, sbj, ticketStatus, priority;
        $(document).delegate('#link_shortcut_msg','click', function(){
            dtl_id_chat = $(this).data('id_chat-msg');           
            messageID = $(this).data('message_id-msg');
            sbj = $(this).data('subject');
            ticketStatus = $(this).data('ticketstatus');
            priority = $(this).data('priority');
            var dtl_user_name = $(this).data('user_name-msg');
            var dtl_desc_chat = $(this).data('desc_chat-msg');
            var dtl_date_chat = $(this).data('date_chat-msg');
            var dtl_time_chat = $(this).data('time_chat-msg');
            $('#show_id_chat').text(dtl_id_chat);
            $('#message_id').text(messageID);
            $('#message_sbj').text(sbj);
            $('#message_priority').text(priority);
            $('#message_ticketstatus').text(ticketStatus);
            $('#show_user_name').text(dtl_user_name);
            $('#show_desc_chat').text(dtl_desc_chat);
            $('#show_date_chat').text(dtl_date_chat);
            $('#show_time_chat').text(dtl_time_chat);

            // Execute the markRead() function, when the details button is clicked
            markReadMsg(); 
            getCountMsgIdTicket(dtl_id_chat);
        });
    // =============================================================

    // ================================LOG==========================
        // Prepare data for modal log detail.
        var idLog, category;
        $(document).delegate('#link_shortcut_log','click', function(){
            idLog = $(this).data('id_log-log');
            var descLogActivity = $(this).data('desc_log_activity-log');
            var dateTime= $(this).data('date_time-log');
            category = $(this).data('category-log');
            $('#show_idLog').text(idLog);
            $('#show_descLogActivity').text(descLogActivity);
            $('#show_dateTime').text(dateTime);
            $('#show_category').text(category);

            // Execute the markRead() function, when the details button is clicked
            markReadLog(); 
        });
    // =============================================================
// ================================================================================================================
 


// ============================================ICON================================================================
    // wrench
    {/* <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wrench-adjustable-circle" viewBox="0 0 16 16">
    <path d="M12.496 8a4.491 4.491 0 0 1-1.703 3.526L9.497 8.5l2.959-1.11c.027.2.04.403.04.61Z"/>
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-1 0a7 7 0 1 0-13.202 3.249l1.988-1.657a4.5 4.5 0 0 1 7.537-4.623L7.497 6.5l1 2.5 1.333 3.11c-.56.251-1.18.39-1.833.39a4.49 4.49 0 0 1-1.592-.29L4.747 14.2A7 7 0 0 0 15 8Zm-8.295.139a.25.25 0 0 0-.288-.376l-1.5.5.159.474.808-.27-.595.894a.25.25 0 0 0 .287.376l.808-.27-.595.894a.25.25 0 0 0 .287.376l1.5-.5-.159-.474-.808.27.596-.894a.25.25 0 0 0-.288-.376l-.808.27.596-.894Z"/>
    </svg>; */}
    // tools
    {/* <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
    <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0Zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708ZM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11Z"/>
    </svg>; */}
    // trash3
    {/* <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
    </svg>; */}
    // toggle2 off
    {/* <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-toggle2-off" viewBox="0 0 16 16">
    <path d="M9 11c.628-.836 1-1.874 1-3a4.978 4.978 0 0 0-1-3h4a3 3 0 1 1 0 6H9z"/>
    <path d="M5 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 1A5 5 0 1 0 5 3a5 5 0 0 0 0 10z"/>
    </svg>; */}
    // toggle2 on
    {/* <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-toggle2-on" viewBox="0 0 16 16">
    <path d="M7 5H3a3 3 0 0 0 0 6h4a4.995 4.995 0 0 1-.584-1H3a2 2 0 1 1 0-4h3.416c.156-.357.352-.692.584-1z"/>
    <path d="M16 8A5 5 0 1 1 6 8a5 5 0 0 1 10 0z"/>
    </svg>; */}

// ================================================================================================================