<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class DispatcherUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if($method == 'PUT'){
        return [
            'name'=>['required'],
            'phone'=>['required']
               ];
        }else{
            return [
            'name'=>['sometimes','required'],
            'phone'=>['sometimes','required']
            ];
        }



    }
}
