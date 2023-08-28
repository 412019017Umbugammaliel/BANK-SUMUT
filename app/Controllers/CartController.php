<?php

namespace App\Controllers;

use App\Controllers\GeneratorController;

use App\Models\OrderModel;
use App\Models\ServersModel;
use App\Models\ServerProductModel;



class CartController extends BaseController
{
  // HALAMAN ORDER ============================================================================================================
    public function order()
    {
        // SESSION UNTUK MEMBERI NILAI PROPERTY ACTIVE PADA NAVBAR ============================================================
            session()->set('active', 'order');
            session()->set('active1', '');
            session()->set('subShow', '');
        // ====================================================================================================================

        // QUERY DARI TABEL ORDER PADA DATABASE ===============================================================================
            $modelorder = new OrderModel();
            $order['allOrder'] = $modelorder->findAll(); // Melakukan Query dengan Model, men-select semua kolom tabel.
        // ====================================================================================================================
        
        echo view('header.php');
        echo view('navigasi.php');
        echo view('dashboard_order.php', $order);
        echo view('dashboard_footer.php');
        echo view('script_plugin.php');        
    }
  // ==========================================================================================================================

  // PROSES DAN HALAMAN CART ==================================================================================================    
    public function cartProses() // PROSES
    {
        // MEMBUAT KODE ORDER BARU ============================================================================================
            $generateCartOrder = new GeneratorController(); 
            $cart_ID = $generateCartOrder->generate_cartOrder();
        // ====================================================================================================================
       
        // MENAMPUNG NILAI YANG DIKIRIM DARI AJAX PADA viewServer.js ==========================================================
            $dcOrder = $this->request->getVar('dcOrder'); // MENAMPUNG NILAI OPTION YANG DIPILIH PENGGUNA.
            $wlOrder = $this->request->getVar('wlOrder'); // MENAMPUNG NILAI OPTION YANG DIPILIH PENGGUNA.
            $cpuOrder = $this->request->getVar('cpuOrder'); // MENAMPUNG NILAI OPTION YANG DIPILIH PENGGUNA.
            $memoryOrder = $this->request->getVar('memoryOrder'); // MENAMPUNG NILAI OPTION YANG DIPILIH PENGGUNA.
            $storageOrder = $this->request->getVar('storageOrder'); // MENAMPUNG NILAI OPTION YANG DIPILIH PENGGUNA.
            
            $serverUserID = $this->request->getVar('serverUserID'); // MENAMPUNG SERVER ID DARI PENGGUNA.
            
            $dcNow = $this->request->getVar('dcSizeNow');
            $wlNow = $this->request->getVar('wlSizeNow');
            $cpuSizeNow = $this->request->getVar('cpuSizeNow'); // MENAMPUNG NILAI CPU SIZE TERAKHIR SEBELUM DI UPDATE.
            $memorySizeNow = $this->request->getVar('memorySizeNow'); // MENAMPUNG NILAI MEMORY SIZE TERAKHIR SEBELUM DI UPDATE.
            $storageSizeNow = $this->request->getVar('storageSizeNow');
        // ====================================================================================================================

        // MENGAMBIL NILAI VMS DARI ID USER DALAM DATABASE ====================================================================
            $modelServer = new ServersModel();       
            $ServerModel = $modelServer->where('id_user',$serverUserID)->findAll();
            foreach($ServerModel as $servers){
                $VMS = $servers['vms']; //AMBIL NILAI DARI KOLOM VMS BERDASARKAN ID USER. 
            }
        // ====================================================================================================================
        
        // KONDISI UNTUK MENENTUKAN PROSES UP/DOWNGRADE =======================================================================
            //  DATA CENTER ===================================================================================================
            if($dcOrder == ""){ // JIKA TIDAK ADA NILAI YANG DIPILIH PENGGUNA.
                $statUpDownGradeDC = "-"; // PADA HALAMAN CART, CETAK "-" UNTUK MENANDAKAN TIDAK ADA UPDATE PADA BAGIN INI.
            }else{
                if($dcOrder >= $dcNow){ // KONDISI JIKA OPTION YANG PENGGUNA PILIH LEBIH BESAR DARI YANG TERAKHIR.
                    $statUpDownGradeDC = "UPGRADE"; 
                }else if($dcOrder <= $dcNow){ // KONDISI JIKA OPTION YANG PENGGUNA PILIH LEBIH KECIL DARI YANG TERAKHIR.
                    $statUpDownGradeDC = "DOWNGRADE";
                }
            } 
            // ================================================================================================================
            //  WINDOWS LICENSE ===============================================================================================
            if($wlOrder == ""){ // JIKA TIDAK ADA NILAI YANG DIPILIH PENGGUNA.
                $statUpDownGradeWL = "-"; // PADA HALAMAN CART, CETAK "-" UNTUK MENANDAKAN TIDAK ADA UPDATE PADA BAGIN INI.
            }else{
                if($wlOrder >= $wlNow){ // KONDISI JIKA OPTION YANG PENGGUNA PILIH LEBIH BESAR DARI YANG TERAKHIR.
                    $statUpDownGradeWL = "UPGRADE"; 
                }else if($wlOrder <= $wlNow){ // KONDISI JIKA OPTION YANG PENGGUNA PILIH LEBIH KECIL DARI YANG TERAKHIR.
                    $statUpDownGradeWL = "DOWNGRADE";
                }
            } 
            // ================================================================================================================
            // CPU ============================================================================================================
            if($cpuOrder == ""){ // JIKA TIDAK ADA NILAI YANG DIPILIH PENGGUNA.
                $statUpDownGradeCPU = "-"; // PADA HALAMAN CART, CETAK "-" UNTUK MENANDAKAN TIDAK ADA UPDATE PADA BAGIN INI.
            }else{
                if($cpuOrder >= $cpuSizeNow){ // KONDISI JIKA OPTION YANG PENGGUNA PILIH LEBIH BESAR DARI YANG TERAKHIR.
                    $statUpDownGradeCPU = "UPGRADE"; 
                }else if($cpuOrder <= $cpuSizeNow){ // KONDISI JIKA OPTION YANG PENGGUNA PILIH LEBIH KECIL DARI YANG TERAKHIR.
                    $statUpDownGradeCPU = "DOWNGRADE";
                }
            } 
            // ================================================================================================================
            // MEMORY =========================================================================================================
            if($memoryOrder == ""){
                $statUpDownGradeMemory = "-";
            }else{
                if($memoryOrder >= $memorySizeNow){
                    $statUpDownGradeMemory = "UPGRADE";
                }else if($memoryOrder <= $memorySizeNow){
                    $statUpDownGradeMemory = "DOWNGRADE";
                }
            }
            // ================================================================================================================
            // STORAGE ========================================================================================================
            if($storageOrder == ""){
                $statUpDownGradeStorage = "-";
            }else{
                if($storageOrder >= $storageSizeNow){
                    $statUpDownGradeStorage = "UPGRADE";
                }else if($storageOrder <= $storageSizeNow){
                    $statUpDownGradeStorage = "DOWNGRADE";
                }
            }
            // ================================================================================================================
        // ====================================================================================================================

        // BUAT ARRAY ASOSIATIF UNTUK DISIMPAN PADA SESSION AGAR BISA DIAKSES PADA HALAMAN CART (function cart()) =============
            $cartData = array( 
                array(   
                    //DATA UMUM.
                    'id_cart' => $cart_ID,
                    'server_user_id' => $serverUserID,
                    'vms' => $VMS,
                    //=========================
                    //DATA SEBELUM UPDATE, DATA TERAKHIR.
                    'dataCenter_now' => $dcNow, 
                    'windowsLicense_now' => $wlNow,
                    'cpu_size_now' => $cpuSizeNow, 
                    'memory_size_now' => $memorySizeNow,
                    'storage_size_now' => $storageSizeNow,
                    //========================
                    //DATA YANG AKAN DI UPDATE.
                    'data_center' => $dcOrder, //NILAI UPDATE DATA.
                    'windows_license' => $wlOrder,
                    'cpu_order' => $cpuOrder,
                    'memory_order' => $memoryOrder,
                    'storage' => $storageOrder,
                    'status_order_dc' => $statUpDownGradeDC, //INFORMASI STATUS.
                    'status_order_wl' => $statUpDownGradeWL,
                    'status_order_cpu' => $statUpDownGradeCPU,
                    'status_order_memory' => $statUpDownGradeMemory,
                    'status_order_storage' => $statUpDownGradeStorage
                    //========================
                )
            );
            session()->set('cartdata',$cartData); //TAMPUNG DALAM SESSION DAN DIGUNAKAN UNTUK FUNGSI CART().
        // ====================================================================================================================
    }
    public function cart() // HALAMAN
    {        
        // MENGAMBIL SESSION YANG DIBUAT PADA cartProses() ====================================================================
        $cartdata['datacart'] = session()->get('cartdata');
        
        echo view('header.php');
        echo view('navigasi.php');
        echo view('dashboard_cartOrder.php',$cartdata); // Send $cartData to veiw. 
        echo view('dashboard_footer.php');
        echo view('script_plugin.php');
        // ====================================================================================================================
    }
  // ==========================================================================================================================

  // HALAMAN INVOICE ==========================================================================================================
    public function invoice(){
        echo view('header.php');
        echo view('navigasi.php');
        echo view('dashboard_invoice.php');
        echo view('dashboard_footer.php');
        echo view('script_plugin.php');
    }
  // ==========================================================================================================================

  // QUERY UNTUK  MENAMPILKAN INFORMASI HARGA PRODUCT DALAM INVOICE (SUMMARY) =================================================  
    public function retriveDataServerProductById()
    {
        $proId = $this->request->getVar('param');

        $serverProduct = new ServerProductModel();
        $product = $serverProduct->where('id_product',$proId)->findAll();

        return $this->response->setJSON($product);
    }
  // ==========================================================================================================================

  // QUERY UNTUK MELAKUKAN PERHITUNGAN TOTAL BERDASARKAN INVOICE PENGGUNA =====================================================
    public function retriveTotalPriceProduct()
    {
        $param1 = $this->request->getVar('paramId1');
        $param2 = $this->request->getVar('paramId2');
        $param3 = $this->request->getVar('paramId3');
        $param4 = $this->request->getVar('paramId4');
        $param5 = $this->request->getVar('paramId5');

        $serverProduct = new ServerProductModel();
        $query = $serverProduct ->select('id_product, product_price')
                                ->whereIn('id_product', [$param1, $param2, $param3, $param4, $param5])
                                ->get();

        $result = $query->getResultArray();
        return $this->response->setJSON($result);
    }    
  // ==========================================================================================================================

  // NEW ORDER PROSES =========================================================================================================
    public function createNewOrder(){
        $order_id = $this->request->getVar('order_id');
        $order_type = $this->request->getVar('order_type');
        $user = $this->request->getVar('user');
        $id_user = $this->request->getVar('id_user');
        $total_order = $this->request->getVar('total_order');

        $newOrder = new OrderModel();
        $createOrder = [
            'order_code' => $order_id,
            'product' => $order_type,
            'id_user' => $id_user,
            'customer' => $user,
            'date' => date_create()->format("Y-m-d"),
            'time' => date_create()->format("H:i:s"),
            'payment' => 'Pending',
            'total' => $total_order
        ];
        $newOrder->insert($createOrder);
    }
  // ==========================================================================================================================
}