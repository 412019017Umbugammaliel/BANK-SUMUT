<?php

namespace App\Controllers;

use App\Models\UserServersModel;
use App\Models\MerchantModel;
use App\Models\LogModel;
use App\Models\ActivityChatModel;

use App\Controllers\GeneratorController;

class Home extends BaseController
{
  // VARIABLE GLOBAL ==================================================================================
    // DIGUNAKAN UNTUK KEPERLUAN LOG ACTIVITY, MENENTUKAN LOG MANA YANG PERLU DITAMPILKAN DAN LOG MANA YANG TIDAK PERLU.
    protected $Admin = "Admin_idnKa_20301";
    protected $SendOTP = "Level_1";
    protected $changePowerServer = "Level_3";
    protected $LoginLogout = "Level_2";    
    protected $change = "Level_4";
    protected $deleteNotifLogActivity = "Level_5";
  // ==================================================================================================

    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        helper('form');
        helper('url');       
    } 
    
  // GENERATOR CODE ====================================================================================
    // public function generate_UserID() // UNTUK PROSES GENERATE ID USER SAAT REGISTRASI.
    // {
    //     //Proses randome generate untuk menghasilkan unik ID untuk setiap user yang melakukan registrasi.
    //     $idUser = ''; // Buat variable kosong untuk deklarasi variable.
    //     $length = 5; // Set dengan nilai 5 (untuk perulangan sebanyak 5 kali.)
    //     $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //     $charactersLength = strlen($characters); //Menghitung pajang character dari isi variable $character.

    //     $randomString = ''; // Buat variable kosong untuk deklarasi variable.
    //     // Melakukan perulangan sebanyak nilai dari $length yg di set.
    //     for ($i = 0; $i < $length; $i++) {
    //         $randomString .= $characters[rand(0, $charactersLength - 1)];
    //     }

    //     $randString = $randomString; // Tampung hasil perulangan secara random kedalam variable $randString.
    //     $randNumber = rand(1, 99999); //Generat angka random 1-99999

    //     $idUser = "Guest_" . $randString . "_" . $randNumber; //Menggabungkan hasil dari kedua generat string dan angka 
    //     //==========================================================================================
    //     return $idUser; //Mengembalikan nilai yang ada dalam variable $idUser dalam fungsi generate_UserID(), agar saat dipanggil fungsi ini memiliki nilai.
    // } 
    public function generate_OTPCode() // UNTUK PROSES GENERATE KODE OTP.
    {
        $length = 6;
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $charactersLength = strlen($characters);
        $randOTPCode = "";
        for ($i = 0; $i < $length; $i++) {
            $randOTPCode .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randOTPCode;
    }
  // ===================================================================================================

  // PROSES CEK SESSION (PERTAMA KALI LOAD HALAMAN PORTAL) =============================================
    public function index()
    {           
        if (!$this->session->get('statuslogin')) {
            return redirect()->to('login'); // DIARAHAN KE HALAMAN LOGIN JIKA TIDAK ADA SESSION (EXPIRED SESSION).
        }else{
            return redirect()->to('main'); // DIARAHKAN KE HALAMAN DASHBOARD JIKA ADA SESSION.
        }               
    }
  // ===================================================================================================

  // THEMES ============================================================================================
    public function themesColor()
    {
        $selectColor = $this->request->getPost('themes');        
        session()->set('themes',$selectColor);       
        return redirect()->to('setting');
    }
  // ===================================================================================================


  // LOGIN PAGE & PROCESS ==============================================================================
    public function getOTPCode()
    { // Function for get OTP code from generate_OTPCode().(This function is made to resend the OTP Code button, if the first OTP code expires)
        $getOTPCode = $this->generate_OTPCode();
        return $getOTPCode;
    }    
    public function login()
    {   
        echo view('header.php');
        echo view('header_login.php');
        echo view('login.php');
        echo view('script_plugin_login.php');        
    }
    public function prosesLogin() // Login process. (After click button login, OTP Code will be generate in session. Sendig code to email or SMS, and save into session.)
    {
        // Get id from generate_LogID()
        $generatorLogId = new GeneratorController();
        $generatLogId = $generatorLogId->generate_LogID();

        // Mengambil nilai email dan password dari input form login.
        echo $email          = $this->request->getPost('email');
        echo $password       = sha1($this->request->getPost('password')); // Encrypt input password.

        $modelLogin    = new UserServersModel();
        $logActivity = new LogModel();

        // Validasi penulisan input email dalam format email. 
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email', // Atribut kondisi validasi (required = wajib, valid_email = format harus dlm bentuk email)
                'errors' => [ // Jika atribut kondisi di atas tidak terpenuhi, kirim atau buat nilai error untuk dikirim kedalam notifikasi pada halaman login.
                    'required' => 'Email harus diisi', // Nilai dari atribut required.
                    'valid_email' => 'Format Email Harus Valid!' // Nilai dari atribut valid_email.
                ]
            ]
        ])) {
            // Jika validasi tidak terpenuhi, buat session untuk mengirim niali error berdasarkan atribut validasi yg tidak terpenuhi.
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('/')); // Kembali ke halaman login.
        } else { // Jika validasi terpenuhi, lakukan pemeriksaan kecocokan email dan password yg user input. 
            
            $dataUser = $modelLogin->where('user_email', $email)->where('password', $password)->findAll();
            $dataUser = (array_merge(...$dataUser)); // Menyederhanakan bentuk array hasil Query.            
            
            if ($dataUser) //Kondisi jika email dan password ditemukan dan cocok.
            {                
                $logSendOtp = [
                    'id_log'=> $generatLogId,
                    'id_user'=> $dataUser['id_user'],
                    'category'=> $this->SendOTP,
                    'date_time'=> date_create()->format("Y-m-d H:i:s"),
                    'desc_log_activity'=> 'Trying login, sending OTP Code to user.', 
                    'status_read' => 'read'
                ];                
                $logActivity->insert($logSendOtp);
                session()->setFlashdata('FirstLogin', true);

                // Cek apakah status dari user tersebut aktif atau non-aktif, jika aktif buat session untuk keerluan menampilkan data-data user ke seluruh halaman view.
                if ($dataUser['status'] == "Aktif") {
                    $OTPCode = $this->getOTPCode(); // Get OTP from getOTPCode() function.
                    session()->setTempdata('otp',$OTPCode,300); // Create functions like FlashData sessions but have adjustable time settings, and are not affected by page refresh.
                    session()->set('email',$email);
                    session()->set('validation', 'validated');
                   
                    // Tempat untuk code mengirim OTP Code via email ataupun whatsapp. 

                    return redirect()->to(base_url('twoVerify')); 
                } else {
                    $logSendOtp = [
                        'id_log'=> $generatLogId,
                        'id_user'=> $dataUser['id_user'],
                        'category'=> $this->SendOTP,
                        'date_time'=> date_create()->format("Y-m-d H:i:s"),
                        'desc_log_activity'=> 'Trying login, user status non-active.', 
                        'status_read' => 'read'
                    ];                
                    $logActivity->insert($logSendOtp);

                    // Jika status non-aktif, buat session untuk dikirim sebagai notifikasi ke halaman login.
                    session()->setFlashdata('error', 'Akun anda sudah tidak aktif!');
                    // dd(session()->getFlashdata('errorLogin'));
                    return redirect()->to(base_url('/')); // Kembali kehalaman login.
                }
            } else {
                $logSendOtp = [
                    'id_log'=> $generatLogId,
                    'category'=> $this->SendOTP,
                    'date_time'=> date_create()->format("Y-m-d H:i:s"),
                    'desc_log_activity'=> 'Trying login, wrong email or pasword.',
                    'status_read' => 'read' 
                ];                
                $logActivity->insert($logSendOtp);

                // Jika email atau password tidak cocok dengan hasil Query atau tidak terdaftar dalam database, buat session error dan kirim nlali error dalam bentuk notifikasi. 
                session()->setFlashdata('error', 'Email atau Password anda salah!');
                // dd(session()->getFlashdata('errorLogin'));
                return redirect()->to(base_url('/')); // Kembali kehalaman login.
            }
            
        }
    }
  // ===================================================================================================


  // TWO-FACTOR VERIFICATION PAGE & PROCESS ============================================================
    public function regenerateOTPCode()
    {
        $OTPCode = $this->getOTPCode(); // Get OTP from getOTPCode() function.
        session()->setTempdata('otp',$OTPCode,300); 
        return redirect()->to('twoVerify');           
    }
    public function twoFactorVerification()
    {
        $validation = session()->get('validation'); 
        if(isset($validation)){
            echo view('header.php');
            echo view('header_login.php');
            echo view('two_factor_verification.php');
            echo view('script_plugin_login.php');
        }else{
            return redirect()->to(base_url('twoVerify'));
        }
    }
    public function twoFactorVerificationProcess()
    {
        // Get id from generate_LogID()
        $generatorLogId = new GeneratorController();
        $generatLogId = $generatorLogId->generate_LogID();
        
        $logActivity = new LogModel();

        // Do a Query based on the email and password of all the data in the user table. 
        $email = session()->get('email'); // Get email from input user.   
        $modelLogin    = new UserServersModel();
        $dataUser = $modelLogin->where('user_email', $email)->findAll();
        $dataUser = (array_merge(...$dataUser)); // Simplifies the form of the Query result array.

        // Get Otp Code from server (generate after login) and input user.
        $OTP = session()->getTempdata('otp');
        $inputOTP = $this->request->getPost('otp-input');

        // Cek OTP
        if(isset($OTP)){
            if($inputOTP == $OTP){                
                session()->set('foto', $dataUser['foto']);
                session()->set('id_user', $dataUser['id_user']);
                session()->set('user_name', $dataUser['user_name']);
                session()->set('first_name', $dataUser['first_name']);
                session()->set('last_name', $dataUser['last_name']);
                session()->set('user_email', $dataUser['user_email']);
                session()->set('user_phone', $dataUser['user_phone']);
                session()->set('password', $dataUser['password']);
                session()->set('level', $dataUser['level']);
                session()->set('status', $dataUser['status']);
                session()->set('statuslogin', true);

                // Send value 1 to database, when user online.
                $id_user = session()->get('id_user');
                $stat_online_offline = [
                    'status_active_user'=> 1
                ];
                $modelLogin->updateDataUser($stat_online_offline,$id_user);

                // Save information to log database.
                $loglogin = [
                    'id_log'=> $generatLogId,
                    'id_user'=> session()->get('id_user'),
                    'category'=> $this->LoginLogout,
                    'date_time'=> date_create()->format("Y-m-d H:i:s"),
                    'desc_log_activity'=> 'Success login, corect OTP Code.',
                    'status_read' => 'read'
                ];                
                $logActivity->insert($loglogin);                
                return redirect()->to(base_url('main'));
            }else{
                // Save information to log database.
                session()->set('id_user', $dataUser['id_user']);
                $loglogin = [
                    'id_log'=> $generatLogId,
                    'id_user'=> session()->get('id_user'),
                    'category'=> $this->LoginLogout,
                    'date_time'=> date_create()->format("Y-m-d H:i:s"),
                    'desc_log_activity'=> 'Failed login, incorect OTP Code.',
                    'status_read' => 'read' 
                ];                
                $logActivity->insert($loglogin);

                session()->setFlashdata('error','Wrong otp code');
                return redirect()->to(base_url('twoVerify'));
            }
        }else{
            session()->setFlashdata('error','Your OTP code has expired');
                return redirect()->to(base_url('twoVerify'));
        }

    }    
  // ===================================================================================================


  // MAIN DASHBOARD ====================================================================================
    public function main()
    {
        // Session untuk memberi nilai property active pada navbar
        session()->set('active', 'main');
        session()->set('active1', '');
        session()->set('subShow', '');
        // ==================================

        $db = \Config\Database::connect();
        $queryUserDataServer = $db  ->table('user_servers') 
                                    ->select('user_servers.*, servers.*')
                                    ->join('servers', 'servers.id_user = user_servers.id_user', 'left')
                                    ->where('user_servers.level', 'Client')
                                    ->get();       
        $result = $queryUserDataServer->getResultArray();
        $allDataServerUser['serverData'] = $result;
        // dd($allDataServerUser);

        echo view('header.php');
        echo view('navigasi.php');
        echo view('dashboard_main.php', $allDataServerUser); // Kirim hasil Query dalam array stdObject resultdata ke view.
        echo view('dashboard_footer.php');
        echo view('script_plugin.php'); 
    }    
  // ===================================================================================================


  // SETTING ===========================================================================================
    public function setting()
    {       
        // Session untuk memberi nilai property active pada navbar
        session()->set('active', 'subpage');
        session()->set('active1', 'subpage1');
        session()->set('subShow', 'show');
        // ==================================

        echo view('header.php');
        echo view('navigasi.php');
        echo view('dashboard_setting.php');
        echo view('dashboard_footer.php');
        echo view('script_plugin.php');        
    }
  // ===================================================================================================


  // HALAMAN DAN PROSES AKTIVITAS PESAN, AKTIVITAS LOG, PESAN & LOG BELUM TERBACA (UNREAD).===============
    // HALAMAN AKTIVITAS PESAN ===========================================================================
        // public function messageActivity()
        // {
        //     // Session untuk memberi nilai property active pada navbar
        //     session()->set('active', 'subpage');
        //     session()->set('active1', 'subpage3');
        //     session()->set('subShow', 'show');
        //     // ================================== 
            
        //     // Menampung jumlah notifikasi yang belum dibaca kedalam session.        

        //     echo view('header.php');
        //     echo view('navigasi.php');
        //     echo view('dashboard_notifikasi.php');
        //     echo view('dashboard_footer.php');
        //     echo view('script_plugin.php'); 
        // } 
    // ===================================================================================================

    // HALAMAN AKTIVITAS LOG =============================================================================
        public function logActivity()
        {
            // Session untuk memberi nilai property active pada navbar
            session()->set('active', 'subpage');
            session()->set('active1', 'subpage3');
            session()->set('subShow', 'show');
            // ==================================

            // Menampung jumlah notifikasi yang belum dibaca kedalam session.
            // session()->set('unreadNotif',$this->getUnreadCount()); 
            
            echo view('header.php');
            echo view('navigasi.php');
            echo view('dashboard_logActivity.php');
            echo view('dashboard_footer.php');
            echo view('script_plugin.php'); 
        }  
    // ===================================================================================================

    // MENGAMBIL DATA PESAN UNTUK TABLE PESAN ============================================================
        public function retrieveMsgDataTabel()
        {
            $id_user = session()->get('id_user');
            $activityChat = new ActivityChatModel();
            $data['data'] = $activityChat->where('destination_id_user',$id_user)->findAll();
            return $this->response->setJSON($data);
        }
    // ===================================================================================================

    // MERUBAH STATUS PESAN DARI UNREAD KE READ, PADA PESAN YANG DIBACA (FUNGSI PADA MODAL NOTIFIKASI & TABEL)
        public function setRead()
        {        
            $messageID = $this->request->getVar('message_ID');

            $readNotifChat = new ActivityChatModel();
            $set_read = [
                // Set setatus belum dibaca menjadi dibaca.
                'status_read' => 'read' 
            ];
            $readNotifChat->setReadChat($set_read, $messageID);       
        }
    // ===================================================================================================

    // MERUBAH STATUS PESAN DARI UNREAD KE READ, PADA PESAN YANG DIBACA (FUNGSI PADA BODY CONSOLE TIKET) =
        public function setReadAllChat()
        {    
            $paramIDchat = $this->request->getVar('IDchat');
            $paramDestId = $this->request->getVar('destIdUser');
            $readNotifChat = new ActivityChatModel();
            $set_read = [
                // Set setatus belum dibaca menjadi dibaca.
                'status_read' => 'read' 
            ];
            $readNotifChat->setReadAllChat($set_read, $paramIDchat, $paramDestId);
        }
    // ===================================================================================================

    // MENGHAPUS PESAN PER ID PESAN ======================================================================
        public function deleteMessage()
        {
            // Get id from generate_LogID()
            $generatorLogId = new GeneratorController();
            $generatLogId = $generatorLogId->generate_LogID();

            $message_ID = $this->request->getVar('message_ID');  
            $msgModel = new ActivityChatModel();
            $msgModel->deleteMsg($message_ID);

            $userExecutor = session()->get('id_user');
            $logActivity = new LogModel();
            $deleteNotif = [
                'id_log'=> $generatLogId,
                'id_user' => $userExecutor,
                'category'=> $this->deleteNotifLogActivity,
                'date_time'=> date_create()->format("Y-m-d H:i:s"),
                'desc_log_activity'=> $userExecutor.' remove message '.$message_ID.'.', 
                'status_read' => 'unread' // Set unread for notif new log activity.
            ];                
            $logActivity->insert($deleteNotif);        
        }
    // ===================================================================================================

    // LOG DATA ==========================================================================================
        public function retrieveLogDataTabel()
        {        
            $id_user = session()->get('id_user');
            $db = \Config\Database::connect();        
            $category = $db->query("SELECT id_log, user_name, category, date_time, desc_log_activity, status_read  FROM log_activity  WHERE  id_user = '$id_user' AND category IN ('$this->changePowerServer', '$this->change', '$this->deleteNotifLogActivity')");
            $data['data'] = $category->getResult();
            return $this->response->setJSON($data);
        } 
        public function setReadLog()
        {
            $id_Log = $this->request->getVar('id_Log');
            $notifLog = new LogModel();
            $update_log = [
                // Set setatus belum dibaca menjadi dibaca.
                'status_read' => 'read' 
            ];
            $notifLog->updateLog($update_log, $id_Log);
        }
        public function deleteLog()
        {
            // Get id from generate_LogID()
            $generatorLogId = new GeneratorController();
            $generatLogId = $generatorLogId->generate_LogID();

            $idExecutor = session()->get('id_user');
            $userExecutor = session()->get('user_name');
            $id_Log = $this->request->getVar('id_Log');
            // $category = $this->request->getVar('category');
            $userName = $this->request->getVar('user_Name');
            // Process delete with parameter $id_log
            $notifLog = new LogModel();
            $notifLog->deleteLog($id_Log);
            
            // Process create log activity delete.
            $logActivity = new LogModel();
            $deleteLog = [
                'id_log'=> $generatLogId,
                'id_user' => $idExecutor,
                'user_name'=> $userName,
                'category'=> $this->deleteNotifLogActivity,
                'date_time'=> date_create()->format("Y-m-d H:i:s"),
                'desc_log_activity'=> $userExecutor.' remove ('.$id_Log.').', 
                'status_read' => 'unread'
            ];
            $logActivity->insert($deleteLog);
        }
    // ===================================================================================================

    // MENDAPATKAN SEMUA JUMLAH LOG BELUM TERBACA (STATUS UNREAD) ========================================
        public function getUnreadLogCount()
        {
            $id_user = session()->get('id_user');
            
            $db = \Config\Database::connect();
        // Tabel log_activity ===================================================
            $count2 = $db->table('log_activity')
                        ->selectCount('status_read', 'Count_Unread_Log')
                        ->where('status_read', 'unread')
                        ->whereIn('category', ['Level_3', 'Level_4', 'Level_5']) // Matches the value in the category column.
                        ->where('id_user', $id_user)
                        ->get();
            // Unread count.
            $result2 = $count2->getRow();
            $log_count = $result2->Count_Unread_Log;
        // ======================================================================

            return  $this->response->setJSON($log_count);
        }
    // ===================================================================================================
    
    // MENDAPATKAN DAFTAR PESAN DAN LOG UNTUK DI LIST NOTIFIKASI PADA NAVIGASI =========================
        public function getMsg()
        {
            $id_user = session()->get('id_user');
            $db = \Config\Database::connect();
            $level_user = session()->get('level');

            if($level_user == 'Cs'){
                $queryData_1 = $db->table('activity_chat') // MENGAMBIL NOTIF PESAN DARI CLIENT
                    ->select('activity_chat.id_user, activity_chat.id_chat, activity_chat.message_id, activity_chat.desc_chat, activity_chat.date_chat, activity_chat.time_chat, ticket_chat.subject, ticket_chat.ticketstatus, ticket_chat.priority, user_servers.user_name, user_servers.foto')
                    ->join('user_servers', 'activity_chat.id_user = user_servers.id_user')
                    ->join('ticket_chat', 'activity_chat.id_chat = ticket_chat.id_chat')
                    ->where('activity_chat.status_read', 'unread')
                    ->where('activity_chat.assigned_id_cs', $id_user) // BERDASARKAN PEMBUAT TICKET
                    ->get()
                    ->getResultArray();
                $queryData_2 = $db->table('activity_chat') // MENGAMBIL NOTIF PESAN DARI ADMIN
                    ->select('activity_chat.id_user, activity_chat.id_chat, activity_chat.message_id, activity_chat.desc_chat, activity_chat.date_chat, activity_chat.time_chat, ticket_chat.subject, ticket_chat.ticketstatus, ticket_chat.priority, user_servers.user_name, user_servers.foto')
                    ->join('user_servers', 'activity_chat.id_user = user_servers.id_user')
                    ->join('ticket_chat', 'activity_chat.id_chat = ticket_chat.id_chat')
                    ->where('activity_chat.status_read', 'unread')
                    ->where('activity_chat.destination_id_user', $id_user) // BERDASARKAN TUJUAN TICKET
                    ->get()
                    ->getResultArray();

                $queryData = array_merge_recursive($queryData_1, $queryData_2); // MENGGABUNGKAN KEDUA QUERY 
                foreach ($queryData as &$msg) { // MENAMBAHKAN INDEX KE DALAM ARRAY $queryData
                    $msg['categori_notif'] = 'message';
                }
                return $this->response->setJSON($queryData); //KEMBALIKAN $queryData DALAM BENTUK JSON
            }else{
                $queryData = $db->table('activity_chat')
                    ->select('activity_chat.id_user, activity_chat.id_chat, activity_chat.message_id, activity_chat.desc_chat, activity_chat.date_chat, activity_chat.time_chat, ticket_chat.subject, ticket_chat.ticketstatus, ticket_chat.priority, user_servers.user_name, user_servers.foto')
                    ->join('user_servers', 'activity_chat.id_user = user_servers.id_user')
                    ->join('ticket_chat', 'activity_chat.id_chat = ticket_chat.id_chat')
                    ->where('activity_chat.status_read', 'unread')
                    ->where('activity_chat.destination_id_user', $id_user)
                    ->get();

                $result = $queryData->getResult();
                $finalResult = array_map(function($msg) {
                    $msgArray = json_decode(json_encode($msg), true); // OBJECT STDCLASS
                    $msgArray['categori_notif'] = 'message'; // MASUKAN INDEKS BARU KEDALAM  $result.
                    return $msgArray;
                }, $result);
                
                return $this->response->setJSON($finalResult);
            }  
        }
        public function getLog()
        {
            $id_user = session()->get('id_user');
            $log = new LogModel();
            $dataLog = $log->where('id_user',$id_user)
                            ->where('status_read','unread')
                            ->whereIn('category', ['Level_3', 'Level_4', 'Level_5']) // Matches the value in the category column.
                            ->findAll();

            $finalResult = array_map(function($msg) {
                $msgArray = json_decode(json_encode($msg), true); // Object StdClass to Array
                $msgArray['categori_notif'] = 'log'; // Insert new key and value to $result.
                return $msgArray;
            }, $dataLog);

            return $this->response->setJSON($finalResult);
        }
    // ===================================================================================================
  // =====================================================================================================

  // MERCHANT ==========================================================================================
    public function merch()
    {       
        // Session untuk memberi nilai property active pada navbar
        session()->set('active', 'merch');
        session()->set('active1', '');
        session()->set('subShow', '');
        // ==================================
        $modelmerchant    = new MerchantModel();
        $merch['merchant'] = $modelmerchant->findAll(); // Melakukan Query dengan Model, men-select data berdasarkan kolom payment dengan value paid.
        echo view('header.php');
        echo view('navigasi.php');
        echo view('dashboard_merch.php', $merch);
        echo view('dashboard_footer.php');
        echo view('script_plugin.php');        
    }
  // ===================================================================================================


  // ACCOUNT AND SECURITY ==============================================================================
    public function accountSecurity()
    {       
        // Session untuk memberi nilai property active pada navbar
        session()->set('active', 'subpage');
        session()->set('active1', 'subpage2');
        session()->set('subShow', 'show');
        // ==================================
        $id_user = session()->get('id_user');
        $datauser    = new UserServersModel();
        $dataprofile['profile'] = $datauser->where('id_user', $id_user)->findAll();
        $dataUpdateUser = (array_merge(...$dataprofile['profile']));

        // Create new session after update tabel user.
        if (!empty($dataUpdateUser)) {
            session()->set('foto', $dataUpdateUser['foto']);
            session()->set('user_name', $dataUpdateUser['user_name']);
            session()->set('first_name', $dataUpdateUser['first_name']);
            session()->set('last_name', $dataUpdateUser['last_name']);
            session()->set('user_email', $dataUpdateUser['user_email']);
            session()->set('user_phone', $dataUpdateUser['user_phone']);
        }
        echo view('header.php');
        echo view('navigasi.php');
        echo view('dashboard_accountSecurity.php', $dataprofile);
        echo view('dashboard_footer.php');
        echo view('script_plugin.php');        
    }
    public function prosesUpdateAccountSecurity($arr) //Parameter from view (type stdClass Object)
    {        
        $modelUpdate   = new UserServersModel();
        $id_user       = session()->get('id_user');
        // Convert from stdClass Object to Array (true).
        $array = json_decode($arr, true);

        // Fetch Array $arr.
        $parameter = $array['param'];
        $dataupdate = $array['data'];

        if (isset($dataupdate)) // Memeriksa variable $dataupdate, kosong atau sudah ada data.
        {
            //Kondisi jika $dataupdate terdapat data, dan selanjutnya memeriksa isi parameter yang dikirim.
            //Kondisi yang dijalankan sesuai dengan parameter yang dikirim.
            if ($parameter == 'firstname'){ // Proses update first name apabila parameter berniai firstname.
                $updateProfile = [
                    'first_name'    => $dataupdate
                ];
                $modelUpdate->updateDataUser($updateProfile, $id_user);
                session()->setFlashdata('notif', 'trueFName');
                return redirect()->to('accScur');
            } elseif ($parameter == 'lastname'){ // Proses update last name apabila parameter berniai lastname.
                $updateProfile = [
                    'last_name'    => $dataupdate
                ];
                $modelUpdate->updateDataUser($updateProfile, $id_user);
                session()->setFlashdata('notif', 'trueLName');
                return redirect()->to('accScur');
            } elseif ($parameter == 'email'){ // Proses update email apabila parameter berniai email.
                $updateProfile = [
                    'user_email'    => $dataupdate
                ];
                $modelUpdate->updateDataUser($updateProfile, $id_user);
                session()->setFlashdata('notif', 'trueEmail');
                return redirect()->to('accScur');
            } elseif ($parameter == 'phone'){ // Proses update nomor telephon apabila parameter berniai phone.
                $updateProfile = [
                    'user_phone'    => $dataupdate
                ];
                $modelUpdate->updateDataUser($updateProfile, $id_user);
                session()->setFlashdata('notif', 'truePhone');
                return redirect()->to('accScur');
            } else {
                // Kondisi jika $dataupdate kosong, atau tidak ada data yang diterima.
                session()->setFlashdata('notif', 'falseUpdate');
                return redirect()->to('accScur');
            }
        }
    }
    public function prosesUpdateFotoProfile() // Catatan: Edit session untuk notifikasi sukses atau gagal dengan alert.
    {
        $modelUpdate   = new UserServersModel();
        $id_user       = session()->get('id_user');
        $foto     = session()->get('foto');

        if (empty($foto)) {
            if (!$this->validate([
                'foto' => [
                    'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto,10240]',
                    'errors' => [
                        'uploaded' => 'Harus Ada File yang diupload',
                        'mime_in' => 'Extention Harus Berupa jpg, gif, atau png',
                        'max_size' => 'Ukuran File Maksimal 10 MB'
                    ]
                ]
            ])) {
                session()->setFlashdata('errorPF', $this->validator->listErrors());
                return redirect()->to('accScur');
            }
            $dataBerkas = $this->request->getFile('foto');
            $filename = $dataBerkas->getRandomName();
            $path = ROOTPATH . 'public/assets/images/users/';
            if ($dataBerkas->move($path, $filename)) {
                $updateProfile = [
                    'foto' => $filename
                ];
                $modelUpdate->updateDataUser($updateProfile, $id_user);
                session()->setFlashdata('successPF', 'Your profile picture has been changed successfully!');
                return redirect()->to('accScur');
            }
        } else {
            if (!$this->validate([
                'foto' => [
                    'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto,10240]',
                    'errors' => [
                        'uploaded' => 'Harus Ada File yang diupload',
                        'mime_in' => 'Extention Harus Berupa jpg, gif, atau png',
                        'max_size' => 'Ukuran File Maksimal 10 MB'
                    ]
                ]
            ])) {
                session()->setFlashdata('errorPF', $this->validator->listErrors());
                return redirect()->to('accScur');
            }            

            $dataBerkas = $this->request->getFile('foto'); // Menangkap nama image dan berkas image, untuk di upload ke database.
            $filename = $dataBerkas->getRandomName(); // Membuat nama file secara random.
            $path = ROOTPATH . 'public/assets/images/users/'; // Mengatur path penyimpanan untuk file image yang baru.

            // Delete old Foto with new foto.
            $file = ROOTPATH . 'public/assets/images/users/' . $foto; // Mengatur path dari file image lama yang di maksud untuk di ganti.

            if(!file_exists($file)){ // Kondisi jika file di dalam directory tidak ada, tetapi didatabase ada.
                // Karena di directory tidak ada file yang di maksud, langsung lakukan upload image baru.
                if ($dataBerkas->move($path, $filename)) {
                    $updateProfile = [
                        'foto' => $filename
                    ];
                    $modelUpdate->updateDataUser($updateProfile, $id_user);
                    // session()->set('foto', $filename);
                    session()->setFlashdata('successPF', 'Your profile picture has been changed successfully!');
                    return redirect()->to('accScur');
                }
            }else{ // Kondisi jika file di dalam directory ada, dan didatabase ada.
                unlink($file); // hapus file di directory terlebih dahulu, selanjutnya upload image baru.
                if ($dataBerkas->move($path, $filename)) {
                    $updateProfile = [
                        'foto' => $filename
                    ];
                    $modelUpdate->updateDataUser($updateProfile, $id_user);
                    // session()->set('foto', $filename);
                    session()->setFlashdata('successPF', 'Your profile picture has been changed successfully!');
                    return redirect()->to('accScur');
                }
            }    
        }
    }
    public function prosesUpdatePassword($Pass)
    {
        helper(['form', 'url']);
        $modelUpdate   = new UserServersModel();
        $id_user       = session()->get('id_user');

        $updateProfile = [
            'password'    => sha1($Pass)
        ];
        $modelUpdate->updateDataUser($updateProfile, $id_user);

        session()->setFlashdata('automaticLogout', 'logoutNow');
        return redirect()->to('accScur');
    }
    public function setTwoFactor() // Set active or Nonactive Two_Factor auth.
    {
        $paramType = $this->request->getVar('paramStatus');
        if($paramType == 'phoneNumbers'){
            $paramStatus = $this->request->getVar('paramStatus');
            $id_user = session()->get('id_user');
            $modelUpdate   = new UserServersModel();
            $updateProfile = [
                'type_two_auth' => 'phone',
                'two_factor_auth' => $paramStatus
            ];
            $modelUpdate->updateDataUser($updateProfile, $id_user);
        }else if($paramType == 'emailAddress'){
            $paramStatus = $this->request->getVar('paramStatus');
            $id_user = session()->get('id_user');
            $modelUpdate   = new UserServersModel();
            $updateProfile = [
                'type_two_auth' => 'email',
                'two_factor_auth'    => $paramStatus
            ];
            $modelUpdate->updateDataUser($updateProfile, $id_user);
        }
       
    } 
  // ===================================================================================================


  // LOGOUT ============================================================================================
    public function logout()
    {
        // Get id from generate_LogID()
        $generatorLogId = new GeneratorController();
        $generatLogId = $generatorLogId->generate_LogID();

        $modelLogin  = new UserServersModel();
        $logActivity = new LogModel();
        $id_user = session()->get('id_user');

        // Send value 0 to database, when user offline.
        $stat_online_offline = [
            'status_active_user'=>0
        ];
        $modelLogin->updateDataUser($stat_online_offline,$id_user);

        $logLogout = [
            'id_log' => $generatLogId,
            'id_user' => $id_user,
            'category' => $this->LoginLogout,
            'date_time' => date_create()->format("Y-m-d H:i:s"),
            'desc_log_activity'=> $id_user.' Logout.', // User yang eksekusi _aksi_ user yang dieksekusi.
        ];                   
        $logActivity->insert($logLogout);

        session()->destroy();
        session()->setFlashdata('success', 'Anda sudah berhasil logout!');
        
        return redirect()->to('/');
    }
  // ===================================================================================================


  // SEND EMAIL ======================================================================================== 
    function sendMailPage()
    {
        // Halaman form untuk input email tujuan, dan pesan email.

        // Form email akan dibuat didalam file account and security file, dalam bentuk modal form untuk registrasi alamat email.
        // Form diisi oleh pengguna untuk mendapatkan code OTP yang dibutuhkan untuk proses verifikasi 2 langkah. 
        // Apabila status two-factor verification true, maka setiap user login akan diminta memasukan nomor otp baru.
        // Catatan: Nomor OTP baru di minta apabila session login dari pengguna telah kadarluarsa, Jika belum maka tidak perlu input Code OTP baru.
    }
    function sendMail() { 
        // $to = $this->request->getVar('mailTo'); // Alamat email tujuan
        // $subject = $this->request->getVar('subject'); // Subject dari email yang dikirim
        // $message = $this->request->getVar('message'); // Pesan dari email yang dikirim 
        
        $to = 'alberttan101112@gmail.com';
        $subject='Test Send Email';
        $message = session()->getTempdata('otp');

        $email = \Config\Services::email(); 
        $email->setTo($to);
        $email->setFrom('informatik.web.development@gmail.com', 'Confirm Registration');
        
        $email->setSubject($subject);
        $email->setMessage($message);
        if ($email->send()) 
		{
            echo 'Email successfully sent';
        } 
		else 
		{
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
    }
  // ===================================================================================================
}