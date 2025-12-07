<?php
namespace App\Traits;


trait HostBasedRedirect {
    public function redirectBasedOnHost($msg=null){
        $host = request()->getHost();
        $subdomain = explode('.', $host)[0];
        $namedRoute = $subdomain==='moves' ? 'guest_home' : 'quote' ;           
        return $msg ? redirect()->route($namedRoute)->with('error',$msg) : redirect()->route($namedRoute);       
    }
}