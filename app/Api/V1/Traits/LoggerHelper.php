<?php

namespace App\Api\V1\Traits;


use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Log;
use Auth;
use DB;

trait LoggerHelper {	

    // protected $logTable = new Log;

    public function postLog(Request $request, $action=null, $scannerId=null ){

        $ip = $request->ip();
        $user = $this->getUser();

        $log = new Log;
        $log->action = $action;
        $log->scan_nik = (isset($user['nik'])) ? $user['nik'] : null ;
        $log->scanner_id = $scannerId;
        $log->description = $this->getQueryParameter();
        $log->save();

        // return $log->toArray();

    }

    public function getQueryParameter(){
        $arrayQuery = DB::getQueryLog();

        if (count($arrayQuery) == 0 ) {
            return 'no query available';
        }
        // fwrite(STDOUT, var_dump($arrayQuery));
        // get last array index
        $sql = $arrayQuery[count($arrayQuery) - 1 ];
        $query = str_replace(array('%', '?'), array('%%', '%s'), $sql['query']);
        $query = vsprintf($query, $sql['bindings']);

        return $query;
    }

    public function getUser(){
        return Auth::user();
    }

}