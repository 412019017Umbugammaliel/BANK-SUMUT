<?php

namespace App\Controllers;

use App\Models\UserServersModel;
use App\Models\TicketModel;
use App\Models\ActivityChatModel;

use App\Controllers\GeneratorController;

class LiveChatController extends BaseController
{
    private $Admin = "Admin_idnKa_20301";
    private $CS = "CS_Center";

    
    public function __construct()
    {
        helper('form');
        helper('url');
        helper('download');
        
    }
    // HALAMAN HELP.
    public function help()
    {
        // Session untuk memberi nilai property active pada navbar
        session()->set('active', 'help');
        session()->set('active1', '');
        session()->set('subShow', '');
        // ==================================

        echo view('header.php');
        echo view('navigasi.php');
        echo view('dashboard_help.php');
        echo view('dashboard_footer.php');
        echo view('script_plugin.php');    
    }

    public function ticket()
    {       
        // Session untuk memberi nilai property active pada navbar
        session()->set('active', 'liveChat');
        session()->set('active1', '');
        session()->set('subShow', '');
        // ==================================
        echo view('header.php');
        echo view('navigasi.php');
        echo view('dashboard_ticket.php');
        echo view('dashboard_footer.php');
        echo view('script_plugin.php');          
    }
    // MEMBUAT TICKET BARU.
    public function createNewChat()
    {
        $creator_id_user = session()->get('id_user');
        $creator_user_name = session()->get('user_name');
        // Get value from select option
        $ticket = $this->request->getPost('ticket');
        $priority = $this->request->getPost('priority');      
        $subject_chat = $this->request->getPost('subjectChat'); // From select option subject.
        // Get value from input text
        $subject_chat_other = $this->request->getPost('subjectChatOther'); // From input text other subject.

      // Condition if one of the variables is filled =============================================
        if(isset($subject_chat)){
            $subject = $subject_chat; // From select option
        }else if(isset($subject_chat_other)){
            $subject = $subject_chat_other; // From input text
        }
      // =========================================================================================

      // Cek level and Get data about detailed information of the intended users =================
        if(session()->get('level') == "Client"){
            $dest_id_user = $this->CS; // If Client, create a ticket only for CS
            $dest_user_name = 'Customer Service';
            $dest_level_user = 'Cs';
        }else if(session()->get('level') == "Cs"){
            $dest_id_user = $this->Admin; // If Cs, create a ticket only for Admin
            $dest_user_name = 'Admin Center';
            $dest_level_user = 'Admin';
        }
        // else if(session()->get('level') == "Admin"){
        //     // If Admin, Get destination from select option destination (Previlage for Admin)
        //     $dest_id_user = $this->request->getPost('du_id');

        //     $data = new UserServersModel();
        //     $getData = $data->where('id_user',$dest_id_user)->findAll();
        //     $dest_data = (array_merge(...$getData));
        //     $dest_user_name = $dest_data['user_name']; // Get user name from the intended users
        //     $dest_level_user = $dest_data['level'];
        // }
      // =========================================================================================    


      // Menjalankan fungsi generate_ChatID(), untuk mendapatkan id baru untuk chat notifikasi ===
        $generateChatID = new GeneratorController();
        $idChat = $generateChatID->generate_ChatID();
      // =========================================================================================
        
      // Insert all data information for creat a new ticket
        $ticketModel = new TicketModel();
        $ticketModel->insert([
            'id_chat' => $idChat,            
            'subject' => $subject,   
            'destination_id_user' => $dest_id_user,
            'destination_user_name' => $dest_user_name,
            'destination_level' => $dest_level_user,            
            'ticket' => $ticket,
            'priority' => $priority,
            'ticketstatus' => 'OPEN', 
            'datetime' => date_create()->format("Y-m-d H:i:s"), // Get date & time when a ticket created 
            'creator_id'=> $creator_id_user,
            'creator_name'=> $creator_user_name            
        ]);
      // =======================================================
        session()->setFlashdata('createnewchat', 'A new chat has been created!');        
        return redirect()->to('liveChat'); 
    }
    // PROSES PENUGASAN CS TERHADAP TICKET (PROSES PENGAMBILAN TICKET OLEH CS).
    public function assignTicketCS()
    {
        $id_cs = session()->get('id_user');
        $idChat = $this->request->getVar('id_chat');
        $nameCs = $this->request->getVar('name_Cs');

        $ticketModel = new TicketModel();       
        $update_ticket = [
            'id_chat' => $idChat, 
            'assigned_id_cs'=> $id_cs,
            'assigned_name_cs' => $nameCs
        ];
        $ticketModel->updateTicket($update_ticket,$idChat);
        
    }
    // CEK APAKAH TICKET SUDAH DI HANDLE OLEH CS LAIN ATAU BELUM (FUNGSI UNTUK MENCEGAH TICKET YANG SUDAH DIAMBIL CS A BISA DIAMBIL CS B).
    public function retriveTicketDataById()
    {
        $idChat = $this->request->getVar('id_chat');
        $data = new TicketModel();
        $getData = $data->where('id_chat',$idChat)->findAll();
        return $this->response->setJSON($getData);
    }
    // MENGAMBIL SELURUH DATA TICKET.
    public function retriveTicketData()
    {
        $data = new TicketModel();
        $getData = $data->findAll();
        return $this->response->setJSON($getData);
    }
    // MENGAMBIL INFORMASI TICKET BERDASARKAN ID CHAT/ ID DARI TIKET.
    public function retriveData()
    {
        $id_chat = $this->request->getVar('id_chat');
        $data = new TicketModel();
        $getData['datanotif']=$data->where('id_chat',$id_chat)->findAll();
        return $this->response->setJSON($getData);
    }
    // MENUTUP TIKET OLEH PEMBUAT TIKET.
    public function closeChat()
    {
        $id_chat = $this->request->getVar('id_chat');
        $data = new TicketModel();
        $update_ticket = [
            'ticketstatus' => 'CLOSED'
        ];
        $data->updateTicket($update_ticket,$id_chat);
    }
    // MENGAMBIL ISI DARI TICKET (DATA OBROLAN DIDALAM TIKET).
    public function getActivityChat()
    {
        $id_chat = $this->request->getVar('id_chat');

        // MENGAMBIL DATA DARI activity_chat (SEBAGAI ISI OBROLAN), DAN user_servers (SEBAGAI INFORMASI PENGIRIM PESAN).
        $db = \Config\Database::connect();
        $queryData = $db->table('activity_chat')
                        ->select('activity_chat.*','user_servers.*')
                        ->join('user_servers','user_servers.id_user = activity_chat.id_user','left')
                        ->where('activity_chat.id_chat',$id_chat)
                        ->get();
        $data= $queryData->getResult();
        return $this->response->setJSON($data);
    }
    
    // PROSES KIRIM PESAN DALAM TICKET
    public function chatActivity()
    {
        // AMBIL SESSION
            $id_user = session()->get('id_user');
            $user_name = session()->get('user_name');
            $level_user = session()->get('level');
        // AMBIL OBJECT FILE YANG DIKIRIM (BERISIKAN INFORMASI FILE DALAM BENTUK OBJECT ARRAY)
            $file = $this->request->getFile('file');   
        // AMBIL NILAI YANG DIKIRIM.  
            $id_chat = $this->request->getVar('id_chat');                
            $inputChat = $this->request->getVar('input_chat');
            $dest_id_user = $this->request->getVar('dest_id_user');
            $dest_user_name = $this->request->getVar('dest_user_name');
            $get_assign_id_cs = ''; 
            $get_id_creator = '';
            $get_name_creator = '';
        // ATUE FORMAT JAM DAN TANGAL.
            $date = date_create()->format("Y-m-d");
            $time = date_create()->format("H:i:s");

        // MENDAPATKAN ID DAN NAMA DARI PEMBUAT TICKET, KEDUA NILAI INI DIGUNAKAN UNTUK PENERIMA PESAN MEMBALAS PESAN KE ID DAN NAMA PEMBUAT TICKET TERSEBUT.
            $db = \Config\Database::connect();
            $queryData = $db->table('ticket_chat')
                            ->select('ticket_chat.*')
                            ->where('id_chat',$id_chat)
                            ->get();
            $data= $queryData->getResult();
            
            foreach($data as $Rdata){
                $get_id_creator = $Rdata->creator_id;
                $get_name_creator = $Rdata->creator_name;        
                
                // BERI NILAI UNTUK PENUGASAN TICKET PADA CS, SELAIN Client DIKOSONGKAN. 
                if($level_user == 'Client'){
                    $get_assign_id_cs = $Rdata->assigned_id_cs; // AMBIL NILAI DARI assigned_id_cs.               
                }else{
                    $get_assign_id_cs = ''; // KOSONGKAN NILAI.
                }
            }
        // =============================================================
       
        // MEMBUAT ID PESAN UNTUK SETIAP PESAN YANG DIKIRIM.
            $generateMessageID = new GeneratorController();
            $msgID = $generateMessageID->generate_MessageID(); 
       
        // MEMERIKSA BENTUK PESAN YANG DIKIRIM, TEXT ATAU FILE.
            $dataChat = new ActivityChatModel();
            if($file){ // KONDISI JIKA FILE YANG DIKIRIM, MEMERIKSA APAKAH $file MEMILIKI NILAI JIKA TIDAK LANJUT KEKONDISI KEDUA.
                // MENGAMBIL INFORMASI DARI OBJECT FILE YANG AKAN DIKIRIM.
                $fileNameExt = $file->getName(); // MENGAMBIL NAMA FILE.
                $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME); // MENGAMBIL DAN MEMISAHKAN NAMA FILE DARI EKSTENSI-NYA.
                $fileExt = $file->getExtension(); // MENGAMBIL EXTENTION FILE.
                $fileSize = $file->getSize(); // MENGAMBIL UKURAN DARI FILE.
                // $currentDatetime = date('Y-m-d H:i:s');
                $fileNameUpload = $fileName.'_'.$date.'_'.str_replace(':', '-', $time).'.'.$fileExt;
                // $fileNameUpload = $fileName.'_'.str_replace(':', '-', $currentDatetime).'.'.$fileExt;
                // MEMBUAT PATH FOLDER, TEMPAT PENYIMPANAN FILE DI SERVER DARI FILE YANG DIKIRIM. 
                $path = ROOTPATH . 'public/file_upload/';
                // VALIDASI FILE SEBELUM DIKIRIM.
                if (!$this->validate([
                    'file' => [
                        'rules' => 'uploaded[file]|mime_in[file,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,image/jpg,image/jpeg,image/gif,image/png]|max_size[file,200000]',
                        'errors' => [
                            'uploaded' => 'Harus Ada File yang diupload',
                            'mime_in' => 'Extention Harus Berupa doc, docx, pdf, jpg, gif, atau png',
                            'max_size' => 'Ukuran File Maksimal 20 MB'
                        ]
                    ]
                ])) {         
                    // KIRIM NILAI BALIK, JIKA ADA KESALAHAN DALAM PENGIRIMAN FILE SESUAI VALIDASI YANG DITENTUKAN.
                    session()->setFlashdata('liveErrorChatNotif', $this->validator->listErrors());
                    
                }
                if ($file->move($path, $fileNameUpload)) {
                    $dataChat->insert([
                        'id_chat' => $id_chat,
                        'message_id'=> $msgID,
                        'id_user' => $id_user, 
                        'user_name' => $user_name,
                        'date_chat' => $date,
                        'time_chat' => $time,
                        'destination_id_user' => $dest_id_user,
                        'destination_user_name' => $dest_user_name,
                        'assigned_id_cs' => $get_assign_id_cs,
                        'status_read' => "unread",
                        'creator_id'=> $get_id_creator,
                        'creator_name'=> $get_name_creator,
                        'file_upload' => $fileNameUpload,
                        'ext_file' => $fileExt,
                        'file_size' => $fileSize
                    ]);
                }            
            }else{ // KONDISI JIKA PESAN BUKAN FILE, TETAPI TEXT.
                $dataChat->insert([
                    'id_chat' => $id_chat,
                    'message_id'=> $msgID,
                    'id_user' => $id_user, 
                    'user_name' => $user_name,       
                    'desc_chat' => $inputChat,
                    'date_chat' => $date,
                    'time_chat' => $time,
                    'destination_id_user' => $dest_id_user,
                    'destination_user_name' => $dest_user_name,
                    'assigned_id_cs' => $get_assign_id_cs,
                    'status_read' => "unread",
                    'creator_id'=> $get_id_creator,
                    'creator_name'=> $get_name_creator
                ]);                              
            }
        // =============================================================
    }

    public function downloadFile()
    {
        $idFile = $this->request->getVar('id_file');
        $nameFile = $this->request->getVar('name_file');

        // Path ke file yang ingin diunduh
        $filePath = 'C:/xampp/htdocs/app_bank_sumut/public/file_upload/'.$nameFile;
        // Fungsi download() untuk memulai proses unduhan
        return $this->response->download($filePath, null)->setFileName($nameFile);
    }

    // MENDAPATKAN SEMUA JUMLAH PESAN BELUM TERBACA (STATUS UNREAD) =============================
        public function getUnreadCount()
        {
            $id_user = session()->get('id_user');
            $level_user = session()->get('level');
            
            $db = \Config\Database::connect();       
            // TABEL ACTIVITY_CHAT     
            if($level_user == 'Client' || $level_user == 'Admin'){ //CEK LEVEL
                // LAKUKAN QUERY
                $count1 = $db->table('activity_chat')
                            ->selectCount('status_read', 'Count_Unread_Msg') // HITUNG JUMLAH BARIS PADA KOLOM status_read DENGAN ALIAS Count_Unread_Msg, SORTIR BERDASARKAN KONDISI:
                            ->where('status_read', 'unread') // HITUNG JUMLAH BARIS KOLOM status_read BERISI unread, LALU DARI HASIL PENCARIAN DILAKUKAN SORTIR KEMBALI DENGAN KONDISI BERIKUTNYA.
                            ->where('destination_id_user', $id_user) // SETELAH DISORTIR BERDASARKAN unread, SORTIR KEMBALI BERDASARKAN KOLOM destination_id_user DENGAN BERISIKAN ID USER PENGUNA.
                            ->get(); // AMBIL HASIL QUERY YANG SUDAH DISORTIR.
                $finalResult = $count1->getRow();
                $msg_count = $finalResult->Count_Unread_Msg; // MENGAKSES ATRIBUT $Count_Unread_Msg DIDALAM OBJECT $finalResult (NILAI SUDAH DALAM BENTUK INTEGER)
            }else if($level_user == 'Cs'){
                $count1 = $db->table('activity_chat')
                            ->selectCount('status_read', 'Count_Unread_Msg')
                            ->where('status_read', 'unread')
                            ->where('assigned_id_cs', $id_user)
                            ->get();
                $Result1 = $count1->getRow();
                $msg_count = $Result1->Count_Unread_Msg;
            }        
            return  $this->response->setJSON($msg_count);
        }
        public function getUnreadCountMyTicetCs()
        {
                $id_user = session()->get('id_user');
            
                $db = \Config\Database::connect();       
            // Tabel activity_chat ==================================================
                $count1 = $db->table('activity_chat')
                            ->selectCount('status_read', 'Count_Unread_Msg')
                            ->where('status_read', 'unread')
                            ->where('destination_id_user', $id_user)
                            ->get();
                $result1 = $count1->getRow();
                $msg_count_my_ticket_cs = $result1->Count_Unread_Msg;
            // ======================================================================       
            return  $this->response->setJSON($msg_count_my_ticket_cs);
        }
        public function getUnreadCountNav()
        {
            $id_user = session()->get('id_user');
            $level_user = session()->get('level');
            
            $db = \Config\Database::connect();       
            // TABEL ACTIVITY_CHAT     
            if($level_user == 'Client' || $level_user == 'Admin'){ //CEK LEVEL
                // LAKUKAN QUERY
                $count1 = $db->table('activity_chat')
                            ->selectCount('status_read', 'Count_Unread_Msg') // HITUNG JUMLAH BARIS PADA KOLOM status_read DENGAN ALIAS Count_Unread_Msg, SORTIR BERDASARKAN KONDISI:
                            ->where('status_read', 'unread') // HITUNG JUMLAH BARIS KOLOM status_read BERISI unread, LALU DARI HASIL PENCARIAN DILAKUKAN SORTIR KEMBALI DENGAN KONDISI BERIKUTNYA.
                            ->where('destination_id_user', $id_user) // SETELAH DISORTIR BERDASARKAN unread, SORTIR KEMBALI BERDASARKAN KOLOM destination_id_user DENGAN BERISIKAN ID USER PENGUNA.
                            ->get(); // AMBIL HASIL QUERY YANG SUDAH DISORTIR.
                $finalResult = $count1->getRow();
                $msg_count = $finalResult->Count_Unread_Msg; // MENGAKSES ATRIBUT $Count_Unread_Msg DIDALAM OBJECT $finalResult (NILAI SUDAH DALAM BENTUK INTEGER)
            }else if($level_user == 'Cs'){
                $count1 = $db->table('activity_chat')
                            ->selectCount('status_read', 'Count_Unread_Msg')
                            ->where('status_read', 'unread')
                            ->where('assigned_id_cs', $id_user)
                            ->get();
                $Result1 = $count1->getRow();
                $tempResult1 = $Result1->Count_Unread_Msg;
                $count2 = $db->table('activity_chat')
                            ->selectCount('status_read', 'Count_Unread_Msg')
                            ->where('status_read', 'unread')
                            ->where('destination_id_user', $id_user)
                            ->get();            
                $Result2 = $count2->getRow();
                $tempResult2 = $Result2->Count_Unread_Msg;
                $msg_count = $tempResult1 + $tempResult2; // MENJUMLAHKAN HASIL QUERY UNTUK MENGHITUNG JUMLAH BARIS SESUAI KONDISI DARI DUA QUERY.
            }        
            return  $this->response->setJSON($msg_count);
        }
    // ==========================================================================================

    // MENDAPATKAN JUMLAH PESAN BELUM TERBACA BERDASARKAN ID TIKET (STATUS UNREAD) ==============
        // ADMIN DAN CLIENT    
        public function getUnreadCountIdChat()
        {
            $id_user = session()->get('id_user');
            $level_user = session()->get('level');
            $idChatTicket = $this->request->getVar('id_chat');       
            // TABEL ACTIVITY_CHAT
            $db = \Config\Database::connect();  
            if($level_user == 'Cs'){ // CEK LEVEL
                $query = $db->table('activity_chat')
                            ->selectCount('status_read', 'Count_Unread') // HITUNG JUMLAH BARIS PADA KOLOM status_read DENGAN ALIAS Count_Unread_Msg, SORTIR BERDASARKAN KONDISI:
                            ->where('id_chat', $idChatTicket) // HASIL DI SORTIR KEMBALI BERDASARKAN ID DARI TICKETNYA. (LEBIH SPESIFIK).
                            ->where('assigned_id_cs', $id_user) // SETELAH DISORTIR BERDASARKAN unread, SORTIR KEMBALI BERDASARKAN KOLOM assigned_id_cs DENGAN BERISIKAN ID USER PENGUNA.
                            ->where('status_read', 'unread') // HITUNG JUMLAH BARIS KOLOM status_read BERISI unread, LALU DARI HASIL PENCARIAN DILAKUKAN SORTIR KEMBALI DENGAN KONDISI BERIKUTNYA.
                            ->get(); // AMBIL HASIL QUERY YANG SUDAH DISORTIR.
            }else{
                $query = $db->table('activity_chat')
                            ->selectCount('status_read', 'Count_Unread')
                            ->where('id_chat', $idChatTicket)
                            ->where('destination_id_user', $id_user)
                            ->where('status_read', 'unread')
                            ->get();
            }
            $result = $query->getRow();
            $final_count = $result->Count_Unread;
            return  $this->response->setJSON($final_count); 
        }
        // CS
        public function getUnreadCountIdChatCs()
        {
            $id_user = session()->get('id_user');        
            $idChatTicket = $this->request->getVar('id_chat');       
            // TABEL ACTIVITY_CHAT
            $db = \Config\Database::connect();        
            $query = $db->table('activity_chat')
                        ->selectCount('status_read', 'Count_Unread')
                        ->where('id_chat', $idChatTicket)
                        ->where('destination_id_user', $id_user)
                        ->where('status_read', 'unread')
                        ->get(); 
            $result = $query->getRow();
            $final_count = $result->Count_Unread;
            return  $this->response->setJSON($final_count); 
        }   
    // ==========================================================================================
   
}

// public function createJsonAndDeleteActivityChat($id_chat)
// {
//     $activityChat = new ActivityChatModel();
//     $createJSONFile = $activityChat->where('id_chat',$id_chat)->findAll();
//     $json_data = json_encode($createJSONFile, JSON_PRETTY_PRINT); // mengubah data menjadi format JSON
//     $file = fopen('export_file_json/export_idChat_('.$id_chat.').json', 'w'); // membuka file untuk ditulis
//     fwrite($file, $json_data); // menulis data JSON ke dalam file
//     fclose($file); // menutup file
//     $activityChat->deleteMsg($id_chat);
// }   
// public function test(){       
//     $db = \Config\Database::connect();
//     $queryData = $db->table('ticket_chat')
//                     ->select('ticket_chat.*')
//                     ->where('id_chat','Ticket_ID_54618')
//                     ->get();
//     $data= $queryData->getResult();
            
//     dd($data);
// }