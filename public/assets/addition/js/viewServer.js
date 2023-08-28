// VARIABLE GLOBAL ========================================================================================
var dcSizeNow, wlSizeNow, cpuSizeNow, memorySizeNow, storageSizeNow;
// ATUR SECARA DEFAULT KOSONG, JIKA PENGGUNA TIDAK MEMILIH UKURAN PADA SELECT OPTION
var sendDataDC = '';
var sendDataWL = '';
var sendDataCPU = '';
var sendDataMemory = '';
var sendDataStorage = '';
// ========================================================================================================

// SERVER TABLE ===========================================================================================
    function tabelDataServer(){
        table_srv = $('#server_tabels').DataTable({
            dom: 'ltpr', // MENDEFINISIKAN FITUR YANG DIGUNAKAN DALAM DATA TABLES.
            responsive: true, // MENGAKTIFKAN KOLOM YANG RESPONSIFE (DATAP MENYESUAIKAN UKURAN).
            fixedColumns: true, 
            autowidth: true, // MENGATUR LEBAR PLACEHOLDER SECARA OTOMATIS.
            lengthMenu: [ // MENGATUR JUMLAH BAYAK BARIS YANG DITAMPILKAN (BENTUK PILIHAN).
                [5, 10, 25, 50, -1], 
                [5, 10, 25, 50, 'All'],
            ],
            ajax:{
                url: base_url+"/serverControler/retrieveServerDataTabel",
                type: "GET",
                dataType: "json",
                dataSrc: 'server',  
            },	
            columnDefs: [ //MENDEFINISIKAN KEADAAN KOLOM.
                // HEADER RATA TENGAN NO-WRAP.
                { className: "dt-head-center", targets: [ 0, 1, 2, 3, 4, 5 ] }, // KOLOM INDEX KE 0 - 5
                { className: "dt-head-nowrap", targets: [ 0, 1, 2, 3, 4, 5 ] },
                // BODY RATA TENGAH NO-WRAP.
                { className: "dt-body-center", targets: [ 2, 4, 5 ] }, // KOLOM INDEX 2 4 DAN 5.
                { className: "dt-body-nowrap", targets: [ 0, 1, 2, 4, 5] },
            ],	
            columns: [	// MENGATUR SUSUNAN / URUTAN DATA DALAM SETIAP KOLOM (KOLOM 1: ICON, KOLOM 2: HOST SERVE, DST).				
                {
                    data: null, // KOLOM KE-1 INDEX 0. MENGATUR KOLOM PERTAMA BERNILAI NULL, KARENA TIDAK ADA DATA SEHINGGA PERLU DI SET MENJADI NULL (MENCEGAH ERROR).
                    defaultContent: '', // MEGATUR JIKA ADA CELL DALAM TABEL YANG KOSONG MENJADI EMPTY STRING.
                    // MERENDER / MENAMPILKAN ICON DAN IMAGE PADA DATA TABLES.
                    render: function (data, type, full, meta) {
                        // KONDISI WARNA.
                        var stat_color;
                        if(full.power_status == 'ON'){
                            stat_color = 'green';
                        } else if(full.power_status == 'OFF'){
                            stat_color = 'red';
                        }
                        return  '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="'+ stat_color +'" class="bi bi-circle-fill" viewBox="0 0 16 16">'+
                                    '<circle cx="8" cy="8" r="8"/>'+
                                '</svg>'
                    }
                },
                { data: 'host_server' }, // KOLOM KE-2 INDEX 1.
                { data: 'server_id' }, // KOLOM KE-3 INDEX 2.
                { data: 'host_server' }, // DST.
                { data: 'power_status' },
                {
                    data: null, // KOLOM TERAKHIR DI SET NULL JUGA KARENA TIDAK ADA DATA, HANYA MENAMPUNG TOMBOL VIEW.
                    render: function(data, type, full, meta) {
                        return '<a class="btn-sm app-btn-secondary" href="' + base_url + '/serverControler/viewServer/' + full.id_user + '">View</a>';
                    }
                }
            ],				
        });
    }
// ========================================================================================================

// MENGAMBIL DAN MENAMPILKAN DATA DARI DATABASE SERVER KE VIEW SERVER =====================================
    function getDataServer(){
        var dataParam = {idUserServer : id_user};    
        $.ajax({
            url: base_url+"/serverControler/getServerData",
            type: 'GET',
            data: dataParam,
            success: function(response) {
                $.each(response, function (key, data){
                    dcSizeNow = data.data_center;
                    wlSizeNow = data.windows_license;
                    cpuSizeNow = data.cpu;
                    memorySizeNow = data.memory;
                    storageSizeNow = data.storage;

                    // MENAMPILKAN INFORMASI KEDALAM ELEMENT DENGAN ID ATAU CLASS YANG DITUJU PADA VIEW SERVER.
                    $('#titleUserName').text(data.user_name); 
                    $('#serverID').text(data.server_id);
                    $('#hostServer').text(data.host_server);
                    $('#primaryIP').text(data.primary_ip);
                    $('#gateway').text(data.gateway);
                    $('#showDC').text(data.data_center);
                    $('#showWL').text(data.windows_license);
                    $('#showCPU').text(data.cpu);
                    $('#showMemory').text(data.memory);
                    $('#showStorage').text(data.storage);
                    $('#serverLocation').text(data.server_location);
                    $('.powerStatus').text(data.power_status);

                  // ADMIN (HANYA DITAMPILKAN PADA ADMIN) ==========
                    // MEMBERI NILAI PADA INPUT BOX CPU DAN MEMORY.
                    $('#dcAdmin').val(data.data_center); // DATA CENTER.
                    $('#wlAdmin').val(data.windows_license); // WINDOWS LICENSE.
                    $('#cpuAdmin').val(data.cpu); // CPU.
                    $('#memoryAdmin').val(data.memory); // MEMORY.
                    $('#storageAdmin').val(data.storage); // STORAGE
                  // ===============================================

                  // KONDISI BERDASARKAN STATUS POWER DARI SERVER YANG DITAMPILKAN.
                    if(data.power_status == "ON"){
                        $('.powerStatus').removeClass('bg-danger'); // HAPUS CLASS bg-danger (GANTI DENGAN CLASS DIBAWAH).
                        $('.powerStatus').addClass('bg-success'); // TAMBAHKAN CLASS bg-success.

                        $('.bgColor').removeClass('table-color-red'); // HAPUS CLASS table-color-red (GANTI DENGAN CLASS DIBAWAH).
                        $('.bgColor').addClass('table-color-default'); // TAMBAHKAN CLASS table-color-default.
                    
                        $('.powerStatus').addClass('badge'); // TAMBAHKAN CLASS badge, UNTUK MEMBUAT MEMBINGKAI STATUS DARI SERVER TERSEBUT. 
                        $('#statusServer').prop('checked', true); // TAMBAHKAN PROPERTI CHECKED PADA INPUT CHECKBOX (ATUR CHECKED KE TRUE).
                    } else { // KONDISI SEBALIKNYA JIKA STATUS POWER OFF.
                        $('.powerStatus').removeClass('bg-success');
                        $('.powerStatus').addClass('bg-danger');

                        $('.bgColor').removeClass('table-color-default'); 
                        $('.bgColor').addClass('table-color-red');

                        $('.powerStatus').addClass('badge');
                        $('#statusServer').prop('checked', false); // TAMBAHKAN PROPERTI CHECKED PADA INPUT CHECKBOX (ATUR CHECKED KE FALSE).
                    }
                });
            }
        });
    }
// ========================================================================================================

// CLIENT =================================================================================================
    // MENINGKATKAN DAN MENURUNKAN TINGKAT CPU DAN MEMORY =================================================
        /*  
            MERESPON PERUBAHAN PADA SELECT OPTION DENGAN ID CPU_size/ memoryCapacity, GUNA MENAMPILKAN KETERANGAN PADA SAAT MEMILIH NILAI
            UKURAN DARI SELECT OPTION PADA CPU_size/ memoryCapacity. JIKA PENGGUNA CLIENT MEMILIH UKURAN LEBIH KECIL MAKA AKAN MUNCUL
            KETERANGAN ( You want to DOWNGRADE the CPU to 8 Core.), DAN SEBALIKNYA SEBELUM MENAMBAHKAN KE KERANJANG. 
        */
        // DATA CENTER ====================================================================================
            $('#DC_size').on("change", function() { 
                dcOrder = document.getElementById('DC_size');            
                selectedDCOrder = document.getElementById('showValueDC');  
                statDC_1 = document.getElementById('statDC-1');
                statDC_2 = document.getElementById('statDC-2');
                selectedDCOrder.textContent = dcOrder.value + ' Unit';
                if(dcOrder.value <= dcSizeNow){
                    statDC_1.textContent = 'DOWNGRADE';
                    statDC_2.textContent = 'DOWNGRADE';
                }else if(dcOrder.value  >= dcSizeNow){
                    statDC_1.textContent = 'UPGRADE';
                    statDC_2.textContent = 'UPGRADE';
                }                 
            });
        // ================================================================================================
        // WINDOWS LICENSE ================================================================================
            $('#WL_size').on("change", function() { 
                wlOrder = document.getElementById('WL_size');            
                selectedWLOrder = document.getElementById('showValueWL');  
                statWL_1 = document.getElementById('statWL-1');
                statWL_2 = document.getElementById('statWL-2');
                selectedWLOrder.textContent = wlOrder.value + ' Unit';
                if(wlOrder.value <= wlSizeNow){
                    statWL_1.textContent = 'DOWNGRADE';
                    statWL_2.textContent = 'DOWNGRADE';
                }else if(wlOrder.value  >= wlSizeNow){
                    statWL_1.textContent = 'UPGRADE';
                    statWL_2.textContent = 'UPGRADE';
                }                 
            });
        // ================================================================================================
        // CPU ============================================================================================
            $('#CPU_size').on("change", function() { 
                cpuOrder = document.getElementById('CPU_size');            
                selectedCpuOrder = document.getElementById('showValueCPU');  
                statCPU_1 = document.getElementById('statCPU-1');
                statCPU_2 = document.getElementById('statCPU-2');
                selectedCpuOrder.textContent = cpuOrder.value + ' Core';
                if(cpuOrder.value <= cpuSizeNow){
                    statCPU_1.textContent = 'DOWNGRADE';
                    statCPU_2.textContent = 'DOWNGRADE';
                }else if(cpuOrder.value  >= cpuSizeNow){
                    statCPU_1.textContent = 'UPGRADE';
                    statCPU_2.textContent = 'UPGRADE';
                }                 
            });
        // ================================================================================================
        // MEMORY =========================================================================================
            $('#memoryCapacity').on("change", function() {                     
                memoryOrder = document.getElementById('memoryCapacity');
                selectedMemoryOrder = document.getElementById('showValueMemory');
                statMemory_1 = document.getElementById('statMemory-1');
                statMemory_2 = document.getElementById('statMemory-2');
                selectedMemoryOrder.textContent = memoryOrder.value + ' GB';
                if(memoryOrder.value <= memorySizeNow){
                    statMemory_1.textContent = 'DOWNGRADE';
                    statMemory_2.textContent = 'DOWNGRADE';
                }else if(memoryOrder.value >= memorySizeNow){
                    statMemory_1.textContent = 'UPGRADE';
                    statMemory_2.textContent = 'UPGRADE';
                }                
            });
        // ================================================================================================
        // MEMORY =========================================================================================
            $('#storage_size').on("change", function() {                     
                storageOrder = document.getElementById('storage_size');
                selectedStorageOrder = document.getElementById('showValueStorage');
                statStorage_1 = document.getElementById('statStorage-1');
                statStorage_2 = document.getElementById('statStorage-2');
                selectedStorageOrder.textContent = storageOrder.value + ' GB';
                if(storageOrder.value <= storageSizeNow){
                    statStorage_1.textContent = 'DOWNGRADE';
                    statStorage_2.textContent = 'DOWNGRADE';
                }else if(storageOrder.value >= storageSizeNow){
                    statStorage_1.textContent = 'UPGRADE';
                    statStorage_2.textContent = 'UPGRADE';
                }                
            });
        // ================================================================================================
    // ====================================================================================================

    // MENAMPILKAN (RENDER) ICON MICROCHIP PADA SELECT OPTION 2 ===========================================
        function iconMicrochip(state) { 
            // MEMBUAT VARIABLE $state UNTUK MENAMPUNG ICON DAN TEXT DARI SELECT OPTION YANG AKAN MENGGUNAKAN FUNGSI INI.           
            var $state = $(
                '<span><i class="fa fa-microchip"></i> ' + state.text + '</span>' 
            );
            return $state;
        };
    // ====================================================================================================

    // DATA CENTER SELECT OPTION ==========================================================================
        // SELECT OPTION ==================================================================================
            $('#DC_size').select2({  
                placeholder: 'select Data Center',
                width: 'resolve', // MENGATUR LEBAR SELECT OPTION SESUAI DENGAN LEBAR DARI ELEMENT INDUKNYA.
                theme: "bootstrap4", // MENGGUNAKAN TEMA BOOTSTRAP 4 PADA SELECT 2.
                minimumResultsForSearch: Infinity, // SELECT OPTION TANPA SEARCH BOX.
                templateSelection: iconMicrochip, // MENAMPILKAN ICON PADA PILIHAN SELECT OPTION YANG DI ATUR DALAM FUNGSI iconMicrochip.
                templateResult: iconMicrochip // MENAMPILKAN ICON PADA OPTION YANG TERPILIH, YANG DIATUR DALAM FUNGSI iconMicrochip.
            });
        // ================================================================================================
        // DATA CENTER ====================================================================================
            $(document).on('click','#ChangeOrderDCSize',function(){
                var valueDC = document.getElementById('DC_size').value; // MENGAMBIL NILAI DARI SELECT OPTION YANG DIPILIH PENGGUNA.
                
                if(valueDC == ''){ // CEK APAKAH SELECT OPTION SUDAH DIPILIH ATAU BELUM, JIKA BELUM.
                    swal.fire({ // TAMPILKAN ALERT
                        title: "Sorry",
                        text: "You have not selected the size of the CPU.",
                        icon: "warning",                
                    })
                }else if(valueDC == dcSizeNow){ // CEK APAKAH OPTION YANG DIPILIH SAMA DENGAN DATA TERAKHIR ATAU UKURAN TIDAK BERUBAH. ( cpuSizeNow DIDAPAT DARI FUNGSI getDataServer())
                    swal.fire({ // TAMPILKAN ALERT
                        title: "Sorry",
                        text: "You have not changed the size of the CPU.",
                        icon: "warning",                
                    })
                }else{ // JALANKAN JIKA KONDISI TERPENUHI.                
                    swal.fire({ // TAMPILKAN ALERT BERHASIL MENAMBAHKAN KE DALAM ORDER.
                        position: 'bottom-end',
                        title: "succeed",
                        text: "Your order is added to the cart",
                        icon: 'success',
                        iconHtml:   '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">'+
                                        '<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>'+
                                    '</svg>',
                        customClass: {container: 'my-custom-dialog-1'}, // MEMBERIKAN CLASS TAMBAHAN UNTUK TAMPILAN DARI SWEETALERT.
                        showConfirmButton: false,
                        timer: 3000,
                    })
                    sendDataDC = valueDC; // SIMPAN NILAI DARI PILIHAN PENGGUNA KEDALAM VARIABLE GLOBAL sendDataCPU (PADA TOMBOL CHECK CART).
                }     
            });
        // ================================================================================================
    // ====================================================================================================

    // WINDOWS LICENSE SELECT OPTION ======================================================================
        // SELECT OPTION ==================================================================================
            $('#WL_size').select2({  
                placeholder: 'select Data Center',
                width: 'resolve', // MENGATUR LEBAR SELECT OPTION SESUAI DENGAN LEBAR DARI ELEMENT INDUKNYA.
                theme: "bootstrap4", // MENGGUNAKAN TEMA BOOTSTRAP 4 PADA SELECT 2.
                minimumResultsForSearch: Infinity, // SELECT OPTION TANPA SEARCH BOX.
                templateSelection: iconMicrochip, // MENAMPILKAN ICON PADA PILIHAN SELECT OPTION YANG DI ATUR DALAM FUNGSI iconMicrochip.
                templateResult: iconMicrochip // MENAMPILKAN ICON PADA OPTION YANG TERPILIH, YANG DIATUR DALAM FUNGSI iconMicrochip.
            });
        // ================================================================================================
        // WINDOWS LICENSE ================================================================================
            $(document).on('click','#ChangeOrderWLSize',function(){
                var valueWL = document.getElementById('WL_size').value; // MENGAMBIL NILAI DARI SELECT OPTION YANG DIPILIH PENGGUNA.
                
                if(valueWL == ''){ // CEK APAKAH SELECT OPTION SUDAH DIPILIH ATAU BELUM, JIKA BELUM.
                    swal.fire({ // TAMPILKAN ALERT
                        title: "Sorry",
                        text: "You have not selected the size of the CPU.",
                        icon: "warning",                
                    })
                }else if(valueWL == wlSizeNow){ // CEK APAKAH OPTION YANG DIPILIH SAMA DENGAN DATA TERAKHIR ATAU UKURAN TIDAK BERUBAH. ( cpuSizeNow DIDAPAT DARI FUNGSI getDataServer())
                    swal.fire({ // TAMPILKAN ALERT
                        title: "Sorry",
                        text: "You have not changed the size of the CPU.",
                        icon: "warning",                
                    })
                }else{ // JALANKAN JIKA KONDISI TERPENUHI.                
                    swal.fire({ // TAMPILKAN ALERT BERHASIL MENAMBAHKAN KE DALAM ORDER.
                        position: 'bottom-end',
                        title: "succeed",
                        text: "Your order is added to the cart",
                        icon: 'success',
                        iconHtml:   '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">'+
                                        '<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>'+
                                    '</svg>',
                        customClass: {container: 'my-custom-dialog-1'}, // MEMBERIKAN CLASS TAMBAHAN UNTUK TAMPILAN DARI SWEETALERT.
                        showConfirmButton: false,
                        timer: 3000,
                    })
                    sendDataWL = valueWL; // SIMPAN NILAI DARI PILIHAN PENGGUNA KEDALAM VARIABLE GLOBAL sendDataCPU (PADA TOMBOL CHECK CART).
                }     
            });
        // ================================================================================================
    // ====================================================================================================

    // CPU SELECT OPTION ==================================================================================
        // SELECT OPTION ==================================================================================
            $('#CPU_size').select2({  
                placeholder: 'select CPU size',
                width: 'resolve', // MENGATUR LEBAR SELECT OPTION SESUAI DENGAN LEBAR DARI ELEMENT INDUKNYA.
                theme: "bootstrap4", // MENGGUNAKAN TEMA BOOTSTRAP 4 PADA SELECT 2.
                minimumResultsForSearch: Infinity, // SELECT OPTION TANPA SEARCH BOX.
                templateSelection: iconMicrochip, // MENAMPILKAN ICON PADA PILIHAN SELECT OPTION YANG DI ATUR DALAM FUNGSI iconMicrochip.
                templateResult: iconMicrochip // MENAMPILKAN ICON PADA OPTION YANG TERPILIH, YANG DIATUR DALAM FUNGSI iconMicrochip.
            });
        // ================================================================================================
        // CPU SIZE =======================================================================================
            $(document).on('click','#ChangeOrderCPUSize',function(){
                var valueCPU = document.getElementById('CPU_size').value; // MENGAMBIL NILAI DARI SELECT OPTION YANG DIPILIH PENGGUNA.
                
                if(valueCPU == ''){ // CEK APAKAH SELECT OPTION SUDAH DIPILIH ATAU BELUM, JIKA BELUM.
                    swal.fire({ // TAMPILKAN ALERT
                        title: "Sorry",
                        text: "You have not selected the size of the CPU.",
                        icon: "warning",                
                    })
                }else if(valueCPU == cpuSizeNow){ // CEK APAKAH OPTION YANG DIPILIH SAMA DENGAN DATA TERAKHIR ATAU UKURAN TIDAK BERUBAH. ( cpuSizeNow DIDAPAT DARI FUNGSI getDataServer())
                    swal.fire({ // TAMPILKAN ALERT
                        title: "Sorry",
                        text: "You have not changed the size of the CPU.",
                        icon: "warning",                
                    })
                }else{ // JALANKAN JIKA KONDISI TERPENUHI.                
                    swal.fire({ // TAMPILKAN ALERT BERHASIL MENAMBAHKAN KE DALAM ORDER.
                        position: 'bottom-end',
                        title: "succeed",
                        text: "Your order is added to the cart",
                        icon: 'success',
                        iconHtml:   '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">'+
                                        '<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>'+
                                    '</svg>',
                        customClass: {container: 'my-custom-dialog-1'}, // MEMBERIKAN CLASS TAMBAHAN UNTUK TAMPILAN DARI SWEETALERT.
                        showConfirmButton: false,
                        timer: 3000,
                    })
                    sendDataCPU = valueCPU; // SIMPAN NILAI DARI PILIHAN PENGGUNA KEDALAM VARIABLE GLOBAL sendDataCPU (PADA TOMBOL CHECK CART).
                }     
            });
        // ================================================================================================
    // ====================================================================================================

    // MEMORY SELECT OPTION ===============================================================================
        // SELECT OPTION ==================================================================================
            $('#memoryCapacity').select2({  
                placeholder: 'select memory size',
                width: 'resolve', // MENGATUR LEBAR SELECT OPTION SESUAI DENGAN LEBAR DARI ELEMENT INDUKNYA.
                theme: "bootstrap4", // MENGGUNAKAN TEMA BOOTSTRAP 4 PADA SELECT 2.
                minimumResultsForSearch: Infinity, // SELECT OPTION TANPA SEARCH BOX.
                templateSelection: iconMicrochip, // MENAMPILKAN ICON PADA PILIHAN SELECT OPTION YANG DI ATUR DALAM FUNGSI iconMicrochip.
                templateResult: iconMicrochip // MENAMPILKAN ICON PADA OPTION YANG TERPILIH, YANG DIATUR DALAM FUNGSI iconMicrochip.
            });
        // ================================================================================================
        // MEMORY SIZE ====================================================================================
            $(document).on('click','#ChangeOrderMemorySize',function(){
                var valueMemory = document.getElementById('memoryCapacity').value;

                if(valueMemory == ''){ // CEK APAKAH SELECT OPTION SUDAH DIPILIH ATAU BELUM, JIKA BELUM.
                    swal.fire({ // TAMPILKAN ALERT
                        title: "Sorry",
                        text: "You have not selected the size of the memory.",
                        icon: "warning",                
                    })
                }else if(valueMemory == memorySizeNow){ // CEK APAKAH OPTION YANG DIPILIH SAMA DENGAN DATA TERAKHIR ATAU UKURAN TIDAK BERUBAH. ( memorySizeNow DIDAPAT DARI FUNGSI getDataServer())
                    swal.fire({ // TAMPILKAN ALERT
                        title: "Sorry",
                        text: "You have not changed the size of the memory.",
                        icon: "warning",                
                    })
                }else{                          
                    swal.fire({
                        position: 'bottom-end',
                        title: "succeed",
                        text: "Your order is added to the cart",
                        icon: 'success',
                        iconHtml:   '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">'+
                                        '<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>'+
                                    '</svg>',
                        customClass: {container: 'my-custom-dialog-1'}, // MEMBERIKAN CLASS TAMBAHAN UNTUK TAMPILAN DARI SWEETALERT.
                        showConfirmButton: false,
                        timer: 3000,
                    })  
                    sendDataMemory = valueMemory; // SIMPAN NILAI DARI PILIHAN PENGGUNA KEDALAM VARIABLE GLOBAL sendDataMemory (PADA TOMBOL CHECK CART).
                }
            });
        // ================================================================================================
    // ====================================================================================================

    // STORAGE SELECT OPTION ==============================================================================
        // SELECT OPTION ==================================================================================
            $('#storage_size').select2({  
                placeholder: 'select memory size',
                width: 'resolve', // MENGATUR LEBAR SELECT OPTION SESUAI DENGAN LEBAR DARI ELEMENT INDUKNYA.
                theme: "bootstrap4", // MENGGUNAKAN TEMA BOOTSTRAP 4 PADA SELECT 2.
                minimumResultsForSearch: Infinity, // SELECT OPTION TANPA SEARCH BOX.
                templateSelection: iconMicrochip, // MENAMPILKAN ICON PADA PILIHAN SELECT OPTION YANG DI ATUR DALAM FUNGSI iconMicrochip.
                templateResult: iconMicrochip // MENAMPILKAN ICON PADA OPTION YANG TERPILIH, YANG DIATUR DALAM FUNGSI iconMicrochip.
            });
        // ================================================================================================
        // STORAGE SIZE ===================================================================================
            $(document).on('click','#ChangeOrderStorageSize',function(){
                var valueStorage = document.getElementById('storage_size').value;

                if(valueStorage == ''){ // CEK APAKAH SELECT OPTION SUDAH DIPILIH ATAU BELUM, JIKA BELUM.
                    swal.fire({ // TAMPILKAN ALERT
                        title: "Sorry",
                        text: "You have not selected the size of the memory.",
                        icon: "warning"                
                    })
                }else if(valueStorage == storageSizeNow){ // CEK APAKAH OPTION YANG DIPILIH SAMA DENGAN DATA TERAKHIR ATAU UKURAN TIDAK BERUBAH. ( memorySizeNow DIDAPAT DARI FUNGSI getDataServer())
                    swal.fire({ // TAMPILKAN ALERT
                        title: "Sorry",
                        text: "You have not changed the size of the memory.",
                        icon: "warning"
                    })
                }else{                          
                    swal.fire({
                        position: 'bottom-end',
                        title: "succeed",
                        text: "Your order is added to the cart",
                        icon: 'success',
                        iconHtml:   '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">'+
                                        '<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>'+
                                    '</svg>',
                        customClass: {container: 'my-custom-dialog-1'}, // MEMBERIKAN CLASS TAMBAHAN UNTUK TAMPILAN DARI SWEETALERT.
                        showConfirmButton: false,
                        timer: 3000,
                    })  
                    sendDataStorage = valueStorage; // SIMPAN NILAI DARI PILIHAN PENGGUNA KEDALAM VARIABLE GLOBAL sendDataMemory (PADA TOMBOL CHECK CART).
                }
            });
        // ================================================================================================
    // ====================================================================================================

    // TOMBOL CHECK CART SERVER ===========================================================================
        $(document).on('click','#cekCartOrder',function(){
            dataToSend = { 
                'dcOrder' : sendDataDC, // NILAI DARI SELECT OPTION PILIHAN PENGGUNA.
                'wlOrder' : sendDataWL, // NILAI DARI SELECT OPTION PILIHAN PENGGUNA.
                'cpuOrder' : sendDataCPU, // NILAI DARI SELECT OPTION PILIHAN PENGGUNA.
                'memoryOrder' : sendDataMemory, // NILAI DARI SELECT OPTION PILIHAN PENGGUNA.
                'storageOrder' : sendDataStorage, // NILAI DARI SELECT OPTION PILIHAN PENGGUNA.

                'serverUserID': id_user, 

                'dcSizeNow' : dcSizeNow, // KIRIM NILAI SAAT INI.
                'wlSizeNow' : wlSizeNow, // KIRIM NILAI SAAT INI.
                'cpuSizeNow' : cpuSizeNow, // KIRIM NILAI SAAT INI.
                'memorySizeNow' : memorySizeNow, // KIRIM NILAI SAAT INI.
                'storageSizeNow' : storageSizeNow // KIRIM NILAI SAAT INI.
            };
            // LAKUKAN PEMERIKSAAN JUMLAH INDEX YANG MEMILIKI NILAI DARI ARRAY dataToSend. (MENCEGAH PENGGUNA MENGAKSES KE HALAMAN CART ORDER TANPA MENAMBAHKAN PESANAN KE CART-NYA).
            let count = 0;
            for (let key in dataToSend) { // LAKUKAN PERULANGAN ISI DARI dataToSend.
                if (dataToSend.hasOwnProperty(key)) { // MEMERIKSA APAKAH dataToSend MEMILIKI INDEX DARI PROPERTI YANG DISIMPAN PADA key.
                    const value = dataToSend[key]; // MENGAKSES NILAI DARI dataToSend DENGAN MENGGUNAKAN NAMA INDEX YANG DISIMPAN DALAM key DAN SIMPAN KE VALUE. 
                    if (value !== null && value !== undefined && value !== '') { // CEK APAKAH VALUE DARI INDEX PADA dataToSend, SESUAI INDEX PADA key YANG SEDANG DI AKSES MEMILIKI NILAI / MEMENUHI KONDISI YANG DISEBUTKAN (TIDAK NULL, TIDAK UNDIFINED, DAN TIDAK EMPTY).
                        count++; // JIKA MEMENUHI SYARAT (TIDAK NULL, TIDAK UNDIFINED, DAN TIDAK EMPTY) MAKA TAMBAHKAN NILAI 1 PADA COUNT. (uLANGI LAGI HINGGA SELURUH INDEX DIDALAM dataToSend DI PERIKSA).
                    }
                }
            }
            if(count <= 6){ // DEAULT INDEX YANG MEMILIKI NILAI ADA 6 (SEDANGKAN INDEX YANG HARUS DI INPUTAN PENGGUNA UNTUK DITAMBAH KE CART ADA 5) JIKA COUNT JUMLAHNYA TETAP 6 MAKA PENGGUNA BELUM MENAMBAHKAN PESANAN KE CART.
                swal.fire({ // TAMPILKAN ALERT
                    title: "Sorry",
                    text: "There are no orders in your cart yet!",
                    icon: "warning"
                })
            }else{ // JIKA COUNT BERNILAI LEBIH DARI 6, MAKA JALANKAN PROSES KE CERT ORDER.
                $.ajax({
                    url: base_url+"/CartController/cartProses", // POST data to this controller function and run this function.
                    type: 'POST',
                    data: dataToSend,
                    cache: false,
                    success: function(response) {
                        // SETELAH BERHASIL, ALIHKAN KE HALAMAN CART (ORDER SERVER).
                        window.location.href = base_url+'/CartController/cart'; 
                    }
                });
            }
        });
    // ====================================================================================================
    
// ========================================================================================================

// ADMIN ==================================================================================================
    // ON ATAU OFF POWER STATUS ===========================================================================
        $(document).on('change','#statusServer',function(){
            dataToSend = {idUserServer : id_user};
        
            if (document.getElementById('statusServer').checked) { 
                // KONDISI JIKA CHECK BOX DI CHECKED ATAU STATUS POWER DI UBAH KE ON, JALANKAN ALERT UNTUK KONFIRMASI MELANJUTKAN ATAU TIDAK.     
                swal.fire({
                    title: "Are you sure?",
                    text: "You want to turn ON this server!",
                    icon: "warning",													
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, turn ON!'
                })
                .then((result) => {
                    // JIKA PENGGUNA MENGKONFIRMASI UNTUK MELANJUTKAN, LAKUKAN PROSES AJAX UNTUK MERUBAH STATUS POWER KE ON.
                    if (result.isConfirmed) {
                        $.ajax({
                            url: base_url+"/serverControler/turnOnServer",
                            type: 'POST',
                            data: dataToSend,
                            cache: false,
                            success: function(response) {
                                getDataServer(); // JALANKAN ULANG getDataServer, UNTUK MENAMPILKAN DATA TERBARU.
                                swal.fire({title: "Success.", text: "successfully set to online.", icon: "success"})
                            }
                        });
                    }
                    // JIKA PENGGUNA MEBATALKAN, ATUR CHECKBOX KE POSISI UNCHECKED.
                    if(result.isDismissed){
                        // MERUBAH ATRIBUT CHECKBOX.
                        this.setAttribute("checked", ""); // UNTUK INTERNET EXPLORER (MERUBAH ATRIBUT CHECKED MENJADI KOSONG).
                        this.removeAttribute("checked"); // UNTUK BROWSER LAINNYA (MENGHAPUS ATRIBUT CHECKED).
                        this.checked = false; // UBAH CHECKED KE FALSE PADA ELEMENT DENGAN ID statusServer.
                    }
                });                
            } else {
                // KONDISI JIKA CHECK BOX DI CHECKED ATAU STATUS POWER DI UBAH KE OFF, JALANKAN ALERT UNTUK KONFIRMASI MELANJUTKAN ATAU TIDAK.
                swal.fire({
                    title: "Are you sure?",
                    text: "You want to turn OFF this server!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, turn OFF!'
                })
                .then((result) => {
                    // JIKA PENGGUNA MENGKONFIRMASI UNTUK MELANJUTKAN, LAKUKAN PROSES AJAX UNTUK MERUBAH STATUS POWER KE OFF.
                    if (result.isConfirmed) {
                        $.ajax({
                            url: base_url+"/serverControler/turnOffServer",
                            type: 'POST',
                            data: dataToSend,
                            cache: false,
                            success: function(response) {
                                getDataServer(); // JALANKAN ULANG getDataServer, UNTUK MENAMPILKAN DATA TERBARU.
                                swal.fire({title: "Success.", text: "successfully set to offline.", icon: "success"})
                            }
                        });
                    }
                    // JIKA PENGGUNA MEBATALKAN, ATUR CHECKBOX KE POSISI CHECKED.
                    if(result.isDismissed){
                        // MERUBAH ATRIBUT CHECKBOX.
                        this.setAttribute("checked", "checked"); // UNTUK INTERNET EXPLORER (MERUBAH ATRIBUT CHECKED MENJADI CHECKED).
                        this.removeAttribute("checked"); // For other browsers
                        this.checked = true; 
                    }
                });
            }
        });
    // ====================================================================================================

    // DATA CENTER ========================================================================================
        // TAMBAH NILAI ===================================================================================
            $(document).on('click','#mineBtnDC',function(){
                let reduceDC = parseInt(inputNilaiDC.value); // AMBIL INPUT DAN KONVERSI KE INTEGER. 
                let index = limitInputValue.indexOf(reduceDC); // CARI NILAI DALAM INDEX ARRAY.
                if (index > 0) { // CEK APAKAH INDEX LEBIH BESAR DARI 0
                    inputNilaiDC.value = limitInputValue[index - 1]; // KURANGI SATU INDEX DARI POSISI DITEMUKANNYA INDEX SESUAI INPUT PENGGUNA DALAM ARRAY.
                } // KONDISI JIKA INDEX MASIH DI INDEX KE-.. SELAIN INDEX KE-0, SEHINGGA MASIH BISA DIKURANGI. NAMUN JIKA SUDAH DI INDEX KE-0, MAKA SUDAH TIDAK DAPAT DIKURANGI.
            });
        // ================================================================================================
        // KURANGI NILAI ==================================================================================
            $(document).on('click','#plusBtnDC',function(){
                let addDC = parseInt(inputNilaiDC.value); // AMBIL INPUT DAN KONVERSI KE INTEGER.
                let index = limitInputValue.indexOf(addDC); // CARI NILAI DALAM INDEX ARRAY.
                if (index < limitInputValue.length - 1) { // CEK APAKAH INDEX KURANG DARI PANJANG ARRAY DIKURANGI 1 INDEX, TUJUANNYA MEMASTIKAN INDEX DIPILIH BUKAN INDEX TERAKHIR DALAN ARRAY.
                    inputNilaiDC.value = limitInputValue[index + 1]; // TAMBAHKAN 1 INDEX DARI ARRAY, TAMPUNG KEDALAM VARIABEL.
                } // KONDISI JIKA SUDAH DI AKHIR INDEX DALAM ARRAY, MAKA TIDAK DAPAT DITAMBAH LAGI.
            });
        // ================================================================================================
        // TOMBOL EDIT ADMIN PADA VIEW SERVER =============================================================            
            $(document).on('click','#checkDCBtnAdmin',function(){
                if(inputNilaiDC.value == dcSizeNow){
                    swal.fire({
                        position: 'center',
                        // title: "succeed",
                        text: "Please change the value before update",
                        customClass: {container: 'my-custom-dialog-1'},
                        showConfirmButton: false,
                        timer: 3000,
                    })                
                }else{
                    swal.fire({
                        title: "Enter the authority code",
                        html:   '<div class="row">'+
                                    '<div class="col-12">'+
                                        '<input type="password" id="dcAuthCode" class="input-auth-code dc" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="dcAuthCode" class="input-auth-code dc" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="dcAuthCode" class="input-auth-code dc" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="dcAuthCode" class="input-auth-code dc" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="dcAuthCode" class="input-auth-code dc" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="dcAuthCode" class="input-auth-code dc" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="dcAuthCode" class="input-auth-code dc" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="dcAuthCode" class="input-auth-code dc" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                    '</div>'+
                                '</div>',

                        // PROSES VALIDASI INPUT ANGKA.
                        inputValidator: () => {                             
                            // KUMPULKAN SEMUA ANGKA YANG DI MASUKAN ADMIN.
                            const inputFields = document.querySelectorAll('#dcAuthCode');
                            let inputValue = ''; // VARIABLE PENAMPUNG KODE OTENTIKASI.
                            for (let i = 0; i < inputFields.length; i++) { // PERULANGAN UNTUK MENGAMBIL SETIAP ANGKA DI SETIAP INPUT BOX & SUSUN SECARA BERURUT.
                                const input = inputFields[i]; 
                                inputValue += input.value; // TAMPUNG ANGKA ANGKA YANG SUDAH DIURUT KEDALAM VARIABLE inputValue.
                            }
                            
                            if (/^\d{8}$/.test(inputValue)) { // VALIDASI JUMLAH ANGKA YANG DIMASUKAN (HARUS 8 DIGIT).     
                            return inputValue; // JIKA BENAR KEMBLAIKAN NILAI.
                            } else {                            
                            return 'Please enter 8 digits'; // JIKA KURANG DARI 8 DIGIT, TAMPILKAN ERROR KEMBALIAN.
                            }
                        },
                        customClass: {
                            container: 'my-input-class' // TAMBAHKAN CUSTOME CLASS PADA SWEETALERT.       
                        },
                        showCancelButton: true,
                        confirmButtonText: 'OK',
                        showLoaderOnConfirm: true,
                        // PROSES PENCOCOKAN KODE OTENTIKASI YANG DIINPUT ADMIN.
                        preConfirm: () => {                            
                            const inputFields = document.querySelectorAll('#dcAuthCode');
                            let inputValue = '';
                            for (let i = 0; i < inputFields.length; i++) {
                            const input = inputFields[i];
                            inputValue += input.value;
                            }                        
                            return inputValue;
                        }
                    }).then((inputAuthCodeDC) => {   
                        if (inputAuthCodeDC.isConfirmed) {
                            if(inputAuthCodeDC.value == defaultAuthorityCode){ // Condition if the admin enters the correct code 
                                var updateSize = {'idUserServer' : id_user, 'size' : inputNilaiDC.value, 'item': 'DC'};
                                $.ajax({ // UPDATE SIZE.
                                    url: base_url+"/serverControler/updateServerCapacitySize",
                                    type: 'POST',
                                    data: updateSize,
                                    success: function(response) {
                                        swal.fire({
                                            position: 'center',
                                            title: "succeed",
                                            icon: "success",
                                            text: "The CPU has been successfully updated",
                                            customClass: {container: 'my-custom-dialog-1'},
                                            showConfirmButton: false,
                                            timer: 3000,
                                        });
                                    }
                                });
                            }else if(inputAuthCodeDC.value != defaultAuthorityCode){ // ALERT JIKA SALAH MEMASUKAN KODE OTORITAS.
                                swal.fire({
                                    position: 'center',
                                    title: "Wrong Code",
                                    icon: "error",
                                    text: "The authority code you entered is incorrect",
                                    customClass: {container: 'my-custom-dialog-1'},
                                    showConfirmButton: false,
                                    timer: 3000,
                                });
                            }
                        }else{
                            inputNilaiDC.value = dcSizeNow; // KEMBALIKAN NILAI KE AWAL, ATAU NILAI TERAKHIR DI UPDATE.
                        }
                    });
                    document.getElementById('dcAuthCode').focus(); // SET FOKUS KURSOR KE ELEMENT INPUT TEXT PERTAMA PADA ID YANG DITUJU. 
                    autoMoveCursorInputAuthKode(); // MENJALANKAN FUNGSI PINDAH FOKUS KURSOR SECARA OTOMATIS, SETELAH INPUT TEXT MEMENUHI KONDISI.
                }
            });
        // ================================================================================================
    // ====================================================================================================

    // WINDOWS LICENSE ====================================================================================
        // TAMBAH NILAI ===================================================================================
            $(document).on('click','#mineBtnWL',function(){    
                let reduceWL = parseInt(inputNilaiWL.value); // AMBIL INPUT DAN KONVERSI KE INTEGER. 
                let index = limitInputValue.indexOf(reduceWL); // CARI NILAI DALAM INDEX ARRAY.
                if (index > 0) { // CEK APAKAH INDEX LEBIH BESAR DARI 0
                    inputNilaiWL.value = limitInputValue[index - 1]; // KURANGI SATU INDEX DARI POSISI DITEMUKANNYA INDEX SESUAI INPUT PENGGUNA DALAM ARRAY.
                } // KONDISI JIKA INDEX MASIH DI INDEX KE-.. SELAIN INDEX KE-0, SEHINGGA MASIH BISA DIKURANGI. NAMUN JIKA SUDAH DI INDEX KE-0, MAKA SUDAH TIDAK DAPAT DIKURANGI.
            });
        // ================================================================================================
        // KURANGI NILAI ==================================================================================
            $(document).on('click','#plusBtnWL',function(){
                let addWL = parseInt(inputNilaiWL.value); // AMBIL INPUT DAN KONVERSI KE INTEGER.
                let index = limitInputValue.indexOf(addWL); // CARI NILAI DALAM INDEX ARRAY.
                if (index < limitInputValue.length - 1) { // CEK APAKAH INDEX KURANG DARI PANJANG ARRAY DIKURANGI 1 INDEX, TUJUANNYA MEMASTIKAN INDEX DIPILIH BUKAN INDEX TERAKHIR DALAN ARRAY.
                    inputNilaiWL.value = limitInputValue[index + 1]; // TAMBAHKAN 1 INDEX DARI ARRAY, TAMPUNG KEDALAM VARIABEL.
                } // KONDISI JIKA SUDAH DI AKHIR INDEX DALAM ARRAY, MAKA TIDAK DAPAT DITAMBAH LAGI.
            });
        // ================================================================================================
        // TOMBOL EDIT ADMIN PADA VIEW SERVER =============================================================
            $(document).on('click','#checkWLBtnAdmin',function(){
                if(inputNilaiWL.value == wlSizeNow){
                    swal.fire({
                        position: 'center',
                        // title: "succeed",
                        text: "Please change the value before update",
                        customClass: {container: 'my-custom-dialog-1'},
                        showConfirmButton: false,
                        timer: 3000,
                    })                
                }else{
                    swal.fire({
                        title: "Enter the authority code",
                        html:   '<div class="row">'+
                                    '<div class="col-12">'+
                                        '<input type="password" id="wlAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="wlAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="wlAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="wlAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="wlAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="wlAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="wlAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="wlAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                    '</div>'+
                                '</div>',

                        // PROSES VALIDASI INPUT ANGKA.                        
                        inputValidator: () => { 
                            // KUMPULKAN SEMUA ANGKA YANG DI MASUKAN ADMIN.
                            const inputFields = document.querySelectorAll('#wlAuthCode');
                            let inputValue = ''; // VARIABLE PENAMPUNG KODE OTENTIKASI.
                            for (let i = 0; i < inputFields.length; i++) { // PERULANGAN UNTUK MENGAMBIL SETIAP ANGKA DI SETIAP INPUT BOX & SUSUN SECARA BERURUT.
                                const input = inputFields[i]; 
                                inputValue += input.value; // TAMPUNG ANGKA ANGKA YANG SUDAH DIURUT KEDALAM VARIABLE inputValue.
                            }
                            if (/^\d{8}$/.test(inputValue)) { // VALIDASI JUMLAH ANGKA YANG DIMASUKAN (HARUS 8 DIGIT).     
                                return inputValue; // JIKA BENAR KEMBALIKAN NILAI.
                            } else {                            
                                return 'Please enter 8 digits'; // JIKA KURANG DARI 8 DIGIT, TAMPILKAN ERROR KEMBALIAN.
                            }
                        },
                        customClass: {
                            container: 'my-input-class' // TAMBAHKAN CUSTOME CLASS PADA SWEETALERT.       
                        },
                        showCancelButton: true,
                        confirmButtonText: 'OK',
                        showLoaderOnConfirm: true,
                        // PROSES PENCOCOKAN KODE OTENTIKASI YANG DIINPUT ADMIN.
                        preConfirm: () => {
                            // KUMPULKAN SEMUA ANGKA YANG DI MASUKAN ADMIN.
                            const inputFields = document.querySelectorAll('#wlAuthCode');
                            let inputValue = '';  // VARIABLE PENAMPUNG KODE OTENTIKASI.
                            for (let i = 0; i < inputFields.length; i++) { // PERULANGAN UNTUK MENGAMBIL SETIAP ANGKA DI SETIAP INPUT BOX & SUSUN SECARA BERURUT.
                            const input = inputFields[i]; // SUSUN SETIAP ANGKA MENJADI SATU STRING.
                            inputValue += input.value; // TAMPUNG ANGKA ANGKA YANG SUDAH DIURUT KEDALAM VARIABLE inputValue.
                            }
                            return inputValue; // KEMBALIKAN NILAI
                        }
                    }).then((inputAuthCodeWL) => {
                        if (inputAuthCodeWL.isConfirmed) {
                            if(inputAuthCodeWL.value == defaultAuthorityCode){ // KONDISI KODE OTORITAS BENAR. 
                                var updateSize = {'idUserServer' : id_user, 'size' : inputNilaiWL.value, 'item': 'WL'};
                                $.ajax({ // UPDATE SIZE.
                                    url: base_url+"/serverControler/updateServerCapacitySize",
                                    type: 'POST',
                                    data: updateSize,
                                    success: function(response) {
                                        swal.fire({
                                            position: 'center',
                                            title: "succeed",
                                            icon: "success",
                                            text: "The CPU has been successfully updated",
                                            customClass: {container: 'my-custom-dialog-1'},
                                            showConfirmButton: false,
                                            timer: 3000,
                                        })
                                        // JALANKAN FUNGSI UNTUK REFRESH DATA PADA VIEW SERVER.                
                                    }
                                });
                            }else if(inputAuthCodeWL.value != defaultAuthorityCode){ // ALERT JIKA SALAH MEMASUKAN KODE OTORITAS.
                                swal.fire({
                                    position: 'center',
                                    title: "Wrong Code",
                                    icon: "error",
                                    text: "The authority code you entered is incorrect",
                                    customClass: {container: 'my-custom-dialog-1'},
                                    showConfirmButton: false,
                                    timer: 3000,
                                })    
                            }
                        }else{
                            inputNilaiWL.value = wlSizeNow; // KEMBALIKAN NILAI KE AWAL, ATAU NILAI TERAKHIR DI UPDATE.
                        }
                    });
                    document.getElementById('wlAuthCode').focus(); // SET FOKUS KURSOR KE ELEMENT INPUT TEXT PERTAMA PADA ID YANG DITUJU. 
                    autoMoveCursorInputAuthKode(); // MENJALANKAN FUNGSI PINDAH FOKUS KURSOR SECARA OTOMATIS, SETELAH INPUT TEXT MEMENUHI KONDISI.
                }
            });
        // ================================================================================================
    // ====================================================================================================

    // CPU ================================================================================================
        // TAMBAH NILAI ===================================================================================
            $(document).on('click','#mineBtnCPU',function(){    
                let reduceCPU = parseInt(inputNilaiCPU.value); // AMBIL INPUT DAN KONVERSI KE INTEGER.
                let index = limitInputCPUValue.indexOf(reduceCPU); // CARI NILAI DALAM INDEX ARRAY.
                if (index > 0) { // CEK APAKAH INDEX LEBIH BESAR DARI 0
                    inputNilaiCPU.value = limitInputCPUValue[index - 1]; // KURANGI SATU INDEX DARI POSISI DITEMUKANNYA INDEX SESUAI INPUT PENGGUNA DALAM ARRAY.
                } // KONDISI JIKA INDEX MASIH DI INDEX KE-.. SELAIN INDEX KE-0, SEHINGGA MASIH BISA DIKURANGI. NAMUN JIKA SUDAH DI INDEX KE-0, MAKA SUDAH TIDAK DAPAT DIKURANGI.
            });
        // ================================================================================================
        // KURANGI NILAI ==================================================================================
            $(document).on('click','#plusBtnCPU',function(){
                let addCPU = parseInt(inputNilaiCPU.value); // AMBIL INPUT DAN KONVERSI KE INTEGER.
                let index = limitInputCPUValue.indexOf(addCPU); // CARI NILAI DALAM INDEX ARRAY.
                if (index < limitInputCPUValue.length - 1) { // CEK APAKAH INDEX KURANG DARI PANJANG ARRAY DIKURANGI 1 INDEX, TUJUANNYA MEMASTIKAN INDEX DIPILIH BUKAN INDEX TERAKHIR DALAN ARRAY.
                    inputNilaiCPU.value = limitInputCPUValue[index + 1]; // TAMBAHKAN 1 INDEX DARI ARRAY, TAMPUNG KEDALAM VARIABEL.
                } // KONDISI JIKA SUDAH DI AKHIR INDEX DALAM ARRAY, MAKA TIDAK DAPAT DITAMBAH LAGI.
            });
        // ================================================================================================
        // TOMBOL EDIT ADMIN PADA VIEW SERVER =============================================================
            $(document).on('click','#checkCPUBtnAdmin',function(){
                if(inputNilaiCPU.value == cpuSizeNow){
                    swal.fire({
                        position: 'center',
                        // title: "succeed",
                        text: "Please change the value before update",
                        customClass: {container: 'my-custom-dialog-1'},
                        showConfirmButton: false,
                        timer: 3000,
                    })                
                }else{
                    swal.fire({
                        title: "Enter the authority code",
                        html:   '<div class="row">'+
                                    '<div class="col-12">'+
                                        '<input type="password" id="CPUAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="CPUAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="CPUAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="CPUAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="CPUAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="CPUAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="CPUAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="CPUAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                    '</div>'+
                                '</div>',
                        // PROSES VALIDASI INPUT ANGKA.
                        inputValidator: () => {
                            // KUMPULKAN SEMUA ANGKA YANG DI MASUKAN ADMIN.
                            const inputFields = document.querySelectorAll('#CPUAuthCode');
                            let inputValue = ''; // VARIABLE PENAMPUNG KODE OTENTIKASI.
                            for (let i = 0; i < inputFields.length; i++) { // PERULANGAN UNTUK MENGAMBIL SETIAP ANGKA DI SETIAP INPUT BOX & SUSUN SECARA BERURUT.
                            const input = inputFields[i]; // SUSUN SETIAP ANGKA MENJADI SATU STRING.
                            inputValue += input.value; // TAMPUNG ANGKA ANGKA YANG SUDAH DIURUT KEDALAM VARIABLE inputValue.
                            }
                            if (/^\d{8}$/.test(inputValue)) { // VALIDASI JUMLAH ANGKA YANG DIMASUKAN (HARUS 8 DIGIT).
                                return inputValue; // JIKA BENAR KEMBALIKAN NILAI.
                            } else {
                                return 'Please enter 8 digits'; // JIKA KURANG DARI 8 DIGIT, TAMPILKAN ERROR KEMBALIAN.
                            }
                        },
                        customClass: {
                            container: 'my-input-class'            
                        },
                        showCancelButton: true,
                        confirmButtonText: 'OK',
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            // KUMPULKAN SEMUA ANGKA YANG DI MASUKAN ADMIN.
                            const inputFields = document.querySelectorAll('#CPUAuthCode');
                            let inputValue = '';  // VARIABLE PENAMPUNG KODE OTENTIKASI.
                            for (let i = 0; i < inputFields.length; i++) { // PERULANGAN UNTUK MENGAMBIL SETIAP ANGKA DI SETIAP INPUT BOX & SUSUN SECARA BERURUT.
                            const input = inputFields[i]; // SUSUN SETIAP ANGKA MENJADI SATU STRING.
                            inputValue += input.value; // TAMPUNG ANGKA ANGKA YANG SUDAH DIURUT KEDALAM VARIABLE inputValue.
                            }                        
                            return inputValue; // KEMBALIKAN NILAI
                        }
                    }).then((inputAuthCodeCpu) => {
                        if (inputAuthCodeCpu.isConfirmed) {
                            if(inputAuthCodeCpu.value == defaultAuthorityCode){ // Condition if the admin enters the correct code 
                                var updateSize = {'idUserServer' : id_user, 'size' : inputNilaiCPU.value, 'item': 'CPU'};
                                $.ajax({ // Update CPU.
                                    url: base_url+"/serverControler/updateServerCapacitySize",
                                    type: 'POST',
                                    data: updateSize,
                                    success: function(response) {
                                        swal.fire({
                                            position: 'center',
                                            title: "succeed",
                                            icon: "success",
                                            text: "The CPU has been successfully updated",
                                            customClass: {container: 'my-custom-dialog-1'},
                                            showConfirmButton: false,
                                            timer: 3000,
                                        })                
                                    }
                                });
                            }else if(inputAuthCodeCpu.value != defaultAuthorityCode){ // Condition if the admin enters the wrong code
                                swal.fire({
                                    position: 'center',
                                    title: "Wrong Code",
                                    icon: "error",
                                    text: "The authority code you entered is incorrect",
                                    customClass: {container: 'my-custom-dialog-1'},
                                    showConfirmButton: false,
                                    timer: 3000,
                                })    
                            }
                        }else{
                            inputNilaiCPU.value = cpuSizeNow; // KEMBALIKAN NILAI KE AWAL, ATAU NILAI TERAKHIR DI UPDATE.
                        }
                    });
                    document.getElementById('CPUAuthCode').focus(); // SET FOKUS KURSOR KE ELEMENT INPUT TEXT PERTAMA PADA ID YANG DITUJU. 
                    autoMoveCursorInputAuthKode(); // MENJALANKAN FUNGSI PINDAH FOKUS KURSOR SECARA OTOMATIS, SETELAH INPUT TEXT MEMENUHI KONDISI.
                }
            });
        // ================================================================================================
    // ====================================================================================================

    // MEMORY =============================================================================================
        // TAMBAH NILAI ===================================================================================
            $(document).on('click','#mineBtnMemory',function(){    
                let reduceMemory = parseInt(inputNilaiMemory.value); // AMBIL INPUT DAN KONVERSI KE INTEGER.
                let index = limitInputMemoryValue.indexOf(reduceMemory); // CARI NILAI DALAM INDEX ARRAY.
                if (index > 0) { // CEK APAKAH INDEX LEBIH BESAR DARI 0
                    inputNilaiMemory.value = limitInputMemoryValue[index - 1]; // KURANGI SATU INDEX DARI POSISI DITEMUKANNYA INDEX SESUAI INPUT PENGGUNA DALAM ARRAY.
                } // KONDISI JIKA INDEX MASIH DI INDEX KE-.. SELAIN INDEX KE-0, SEHINGGA MASIH BISA DIKURANGI. NAMUN JIKA SUDAH DI INDEX KE-0, MAKA SUDAH TIDAK DAPAT DIKURANGI.
            });
        // ================================================================================================
        // KURANGI NILAI ==================================================================================
            $(document).on('click','#plusBtnMemory',function(){
                let addMemory = parseInt(inputNilaiMemory.value); // AMBIL INPUT DAN KONVERSI KE INTEGER.
                let index = limitInputMemoryValue.indexOf(addMemory); // CARI NILAI DALAM INDEX ARRAY.
                if (index < limitInputMemoryValue.length - 1) { // CEK APAKAH INDEX KURANG DARI PANJANG ARRAY DIKURANGI 1 INDEX, TUJUANNYA MEMASTIKAN INDEX DIPILIH BUKAN INDEX TERAKHIR DALAN ARRAY.
                    inputNilaiMemory.value = limitInputMemoryValue[index + 1]; // TAMBAHKAN 1 INDEX DARI ARRAY, TAMPUNG KEDALAM VARIABEL.
                } // KONDISI JIKA SUDAH DI AKHIR INDEX DALAM ARRAY, MAKA TIDAK DAPAT DITAMBAH LAGI.
            });
        // ================================================================================================
        // TOMBOL EDIT ADMIN PADA VIEW SERVER =============================================================
             $(document).on('click','#checkMemoryBtnAdmin',function(){
                if(inputNilaiMemory.value == memorySizeNow){
                    swal.fire({
                        position: 'center',
                        // title: "succeed",
                        text: "Please change the value before update",
                        customClass: {container: 'my-custom-dialog-1'},
                        showConfirmButton: false,
                        timer: 3000,
                    })                
                }else{
                    swal.fire({
                        title: "Enter the authority code",
                        html:   '<div class="row">'+
                                    '<div class="col-12">'+
                                        '<input type="password" id="memoryAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="memoryAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="memoryAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="memoryAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="memoryAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="memoryAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="memoryAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="memoryAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                    '</div>'+
                                '</div>',
                        inputValidator: () => {
                            // Collect the values from all input fields
                            const inputFields = document.querySelectorAll('#memoryAuthCode');
                            let inputValue = '';
                            for (let i = 0; i < inputFields.length; i++) {
                            const input = inputFields[i];
                            inputValue += input.value;
                            }

                            // Validate the input value
                            if (/^\d{8}$/.test(inputValue)) {
                            // Return the input value if it is valid
                            return inputValue;
                            } else {
                            // Show error message if input value is invalid
                            return 'Please enter 8 digits';
                            }
                        },
                        customClass: {
                            container: 'my-input-class'            
                        },
                        showCancelButton: true,
                        confirmButtonText: 'OK',
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            // Collect the values from all input fields
                            const inputFields = document.querySelectorAll('#memoryAuthCode');
                            let inputValue = '';
                            for (let i = 0; i < inputFields.length; i++) {
                            const input = inputFields[i];
                            inputValue += input.value;
                            }
                        
                            // Return the input value if it is valid
                            return inputValue;
                        }
                    }).then((inputAuthCodeMemory) => {
                        if (inputAuthCodeMemory.isConfirmed) {                
                            if(inputAuthCodeMemory.value == defaultAuthorityCode){ // Condition if the admin enters the correct code 
                                var updateSize = {'idUserServer' : id_user, 'size' : inputNilaiMemory.value, 'item': 'MEMORY'};
                                $.ajax({ // Update memory size.
                                    url: base_url+"/serverControler/updateServerCapacitySize",
                                    type: 'POST',
                                    data: updateSize,
                                    success: function(response) {
                                        swal.fire({
                                            position: 'center',
                                            title: "succeed",
                                            icon: "success",
                                            text: "The memory has been updated successfully",
                                            customClass: {container: 'my-custom-dialog-1'},
                                            showConfirmButton: false,
                                            timer: 3000,
                                        })                
                                    }
                                });
                            }else if(inputAuthCodeMemory.value != defaultAuthorityCode){ // Condition if the admin enters the wrong code
                                swal.fire({
                                    position: 'center',
                                    title: "Wrong Code",
                                    icon: "error",
                                    text: "The authority code you entered is incorrect",
                                    customClass: {container: 'my-custom-dialog-1'},
                                    showConfirmButton: false,
                                    timer: 3000,
                                })    
                            }
                        }else{
                            inputNilaiMemory.value = memorySizeNow; // KEMBALIKAN NILAI KE AWAL, ATAU NILAI TERAKHIR DI UPDATE.
                        }
                    });
                    document.getElementById('memoryAuthCode').focus(); // SET FOKUS KURSOR KE ELEMENT INPUT TEXT PERTAMA PADA ID YANG DITUJU. 
                    autoMoveCursorInputAuthKode(); // MENJALANKAN FUNGSI PINDAH FOKUS KURSOR SECARA OTOMATIS, SETELAH INPUT TEXT MEMENUHI KONDISI.
                }
            });
        // ================================================================================================
    // ====================================================================================================

    // STORAGE ============================================================================================
        // TAMBAH NILAI ===================================================================================
            $(document).on('click','#mineBtnStorage',function(){    
                let reduceSSD = parseInt(inputNilaiSDD.value); // AMBIL INPUT DAN KONVERSI KE INTEGER. 
                let index = limitInputStorageValue.indexOf(reduceSSD); // CARI NILAI DALAM INDEX ARRAY.
                if (index > 0) { // CEK APAKAH INDEX LEBIH BESAR DARI 0
                    inputNilaiSDD.value = limitInputStorageValue[index - 1]; // KURANGI SATU INDEX DARI POSISI DITEMUKANNYA INDEX SESUAI INPUT PENGGUNA DALAM ARRAY.
                } // KONDISI JIKA INDEX MASIH DI INDEX KE-.. SELAIN INDEX KE-0, SEHINGGA MASIH BISA DIKURANGI. NAMUN JIKA SUDAH DI INDEX KE-0, MAKA SUDAH TIDAK DAPAT DIKURANGI.
            });
        // ================================================================================================
        // KURANGI NILAI ==================================================================================
            $(document).on('click','#plusBtnStorage',function(){
                let addSSD = parseInt(inputNilaiSDD.value); // AMBIL INPUT DAN KONVERSI KE INTEGER.
                let index = limitInputStorageValue.indexOf(addSSD); // CARI NILAI DALAM INDEX ARRAY.
                if (index < limitInputStorageValue.length - 1) { // CEK APAKAH INDEX KURANG DARI PANJANG ARRAY DIKURANGI 1 INDEX, TUJUANNYA MEMASTIKAN INDEX DIPILIH BUKAN INDEX TERAKHIR DALAN ARRAY.
                    inputNilaiSDD.value = limitInputStorageValue[index + 1]; // TAMBAHKAN 1 INDEX DARI ARRAY, TAMPUNG KEDALAM VARIABEL.
                } // KONDISI JIKA SUDAH DI AKHIR INDEX DALAM ARRAY, MAKA TIDAK DAPAT DITAMBAH LAGI.
            });
        // ================================================================================================
        // TOMBOL EDIT ADMIN PADA VIEW SERVER =============================================================
            $(document).on('click','#checkStorageBtnAdmin',function(){
                if(inputNilaiSDD.value == storageSizeNow){
                    swal.fire({
                        position: 'center',
                        // title: "succeed",
                        text: "Please change the value before update",
                        customClass: {container: 'my-custom-dialog-1'},
                        showConfirmButton: false,
                        timer: 3000,
                    })                
                }else{
                    swal.fire({
                        title: "Enter the authority code",
                        html:   '<div class="row">'+
                                    '<div class="col-12">'+
                                        '<input type="password" id="sddAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="sddAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="sddAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="sddAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="sddAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="sddAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="sddAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                        '<input type="password" id="sddAuthCode" class="input-auth-code" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                                    '</div>'+
                                '</div>',

                        // PROSES VALIDASI INPUT ANGKA.                        
                        inputValidator: () => { 
                            // KUMPULKAN SEMUA ANGKA YANG DI MASUKAN ADMIN.
                            const inputFields = document.querySelectorAll('#sddAuthCode');
                            let inputValue = ''; // VARIABLE PENAMPUNG KODE OTENTIKASI.
                            for (let i = 0; i < inputFields.length; i++) { // PERULANGAN UNTUK MENGAMBIL SETIAP ANGKA DI SETIAP INPUT BOX & SUSUN SECARA BERURUT.
                                const input = inputFields[i]; 
                                inputValue += input.value; // TAMPUNG ANGKA ANGKA YANG SUDAH DIURUT KEDALAM VARIABLE inputValue.
                            }
                            if (/^\d{8}$/.test(inputValue)) { // VALIDASI JUMLAH ANGKA YANG DIMASUKAN (HARUS 8 DIGIT).     
                                return inputValue; // JIKA BENAR KEMBALIKAN NILAI.
                            } else {                            
                                return 'Please enter 8 digits'; // JIKA KURANG DARI 8 DIGIT, TAMPILKAN ERROR KEMBALIAN.
                            }
                        },
                        customClass: {
                            container: 'my-input-class' // TAMBAHKAN CUSTOME CLASS PADA SWEETALERT.       
                        },
                        showCancelButton: true,
                        confirmButtonText: 'OK',
                        showLoaderOnConfirm: true,
                        // PROSES PENCOCOKAN KODE OTENTIKASI YANG DIINPUT ADMIN.
                        preConfirm: () => {
                            // KUMPULKAN SEMUA ANGKA YANG DI MASUKAN ADMIN.
                            const inputFields = document.querySelectorAll('#sddAuthCode');
                            let inputValue = '';  // VARIABLE PENAMPUNG KODE OTENTIKASI.
                            for (let i = 0; i < inputFields.length; i++) { // PERULANGAN UNTUK MENGAMBIL SETIAP ANGKA DI SETIAP INPUT BOX & SUSUN SECARA BERURUT.
                            const input = inputFields[i]; // SUSUN SETIAP ANGKA MENJADI SATU STRING.
                            inputValue += input.value; // TAMPUNG ANGKA ANGKA YANG SUDAH DIURUT KEDALAM VARIABLE inputValue.
                            }
                            return inputValue; // KEMBALIKAN NILAI
                        }
                    }).then((inputAuthCodeSDD) => {
                        if (inputAuthCodeSDD.isConfirmed) {
                            if(inputAuthCodeSDD.value == defaultAuthorityCode){ // KONDISI KODE OTORITAS BENAR. 
                                var updateSize = {'idUserServer' : id_user, 'size' : inputNilaiSDD.value, 'item': 'SDD'};
                                $.ajax({ // UPDATE SIZE.
                                    url: base_url+"/serverControler/updateServerCapacitySize",
                                    type: 'POST',
                                    data: updateSize,
                                    success: function(response) {
                                        swal.fire({
                                            position: 'center',
                                            title: "succeed",
                                            icon: "success",
                                            text: "The CPU has been successfully updated",
                                            customClass: {container: 'my-custom-dialog-1'},
                                            showConfirmButton: false,
                                            timer: 3000,
                                        })                                                   
                                    }
                                });
                            }else if(inputAuthCodeSDD.value != defaultAuthorityCode){ // ALERT JIKA SALAH MEMASUKAN KODE OTORITAS.
                                swal.fire({
                                    position: 'center',
                                    title: "Wrong Code",
                                    icon: "error",
                                    text: "The authority code you entered is incorrect",
                                    customClass: {container: 'my-custom-dialog-1'},
                                    showConfirmButton: false,
                                    timer: 3000,
                                })                                
                            }
                        }else{
                            inputNilaiSDD.value = storageSizeNow;                            
                        }
                    });
                    document.getElementById('sddAuthCode').focus(); // SET FOKUS KURSOR KE ELEMENT INPUT TEXT PERTAMA PADA ID YANG DITUJU. 
                    autoMoveCursorInputAuthKode(); // MENJALANKAN FUNGSI PINDAH FOKUS KURSOR SECARA OTOMATIS, SETELAH INPUT TEXT MEMENUHI KONDISI.
                }
            });
        // ================================================================================================
    // ==================================================================================================== 
    // OTOMATIS MEMINDAHKAN KURSOR UNTUK INPUT TEXT AUTHORITY CODE ========================================
        function autoMoveCursorInputAuthKode(){
            var inputFields = document.getElementsByClassName('input-auth-code'); // MENGAMBIL SEMUA ELEMENT DENGAN CLASS input-auth-code.
            for (var i = 0; i < inputFields.length; i++) { // CEK PANJANG DARI inputFields YANG MERUPAKAN KUMPULAN DARI ELEMENT DENGAN CLASS nput-auth-code.
                inputFields[i].addEventListener('input', function() { // EVENT LISTENER (EVENT INPUT) KARENA DITUJAKN MEMBACA INPUT DALAM INPUT TEXT.
                    if (this.value.length === this.maxLength) { // KONDISI JIKA PANJANG YANG DIINPUT SUDAH SESUAI DENGAN PANJANG MAXIMUM CHARACTER DARI INPUT TEXT YANG DITENTUKAN (DALAM HAL INI 1 CHRACTER).
                        var currentIndex = Array.prototype.indexOf.call(inputFields, this); // MENGAMBIL INDEX ELEMENT YANG SEDANG DIINPUT DALAM ARRAY.
                        var nextIndex = currentIndex + 1; // MENGGESER KE INDEX ELEMENT BERIKUTNYA, INDEX SAAT INI + 1 = INDEX SELANJUTNYA (INDEX = INPUT TEXT).
                        if (nextIndex < inputFields.length) { // CEK APAKAH MASIH ADA ELEMENT BERIKUTNYA.
                            inputFields[nextIndex].focus(); // MEMBERIKAN FOCUS PADA ELEMENT BERIKUTNYA, UNTUK MEMINDAHKAN CURSOR OTOMATIS KE INPUT TEXT SELANJUTNYA JIKA MASIH ADA.
                        }
                    }
                });
            }
        }
    // ====================================================================================================
// ========================================================================================================