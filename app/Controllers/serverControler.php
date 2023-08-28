<?php

namespace App\Controllers;

use App\Controllers\GeneratorController;

use App\Models\UserServersModel;
use App\Models\ServersModel;
use App\Models\LogModel;



class serverControler extends BaseController
{
    // GLOBAL variable for show level in notifikasi
    protected $changePowerServer = "Level_3";

    public function __construct()
    {
        helper('form');
        helper('url');
    }
    // MENGAMBIL DATA USER SERVER DAN DATA SERVER PENGGUNA.
    public function getServerData()
    {
        $id_user = $this->request->getVar('idUserServer');

        // TABEL USER_SERVERS.
        $dataUserServer = new UserServersModel();
        $temp_dataUserServer = $dataUserServer->where('id_user',$id_user)->findAll();

        // TABEL SERVERS.
        $dataServer = new ServersModel();
        $temp_dataServer = $dataServer->where('id_user',$id_user)->findAll();

        // MENGGABUNGKAN DUA TABEL DENGAN ARRAY MERGE DARI TABEL USER SERVERS DAN TABEL SERVERS.
        $allDataServerUser = array_merge($temp_dataUserServer, $temp_dataServer);

        return $this->response->setJSON($allDataServerUser);
    }
    // HALAMAN SERVER.
    public function server()
    {        
        // Session untuk memberi nilai property active pada navbar
        session()->set('active', 'server');
        session()->set('active1', '');
        session()->set('subShow', '');
        // ==================================        

        echo view('header.php');
        echo view('navigasi.php');
        echo view('dashboard_server.php');
        echo view('dashboard_footer.php');
        echo view('script_plugin.php');       
    } 

    public function retrieveServerDataTabel()
    {
        $db = \Config\Database::connect();

        $level_user_login = session()->get('level');
        $user_id_login = session()->get('id_user');
        if($level_user_login == 'Client'){
            $queryUserDataServer = $db  ->table('user_servers') 
                                        ->select('user_servers.*, servers.*')
                                        ->join('servers', 'servers.id_user = user_servers.id_user', 'left')
                                        ->where('user_servers.id_user', $user_id_login)
                                        ->get();       
            $result = $queryUserDataServer->getResultArray(); // BENTUK ARRAY ASSOISIATIF.
            $server['server'] = $result;            
            return $this->response->setJSON($server);
        }else{
            $excluded_user_levels = array('Admin', 'Cs');
            $queryUserDataServer = $db  ->table('user_servers') 
                                        ->select('user_servers.*, servers.*')
                                        ->join('servers', 'servers.id_user = user_servers.id_user', 'left')
                                        ->whereNotIn('user_servers.level', $excluded_user_levels)
                                        ->get();       
            $result = $queryUserDataServer->getResultArray(); // BENTUK ARRAY ASSOISIATIF.
            $server['server'] = $result;           
            return $this->response->setJSON($server);
        } 
    } 
     
    public function viewServer($id_user) 
    {
        $viewServer = ['id_user' => $id_user]; // ARRAY ID USER, AGAR BISA DIKIRIM.
        
        echo view('header.php');
        echo view('navigasi.php');
        echo view('dashboard_viewServer.php',$viewServer); // KIRIM NILAI ID USER KE DALAM VIEW (DIKIRIM DALAM BENTUK ARRAY).
        echo view('dashboard_footer.php');
        echo view('script_plugin.php');        
    }

    public function turnOffServer()
    {   
      // Get id from generate_LogID =============================================================================================
        $generatorLogId = new GeneratorController();
        $generatLogId = $generatorLogId->generate_LogID();
        
        $idExecutor = session()->get('id_user');
        $userExecutor = session()->get('user_name');
        $id_user = $this->request->getVar('idUserServer');
      // ========================================================================================================================
             
      // Create Log Turn ON Server ==============================================================================================
        $logActivity = new LogModel();
        $logTurnOff = [
            'id_log'=> $generatLogId,
            'id_user'=> $idExecutor,
            'user_name'=> $userExecutor,
            'category'=> $this->changePowerServer,
            'date_time'=> date_create()->format("Y-m-d H:i:s"),
            'desc_log_activity'=> $userExecutor.' Turn Off power '.$id_user.'.',
            'status_read' => 'unread'
        ];                
        $logActivity->insert($logTurnOff);

        // Update Power Status ================================================================================================
        $datatoserver = new ServersModel();
        $updateData = ['power_status'=>'OFF'];
        $datatoserver->updateDataServer($updateData,$id_user);
        //=====================================================================================================================
        session()->setFlashdata('feadback','SUCCESSOFF');
        
      //=========================================================================================================================     
    }

    public function turnOnServer()
    {           
      // Get id from generate_LogID() ===========================================================================================
        $generatorLogId = new GeneratorController();
        $generatLogId = $generatorLogId->generate_LogID();

        $idExecutor = session()->get('id_user');
        $userExecutor = session()->get('user_name'); 
        $id_user = $this->request->getVar('idUserServer'); 
      //=========================================================================================================================

      // Update Power Status ====================================================================================================
        $updatePowerStatus = new ServersModel();
        $updateProfile = ['power_status' => 'ON'];
        $updatePowerStatus->updateDataServer($updateProfile, $id_user);
      //=========================================================================================================================

      // Create Log Turn ON Server ==============================================================================================
        $logActivity = new LogModel();
        $logTurnOn = [
            'id_log'=> $generatLogId,
            'id_user'=> $idExecutor,
            'user_name'=> $userExecutor,
            'category'=> $this->changePowerServer,
            'date_time'=> date_create()->format("Y-m-d H:i:s"),
            'desc_log_activity'=> $userExecutor.' Turn On power '.$id_user.'.', // User yang eksekusi _aksi_ user yang dieksekusi.
            'status_read' => 'unread'
        ];                
        $logActivity->insert($logTurnOn);
      //=========================================================================================================================
        session()->setFlashdata('feadback','SUCCESSON');
    }

    public function updateServerCapacitySize()
    {
      $itemSize = $this->request->getVar('size');
      $itemName = $this->request->getVar('item');

      $id_user = $this->request->getVar('idUserServer');
      $update_item_size = new ServersModel();
      if($itemName == "DC"){
        $update_item = ['data_center' => $itemSize];
      }
      if($itemName == "WL"){
        $update_item = ['windows_license' => $itemSize];
      }
      if($itemName == "CPU"){
        $update_item = ['cpu' => $itemSize];
      }
      if($itemName == "MEMORY"){
        $update_item = ['memory' => $itemSize];
      }
      if($itemName == "SDD"){
        $update_item = ['storage' => $itemSize];
      }
      
      $update_item_size->updateDataServer($update_item, $id_user);
    }   
}

// public function updateServer()
  // {
  //     $param = $this->request->getVar('param');
  //     $val_update = $this->request->getVar('valUpdate');
  //     $id_user = $this->request->getVar('idUserServer');

  //     $datatoserver = new ServersModel();
  //     if($param == 'cpu')
  //     {
  //         $updateData = ['cpu'=>$val_update];
  //         $datatoserver->updateDataServer($updateData,$id_user);
  //     }
  //     else if($param == 'memory')
  //     {
  //         $updateData = ['memory'=>$val_update];
  //         $datatoserver->updateDataServer($updateData,$id_user);
  //     }
  // }