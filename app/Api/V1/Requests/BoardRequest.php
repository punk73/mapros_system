<?php

namespace App\Api\V1\Requests;

use Config;
use Dingo\Api\Http\FormRequest;

class BoardRequest extends FormRequest
{
    public function rules()
    {
        return [
            'board_id' => 'required',
            // 'guid_master' => 'required',
            // 'guid_ticket' => 'required',
            'scanner_id' => 'integer',
            'status' => 'required',
            'scan_nik' => 'required',
            // 'judge' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
