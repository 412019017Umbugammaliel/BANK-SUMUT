// MENAMPILKAN PERULANGAN CARD DARI TIKET CLIENT, CS, ADMIN ===================================================================
    function loopMsgOpenTicket()
    {         
        $.ajax({
            url: base_url+"/LiveChatController/retriveTicketData",
            type: 'GET',
            success: function(response) {                
            // URUTKAN CARD BERDASARKAN SORTIRAN TANGGAL TERBARU =============
                response.sort(function(a, b) {
                    var dateA = new Date(a.datetime);
                    var dateB = new Date(b.datetime);
                    return dateB - dateA;
                });
            // ===============================================================

                for(var i = 0; i < response.length; i++) {
                    // ATUR WARNA SESUAI KONDISI ============================================
                    var card_bg_stat, card_bg_prio;
                    
                    if(response[i].ticketstatus == "OPEN"){ card_bg_stat = "bg-info" }
                    else if(response[i].ticketstatus == "CLOSED"){ card_bg_stat = "bg-black" };
                    if(response[i].priority == "CRITICAL"){ card_bg_prio = "bg-critical" }
                    else if(response[i].priority == "HIGH"){ card_bg_prio = "bg-high" }
                    else if(response[i].priority == "MODERATE"){ card_bg_prio = "bg-moderat" }
                    else if(response[i].priority == "LOW"){ card_bg_prio = "bg-low" }
                    else if(response[i].priority == "REQUEST"){ card_bg_prio = "bg-request" };
                    // =====================================================================

                    if(level == 'Client') // CEK LEVEL CLIENT.
                    {   
                        if(response[i].creator_id == userID) // TAMPILKAN CARD YANG DIBUAT OLEH PENGGUNA SENDIRI.
                        {   
                            if(response[i].ticketstatus == 'OPEN') // TAMPILKAN CARD DENGAN STATUS TIKET OPEN.
                            {   
                                     
                                // KOSONGKAN JUMLAH NOTIFIKASI PADA TIKET (JUMLAH NOTIF PESAN BARU).
                                $("#count_unread_notif_card_ticket_"+ response[i].id_chat ).empty();
                                if(response[i].assigned_name_cs){
                                    var assignedNameCS = 'Handled by: '+response[i].assigned_name_cs;
                                    var fontColor = "";
                                }else{
                                    var assignedNameCS = "Waiting for CS";
                                    var fontColor = "fontColorNameCS";
                                }
                                // TAMPILKAN CARD TICKET PADA ELEMENT DENGAN ID statOPENTicket.
                                $("#statOPENTicket").append(
                                    '<div class="app-card shadow-sm mb-2 mr-1 ml-1 ticket_card">'+
                                        '<div class="app-card-body">'+
                                            '<div class="row headerSubject padding_hs">'+
                                                '<div class="col-6">'+
                                                    '<span class="">'+ response[i].subject +'</span>'+
                                                '</div>'+
                                                '<div class="col-6 text-end">'+
                                                    '<div class="row">'+
                                                        '<span class="elapsedDateTicket " id="intervalDate_'+response[i].id_chat+'"></span>'+
                                                    '</div>'+
                                                    '<div class="row">'+
                                                        '<span class="senderNameTicket pt-1 '+fontColor+'">'+ assignedNameCS +'</span>'+
                                                    '</div>'+
                                                '</div>'+
                                                
                                            '</div>'+
                                            '<div class="row bodySubject">'+
                                                ''+
                                            '</div>'+
                                            '<div class="row footerSubject">'+
                                                '<div class="col-9 app-utility-item-custome-ticket">'+
                                                    '<span class="m-custome-ticket badge '+ card_bg_prio +'">'+ response[i].priority +'</span>'+ // Display Prioroty Ticket On Card Ticket.
                                                    '<span class="badge bg-info">'+ response[i].id_chat +'</span>'+ // Display Id Ticket On Card Ticket.
                                                    '<span id="count_unread_notif_card_ticket_'+ response[i].id_chat +'" class="icon-badge-custome-ticket" hidden></span>'+ // Displays The Number Of Unread Messages. 
                                                '</div>'+
                                                '<div class="col-3 text-end">'+
                                                    '<button id="viewChat" onclick="goToConsoleFunction(\''+response[i].id_chat+'\')" class="btn-sm app-btn-secondary btn-secondary-view-ticket">'+
                                                        'View'+
                                                    '</button>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'                                
                                );
                                // AMBIL DAN TAMPUNG ID CHAT, DAN KIRIM KEDALAM FUNGSI getCountMsgIdTicket.
                                id_chat_ticket = response[i].id_chat;
                                // FUNGSI INI DIJALANKAN UNTUK MENGAMBIL JUMLAH NOTIF/ PESAN UNREAD. DIPANGGIL DIDALAM PERULANGAN AGAR MENAMPILKAN NOTIF DISETIAP CARD TCKETNYA.
                                getCountMsgIdTicket(id_chat_ticket); 

                                // MEMANGGIL FUNGSI SELISIH WAKTU SEBAGAI INFO MENAMPILKAN LAMA WAKTU TICKET SUDAH DIBUAT.
                                var interval_date = document.getElementById("intervalDate_"+response[i].id_chat); // MENGAMBIL ID DARI ELEMENT UNTUK MENAMPILKAN INTERVAL WAKTU.
                                var ticketCreatedDate = new Date(response[i].datetime); // MEMBUAT OBJECT DATE TIME DARI TANGGAL PERTAMA CRD TICKET DIBUAT.
                                var elapsedTime = formatElapsedTime(ticketCreatedDate); // MENGIRIM OBJECT TANGGAL DAN WAKTU YANG DIBUAT, KEDALAM FUNGSI formatElapsedTime. (HASIL DI RETRUN DAN DISIMPAN DALAM VAR elapsedTime). 
                                if(interval_date){
                                    interval_date.textContent = elapsedTime; // HASIL RETURN YANG DITAMPUNG DALAM elapsedTime, DI CETAK KEDALAM interval_date/ ELEMENT ID UNTUK MENAMPILKAN SELANG WAKTUNYA SEJAK PERTAMA DIBUAT.
                                }
                                // ====================================================================================                            
                            }
                            if(response[i].ticketstatus == 'CLOSED') // TAMPILKAN CARD DENGAN STATUS TIKET CLOSED.
                            {
                                if(response[i].assigned_name_cs){
                                    var assignedNameCS = 'Handled by: '+response[i].assigned_name_cs;
                                    var fontColor = "";
                                }else{
                                    var assignedNameCS = "No response from cs";
                                    var fontColor = "fontColorNameCS";
                                }
                                // TAMPILKAN CARD TICKET PADA ELEMENT DENGAN ID statCLOSEDTicket.
                                $("#statCLOSEDTicket").append(
                                    '<div class="app-card shadow-sm mb-2 mr-1 ml-1 ticket_card">'+
                                        '<div class="app-card-body">'+
                                            '<div class="row headerSubject padding_hs">'+
                                                '<div class="col-6">'+
                                                    '<span class="">'+ response[i].subject +'</span>'+
                                                '</div>'+
                                                '<div class="col-6 text-end">'+
                                                    '<div class="row">'+
                                                        '<span class="elapsedDateTicket " id="intervalDate_'+response[i].id_chat+'"></span>'+
                                                    '</div>'+
                                                    '<div class="row">'+
                                                        '<span class="senderNameTicket pt-1 '+fontColor+'">'+ assignedNameCS +'</span>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="row bodySubject">'+
                                                ''+
                                            '</div>'+
                                            '<div class="row footerSubject">'+
                                                '<div class="col-9 app-utility-item-custome-ticket">'+
                                                    '<span class="m-custome-ticket badge '+ card_bg_prio +'">'+ response[i].priority +'</span>'+
                                                    '<span class="badge bg-info">'+ response[i].id_chat +'</span>'+                                                    
                                                '</div>'+
                                                '<div class="col-3 text-end">'+
                                                    '<button id="viewChat" onclick="goToConsoleFunction(\''+response[i].id_chat+'\')" class="btn-sm app-btn-secondary btn-secondary-view-ticket">'+
                                                        'View'+
                                                    '</button>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'
                                );
                                // MEMANGGIL FUNGSI SELISIH WAKTU SEBAGAI INFO MENAMPILKAN LAMA WAKTU TICKET SUDAH DIBUAT.
                                var interval_date = document.getElementById("intervalDate_"+response[i].id_chat); // MENGAMBIL ID DARI ELEMENT UNTUK MENAMPILKAN INTERVAL WAKTU.
                                var ticketCreatedDate = new Date(response[i].datetime); // MEMBUAT OBJECT DATE TIME DARI TANGGAL PERTAMA CRD TICKET DIBUAT.
                                var elapsedTime = formatElapsedTime(ticketCreatedDate); // MENGIRIM OBJECT TANGGAL DAN WAKTU YANG DIBUAT, KEDALAM FUNGSI formatElapsedTime. (HASIL DI RETRUN DAN DISIMPAN DALAM VAR elapsedTime). 
                                if(interval_date){
                                    interval_date.textContent = elapsedTime; // HASIL RETURN YANG DITAMPUNG DALAM elapsedTime, DI CETAK KEDALAM interval_date/ ELEMENT ID UNTUK MENAMPILKAN SELANG WAKTUNYA SEJAK PERTAMA DIBUAT.
                                }
                                // ====================================================================================
                            }
                        } 
                    }
                    else if(level == 'Cs') // CEK LEVEL CS.
                    {                        
                        if(response[i].destination_id_user == 'CS_Center') // TAMPILKAN HANYA CARD TICKET YANG DITUJUKAN PADA CS CENTER.
                        {                            
                            if(response[i].assigned_id_cs == userID) // TAMPILKAN CARD TICKET YANG SDUAH MENDAPAT PENUGASAN PADA CS TERSEBUT.
                            { 
                                if(response[i].ticketstatus == 'OPEN') //TAMPILKAN CARD TICKET YANG MEMILIKI STATUS OPEN.
                                {                                       
                                    // KOSONGKAN JUMLAH NOTIFIKASI PADA TIKET (JUMLAH NOTIF PESAN BARU).
                                    $("#count_unread_notif_card_ticket_"+ response[i].id_chat ).empty();                            
                                    // TAMPILKAN CARD TICKET PADA ELEMENT DENGAN ID assignedTicket.
                                    $("#assignedTicket").append( '<div class="app-card shadow-sm mb-2 mr-1 ml-1 ticket_card">'+
                                            '<div class="app-card-body">'+
                                                '<div class="row headerSubject padding_hs">'+
                                                    '<div class="col-6">'+
                                                        '<span class="">'+ response[i].subject +'</span>'+
                                                    '</div>'+
                                                    '<div class="col-6 text-end">'+
                                                        '<div class="row">'+
                                                            '<span class="senderNameTicket ">'+ response[i].creator_name +'</span>'+
                                                        '</div>'+
                                                        '<div class="row">'+                                                            
                                                            '<span class="elapsedDateTicket " id="intervalDate_'+response[i].id_chat+'"></span>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="row bodySubject">'+
                                                    ''+
                                                '</div>'+
                                                '<div class="row footerSubject">'+
                                                    '<div class="col-9 app-utility-item-custome-ticket">'+
                                                        '<span class="m-custome-ticket badge '+ card_bg_prio +'">'+ response[i].priority +'</span>'+ // Display Prioroty Ticket On Card Ticket.
                                                        '<span class="badge bg-info">'+ response[i].id_chat +'</span>'+ // Display Id Ticket On Card Ticket.
                                                        '<span id="count_unread_notif_card_ticket_'+response[i].id_chat+'" class="icon-badge-custome-ticket" hidden></span>'+ // Displays The Number Of Unread Messages.                                                         
                                                    '</div>'+
                                                    '<div class="col-3 text-end">'+
                                                        '<button id="viewChat" onclick="goToConsoleFunction(\''+response[i].id_chat+'\')" class="btn-sm app-btn-secondary btn-secondary-view-ticket">'+
                                                            'View'+
                                                        '</button>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'
                                    );
                                    // AMBIL DAN TAMPUNG ID CHAT, DAN KIRIM KEDALAM FUNGSI getCountMsgIdTicket.
                                    id_chat_ticket = response[i].id_chat;
                                    // FUNGSI INI DIJALANKAN UNTUK MENGAMBIL JUMLAH NOTIF/ PESAN UNREAD. DIPANGGIL DIDALAM PERULANGAN AGAR MENAMPILKAN NOTIF DISETIAP CARD TCKETNYA.
                                    getCountMsgIdTicket(id_chat_ticket);
                                    
                                    // MEMANGGIL FUNGSI SELISIH WAKTU SEBAGAI INFO MENAMPILKAN LAMA WAKTU TICKET SUDAH DIBUAT.
                                    var interval_date = document.getElementById("intervalDate_"+response[i].id_chat); // MENGAMBIL ID DARI ELEMENT UNTUK MENAMPILKAN INTERVAL WAKTU.
                                    var ticketCreatedDate = new Date(response[i].datetime); // MEMBUAT OBJECT DATE TIME DARI TANGGAL PERTAMA CRD TICKET DIBUAT.
                                    var elapsedTime = formatElapsedTime(ticketCreatedDate); // MENGIRIM OBJECT TANGGAL DAN WAKTU YANG DIBUAT, KEDALAM FUNGSI formatElapsedTime. (HASIL DI RETRUN DAN DISIMPAN DALAM VAR elapsedTime).
                                    if(interval_date){
                                        interval_date.textContent = elapsedTime; // HASIL RETURN YANG DITAMPUNG DALAM elapsedTime, DI CETAK KEDALAM interval_date/ ELEMENT ID UNTUK MENAMPILKAN SELANG WAKTUNYA SEJAK PERTAMA DIBUAT.
                                    }
                                    // ====================================================================================
                                }
                                if(response[i].ticketstatus == 'CLOSED') //TAMPILKAN CARD TICKET YANG MEMILIKI STATUS CLOSED.
                                {
                                    // TAMPILKAN CARD TICKET PADA ELEMENT DENGAN ID archiveTicket.
                                    $("#archiveTicket").append(
                                        '<div class="app-card shadow-sm mb-2 mr-1 ml-1 ticket_card">'+
                                            '<div class="app-card-body">'+
                                                '<div class="row headerSubject padding_hs">'+
                                                    '<div class="col-6">'+
                                                        '<span class="">'+ response[i].subject +'</span>'+
                                                    '</div>'+
                                                    '<div class="col-6 text-end">'+
                                                        '<div class="row">'+
                                                            '<span class="senderNameTicket ">'+ response[i].creator_name +'</span>'+
                                                        '</div>'+
                                                        '<div class="row">'+                                                            
                                                            '<span class="elapsedDateTicket " id="intervalDate_'+response[i].id_chat+'"></span>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="row bodySubject">'+
                                                    ''+
                                                '</div>'+
                                                '<div class="row footerSubject">'+
                                                    '<div class="col-9 app-utility-item-custome-ticket">'+
                                                        '<span class="m-custome-ticket badge '+ card_bg_prio +'">'+ response[i].priority +'</span>'+ // Display Prioroty Ticket On Card Ticket.
                                                        '<span class="badge bg-info">'+ response[i].id_chat +'</span>'+ // Display Id Ticket On Card Ticket.                                                        
                                                    '</div>'+
                                                    '<div class="col-3 text-end">'+
                                                        '<button id="viewChat" onclick="goToConsoleFunction(\''+response[i].id_chat+'\')" class="btn-sm app-btn-secondary btn-secondary-view-ticket">'+
                                                            'View'+
                                                        '</button>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'
                                    );

                                    // MEMANGGIL FUNGSI SELISIH WAKTU SEBAGAI INFO MENAMPILKAN LAMA WAKTU TICKET SUDAH DIBUAT.
                                    var interval_date = document.getElementById("intervalDate_"+response[i].id_chat); // MENGAMBIL ID DARI ELEMENT UNTUK MENAMPILKAN INTERVAL WAKTU.
                                    var ticketCreatedDate = new Date(response[i].datetime); // MEMBUAT OBJECT DATE TIME DARI TANGGAL PERTAMA CRD TICKET DIBUAT.
                                    var elapsedTime = formatElapsedTime(ticketCreatedDate); // MENGIRIM OBJECT TANGGAL DAN WAKTU YANG DIBUAT, KEDALAM FUNGSI formatElapsedTime. (HASIL DI RETRUN DAN DISIMPAN DALAM VAR elapsedTime).
                                    if(interval_date){
                                        interval_date.textContent = elapsedTime; // HASIL RETURN YANG DITAMPUNG DALAM elapsedTime, DI CETAK KEDALAM interval_date/ ELEMENT ID UNTUK MENAMPILKAN SELANG WAKTUNYA SEJAK PERTAMA DIBUAT.
                                    }
                                    // ====================================================================================
                                }
                            }
                        }
                        if(response[i].creator_id == userID) // TAMPILKAN CARD YANG DIBUAT OLEH PENGGUNA SENDIRI.
                        {
                            if(response[i].ticketstatus == 'OPEN') // TAMPILKAN CARD DENGAN STATUS TIKET OPEN.
                            {                                
                                // KOSONGKAN JUMLAH NOTIFIKASI PADA TIKET (JUMLAH NOTIF PESAN BARU).
                                $("#count_unread_notif_card_ticket_cs_"+ response[i].id_chat ).empty();                            
                                // TAMPILKAN CARD TICKET PADA ELEMENT DENGAN ID statOPENTicket.
                                $("#myOpenTicket").append(
                                    '<div class="app-card shadow-sm mb-2 mr-1 ml-1 ticket_card">'+
                                        '<div class="app-card-body">'+
                                            '<div class="row headerSubject padding_hs">'+
                                                '<div class="col-6">'+
                                                    '<span class="">'+ response[i].subject +'</span>'+
                                                '</div>'+
                                                '<div class="col-6 text-end">'+
                                                    '<span class="elapsedDateTicket" id="intervalDate_'+response[i].id_chat+'"></span>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="row bodySubject">'+
                                                ''+
                                            '</div>'+
                                            '<div class="row footerSubject">'+
                                                '<div class="col-9 app-utility-item-custome-ticket">'+
                                                    '<span class="m-custome-ticket badge '+ card_bg_prio +'">'+ response[i].priority +'</span>'+ // Display Prioroty Ticket On Card Ticket.
                                                    '<span class="badge bg-info">'+ response[i].id_chat +'</span>'+ // Display Id Ticket On Card Ticket.
                                                    '<span id="count_unread_notif_card_ticket_cs_'+ response[i].id_chat +'" class="icon-badge-custome-ticket" hidden></span>'+ // Displays The Number Of Unread Messages. 
                                                '</div>'+
                                                '<div class="col-3 text-end">'+
                                                    '<button id="viewChat" onclick="goToConsoleFunction(\''+response[i].id_chat+'\',\''+mYt+'\')" class="btn-sm app-btn-secondary btn-secondary-view-ticket">'+
                                                        'View'+
                                                    '</button>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'                                
                                );
                                // AMBIL DAN TAMPUNG ID CHAT, DAN KIRIM KEDALAM FUNGSI getCountMsgIdTicket.
                                id_chat_ticket_cs = response[i].id_chat;
                                // FUNGSI INI DIJALANKAN UNTUK MENGAMBIL JUMLAH NOTIF/ PESAN UNREAD. DIPANGGIL DIDALAM PERULANGAN AGAR MENAMPILKAN NOTIF DISETIAP CARD TCKETNYA.
                                getCountMsgIdTicketCs(id_chat_ticket_cs); 

                                // MEMANGGIL FUNGSI SELISIH WAKTU SEBAGAI INFO MENAMPILKAN LAMA WAKTU TICKET SUDAH DIBUAT.
                                var interval_date = document.getElementById("intervalDate_"+response[i].id_chat); // MENGAMBIL ID DARI ELEMENT UNTUK MENAMPILKAN INTERVAL WAKTU.
                                var ticketCreatedDate = new Date(response[i].datetime); // MEMBUAT OBJECT DATE TIME DARI TANGGAL PERTAMA CRD TICKET DIBUAT.
                                var elapsedTime = formatElapsedTime(ticketCreatedDate); // MENGIRIM OBJECT TANGGAL DAN WAKTU YANG DIBUAT, KEDALAM FUNGSI formatElapsedTime. (HASIL DI RETRUN DAN DISIMPAN DALAM VAR elapsedTime). 
                                interval_date.textContent = elapsedTime; // HASIL RETURN YANG DITAMPUNG DALAM elapsedTime, DI CETAK KEDALAM interval_date/ ELEMENT ID UNTUK MENAMPILKAN SELANG WAKTUNYA SEJAK PERTAMA DIBUAT.
                                // ===============================================================================================
                            }
                            if(response[i].ticketstatus == 'CLOSED') // TAMPILKAN CARD DENGAN STATUS TIKET CLOSED.
                            {
                                // TAMPILKAN CARD TICKET PADA ELEMENT DENGAN ID statCLOSEDTicket.
                                $("#myClosedTicket").append(
                                    '<div class="app-card shadow-sm mb-2 mr-1 ml-1 ticket_card">'+
                                        '<div class="app-card-body">'+
                                            '<div class="row headerSubject padding_hs">'+
                                                '<div class="col-6">'+
                                                    '<span class="">'+ response[i].subject +'</span>'+
                                                '</div>'+
                                                '<div class="col-6 text-end">'+
                                                    '<span class="elapsedDateTicket" id="intervalDate_'+response[i].id_chat+'"></span>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="row bodySubject">'+
                                                ''+
                                            '</div>'+
                                            '<div class="row footerSubject">'+
                                                '<div class="col-9 app-utility-item-custome-ticket">'+
                                                    '<span class="m-custome-ticket badge '+ card_bg_prio +'">'+ response[i].priority +'</span>'+
                                                    '<span class="badge bg-info">'+ response[i].id_chat +'</span>'+                                                    
                                                '</div>'+
                                                '<div class="col-3 text-end">'+
                                                    '<button id="viewChat" onclick="goToConsoleFunction(\''+response[i].id_chat+'\')" class="btn-sm app-btn-secondary btn-secondary-view-ticket">'+
                                                        'View'+
                                                    '</button>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'
                                );
                                // MEMANGGIL FUNGSI SELISIH WAKTU SEBAGAI INFO MENAMPILKAN LAMA WAKTU TICKET SUDAH DIBUAT.
                                var interval_date = document.getElementById("intervalDate_"+response[i].id_chat); // MENGAMBIL ID DARI ELEMENT UNTUK MENAMPILKAN INTERVAL WAKTU.
                                var ticketCreatedDate = new Date(response[i].datetime); // MEMBUAT OBJECT DATE TIME DARI TANGGAL PERTAMA CRD TICKET DIBUAT.
                                var elapsedTime = formatElapsedTime(ticketCreatedDate); // MENGIRIM OBJECT TANGGAL DAN WAKTU YANG DIBUAT, KEDALAM FUNGSI formatElapsedTime. (HASIL DI RETRUN DAN DISIMPAN DALAM VAR elapsedTime). 
                                interval_date.textContent = elapsedTime; // HASIL RETURN YANG DITAMPUNG DALAM elapsedTime, DI CETAK KEDALAM interval_date/ ELEMENT ID UNTUK MENAMPILKAN SELANG WAKTUNYA SEJAK PERTAMA DIBUAT.
                                // ====================================================================================
                            }
                        }
                    }
                    else if(level == 'Admin') // CEK LEVEL CLIENT.
                    {   
                        if(response[i].destination_id_user == 'Admin_idnKa_20301') // TAMPILKAN HANYA CARD TICKET YANG DITUJUKAN PADA CS CENTER.
                        {   
                            if(response[i].ticketstatus == 'OPEN') // TAMPILKAN CARD DENGAN STATUS TIKET OPEN.
                            {               
                                // KOSONGKAN JUMLAH NOTIFIKASI PADA TIKET (JUMLAH NOTIF PESAN BARU).
                                $("#count_unread_notif_card_ticket_"+ response[i].id_chat ).empty(); 
                                if(response[i].creator_name){
                                    var fromNameCS = 'From: '+response[i].creator_name;
                                }                          
                                // TAMPILKAN CARD TICKET PADA ELEMENT DENGAN ID statOPENTicket.
                                $("#statAdminOPENTicket").append(
                                    '<div class="app-card shadow-sm mb-2 mr-1 ml-1 ticket_card">'+
                                        '<div class="app-card-body">'+
                                            '<div class="row headerSubject padding_hs">'+
                                                '<div class="col-6">'+
                                                    '<span class="">'+ response[i].subject +'</span>'+
                                                '</div>'+
                                                '<div class="col-6 text-end">'+
                                                    '<div class="row">'+
                                                        '<span class="elapsedDateTicket " id="intervalDate_'+response[i].id_chat+'"></span>'+
                                                    '</div>'+
                                                    '<div class="row">'+
                                                        '<span class="senderNameTicket pt-1">'+ fromNameCS +'</span>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="row bodySubject">'+
                                                ''+
                                            '</div>'+
                                            '<div class="row footerSubject">'+
                                                '<div class="col-9 app-utility-item-custome-ticket">'+
                                                    '<span class="m-custome-ticket badge '+ card_bg_prio +'">'+ response[i].priority +'</span>'+ // Display Prioroty Ticket On Card Ticket.
                                                    '<span class="badge bg-info">'+ response[i].id_chat +'</span>'+ // Display Id Ticket On Card Ticket.
                                                    '<span id="count_unread_notif_card_ticket_'+ response[i].id_chat +'" class="icon-badge-custome-ticket" hidden></span>'+ // Displays The Number Of Unread Messages. 
                                                '</div>'+
                                                '<div class="col-3 text-end">'+
                                                    '<button id="viewChat" onclick="goToConsoleFunction(\''+response[i].id_chat+'\')" class="btn-sm app-btn-secondary btn-secondary-view-ticket">'+
                                                        'View'+
                                                    '</button>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'                                
                                );
                                // AMBIL DAN TAMPUNG ID CHAT, DAN KIRIM KEDALAM FUNGSI getCountMsgIdTicket.
                                id_chat_ticket = response[i].id_chat;
                                // FUNGSI INI DIJALANKAN UNTUK MENGAMBIL JUMLAH NOTIF/ PESAN UNREAD. DIPANGGIL DIDALAM PERULANGAN AGAR MENAMPILKAN NOTIF DISETIAP CARD TCKETNYA.
                                getCountMsgIdTicket(id_chat_ticket); 

                                // MEMANGGIL FUNGSI SELISIH WAKTU SEBAGAI INFO MENAMPILKAN LAMA WAKTU TICKET SUDAH DIBUAT.
                                var interval_date = document.getElementById("intervalDate_"+response[i].id_chat); // MENGAMBIL ID DARI ELEMENT UNTUK MENAMPILKAN INTERVAL WAKTU.
                                var ticketCreatedDate = new Date(response[i].datetime); // MEMBUAT OBJECT DATE TIME DARI TANGGAL PERTAMA CRD TICKET DIBUAT.
                                var elapsedTime = formatElapsedTime(ticketCreatedDate); // MENGIRIM OBJECT TANGGAL DAN WAKTU YANG DIBUAT, KEDALAM FUNGSI formatElapsedTime. (HASIL DI RETRUN DAN DISIMPAN DALAM VAR elapsedTime). 
                                if(interval_date){
                                    interval_date.textContent = elapsedTime; // HASIL RETURN YANG DITAMPUNG DALAM elapsedTime, DI CETAK KEDALAM interval_date/ ELEMENT ID UNTUK MENAMPILKAN SELANG WAKTUNYA SEJAK PERTAMA DIBUAT.
                                }
                                // ====================================================================================                            
                            }
                            if(response[i].ticketstatus == 'CLOSED') // TAMPILKAN CARD DENGAN STATUS TIKET CLOSED.
                            {
                                if(response[i].creator_name){
                                    var fromNameCS = 'From: '+response[i].creator_name;
                                }  
                                // TAMPILKAN CARD TICKET PADA ELEMENT DENGAN ID statCLOSEDTicket.
                                $("#statAdminCLOSEDTicket").append(
                                    '<div class="app-card shadow-sm mb-2 mr-1 ml-1 ticket_card">'+
                                        '<div class="app-card-body">'+
                                            '<div class="row headerSubject padding_hs">'+
                                                '<div class="col-6">'+
                                                    '<span class="">'+ response[i].subject +'</span>'+
                                                '</div>'+
                                                '<div class="col-6 text-end">'+
                                                    '<div class="row">'+
                                                        '<span class="elapsedDateTicket " id="intervalDate_'+response[i].id_chat+'"></span>'+
                                                    '</div>'+
                                                    '<div class="row">'+
                                                        '<span class="senderNameTicket pt-1">'+ fromNameCS +'</span>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="row bodySubject">'+
                                                ''+
                                            '</div>'+
                                            '<div class="row footerSubject">'+
                                                '<div class="col-9 app-utility-item-custome-ticket">'+
                                                    '<span class="m-custome-ticket badge '+ card_bg_prio +'">'+ response[i].priority +'</span>'+
                                                    '<span class="badge bg-info">'+ response[i].id_chat +'</span>'+                                                    
                                                '</div>'+
                                                '<div class="col-3 text-end">'+
                                                    '<button id="viewChat" onclick="goToConsoleFunction(\''+response[i].id_chat+'\')" class="btn-sm app-btn-secondary btn-secondary-view-ticket">'+
                                                        'View'+
                                                    '</button>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'
                                );
                                // MEMANGGIL FUNGSI SELISIH WAKTU SEBAGAI INFO MENAMPILKAN LAMA WAKTU TICKET SUDAH DIBUAT.
                                var interval_date = document.getElementById("intervalDate_"+response[i].id_chat); // MENGAMBIL ID DARI ELEMENT UNTUK MENAMPILKAN INTERVAL WAKTU.
                                var ticketCreatedDate = new Date(response[i].datetime); // MEMBUAT OBJECT DATE TIME DARI TANGGAL PERTAMA CRD TICKET DIBUAT.
                                var elapsedTime = formatElapsedTime(ticketCreatedDate); // MENGIRIM OBJECT TANGGAL DAN WAKTU YANG DIBUAT, KEDALAM FUNGSI formatElapsedTime. (HASIL DI RETRUN DAN DISIMPAN DALAM VAR elapsedTime). 
                                if(interval_date){
                                    interval_date.textContent = elapsedTime; // HASIL RETURN YANG DITAMPUNG DALAM elapsedTime, DI CETAK KEDALAM interval_date/ ELEMENT ID UNTUK MENAMPILKAN SELANG WAKTUNYA SEJAK PERTAMA DIBUAT.
                                }
                                // ====================================================================================
                            }
                        } 
                    }
                }                
            },error: function(xhr, status, error) {
                console.error(error); // Tampilkan kesalahan pada konsol jika ada
            }
        });
    };
// ================================================================================================================================

// PERULANGAN CARD UNASSIGNED TICKET UNTUK CS =====================================================================================
    function loopUnassignTicket()
    {              
        $.ajax({
            url: base_url+"/LiveChatController/retriveTicketData",
            type: 'GET',
            success: function(response_unassigned_card) { 
            // URUTKAN CARD BERDASARKAN SORTIRAN TANGGAL TERBARU =============
                response_unassigned_card.sort(function(a, b) {
                    var dateA = new Date(a.datetime);
                    var dateB = new Date(b.datetime);
                    return dateB - dateA;
                });
            // ==============================================================                
                
                for(var i = 0; i < response_unassigned_card.length; i++) {
                    // ATUR WARNA SESUAI KONDISI ============================================
                    var card_bg_stat, card_bg_prio;
                    if(response_unassigned_card[i].ticketstatus == "OPEN"){ card_bg_stat = "bg-info" }
                    else if(response_unassigned_card[i].ticketstatus == "CLOSED"){ card_bg_stat = "bg-black" };
                    if(response_unassigned_card[i].priority == "CRITICAL"){ card_bg_prio = "bg-critical" }
                    else if(response_unassigned_card[i].priority == "HIGH"){ card_bg_prio = "bg-high" }
                    else if(response_unassigned_card[i].priority == "MODERATE"){ card_bg_prio = "bg-moderat" }
                    else if(response_unassigned_card[i].priority == "LOW"){ card_bg_prio = "bg-low" }
                    else if(response_unassigned_card[i].priority == "REQUEST"){ card_bg_prio = "bg-request" };
                    // =====================================================================
                    
                    if(level == 'Cs') // CEK LEVEL CS
                    {   // MENAMPILKAN CARD YANG DITUJUKAN PADA CS_CENTER
                        if(response_unassigned_card[i].destination_id_user == 'CS_Center') // CEK USER YANG DITUJU ADALAH CS_CENTER.
                        {   // MENAMPILKAN CARD YANG BELUM MENDAPAT PENAGANAN CS.
                            if(response_unassigned_card[i].assigned_id_cs == '') // CEK APAKAH SUDAH DI TUGASKAN ATAU BELUM PADA CS, JIKA BELUM TAMPILKAN.
                            {   // MENAMPILKAN CARD DENGAN STATUS MASIH OPEN
                                if(response_unassigned_card[i].ticketstatus == 'OPEN') // CEK STATUS TIKET, JIKA OPEN TAMPILKAN.
                                {
                                    // KOSONGKAN JUMLAH NOTIFIKASI PADA TIKET (JUMLAH NOTIF PESAN BARU).
                                    $("#count_unread_notif_card_ticket_"+ response_unassigned_card[i].id_chat ).empty();
                                    // TAMPUNG TAMPILAN CARD TICKET PADA VAR unassignTiket.
                                    $("#unassignedTicket").append(
                                        '<div class="app-card shadow-sm mb-2 mr-1 ml-1 ticket_card">'+
                                            '<div class="app-card-body">'+
                                                '<div class="row headerSubject padding_hs">'+
                                                    '<div class="col-6">'+
                                                        '<span class="">'+ response_unassigned_card[i].subject +'</span>'+
                                                    '</div>'+
                                                    '<div class="col-6 text-end">'+
                                                        '<div class="row">'+
                                                            '<span class="senderNameTicket ">'+ response_unassigned_card[i].creator_name +'</span>'+
                                                        '</div>'+
                                                        '<div class="row">'+
                                                            '<span class="elapsedDateTicket " id="intervalDate_'+response_unassigned_card[i].id_chat+'"></span>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="row bodySubject">'+
                                                    ''+
                                                '</div>'+
                                                '<div class="row footerSubject">'+
                                                    '<div class="col-9 app-utility-item-custome-ticket">'+
                                                        '<span class="m-custome-ticket badge '+ card_bg_prio +'">'+ response_unassigned_card[i].priority +'</span>'+ // Display Prioroty Ticket On Card Ticket.
                                                        '<span class="badge bg-info">'+ response_unassigned_card[i].id_chat +'</span>'+ // Display Id Ticket On Card Ticket.                                                        
                                                    '</div>'+
                                                    '<div class="col-3 text-end">'+
                                                        '<button id="assignToMe" onclick="goToUnassignTicket(\''+response_unassigned_card[i].id_chat+'\')" class="btn-sm app-btn-secondary btn-secondary-view-ticket" data-id_chat="'+ response_unassigned_card[i].id_chat +'">'+
                                                            'Take a Ticket'+
                                                        '</button>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'
                                    );
                                    // Pass parameters to the formatElapsedTime function and run this function ============
                                    var interval_date = document.getElementById("intervalDate_"+response_unassigned_card[i].id_chat); // Get id from span id.
                                    var ticketCreatedDate = new Date(response_unassigned_card[i].datetime); // Create object date from dateTime.
                                    var elapsedTime = formatElapsedTime(ticketCreatedDate); // Send object date to formatElapsedTime function and get return from this function.
                                    interval_date.textContent = elapsedTime; // Set the return result from the formatElapsedTime function to var interval_date for display in span with id="intervalDate_"+response[i].id_chat.
                                    
                                    // ====================================================================================               
                                }
                            }
                        }
                    }                    
                }                  
            },error: function(xhr, status, error) {
                console.error(error); // Tampilkan kesalahan pada konsol jika ada
            }
        });
    };
// ================================================================================================================================



// CEK JUMLAH PESAN BELUM TERBACA DI MASING-MASING TIKET (HANYA DIEKSEKUSI KETIKA TIKET PERTAMA KALI DI TAMPILKAN) ================
    function getCountMsgIdTicket(id_chat_ticket){
        // AMBIL ID DARI ELEMENT YANG AKAN MENAMPILKAN NOTIF.
        var countUnreadNotifCardTicket = document.getElementById("count_unread_notif_card_ticket_"+id_chat_ticket);        
        var dataToSend = {id_chat : id_chat_ticket};
        // CEK APAKAH ELEMENT TERSEBUT SUDAH DIMUAT ATAU TIDAK DIMUAT, JIKA DIMUAT JALANKAN FUNGSI UNTUK MENGAMBIL JUMLAH PESAN BELUM DIBACA (UNREAD) DITIAP TIKETNYA.
        if(countUnreadNotifCardTicket){     
            // SEMBUNYIKAN countUnreadNotifCardTicket
            countUnreadNotifCardTicket.hidden = true; 
        
            $.ajax({
                url: base_url+"/LiveChatController/getUnreadCountIdChat",
                type: 'GET',
                data: dataToSend,
                success: function(response) {
                    if(response >= 1){ // JIKA ADA PESAN BELUM TERBACA.
                        // TAMPILKAN countUnreadNotifCardTicket.                      
                        countUnreadNotifCardTicket.hidden = false;
                        // CETAK JUMLAH PESAN YANG BELUM DIBACA PADA countUnreadNotifCardTicket.
                        countUnreadNotifCardTicket.textContent = response;
                    }                    
                }
            });
        }
    };
    // MEMPERBAHARUI JUMLAH PESAN BELUM TERBACA PADA TIKET dalam perulangan =======================================================
        function loopUnreadMsgOpenTicket()
        {
            $.ajax({
                url: base_url+"/LiveChatController/retriveTicketData",
                type: 'GET',
                success: function(response) { 
                    for(var i = 0; i < response.length; i++) {
                        // KOSONGKAN TERLEBIH DAHULU JUMLAH PESAN YANG BELUM DIBACA, LALU TAMPILKAN JUMLAH TERBARUNYA.
                        $("#count_unread_notif_card_ticket_"+ response[i].id_chat ).empty();
                        id_chat_ticket = response[i].id_chat;
                        getCountMsgIdTicket(id_chat_ticket); // JALANKAN KEMBALI FUNGSI getCountMsgIdTicket.                
                    }
                }
            });
        };
    // ============================================================================================================================
    function getCountMsgIdTicketCs(id_chat_ticket_cs){ // UNTUK MY TICKET PADA CS
        // AMBIL ID DARI ELEMENT YANG AKAN MENAMPILKAN NOTIF.
        var countUnreadNotifCardTicketCs = document.getElementById("count_unread_notif_card_ticket_cs_"+id_chat_ticket_cs);
        var dataToSend = {id_chat : id_chat_ticket_cs};
        // CEK APAKAH ELEMENT TERSEBUT SUDAH DIMUAT ATAU TIDAK DIMUAT, JIKA DIMUAT JALANKAN FUNGSI UNTUK MENGAMBIL JUMLAH PESAN BELUM DIBACA (UNREAD) DITIAP TIKETNYA.
        if(countUnreadNotifCardTicketCs){ 
            // SEMBUNYIKAN countUnreadNotifCardTicketCs
            countUnreadNotifCardTicketCs.hidden = true;
        
            $.ajax({
                url: base_url+"/LiveChatController/getUnreadCountIdChatCs",
                type: 'GET',
                data: dataToSend,
                success: function(response) {                         
                    if(response >= 1){ // JIKA ADA PESAN BELUM TERBACA.
                        // TAMPILKAN countUnreadNotifCardTicket.
                        countUnreadNotifCardTicketCs.hidden = false;
                        // CETAK JUMLAH PESAN YANG BELUM DIBACA PADA countUnreadNotifCardTicket.
                        countUnreadNotifCardTicketCs.textContent = response;
                    }
                }
            }); 
        }
    };
    // MEMPERBAHARUI JUMLAH PESAN BELUM TERBACA PADA TIKET dalam perulangan =======================================================
        function loopUnreadMsgOpenTicketCs()
        {
            $.ajax({
                url: base_url+"/LiveChatController/retriveTicketData",
                type: 'GET',
                success: function(response) { 
                    for(var i = 0; i < response.length; i++) {
                        // KOSONGKAN TERLEBIH DAHULU JUMLAH PESAN YANG BELUM DIBACA, LALU TAMPILKAN JUMLAH TERBARUNYA.
                        $("#count_unread_notif_card_ticket_cs_"+ response[i].id_chat ).empty();

                        id_chat_ticket = response[i].id_chat;
                        getCountMsgIdTicketCs(id_chat_ticket); // JALANKAN KEMBALI FUNGSI getCountMsgIdTicket.                
                    }
                }
            });
        };
    // ============================================================================================================================
// ================================================================================================================================



// FUNGSI UNTUK MENJALANKAN FUNGSI LAINNYA ========================================================================================
    function goToConsoleFunction(card_id_chat, mYt){
        paramIDChatTicket = card_id_chat; // SIMPAN NILAI ID CHAT KEDALAM paramClosedTicket, UNTUK DIGUNAKAN OLEH TOMBOL CLOSED STATUS CHAT.        
        configFormChat(paramIDChatTicket);
        if(mYt){
            initial = mYt;
        }else{
            initial = "";
        }
        retriveChatActivity(paramIDChatTicket,initial);
        setInterval( function(){            
            retriveChatActivity(paramIDChatTicket,initial); // MENJALANKAN ULANG FUNGSI retriveChatActivity.
        },60000); // 60 DEITK
        
    }    
    // TAMPILKAN INFORMASI TIKET PADA HEADER CONSOLE DAN PENGATURAN TOMBOL CLOSED ================================================= 
        function configFormChat(paramIDChatTicket){    
            var dataParam = {id_chat: paramIDChatTicket};
            $.ajax({ 
                method:"GET",
                url: base_url+"/LiveChatController/retriveData/",
                data: dataParam,
                success:function(response){            
                    $.each(response.datanotif, function (key, value){
                        // MENAMPILKAN DAN MENGATUR INFORMASI DARI TIKET PADA HEADER CONSOLE.
                        var bg_stat, bg_prio;
                        // PENGATURAN STATUS TIKET OPEN ATAU CLOSED.
                        if(value['ticketstatus'] == "OPEN"){ bg_stat = "bg-info" }
                        else if(value['ticketstatus'] == "CLOSED"){ bg_stat = "bg-black" };
                        // PENGATURAN WARNA STATUS PRIOROTAS DARI TIKET.
                        if(value['priority'] == "CRITICAL"){ bg_prio = "bg-critical" }
                        else if(value['priority'] == "HIGH"){ bg_prio = "bg-high" }
                        else if(value['priority'] == "MODERATE"){ bg_prio = "bg-moderat" }
                        else if(value['priority'] == "LOW"){ bg_prio = "bg-low" }
                        else if(value['priority'] == "REQUEST"){ bg_prio = "bg-request" };
                        
                        // MENCETAK INFORMASI TIKET KEDALAM HEADER CONSOLE BERDASARKAN PENGATURAN DIATAS.
                        headerInfoConsole = '<div id="subjectTicketConsole" class="container headerSubject header-console-child-subject">'+
                                                value['subject'] +
                                            '</div>'+
                                            '<div class="container cust-margin app-utility-item-custome-ticket header-console-child-info">'+
                                                '<span class="badge '+ bg_stat +' mr-02" id="ticket_status">'+value['ticketstatus']+'</span>'+
                                                '<span class="badge '+ bg_prio +' mr-02" id="ticket_priority">'+ value['priority'] +'</span>'+
                                                '<span class="badge bg-info mr-02" id="ticket_id">'+ value['id_chat'] +'</span>'+
                                            '</div>';                                        
                        $('#headerInfoConsole').empty(); // MENGHAPUS INFORMASI SEBELUMNYA, MENCEGAH TERCETAK GANDA.
                        $('#headerInfoConsole').append(headerInfoConsole); // MENCETAK INFORMASI TERAKHIR DARI TIKET.                    
                    
                        // MENGATUR TAMPIAN BONDY CONSOLE, DENGAN SETATUS TIKET OPEN ATAU CLOSED.
                        if(value['ticketstatus'] == 'CLOSED'){ // STATUS TIKET CLOSED.
                            // MENGATUR WARNA LATAR CONSOLE.
                            chatActivity.style.backgroundColor='var(--bs-closed-chat-bg-color)';
                            // MENONAKTIFKAN TOMBOL CLOSED TICKET PADA HEADER CONSOLE.
                            btnClosed.disabled = true; 
                            btnClosed.style.backgroundColor="#dee2e6";
                            // MENGATUR INPUT PESAN PADA FOOTER CONSOLE.
                            inputChat.disabled = true; // MENONAKTIFKAN
                            inputChat.style.backgroundColor='var(--bs-closed-chat-bg-color)'; // MEMBERI WARNA LATAR.
                            inputChat.placeholder = "CLOSED"; // MENAMPILKAN STATUS CLOSED PADA INPUT PESAN.
                            // MENONAKTIFKAN TOMBOL ATTACH DAN SEND PADA FOOTER CONSOLE.
                            file.disabled = true; // TOMBOL ATTACH.
                            btnSend.disabled = true; // TOMBOL SEND.
                        }else if(value['ticketstatus'] == 'OPEN' && value['creator_id'] == userID){ // STATUS TIKET OPEN, DAN DIBUKA OLEH PEMBUAT TIKET (CLIENT).
                            // MENGATUR WARNA LATAR BODY CONSOLE.
                            chatActivity.style.backgroundColor='#fff';// Set bgcolor consol                        
                            // MENGAKTIFKAN TOMBOL CLOSED TICKET DAN MEMBERI WARNA MERAH TOMBOL PADA HEADER CONSOLE.
                            btnClosed.disabled = false; 
                            btnClosed.style.backgroundColor="var(--bs-red)";
                            // MENGATUR INPUT PESAN PADA FOOTER CONSOLE.
                            inputChat.disabled = false; // MENGAKTIFKAN INPUT PESAN.
                            inputChat.style.backgroundColor='#fff'; // MEMBERI WARNA LATAR.
                            inputChat.placeholder = "Chat..."; // MENAMPILKAN PLACEHOLDER PADA INPUT PESAN.
                            // MENGAKTIFKAN TOMBOL ATTACH DAN TOMBOL SEND.
                            file.disabled = false; // TOMBOL ATTACH.
                            btnSend.disabled = false; // TOMBOL SEND.
                        }else if(value['ticketstatus'] == 'OPEN' && value['creator_id'] != userID){ // STATUS TIKET OPEN, DAN DIBUKA OLEH BUKAN PEMBUAT TIKET (CS).
                            // MENGATUR WARNA LATAR BODY CONSOLE.
                            chatActivity.style.backgroundColor='#fff';// Set bgcolor consol
                            // MENONAKTIFKAN TOMBOL CLOSED TICKET PADA HEADER CONSOLE (HANAYA PEMBUAT TIKET YANG BISA MERUBAH STATUS TIKET KE CLOSED).
                            btnClosed.disabled = true; 
                            btnClosed.style.backgroundColor="#dee2e6";
                            // MENGATUR INPUT PESAN PADA FOOTER CONSOLE.
                            inputChat.disabled = false; // MENGAKTIFKAN INPUT PESAN.
                            inputChat.style.backgroundColor='#fff'; // MEMBERI WARNA LATAR.
                            inputChat.placeholder = "Chat..."; // MENAMPILKAN PLACEHOLDER PADA INPUT PESAN.
                            // MENGAKTIFKAN TOMBOL ATTACH DAN TOMBOL SEND.
                            file.disabled = false; // TOMBOL ATTACH.
                            btnSend.disabled = false; // TOMBOL SEND.
                        }
                    })
                },
                error:function(xhr){ // MENAMPIKAN PESAN PADA CONSOLE JIKA ADA KESALAHAN.
                    console.log(xhr.responseText);
                }    
            });
        };
    // ============================================================================================================================
    // MENGAMBIL DAN MENAMPILKAN ISI SELURUH PESAN DARI TIKET PADA BODY CONSOLE ===================================================
        function retriveChatActivity(paramIDChatTicket,initial){ 
            // MENAMPUNG NILAI PARAM KEDALAM VARIABE JSON, UNTUK DIKIRIM KE CONTROLLER.
            var dataParam = {id_chat: paramIDChatTicket};
            $.ajax({
                url: base_url+'/LiveChatController/getActivityChat/',
                type: 'GET',
                data: dataParam,
                dataType: 'json',
                success: function(response){                           
                    // MENDEFINISIKAN VARIABLE GLOBAL DALAM FUNGSI INI.
                    var text_position, iconStat, color, iconDownloadFIle, fileName, iconUnreadPosition, maxCardFileName;
                    var output = '';
                    var previousDate = null;
                    var outputByDate = '';

                    // MEMERIKSA DAN MEMEBUAT FORMAT TANGGAL SAAT INI.
                    let currentDate = new Date();
                    let dateNow = currentDate.toISOString().slice(0, 10); // MENGAMBIL 10 CHAR PERTAMA DARI STRING YANG DIHASILKAN. (YYYY-MM-DD) HANYA TAHUN,BULAN,TANGGAL.
                    
                    for (var i = 0; i < response.length; i++) {
                        var key = response[i];

                    // JALANKAN FUNGSI markReadAllMsg, SAAT SELURUH ISI PESAN DITAMPILKAN PADA BODY CONSOLE=======
                        var paramSenderID = key.id_user; // MERUPAKAN ID DARI PENGIRIM PESAN ATAU ID DARI SI USER INI SENDIRI.
                        var paramIDchat = key.id_chat; // MERUPAKAN ID DARI TICKET.
                        var paramDestinationId = key.destination_id_user; // MERUPAKAN ID TUJUAN DARI TICKET.

                        // CEK userID SEBAGAI PENERIMA PESAN BUKANLAH SI PENGIRIM PESAN ITU SENDIRI paramSenderID (USER INI SENDIRI).
                        // KONDISI INI UNTUK MEMASTIKAN BAHWA HANYA PENERIMA PESAN YANG HANYA DAPAT MERUBAH STATUS PESAN MENJADI READ.
                        // DAN MENCEGAH PENGIRIM PESAN YANG MERUBAH STATUS READ PADA PESAN YANG DIKIRIMNYA SENDIRI. 
                        if(paramSenderID != userID){
                            // CEK PAKAH PESAN MASIH DALAM STATUS UNREAD, JIKA YA UBAH KE READ BERDASARKAN PRAMETER YANG DIKIRIM.
                            if(key.status_read == 'unread'){
                                // MENJALANKAN FUNGSI markReadAllMsg DENGAN MENGIRIM PARAMETER.
                                // (FUNGSI INI AKAN DIJALANKAN APABILA TERDAPAT PESAN YANG BELUM DIBACA UNREAD)
                                markReadAllMsg(paramIDchat, paramDestinationId, initial);                                
                            }
                        }
                    // ============================================================================================ 

                    // MEMBUAT FORMAT TANGGAL PADA SETIAP PESAN.
                        var messageDate = new Date(key.date_chat);
                        var chatDate = messageDate.toISOString().slice(0, 10); // MENGAMBIL 10 CHAR PERTAMA DARI STRING YANG DIHASILKAN. (YYYY-MM-DD) HANYA TAHUN,BULAN,TANGGAL.
                        
                    // MENGATUR POSISI PESAN PADA SAAT DITAMPILKAN DI DALAM BODY CONSOLE.
                        // PENGGUNA ITU SENDIRI (CLIENT ATAU CS).
                        if (userID == key.id_user) { // MEMPOSISIKAN PESAN DI SEBAL KIRI, UNTUK PESAN YANG DIKIRIM PENGGUNA TERSEBUT.
                            text_position = 'text-start'; // MENGATUR POSISI ISI PESAN YANG DIKIRIM.
                            style_bg_color = 'div-chat-bg-color_1'; // MENGATUR LATAR DARI PESAN YANG DIKIRIM.
                            user_label = 'You'; // MENAMPILKAN NAMA PENGIRIM PESAN PADA ISI PESAN DIDALAM BODY CONSOLE.                         
                            
                            if(key.ext_file == "jpg" || key.ext_file == "jpeg" || key.ext_file == "png"){ // KONDISI JIKA FILE IMAGE YANG DIKIRIM.
                                fileName = "position-image-name"; // MENGATUR POSISI DARI NAMA FILE YANG DIKIRIM.
                                iconDownloadFIle = "position-icon-download-image"; // MENGATUR POSISI ICON DOWNLOAD JIKA PESAN BERUPA FILE.
                                iconUnreadPosition = "position-icon-unread-image"; // MEGATUR POSISI ICON UNREAD PADA SISI PENGGUNA.
                                maxCardFileName = "max-card-image-name"; // MENGATUR LEBAR MAXIMAL DARI CARD PENAMPUNG NAMA FILE.
                            }else{ // KONDISI JIKA FILE SELAIN IMAGE YANG DIKIRIM.
                                fileName = "position-file-name"; // MENGATUR POSISI DARI NAMA FILE YANG DIKIRIM.
                                iconDownloadFIle = "position-icon-download-file"; // MENGATUR POSISI ICON DOWNLOAD JIKA PESAN BERUPA FILE.
                                iconUnreadPosition = "position-icon-unread-file"; // MEGATUR POSISI ICON UNREAD PADA SISI PENGGUNA.
                                maxCardFileName = "max-card-file-name"; // MENGATUR LEBAR MAXIMAL DARI CARD PENAMPUNG NAMA FILE.
                            }
                            
                        }
                        // PENGGUNA DARI LAWAN BICARA (CLIENT ATAU CS).
                        if (userID != key.id_user) { // MENGATUR POSISI DI SEBELAH KANAN, UNTUK PESAN YANG DITERIMA PENGGUNA TERSEBUT.
                            text_position = 'text-end'; // MENGATUR POSISI ISI PESAN YANG DITERIMA.
                            style_bg_color = 'div-chat-bg-color_2'; // MENGATUR LATAR DARI PESAN YANG DITERIMA.
                            user_label = key.user_name; // MENAMPILKAN NAMA PENGIRIM PESAN PADA ISI PESAN DIDALAM BODY CONSOLE.                        
                            
                            if(key.ext_file == "jpg" || key.ext_file == "jpeg" || key.ext_file == "png"){
                                fileName = "position-image-name-receiver"; // MENGATUR POSISI DARI NAMA FILE YANG DIKIRIM.
                                iconDownloadFIle = "position-icon-download-image-receiver"; // MENGATUR POSISI ICON DOWNLOAD JIKA PESAN BERUPA FILE.
                                maxCardFileName = "max-card-image-name"; // MENGATUR LEBAR MAXIMAL DARI CARD PENAMPUNG NAMA FILE.
                            }else{
                                fileName = "position-file-name-receiver"; // MENGATUR POSISI DARI NAMA FILE YANG DIKIRIM.
                                iconDownloadFIle = "position-icon-download-file-receiver"; // MENGATUR POSISI ICON DOWNLOAD JIKA PESAN BERUPA FILE.
                                maxCardFileName = "max-card-file-name"; // MENGATUR LEBAR MAXIMAL DARI CARD PENAMPUNG NAMA FILE.
                            }
                        }

                    // CEK PENGGUNA LAIN SEDANG ONLINE ATAU OFFLINE.
                        // PENGGUNA LAWAN BICARA.
                        if(key.id_user != userID){ // CEK JIKA BUKAN PUNGGUNA ITU SENDIRI, TETAPI LAWAN BICARANYA DALAM TIKET.
                            // BUAT INDIKATOR WARNA PADA LAWAN BICARANYA, UNTUK MENANDAKAN SEDANG ONLINE ATAU OFFLINE.
                            if(key.status_active_user == 1){ color="green"; }else{ color="red"; }; // GREEN ONLINE, RED OFFLINE.
                            // BUAT INDIKATOR ICON PADA LAWAN BICARA, DENGAN WARNA ICON BERDASARKAN INDIKATOR WARNA DIATAS.
                            iconStat = '<svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" fill="'+ color +'" class="bi bi-circle-fill" viewBox="0 0 16 16"><circle cx="8" cy="8" r="8"/></svg>';
                            
                            // MENGATUR icon_Un_Read (ICON UNTUK PESAN SUDAH ATAU BELUM DIBACA).
                            // ICON HANYA DI TAMPILKAN PADA PESAN YANG DIKIRIM PENGGUNA, BUKAN PESAN YANG DITERIMA PENGGUNA. (HAL INI UNTUK MEMASTIKAN PESAN SUDAH DIBACA OLEH PENERIMA DAN MEMBERI TANDA JIKA SUDAH DIBACA)
                            // MEMBERI NILAI KOSONG PADA icon_Un_Read, UNTUK MENCEGAH PESAN DITERIMA PENGGUNA MENAMPILKAN ICON TERSEBUT.
                            icon_Un_Read = ''; // MENCEGAH ERROR UNDIFINED, KARENA SALAH SATU KONDISI DI DEFINISIKAN MAKA KONDISI LAIN JUGA HARUS DIDEFINISIKAN.
                            
                        }else{ // PENGGUNA ITU SENDIRI.
                            // MENCEGAH iconStat DITAMPILKAN PADA PENGGUNA ITU SENDIRI (ICON STATUS ONLINE ATAU OFFLINE), KARENA HANYA DITAMPILKAN UTNTUK LAWAN BICARA.
                            iconStat =''; // MENCEGAH ERROR UNDIFINED, KARENA SALAH SATU KONDISI DI DEFINISIKAN MAKA KONDISI LAIN JUGA HARUS DIDEFINISIKAN.
                            
                            // KONDISI UNTUK MEMERIKSA STATUS PESAN SUDAH DIBACA ATAU BELUM DENGAN MENAMPILKAN ICON SUDAH DAN BELUM DIBACA PENERIMA. 
                            if(key.status_read == 'unread'){ // ICON BELUM DIBACA.
                                icon_Un_Read =  '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-patch-exclamation" viewBox="0 0 16 16">'+
                                                    '<path d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.553.553 0 0 1-1.1 0L7.1 4.995z"/>'+
                                                    '<path d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911l-1.318.016z"/>'+
                                                '</svg>';
                            }else{ // ICON SUDAH DIBACA.
                                icon_Un_Read =  '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-patch-check" viewBox="0 0 16 16">'+
                                                    '<path fill-rule="evenodd" d="M10.354 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>'+
                                                    '<path d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911l-1.318.016z"/>'+
                                                '</svg>';
                            }
                        }
                                        
                        // MEBUAT PEMBATAS TANGGAL UNTUK SETIAP PESAN (PENGELOMPOKAN PESAN BERDASARKAN TANGGAL PESAN DIKIRIM ATAUPUN DITERIMA).
                        // PESAN TERDAHULU HINGGA PESAN TERAKHIR SELAIN TANGGAL HARI INI.
                        if (previousDate !== chatDate) {  // JIKA TANGGAL PESAN SAAT INI BERBEDA DENGAN TANGGAL PESAN SEBELUMNYA, BERIKAN PEMBATAS TANGGAL.                       
                            if (outputByDate) {
                                // BAGIAN INI UNTUK MENAMPUNG PESAN DENGAN TANGGAL YANG SAMA, BAIK PESAN YANG DIKIRIM ATAUPUN PESAN YANG DITERIMA.
                                // PESAN PADA TANGGAL TERSEBUT AKAN DISIMPAN DAN DIGABUNGKAN/ DISERTAKAN DIBAWAH PEMBATAS DIDALAM PEMBATAS TANGGAL, DENGAN TANGGAL YANG SAMA.
                                output += '<div class="app-card shadow-sm date-divider text-center mt-4">' + previousDate + '</div>' + outputByDate ; 
                            }
                            outputByDate = ''; // BAGIAN INI DIKOSONGKAN KARENA HANYA UNTUK MENAPILKAN PEMBATAS, SEBELUM ADA PESAN BARU DI TANGGAL TERSBUT.                        
                            previousDate = chatDate;    // BAGIAN INI MENYIMPAN TANGGAL SAAT INI, UNTUK DIBANDINGKAN DENGAN PESAN BARU SELANJUTNYA.
                                                        // APAKAH PERLU DIBUAT PEMBATAS TANGGAL BARU LAGI KARENA BERBEDA TANGGAL ATAU TIDAK KARENA MASIH TANGGAL YANG SAMA. 
                        }

                        // CEK APAKAH PESAN ADALAH FILE ATAU PESAN TEXT.
                        // KONDISI HANYA BERLAKU PADA SALAH SATU, PESAN TEXT ATAU FILE. (PADA KONSOLE HANYA BISA MENGIRIM PESAN TEXT SAJA ATAU FILE SAJA, TIDAK BISA KEDUANYA SECARA BERSAMAAN).
                        if(key.file_upload !== "" ){ // JIKA YANG DIKIRI FILE.
                            if(key.ext_file === "pdf"){ // JIKA FILE DENGAN EXT PDF.
                                var send_image = new Image(65); // BUAT OBJECT IMAGE UNTUK MENAMPILKAN GAMBAR FILE BERDASARKAN EXTENTION FILE.
                                send_image.src = base_url+'/assets/images/icons/pdf.png';
                            }else if(key.ext_file === "doc"){ // JIKA FILE DENGAN EXT DOC.
                                var send_image = new Image(65); // BUAT OBJECT IMAGE UNTUK MENAMPILKAN GAMBAR FILE BERDASARKAN EXTENTION FILE.
                                send_image.src = base_url+'/assets/images/icons/doc.png';
                            }else if(key.ext_file === "docx"){ // JIKA FILE DENGAN EXT DOCX.
                                var send_image = new Image(65); // BUAT OBJECT IMAGE UNTUK MENAMPILKAN GAMBAR FILE BERDASARKAN EXTENTION FILE.
                                send_image.src = base_url+'/assets/images/icons/docx.png';
                            }else if(key.ext_file === "txt"){ // JIKA FILE DENGAN EXT TXT.
                                var send_image = new Image(65); // BUAT OBJECT IMAGE UNTUK MENAMPILKAN GAMBAR FILE BERDASARKAN EXTENTION FILE.
                                send_image.src = base_url+'/assets/images/icons/txt.png';
                            }else if(key.ext_file === "jpg"){ // JIKA FILE DENGAN EXT DOCX.
                                var send_image = new Image(200); // BUAT OBJECT IMAGE UNTUK MENAMPILKAN GAMBAR FILE BERDASARKAN EXTENTION FILE.
                                send_image.src = base_url+'/file_upload/'+key.file_upload;
                            }else if(key.ext_file === "jpeg"){ // JIKA FILE DENGAN EXT DOCX.
                                var send_image = new Image(200); // BUAT OBJECT IMAGE UNTUK MENAMPILKAN GAMBAR FILE BERDASARKAN EXTENTION FILE.
                                send_image.src = base_url+'/file_upload/'+key.file_upload;
                            }else if(key.ext_file === "png"){ // JIKA FILE DENGAN EXT DOCX.
                                var send_image = new Image(200); // BUAT OBJECT IMAGE UNTUK MENAMPILKAN GAMBAR FILE BERDASARKAN EXTENTION FILE.
                                send_image.src = base_url+'/file_upload/'+key.file_upload;
                            }else{ // JIKA FILE DENGAN EXT SELAIN YANG SUDAH DIDEFINISIKAN.
                                var send_image = new Image(65); // BUAT OBJECT IMAGE UNTUK MENAMPILKAN GAMBAR FILE BERDASARKAN EXTENTION FILE.
                                send_image.src = base_url+'/assets/images/icons/unknown.png';
                            }
                            // MENCETAK PESAN FILE KEDALAM BODY CONSOLE, SESUAI KONDISI DIATAS.
                            outputByDate += '<div class="row mt-2 div-container">'+
                                                '<div class="col-12 ' + text_position + '">'+
                                                    '<span class="chat-user-label">'+ iconStat +'  '+ user_label + '</span> '+
                                                    '<span class="chat-data-time">' + key.time_chat + '</span> <br> '+
                                                    '<label class="">'+
                                                        '<div class="container-position-icon" id="send_file_image">'+
                                                            send_image.outerHTML + // MENAMPILKAN IMAGE FILE.
                                                            '<label class="'+iconUnreadPosition+'">'+ 
                                                                icon_Un_Read + // MENAMPILKAN ICON UNREAD / READ.
                                                            '</label>'+
                                                            '<label class="'+ iconDownloadFIle +'">'+
                                                                '<a id="btn_download_file" onclick="downloadFile(\''+key.message_id+'\', \''+key.file_upload+'\')" class="">'+
                                                                    '<svg  xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">'+
                                                                        '<path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>'+
                                                                        '<path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>'+
                                                                    '</svg>'+
                                                                '</a>'+
                                                            '</label>'+
                                                            '<div class="'+ fileName +'">'+
                                                                '<div class="app-card '+ maxCardFileName +' shadow-sm '+ style_bg_color + '">'+ 
                                                                    '<span class="chat-image" id="max_word_file_name">'+ key.file_upload +'</span>'+                                                                
                                                                '</div>'+
                                                            '</div>'+
                                                        '</div>'+
                                                    '</label>'+
                                                '</div>'+
                                            '</div>';
                        }else if(key.desc_chat !== "" ){ // MENCETAK ISI PESAN TEXT KEDALAM BODY CONSOLE.
                            outputByDate += '<div class="row mt-2 div-container">'+
                                                '<div class="col-12 ' + text_position + '">'+ 
                                                    '<span class="chat-user-label">'+ iconStat +'  '+ user_label + '</span> '+ 
                                                    '<span class="chat-data-time">' + key.time_chat + '</span> <br> '+
                                                    '<label class="">'+
                                                        '<div class="app-card shadow-sm container-position-chat-icon ' + style_bg_color + '">'+
                                                            '<label class="position-chat-icon">'+
                                                                icon_Un_Read +
                                                            '</label>'+ 
                                                            '<span class="chat-data">' + key.desc_chat + '</span> '+
                                                        '</div>'+
                                                    '</label>'+
                                                '</div>'+
                                            '</div>';
                        }
                    }

                    // MEMBUAT PEMBATAS TANGGAL UNTUK SETIAP PESAN (PENGELOMPOKAN PESAN BERDASARKAN TANGGAL PESAN DIKIRIM ATAUPUN DITERIMA).
                    // SETELAH PERULANGAN DITAMBAHKAN KEMBALI SATU PEMBATAS, SEBAGAI PEMBATAS TERBARU JIKA ADA PESAN BARU DENGAN TANGGAL BERBEDA DARI PESAN SEBELUMNYA.
                    if (outputByDate) { 
                        if(chatDate === dateNow){
                            // JIKA PESAN DITERIMA ATAU DIKIRIM SESUAI DENGAN TANGGAL SAAT INI, PEMBATAS PESAN DICETAK Today.
                            previousDate = "Today";
                        }
                        output += '<div class="app-card shadow-sm date-divider text-center mt-4">' + previousDate + '</div>' + outputByDate ;
                    }
                    // HASIL DARI SELURUH PEMBATAS PESAN DAN ISI PESAN PADA TANGGAL ITU SENDIRI AKAN DI SIMPAN DALAM output, YANG DICETAK KEDALAM chat_data (BAGIAN ISI DARI ELEMENT BODY CONSOLE).
                    $('#chat_data').html(output); 
                    // MENGATUR SCROLLBAR KE POSISI BAGIAN PALING BAWAH DARI ELEMENT BODY CONSOLE/ MENGARAHKAN KEBAGIAN CHAT TERBARU.
                    var scroll = document.getElementById('chat_activity');
                    scroll.scrollTop = scroll.scrollHeight - scroll.clientHeight;  
                    // PROPERTI scrollHeight ==> UNTUK MENGHITUNG TINGGI KESELURUHAN DARI ELEMENT SCROLL, BAIK BAGIAN YANG TERLIHAT MAUPUN BAGIAN YANG TIDAK TERLIHAT (OVERFLOW).
                    // PROPERTI clientHeight ==> UNTUK MENGHITUNG TINGGI DARI ELEMENT SCROLL YANG TAMPAK/ TERLIHAT.
                    // CARA KERJA: scrollHeight(NILAI DIAMBIL DARI TINGGI ISI ELEMENT BODY CONSOLE) - clientHeight(NILAI DIAMBIL DARI PENGATURAN TINGGI BODY CONSOLE PADA CSS).
                    // HASILNYA / SELISIH NYA DI GUNAKAN UNTUK UKURAN YANG AKAN DI SEMBUNYIKAN PADA BAGIAN ATAS DARI ELEMENT BODY CONSOLE (OVERFLOW).
                    // ATAU SIMPLE NYA MENAMPILKAN ELEMENT BODY CONSOLE DARI BAGIAN PALING BAWAH DENGAN TINGGI DIAMBIL NILAI NYA DARI clientHeight (TINGGI YANG DISET PADA CSS).
                }
            });
        };        
    //  ===========================================================================================================================
//  ===============================================================================================================================



// FUNGSI UNTUK MENJALANKAN FUNGSI LAINNYA ========================================================================================
    function goToUnassignTicket(unassigned_card_id_chat){
        cekTicketDataById(unassigned_card_id_chat);
    }
    // CEK APAKAH TICKET SUDAH DI HANDLE OLEH CS LAIN ATAU BELUM (FUNGSI UNTUK MENCEGAH TICKET YANG SUDAH DIAMBIL CS A BISA DIAMBIL CS B).
    function cekTicketDataById(unassigned_card_id_chat){
        var dataParam = {id_chat: unassigned_card_id_chat};
        $.ajax({
            url: base_url+"/LiveChatController/retriveTicketDataById/",
            type: 'GET',
            data: dataParam,            
            cache: false,
            success: function(response) {
                console.log(response);
                if(response[0].assigned_id_cs != ""){
                    swal.fire({ // TAMPILKAN ALERT JIKA TICKET SUDAH DIAMBIL OLEH CS LAIN.
                        position: 'bottom-end',
                        title: "Alert",
                        text: "Tiket yang anda pilih sudah di ambil!",
                        icon: 'alert',
                        iconHtml:   '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">'+
                                        '<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>'+
                                    '</svg>',
                        customClass: {container: 'my-custom-dialog-1'}, // MEMBERIKAN CLASS TAMBAHAN UNTUK TAMPILAN DARI SWEETALERT.
                        showConfirmButton: false,
                        timer: 5000,
                    })
                }else{ // JALANKAN FUNGSI UNTUK MENGAMBIL TICKET JIKA BELUM ADA YANG MENGAMBIL.
                    assignTiketCS(unassigned_card_id_chat);
                }
                // MENGOSONGKAN KEMBALI DAFTAR CARD TIKET SEBELUM MEMPERBAHARUI DAFTAR TIKET DENGAN PROSES PERULANGAN CARD TIKET (CS)
                $("#unassignedTicket").empty();
                $("#assignedTicket").empty();
                $("#archiveTicket").empty();
                // MENJALANKAN ULANG FUNGSI PERULANGAN CARD UNASSIGN TICKET.
                loopUnassignTicket()
                // MENJALANKAN ULANG FUNGSI PERULANGAN CARD ASSIGN & ARCHIVE TICKET.
                loopMsgOpenTicket();
            }
        });
    }
    
    // FUNGSI PENUGASAN PADA CS TERHADAP TIKET ====================================================================================
        function assignTiketCS(unassigned_card_id_chat){ 
            var formData = new FormData();
            formData.append('id_chat', unassigned_card_id_chat);
            formData.append('name_Cs', userName);
            $.ajax({
                url: base_url+"/LiveChatController/assignTicketCS",
                type: 'POST',
                data: formData,
                processData: false, // SET FALSE AGAR FormData TIDAK DIPROSES SECARA OTOMATIS.
                contentType: false, // SET FALSE AGAR FormData MENENTUKAN TIPE KONTENT SECARA OTOMATIS.
                cache: false,
                success: function(response) {                                    
                    // MENGOSONGKAN KEMBALI DAFTAR CARD TIKET SEBELUM MEMPERBAHARUI DAFTAR TIKET DENGAN PROSES PERULANGAN CARD TIKET (CS)
                    $("#unassignedTicket").empty();
                    $("#assignedTicket").empty();
                    $("#archiveTicket").empty();
                    // MENJALANKAN ULANG FUNGSI PERULANGAN CARD UNASSIGN TICKET.
                    loopUnassignTicket()
                    // MENJALANKAN ULANG FUNGSI PERULANGAN CARD ASSIGN & ARCHIVE TICKET.
                    loopMsgOpenTicket();
                    
                }
            });
        }        
    // ============================================================================================================================
//  ===============================================================================================================================



// TANDAI SUDAH DIBACA ============================================================================================================
    // MERUBAH SETATUS UNREAD KE READ UNTUK PESAN TERTENTU, SESUAI DENGAN ID PESAN YANG DIMAKSUD ==================================
        function markReadMsg(){ // FUNGSI INI DIJALANKAN JIKA MEMBACA PESAN MELALUI LIST NOTIFIKASI PADA NAVBAR DAN MELALUI TABEL NOTIFIKASI (PESAN DITAMPILKAN DALAM MODAL).
            var dataToSend = {message_ID : messageID} // MENGIRIM ID PESAN.  
            $.ajax({
                url: base_url+"/Home/setRead",
                type: 'POST',
                data: dataToSend,
                cache: false,
                success: function(response) {
                    loopUnreadMsgOpenTicket(); // FUNGSI UPDATE JUMLAH PESAN YANG BELUM DIBACA.
                    getCountNotifNav(); // FUNGSI PENGATURAN PADA NAVIGASI.
                    getCountNotifTicket(); // FUNGSI PENGATURAN PADA TIKET.                    

                    table_msg.ajax.reload(); // Reaload ajax after button or icon detail kliked.
                    getLogMsg(); // Runing function for show notification in navbar top.
                    
                }
            });			
        }
    // ============================================================================================================================
    // MERUBAH SETATUS UNREAD KE READ UNTUK SETIAP PESAN DALAM TIKET, PADA SAAT DITAMPILKAN KEDALAM CONSOLE =======================
        function markReadAllMsg(paramIDchat, paramDestinationId, initial){ // paramIDchat DAN paramDestinationId DIDAPAT DARI FUNGSI retriveChatActivity() PADA SAAT DI JALANKAN.
            var dataToSend = {IDchat : paramIDchat, destIdUser : paramDestinationId}; // MENGIRIM ID CHAT, BUKAN LAGI ID PESAN (SELURUH ID PESAN DENGAN ID CHAT YANG DIMAKSUD). 
            // initial DIGUNAKAN SEBAGAI PENANDA JIKA MYTICKET PADA CS YANGSEDANG DI AKSES USER, DITUJUKAN AGAR HANYA FUNGSI FUNGSI YANG DIPERLUKAN PADA CS YANG DIJALANKAN.
            $.ajax({
                url: base_url+"/Home/setReadAllChat",
                type: 'POST',
                data: dataToSend,
                cache: false,
                success: function(response) { 
                    if(level == "Cs"){
                        if(initial){ // CEK JIKA initiaL MEMILIKI NILAI, ARTINYA TAB MYTICKET PADA CS YANG SEDANG DI AKSES.
                            loopUnreadMsgOpenTicketCs(); // FUNGSI UPDATE JUMLAH PESAN YANG BELUM DIBACA (CS)
                            getCountNotifTicketCs(); // MEMERIKSA PESAN DENGAN STATUS UNREAD, JIKA ADA TAMPILKAN NOTIF "NEW" PADA NAV-TAB MY TICKET CS.
                            getCountNotifNav(); // FUNGSI PENGATURAN PADA NAVIGASI.
                            getCountNotifTicket(); // MEMERIKSA PESAN DENGAN STATUS UNREAD, JIKA ADA TAMPILKAN NOTIF "NEW" PADA NAV-TAB OPEN TICKET CLIENT DAN ASSIGN TICKET CS.
                            getLogMsg(); // MENJALANKAN FUNGSI getLogMsg UNTUK MEMPERBAHARUI LIST NOTIF PADA NAV-TOP.
                        }else{
                            loopUnreadMsgOpenTicket(); // FUNGSI UPDATE JUMLAH PESAN YANG BELUM DIBACA (ADMIN, CS, CLIENT). 
                            getCountNotifNav(); // FUNGSI PENGATURAN PADA NAVIGASI.
                            getCountNotifTicket(); // MEMERIKSA PESAN DENGAN STATUS UNREAD, JIKA ADA TAMPILKAN NOTIF "NEW" PADA NAV-TAB OPEN TICKET CLIENT DAN ASSIGN TICKET CS.
                            getLogMsg(); // MENJALANKAN FUNGSI getLogMsg UNTUK MEMPERBAHARUI LIST NOTIF PADA NAV-TOP.
                        }
                    }else{
                        loopUnreadMsgOpenTicket(); // FUNGSI UPDATE JUMLAH PESAN YANG BELUM DIBACA.
                        getCountNotifNav(); // FUNGSI PENGATURAN PADA NAVIGASI.
                        getCountNotifTicket(); // MEMERIKSA PESAN DENGAN STATUS UNREAD, JIKA ADA TAMPILKAN NOTIF "NEW" PADA NAV-TAB OPEN TICKET CLIENT DAN ASSIGN TICKET CS.
                        getLogMsg(); // MENJALANKAN FUNGSI getLogMsg UNTUK MEMPERBAHARUI LIST NOTIF PADA NAV-TOP.
                    }
                }
            });	
        }
    // ============================================================================================================================
// ================================================================================================================================

// MENGHITUNG PESAN YANG BELUM DIBACA (UNREAD)=====================================================================================
    // MENGHITUNG SELURUH PESAN YANG BELUM DIBACA, DAN DITAMPILKAN PADA BAGIAN NAVIGASI (NAV-TOP & NAV-SIDE) ======================
    function getCountNotifNav(){
        $.ajax({
            url: base_url+"/LiveChatController/getUnreadCountNav",
            type: 'GET',
            success: function(response) {
                if(response == 0){ // JIKA TIDAK ADA NOTIF/ PESAN BELUM DIBACA.
                    countUnreadNotifTop.hidden = true; // SEMBUNYIKAN NOTIF PADA NAV-TOP.
                    // CS
                    countUnreadNotifTicketSide.hidden = true; // SEMBUNYIKAN NOTIF PADA NAV-SIDE.
                    // ADMIN
                    countUnreadNotifSide.hidden = true; // SEMBUNYIKAN NOTIF PADA NAV-SIDE.
                }else if(response >= 1){ // JIKA ADA SATU ATAU LEBIH PESAN YANG BELUM DIBACA (UNREAD).
                    countUnreadNotifTop.hidden = false; // TAMPILKAN NOTIF PADA NAV-TOP.
                    countUnreadNotifTop.textContent = response; // CETAK NILAI JUMLAH PESAN BELUM DIBACA PADA NAV-TOP.
                    // CS
                    countUnreadNotifTicketSide.hidden = false; // TAMPILKAN NOTIF PADA TICKET NAV-SIDE.
                    countUnreadNotifTicketSide.textContent = response; // CETAK NILAI JUMLAH PESAN BELUM DIBACA PADA TICKET NAV-SIDE.
                    // ADMIN
                    countUnreadNotifSide.hidden = false; // TAMPILKAN NOTIF PADA NAV-SIDE.
                    countUnreadNotifSide.textContent = response; // CETAK NILAI JUMLAH PESAN BELUM DIBACA PADA NAV-SIDE.
                }
            }
        });
    };
    // MEMERIKSA PESAN YANG BELUM DIBACA (UNREAD), UNTUK MEMBERI TANDA PADA TAB NAVIGASI ==========================================
    function getCountNotifTicket(){
        $.ajax({
            url: base_url+"/LiveChatController/getUnreadCount",
            type: 'GET',
            success: function(response) {
                if(level == "Client"){ // CEK LEVEL CLIENT ATAU ADMIN.
                    if(response === 0){ // JIKA TIDAK ADA NOTIF/ PESAN BELUM DIBACA.
                        if (countUnreadNotifTicket) { 
                            countUnreadNotifTicket.hidden = true; // SEMBUNYIKAN NOTIF PADA TAB NAVIGASI.
                        }
                    }else if(response >= 1){ // JIKA ADA SATU ATAU LEBIH PESAN YANG BELUM DIBACA (UNREAD).
                        // CEK APAKAH ELEMENT ID YANG DITAMPUNG PADA countUnreadNotifTicket ADA ATAU DI MUAT (MENCEGAH ERROR JIKA YANG SEDANG DIAKSES ADALAH LEVEL CS).
                        if (countUnreadNotifTicket) { 
                            countUnreadNotifTicket.hidden = false; // TAMPILKAN NOTIF PADA TAB NAVIGASI.
                            countUnreadNotifTicket.textContent = "New"; // CETAK NEW JIKA ADA PESAN UNREAD.
                        }
                    }
                }else if(level == "Admin"){ // CEK LEVEL CLIENT ATAU ADMIN.
                    if(response === 0){ // JIKA TIDAK ADA NOTIF/ PESAN BELUM DIBACA.
                        if (countUnreadNotifTicket) {
                            countUnreadNotifTicket.hidden = true; // SEMBUNYIKAN NOTIF PADA TAB NAVIGASI.
                        }
                    }else if(response >= 1){ // JIKA ADA SATU ATAU LEBIH PESAN YANG BELUM DIBACA (UNREAD).
                        // CEK APAKAH ELEMENT ID YANG DITAMPUNG PADA countUnreadNotifTicket ADA ATAU DI MUAT (MENCEGAH ERROR JIKA YANG SEDANG DIAKSES ADALAH LEVEL CS).
                        if (countUnreadNotifTicket) { 
                            countUnreadNotifTicket.hidden = false; // TAMPILKAN NOTIF PADA TAB NAVIGASI.
                            countUnreadNotifTicket.textContent = "New"; // CETAK NEW JIKA ADA PESAN UNREAD.
                        }
                    }
                }else if(level == "Cs"){ // CEK LEVEL CS.
                    if(response === 0){ // JIKA TIDAK ADA NOTIF/ PESAN BELUM DIBACA.
                        if (countUnreadNotifAssignTicketCs){
                            countUnreadNotifAssignTicketCs.hidden = true; // SEMBUNYIKAN NOTIF PADA TAB NAVIGASI.
                        }
                    }else if(response >= 1){ // JIKA ADA SATU ATAU LEBIH PESAN YANG BELUM DIBACA (UNREAD).
                        // CEK APAKAH ELEMENT ID YANG DITAMPUNG PADA countUnreadNotifTicket ADA ATAU DI MUAT (MENCEGAH ERROR JIKA YANG SEDANG DIAKSES ADALAH LEVEL CLIENT).
                        if (countUnreadNotifAssignTicketCs) { 
                            countUnreadNotifAssignTicketCs.hidden = false; // TAMPILKAN NOTIF PADA TAB NAVIGASI.
                            countUnreadNotifAssignTicketCs.textContent = "New"; // CETAK NEW JIKA ADA PESAN UNREAD.
                        }
                    }
                }
            }
        });
    };
    // MEMERIKSA APAKAH ADA PESAN DENGAN STATUS UNREAD PADA TIKET YANG CS BUAT (MY TICKET), UNTUK MEMBERI TANDA PADA TAB NAVIGASI ======================================== 
    function getCountNotifTicketCs(){
        $.ajax({
            url: base_url+"/LiveChatController/getUnreadCountMyTicetCs", 
            type: 'GET',
            success: function(response) {
                if(response == 0){ // JIKA TIDAK ADA NOTIF/ PESAN BELUM DIBACA.
                    if (countUnreadNotifMyTicketCs) {
                        countUnreadNotifMyTicketCs.hidden = true; // SEMBUNYIKAN NOTIF PADA TAB NAVIGASI.
                    }
                }else if(response >= 1){ // JIKA ADA SATU ATAU LEBIH PESAN YANG BELUM DIBACA (UNREAD).
                    // CEK APAKAH ELEMENT ID YANG DITAMPUNG PADA countUnreadNotifTicket ADA ATAU DI MUAT (MENCEGAH ERROR JIKA YANG SEDANG DIAKSES ADALAH LEVEL CLIENT).
                    if (countUnreadNotifMyTicketCs) { 
                        countUnreadNotifMyTicketCs.hidden = false; // TAMPILKAN NOTIF PADA TAB NAVIGASI.
                        countUnreadNotifMyTicketCs.textContent = "New"; // CETAK NEW JIKA ADA PESAN UNREAD.
                    }
                }
            }
        });
    };
// ================================================================================================================================

//  =================================================TOMBOL CLOSED TIKET=======================================================
    $(document).on('click','#btn_closed',function(){         
        var dataParam = {id_chat: paramIDChatTicket};
        $.ajax({
            url: base_url+'/LiveChatController/closeChat',
            type: 'POST',
            data: dataParam,
            success: function(response){                
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
                // ===========================================================================================================
                configFormChat(paramIDChatTicket);
                loopMsgOpenTicket();  // PERULANGAN CARD TICKET (SISI CLIENT DAN CS).
                
            }
        });           
    });
//  ===========================================================================================================================

//  ============================================TOMBOL KIRIM PESAN (SEND BUTTON)===============================================
    $(document).on('click','#btn_send',function() { 
            
        // TAMPUNG NILAI DARI INPUT TEXT DAN INPUT FILE YANG AKAN DIKIRIM.
        var descChat = document.getElementById('input_chat').value;
        var fileInput = document.getElementById('file');
         
        if(fileInput){ // JIKA FILE ADA.
            var file = fileInput.files[0]; // MENGAMBIL FILE PERTAMA DARI DAFTAR FILE YANG DIUNGGAH.
        }else{ // JIKA FILE TIDAK ADA.
            var file = ""; // ATUR FILE MENJADI KOSONG, MENCEGAH ERROR.
        }
        var dataParam = {id_chat:paramIDChatTicket};
        $.ajax({
            url: base_url+"/LiveChatController/retriveData",
            type: 'GET',
            data: dataParam,
            success: function(response) { 
                $.each(response, function (key, item){
                    // CEK PENGIRIM PESAN ADALAH PENGGUNA YANG MEMBUAT TIKET (CLIENT) ATAU BUKAN (CS), LALU BUAT OBJECT JSON.
                    if(item[0].creator_id == userID){ // JIKA PENGIRIM PESAN ADALAH PENGGUNA YANG MEMBUAT TIKET (CLIENT).
                        // BUAT OBJECT FORM DATA UNTUK MENAMPUNG NILAI (JSON).
                        var formData = new FormData();
                        formData.append('id_chat', paramIDChatTicket);
                        formData.append('input_chat', descChat);
                        formData.append('file', file);
                        // PESAN DIARAHKAN KE PENGGUNA YANG DITUJU (CS).
                        formData.append('dest_id_user', item[0].destination_id_user); 
                        formData.append('dest_user_name', item[0].destination_user_name);                                
                    }else if(item[0].creator_id != userID){ // JIKA PENGIRIM PESAN BUKAN PEMBUAT TIKET (CS) MEMBALAS PESAN CLIENT.
                        // BUAT OBJECT FORM DATA UNTUK MENAMPUNG NILAI (JSON).
                        var formData = new FormData();
                        formData.append('id_chat', paramIDChatTicket);
                        formData.append('input_chat', descChat);
                        formData.append('file', file);
                        // PESAN BALASAN DIARAHKAN KE PENGGUNA YANG MEMBUAT TIKET (CLIENT).
                        formData.append('dest_id_user', item[0].creator_id);
                        formData.append('dest_user_name', item[0].creator_name);                                  
                    }                   
                    // KIRIM FormData DENGAN AJAX KE CONTROLLER.
                    if(descChat !== "" || file !== ""){
                        $.ajax({
                            url: base_url+"/LiveChatController/chatActivity",
                            type: 'POST',
                            data: formData,
                            processData: false, // SET FALSE AGAR FormData TIDAK DIPROSES SECARA OTOMATIS.
                            contentType: false, // SET FALSE AGAR FormData MENENTUKAN TIPE KONTENT SECARA OTOMATIS.
                            cache: false,
                            success: function(response) {
                                document.getElementById('input_chat').value = ""; // KOSONGKAN KEMBALI INPUT TEXT SETELAH PESAN DIKIRIM.
                                // JALANKAN FUNGSI emptySendFile, SETELAH PROSES PENGIRIMAN FILE.
                                emptySendFile(); // KOSONGKAN KEMBALI INPUT FILE SETELAH FILE DIKIRIM.
                                // JALANKAN KEMBALI FUNGSI retriveChatActivity, UNTUK UPDATE CHAT PADA BODY CONSOLE.
                                retriveChatActivity(paramIDChatTicket);                                                     
                            }
                        });
                    }
                });
            }
        });
    });
//  ===========================================================================================================================

// ==============================PENGATUR KETINGGIAN OTOMATIS PADA INPUT TEXT==================================================
    // MENGATUR OTOMATIS KETINGGIAN INPUT SEND TEXT, PADA FOOTER CONSOLE ======================================================
        function autoHeight(element) {
            element.style.height = "5px";
            element.style.height = (element.scrollHeight)+"px"; 
        }
        function onInput(element) {
            autoHeight(element);
        }
        function onKeyDown(element) {
            autoHeight(element);
        }
        function onKeyUp(element) {
            autoHeight(element);
        }
        function onKeyPress(element) {
            autoHeight(element);
        }
        function onPaste(element) {
            setTimeout(function() {
                autoHeight(element);
            }, 0);
        }
        function onCut(element) {
            setTimeout(function() {
                autoHeight(element);
            }, 0);
        }
        function onUndo(element) {
            setTimeout(function() {
                autoHeight(element);
            }, 0);
        }
        function onRedo(element) {
            setTimeout(function() {
                autoHeight(element);
            }, 0);
        }
    // ======================================================================================================================== 
// ============================================================================================================================

// ==========================================CANCEL ATTACH FILE================================================================
    $(document).on('click','#btn_cancel',function()
    {
        emptySendFile();
    });
    // ======================================== MENGOSONGKAN ATTACHMENT FILE ==================================================
    function emptySendFile()
    {
        // MENGOSONGKAN KEMBALI NAMA FILE, IMAGE FILE, DAN FILE YANG TELAH DIKIRIM ATAU BATAL DIKIRIM.
        document.getElementById('name-file').textContent  = '';
        document.getElementById('image_file').innerHTML = '';
        document.getElementById('file').value='';

        // MENJALANKAN FUNGSI showFooterConsole, UNTUK MENAMPILKAN KEMBALI INPUT TEXT PADA FOOTER CONSOLE.
        showFooterConsole();

        // MENYEMBUNYIKAN containImgExt (CONTAINER MENAMPUNG IMAGE FILE YANG AKAN DIKIRIM).
        containImgExt.style.display ="none";
    }
    // ========================================================================================================================
// ============================================================================================================================

// MENAMPILKAN SELANG WAKTU SEJAK TIKET DIBUAT HINGGA SAAT INI TIKET DIAKSES ==================================================
    function formatElapsedTime(ticketCreatedDate) 
    {
        var now = new Date();
        var timeDifference = now - ticketCreatedDate;

        // MENGHITUNG SELISIH WAKTU DALAM MILIDETIK, DETIK, MENIT, JAM, HARI, BULAN, & TAHUN.
        var seconds = Math.floor(timeDifference / 1000);
        var minutes = Math.floor(seconds / 60);
        var hours = Math.floor(minutes / 60);
        var days = Math.floor(hours / 24);
        var months = Math.floor(days / 30);
        var years = Math.floor(months / 12);

        // KEMBALIKAN NILAI BERDASARKAN KONDISI (TAHUN, BULAN, HARI, DAN SAAT INI).
        if (years > 0) {
        return years + ' Years ago';
        } else if (months > 0) {
        return months + ' Months ago';
        } else if (days > 0) {
        return days + ' Days ago';
        } else {
        return 'Today';
        }    
    };
// ============================================================================================================================


// FUNGSI FILTER BERDASARKAN PRIORITAS TIKET PADA SELECT OPTION, DAN BERDASARKAN INPUT TEXT MANUAL. ===========================
    $(document).ready(function(){
        // Select Option
        $('#filteringPriority').change(function(){
            var selectPriority = $(this).val(); // Take value frome selected option.
            filterTickets(selectPriority); //Run filterTicket function, when user selecting option and send value to this function.
        });
        // Input Search
        $('#searchTicket').on('input', function(){ 
            var searchText = $(this).val().toLowerCase(); // Take keyword from input text and convert to lowercase.
            searchTickets(searchText); // Run searchTicket, and send keyword in input text to this function.
        })
    });
    // SELECT OPTION.
        function filterTickets(selectPriority){
            $('.ticket_card').hide(); // Hiide all card from loopMsgOpenTicket(). 
            if(selectPriority === ''){
                $('.ticket_card').show(); // If no option selected, show all card.
            }else{
                $('.ticket_card').each(function(){
                    var priority = $(this).find('.m-custome-ticket').text();// Take value priority from card.
                    // Check if priority on card same with selected priority option.
                    if(priority === selectPriority){
                        $(this).show(); // Display card with this condition, or same with selected priority option.
                    }
                });
            }
        }
    // INPUT TEXT.
        function searchTickets(searchText){
            $('.ticket_card').hide(); // Hide all card.
            $('.ticket_card').each(function(){   
                // Take keyword from input text, save to textOnCard. replace or remove spaces using regex to search for spaces globally.
                var textOnCard = $(this).text().toLowerCase().replace(/\s/g, ""); 
                
                if(textOnCard.includes(searchText)){ // Check if the card has the same word as the keyword.
                    $(this).show(); // Show tickets that have the same word as the keyword from the input text.
                }
            });
            
        }
// ============================================================================================================================


// DOWNLOAD FILE ==============================================================================================================
    function downloadFile(param_id_message, file_name){
        var dataToSend = {id_file : param_id_message, name_file : file_name} // MENGIRIM ID PESAN.  
        $.ajax({
            url: base_url+"/LiveChatController/downloadFile",
            type: 'GET',
            data: dataToSend,
            cache: false,
            xhrFields: {
                responseType: 'blob' // Menetapkan tipe respons sebagai blob (binary data)
            },
            success: function(response, status, xhr) {                
                var url = URL.createObjectURL(response); // MEMBUAT OBJECT URL DARI RESPON BLOB (METODE UNTUK MENGHASILKAN URL UNIK YANG DAPAT DIGUNAKAN UNTUK MENGAKSES DATA DALAM BLOB).
                var link = document.createElement('a'); // MEMBUAT ELEMENT ANCHOR <a> UNTUK MENGARAHKAN BROWSER KE URL UNDUHAN.
                link.href = url; // MEMBERI ATAU MENGATUR PROPERTI HREF PADA ELEMENT ANCHOR <a> DENGAN URL YANG DIDAPAT DARI BLOB.
                link.download = file_name; // MEMBERI ATAU MENGATUR PROPERTI DOWNLOAD PADA ELEMENT ANCHOR <a> DENGAN NAMA FILE YANG AKAN DIUNDUH.
                link.click(); // PEMICU (CLICK) UNTUK MENJALANKAN PROSES DOWNLOAD PADA ELEMENT ANCHOR <a>.
                URL.revokeObjectURL(url); // MEBERSIHKAN OBJEK URL YANG BARU SAJA DIGUNAKAN SAAT MENGUNDUH FILE, MENCEGAH PENUMPUKAN URL YANG BERPENGARUH PADA MEMORY.
            }
        });
    }
// ============================================================================================================================


// ============================================== BUAT TIKET BARU =============================================================
    // MEMBUAT DAN BATAL MEMBUAT NEW TICKET ===================================================================================
        $(document).on('click','#createNewTicket', function(){ // MEMBUAT TICKET BARU.
            createNewTicket.hidden = true; // MENYEMBUNYIKAN TOMBOL NEW TICKET.
            cancelCreateTicket.hidden = false; // MENAMPILKAN TOMBOL CANCEL.
        })
        $(document).on('click','#cancelCreateTicket', function(){ // BATAL MEMBUAT TICKET BARU.
            createNewTicket.hidden = false; // MENAMPILKAN KEMBALI TOMBOL NEW TICKET.
            cancelCreateTicket.hidden = true; // MENYEMBUNYIKAN KEMBALI TOMBOL CANCEL.
        })
    // ========================================================================================================================

    // FORM SELECT OPTION UNTUK NEW TICKET ====================================================================================
        // SELECT OPTION SUBJECT DARI CHAT ====================================================================================
            $('#subjectChat').select2({  
                placeholder: 'Choose Subject',
                width: 'resolve',
                theme: "bootstrap4",
                minimumResultsForSearch: Infinity, // MENYEMBUNYIKAN SERCH BOX PADA SELECT2.
                tags: true // MENGAKTIFKAN FITUR TAGING.
            }).on('select2:selecting', function(e) {    
                var selectedValue = e.params.args.data.id; // MENANGKAP NILAI DARI SELECT OPTION YANG DIPILIH PENGGUNA.
                // KONDISI JIKA PENGGUNA MEMILIH OTHER PADA SELECT OPTION SUBJECT.
                if (selectedValue === 'other') { 
                    selectSubject.disabled = true; // MENONAKTIFKAN FUNGSI SELECT OPTION.
                    optionSelect.hidden = true; // MENYEMBUNYIKAN SELECT OPTION.
                    otherOption.hidden = false; // MENAMPILKAN INPUT TEXT SEBAGAI OTHER SUBJECT.
                }
            });
        // ====================================================================================================================
        // TOMBOL CANCEL(X) MEMBUAT SUBJECT OTHER (KEMBALI KE SELECT OPTION) ==================================================
            $(document).on('click', '#cancelOther', function() {
                // MENGOSONGKAN KEMBALI NILAI DARI SUBJECT YANG DI INPUT.
                $('#subjectChat').val(null).trigger('change');
                otherOption.hidden = true;  // MENYEMBUNYIKAN INPUT TEXT SEBAGAI OTHER SUBJECT.
                optionSelect.hidden = false; // MENAMPILKAN KEMBALI SELECT OPTION.
                selectSubject.disabled = false; // MENGAKTIFKAN KEMBALI FUNGSI SELECT OPTION.
            });
        // ====================================================================================================================
        // SELECT OPTION TIPE TIKET ===========================================================================================
            $('#ticket').select2({  
                placeholder: 'Choose Ticket',
                width: 'resolve',
                theme: "bootstrap4",
                minimumResultsForSearch: Infinity, // MENYEMBUNYIKAN SERCH BOX PADA SELECT2.
            });
        // ====================================================================================================================
        // SELECT OPTION PRIORITY =============================================================================================
            $('#priority').select2({  
                placeholder: 'Choose Priority',
                width: 'resolve',
                theme: "bootstrap4",
                minimumResultsForSearch: Infinity, // MENYEMBUNYIKAN SERCH BOX PADA SELECT2.
            });
        // ====================================================================================================================
    // ========================================================================================================================
// ============================================================================================================================