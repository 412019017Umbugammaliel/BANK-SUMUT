<?php

namespace App\Controllers;


class GeneratorController extends BaseController
{
    public function randNumber()
    { 
        //Generat angka random 1-99999
        $random = rand(1, 99999999);
        return $random;
    }
    public function generate_LogID()
    {         
        $idChat = "Log_ID_". $this->randNumber(); 
        return $idChat; 
    }
    public function generate_cartOrder()
    {
        $idCart = "Cart ID ". $this->randNumber(); 
        return $idCart; 
    }
    public function generate_MessageID()
    {
        $idMessage = "message_ID_". $this->randNumber();       
        return $idMessage; 
    }
    public function generate_ChatID()
    {        
        $idChat = "Ticket_ID_". $this->randNumber(); //Hasil chat id 
        //==========================================================================================
        return $idChat; //Mengembalikan nilai yang ada dalam variable $idUser dalam fungsi generate_UserID(), agar saat dipanggil fungsi ini memiliki nilai.
    }
}