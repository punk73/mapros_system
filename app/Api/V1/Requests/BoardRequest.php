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
            'nik' => 'required'
            
        ];
    }

    public function authorize()
    {
        return true;
    }
}
