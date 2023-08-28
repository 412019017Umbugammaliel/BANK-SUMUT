<?php 
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
         // PENGECUALIAN UNTUK reOtp,
         // PENGGUNA DAPAT MENGAKSES reOtp UNTUK MENDAPAT KODE OTP BARU JIKA SESSION FirstLogin ada.
         // JIKA SESSION FirstLogin TIDAK ADA MAKA AKAN DIALIHKAN KE HALAMAN LOGIN.
         // PENGGUNA DAPAT MENERIMA KODE OTP BARU JIKA HANYA EMAIL DAN PASSWORD TERVALIDASI, PADA SAAT TERVALIDASI SISTEM AKAM MEMBUAT
         // SEBUAH SESSION FirstLogin.
        //  $uri = $request->uri->getPath();
        //  if ($uri === 'reOtp') {
        //     if(session()->has('FirstLogin')){
        //         return;  
        //     }else{
        //         return redirect()->to(base_url('/'));
        //     }            
        // }
        // KONDISI JIKA BELUM TERVALIDASI EMAIL DAN PASSWORDNYA.
        if(!session()->has('statuslogin')){
            return redirect()->to(base_url('/'));
        }
    }    
    public function after(RequestInterface $request, 
    ResponseInterface $response, $arguments = null)
    {
       
    }
}