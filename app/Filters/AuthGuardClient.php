<?php 
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthGuardClient implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {       
        // if(isset(session()->get("statuslogin"))){
            $Level = session()->get('level');
            if($Level == 'Client')
            {
                return redirect()->to(base_url('main'));
            }
        // }
    }    
    public function after(RequestInterface $request, 
    ResponseInterface $response, $arguments = null)
    {
        
    }
}