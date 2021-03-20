<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TownInfoGetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'townCode' => ['required', 'array'],
            'townCode.*' => ['regex:/^[0-9]{12}/'],
        ];
    }

    public function makeTownCodes(): array
    {
        return $this->townCode;
    }
}
