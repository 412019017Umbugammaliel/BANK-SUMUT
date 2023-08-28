<?php

namespace App\Controllers;

use App\Models\UserServersModel;

class CekOnlineController extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('url');       
    }

    public function cekUser_onlineOffline()
    {
        $cekUser = new UserServersModel();
        $userCek = $cekUser->findAll();
        return $this->response->setJSON($userCek);
    }
}