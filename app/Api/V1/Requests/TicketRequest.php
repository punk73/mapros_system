<?php

namespace App\Api\V1\Requests;

use Config;
use Dingo\Api\Http\FormRequest;

class TicketRequest extends FormRequest
{
    public function rules()
    {
        return [
            'code' => 'required',
            'line_id' => 'required|integer',
            'count' => 'required|integer'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
