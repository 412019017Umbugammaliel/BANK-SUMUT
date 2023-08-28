// MERUBAH SETATUS UNREAD KE READ UNTUK LOG TERTENTU, SESUAI DENGAN ID LOG YANG DIMAKSUD =============================================
    function markReadLog(){
        // Send id_chat & time_chat parameters to set chat read status.
        var dataToSend = {id_Log : idLog, category : category}   
        $.ajax({
            url: base_url+"/Home/setReadLog",
            type: 'POST',
            data: dataToSend,
            cache: false,
            success: function(response) {
                getCountNotifNav(); // FUNGSI PENGATURAN PADA NAVIGASI.
                getCountNotifTicket(); // FUNGSI PENGATURAN PADA TIKET.

                table_log.ajax.reload(); // Reaload ajax after button or icon detail kliked.
                getLogMsg(); // Runing function for show notification in navbar top.	
            }
        });			
    }
// ===================================================================================================================================

// LOG TABLE =========================================================================================================================
    function getDataLog(){    
        table_log = $('#logactivity').DataTable({
            dom: 'ltpr', // MENDEFINISIKAN FITUR YANG DIGUNAKAN DALAM DATA TABLES.
            responsive: true, // MENGAKTIFKAN KOLOM YANG RESPONSIFE (DATAP MENYESUAIKAN UKURAN).
            fixedColumns: true,
            autowidth: true, // MENGATUR LEBAR PLACEHOLDER SECARA OTOMATIS.
            lengthMenu: [ // MENGATUR JUMLAH BAYAK BARIS YANG DITAMPILKAN (BENTUK PILIHAN).
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, 'All'],
            ],
            ajax:{
                url: base_url+"/Home/retrieveLogDataTabel",
                type: "GET",
                dataType: "json",
                dataSrc: 'data',								
            },				
            columnDefs: [ //MENDEFINISIKAN KEADAAN KOLOM.
            // HEADER RATA TENGAN NO-WRAP.
                { className: "dt-head-center", targets: [ 0, 1, 2, 3, 4, 5 ] }, // KOLOM INDEX KE 0 - 5
                { className: "dt-head-nowrap", targets: [ 0, 1, 2, 4, 5 ] },
                // BODY RATA TENGAH NO-WRAP.
                { className: "dt-body-center", targets: [ 0, 1, 2, 4, 5 ] },
                { className: "dt-body-nowrap", targets: [ 0, 1, 2, 4, 5 ] },
            ],	
            columns: [	// MENGATUR SUSUNAN / URUTAN DATA DALAM SETIAP KOLOM (KOLOM 1: ICON, KOLOM 2: HOST SERVE, DST).
                {
                    data: null, // KOLOM KE-1 INDEX 0. MENGATUR KOLOM PERTAMA BERNILAI NULL, KARENA TIDAK ADA DATA SEHINGGA PERLU DI SET MENJADI NULL (MENCEGAH ERROR).
                    defaultContent: '', // MEGATUR JIKA ADA CELL DALAM TABEL YANG KOSONG MENJADI EMPTY STRING.
                    // MERENDER / MENAMPILKAN ICON DAN IMAGE PADA DATA TABLES.
                    render: function (data, type, full, meta) {
                        // KONDISI WARNA.
                        var stat_color;
                        if(full.status_read == 'read'){
                            stat_color = 'icon-detail-green-dt';
                        } else if(full.status_read == 'unread'){
                            stat_color = 'icon-detail-red-dt';
                        }
                        return '<a class="ml-05 text-nowrap '+stat_color+'" id="btn_detailLog" data-bs-toggle="modal" data-bs-target="#logShow" data-id_log = "'+full.id_log+'" data-user_name_log = "'+full.user_name+'" data-category = "'+full.category+'" data-desc_log_activity = "'+full.desc_log_activity+'" data-date_time = "'+full.date_time+'" data-status_read = "'+full.status_read+'">'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">'+
                                        '<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>'+
                                        '<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>'+
                                    '</svg>'+
                                '</a>'
                    }
                },
                { data: 'id_log' }, // KOLOM KE-2 INDEX 1.
                { data: 'category' }, // KOLOM KE-3 INDEX 2.
                { data: 'desc_log_activity' }, // DST.
                { data: 'date_time' },
                { data: 'status_read' } // KOLOM TERAKHIR.
            ],				
        });

    // FITUR FILTER DAN SEARCH LOG ACTIVITY.
        // FUNGSI SEARCH BOX.
        $('#search-log').on('input', () => {            
            table_log.search($("#search-log").val()).draw(); // AMBIL NILAI DARI ELEMENT SEARCH KEMUDAIN CARI PADA ELEMENT DATA TABLES, KEMUDIAN PERBAHARUI TABEL KEMBALI SESUAI SEARCH.
         });
        // FUNGSI FILTER BERDASARKAN READ DAN UNREAD.
        $('#log_status').on('change', () => {            
            table_log.search($("#log_status").val()).draw();
        });
    // End =====================================
    }
// ===================================================================================================================================

// MENYEMBUNYIKAN MODAL SETELAH MENGHAPUS PESAN ATAU LOG =============================================================================
    // Hide modal message detail.
        function hideModalMsg() {
            const hideModal = document.querySelector('#messageShow');
            const modal = bootstrap.Modal.getInstance(hideModal);    
            modal.hide();
        }
    // ===============================================================================================================================

    // Hide modal message detail.
        function hideModalLog() {
            const hideModal = document.querySelector('#logShow');
            const modal = bootstrap.Modal.getInstance(hideModal);    
            modal.hide();
        }
    // ===============================================================================================================================
// ===================================================================================================================================


// HAPUS NOTIFIKASI ================================================================================================================== PENDING
    // FUNGSI UNTUK MENGHAPUS LOG DARI TABEL LOG NOTIFIKASI ==========================================================================
        $(document).delegate('#delete_log','click', function(event){
            // window.location.href="<?php //echo base_url('Home/deleteMessage')?>/"+messageID; // send message id as parameter delete message
            var dataToSend = {id_Log : idLog, user_Name: userName } 
            console.log(dataToSend);  
            $.ajax({
                url: base_url+"/Home/deleteLog",
                type: 'POST',
                data: dataToSend,
                cache: false,
                success: function(response) {
                    hideModalLog(); // Runing hideModal() function, for close modal message detail.
                    table_log.ajax.reload(); // Reaload ajax after button or icon detail clicked.
                    getCoutNotif(); // Run the process of calculating unread messages.
                    getLogMsg(); // Running process displays unread messages in the list on the navbar.					
                }
            });		
        });
    // ===============================================================================================================================
// ===================================================================================================================================