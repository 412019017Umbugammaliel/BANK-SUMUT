function vms(){ // SET JUMLAH VM'S DARI MASING MASING PRODUCT.
    DCDV.textContent = VMS;
    WLDV.textContent = VMS;
    CDV.textContent = VMS;
    MDV.textContent = VMS;
    SDV.textContent = VMS;    
}
// TAMPILKAN HARGA DARI SETIAP PRODUK SESUAI DENGAN ORDER PENGGUNA ===============================================================
    // DATA CENTER ===============================================================================================================
        function retriveDataProductDC(productId)
        {
            var dataParam = {param: productId};
            $.ajax({
                url: base_url+"/CartController/retriveDataServerProductById",
                type: 'GET',
                data: dataParam,  
                success: function(response) { 
                    if(DC == ""){
                        DCDO.textContent = 0;
                        temp_DC_price = 0 * VMS;            
                        DC_price = temp_DC_price.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                        DCP.textContent = DC_price;
                    }else{
                        DCDO.textContent = response[0].product_variant;
                        temp_DC_price = response[0].product_price * VMS;            
                        DC_price = temp_DC_price.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                        DCP.textContent = DC_price;
                    }
                }
            });
        }
    // ===========================================================================================================================
    // WINDOWS LICENSE ===========================================================================================================
        function retriveDataProductWL(productId)
        {
            var dataParam = {param: productId};
            $.ajax({
                url: base_url+"/CartController/retriveDataServerProductById",
                type: 'GET',
                data: dataParam,  
                success: function(response) {
                    if(WL == ""){
                        WLDO.textContent = 0;
                        temp_WL_price = 0 * VMS;
                        WL_price = temp_WL_price.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                        WLP.textContent = WL_price;
                    }else{
                        WLDO.textContent = response[0].product_variant;
                        temp_WL_price = response[0].product_price * VMS;
                        WL_price = temp_WL_price.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                        WLP.textContent = WL_price;
                    }            
                }
            });
        }
    // ===========================================================================================================================
    // CPU =======================================================================================================================
        function retriveDataProductCP(productId)
        {
            var dataParam = {param: productId};
            $.ajax({
                url: base_url+"/CartController/retriveDataServerProductById",
                type: 'GET',
                data: dataParam,  
                success: function(response) {
                    if(CO == ""){
                        CDO.textContent = 0;
                        temp_CP_price = 0 * VMS;
                        CP_price = temp_CP_price.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                        CP.textContent = CP_price;
                    }else{
                        CDO.textContent = response[0].product_variant;
                        temp_CP_price = response[0].product_price * VMS;
                        CP_price = temp_CP_price.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                        CP.textContent = CP_price;
                    }
                }
            });
        }
    // ===========================================================================================================================
    // MEMORY ====================================================================================================================
        function retriveDataProductMM(productId)
        {
            var dataParam = {param: productId};
            $.ajax({
                url: base_url+"/CartController/retriveDataServerProductById",
                type: 'GET',
                data: dataParam,  
                success: function(response) {
                    if(MO == ""){
                        MDO.textContent = 0;
                        temp_MM_price = 0 * VMS;
                        MM_price = temp_MM_price.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                        MP.textContent = MM_price;
                    }else{
                        MDO.textContent = response[0].product_variant;
                        temp_MM_price = response[0].product_price * VMS;
                        MM_price = temp_MM_price.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                        MP.textContent = MM_price;
                    }
                }
            });
        }
    // ===========================================================================================================================
    // STORAGE ===================================================================================================================
        function retriveDataProductST(productId)
        {
            var dataParam = {param: productId};
            $.ajax({
                url: base_url+"/CartController/retriveDataServerProductById",
                type: 'GET',
                data: dataParam,  
                success: function(response) {
                    if(SO == ""){
                        SDO.textContent = 0;
                        temp_ST_price = 0 * VMS;
                        ST_price = temp_ST_price.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                        SP.textContent  = ST_price;
                    }else{
                        SDO.textContent = response[0].product_variant;
                        temp_ST_price = response[0].product_price * VMS;
                        ST_price = temp_ST_price.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                        SP.textContent  = ST_price;
                    }
                }
            });
        }
    // ===========================================================================================================================
// ===============================================================================================================================

// KALKULASI TOTAL DARI INVOICE (SUMMARY) ========================================================================================
    function totalInvoice(paramId1, paramId2, paramId3, paramId4, paramId5){ // MENGGUNAKAN PARAMETER YANG DIKIRIM DARI FUNGSI.        
        var dataParam = {paramId1: paramId1, paramId2: paramId2, paramId3: paramId3, paramId4: paramId4, paramId5: paramId5}; // TAMPUNG DALAM ARRAY OBJECT
        $.ajax({
            url: base_url+"/CartController/retriveTotalPriceProduct",
            type: 'GET',
            data: dataParam,  
            success: function(response) {
                let total = 0; // DEFINISIKAN VARIABLE TOTAL = 0.
                let tax = 10/100; // TAX 10%.
                for(let i = 0; i < response.length; i++){ // LAKUKAN PERULANGAN UNTUK MENGAMBIL SEMUA NILAI YANG DIDAPAT DARI QUERY.
                    total += parseInt(response[i].product_price); // HASIL DARI QUERY BERUPA STRING, JADI HARUS DI KONVERSI KE DALAM INTEGER.
                }
                // TotalRp.textContent = total; // CETAK TOTAL KEDALAM SUMMARY BAGIAN TOTAL.
                TotalRp.textContent = total.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });            
                
                let totalXtax = total * tax; // CETAK HASIL TAX KEDALAM BAGIAN TAX PADA SUMMARY.
                TaxRp.textContent = totalXtax.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });

                totalPlusTotalXTax = total+(total * tax); // CETAK TOTAL + TAX KEDALAM SUMMARY.
                TTRp.textContent = totalPlusTotalXTax.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });                
            }
        }); 
    }
// ===============================================================================================================================

// PROSES MEMBUAT ORDER BARU =====================================================================================================
    function createNewOrder(){
        var dataParam = {paramId1: '$DC_'+DC, paramId2: '$WL_'+WL, paramId3: '$CP_'+CO, paramId4: '$MM_'+MO, paramId5: '$ST_'+SO}; // TAMPUNG DALAM ARRAY OBJECT
        $.ajax({
            url: base_url+"/CartController/retriveTotalPriceProduct",
            type: 'GET',
            data: dataParam,  
            success: function(response) {
                let total = 0; // DEFINISIKAN VARIABLE TOTAL = 0.
                let tax = 10/100; // TAX 10%.
                for(let i = 0; i < response.length; i++){ // LAKUKAN PERULANGAN UNTUK MENGAMBIL SEMUA NILAI YANG DIDAPAT DARI QUERY.
                    total += parseInt(response[i].product_price); // HASIL DARI QUERY BERUPA STRING, JADI HARUS DI KONVERSI KE DALAM INTEGER.
                }
                // TotalRp.textContent = total; // CETAK TOTAL KEDALAM SUMMARY BAGIAN TOTAL.
                TotalRp.textContent = total.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });            
                
                let totalXtax = total * tax; // CETAK HASIL TAX KEDALAM BAGIAN TAX PADA SUMMARY.
                TaxRp.textContent = totalXtax.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });

                totalPlusTotalXTax = total+(total * tax); // CETAK TOTAL + TAX KEDALAM SUMMARY.
                TTRp.textContent = totalPlusTotalXTax.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });   

                // AJAX KE DUA, PROSES INSERT ORDER BARU.
                seconDdataParam = {'order_id':idOrder, 'order_type':'CUSTOME PACKAGE','id_user': id_user,'user':userName, 'total_order':totalPlusTotalXTax};
                $.ajax({
                    url: base_url+"/CartController/createNewOrder",
                    type: 'POST',
                    data: seconDdataParam,  
                    success: function(response) {                    
                        window.location.href = urltoorder; // REDIRECT TO ORDER PAGE.
                    }
                });
            }
        }); 
    }
// ===============================================================================================================================
