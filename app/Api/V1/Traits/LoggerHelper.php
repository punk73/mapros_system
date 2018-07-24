<?php

namespace App\Api\V1\Traits;


use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Log;
use Auth;

trait LoggerHelper {	

    // protected $logTable = new Log;

    public function postLog(Request $request, $action=null, $desc = null, $scannerId=null ){

        $ip = $request->ip();
        $user = $this->getUser();

        $log = new Log;
        $log->action = $action;
        $log->scan_nik = (isset($user['nik'])) ? $user['nik'] : null ;
        $log->scanner_id = $scannerId;
        $log->description = $desc;
        $log->save();

    }

    

    public function getUser(){
        return Auth::user();
    }

}